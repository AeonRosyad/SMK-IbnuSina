<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $nama      = mysqli_real_escape_string($koneksi, $_POST['nama_jurusan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $status    = $_POST['status'];

    $query = "INSERT INTO jurusan (nama_jurusan, deskripsi, status) VALUES ('$nama', '$deskripsi', '$status')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Jurusan berhasil ditambahkan!'); window.location.href='kelola-jurusan.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Jurusan - SMK IBNU SINA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* CSS ini memastikan Sidebar dan Content sejajar secara horizontal */
        .wrapper { display: flex; align-items: stretch; }
        #sidebar {
            min-width: 280px;
            max-width: 280px;
            background: #ffffff;
            height: 100vh;
            position: sticky;
            top: 0;
            border-right: 1px solid #e2e8f0;
            padding: 30px;
        }
        #content { width: 100%; padding: 40px; }
    </style>
</head>
<body class="bg-light">
<div class="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content">
        <header class="mb-5">
            <h2 class="fw-900 text-dark">Tambah Jurusan Baru</h2>
            <p class="text-secondary">Input data program keahlian baru sesuai kurikulum nasional.</p>
        </header>

        <div class="row">
            <div class="col-lg-8">
                <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                    <form action="" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Program Keahlian</label>
                            <input type="text" name="nama_jurusan" class="form-control-modern w-100 p-3" placeholder="Contoh: Teknik Komputer dan Jaringan" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control-modern w-100 p-3" rows="4" placeholder="Jelaskan fokus keahlian jurusan ini..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Status Jurusan</label>
                            <select name="status" class="form-select form-control-modern p-3">
                                <option value="Aktif">Aktif (Tampil di PPDB)</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" name="simpan" class="btn btn-success px-5 py-3 rounded-pill fw-bold">Simpan Jurusan</button>
                            <a href="kelola-jurusan.php" class="btn btn-light px-5 py-3 rounded-pill fw-bold">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>