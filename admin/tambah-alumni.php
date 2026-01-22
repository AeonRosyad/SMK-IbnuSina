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
    $nama           = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email          = mysqli_real_escape_string($koneksi, $_POST['email']);
    $jurusan_id     = mysqli_real_escape_string($koneksi, $_POST['jurusan_id']);
    $tahun_lulus    = mysqli_real_escape_string($koneksi, $_POST['tahun_lulus']);
    $status_kerja   = mysqli_real_escape_string($koneksi, $_POST['status_kerja']);
    $testimoni      = mysqli_real_escape_string($koneksi, $_POST['testimoni']);

    // Logika Upload Foto
    $foto = "";
    if (!empty($_FILES['foto']['name'])) {
        $nama_file = time() . "_" . $_FILES['foto']['name'];
        $sumber    = $_FILES['foto']['tmp_name'];
        $folder    = "../assets/img/alumni/";
        
        if (move_uploaded_file($sumber, $folder . $nama_file)) {
            $foto = $nama_file;
        }
    }

    $query = "INSERT INTO alumni (nama, email, jurusan_id, tahun_lulus, status_kerja, testimoni, foto) 
              VALUES ('$nama', '$email', '$jurusan_id', '$tahun_lulus', '$status_kerja', '$testimoni', '$foto')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data alumni berhasil ditambahkan!'); window.location.href='kelola-alumni.php';</script>";
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
    <title>Tambah Alumni - SMK IBNU SINA</title>
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
                    <li class="breadcrumb-item"><a href="kelola-alumni.php" class="text-success text-decoration-none">Database Alumni</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Alumni</li>
                </ol>
            </nav>
            <h2 class="fw-900 text-dark">Tambah Data Lulusan</h2>
            <p class="text-secondary">Input manual data alumni untuk database Tracer Study.</p>
        </header>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Nama Lengkap Alumni</label>
                            <input type="text" name="nama" class="form-control-modern w-100 p-3" placeholder="Masukkan nama sesuai ijazah" required>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Email Aktif</label>
                                <input type="email" name="email" class="form-control-modern w-100 p-3" placeholder="contoh@mail.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Tahun Lulus</label>
                                <input type="number" name="tahun_lulus" class="form-control-modern w-100 p-3" value="<?php echo date('Y'); ?>" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Program Keahlian</label>
                                <select name="jurusan_id" class="form-select form-control-modern p-3" required>
                                    <option value="">-- Pilih Jurusan --</option>
                                    <?php
                                    $jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan ORDER BY nama_jurusan ASC");
                                    while($j = mysqli_fetch_assoc($jurusan)) {
                                        echo "<option value='".$j['id']."'>".$j['nama_jurusan']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Status Kesibukan</label>
                                <select name="status_kerja" class="form-select form-control-modern p-3" required>
                                    <option value="Bekerja">Bekerja</option>
                                    <option value="Kuliah">Kuliah / Studi Lanjut</option>
                                    <option value="Wirausaha">Wirausaha / Mandiri</option>
                                    <option value="Mencari Kerja">Mencari Kerja</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold text-dark">Testimoni Singkat</label>
                            <textarea name="testimoni" class="form-control-modern w-100 p-3" rows="4" placeholder="Ceritakan singkat pengalaman kerja atau kesan selama sekolah..."></textarea>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" name="simpan" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow">
                                <i class="bi bi-save me-2"></i> Simpan Alumni
                            </button>
                            <a href="kelola-alumni.php" class="btn btn-light px-5 py-3 rounded-pill fw-bold">Batal</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-5 text-center">
                        <label class="form-label fw-bold text-dark mb-3">Foto Alumni</label>
                        <div class="bg-light rounded-4 p-5 mb-3 border-2 border-dashed border-success-subtle">
                            <i class="bi bi-person-bounding-box display-4 text-success opacity-25"></i>
                        </div>
                        <input type="file" name="foto" class="form-control form-control-sm border-0 bg-light p-2 rounded-3">
                        <p class="small text-muted mt-3">Rekomendasi ukuran: <strong>400 x 400 px</strong> (Square) dengan format JPG/PNG.</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>