<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="pesantren-hero text-center mb-5">
        <div class="container">
            <div class="badge bg-white text-success px-3 py-2 rounded-pill mb-4 fw-bold shadow-sm">PONDOK PESANTREN MODERN IBNU SINA</div>
            <h1 class="display-3 fw-900 mb-4" style="letter-spacing: -2px;">Membentuk Karakter <br><span class="text-warning">Berbasis Qur'ani.</span></h1>
            <p class="lead opacity-90 mx-auto" style="max-width: 700px;">Integrasi pendidikan vokasi SMK dengan pendalaman nilai-nilai agama untuk mencetak generasi yang mahir teknologi dan teguh dalam iman.</p>
        </div>
    </section>

    <section class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="assets/img/pesantren-activity.jpg" class="img-fluid rounded-5 shadow-lg" alt="Kegiatan Santri" onerror="this.src='https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?q=80&w=800';">
            </div>
            <div class="col-lg-6 ps-lg-5">
                <h2 class="fw-900 text-dark mb-4">Adab Dahulu, <br><span class="text-success">Baru Ilmu.</span></h2>
                <div class="quote-box mb-4">
                    "Kami percaya bahwa keahlian teknologi tanpa pondasi spiritual yang kuat akan kehilangan arah. Di sini, santri dididik untuk menjadi ahli IT yang bertakwa."
                </div>
                <p class="text-secondary lh-lg">Pesantren IBNU SINA menggunakan metode pengajaran interaktif termasuk penggunaan metode **Qiroati** terbaru untuk percepatan baca tulis Al-Quran.</p>
            </div>
        </div>
    </section>

    <section class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-900 text-dark">Program <span class="text-success">Kasantrian</span></h2>
            <div class="bg-success mx-auto mt-2" style="width: 60px; height: 4px; border-radius: 10px;"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="program-card">
                    <div class="icon-box-islamic"><i class="bi bi-book-half"></i></div>
                    <h5 class="fw-800 text-dark mb-3">Tahfidz Qur'an</h5>
                    <p class="text-muted small lh-lg mb-0">Program hafalan Al-Quran dengan target capaian yang terukur dan bimbingan ustadz berpengalaman.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="program-card">
                    <div class="icon-box-islamic"><i class="bi bi-translate"></i></div>
                    <h5 class="fw-800 text-dark mb-3">Bahasa Arab & Inggris</h5>
                    <p class="text-muted small lh-lg mb-0">Pembiasaan komunikasi harian menggunakan bahasa resmi internasional untuk menunjang karir global.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="program-card">
                    <div class="icon-box-islamic"><i class="bi bi-stars"></i></div>
                    <h5 class="fw-800 text-dark mb-3">Kajian Kitab Kuning</h5>
                    <p class="text-muted small lh-lg mb-0">Pendalaman khazanah keilmuan Islam klasik melalui kitab-kitab muktabar dengan pendekatan modern.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #f8fafc;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="bg-white p-5 rounded-5 shadow-sm">
                        <h3 class="fw-900 text-center text-dark mb-5">Agenda Rutin <span class="text-success">Santri</span></h3>
                        <div class="row g-4">
                            <div class="col-md-6 border-end">
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between mb-3"><strong>04:00 - 05:00</strong> <span class="text-muted small">Shalat Subuh & Tahfidz</span></li>
                                    <li class="d-flex justify-content-between mb-3"><strong>07:00 - 13:30</strong> <span class="text-muted small">Pembelajaran SMK</span></li>
                                    <li class="d-flex justify-content-between mb-3"><strong>15:30 - 17:00</strong> <span class="text-muted small">Kajian Madin</span></li>
                                </ul>
                            </div>
                            <div class="col-md-6 ps-md-4">
                                <ul class="list-unstyled">
                                    <li class="d-flex justify-content-between mb-3"><strong>18:30 - 20:00</strong> <span class="text-muted small">Diniyah Malam</span></li>
                                    <li class="d-flex justify-content-between mb-3"><strong>20:00 - 21:00</strong> <span class="text-muted small">Belajar Mandiri/IT</span></li>
                                    <li class="d-flex justify-content-between mb-3"><strong>21:30</strong> <span class="text-muted small">Istirahat Malam</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>