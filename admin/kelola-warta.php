<?php
session_start();
include '../config/koneksi.php';

// Proteksi Halaman
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Query mengambil data pengumuman
$query = mysqli_query($koneksi, "SELECT * FROM pengumuman ORDER BY tanggal_tampil DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Warta - SMK IBNU SINA</title>
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
                <h2 class="fw-900 text-dark mb-1">Manajemen Warta</h2>
                <p class="text-secondary fw-bold">Kelola pengumuman dan informasi sekolah.</p>
            </div>
            <a href="tambah-warta.php" class="btn btn-success px-4 py-2 rounded-pill fw-bold shadow-sm">
                <i class="bi bi-plus-lg me-2"></i> Tambah Baru
            </a>
        </header>

        <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 px-4 py-3">Tanggal</th>
                            <th class="border-0 py-3">Judul Pengumuman</th>
                            <th class="border-0 py-3 text-center">Prioritas</th>
                            <th class="border-0 py-3 text-center">Status</th>
                            <th class="border-0 py-3 text-end px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($query)) : 
                            // Warna Badge Prioritas
                            $p_class = ($row['prioritas'] == 'Mendesak') ? 'bg-danger' : (($row['prioritas'] == 'Penting') ? 'bg-warning' : 'bg-success');
                        ?>
                        <tr>
                            <td class="px-4 small fw-bold text-secondary">
                                <?php echo date('d M Y', strtotime($row['tanggal_tampil'])); ?>
                            </td>
                            <td>
                                <h6 class="fw-bold text-dark mb-0"><?php echo $row['judul']; ?></h6>
                            </td>
                            <td class="text-center">
                                <span class="badge <?php echo $p_class; ?> rounded-pill px-3 py-2 small">
                                    <?php echo $row['prioritas']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border rounded-pill px-3 py-2 small">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td class="text-end px-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="edit-warta.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary border-0 rounded-3">
                                        <i class="bi bi-pencil-square fs-5"></i>
                                    </a>
                                    <a href="hapus-warta.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger border-0 rounded-3" onclick="return confirm('Hapus pengumuman ini?')">
                                        <i class="bi bi-trash3 fs-5"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>