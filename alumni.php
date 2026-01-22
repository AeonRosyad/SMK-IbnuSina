<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="position-relative py-5 overflow-hidden" style="background: radial-gradient(circle at 100% 0%, #f0fdf4 0%, #ffffff 100%); min-height: 40vh; display: flex; align-items: center;">
        <div class="container py-4 text-center position-relative" style="z-index: 2;">
            <span class="badge bg-success-subtle text-success px-4 py-2 rounded-pill mb-3 fw-bold shadow-sm">
                <i class="bi bi-people-fill me-2"></i>JARINGAN LULUSAN
            </span>
            <h1 class="fw-900 text-dark mb-3" style="font-size: clamp(2.5rem, 5vw, 4rem); letter-spacing: -3px; line-height: 1;">
                Kisah <span class="text-success">Sukses Alumni.</span>
            </h1>
            <p class="text-secondary mx-auto fs-5 opacity-75" style="max-width: 700px;">
                Menginspirasi generasi mendatang melalui jejak karir para lulusan terbaik SMK IBNU SINA Genteng.
            </p>
        </div>
        <div class="position-absolute top-0 start-0 bg-success opacity-5 rounded-circle shadow-blur" style="width: 300px; height: 300px; margin-top: -100px; margin-left: -100px;"></div>
    </section>

    <section class="container mt-n4">
        <div class="row g-4 justify-content-center">
            <?php
            // Query lengkap mengambil semua data terkait alumni
            $query_alumni = mysqli_query($koneksi, "SELECT a.*, j.nama_jurusan FROM alumni a JOIN jurusan j ON a.jurusan_id = j.id ORDER BY a.tahun_lulus DESC");
            
            if (mysqli_num_rows($query_alumni) > 0) {
                while ($row = mysqli_fetch_assoc($query_alumni)) {
                    $tampil_foto = (!empty($row['foto'])) ? "assets/img/alumni/".$row['foto'] : "https://ui-avatars.com/api/?name=".urlencode($row['nama'])."&background=10b981&color=fff";
                    
                    // Warna badge status dinamis
                    $status_class = ($row['status_kerja'] == 'Bekerja') ? 'bg-primary' : (($row['status_kerja'] == 'Kuliah') ? 'bg-info' : 'bg-warning');
            ?>
                <div class="col-lg-4 col-md-6 animate-up">
                    <div class="alumni-card-modern p-4 h-100 shadow-sm border-0 bg-white rounded-5 transition-up">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="position-relative">
                                <img src="<?php echo $tampil_foto; ?>" class="rounded-circle shadow-sm border border-2 border-white" style="width: 70px; height: 70px; object-fit: cover;" alt="Foto Alumni">
                                <span class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle" style="width: 15px; height: 15px;"></span>
                            </div>
                            <div>
                                <h6 class="fw-800 text-dark mb-0 fs-5"><?php echo $row['nama']; ?></h6>
                                <small class="text-success fw-bold text-uppercase" style="font-size: 0.7rem; letter-spacing: 1px;">
                                    <?php echo $row['nama_jurusan']; ?> <span class="text-muted">| Class of <?php echo $row['tahun_lulus']; ?></span>
                                </small>
                            </div>
                        </div>

                        <div class="testimonial-box position-relative mb-4 p-3 bg-light rounded-4">
                            <i class="bi bi-quote fs-1 position-absolute top-0 start-0 opacity-10 translate-middle-y"></i>
                            <p class="small text-secondary mb-0 lh-base italic">
                                "<?php echo (strlen($row['testimoni']) > 150) ? substr($row['testimoni'], 0, 150) . '...' : $row['testimoni']; ?>"
                            </p>
                        </div>

                        <div class="career-info d-flex align-items-center justify-content-between pt-3 border-top border-light mt-auto">
                            <div>
                                <small class="text-muted d-block small fw-bold text-uppercase" style="font-size: 0.6rem; letter-spacing: 0.5px;">Status & Lokasi</small>
                                <span class="text-dark fw-bold small"><?php echo $row['status_kerja']; ?> @ <?php echo !empty($row['nama_instansi']) ? $row['nama_instansi'] : '-'; ?></span>
                            </div>
                            <span class="badge <?php echo $status_class; ?> rounded-pill px-2 py-1 small opacity-75">
                                <i class="bi bi-briefcase-fill small"></i>
                            </span>
                        </div>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo '<div class="col-12 text-center py-5"><img src="assets/img/empty-data.svg" style="width:200px" class="mb-4 d-block mx-auto"><p class="text-muted fs-5">Belum ada jejak alumni yang tercatat.</p></div>';
            }
            ?>
        </div>
    </section>

    <section class="container mt-5 pt-5">
        <div class="p-5 rounded-5 text-center text-white shadow-lg overflow-hidden position-relative" style="background: linear-gradient(135deg, #064e3b 0%, #10b981 100%);">
            <div class="position-relative" style="z-index: 2;">
                <h3 class="fw-900 mb-3 display-6">Halo Alumni! Sudahkah Anda Update Data?</h3>
                <p class="mb-4 fs-5 opacity-75">Bantu sekolah dalam pemetaan karir lulusan dengan mengisi formulir Tracer Study online.</p>
                <a href="tracer-study.php" class="btn btn-light rounded-pill px-5 py-3 fw-bold text-success shadow-sm hover-grow">
                    <i class="bi bi-pencil-square me-2"></i>Update Data Karir Saya
                </a>
            </div>
            <div class="position-absolute top-50 start-50 translate-middle bg-white opacity-10 rounded-circle" style="width: 500px; height: 500px; filter: blur(100px);"></div>
        </div>
    </section>
</main>

<style>
    .fw-800 { font-weight: 800; }
    .fw-900 { font-weight: 900; }
    .transition-up { transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .transition-up:hover { transform: translateY(-12px); box-shadow: 0 20px 40px rgba(16, 185, 129, 0.1) !important; border-color: #10b981 !important; }
    .hover-grow:hover { transform: scale(1.05); }
    .animate-up { animation: fadeInUp 0.8s ease-out forwards; }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .shadow-blur { filter: blur(50px); }
    .italic { font-style: italic; }
</style>

<?php include 'includes/footer.php'; ?>