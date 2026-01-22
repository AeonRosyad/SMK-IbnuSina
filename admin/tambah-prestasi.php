<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $judul    = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $tahun    = mysqli_real_escape_string($koneksi, $_POST['tahun']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $tingkat  = mysqli_real_escape_string($koneksi, $_POST['tingkat']);

    // Logika penentuan warna otomatis berdasarkan kategori
    switch ($kategori) {
        case 'Akademik': $bg = '#dcfce7'; $tx = '#166534'; break;
        case 'Institusi': $bg = '#fef3c7'; $tx = '#92400e'; break;
        case 'Non-Akademik': $bg = '#f1f5f9'; $tx = '#475569'; break;
        case 'Kejuruan': $bg = '#ecfdf5'; $tx = '#065f46'; break;
        default: $bg = '#f0fdf4'; $tx = '#166534';
    }

    $insert = mysqli_query($koneksi, "INSERT INTO prestasi (judul, tahun, kategori, tingkat, warna_bg, warna_teks) 
              VALUES ('$judul', '$tahun', '$kategori', '$tingkat', '$bg', '$tx')");
    
    if ($insert) {
        echo "<script>alert('Prestasi berhasil dicatat!'); window.location.href='kelola-prestasi.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Prestasi - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
<body class="bg-light p-5">
    <div class="container" style="max-width: 700px;">
        <div class="card p-5 border-0 shadow-sm rounded-5">
            <h3 class="fw-bold mb-4"><i class="bi bi-award text-success me-2"></i>Tambah Penghargaan</h3>
            <form action="" method="POST">
                <div class="row g-3">
                    <div class="col-md-9 mb-3">
                        <label class="form-label fw-bold">Judul Prestasi</label>
                        <input type="text" name="judul" class="form-control p-3 rounded-3" placeholder="Contoh: Juara 1 LKS Nasional" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-bold">Tahun</label>
                        <input type="number" name="tahun" class="form-control p-3 rounded-3" value="2026" required>
                    </div>
                </div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Kategori</label>
                        <select name="kategori" class="form-select p-3 rounded-3">
                            <option value="Akademik">Akademik</option>
                            <option value="Non-Akademik">Non-Akademik</option>
                            <option value="Kejuruan">Kejuruan</option>
                            <option value="Institusi">Institusi</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tingkat</label>
                        <select name="tingkat" class="form-select p-3 rounded-3">
                            <option value="Internasional">Internasional</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Kabupaten">Kabupaten</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="simpan" class="btn btn-success w-100 py-3 rounded-pill fw-bold shadow">Simpan Prestasi</button>
                <a href="kelola-prestasi.php" class="btn btn-light w-100 mt-2 py-3 rounded-pill fw-bold">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>