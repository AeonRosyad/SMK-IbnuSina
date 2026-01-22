<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 0% 100%, #f0fdf4 0%, #ffffff 100%);">
        <div class="container py-4 text-center">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-3 fw-bold">DOKUMENTASI</span>
            <h1 class="fw-900 text-dark mb-2" style="font-size: 3rem; letter-spacing: -2px;">Galeri <span class="text-success">Kegiatan.</span></h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Momen berharga dan dokumentasi berbagai aktivitas di SMK IBNU SINA Genteng.</p>
        </div>
    </section>

    <section class="container">
        <div class="row g-4">
            <?php
            $query_galeri = mysqli_query($koneksi, "SELECT * FROM galeri ORDER BY tanggal_upload DESC");
            if (mysqli_num_rows($query_galeri) > 0) {
                while ($row = mysqli_fetch_assoc($query_galeri)) :
                    $foto_path = "assets/img/galeri/" . $row['foto'];
            ?>
                <div class="col-lg-4 col-md-6 animate-up">
                    <div class="gallery-card position-relative overflow-hidden rounded-5 shadow-sm h-100">
                        <img src="<?php echo $foto_path; ?>" class="img-fluid w-100 h-100 object-fit-cover transition-up" style="min-height: 250px;" alt="<?php echo $row['judul']; ?>">
                        
                        <div class="gallery-overlay position-absolute bottom-0 start-0 w-100 p-4 text-white d-flex flex-column justify-content-end">
                            <span class="badge bg-success rounded-pill mb-2 align-self-start" style="font-size: 0.7rem;"><?php echo strtoupper($row['kategori']); ?></span>
                            <h5 class="fw-800 mb-0"><?php echo $row['judul']; ?></h5>
                            <small class="opacity-75"><?php echo date('d M Y', strtotime($row['tanggal_upload'])); ?></small>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile;
            } else {
                echo '<div class="col-12 text-center py-5"><p class="text-muted">Belum ada foto yang diunggah.</p></div>';
            }
            ?>
        </div>
    </section>
</main>

<style>
    .fw-900 { font-weight: 900; }
    .fw-800 { font-weight: 800; }
    
    .gallery-card {
        cursor: pointer;
        background: #f8fafc;
        height: 300px;
    }

    .gallery-overlay {
        background: linear-gradient(to top, rgba(6, 78, 89, 0.9) 0%, transparent 100%);
        height: 100%;
        opacity: 0;
        transition: all 0.4s ease;
        transform: translateY(20px);
    }

    .gallery-card:hover .gallery-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .gallery-card:hover img {
        transform: scale(1.1);
    }

    .transition-up {
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .animate-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<?php include 'includes/footer.php'; ?>