<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query_data = mysqli_query($koneksi, "SELECT * FROM konten WHERE id = '$id'");
$data = mysqli_fetch_assoc($query_data);

if (!$data) {
    echo "<script>alert('Berita tidak ditemukan!'); window.location.href='kelola-berita.php';</script>";
    exit();
}

if (isset($_POST['update'])) {
    $judul    = mysqli_real_escape_string($koneksi, $_POST['judul']);
    // Menangkap data dari CKEditor (sudah termasuk tag HTML)
    $isi      = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $kategori = $_POST['kategori'];
    $status   = $_POST['status'];

    $foto_nama = $data['gambar']; 
    
    // Logika Multi-upload (menggunakan file pertama sebagai sampul utama)
    if (!empty($_FILES['gambar']['name'][0])) {
        $folder = "../assets/img/berita/";
        $files = $_FILES['gambar'];

        foreach ($files['name'] as $key => $name) {
            if ($files['error'][$key] === 0) {
                $nama_file_baru = time() . "_" . $name;
                
                if (move_uploaded_file($files['tmp_name'][$key], $folder . $nama_file_baru)) {
                    // Jika file pertama, hapus file lama dan set sebagai gambar utama
                    if ($key === 0) {
                        if (!empty($data['gambar']) && file_exists($folder . $data['gambar'])) {
                            unlink($folder . $data['gambar']);
                        }
                        $foto_nama = $nama_file_baru;
                    }
                    // File tambahan bisa diproses ke tabel galeri jika sudah tersedia
                }
            }
        }
    }

    $update = mysqli_query($koneksi, "UPDATE konten SET 
        judul='$judul', isi='$isi', kategori='$kategori', 
        status='$status', gambar='$foto_nama' WHERE id='$id'");

    if ($update) {
        echo "<script>alert('Berita berhasil diperbarui!'); window.location.href='kelola-berita.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita - SMK IBNU SINA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <style>
        .wrapper { display: flex; align-items: stretch; }
        #sidebar {
            min-width: 280px; max-width: 280px;
            background: #ffffff; height: 100vh;
            position: sticky; top: 0;
            border-right: 1px solid #e2e8f0; padding: 30px;
        }
        #content { width: 100%; padding: 40px; }
        
        /* Pengaturan tinggi editor */
        .ck-editor__editable { min-height: 400px; border-radius: 0 0 15px 15px !important; }
        .ck-toolbar { border-radius: 15px 15px 0 0 !important; border: 1px solid #dee2e6 !important; }
    </style>
</head>
<body class="bg-light">
<div class="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content">
        <header class="mb-5">
            <h2 class="fw-900 text-dark">Edit Konten Berita</h2>
            <p class="text-secondary">Perbarui informasi atau koreksi kesalahan pada berita Anda.</p>
        </header>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Judul Berita</label>
                            <input type="text" name="judul" class="form-control-modern w-100 p-3" value="<?php echo $data['judul']; ?>" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Isi Berita</label>
                            <textarea name="isi" id="editor"><?php echo $data['isi']; ?></textarea>
                        </div>
                        <button type="submit" name="update" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow">Simpan Perubahan</button>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-5 text-center">
                        <div class="mb-4 text-start">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="kategori" class="form-select form-control-modern p-3">
                                <option value="berita" <?php echo ($data['kategori'] == 'berita') ? 'selected' : ''; ?>>Berita Kegiatan</option>
                                <option value="prestasi" <?php echo ($data['kategori'] == 'prestasi') ? 'selected' : ''; ?>>Prestasi Siswa</option>
                                <option value="artikel" <?php echo ($data['kategori'] == 'artikel') ? 'selected' : ''; ?>>Artikel Pendidikan</option>
                            </select>
                        </div>
                        <div class="mb-4 text-start">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select form-control-modern p-3">
                                <option value="Publish" <?php echo ($data['status'] == 'Publish') ? 'selected' : ''; ?>>Publish</option>
                                <option value="Draft" <?php echo ($data['status'] == 'Draft') ? 'selected' : ''; ?>>Draft</option>
                            </select>
                        </div>
                        <div class="mb-0 text-start">
                            <label class="form-label fw-bold mb-3">Gambar Utama</label>
                            <?php if(!empty($data['gambar'])): ?>
                                <img src="../assets/img/berita/<?php echo $data['gambar']; ?>" class="rounded-3 mb-3 w-100 shadow-sm">
                            <?php endif; ?>
                            <input type="file" name="gambar[]" class="form-control" multiple accept="image/*">
                            <small class="text-muted d-block mt-2">Pilih file baru jika ingin mengganti gambar utama.</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Inisialisasi CKEditor 5
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [
                'heading', '|', 
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                'blockQuote', 'insertTable', 'undo', 'redo'
            ],
            placeholder: 'Perbarui isi berita di sini...'
        })
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>