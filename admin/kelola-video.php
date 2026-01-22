<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM video ORDER BY tanggal_upload DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Video - SMK IBNU SINA</title>
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
<div class="wrapper d-flex">
    <?php include 'sidebar.php'; ?>
    <div id="content" class="p-5 w-100">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-900 text-dark">Manajemen Video</h2>
                <p class="text-secondary fw-bold">Kelola tautan video profil dan dokumentasi kegiatan.</p>
            </div>
            <a href="tambah-video.php" class="btn btn-success px-4 py-2 rounded-pill fw-bold shadow-sm">
                <i class="bi bi-link-45deg me-2"></i> Tambah Video URL
            </a>
        </header>

        <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 px-4 py-3">Judul Video</th>
                            <th class="border-0 py-3">Source URL</th>
                            <th class="border-0 py-3 text-end px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                        <tr>
                            <td class="px-4"><h6 class="fw-bold text-dark mb-0"><?php echo $row['judul']; ?></h6></td>
                            <td class="text-primary small"><?php echo $row['url_video']; ?></td>
                            <td class="text-end px-4">
                                <a href="hapus-video.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-light rounded-3 text-danger" onclick="return confirm('Hapus link video ini?')">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>