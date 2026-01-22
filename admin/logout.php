<?php
// Memulai sesi untuk mengakses data yang akan dihapus
session_start();

// Menghapus semua variabel sesi yang terdaftar
$_SESSION = array();

// Jika ingin menghapus cookie sesi, maka session cookie juga harus dihapus
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Menghancurkan sesi secara permanen di server
session_destroy();

// Mengarahkan admin kembali ke halaman login dengan pesan sukses
echo "<script>
    alert('Anda telah berhasil keluar dari sistem.');
    window.location.href='login.php';
</script>";
exit();
?>