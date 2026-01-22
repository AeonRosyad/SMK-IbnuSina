<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 0% 100%, #ecfdf5 0%, #ffffff 100%);">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="d-inline-flex align-items-center bg-white border border-success-subtle rounded-pill px-3 py-1 mb-4 shadow-sm">
                        <span class="badge bg-success rounded-pill me-2">FASILITAS</span>
                        <small class="fw-bold text-success">Lingkungan Belajar Modern</small>
                    </div>
                    <h1 class="premium-heading mb-4" style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; color: #064e3b; letter-spacing: -2px;">
                        Sarana & <br><span class="text-success">Prasarana Unggulan.</span>
                    </h1>
                    <p class="text-secondary fs-5">Kami menyediakan fasilitas berstandar industri untuk mendukung kenyamanan dan kreativitas belajar siswa SMK IBNU SINA.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="row g-4">
            <?php
            // Data Dummy Fasilitas (Bisa ditarik dari database jika sudah ada tabelnya)
            $fasilitas = [
                [
                    'nama' => 'Laboratorium Komputer TKJ',
                    'kategori' => 'RUANG PRAKTIK',
                    'icon' => 'bi-cpu',
                    'deskripsi' => 'Dilengkapi dengan perangkat server terbaru, mikrotik, dan fiber optik standar industri.',
                    'gambar' => 'lab-tkj.jpg'
                ],
                [
                    'nama' => 'Bengkel Otomotif Modern',
                    'kategori' => 'RUANG PRAKTIK',
                    'icon' => 'bi-tools',
                    'deskripsi' => 'Area praktik luas dengan alat scan engine dan peralatan servis modern berstandar bengkel resmi.',
                    'gambar' => 'bengkel.jpg'
                ],
                [
                    'nama' => 'Perpustakaan Digital',
                    'kategori' => 'FASILITAS UMUM',
                    'icon' => 'bi-book',
                    'deskripsi' => 'Koleksi buku lengkap serta akses e-library yang bisa diakses kapan saja oleh siswa.',
                    'gambar' => 'perpus.jpg'
                ],
                [
                    'nama' => 'Masjid Hidayatul Mubtadi\'in',
                    'kategori' => 'IBADAH',
                    'icon' => 'bi-moon-stars',
                    'deskripsi' => 'Masjid sekolah yang nyaman untuk mendukung kegiatan religius dan karakter santri.',
                    'gambar' => 'masjid.jpg'
                ],
                [
                    'nama' => 'Lapangan Olahraga Multifungsi',
                    'kategori' => 'OLAHRAGA',
                    'icon' => 'bi-trophy',
                    'deskripsi' => 'Area olahraga luar ruangan untuk basket, futsal, dan voli yang representatif.',
                    'gambar' => 'lapangan.jpg'
                ],
                [
                    'nama' => 'Green House & Hidroponik',
                    'kategori' => 'AREA PERTANIAN',
                    'icon' => 'bi-flower1',
                    'deskripsi' => 'Laboratorium alam untuk praktik agribisnis dan pengolahan hasil pertanian.',
                    'gambar' => 'greenhouse.jpg'
                ]
            ];

            foreach ($fasilitas as $f) :
            ?>
            <div class="col-lg-4 col-md-6">
                <div class="facility-card h-100 shadow-sm border-0">
                    <div class="facility-img-wrapper">
                        <img src="assets/img/sarpras/<?php echo $f['gambar']; ?>" 
                             alt="<?php echo $f['nama']; ?>"
                             onerror="this.src='https://images.unsplash.com/photo-1562774053-701939374585?q=80&w=600&auto=format&fit=crop';">
                        <div class="facility-badge text-uppercase"><?php echo $f['kategori']; ?></div>
                    </div>
                    
                    <div class="p-4">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="icon-circle-sarpras">
                                <i class="bi <?php echo $f['icon']; ?>"></i>
                            </div>
                            <h5 class="fw-800 text-dark mb-0" style="font-size: 1.15rem;"><?php echo $f['nama']; ?></h5>
                        </div>
                        <p class="text-muted small lh-lg mb-0">
                            <?php echo $f['deskripsi']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="container py-5">
        <div class="p-5 rounded-5 text-center shadow-lg" style="background: linear-gradient(135deg, #064e3b 0%, #10b981 100%);">
            <h2 class="fw-900 text-white mb-3">Ingin Melihat Secara Langsung?</h2>
            <p class="text-white-50 mb-4 mx-auto" style="max-width: 600px;">Kami mengundang Anda untuk melakukan kunjungan sekolah (School Tour) untuk melihat semua fasilitas kami.</p>
            <a href="kontak.php" class="btn btn-light px-5 py-3 rounded-pill fw-bold text-success">Jadwalkan Kunjungan</a>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>