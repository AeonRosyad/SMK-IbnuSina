<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 

// Logika Pencarian & Filter
$keyword = isset($_GET['q']) ? mysqli_real_escape_string($koneksi, $_GET['q']) : '';
$filter_kategori = isset($_GET['kategori']) ? mysqli_real_escape_string($koneksi, $_GET['kategori']) : '';

$query_str = "SELECT * FROM agenda WHERE (judul LIKE '%$keyword%' OR lokasi LIKE '%$keyword%')";
if ($filter_kategori != '') {
    $query_str .= " AND kategori = '$filter_kategori'";
}
$query_str .= " ORDER BY tanggal DESC";
$query_all_agenda = mysqli_query($koneksi, $query_str);
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 100% 0%, #ecfdf5 0%, #ffffff 100%);">
        <div class="container py-4">
            <h1 class="fw-900 text-dark mb-2" style="font-size: 3rem; letter-spacing: -2px;">Kalender <span class="text-success">Agenda.</span></h1>
            <p class="text-secondary">Daftar lengkap seluruh kegiatan dan event resmi di SMK IBNU SINA.</p>
        </div>
    </section>

    <section class="container mt-n4">
        <div class="registration-card p-4 mb-5 shadow-sm bg-white">
            <form action="" method="GET" class="row g-3">
                <div class="col-lg-5">
                    <div class="search-box-agenda d-flex align-items-center">
                        <i class="bi bi-search text-muted me-3"></i>
                        <input type="text" name="q" class="border-0 w-100" style="outline: none;" placeholder="Cari nama kegiatan atau lokasi..." value="<?php echo $keyword; ?>">
                    </div>
                </div>
                <div class="col-lg-3">
                    <select name="kategori" class="form-select border-0 bg-light p-3 rounded-4 fw-bold text-success">
                        <option value="">Semua Kategori</option>
                        <option value="Akademik" <?php if($filter_kategori == 'Akademik') echo 'selected'; ?>>Akademik</option>
                        <option value="Kesiswaan" <?php if($filter_kategori == 'Kesiswaan') echo 'selected'; ?>>Kesiswaan</option>
                        <option value="Pesantren" <?php if($filter_kategori == 'Pesantren') echo 'selected'; ?>>Pesantren</option>
                        <option value="Umum" <?php if($filter_kategori == 'Umum') echo 'selected'; ?>>Umum</option>
                    </select>
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-success w-100 p-3 rounded-4 fw-bold">Filter</button>
                </div>
                <div class="col-lg-2">
                    <a href="semua-agenda.php" class="btn btn-light w-100 p-3 rounded-4 fw-bold">Reset</a>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php
                if (mysqli_num_rows($query_all_agenda) > 0) {
                    while ($row = mysqli_fetch_assoc($query_all_agenda)) {
                        $tgl = strtotime($row['tanggal']);
                        $hari = date('d', $tgl);
                        $bulan_tahun = date('M Y', $tgl);
                        
                        // Badge Color Logic
                        $badge_class = ($row['status'] == 'Mendatang') ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary';
                ?>
                    <div class="agenda-item-list d-flex flex-column flex-md-row align-items-md-center gap-4">
                        <div class="date-box flex-shrink-0 mx-auto mx-md-0">
                            <span class="day"><?php echo $hari; ?></span>
                            <span class="month"><?php echo $bulan_tahun; ?></span>
                        </div>
                        
                        <div class="flex-grow-1 text-center text-md-start">
                            <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-2 mb-2">
                                <span class="agenda-category"><?php echo $row['kategori']; ?></span>
                                <span class="status-badge <?php echo $badge_class; ?>"><?php echo $row['status']; ?></span>
                            </div>
                            <h4 class="fw-800 text-dark mb-2"><?php echo $row['judul']; ?></h4>
                            <div class="d-flex flex-wrap justify-content-center justify-content-md-start gap-4">
                                <span class="text-muted small"><i class="bi bi-clock me-2 text-success"></i> <?php echo $row['jam']; ?></span>
                                <span class="text-muted small"><i class="bi bi-geo-alt me-2 text-success"></i> <?php echo $row['lokasi']; ?></span>
                            </div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-light rounded-pill px-4 fw-bold text-success border-success-subtle">Ingatkan Saya</button>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo '
                    <div class="text-center py-5">
                        <img src="https://illustrations.popsy.co/emerald/searching.svg" style="width: 200px;" class="mb-4">
                        <h4 class="fw-800 text-dark">Agenda tidak ditemukan</h4>
                        <p class="text-muted">Coba gunakan kata kunci lain atau reset filter kategori.</p>
                    </div>';
                }
                ?>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>