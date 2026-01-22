<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 100% 0%, #ecfdf5 0%, #ffffff 100%);">
        <div class="container py-5 text-center">
            <div class="d-inline-flex align-items-center bg-white border border-success-subtle rounded-pill px-3 py-1 mb-4 shadow-sm">
                <span class="badge bg-success rounded-pill me-2">KOMPETENSI</span>
                <small class="fw-bold text-success">Pilih Masa Depanmu</small>
            </div>
            <h1 class="premium-heading mb-0" style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; color: #064e3b; letter-spacing: -2px;">
                Jurusan <span class="text-success">Unggulan.</span>
            </h1>
        </div>
    </section>

    <section class="container py-5">
        <div class="row g-4">
            <?php
            $query_jurusan = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE status='Aktif'");
            if (mysqli_num_rows($query_jurusan) > 0) {
                while ($row = mysqli_fetch_assoc($query_jurusan)) {
            ?>
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-5 p-4 h-100 transition-up">
                        <div class="d-flex align-items-start gap-4">
                            <div class="bg-success-subtle text-success rounded-4 d-flex align-items-center justify-content-center flex-shrink-0" style="width: 70px; height: 70px; font-size: 2rem;">
                                <i class="bi <?php echo $row['ikon']; ?>"></i>
                            </div>
                            <div>
                                <h4 class="fw-800 text-dark mb-2"><?php echo $row['nama_jurusan']; ?> (<?php echo $row['singkatan']; ?>)</h4>
                                <p class="text-secondary small lh-lg mb-4"><?php echo $row['deskripsi']; ?></p>
                                <a href="detail-jurusan.php?id=<?php echo $row['id']; ?>" class="btn btn-light rounded-pill px-4 fw-bold text-success border-success-subtle">
                                    Pelajari Lebih Lanjut <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo '<div class="col-12 text-center"><p class="text-muted">Data jurusan belum diinput.</p></div>';
            }
            ?>
        </div>
    </section>
</main>

<style>
    .transition-up { transition: all 0.3s ease; }
    .transition-up:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(16, 185, 129, 0.1) !important; }
</style>

<?php include 'includes/footer.php'; ?>