<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Ambil info foto sebelum dihapus
    $query = mysqli_query($koneksi, "SELECT foto FROM alumni WHERE id = '$id'");
    $data = mysqli_fetch_assoc($query);
    
    // Hapus file fisik jika ada
    if (!empty($data['foto'])) {
        $path = "../assets/img/alumni/" . $data['foto'];
        if (file_exists($path)) {
            unlink($path);
        }
    }
    
    // Hapus dari database
    $delete = mysqli_query($koneksi, "DELETE FROM alumni WHERE id = '$id'");
    
    if ($delete) {
        echo "<script>alert('Data alumni berhasil dihapus!'); window.location.href='kelola-alumni.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location.href='kelola-alumni.php';</script>";
    }
}
?>