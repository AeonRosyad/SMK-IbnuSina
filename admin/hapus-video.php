<?php
session_start();
include '../config/koneksi.php';

// Proteksi Halaman: Pastikan hanya admin yang bisa menghapus
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Menangkap ID video dari URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Eksekusi query hapus
    $query_hapus = mysqli_query($koneksi, "DELETE FROM video WHERE id = '$id'");

    if ($query_hapus) {
        // Jika berhasil, kembali ke halaman kelola dengan pesan sukses
        echo "<script>
                alert('Tautan video berhasil dihapus!');
                window.location.href='kelola-video.php';
              </script>";
    } else {
        // Jika gagal, tampilkan pesan error database
        echo "<script>
                alert('Gagal menghapus video: " . mysqli_error($koneksi) . "');
                window.location.href='kelola-video.php';
              </script>";
    }
} else {
    // Jika ID tidak ditemukan di URL, arahkan kembali
    header("Location: kelola-video.php");
    exit();
}
?>