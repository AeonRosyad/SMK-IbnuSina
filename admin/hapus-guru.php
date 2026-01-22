<?php
session_start();
include '../config/koneksi.php';

// Proteksi Halaman
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Ambil info foto sebelum data dihapus
    $cek_foto = mysqli_query($koneksi, "SELECT foto FROM tenaga_pendidik WHERE id = '$id'");
    $data = mysqli_fetch_assoc($cek_foto);
    
    // Hapus file fisik foto jika ada
    if (!empty($data['foto'])) {
        $path = "../assets/img/guru/" . $data['foto'];
        if (file_exists($path)) {
            unlink($path);
        }
    }
    
    // Hapus data dari database
    $delete = mysqli_query($koneksi, "DELETE FROM tenaga_pendidik WHERE id = '$id'");
    
    if ($delete) {
        echo "<script>alert('Data personel berhasil dihapus!'); window.location.href='kelola-guru.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location.href='kelola-guru.php';</script>";
    }
}
?>