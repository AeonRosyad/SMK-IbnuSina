<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Query yang sudah dilengkapi deteksi error
// Query untuk mengambil kategori berita, prestasi, dan artikel sekaligus
$query = mysqli_query($koneksi, "SELECT * FROM konten 
                                 WHERE kategori IN ('berita', 'prestasi', 'artikel') 
                                 ORDER BY tanggal_posting DESC") 
         or die(mysqli_error($koneksi));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Berita - SMK IBNU SINA</title>
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
                <h2 class="fw-900 text-dark mb-1">Berita & Artikel</h2>
                <p class="text-secondary fw-bold">Manajemen konten informasi publik sekolah.</p>
            </div>
            <a href="tambah-berita.php" class="btn btn-success px-4 py-2 rounded-pill fw-bold shadow-sm">
                <i class="bi bi-pencil-square me-2"></i> Tulis Berita
            </a>
        </header>

        <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 px-4 py-3">Gambar</th>
                            <th class="border-0 py-3">Judul Konten</th>
                            <th class="border-0 py-3">Kategori</th> <th class="border-0 py-3">Tanggal</th>
                            <th class="border-0 py-3 text-center">Status</th>
                            <th class="border-0 py-3 text-end px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($query)) : 
                            $img_path = "../assets/img/berita/" . $row['gambar'];
                            $tampil_img = (!empty($row['gambar']) && file_exists($img_path)) ? $img_path : "https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=200";
                            
                            // Warna badge kategori otomatis
                            $cat_bg = ($row['kategori'] == 'prestasi') ? 'bg-primary' : (($row['kategori'] == 'artikel') ? 'bg-info' : 'bg-success');
                        ?>
                        <tr>
                            <td class="px-4">
                                <img src="<?php echo $tampil_img; ?>" class="rounded-3 object-fit-cover" style="width: 80px; height: 50px;">
                            </td>
                            <td><h6 class="fw-bold text-dark mb-0"><?php echo substr($row['judul'], 0, 50); ?>...</h6></td>
                            <td>
                                <span class="badge <?php echo $cat_bg; ?> rounded-pill px-3 text-capitalize">
                                    <?php echo $row['kategori']; ?>
                                </span>
                            </td>
                            <td class="small text-muted"><?php echo date('d M Y', strtotime($row['tanggal_posting'])); ?></td>
                            <td class="text-center">
                                <span class="badge <?php echo ($row['status'] == 'Publish') ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary'; ?> rounded-pill px-3">
                                    <?php echo $row['status']; ?>
                                </span>
                            </td>
                            <td class="text-end px-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="edit-berita.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-light text-primary rounded-3 shadow-sm" title="Edit Konten">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <a href="hapus-berita.php?id=<?php echo $row['id']; ?>" 
                                    class="btn btn-sm btn-light text-danger rounded-3 shadow-sm" 
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini? Tindakan ini akan menghapus file gambar secara permanen.')" 
                                    title="Hapus Konten">
                                        <i class="bi bi-trash-fill"></i>
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