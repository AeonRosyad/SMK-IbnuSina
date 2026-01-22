<?php
session_start();
include '../config/koneksi.php';

// Proteksi Halaman
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Proses Simpan Data
if (isset($_POST['simpan'])) {
    $id_jurusan = mysqli_real_escape_string($koneksi, $_POST['id_jurusan']);
    $siswa_l    = mysqli_real_escape_string($koneksi, $_POST['siswa_l']);
    $siswa_p    = mysqli_real_escape_string($koneksi, $_POST['siswa_p']);

    // Cek apakah data statistik untuk jurusan tersebut sudah ada
    $cek = mysqli_query($koneksi, "SELECT * FROM statistik_siswa WHERE id_jurusan = '$id_jurusan'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Data statistik untuk jurusan ini sudah ada! Gunakan menu edit.'); window.location.href='kelola-siswa.php';</script>";
    } else {
        $query = "INSERT INTO statistik_siswa (id_jurusan, siswa_l, siswa_p) VALUES ('$id_jurusan', '$siswa_l', '$siswa_p')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Data siswa berhasil ditambahkan!'); window.location.href='kelola-siswa.php';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Siswa - SMK IBNU SINA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="kelola-siswa.php" class="text-success text-decoration-none">Data Peserta Didik</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data</li>
                </ol>
            </nav>
            <h2 class="fw-900 text-dark">Tambah Statistik Siswa Baru</h2>
            <p class="text-secondary">Inisialisasi jumlah siswa untuk jurusan yang tersedia.</p>
        </header>

        <div class="row">
            <div class="col-lg-8">
                <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                    <form action="" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Pilih Jurusan</label>
                            <select name="id_jurusan" class="form-select form-control-modern p-3" required>
                                <option value="">-- Pilih Jurusan --</option>
                                <?php
                                $query_jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
                                while($j = mysqli_fetch_assoc($query_jurusan)) {
                                    echo "<option value='".$j['id']."'>".$j['nama_jurusan']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-gender-male text-primary me-2"></i>Siswa Laki-laki</label>
                                <input type="number" name="siswa_l" class="form-control-modern p-3" placeholder="0" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-gender-female text-danger me-2"></i>Siswa Perempuan</label>
                                <input type="number" name="siswa_p" class="form-control-modern p-3" placeholder="0" required>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" name="simpan" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow">
                                <i class="bi bi-plus-circle me-2"></i> Simpan Data
                            </button>
                            <a href="kelola-siswa.php" class="btn btn-light px-5 py-3 rounded-pill fw-bold">Batal</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 rounded-5 bg-white shadow-sm border-0 h-100">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-shield-check text-success me-2"></i> Validasi Otomatis</h5>
                    <p class="small text-muted">Sistem akan secara otomatis menjumlahkan input Laki-laki dan Perempuan untuk menampilkan <strong>Total Siswa</strong> di halaman depan.</p>
                    <hr>
                    <p class="small text-muted">Pastikan jurusan yang dipilih belum memiliki data statistik sebelumnya untuk menghindari duplikasi.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>