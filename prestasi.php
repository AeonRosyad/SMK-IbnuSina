<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 100% 0%, #ecfdf5 0%, #ffffff 100%);">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center bg-white border border-success-subtle rounded-pill px-3 py-1 mb-4 shadow-sm">
                        <span class="badge bg-success rounded-pill me-2">HALL OF FAME</span>
                        <small class="fw-bold text-success">Kebanggaan SMK IBNU SINA</small>
                    </div>
                    <h1 class="premium-heading mb-4" style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; color: #064e3b; letter-spacing: -2px;">
                        Prestasi & <br><span class="text-success">Penghargaan.</span>
                    </h1>
                    <p class="text-secondary fs-5 pe-lg-5">Apresiasi atas dedikasi, kerja keras, dan kreativitas seluruh civitas akademika dalam meraih standar keunggulan nasional.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="row g-4">
            <?php
            // Ambil data prestasi dari database urut tahun terbaru
            $query_prestasi = mysqli_query($koneksi, "SELECT * FROM prestasi ORDER BY tahun DESC, id DESC");
            
            if (mysqli_num_rows($query_prestasi) > 0) {
                while ($p = mysqli_fetch_assoc($query_prestasi)) :
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="achievement-card shadow-sm border-0">
                        <div class="achievement-year"><?php echo $p['tahun']; ?></div>
                        <div class="achievement-content">
                            <div class="medal-icon shadow-sm">
                                <i class="bi bi-trophy-fill"></i>
                            </div>
                            <span class="category-pill" style="background: <?php echo $p['warna_bg']; ?>; color: <?php echo $p['warna_teks']; ?>;">
                                <?php echo $p['kategori']; ?> • <?php echo $p['tingkat']; ?>
                            </span>
                            <h5 class="fw-800 text-dark lh-base mb-0"><?php echo $p['judul']; ?></h5>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile;
            } else {
                echo '<div class="col-12 text-center py-5"><p class="text-muted">Belum ada data prestasi yang tercatat.</p></div>';
            }
            ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>