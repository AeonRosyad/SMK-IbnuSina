<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['upload'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    
    $nama_file = time() . "_" . $_FILES['foto']['name'];
    $sumber = $_FILES['foto']['tmp_name'];
    $folder = "../assets/img/galeri/";

    if (move_uploaded_file($sumber, $folder . $nama_file)) {
        mysqli_query($koneksi, "INSERT INTO galeri (judul, kategori, foto) VALUES ('$judul', '$kategori', '$nama_file')");
        echo "<script>alert('Foto berhasil diunggah!'); window.location.href='kelola-galeri.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Galeri - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
    <div class="container" style="max-width: 600px;">
        <div class="card p-5 border-0 shadow-sm rounded-5">
            <h3 class="fw-bold mb-4">Unggah Dokumentasi</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Foto</label>
                    <input type="text" name="judul" class="form-control p-3 rounded-3" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Kategori</label>
                    <select name="kategori" class="form-select p-3 rounded-3">
                        <option value="Kegiatan Siswa">Kegiatan Siswa</option>
                        <option value="Fasilitas">Fasilitas</option>
                        <option value="Prestasi">Prestasi</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold">Pilih File Foto</label>
                    <input type="file" name="foto" class="form-control" required>
                </div>
                <button type="submit" name="upload" class="btn btn-success w-100 py-3 rounded-pill fw-bold">Mulai Unggah</button>
                <a href="kelola-galeri.php" class="btn btn-light w-100 mt-2 py-3 rounded-pill fw-bold">Batal</a>
            </form>
        </div>
    </div>
</body>
</html>