<?php 
include "koneksi.php";

$error = "";
$success = false;

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])){
    $nama   = trim($_POST['nama']);
    $notelp = trim($_POST['notelp']);
    $email  = trim($_POST['email']);
    $pass   = trim($_POST['password']);

    if($nama=="" || $notelp=="" || $email=="" || $pass==""){
        $error = "Semua field wajib diisi.";
    } else {
        $stmt = $koneksi->prepare("
            INSERT INTO admin (nama, notelp, email, password) 
            VALUES (?, ?, ?, ?)
        ");

        $stmt->bind_param("ssss", $nama, $notelp, $email, $pass);

        if($stmt->execute()){
            $success = true;
        } else {
            $error = "Gagal menyimpan data: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Registrasi Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
:root{
    --bg1:#071129;
    --bg2:#0f2949;
    --accent:#ff7a59;
    --muted:#cbd5e1;
}
*{box-sizing:border-box}

/* ============================
   PERBAIKAN AGAR FOOTER DI BAWAH
   ============================ */
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,var(--bg1),var(--bg2));
    color:var(--muted);
    min-height:100vh;

    display:flex;
    flex-direction:column;  /* elemen disusun dari atas ke bawah */
    align-items:center;     /* form tetap di tengah */
    justify-content:center; /* form tetap center vertikal */

    padding:24px;
}

.card{
    width:100%;
    max-width:460px;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.06);
    backdrop-filter:blur(6px);
    border-radius:14px;
    padding:28px;
    box-shadow:0 12px 40px rgba(3,10,30,0.5);
}

h1{
    margin:0;
    font-size:22px;
    text-align:center;
    color:#fff;
    margin-bottom:4px;
}
.lead{text-align:center;margin-bottom:18px;color:#d6e3ff}

label{
    display:block;
    font-size:13px;
    color:#e8f0ff;
    margin-bottom:4px;
    margin-top:10px;
}

input{
    width:100%;
    padding:10px 12px;
    border-radius:8px;
    border:1px solid rgba(255,255,255,0.06);
    background:rgba(0,0,0,0.18);
    color:#fff;
}

input:focus{border-color:var(--accent)}

.btn{
    width:100%;
    margin-top:18px;
    padding:12px;
    border-radius:10px;
    border:none;
    background:linear-gradient(90deg,var(--accent),#ffb085);
    color:#082033;
    font-weight:700;
    cursor:pointer;
}
.alert{
    padding:12px;
    border-radius:10px;
    margin-bottom:12px;
}
.alert.error{background:rgba(255,107,107,0.12);color:#ff6b6b}
.alert.success{background:rgba(76,175,80,0.12);color:#4caf50}

a{text-decoration:none;color:var(--accent);font-weight:600}
.center{text-align:center;margin-top:10px}

footer{
    text-align:center;
    color:#cbd5e1;
    margin-top:auto; /* dorong footer ke bawah */
    padding:10px 0;
    font-size:14px;
}
</style>
</head>
<body>

<div class="card">

<?php if($success): ?>
    <div class="alert success">Registrasi berhasil!</div>
    <h2 style="text-align:center;color:#fff">Akun admin telah dibuat.</h2>
    <div class="center">
        <a href="admin_login.php">Ke Halaman Login</a>
    </div>

<?php else: ?>

    <h1>Registrasi Admin</h1>
    <div class="lead">Buat akun admin baru</div>

    <?php if($error): ?>
        <div class="alert error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">

        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>

        <label>No. Telepon</label>
        <input type="text" name="notelp" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button name="submit" class="btn">Daftar Admin</button>

    </form>

    <div class="center">
        <a href="admin_login.php">Sudah punya akun?</a>
    </div>

<?php endif; ?>

</div>

<footer>
    <p>@2025 Platform Beasiswa dibuat oleh JESSICA LOURENT XII5.</p>
    <p>Hubungi kami: info@beasiswa.com | +62 812-3456-7890</p>
</footer>

</body>
</html>
