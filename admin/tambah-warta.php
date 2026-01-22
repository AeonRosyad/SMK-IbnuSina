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
    $judul      = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $prioritas  = $_POST['prioritas'];
    $status     = $_POST['status'];
    $tanggal    = $_POST['tanggal_tampil'];

    $query = "INSERT INTO pengumuman (judul, prioritas, status, tanggal_tampil) 
              VALUES ('$judul', '$prioritas', '$status', '$tanggal')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Warta berhasil ditambahkan!'); window.location.href='kelola-warta.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Warta - SMK IBNU SINA</title>
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
                    <li class="breadcrumb-item"><a href="kelola-warta.php" class="text-success text-decoration-none">Kelola Warta</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </nav>
            <h2 class="fw-900 text-dark">Buat Pengumuman Baru</h2>
            <p class="text-secondary">Informasikan agenda atau berita sekolah kepada wali murid.</p>
        </header>

        <div class="row">
            <div class="col-lg-8">
                <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                    <form action="" method="POST">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Judul Pengumuman</label>
                            <input type="text" name="judul" class="form-control-modern w-100 p-3" placeholder="Contoh: Rapat Wali Murid Semester Ganjil" required>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Prioritas</label>
                                <select name="prioritas" class="form-select form-control-modern p-3" required>
                                    <option value="Normal">Normal (Hijau)</option>
                                    <option value="Penting">Penting (Kuning)</option>
                                    <option value="Mendesak">Mendesak (Merah)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Tanggal Tampil</label>
                                <input type="date" name="tanggal_tampil" class="form-control-modern p-3" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold text-dark">Status Publikasi</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="aktif" value="Aktif" checked>
                                    <label class="form-check-label" for="aktif">Tampilkan Sekarang</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="arsip" value="Arsip">
                                    <label class="form-check-label" for="arsip">Simpan sebagai Arsip</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" name="simpan" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow">
                                <i class="bi bi-check-circle me-2"></i> Simpan Warta
                            </button>
                            <a href="kelola-warta.php" class="btn btn-light px-5 py-3 rounded-pill fw-bold">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="p-4 rounded-5 bg-success-subtle border-0">
                    <h5 class="fw-bold text-success mb-3"><i class="bi bi-lightbulb me-2"></i> Tips Admin</h5>
                    <p class="small text-dark opacity-75">Gunakan prioritas <strong>Mendesak</strong> hanya untuk pengumuman yang memerlukan tindakan cepat dari wali murid, seperti jadwal ujian atau libur mendadak.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>