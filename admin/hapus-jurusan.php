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

    // CEK VALIDASI: Apakah jurusan masih digunakan di tabel lain?
    $cek_siswa = mysqli_query($koneksi, "SELECT id FROM statistik_siswa WHERE id_jurusan = '$id'");
    $cek_alumni = mysqli_query($koneksi, "SELECT id FROM alumni WHERE jurusan_id = '$id'");

    if (mysqli_num_rows($cek_siswa) > 0 || mysqli_num_rows($cek_alumni) > 0) {
        // Jika masih ada keterkaitan data, cegah penghapusan
        echo "<script>alert('Gagal! Jurusan ini tidak bisa dihapus karena masih memiliki data siswa atau alumni aktif. Silakan hapus data terkait terlebih dahulu.'); window.location.href='kelola-jurusan.php';</script>";
    } else {
        // Proses hapus jika aman
        $delete = mysqli_query($koneksi, "DELETE FROM jurusan WHERE id = '$id'");
        
        if ($delete) {
            echo "<script>alert('Jurusan berhasil dihapus secara permanen!'); window.location.href='kelola-jurusan.php';</script>";
        } else {
            echo "<script>alert('Terjadi kesalahan sistem saat menghapus data.'); window.location.href='kelola-jurusan.php';</script>";
        }
    }
}
?>