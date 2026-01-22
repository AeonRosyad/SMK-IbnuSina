<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Cari data gambar dulu
    $query = mysqli_query($koneksi, "SELECT gambar FROM konten WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);
    
    // Hapus file gambar di folder jika ada
    if (!empty($data['gambar'])) {
        $path = "../assets/img/berita/" . $data['gambar'];
        if (file_exists($path)) {
            unlink($path);
        }
    }
    
    // Hapus data dari database
    $delete = mysqli_query($koneksi, "DELETE FROM konten WHERE id = '$id'");
    
    if ($delete) {
        echo "<script>alert('Berita berhasil dihapus!'); window.location.href='kelola-berita.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus berita.'); window.location.href='kelola-berita.php';</script>";
    }
}
?>