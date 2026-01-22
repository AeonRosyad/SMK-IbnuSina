<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['simpan'])) {
    $judul      = mysqli_real_escape_string($koneksi, $_POST['judul']);
    // Isi berita sekarang menyimpan tag HTML dari editor (bold, italic, dll)
    $isi        = mysqli_real_escape_string($koneksi, $_POST['isi']);
    $kategori   = $_POST['kategori'];
    $status     = $_POST['status'];

    // Simpan data berita terlebih dahulu
    $query = "INSERT INTO konten (judul, isi, kategori, status) 
              VALUES ('$judul', '$isi', '$kategori', '$status')";
    
    if (mysqli_query($koneksi, $query)) {
        $konten_id = mysqli_insert_id($koneksi); // Ambil ID berita yang baru masuk

        // LOGIKA MULTI-UPLOAD GAMBAR
        if (!empty($_FILES['gambar']['name'][0])) {
            $files = $_FILES['gambar'];
            foreach ($files['name'] as $key => $name) {
                if ($files['error'][$key] === 0) {
                    $foto_nama = time() . "_" . $name;
                    $path = "../assets/img/berita/" . $foto_nama;
                    
                    if (move_uploaded_file($files['tmp_name'][$key], $path)) {
                        // Jika ini foto pertama, set sebagai gambar utama di tabel konten
                        if ($key === 0) {
                            mysqli_query($koneksi, "UPDATE konten SET gambar = '$foto_nama' WHERE id = '$konten_id'");
                        }
                        // Opsional: Anda bisa menyimpan foto lainnya ke tabel galeri_berita jika ada
                    }
                }
            }
        }
        echo "<script>alert('Berita berhasil diterbitkan!'); window.location.href='kelola-berita.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tulis Berita - SMK IBNU SINA</title>
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
        /* Memperbaiki tinggi editor agar terlihat proporsional */
        .ck-editor__editable { min-height: 400px; border-radius: 0 0 15px 15px !important; }
        .ck-toolbar { border-radius: 15px 15px 0 0 !important; border: 1px solid #dee2e6 !important; }
    </style>
</head>
<body class="bg-light">
<div class="wrapper">
    <?php include 'sidebar.php'; ?>
    <div id="content">
        <header class="mb-5">
            <h2 class="fw-900 text-dark">Tulis Konten Baru</h2>
            <p class="text-secondary">Bagikan berita kegiatan dan prestasi sekolah dengan format yang menarik.</p>
        </header>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="modern-card p-5 border-0 shadow-sm bg-white rounded-5">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Judul Berita</label>
                            <input type="text" name="judul" class="form-control-modern w-100 p-3" placeholder="Masukkan judul berita..." required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Isi Berita</label>
                            <textarea name="isi" id="editor"></textarea>
                        </div>
                        <button type="submit" name="simpan" class="btn btn-success px-5 py-3 rounded-pill fw-bold">Terbitkan Berita</button>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-5">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Kategori</label>
                            <select name="kategori" class="form-select form-control-modern p-3">
                                <option value="berita">Berita Kegiatan</option>
                                <option value="prestasi">Prestasi Siswa</option>
                                <option value="artikel">Artikel Pendidikan</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Status</label>
                            <select name="status" class="form-select form-control-modern p-3">
                                <option value="Publish">Publish</option>
                                <option value="Draft">Draft</option>
                            </select>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-bold">Upload Foto (Bisa pilih banyak)</label>
                            <input type="file" name="gambar[]" class="form-control" multiple accept="image/*">
                            <small class="text-muted mt-2 d-block small">Foto pertama akan menjadi sampul utama.</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Menjalankan Rich Text Editor
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [
                'heading', '|', 
                'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                'blockQuote', 'insertTable', 'undo', 'redo'
            ],
            placeholder: 'Tuliskan isi berita di sini...'
        })
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>