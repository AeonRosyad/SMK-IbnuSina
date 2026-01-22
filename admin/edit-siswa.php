<?php
session_start();
include '../config/koneksi.php';

// Proteksi Halaman
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil ID dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data lama untuk ditampilkan di form
$query_data = mysqli_query($koneksi, "SELECT statistik_siswa.*, jurusan.nama_jurusan 
                                      FROM statistik_siswa 
                                      JOIN jurusan ON statistik_siswa.id_jurusan = jurusan.id 
                                      WHERE statistik_siswa.id = '$id'");
$data = mysqli_fetch_assoc($query_data);

// Jika ID tidak ditemukan
if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='kelola-siswa.php';</script>";
    exit();
}

// Proses Update Data
if (isset($_POST['update'])) {
    $siswa_l = mysqli_real_escape_string($koneksi, $_POST['siswa_l']);
    $siswa_p = mysqli_real_escape_string($koneksi, $_POST['siswa_p']);

    $update = mysqli_query($koneksi, "UPDATE statistik_siswa SET 
                                      siswa_l = '$siswa_l', 
                                      siswa_p = '$siswa_p' 
                                      WHERE id = '$id'");

    if ($update) {
        echo "<script>alert('Statistik berhasil diperbarui!'); window.location.href='kelola-siswa.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Statistik Siswa - SMK IBNU SINA</title>
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
                    <li class="breadcrumb-item active" aria-current="page">Edit Angka</li>
                </ol>
            </nav>
            <h2 class="fw-900 text-dark">Update Angka Statistik</h2>
            <p class="text-secondary">Jurusan: <span class="text-success fw-bold"><?php echo $data['nama_jurusan']; ?></span></p>
        </header>

        <div class="row">
            <div class="col-lg-7">
                <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                    <form action="" method="POST">
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-gender-male text-primary me-2"></i>Siswa Laki-laki</label>
                                <input type="number" name="siswa_l" class="form-control-modern p-3 fs-5 fw-bold" 
                                       value="<?php echo $data['siswa_l']; ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark"><i class="bi bi-gender-female text-danger me-2"></i>Siswa Perempuan</label>
                                <input type="number" name="siswa_p" class="form-control-modern p-3 fs-5 fw-bold" 
                                       value="<?php echo $data['siswa_p']; ?>" required>
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <button type="submit" name="update" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                            <a href="kelola-siswa.php" class="btn btn-light px-5 py-3 rounded-pill fw-bold">Batal</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="p-5 rounded-5 bg-white shadow-sm text-center border-0 h-100 d-flex flex-column justify-content-center">
                    <div class="icon-box-premium mx-auto mb-4 bg-success-subtle text-success" style="width: 80px; height: 80px; border-radius: 25px; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                        <i class="bi bi-calculator"></i>
                    </div>
                    <h5 class="fw-900 text-dark">Total Saat Ini</h5>
                    <h1 class="display-4 fw-900 text-success mb-0"><?php echo number_format($data['total_siswa']); ?></h1>
                    <p class="text-secondary fw-bold mt-2">Siswa Terdaftar</p>
                    <hr class="my-4 opacity-10">
                    <p class="small text-muted px-4">Sistem akan otomatis menggabungkan angka Laki-laki dan Perempuan untuk kalkulasi total di halaman publik.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>