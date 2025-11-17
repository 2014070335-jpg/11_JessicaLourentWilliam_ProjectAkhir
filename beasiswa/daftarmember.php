<?php
include "koneksi.php";

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $peserta       = trim($_POST['peserta'] ?? '');
    $nama_sekolah  = trim($_POST['nama_sekolah'] ?? '');
    $tgl_lahir     = trim($_POST['tgl_lahir'] ?? '');
    $nilai_rata    = trim($_POST['nilai_rata'] ?? '');
    $status_berkas = isset($_POST['status_berkas']) ? (int)$_POST['status_berkas'] : 0;

    if ($peserta === '' || $nama_sekolah === '' || $tgl_lahir === '' || $nilai_rata === '') {
        $error = "Semua field wajib diisi.";
    } elseif (!isset($_FILES['file_berkas']) || $_FILES['file_berkas']['error'] !== UPLOAD_ERR_OK) {
        $error = "Silakan upload file berkas (JPG/PNG/PDF).";
    } else {
        $upload = $_FILES['file_berkas'];
        $maxSize = 2 * 1024 * 1024;

        if ($upload['size'] > $maxSize) {
            $error = "File terlalu besar. Maks 2MB.";
        } else {
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime  = $finfo->file($upload['tmp_name']);

            $allowed = [
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'application/pdf' => 'pdf'
            ];

            if (!isset($allowed[$mime])) {
                $error = "Format file tidak diizinkan. Hanya JPG/PNG/PDF.";
            } else {
                $ext = $allowed[$mime];

                $uploadDir = __DIR__ . "/upload_member/";
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                $uniqueName = time() . "_" . bin2hex(random_bytes(6)) . "." . $ext;
                $targetPath = $uploadDir . $uniqueName;

                if (!move_uploaded_file($upload['tmp_name'], $targetPath)) {
                    $error = "Gagal menyimpan file upload.";
                } else {
                    $stmt = $koneksi->prepare("
                        INSERT INTO member (peserta, nama_sekolah, tgl_lahir, nilai_rata, status_berkas, file_berkas, waktu_daftar)
                        VALUES (?, ?, ?, ?, ?, ?, NOW())
                    ");

                    if (!$stmt) {
                        @unlink($targetPath);
                        $error = "Kesalahan server: " . $koneksi->error;
                    } else {
                        $nilai_rata_val = (float)$nilai_rata;

                        $stmt->bind_param("sssdis",
                            $peserta,
                            $nama_sekolah,
                            $tgl_lahir,
                            $nilai_rata_val,
                            $status_berkas,
                            $uniqueName
                        );

                        if ($stmt->execute()) {
                            $success = true;
                        } else {
                            @unlink($targetPath);
                            $error = "Gagal menyimpan data: " . $stmt->error;
                        }

                        $stmt->close();
                    }
                }
            }
        }
    }
}

$koneksi->close();
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Daftar Member</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<style>
:root{--bg1:#071129;--bg2:#0f2949;--accent:#ff7a59;--muted:#cbd5e1}
*{box-sizing:border-box}

body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,var(--bg1),var(--bg2));
    color:var(--muted);
    min-height:100vh;

    /* FIX FORM TETAP DI TENGAH */
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;

    padding:24px;
}

/* Agar card tidak menempel footer */
.card{
    width:100%;
    max-width:820px;
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.04);
    backdrop-filter:blur(6px);
    border-radius:14px;
    padding:28px;
    box-shadow:0 12px 40px rgba(3,10,30,0.6);
    margin-bottom:40px; /* jarak bawah agar footer rapi */
}

.header{display:flex;align-items:center;gap:14px;margin-bottom:16px}
.logo{width:56px;height:56px;border-radius:10px;background:linear-gradient(135deg,var(--accent),#ffb085);display:flex;align-items:center;justify-content:center;font-weight:700;color:#082033}
h1{margin:0;font-size:20px;color:#fff}
.lead{margin:4px 0 18px;color:#d6e3ff}
.form-row{display:flex;gap:12px}
.col{flex:1;min-width:0}
label{display:block;font-size:13px;color:#e8f0ff;margin-bottom:6px}
input,select{width:100%;padding:10px 12px;border-radius:8px;border:1px solid rgba(255,255,255,0.06);background:rgba(0,0,0,0.18);color:#fff}
input:focus,select:focus{border-color:var(--accent)}
.actions{display:flex;gap:12px;margin-top:12px}
.btn{flex:1;padding:12px;border-radius:10px;border:none;background:linear-gradient(90deg,var(--accent),#ffb085);color:#082033;font-weight:700;cursor:pointer;text-align:center;text-decoration:none}
.btn.secondary{background:transparent;border:1px solid rgba(255,255,255,0.06);color:var(--muted)}
.alert{padding:12px;border-radius:10px;margin-bottom:12px}
.alert.error{background:rgba(255,107,107,0.12);color:#ff6b6b;border:1px solid rgba(255,107,107,0.2)}
.alert.success{background:rgba(76,175,80,0.12);color:#4caf50;border:1px solid rgba(76,175,80,0.2)}
.thanks{text-align:center;padding:30px}
.thanks h2{color:#fff;margin-bottom:8px}

/* FOOTER – hanya tambahkan ini */
footer{
    text-align:center;
    color:#cbd5e1;
    margin-top:auto;
    padding:10px 0;
    font-size:14px;
}
</style>
</head>
<body>

<div class="card">

<?php if ($success): ?>

    <div class="thanks">
        <div class="alert success">Pendaftaran berhasil!</div>
        <h2>Terima kasih telah mendaftar!</h2>
        <p>Data Anda telah berhasil disimpan.</p>

        <a class="btn" href="index.php">Kembali ke Beranda</a>
    </div>

<?php else: ?>

    <div class="header">
        <div class="logo">BM</div>
        <div>
            <h1>Form Pendaftaran Member</h1>
            <div class="lead">Isi data dengan lengkap.</div>
        </div>
    </div>

    <?php if ($error): ?>
        <div class="alert error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">

        <label>Nama Peserta</label>
        <input type="text" name="peserta" required>

        <label style="margin-top:12px">Nama Sekolah</label>
        <input type="text" name="nama_sekolah" required>

        <div class="form-row" style="margin-top:10px">
            <div class="col">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" required>
            </div>
            <div class="col">
                <label>Nilai Rata-rata</label>
                <input type="number" name="nilai_rata" step="0.01" required>
            </div>
        </div>

        <label style="margin-top:12px">Status Berkas</label>
        <select name="status_berkas">
            <option value="0">Belum Lengkap</option>
            <option value="1">Lengkap</option>
        </select>

        <label style="margin-top:12px">Upload Berkas (JPG/PNG/PDF)</label>
        <input type="file" name="file_berkas" required>

        <div class="actions">
            <button class="btn" name="submit">Daftar Sekarang</button>
            <a class="btn secondary" href="index.php">Batal</a>
        </div>

    </form>

<?php endif; ?>

</div>

<footer>
    <p>@2025 Platform Beasiswa dibuat oleh JESSICA LOURENT XII5.</p>
    <p>Hubungi kami: info@beasiswa.com | +62 812-3456-7890</p>
</footer>

</body>
</html>
