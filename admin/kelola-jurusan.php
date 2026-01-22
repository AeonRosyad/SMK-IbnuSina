<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Query mengambil semua data jurusan
$query = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Jurusan - SMK IBNU SINA</title>
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
                <h2 class="fw-900 text-dark mb-1">Program Keahlian</h2>
                <p class="text-secondary fw-bold">Manajemen program studi dan kurikulum industri.</p>
            </div>
            <a href="tambah-jurusan.php" class="btn btn-success px-4 py-2 rounded-pill fw-bold shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Tambah Jurusan
            </a>
        </header>

        <div class="row g-4">
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <div class="col-md-6 col-xl-4">
                <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-4 h-100 position-relative">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="bg-success-subtle text-success p-3 rounded-3">
                            <i class="bi bi-mortarboard-fill fs-4"></i>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm rounded-circle" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                <li><a class="dropdown-item" href="edit-jurusan.php?id=<?php echo $row['id']; ?>"><i class="bi bi-pencil me-2"></i> Edit</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="hapus-jurusan.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Hapus jurusan ini?')"><i class="bi bi-trash me-2"></i> Hapus</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <h5 class="fw-800 text-dark mb-2"><?php echo $row['nama_jurusan']; ?></h5>
                    <p class="small text-secondary mb-3"><?php echo substr($row['deskripsi'], 0, 100); ?>...</p>
                    
                    <div class="d-flex align-items-center gap-2 mt-auto">
                        <?php if($row['status'] == 'Aktif'): ?>
                            <span class="badge bg-success-subtle text-success rounded-pill px-3">Aktif</span>
                        <?php else: ?>
                            <span class="badge bg-secondary-subtle text-secondary rounded-pill px-3">Non-Aktif</span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>