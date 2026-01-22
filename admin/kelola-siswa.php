<?php
session_start();
include '../config/koneksi.php';

// Proteksi Halaman
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Query mengambil data statistik siswa bergabung dengan tabel jurusan
$query = mysqli_query($koneksi, "SELECT statistik_siswa.*, jurusan.nama_jurusan 
                                 FROM statistik_siswa 
                                 JOIN jurusan ON statistik_siswa.id_jurusan = jurusan.id");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Data Siswa - SMK IBNU SINA</title>
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
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-900 text-dark mb-1">Data Peserta Didik</h2>
                <p class="text-secondary fw-bold">Update statistik jumlah siswa per departemen.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="tambah-siswa.php" class="btn btn-success px-4 py-2 rounded-pill fw-bold shadow-sm">
                    <i class="bi bi-plus-lg me-2"></i> Tambah Data
                </a>
            </div>
        </header>
        <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 px-4 py-3">Jurusan</th>
                            <th class="border-0 py-3 text-center">Laki-laki</th>
                            <th class="border-0 py-3 text-center">Perempuan</th>
                            <th class="border-0 py-3 text-center">Total Siswa</th>
                            <th class="border-0 py-3 text-end px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td class="px-4">
                                <span class="fw-bold text-dark"><?php echo $row['nama_jurusan']; ?></span>
                            </td>
                            <td class="text-center fw-bold text-primary"><?php echo number_format($row['siswa_l']); ?></td>
                            <td class="text-center fw-bold text-danger"><?php echo number_format($row['siswa_p']); ?></td>
                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-900">
                                    <?php echo number_format($row['total_siswa']); ?>
                                </span>
                            </td>
                            <td class="text-end px-4">
                                <a href="edit-siswa.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-success rounded-3 px-3">
                                    <i class="bi bi-pencil-fill me-2"></i>Edit Angka
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-4 p-4 rounded-4 bg-white shadow-sm border-start border-success border-4">
            <p class="mb-0 small text-secondary">
                <i class="bi bi-lightbulb-fill text-warning me-2"></i>
                <strong>Catatan:</strong> Angka yang Anda masukkan di sini akan langsung tampil pada grafik dan ringkasan di halaman beranda utama.
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>