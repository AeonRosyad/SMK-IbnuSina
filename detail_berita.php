<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 

// Ambil ID dari URL dan proteksi dengan mysqli_real_escape_string
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query mengambil berita spesifik yang berstatus 'Publish'
$query = mysqli_query($koneksi, "SELECT * FROM konten WHERE id = '$id' AND status = 'Publish'");
$data = mysqli_fetch_assoc($query);

// Jika berita tidak ditemukan, arahkan kembali
if (!$data) {
    header("Location: berita.php");
    exit();
}

// Path folder gambar
$path_berita = "assets/img/berita/";
$sumber_gambar = (!empty($data['gambar']) && file_exists($path_berita . $data['gambar'])) 
                 ? $path_berita . $data['gambar'] 
                 : "https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=1200";
?>

<main class="bg-white pb-5">
    <nav class="py-3 bg-light border-bottom mb-5">
        <div class="container">
            <ol class="breadcrumb mb-0 small fw-bold">
                <li class="breadcrumb-item"><a href="index.php" class="text-success text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item"><a href="berita.php" class="text-success text-decoration-none">Berita</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Detail Berita</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <article>
                    <header class="mb-4">
                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 mb-3 fw-bold text-uppercase ls-1">
                            <?php echo $data['kategori']; ?>
                        </span>
                        <h1 class="fw-900 text-dark mb-3" style="font-size: 2.5rem; line-height: 1.2; letter-spacing: -1px;">
                            <?php echo $data['judul']; ?>
                        </h1>
                        <div class="d-flex align-items-center text-muted small fw-bold mb-4">
                            <i class="bi bi-calendar3 me-2 text-success"></i> 
                            <?php echo date('d F Y', strtotime($data['tanggal_posting'])); ?>
                            <span class="mx-3 opacity-25">|</span>
                            <i class="bi bi-person-circle me-2 text-success"></i> Admin SMK IBNU SINA
                        </div>
                    </header>

                    <div class="rounded-5 overflow-hidden mb-5 shadow-sm">
                        <img src="<?php echo $sumber_gambar; ?>" class="img-fluid w-100" alt="<?php echo $data['judul']; ?>">
                    </div>

                    <div class="entry-content fs-5 text-secondary lh-lg" style="text-align: justify;">
                        <?php 
                            // Mengubah baris baru menjadi paragraf agar tampilan rapi
                            echo nl2br($data['isi']); 
                        ?>
                    </div>
                </article>

                <div class="mt-5 pt-4 border-top">
                    <h6 class="fw-bold mb-3">Bagikan Berita:</h6>
                    <div class="d-flex gap-2">
                        <a href="https://wa.me/?text=<?php echo urlencode($data['judul'] . " - " . (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"); ?>" 
                           target="_blank" class="btn btn-success rounded-pill px-4 fw-bold">
                            <i class="bi bi-whatsapp me-2"></i> WhatsApp
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sticky-top" style="top: 100px; z-index: 1;">
                    <div class="p-4 rounded-5 bg-light border-0 mb-4">
                        <h5 class="fw-900 text-dark mb-4 border-start border-success border-4 ps-3">Berita Lainnya</h5>
                        <?php
                        // Ambil 3 berita terbaru lainnya
                        $query_lain = mysqli_query($koneksi, "SELECT * FROM konten WHERE kategori IN ('berita', 'prestasi', 'artikel') AND status='Publish' AND id != '$id' ORDER BY tanggal_posting DESC LIMIT 3");
                        while($lain = mysqli_fetch_assoc($query_lain)):
                        ?>
                        <div class="mb-4 pb-4 border-bottom border-secondary-subtle last-child-border-0">
                            <a href="detail_berita.php?id=<?php echo $lain['id']; ?>" class="text-decoration-none group">
                                <h6 class="fw-bold text-dark mb-2 transition-success"><?php echo $lain['judul']; ?></h6>
                                <small class="text-muted d-block"><?php echo date('d M Y', strtotime($lain['tanggal_posting'])); ?></small>
                            </a>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    
                    <div class="p-4 rounded-5 bg-success text-white border-0 shadow-lg">
                        <h5 class="fw-bold mb-3">Ada Pertanyaan?</h5>
                        <p class="small opacity-75 mb-4">Hubungi admin sekolah untuk informasi lebih lanjut mengenai kegiatan ini.</p>
                        <a href="https://wa.me/628123456789" class="btn btn-white w-100 rounded-pill fw-bold py-2 text-success">
                            Hubungi Kami
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .fw-900 { font-weight: 900; }
    .ls-1 { letter-spacing: 1px; }
    .transition-success { transition: 0.3s; }
    .transition-success:hover { color: #10b981 !important; }
    .btn-white { background: #fff; border: none; }
    .last-child-border-0:last-child { border-bottom: none !important; margin-bottom: 0 !important; padding-bottom: 0 !important; }
</style>

<?php include 'includes/footer.php'; ?>