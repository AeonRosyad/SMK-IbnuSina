<?php
include 'config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Tangkap Data
    $nama           = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tahun_lulus    = mysqli_real_escape_string($koneksi, $_POST['tahun_lulus']);
    $jurusan_id     = mysqli_real_escape_string($koneksi, $_POST['jurusan_id']);
    $status_alumni  = mysqli_real_escape_string($koneksi, $_POST['status_alumni']);
    $nama_instansi  = mysqli_real_escape_string($koneksi, $_POST['nama_instansi']);
    $testimoni      = mysqli_real_escape_string($koneksi, $_POST['testimoni']);
    
    $foto_name = "";

    // 2. Logika Foto
    if (!empty($_FILES['foto']['name'])) {
        $target_dir = "assets/img/alumni/";
        if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }

        $file_ext   = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $foto_name  = time() . "_" . preg_replace("/[^a-zA-Z0-9]/", "", $nama) . "." . $file_ext;
        $target_file = $target_dir . $foto_name;

        $allowed = ['jpg', 'jpeg', 'png'];
        if (in_array(strtolower($file_ext), $allowed)) {
            move_uploaded_file($_FILES['foto']['tmp_name'], $target_file);
        }
    }

    // 3. Query Insert (PASTIKAN NAMA KOLOM SAMA DENGAN DATABASE)
    $sql = "INSERT INTO alumni (nama, tahun_lulus, jurusan_id, status_kerja, nama_instansi, testimoni, foto) 
            VALUES ('$nama', '$tahun_lulus', '$jurusan_id', '$status_alumni', '$nama_instansi', '$testimoni', '$foto_name')";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                alert('Terima kasih! Data alumni Anda berhasil dikirim.');
                window.location.href='index.php';
              </script>";
    } else {
        // Mode Debug: Menampilkan error asli dari MySQL jika gagal
        $error_msg = mysqli_error($koneksi);
        echo "<script>
                alert('Gagal mengirim data! Error: " . addslashes($error_msg) . "');
                window.history.back();
              </script>";
    }
}
?>