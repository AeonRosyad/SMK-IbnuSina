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
$query_data = mysqli_query($koneksi, "SELECT * FROM tenaga_pendidik WHERE id = '$id'");
$data = mysqli_fetch_assoc($query_data);

// Jika ID tidak ditemukan
if (!$data) {
    echo "<script>alert('Data personel tidak ditemukan!'); window.location.href='kelola-guru.php';</script>";
    exit();
}

// Proses Update Data
if (isset($_POST['update'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $nip      = mysqli_real_escape_string($koneksi, $_POST['nip']);
    $jabatan  = mysqli_real_escape_string($koneksi, $_POST['jabatan']);
    $kategori = $_POST['kategori'];
    $status   = $_POST['status_aktif'];

    $foto_nama = $data['foto']; 
    if (!empty($_FILES['foto']['name'])) {
        $nama_file = time() . "_" . $_FILES['foto']['name'];
        $sumber    = $_FILES['foto']['tmp_name'];
        $folder    = "../assets/img/guru/";
        
        if (move_uploaded_file($sumber, $folder . $nama_file)) {
            // Hapus foto lama jika ada file fisiknya
            if (!empty($data['foto']) && file_exists($folder . $data['foto'])) {
                unlink($folder . $data['foto']);
            }
            $foto_nama = $nama_file;
        }
    }

    $update = mysqli_query($koneksi, "UPDATE tenaga_pendidik SET 
                                      nama = '$nama', 
                                      nip = '$nip', 
                                      jabatan = '$jabatan', 
                                      kategori = '$kategori', 
                                      foto = '$foto_nama',
                                      status_aktif = '$status' 
                                      WHERE id = '$id'");

    if ($update) {
        echo "<script>alert('Profil personel berhasil diperbarui!'); window.location.href='kelola-guru.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Personel - SMK IBNU SINA</title>
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
                    <li class="breadcrumb-item"><a href="kelola-guru.php" class="text-success text-decoration-none">Tenaga Pendidik</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                </ol>
            </nav>
            <h2 class="fw-900 text-dark">Edit Data Personel</h2>
            <p class="text-secondary">Perbarui informasi profil profesional staf sekolah.</p>
        </header>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Lengkap & Gelar</label>
                            <input type="text" name="nama" class="form-control-modern w-100 p-3" value="<?php echo $data['nama']; ?>" required>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">NIP</label>
                                <input type="text" name="nip" class="form-control-modern w-100 p-3" value="<?php echo $data['nip']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kategori</label>
                                <select name="kategori" class="form-select form-control-modern p-3" required>
                                    <option value="Guru" <?php if($data['kategori'] == 'Guru') echo 'selected'; ?>>Guru</option>
                                    <option value="Staf TU" <?php if($data['kategori'] == 'Staf TU') echo 'selected'; ?>>Staf Tata Usaha</option>
                                    <option value="Pimpinan" <?php if($data['kategori'] == 'Pimpinan') echo 'selected'; ?>>Pimpinan Sekolah</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Jabatan / Pengampu Mapel</label>
                            <input type="text" name="jabatan" class="form-control-modern w-100 p-3" value="<?php echo $data['jabatan']; ?>" required>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold">Status Kepegawaian Aktif</label>
                            <div class="d-flex gap-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_aktif" id="aktif" value="Aktif" <?php if($data['status_aktif'] == 'Aktif') echo 'checked'; ?>>
                                    <label class="form-check-label" for="aktif">Aktif</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_aktif" id="non" value="Non-Aktif" <?php if($data['status_aktif'] == 'Non-Aktif') echo 'checked'; ?>>
                                    <label class="form-check-label" for="non">Non-Aktif</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" name="update" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow">Simpan Perubahan</button>
                            <a href="kelola-guru.php" class="btn btn-light px-5 py-3 rounded-pill fw-bold">Batal</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-5 text-center">
                        <label class="form-label fw-bold d-block mb-3">Foto Personel</label>
                        <div class="mb-3">
                            <?php 
                            $foto_tampil = (!empty($data['foto'])) ? "../assets/img/guru/".$data['foto'] : "https://ui-avatars.com/api/?name=".urlencode($data['nama'])."&background=064e3b&color=fff";
                            ?>
                            <img src="<?php echo $foto_tampil; ?>" class="rounded-4 shadow-sm object-fit-cover" style="width: 150px; height: 180px;">
                        </div>
                        <input type="file" name="foto" class="form-control form-control-sm">
                        <small class="text-muted d-block mt-2">Biarkan kosong jika tidak ingin mengganti foto.</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>