<?php
session_start();
include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM galeri WHERE id = '$id'"));

if ($data) {
    // Hapus file fisik di folder galeri
    unlink("../assets/img/galeri/" . $data['foto']);
    // Hapus data di database
    mysqli_query($koneksi, "DELETE FROM galeri WHERE id = '$id'");
    header("Location: kelola-galeri.php");
}
?>