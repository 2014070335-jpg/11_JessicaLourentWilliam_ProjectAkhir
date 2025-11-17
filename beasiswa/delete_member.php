<?php
// KONEKSI KE DATABASE
$host = "localhost";
$user = "root";
$pass = "mysql";
$db   = "beasiswa"; // ganti sesuai DB kamu

$conn = mysqli_connect($host, $user, $pass, $db);

// CEK KONEKSI
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// CEK APAKAH ADA ID YANG DIKIRIM
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // QUERY DELETE
    $query = "DELETE FROM member WHERE id = '$id'"; 
    $result = mysqli_query($conn, $query);

    // JIKA BERHASIL
    if ($result) {
        echo "
        <script>
            alert('Data berhasil dihapus!');
            window.location.href = 'datamember.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Gagal menghapus data!');
            window.location.href = 'datamember.php';
        </script>
        ";
    }
} else {
    // JIKA ID TIDAK ADA, LANGSUNG BALIK
    header("Location: datamember.php");
    exit;
}
?>
