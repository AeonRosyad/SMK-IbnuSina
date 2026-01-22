<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nip      = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $jabatan  = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $kategori = $_POST['kategori'];

    $foto_nama = "";
    if (!empty($_FILES['foto']['name'])) {
        $foto_nama = time() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../assets/img/guru/" . $foto_nama);
    }

    $query = "INSERT INTO tenaga_pendidik (nama, nip, jabatan, kategori, foto) VALUES ('$nama', '$nip', '$jabatan', '$kategori', '$foto_nama')";
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data personel berhasil ditambahkan!'); window.location.href='kelola-guru.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Personel - SMK IBNU SINA</title>
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
            <h2 class="fw-900 text-dark">Tambah Personel Baru</h2>
            <p class="text-secondary">Input data Guru atau Staf Kependidikan.</p>
        </header>

        <div class="row">
            <div class="col-lg-8">
                <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Lengkap & Gelar</label>
                            <input type="text" name="nama" class="form-control-modern w-100 p-3" placeholder="Contoh: Baitiyah, S.Pd" required>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">NIP (Opsional)</label>
                                <input type="text" name="nip" class="form-control-modern w-100 p-3" placeholder="19XXXXXXXX XXXXXX">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="kategori" class="form-select form-control-modern p-3" required>
                                    <option value="Guru">Guru</option>
                                    <option value="Staf TU">Staf Tata Usaha</option>
                                    <option value="Pimpinan">Kepala Sekolah / Pimpinan</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Jabatan / Mata Pelajaran</label>
                            <input type="text" name="jabatan" class="form-control-modern w-100 p-3" placeholder="Contoh: Guru Produktif TKJ" required>
                        </div>
                        <div class="mb-5">
                            <label class="form-label fw-bold">Foto Personel</label>
                            <input type="file" name="foto" class="form-control">
                        </div>
                        <button type="submit" name="simpan" class="btn btn-success px-5 py-3 rounded-pill fw-bold">Simpan Personel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>