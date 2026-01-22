<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 100% 0%, #ecfdf5 0%, #ffffff 100%);">
        <div class="container py-4 text-center">
            <div class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-3 fw-bold">SUMBER DAYA MANUSIA</div>
            <h1 class="fw-900 text-dark mb-2" style="font-size: 3rem; letter-spacing: -2px;">Tenaga <span class="text-success">Pendidik.</span></h1>
            <p class="text-secondary mx-auto" style="max-width: 700px;">Mengenal lebih dekat para pengajar dan staf profesional SMK IBNU SINA Genteng yang berdedikasi tinggi.</p>
        </div>
    </section>

    <section class="container mt-4">
        <div class="row g-4 justify-content-center">
            <?php
            // Jalur gambar disesuaikan dengan folder di panel admin
            $path_guru = "assets/img/guru/";
            
            // Query mengambil data dari tabel tenaga_pendidik yang berstatus Aktif
            // Diurutkan berdasarkan kategori (Pimpinan dulu, lalu Guru, lalu Staf)
            $query_guru = mysqli_query($koneksi, "SELECT * FROM tenaga_pendidik 
                                                  WHERE status_aktif = 'Aktif' 
                                                  ORDER BY FIELD(kategori, 'Pimpinan', 'Guru', 'Staf TU'), nama ASC");
            
            if (mysqli_num_rows($query_guru) > 0) {
                while ($row = mysqli_fetch_assoc($query_guru)) {
                    $foto_file = $path_guru . $row['foto'];
                    // Cek ketersediaan file foto, jika tidak ada gunakan avatar inisial
                    $tampil_foto = (!empty($row['foto']) && file_exists($foto_file)) 
                                   ? $foto_file 
                                   : "https://ui-avatars.com/api/?name=".urlencode($row['nama'])."&background=064e3b&color=fff&size=128";
            ?>
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="staff-card shadow-sm border-0 rounded-4 overflow-hidden bg-white text-center p-3 transition-up">
                        <div class="staff-img-wrapper mb-3 mx-auto" style="width: 120px; height: 120px; overflow: hidden; border-radius: 50%;">
                            <img src="<?php echo $tampil_foto; ?>" class="img-fluid" alt="<?php echo $row['nama']; ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <span class="badge bg-light text-success mb-2 px-3 rounded-pill border small"><?php echo $row['kategori']; ?></span>
                        <h6 class="fw-800 text-dark mb-1" style="font-size: 1rem;"><?php echo $row['nama']; ?></h6>
                        <p class="text-muted small mb-1"><?php echo $row['jabatan']; ?></p>
                        <?php if(!empty($row['nip'])): ?>
                            <small class="text-secondary d-block" style="font-size: 0.75rem;">NIP. <?php echo $row['nip']; ?></small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php 
                }
            } else {
                echo '<div class="text-center py-5 col-12"><p class="text-muted">Data tenaga pendidik belum tersedia saat ini.</p></div>';
            }
            ?>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>