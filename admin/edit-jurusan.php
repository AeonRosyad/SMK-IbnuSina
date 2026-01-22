<?php
session_start();
include '../config/koneksi.php';

// Proteksi Halaman
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query_data = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE id = '$id'");
$data = mysqli_fetch_assoc($query_data);

// Jika ID tidak ditemukan
if (!$data) {
    echo "<script>alert('Data jurusan tidak ditemukan!'); window.location.href='kelola-jurusan.php';</script>";
    exit();
}

// Proses Update Data
if (isset($_POST['update'])) {
    $nama      = mysqli_real_escape_string($koneksi, $_POST['nama_jurusan']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $visi_misi = mysqli_real_escape_string($koneksi, $_POST['visi_misi']); // Field baru
    $status    = $_POST['status'];

    // Logika Upload Gambar Header
    $gambar_nama = $data['gambar_header']; // Default pakai gambar lama
    if (!empty($_FILES['gambar_header']['name'])) {
        $file_name = time() . "_" . $_FILES['gambar_header']['name'];
        $source    = $_FILES['gambar_header']['tmp_name'];
        $folder    = "../assets/img/jurusan/";

        // Buat folder jika belum ada
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (move_uploaded_file($source, $folder . $file_name)) {
            // Hapus gambar lama jika ada dan bukan default
            if (!empty($data['gambar_header']) && file_exists($folder . $data['gambar_header'])) {
                unlink($folder . $data['gambar_header']);
            }
            $gambar_nama = $file_name;
        }
    }

    $update = mysqli_query($koneksi, "UPDATE jurusan SET 
                nama_jurusan = '$nama', 
                deskripsi = '$deskripsi', 
                visi_misi = '$visi_misi', 
                gambar_header = '$gambar_nama',
                status = '$status' 
                WHERE id = '$id'");

    if ($update) {
        echo "<script>alert('Jurusan berhasil diperbarui!'); window.location.href='kelola-jurusan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jurusan - SMK IBNU SINA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .wrapper { display: flex; align-items: stretch; }
        #sidebar { min-width: 280px; max-width: 280px; background: #ffffff; height: 100vh; position: sticky; top: 0; border-right: 1px solid #e2e8f0; padding: 30px; }
        #content { width: 100%; padding: 40px; }
        .preview-img { width: 100%; max-height: 200px; object-fit: cover; border-radius: 15px; margin-bottom: 15px; border: 2px dashed #dee2e6; }
    </style>
</head>
<body class="bg-light">

<div class="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content">
        <header class="mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="kelola-jurusan.php" class="text-success text-decoration-none">Program Keahlian</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Jurusan</li>
                </ol>
            </nav>
            <h2 class="fw-900 text-dark">Perbarui Data Jurusan</h2>
            <p class="text-secondary">Sesuaikan konten visual dan informasi kompetensi keahlian.</p>
        </header>

        <form action="" method="POST" enctype="multipart/form-data"> <div class="row g-4">
                <div class="col-lg-8">
                    <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Nama Program Keahlian</label>
                            <input type="text" name="nama_jurusan" class="form-control-modern w-100 p-3" 
                                   value="<?php echo $data['nama_jurusan']; ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Deskripsi Singkat</label>
                            <textarea name="deskripsi" class="form-control-modern w-100 p-3" rows="3"><?php echo $data['deskripsi']; ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-dark">Visi & Misi Jurusan</label>
                            <textarea name="visi_misi" class="form-control-modern w-100 p-3" rows="6" placeholder="Tuliskan poin-poin visi dan misi..."><?php echo $data['visi_misi']; ?></textarea>
                        </div>

                        <div class="mb-5">
                            <label class="form-label fw-bold text-dark">Status Operasional</label>
                            <select name="status" class="form-select form-control-modern p-3">
                                <option value="Aktif" <?php echo ($data['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif (Tampil di Publik)</option>
                                <option value="Non-Aktif" <?php echo ($data['status'] == 'Non-Aktif') ? 'selected' : ''; ?>>Non-Aktif (Arsip)</option>
                            </select>
                        </div>

                        <div class="d-flex gap-3">
                            <button type="submit" name="update" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow">
                                <i class="bi bi-save me-2"></i> Simpan Perubahan
                            </button>
                            <a href="kelola-jurusan.php" class="btn btn-light px-5 py-3 rounded-pill fw-bold">Batal</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-5">
                        <label class="form-label fw-bold text-dark mb-3">Gambar Header Jurusan</label>
                        
                        <?php if(!empty($data['gambar_header'])): ?>
                            <img src="../assets/img/jurusan/<?php echo $data['gambar_header']; ?>" class="preview-img" id="imgPreview">
                        <?php else: ?>
                            <div class="preview-img d-flex align-items-center justify-content-center bg-light text-muted" id="imgPreview">
                                <i class="bi bi-image fs-1"></i>
                            </div>
                        <?php endif; ?>

                        <input type="file" name="gambar_header" class="form-control" accept="image/*" onchange="previewImage(this)">
                        <small class="text-muted d-block mt-2 italic">Format: JPG, PNG, WEBP. Maks 2MB.</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Script untuk preview gambar secara instan sebelum di-upload
    function previewImage(input) {
        const preview = document.getElementById('imgPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                if (preview.tagName === 'IMG') {
                    preview.src = e.target.result;
                } else {
                    const newImg = document.createElement('img');
                    newImg.src = e.target.result;
                    newImg.className = 'preview-img';
                    newImg.id = 'imgPreview';
                    preview.parentNode.replaceChild(newImg, preview);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
</body>
</html>