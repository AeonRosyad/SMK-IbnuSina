<nav id="sidebar">
    <div class="sidebar-header text-center mb-5">
        <img src="../assets/img/logo.png" alt="Logo" height="60" class="mb-3">
        <h6 class="fw-900 text-dark mb-0 ls-1">SMK IBNU SINA</h6>
        <span class="badge bg-success-subtle text-success rounded-pill px-3 mt-2 fw-bold">ADMIN PANEL</span>
    </div>

    <ul class="nav nav-pills flex-column mb-auto">
        <?php $current = basename($_SERVER['PHP_SELF']); ?>
        
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link <?php echo ($current == 'dashboard.php') ? 'active' : ''; ?>">
                <i class="bi bi-grid-fill me-3"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="kelola-jurusan.php" class="nav-link <?php echo ($current == 'kelola-jurusan.php') ? 'active' : ''; ?>">
                <i class="bi bi-stack me-3"></i> Jurusan
            </a>
        </li>
        <li>
            <a href="kelola-guru.php" class="nav-link <?php echo ($current == 'kelola-guru.php') ? 'active' : ''; ?>">
                <i class="bi bi-person-badge-fill me-3"></i> Tendik
            </a>
        </li>
        <li>
            <a href="kelola-siswa.php" class="nav-link <?php echo ($current == 'kelola-siswa.php') ? 'active' : ''; ?>">
                <i class="bi bi-people-fill me-3"></i> Peserta Didik
            </a>
        </li>
        <li>
            <a href="kelola-alumni.php" class="nav-link <?php echo ($current == 'kelola-alumni.php') ? 'active' : ''; ?>">
                <i class="bi bi-mortarboard-fill me-3"></i> Alumni
            </a>
        </li>

        <li>
            <a href="kelola-berita.php" class="nav-link <?php echo ($current == 'kelola-berita.php') ? 'active' : ''; ?>">
                <i class="bi bi-newspaper me-3"></i> Berita
            </a>
        </li>
        <li>
            <a href="kelola-warta.php" class="nav-link <?php echo ($current == 'kelola-warta.php') ? 'active' : ''; ?>">
                <i class="bi bi-info-circle-fill me-3"></i> Warta Sekolah
            </a>
        </li>
        <li>
            <a href="kelola-galeri.php" class="nav-link <?php echo ($current == 'kelola-galeri.php') ? 'active' : ''; ?>">
                <i class="bi bi-images me-3"></i> Galeri Foto
            </a>
        </li>
        <li>
            <a href="kelola-video.php" class="nav-link <?php echo ($current == 'kelola-video.php') ? 'active' : ''; ?>">
                <i class="bi bi-play-btn-fill me-3"></i> Video Kegiatan
            </a>
        </li>
        <li>
            <a href="kelola-prestasi.php" class="nav-link <?php echo ($current == 'kelola-prestasi.php') ? 'active' : ''; ?>">
                <i class="bi bi-trophy-fill me-3"></i> Prestasi
            </a>
        </li>
    </ul>

    <div class="mt-auto pt-4 border-top">
        <a href="logout.php" class="nav-link text-danger fw-bold d-flex align-items-center">
            <i class="bi bi-power fs-5 me-3"></i> Keluar
        </a>
    </div>
</nav>