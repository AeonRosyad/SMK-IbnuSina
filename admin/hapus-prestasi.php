<?php
session_start();
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    mysqli_query($koneksi, "DELETE FROM prestasi WHERE id = '$id'");
    header("Location: kelola-prestasi.php");
}
?>