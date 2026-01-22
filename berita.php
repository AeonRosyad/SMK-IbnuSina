<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 

// Tentukan path folder gambar agar mudah dikelola
$path_berita = "assets/img/berita/";
?>

<main class="bg-white">
    <section class="py-5" style="background: radial-gradient(circle at 0% 100%, #ecfdf5 0%, #ffffff 100%);">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    <div class="d-inline-flex align-items-center bg-white border border-success-subtle rounded-pill px-3 py-1 mb-4 shadow-sm">
                        <span class="badge bg-success rounded-pill me-2">WARTA</span>
                        <small class="fw-bold text-success">Kabar Terkini SMK IBNU SINA</small>
                    </div>
                    <h1 class="premium-heading mb-4" style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; color: #064e3b; letter-spacing: -2px;">
                        Berita & <br><span class="text-success">Informasi Terbaru.</span>
                    </h1>
                    <p class="text-secondary fs-5 pe-lg-5">Informasi resmi mengenai kegiatan sekolah, prestasi siswa, dan pengumuman penting lainnya.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="row g-4">
                <?php
                // Query mengambil data dari database
                // Query untuk mengambil kategori berita, prestasi, dan artikel sekaligus
                $query = mysqli_query($koneksi, "SELECT * FROM konten 
                                                WHERE kategori IN ('berita', 'prestasi', 'artikel') 
                                                ORDER BY tanggal_posting DESC") 
                        or die(mysqli_error($koneksi));
                
                if(mysqli_num_rows($query) > 0) {
                    while($row = mysqli_fetch_array($query)) {
                        
                        // Logika Sinkronisasi Gambar
                        $nama_file = $row['gambar'];
                        $file_lokal = $path_berita . $nama_file;
                        
                        // Cek apakah file benar-benar ada di folder assets
                        if (!empty($nama_file) && file_exists($file_lokal)) {
                            $sumber_gambar = $file_lokal;
                        } else {
                            // Gambar Cadangan jika file tidak ditemukan di folder
                            $sumber_gambar = "https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=600";
                        }
                ?>
                <div class="col-lg-4 col-md-6">
                    <article class="news-card h-100 d-flex flex-column shadow-sm border-0" style="background: #ffffff; border-radius: 32px; overflow: hidden; transition: 0.4s;">
                        
                        <div class="position-relative overflow-hidden" style="height: 250px;">
                            <img src="<?php echo $sumber_gambar; ?>" 
                                 class="w-100 h-100" 
                                 style="object-fit: cover; transition: 0.5s;" 
                                 alt="<?php echo $row['judul']; ?>">
                            
                            <div class="position-absolute top-0 start-0 m-3">
                                <span class="badge bg-white text-success shadow-sm px-3 py-2 rounded-pill fw-bold small">
                                    BERITA
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="d-flex align-items-center mb-3 small text-muted fw-bold">
                                <i class="bi bi-calendar3 me-2 text-success"></i>
                                <?php echo date('d M Y', strtotime($row['tanggal_posting'])); ?>
                            </div>
                            
                            <h4 class="fw-800 mb-3" style="color: #064e3b; line-height: 1.3; font-size: 1.25rem;">
                                <?php echo $row['judul']; ?>
                            </h4>
                            
                            <p class="text-muted small mb-4">
                                <?php echo substr(strip_tags($row['isi']), 0, 115); ?>...
                            </p>
                            
                            <div class="mt-auto pt-3 border-top border-light">
                                <a href="detail_berita.php?id=<?php echo $row['id']; ?>" class="text-success fw-bold text-decoration-none small d-flex align-items-center">
                                    SELENGKAPNYA <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                </div>
                <?php 
                    } 
                } else {
                    echo '<div class="col-12 text-center py-5"><p class="text-muted">Data berita tidak tersedia.</p></div>';
                }
                ?>
            </div>
        </div>
    </section>
</main>

<style>
    /* Hover Effect untuk News Card */
    .news-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px -15px rgba(16, 185, 129, 0.15) !important;
    }
    .news-card:hover img {
        transform: scale(1.08);
    }
    .fw-800 { font-weight: 800; }
</style>

<?php include 'includes/footer.php'; ?>