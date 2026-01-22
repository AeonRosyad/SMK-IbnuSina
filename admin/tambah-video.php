<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $url   = mysqli_real_escape_string($koneksi, $_POST['url_video']);

    // Logika sederhana untuk memastikan URL YouTube diconvert ke format embed
    if (strpos($url, 'watch?v=') !== false) {
        $url = str_replace('watch?v=', 'embed/', $url);
    }

    $insert = mysqli_query($koneksi, "INSERT INTO video (judul, url_video) VALUES ('$judul', '$url')");
    if ($insert) {
        echo "<script>alert('Video berhasil ditambahkan!'); window.location.href='kelola-video.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Video - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 600px;">
        <div class="card p-5 border-0 shadow-sm rounded-5">
            <h3 class="fw-bold mb-4">Input URL Video</h3>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Video</label>
                    <input type="text" name="judul" class="form-control p-3 rounded-3" placeholder="Misal: Profil SMK Ibnu Sina 2026" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">URL Video (YouTube Embed Link)</label>
                    <input type="url" name="url_video" class="form-control p-3 rounded-3" placeholder="https://www.youtube.com/embed/..." required>
                    <small class="text-muted d-block mt-2">Disarankan menggunakan link <b>Embed</b> dari YouTube agar video dapat diputar langsung.</small>
                </div>
                <button type="submit" name="simpan" class="btn btn-success w-100 py-3 rounded-pill fw-bold">Simpan Video</button>
                <a href="kelola-video.php" class="btn btn-light w-100 mt-2 py-3 rounded-pill fw-bold">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>