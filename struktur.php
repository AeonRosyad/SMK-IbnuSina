<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="org-section">
    <div class="container text-center">
        <div class="mb-5">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold mb-3 small">ORGANOGRAM</span>
            <h1 class="premium-heading mb-0" style="font-size: clamp(2.5rem, 5vw, 4rem); font-weight: 900; color: #064e3b; letter-spacing: -2px;">
                Struktur <span class="text-success">Organisasi.</span>
            </h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card-top-management shadow-lg">
                    <div class="img-container-premium shadow-sm">
                        <img src="assets/img/kabid.jpg" alt="Kabid" onerror="this.src='https://ui-avatars.com/api/?name=Kabid+Pendidikan&background=ffffff&color=064e3b&size=128';">
                    </div>
                    <h4 class="fw-900 mb-1">Nama Kabid Pendidikan, M.Pd.</h4>
                    <p class="small opacity-75 mb-0 fw-bold" style="letter-spacing: 2px;">KEPALA BIDANG PENDIDIKAN FORMAL</p>
                    <small class="opacity-50">YAyasan Pendidikan IBNU SINA</small>
                </div>
            </div>
        </div>

        <div class="connector-vertical"></div>

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card-standard border-2 border-success shadow-sm">
                    <div class="img-container-premium">
                        <img src="assets/img/kepsek.jpg" alt="Kepala Sekolah" onerror="this.src='https://ui-avatars.com/api/?name=Kepala+Sekolah&background=10b981&color=fff&size=128';">
                    </div>
                    <span class="badge bg-success text-white px-3 py-2 rounded-pill mb-3 small fw-bold">KEPALA SEKOLAH</span>
                    <h5 class="fw-800 text-dark mb-1">Nama Kepala Sekolah, S.Pd.</h5>
                    <p class="text-muted small mb-0">SMK IBNU SINA GENTENG</p>
                </div>
            </div>
        </div>

        <div class="connector-vertical"></div>

        <div class="row justify-content-center g-4 mb-4">
            <div class="col-md-4 col-lg-3">
                <div class="card-standard bg-light border-0 shadow-sm">
                    <i class="bi bi-people-fill fs-2 text-success mb-3 d-block"></i>
                    <h6 class="fw-bold text-success small mb-2">KOMITE SEKOLAH</h6>
                    <p class="fw-800 text-dark mb-0">Nama Ketua Komite</p>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="card-standard bg-light border-0 shadow-sm">
                    <i class="bi bi-briefcase-fill fs-2 text-success mb-3 d-block"></i>
                    <h6 class="fw-bold text-success small mb-2">KEPALA TATA USAHA</h6>
                    <p class="fw-800 text-dark mb-0">Nama Kepala TU</p>
                </div>
            </div>
        </div>

        <div class="connector-vertical d-none d-md-block"></div>

        <div class="row g-4 mt-2">
            <?php
            $waka = [
                ['Kurikulum', 'bi-journal-check'],
                ['Kesiswaan', 'bi-person-badge'],
                ['Sarana Prasarana', 'bi-building-gear'],
                ['Hubin/Humas', 'bi-broadcast-pin']
            ];
            foreach ($waka as $item) :
            ?>
            <div class="col-6 col-md-3">
                <div class="card-standard shadow-sm border-0">
                    <div class="bg-success-subtle text-success rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 55px; height: 55px;">
                        <i class="bi <?php echo $item[1]; ?> fs-4"></i>
                    </div>
                    <h6 class="fw-bold text-success small mb-2" style="font-size: 0.7rem;">WAKA <?php echo strtoupper($item[0]); ?></h6>
                    <p class="fw-800 text-dark small mb-0">Nama Wakasek</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>