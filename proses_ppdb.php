<?php
include 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dan proteksi dari SQL Injection
    $nama         = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $tmp_lahir    = mysqli_real_escape_string($koneksi, $_POST['tmp_lahir']);
    $tgl_lahir    = mysqli_real_escape_string($koneksi, $_POST['tgl_lahir']);
    $jk           = mysqli_real_escape_string($koneksi, $_POST['jk']);
    $whatsapp     = mysqli_real_escape_string($koneksi, $_POST['whatsapp']);
    $asal_sekolah = mysqli_real_escape_string($koneksi, $_POST['asal_sekolah']);
    $jurusan1     = mysqli_real_escape_string($koneksi, $_POST['jurusan1']);
    $asrama       = mysqli_real_escape_string($koneksi, $_POST['asrama']);

    // Query simpan ke database
    $sql = "INSERT INTO pendaftaran (nama, tmp_lahir, tgl_lahir, jk, whatsapp, asal_sekolah, jurusan1, asrama) 
            VALUES ('$nama', '$tmp_lahir', '$tgl_lahir', '$jk', '$whatsapp', '$asal_sekolah', '$jurusan1', '$asrama')";

    if (mysqli_query($koneksi, $sql)) {
        // Format pesan WhatsApp untuk konfirmasi ke Admin
        $no_admin = "+62 851-6918-7100"; // Ganti dengan nomor WhatsApp Admin SMK IBNU SINA
        $pesan = "Halo Admin SMK IBNU SINA, saya telah mendaftar PPDB Online.%0A%0A" .
                 "*Data Pendaftar*%0A" .
                 "Nama: $nama%0A" .
                 "Asal Sekolah: $asal_sekolah%0A" .
                 "Pilihan Jurusan: $jurusan1%0A" .
                 "Program Asrama: $asrama%0A%0A" .
                 "Mohon instruksi selanjutnya untuk proses verifikasi. Terima kasih.";

        // Redirect ke WhatsApp
        echo "<script>
                alert('Pendaftaran Berhasil! Silakan klik OK untuk konfirmasi ke WhatsApp Admin.');
                window.location.href = 'https://api.whatsapp.com/send?phone=$no_admin&text=$pesan';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>