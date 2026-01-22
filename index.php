<?php 
include 'includes/header.php'; 
include 'config/koneksi.php';
?>

<main class="bg-white">
    <section class="position-relative py-5 overflow-hidden" style="background: radial-gradient(circle at 0% 0%, #f1fef7 0%, #ffffff 100%); min-height: 95vh; display: flex; align-items: center;">
        
        <div class="position-absolute animate-blob" style="top: -5%; right: 0%; width: 600px; height: 600px; background: rgba(16, 185, 129, 0.07); filter: blur(100px); border-radius: 50%; z-index: 1;"></div>
        <div class="position-absolute animate-blob animation-delay-2000" style="bottom: -10%; left: -5%; width: 500px; height: 500px; background: rgba(6, 78, 59, 0.04); filter: blur(90px); border-radius: 50%; z-index: 1;"></div>
        
        <div class="container position-relative" style="z-index: 5;">
            <div class="row align-items-center g-5">
                <div class="col-lg-7 text-center text-lg-start animate-up">
                    <div class="d-inline-flex align-items-center bg-white border border-success-subtle rounded-pill px-3 py-2 mb-4 shadow-sm" style="backdrop-filter: blur(15px);">
                        <span class="badge bg-success rounded-pill me-2 pulse">PPDB 2026</span>
                        <small class="fw-bold text-success">Pendaftaran Gelombang 1 Telah Dibuka!</small>
                    </div>
                    
                    <h1 class="hero-title mb-4" style="font-size: clamp(3.2rem, 7vw, 5.5rem); font-weight: 800; line-height: 0.9; color: #064e3b; letter-spacing: -4px;">
                        Membangun <span class="text-gradient-green">Kompetensi</span> <br>
                        Meraih <span class="text-success">Prestasi.</span>
                    </h1>
                    
                    <p class="text-secondary fs-5 mb-5 pe-lg-5 lh-base opacity-75">
                        SMK IBNU SINA Genteng menghadirkan pendidikan vokasi berbasis teknologi industri yang dipadukan dengan penguatan karakter religius.
                    </p>
                    
                    <div class="d-flex flex-wrap gap-3 justify-content-center justify-content-lg-start">
                        <a href="ppdb.php" class="btn btn-success btn-lg px-5 rounded-pill shadow-lg fw-bold py-3 transition-up border-0" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            Daftar Sekarang <i class="bi bi-arrow-right-short ms-2"></i>
                        </a>
                        <a href="jurusan.php" class="btn btn-outline-dark btn-lg px-5 rounded-pill fw-bold py-3 border-2">
                            Eksplor Jurusan
                        </a>
                    </div>

                    <div class="mt-5 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start gap-4">
                        <div class="d-flex align-items-center bg-white border border-light px-3 py-2 rounded-4 shadow-sm">
                            <i class="bi bi-patch-check-fill text-success me-2"></i>
                            <small class="fw-bold text-dark">Terakreditasi A</small>
                        </div>
                        <div class="d-flex align-items-center bg-white border border-light px-3 py-2 rounded-4 shadow-sm">
                            <i class="bi bi-award-fill text-success me-2"></i>
                            <small class="fw-bold text-dark">Mitra Industri Luas</small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 d-none d-lg-block text-center position-relative">
                    <div class="position-relative d-inline-block">
                        <div class="glass-card position-absolute top-0 start-0 translate-middle-x mt-5 p-3 rounded-4 shadow-lg animate-float" style="z-index: 10; width: 160px; background: rgba(255,255,255,0.85); border: 1px solid rgba(255,255,255,0.5); backdrop-filter: blur(12px);">
                            <h4 class="fw-900 text-success mb-0"><span class="counter" data-target="95">0</span>%</h4>
                            <small class="text-dark fw-bold">Lulusan Bekerja, Wirausaha, dan Kuliah</small>
                        </div>
                        <img src="assets/img/hero-student-hd.png" class="img-fluid position-relative" alt="Student" style="max-width: 140%; z-index: 5; filter: drop-shadow(0 40px 80px rgba(16, 185, 129, 0.3)); -webkit-mask-image: linear-gradient(to bottom, black 85%, transparent 100%);">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white border-top border-light">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center gap-3 mb-5">
                        <h2 class="fw-900 text-dark mb-0" style="letter-spacing: -1.5px;">Berita <span class="text-success">Terkini.</span></h2>
                        <div class="flex-grow-1 border-top border-light"></div>
                        <a href="berita.php" class="btn btn-light rounded-pill px-4 fw-bold text-success border-0">LIHAT SEMUA</a>
                    </div>
                    <div class="row g-4">
                        <?php
                        $query_artikel = mysqli_query($koneksi, "SELECT * FROM konten WHERE status='Publish' ORDER BY tanggal_posting DESC LIMIT 4");
                        while ($art = mysqli_fetch_assoc($query_artikel)) :
                            $img_file = "assets/img/berita/" . $art['gambar'];
                            $tampil_img = (!empty($art['gambar']) && file_exists($img_file)) ? $img_file : "https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=800";
                        ?>
                        <div class="col-md-6">
                            <article class="article-card shadow-sm h-100 bg-white rounded-5 overflow-hidden border-0 position-relative transition-up">
                                <div class="position-relative" style="height: 220px; overflow: hidden;">
                                    <img src="<?php echo $tampil_img; ?>" class="w-100 h-100 object-fit-cover" alt="News">
                                    <div class="position-absolute top-0 start-0 m-3">
                                        <span class="badge bg-white text-success rounded-pill px-3 shadow-sm"><?php echo strtoupper($art['kategori']); ?></span>
                                    </div>
                                </div>
                                <div class="p-4 d-flex flex-column">
                                    <small class="text-muted fw-bold mb-2"><i class="bi bi-calendar3 me-2 text-success"></i><?php echo date('d M Y', strtotime($art['tanggal_posting'])); ?></small>
                                    <h5 class="fw-800 text-dark mb-3 lh-base" style="font-size: 1.2rem;"><?php echo substr($art['judul'], 0, 55); ?>...</h5>
                                    <a href="detail_berita.php?id=<?php echo $art['id']; ?>" class="text-success fw-bold text-decoration-none mt-auto stretched-link">SELENGKAPNYA <i class="bi bi-chevron-right ms-1"></i></a>
                                </div>
                            </article>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px; z-index: 10;">
                        <div class="bg-light p-4 p-md-5 rounded-5 border-0 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h4 class="fw-900 text-dark mb-0">Pengumuman.</h4>
                                <span class="badge bg-danger pulse rounded-pill">PENTING</span>
                            </div>
                            <div class="announcement-list">
                                <?php
                                $query_home_pengumuman = mysqli_query($koneksi, "SELECT * FROM pengumuman WHERE status='Aktif' ORDER BY tanggal_tampil DESC LIMIT 3");
                                while ($row = mysqli_fetch_assoc($query_home_pengumuman)) :
                                    $dot_color = ($row['prioritas'] == 'Mendesak') ? 'bg-danger' : (($row['prioritas'] == 'Penting') ? 'bg-warning' : 'bg-success');
                                ?>
                                <div class="mb-4 pb-4 border-bottom border-white">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="announcement-dot <?php echo $dot_color; ?> pulse shadow-sm"></span>
                                        <small class="text-muted fw-bold small text-uppercase" style="letter-spacing: 1px;"><?php echo date('d M Y', strtotime($row['tanggal_tampil'])); ?></small>
                                    </div>
                                    <h6 class="fw-800 text-dark mb-2" style="font-size: 1.05rem; line-height: 1.4;"><?php echo $row['judul']; ?></h6>
                                    <a href="pengumuman.php" class="text-success fw-bold text-decoration-none small">LIHAT DETAIL <i class="bi bi-arrow-right"></i></a>
                                </div>
                                <?php endwhile; ?>
                            </div>
                            <a href="pengumuman.php" class="btn btn-white w-100 rounded-pill fw-bold py-3 mt-2 shadow-sm border border-success-subtle text-success">SEMUA PENGUMUMAN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light overflow-hidden">
        <div class="container py-4">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-900 text-dark mb-0 ls-1">Galeri <span class="text-success">Kegiatan.</span></h2>
                        <a href="galeri.php" class="text-success fw-bold text-decoration-none small">LIHAT SEMUA <i class="bi bi-arrow-right"></i></a>
                    </div>
                    
                    <div class="row g-3">
                        <?php
                        // Mengambil 4 foto terbaru dari database
                        $query_home_galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY tanggal_upload DESC LIMIT 4");
                        if (mysqli_num_rows($query_home_galeri) > 0) {
                            while ($g = mysqli_fetch_assoc($query_home_galeri)) :
                        ?>
                            <div class="col-md-6">
                                <div class="gallery-item position-relative overflow-hidden rounded-5 shadow-sm" style="height: 200px;">
                                    <img src="assets/img/galeri/<?php echo $g['foto']; ?>" class="w-100 h-100 object-fit-cover transition-up" alt="<?php echo $g['judul']; ?>">
                                    <div class="gallery-overlay-small p-3 d-flex align-items-end">
                                        <small class="text-white fw-bold"><?php echo substr($g['judul'], 0, 30); ?>...</small>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endwhile;
                        } else {
                            echo '<p class="text-muted small">Belum ada dokumentasi foto.</p>';
                        }
                        ?>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="mb-4">
                        <h2 class="fw-900 text-dark mb-1 ls-1">Video <span class="text-success">Profil.</span></h2>
                        <p class="text-secondary small">Visualisasi lingkungan dan aktivitas SMK IBNU SINA Genteng.</p>
                    </div>

                    <div class="video-container position-relative rounded-5 overflow-hidden shadow-lg bg-dark" style="height: 415px;">
                        <?php
                        // Ambil 1 video terbaru yang diinput dari panel admin
                        $query_video = mysqli_query($koneksi, "SELECT * FROM video ORDER BY tanggal_upload DESC LIMIT 1");
                        
                        if (mysqli_num_rows($query_video) > 0) {
                            $data_video = mysqli_fetch_assoc($query_video);
                            $url_video = $data_video['url_video'];

                            // Cek apakah URL berisi link YouTube biasa, jika ya ubah ke format embed
                            if (strpos($url_video, 'watch?v=') !== false) {
                                $url_video = str_replace('watch?v=', 'embed/', $url_video);
                            }
                        ?>
                            <iframe class="w-100 h-100 border-0" 
                                    src="<?php echo $url_video; ?>?rel=0&modestbranding=1" 
                                    title="<?php echo $data_video['judul']; ?>" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                            
                            <div class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-dark text-white" style="background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                                <h6 class="fw-bold mb-0">
                                    <i class="bi bi-play-circle-fill me-2 text-success"></i> 
                                    <?php echo $data_video['judul']; ?>
                                </h6>
                                <small class="opacity-75">Diunggah pada: <?php echo date('d M Y', strtotime($data_video['tanggal_upload'])); ?></small>
                            </div>

                        <?php } else { ?>
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-white opacity-50">
                                <i class="bi bi-camera-video fs-1 mb-2"></i>
                                <p class="small">Belum ada video profil tersedia.</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 position-relative overflow-hidden" style="background: #064e3b; margin-top: -50px; border-top: 1px solid rgba(255,255,255,0.1);">
        
        <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/stardust.png'); z-index: 1;"></div>
        
        <div class="position-absolute top-0 end-0 bg-success opacity-20 rounded-circle" style="width: 500px; height: 500px; margin-top: -200px; margin-right: -100px; filter: blur(120px); z-index: 2;"></div>

        <div class="container py-5 position-relative" style="z-index: 5;">
            <div class="row align-items-center g-5">
                <div class="col-lg-5 text-center text-lg-start animate-up">
                    <div class="d-inline-flex align-items-center bg-white bg-opacity-10 border border-white border-opacity-20 rounded-pill px-4 py-2 mb-4 shadow-sm" style="backdrop-filter: blur(10px);">
                        <span class="badge bg-success rounded-pill me-2">ALUMNI SUCCESS</span>
                        <small class="fw-bold text-white-50">Inspirasi SMK Ibnu Sina</small>
                    </div>
                    
                    <h2 class="fw-900 display-4 mb-4 text-white" style="line-height: 1.1; letter-spacing: -2.5px;">
                        Jejak Karir <br><span style="color: #4ade80;">Generasi Hebat.</span>
                    </h2>
                    
                    <p class="text-white-50 fs-5 mb-5 pe-lg-5 lh-base">
                        Simak bagaimana lulusan terbaik kami berkontribusi nyata di dunia industri global dan membawa nama baik almamater.
                    </p>
                    
                    <a href="alumni.php" class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow-lg py-3 transition-up border-0" style="color: #064e3b;">
                        KISAH SUKSES LAINNYA
                    </a>
                </div>

                <div class="col-lg-7">
                    <div class="row g-4">
                        <?php
                        $query_home_alumni = mysqli_query($koneksi, "SELECT a.*, j.nama_jurusan FROM alumni a JOIN jurusan j ON a.jurusan_id = j.id ORDER BY a.id DESC LIMIT 2");
                        while ($row = mysqli_fetch_assoc($query_home_alumni)) :
                            $tampil_foto = (!empty($row['foto'])) ? "assets/img/alumni/".$row['foto'] : "https://ui-avatars.com/api/?name=".urlencode($row['nama'])."&background=10b981&color=fff";
                        ?>
                        <div class="col-md-6">
                            <div class="glass-alumni-card p-4 p-md-5 rounded-5 h-100 d-flex flex-column justify-content-between shadow-lg">
                                <div class="quote-icon mb-4 text-success opacity-50"><i class="bi bi-quote fs-1"></i></div>
                                
                                <p class="text-white fw-medium lh-lg mb-4" style="font-size: 1.1rem; font-style: italic;">
                                    "<?php echo substr($row['testimoni'], 0, 130); ?>..."
                                </p>
                                
                                <div class="d-flex align-items-center gap-3 pt-4 border-top border-white border-opacity-10">
                                    <img src="<?php echo $tampil_foto; ?>" class="rounded-circle shadow-lg" style="width: 60px; height: 60px; object-fit: cover; border: 2px solid rgba(255,255,255,0.3);">
                                    <div>
                                        <h6 class="fw-800 text-white mb-0"><?php echo $row['nama']; ?></h6>
                                        <small class="fw-bold text-uppercase" style="font-size: 0.75rem; color: #4ade80 !important;"><?php echo $row['nama_jurusan']; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<style>
    /* Mengatur transparansi kartu agar 'kontras' dengan background section yang solid */
    .glass-alumni-card { 
        background: rgba(255, 255, 255, 0.08) !important; 
        backdrop-filter: blur(25px); 
        border: 1px solid rgba(255, 255, 255, 0.15); 
        transition: all 0.4s ease; 
    }
    
    .glass-alumni-card:hover { 
        background: rgba(255, 255, 255, 0.12) !important; 
        transform: translateY(-10px); 
        border-color: rgba(74, 222, 128, 0.4); /* Highlight warna hijau terang saat hover */
    }

    /* Penyesuaian warna teks deskripsi agar tidak terlalu kontras menyakitkan mata */
    .text-white-50 {
        color: rgba(255, 255, 255, 0.7) !important;
    }
</style>

    <style>
        .text-gradient-green { background: linear-gradient(135deg, #064e3b 0%, #10b981 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .animate-blob { animation: blob-bounce 8s infinite alternate; }
        @keyframes blob-bounce { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(40px, -60px) scale(1.1); } }
        .animation-delay-2000 { animation-delay: 2s; }
        .glass-alumni-card { background: rgba(255, 255, 255, 0.04) !important; backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.08); transition: all 0.4s ease; }
        .glass-alumni-card:hover { background: rgba(255, 255, 255, 0.08) !important; transform: translateY(-12px); border-color: rgba(16, 185, 129, 0.3); }
        .fw-900 { font-weight: 900; } .fw-800 { font-weight: 800; }
        .transition-up { transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1); }
        .transition-up:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(0,0,0,0.1) !important; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        .animate-float { animation: float 4s ease-in-out infinite; }
        .animate-float-slow { animation: float 6s ease-in-out infinite; }
        .pulse { animation: pulse-red 2s infinite; }
        @keyframes pulse-red { 0% { box-shadow: 0 0 0 0px rgba(220, 53, 69, 0.4); } 100% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); } }
        .announcement-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
    </style>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll('.counter');
        const speed = 40;
        counters.forEach(counter => {
            const updateCount = () => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const inc = target / speed;
                if (count < target) {
                    counter.innerText = Math.ceil(count + inc);
                    setTimeout(updateCount, 30);
                } else { counter.innerText = target; }
            };
            updateCount();
        });
    });
    </script>
</main>

<?php include 'includes/footer.php'; ?>