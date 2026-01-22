<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 0% 100%, #ecfdf5 0%, #ffffff 100%);">
        <div class="container py-4 text-center">
            <h1 class="fw-900 text-dark mb-2" style="font-size: 3rem; letter-spacing: -2px;">Pusat <span class="text-success">Pengumuman.</span></h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Informasi resmi, agenda mendesak, dan berita penting seputar SMK IBNU SINA Genteng.</p>
        </div>
    </section>

    <section class="container mt-4">
        <div class="row g-4 justify-content-center">
            <?php
            $query_pengumuman = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE status='Aktif' ORDER BY tanggal_tampil DESC");
            
            if (mysqli_num_rows($query_pengumuman) > 0) {
                while ($row = mysqli_fetch_assoc($query_pengumuman)) {
                    $color_class = 'bg-' . strtolower($row['prioritas']);
            ?>
                <div class="col-lg-10">
                    <div class="announcement-card shadow-sm d-flex flex-column flex-md-row align-items-md-center gap-4">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <span class="priority-indicator <?php echo $color_class; ?>"></span>
                                <small class="fw-bold text-uppercase text-muted" style="letter-spacing: 1px; font-size: 0.7rem;">
                                    <?php echo $row['prioritas']; ?> • <?php echo date('d M Y', strtotime($row['tanggal_tampil'])); ?>
                                </small>
                            </div>
                            <h4 class="fw-800 text-dark mb-2"><?php echo $row['judul']; ?></h4>
                            <p class="text-secondary mb-0 small lh-lg"><?php echo $row['isi']; ?></p>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="detail_pengumuman.php?id=<?php echo $row['id']; ?>" class="btn btn-success rounded-pill px-4 fw-bold">Detail Info</a>
                        </div>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo '<div class="text-center py-5"><p class="text-muted">Belum ada pengumuman terbaru.</p></div>';
            }
            ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>