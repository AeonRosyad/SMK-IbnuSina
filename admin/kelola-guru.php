<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$query = mysqli_query($koneksi, "SELECT * FROM tenaga_pendidik ORDER BY kategori ASC, nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Guru & Staf - SMK IBNU SINA</title>
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
                <h2 class="fw-900 text-dark mb-1">Tenaga Pendidik & Kependidikan</h2>
                <p class="text-secondary fw-bold">Manajemen data Guru dan Staf Tata Usaha.</p>
            </div>
            <a href="tambah-guru.php" class="btn btn-success px-4 py-2 rounded-pill fw-bold shadow-sm">
                <i class="bi bi-person-plus-fill me-2"></i> Tambah Personel
            </a>
        </header>

        <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 px-4 py-3">Nama & NIP</th>
                            <th class="border-0 py-3">Jabatan</th>
                            <th class="border-0 py-3">Kategori</th>
                            <th class="border-0 py-3 text-center">Status</th>
                            <th class="border-0 py-3 text-end px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($query)) : 
                            $foto = (!empty($row['foto'])) ? "../assets/img/guru/".$row['foto'] : "https://ui-avatars.com/api/?name=".urlencode($row['nama'])."&background=064e3b&color=fff";
                        ?>
                        <tr>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="<?php echo $foto; ?>" class="rounded-circle object-fit-cover" style="width: 45px; height: 45px;">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0"><?php echo $row['nama']; ?></h6>
                                        <small class="text-muted">NIP: <?php echo $row['nip'] ?: '-'; ?></small>
                                    </div>
                                </div>
                            </td>
                            <td><span class="fw-bold"><?php echo $row['jabatan']; ?></span></td>
                            <td><span class="badge bg-light text-dark border rounded-pill px-3"><?php echo $row['kategori']; ?></span></td>
                            <td class="text-center">
                                <span class="badge <?php echo ($row['status_aktif'] == 'Aktif') ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'; ?> rounded-pill px-3">
                                    <?php echo $row['status_aktif']; ?>
                                </span>
                            </td>
                            <td class="text-end px-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="edit-guru.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-light text-primary rounded-3"><i class="bi bi-pencil-fill"></i></a>
                                    <a href="hapus-guru.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-light text-danger rounded-3" onclick="return confirm('Hapus data personel ini?')"><i class="bi bi-trash-fill"></i></a>
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