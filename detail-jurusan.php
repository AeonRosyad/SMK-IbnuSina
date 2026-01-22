<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 

// Proteksi ID Jurusan
$id = mysqli_real_escape_string($koneksi, $_GET['id']);
$query = mysqli_query($koneksi, "SELECT * FROM jurusan WHERE id='$id' AND status='Aktif'");
$data = mysqli_fetch_array($query);

if (!$data) {
    echo "<script>window.location.href='jurusan.php';</script>";
    exit;
}

// Fallback gambar jika tidak ada di database
$img_header = !empty($data['gambar_header']) ? "assets/img/jurusan/".$data['gambar_header'] : "https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=1400";
?>

<main class="bg-white">
    <section class="jurusan-hero-section shadow-lg" style="background-image: url('<?php echo $img_header; ?>');">
        <div class="container position-relative" style="z-index: 2;">
            <div class="row">
                <div class="col-lg-8">
                    <span class="badge bg-success-subtle text-white px-3 py-2 rounded-pill mb-4 fw-bold shadow-sm" style="background: rgba(255,255,255,0.2) !important;">
                        PROGRAM KEAHLIAN
                    </span>
                    <h1 class="display-3 fw-900 mb-3" style="letter-spacing: -3px;"><?php echo $data['nama_jurusan']; ?></h1>
                    <p class="fs-5 opacity-75 mb-0">Mempersiapkan tenaga profesional di bidang <?php echo $data['singkatan']; ?> dengan standar industri internasional.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="floating-stats-card">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-7 border-end-lg">
                            <h3 class="fw-900 text-dark mb-4">Mengenal Program.</h3>
                            <div class="text-secondary lh-lg mb-0" style="font-size: 1.1rem;">
                                <?php echo nl2br($data['deskripsi']); ?>
                            </div>
                        </div>
                        <div class="col-lg-5 ps-lg-5 text-center text-lg-start">
                            <h5 class="fw-800 text-success mb-3">Peluang Karir Lulusan:</h5>
                            <div class="d-flex flex-wrap justify-content-center justify-content-lg-start">
                                <span class="career-tag">Technopreneur</span>
                                <span class="career-tag">Network Engineer</span>
                                <span class="career-tag">Web Developer</span>
                                <span class="career-tag">System Admin</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="p-5 bg-light rounded-5 h-100 border-0">
                    <h4 class="fw-900 text-dark mb-4 d-flex align-items-center">
                        <i class="bi bi-bullseye text-success me-3 fs-2"></i> Fokus Kompetensi
                    </h4>
                    <div class="text-secondary fs-5 lh-lg">
                        <?php echo nl2br($data['visi_misi']); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="p-5 text-white rounded-5 h-100 shadow-sm" style="background: #064e3b;">
                    <h4 class="fw-900 mb-4">Fasilitas Utama</h4>
                    <ul class="list-unstyled">
                        <li class="mb-4 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 text-success fs-4"></i> Lab Praktik Standar Industri</li>
                        <li class="mb-4 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 text-success fs-4"></i> Akses Internet Fiber Optik</li>
                        <li class="mb-4 d-flex align-items-center"><i class="bi bi-check-circle-fill me-3 text-success fs-4"></i> Sertifikasi Kompetensi Nasional</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>