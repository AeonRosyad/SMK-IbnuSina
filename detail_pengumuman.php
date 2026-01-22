<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 

// Ambil ID dari URL dan proteksi dari SQL Injection
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query ambil data pengumuman spesifik
$query = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE id='$id' AND status='Aktif'");
$data = mysqli_fetch_array($query);

// Jika data tidak ditemukan, kembalikan ke halaman pengumuman
if (!$data) {
    echo "<script>window.location.href='pengumuman.php';</script>";
    exit;
}

// Logika warna badge prioritas sesuai kodingan CSS Anda
$badge_color = 'bg-normal';
if($data['prioritas'] == 'Mendesak') $badge_color = 'bg-mendesak';
if($data['prioritas'] == 'Penting') $badge_color = 'bg-penting';
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 0% 100%, #ecfdf5 0%, #ffffff 100%);">
        <div class="container py-4">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php" class="text-success text-decoration-none">Home</a></li>
                    <li class="breadcrumb-item"><a href="pengumuman.php" class="text-success text-decoration-none">Pengumuman</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>

            <div class="d-flex align-items-center gap-3 mb-3">
                <span class="priority-indicator <?php echo $badge_color; ?>"></span>
                <span class="fw-bold text-uppercase text-muted" style="letter-spacing: 1px; font-size: 0.8rem;">
                    <?php echo $data['prioritas']; ?> • <?php echo date('d F Y', strtotime($data['tanggal_tampil'])); ?>
                </span>
            </div>

            <h1 class="fw-900 text-dark mb-0" style="font-size: clamp(2rem, 4vw, 3rem); line-height: 1.2;">
                <?php echo $data['judul']; ?>
            </h1>
        </div>
    </section>

    <section class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="announcement-card shadow-sm p-4 p-md-5">
                    <div class="article-content mb-5">
                        <?php echo nl2br($data['isi']); ?>
                    </div>

                    <hr class="my-5 opacity-25">

                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <a href="pengumuman.php" class="btn btn-outline-success rounded-pill px-4 fw-bold">
                            <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
                        </a>
                        <button onclick="window.print()" class="btn btn-light rounded-pill px-4 fw-bold text-success border-success-subtle">
                            <i class="bi bi-printer me-2"></i> Cetak Pengumuman
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>