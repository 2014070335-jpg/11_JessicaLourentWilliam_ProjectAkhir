<?php
session_start();
include "koneksi.php";

// Proteksi: hanya admin
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Pastikan ada ID
if (!isset($_GET['id'])) {
    header("Location: data_member.php");
    exit;
}

$id = $_GET['id'];

// Ambil data member berdasarkan ID
$query = $koneksi->query("SELECT * FROM member WHERE id='$id'");
$data  = $query->fetch_assoc();

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Member</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>
body{
    font-family:'Poppins',sans-serif;
    background:linear-gradient(135deg,#071129,#0f2949);
    color:white;
    padding:30px;
}
.container{
    max-width:550px;
    margin:auto;
    background:rgba(255,255,255,0.05);
    padding:25px;
    border-radius:12px;
    border:1px solid rgba(255,255,255,0.1);
}
input,select{
    width:100%;
    padding:10px;
    margin-top:6px;
    margin-bottom:15px;
    border:none;
    border-radius:8px;
}
.btn{
    padding:12px 16px;
    background:linear-gradient(90deg,#ff7a59,#ffb085);
    border:none;
    border-radius:10px;
    color:#082033;
    font-weight:600;
    cursor:pointer;
}
a{
    color:#ffb085;
}
</style>
</head>

<body>
<div class="container">
    <h2>Edit Data Member</h2>

    <form action="update_member.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $data['id'] ?>">

        <label>Nama Peserta</label>
        <input type="text" name="peserta" value="<?= $data['peserta'] ?>" required>

        <label>Tanggal Lahir</label>
        <input type="date" name="tgl_lahir" value="<?= $data['tgl_lahir'] ?>" required>

        <label>Nama Sekolah</label>
        <input type="text" name="nama_sekolah" value="<?= $data['nama_sekolah'] ?>" required>

        <label>Nilai Rata-Rata</label>
        <input type="number" step="0.01" name="nilai_rata" value="<?= $data['nilai_rata'] ?>" required>

        <label>Status Berkas</label>
        <select name="status_berkas">
            <option value="1" <?= $data['status_berkas']==1?'selected':'' ?>>Lengkap</option>
            <option value="0" <?= $data['status_berkas']==0?'selected':'' ?>>Belum Lengkap</option>
        </select>

        <label>File Berkas (biarkan kosong jika tidak ganti)</label>
        <input type="file" name="file_berkas">

        <p>File saat ini: <b><?= $data['file_berkas'] ?></b></p>

        <button class="btn" type="submit">Simpan Perubahan</button>
    </form>

    <br>
    <a href="data_member.php">⬅ Kembali</a>
</div>
</body>
</html>

