<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 

// 1. Query Total Siswa dengan pengecekan error
$query_total = mysqli_query($koneksi, "SELECT SUM(total_siswa) as grand_total FROM statistik_siswa");

if (!$query_total) {
    die("Query Error (Total): " . mysqli_error($koneksi));
}

$data_total = mysqli_fetch_assoc($query_total);
$grand_total = $data_total['grand_total'] ?? 0;
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 0% 100%, #f0fdf4 0%, #ffffff 100%);">
        <div class="container py-4 text-center">
            <h1 class="fw-900 text-dark mb-2" style="font-size: 3rem; letter-spacing: -2px;">Data <span class="text-success">Peserta Didik.</span></h1>
            <div class="d-inline-block mt-4 p-3 bg-white shadow-sm rounded-4 border">
                <h3 class="fw-900 text-success mb-0"><?php echo number_format($grand_total); ?></h3>
                <small class="text-muted fw-bold text-uppercase">Total Siswa Aktif</small>
            </div>
        </div>
    </section>

    <section class="container mt-5">
        <div class="row g-4">
            <?php
            // 1. Query Detail Jurusan dengan JOIN yang disinkronkan
            // Pastikan tabel dan kolom sesuai dengan yang dibuat di admin
            $sql_stats = "SELECT s.*, j.nama_jurusan 
                        FROM statistik_siswa s 
                        JOIN jurusan j ON s.id_jurusan = j.id 
                        ORDER BY s.siswa_l + s.siswa_p DESC"; // Urutkan berdasarkan total siswa
            
            $query_stats = mysqli_query($koneksi, $sql_stats);

            if (!$query_stats) {
                echo "<div class='alert alert-danger'>Kesalahan Query: " . mysqli_error($koneksi) . "</div>";
            } else {
                if (mysqli_num_rows($query_stats) > 0) {
                    while ($row = mysqli_fetch_assoc($query_stats)) {
                        // Hitung total secara dinamis dari database
                        $total_per_jurusan = $row['siswa_l'] + $row['siswa_p'];
            ?>
                <div class="col-lg-4">
                    <div class="stats-card h-100 shadow-sm border-0 bg-white p-4 rounded-5 transition-up">
                        <h5 class="fw-800 text-dark mb-1"><?php echo $row['nama_jurusan']; ?></h5>
                        <p class="text-muted small mb-4">Statistik Peserta Didik Aktif</p>
                        
                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-4 text-center border-0">
                                    <small class="text-primary d-block small fw-bold mb-1">
                                        <i class="bi bi-gender-male"></i> Laki-laki
                                    </small>
                                    <span class="fw-900 text-dark h4 mb-0"><?php echo number_format($row['siswa_l']); ?></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded-4 text-center border-0">
                                    <small class="text-danger d-block small fw-bold mb-1">
                                        <i class="bi bi-gender-female"></i> Perempuan
                                    </small>
                                    <span class="fw-900 text-dark h4 mb-0"><?php echo number_format($row['siswa_p']); ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top border-light">
                            <span class="small fw-bold text-secondary text-uppercase">Total Kekuatan</span>
                            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-900">
                                <?php echo number_format($total_per_jurusan); ?> Siswa
                            </span>
                        </div>
                    </div>
                </div>
            <?php 
                    }
                } else {
                    // Tampilan jika data masih kosong di database
                    echo '<div class="col-12 text-center py-5">
                            <p class="text-muted">Data statistik siswa belum tersedia.</p>
                        </div>';
                }
            } 
            ?>
        </div>
    </section>
</main>
<style>
    .transition-up { transition: all 0.3s ease; border: 1px solid transparent; }
    .transition-up:hover { transform: translateY(-10px); border-color: #10b981; }
    .fw-800 { font-weight: 800; }
    .fw-900 { font-weight: 900; }
</style>

<?php include 'includes/footer.php'; ?>