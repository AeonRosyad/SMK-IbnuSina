<?php
session_start();
include '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Membersihkan input dari potensi SQL Injection
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Query mencari user dengan username dan password teks biasa
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $query = mysqli_query($koneksi, $sql);
    $user = mysqli_fetch_assoc($query);

    if ($user) {
        // Jika data cocok, buat session
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_name'] = $user['nama'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika salah, tampilkan pesan peringatan
        echo "<script>alert('Username atau Password salah!'); window.location.href='login.php';</script>";
    }
}
?>