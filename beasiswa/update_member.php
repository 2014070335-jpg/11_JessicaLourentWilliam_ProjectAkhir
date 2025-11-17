<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "koneksi.php";

// Proteksi login
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id            = $_POST['id'];
    $peserta       = $_POST['peserta'];
    $tgl_lahir     = $_POST['tgl_lahir'];
    $nama_sekolah  = $_POST['nama_sekolah'];
    $nilai_rata    = $_POST['nilai_rata'];
    $status_berkas = $_POST['status_berkas'];

    $query = "
        UPDATE member SET
            peserta='$peserta',
            tgl_lahir='$tgl_lahir',
            nama_sekolah='$nama_sekolah',
            nilai_rata='$nilai_rata',
            status_berkas='$status_berkas'
        WHERE id='$id'
    ";

    if (mysqli_query($koneksi, $query)) {
        header("Location: datamember.php");
        exit;
    } else {
        echo "Query error: " . mysqli_error($koneksi);
    }
}
?>

