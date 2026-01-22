<?php
session_start();
include '../config/koneksi.php';

// Cek sesi login admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data ringkasan statistik
$total_siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(total_siswa) as total FROM statistik_siswa"))['total'] ?? 0;
$total_alumni = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM alumni"))['total'] ?? 0;
$pengumuman_aktif = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM pengumuman WHERE status='Aktif'"))['total'] ?? 0;
$total_jurusan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM jurusan WHERE status='Aktif'"))['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SMK IBNU SINA</title>
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
<body>

<div class="wrapper bg-light">
    <?php include 'sidebar.php'; ?>

    <div id="content">
        <header class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5">
            <div>
                <h1 class="fw-900 text-dark ls-1 mb-1" style="font-size: 2.5rem;">Halo, <?php echo $_SESSION['admin_name']; ?>!</h1>
                <p class="text-secondary fw-bold">Berikut adalah ikhtisar perkembangan sekolah hari ini.</p>
            </div>
            <div class="bg-white p-3 px-4 rounded-pill shadow-sm d-flex align-items-center gap-3">
                <div class="bg-success text-white rounded-circle p-2 d-flex"><i class="bi bi-calendar-check"></i></div>
                <span class="fw-bold text-dark"><?php echo date('l, d M Y'); ?></span>
            </div>
        </header>

        <div class="row g-4 mb-5">
            <?php
            $stats_data = [
                ['label' => 'Siswa Aktif', 'val' => $total_siswa, 'icon' => 'people', 'bg' => '#ecfdf5', 'color' => '#10b981'],
                ['label' => 'Total Alumni', 'val' => $total_alumni, 'icon' => 'mortarboard', 'bg' => '#eff6ff', 'color' => '#3b82f6'],
                ['label' => 'Warta Aktif', 'val' => $pengumuman_aktif, 'icon' => 'megaphone', 'bg' => '#fffbeb', 'color' => '#f59e0b'],
                ['label' => 'Jurusan', 'val' => $total_jurusan, 'icon' => 'grid-1x2', 'bg' => '#f5f3ff', 'color' => '#8b5cf6']
            ];
            foreach ($stats_data as $s) : ?>
            <div class="col-xl-3 col-md-6">
                <div class="bento-stat-card shadow-sm border-0">
                    <div class="icon-box-premium" style="background: <?php echo $s['bg']; ?>; color: <?php echo $s['color']; ?>;">
                        <i class="bi bi-<?php echo $s['icon']; ?>"></i>
                    </div>
                    <h2 class="fw-900 text-dark mb-1"><?php echo number_format($s['val']); ?></h2>
                    <p class="text-secondary fw-bold small mb-0 text-uppercase ls-1"><?php echo $s['label']; ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5 position-relative overflow-hidden">
            <div class="row align-items-center">
                <div class="col-lg-8 position-relative" style="z-index: 2;">
                    <h3 class="fw-900 text-dark mb-3">Manajemen Konten Cepat</h3>
                    <p class="text-secondary mb-4 fs-5">Perbarui informasi sekolah secara real-time untuk menjangkau wali murid dan alumni lebih efektif.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="tambah-warta.php" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow-lg transition-up">
                            <i class="bi bi-plus-lg me-2"></i> Buat Pengumuman
                        </a>
                        <a href="kelola-siswa.php" class="btn btn-outline-success px-5 py-3 rounded-pill fw-bold transition-up">
                            Data Siswa
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 d-none d-lg-block text-end opacity-10">
                    <i class="bi bi-shield-lock-fill" style="font-size: 10rem; color: #10b981;"></i>
                </div>
            </div>
        </div>
    </div>
</div>