<?php
session_start();
include "koneksi.php";

// Proteksi halaman: hanya admin yang sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Ambil semua data member
$query = "SELECT * FROM member ORDER BY waktu_daftar DESC";
$result = $koneksi->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Member</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
:root {
    --bg1:#071129;
    --bg2:#0f2949;
    --accent:#ff7a59;
    --muted:#cbd5e1;
}
*{box-sizing:border-box}
body{
    margin:0;
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,var(--bg1),var(--bg2));
    color:#fff;
    padding:24px;
}
.container{
    max-width:1100px;
    margin:auto;
    background:rgba(255,255,255,0.04);
    padding:24px;
    border-radius:14px;
    backdrop-filter:blur(6px);
    border:1px solid rgba(255,255,255,0.07);
    box-shadow:0 12px 40px rgba(3,10,30,0.6);
}
header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}
.logo{
    font-size:24px;
    font-weight:700;
    background:linear-gradient(135deg,var(--accent),#ffb085);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}
.btn{
    padding:10px 16px;
    background:linear-gradient(90deg,var(--accent),#ffb085);
    border:none;
    border-radius:10px;
    color:#082033;
    font-weight:600;
    text-decoration:none;
}
table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    background:rgba(0,0,0,0.25);
    border-radius:10px;
    overflow:hidden;
}
th,td{
    padding:12px;
    border-bottom:1px solid rgba(255,255,255,0.08);
    font-size:14px;
}
th{
    background:rgba(255,255,255,0.08);
    font-weight:600;
}
tr:hover{
    background:rgba(255,255,255,0.05);
}
.badge{
    padding:6px 10px;
    border-radius:8px;
    font-size:12px;
}
.badge.green{
    background:rgba(76,175,80,0.2);
    color:#4caf50;
}
.badge.red{
    background:rgba(255,107,107,0.2);
    color:#ff6b6b;
}
.download-link{
    color:var(--accent);
    font-weight:600;
    text-decoration:none;
}
.download-link:hover{text-decoration:underline}
</style>
</head>
<body>

<div class="container">
    <header>
        <div class="logo">📑 Data Member Beasiswa</div>
        <a class="btn" href="logout.php">Logout</a>
    </header>

    <h2>Daftar Member Terdaftar</h2>
    <p>Berikut adalah data member yang telah mendaftar beasiswa.</p>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Peserta</th>
            <th>Tgl Lahir</th>
            <th>Nilai Rata</th>
            <th>Status Berkas</th>
            <th>File</th>
            <th>Waktu Daftar</th>
        </tr>

        <?php
        $no = 1;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $status = $row['status_berkas'] == 1 
                    ? "<span class='badge green'>Lengkap</span>" 
                    : "<span class='badge red'>Belum Lengkap</span>";

                echo "
                <tr>
                    <td>{$no}</td>
                    <td>{$row['peserta']}</td>
                    <td>{$row['tgl_lahir']}</td>
                    <td>{$row['nilai_rata']}</td>
                    <td>{$status}</td>
                    <td><a class='download-link' href='upload_member/{$row['file_berkas']}' target='_blank'>Download</a></td>
                    <td>{$row['waktu_daftar']}</td>
                </tr>
                ";
                $no++;
            }
        } else {
            echo "<tr><td colspan='7' style='text-align:center;color:#ccc'>Belum ada data member.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

