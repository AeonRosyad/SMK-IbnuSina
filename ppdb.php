<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="ppdb-hero">
        <div class="container text-center">
            <div class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-4 fw-bold">ONLINE REGISTRATION</div>
            <h1 class="display-4 fw-900 mb-4" style="color: #064e3b; letter-spacing: -2px;">Bergabung Bersama <br><span class="text-success">SMK IBNU SINA.</span></h1>
            <p class="text-secondary fs-5 mx-auto" style="max-width: 600px;">Isi formulir di bawah ini dengan data yang benar untuk memulai perjalanan pendidikan Anda di sekolah digital masa depan.</p>
        </div>
    </section>

    <section class="container mt-n4">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="registration-card">
                    <form action="proses_ppdb.php" method="POST">
                        
                        <div class="d-flex align-items-center mb-5">
                            <div class="stepper-badge">1</div>
                            <h4 class="fw-800 text-dark mb-0">Identitas Calon Siswa</h4>
                        </div>
                        
                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <label class="form-label">Nama Lengkap Sesuai Ijazah</label>
                                <input type="text" name="nama" class="form-control-modern w-100" placeholder="Contoh: Ahmad Fauzi" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tmp_lahir" class="form-control-modern w-100" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control-modern w-100" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jk" class="form-control-modern w-100" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">No. WhatsApp Aktif</label>
                                <input type="tel" name="whatsapp" class="form-control-modern w-100" placeholder="0812xxxx" required>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-5">
                            <div class="stepper-badge">2</div>
                            <h4 class="fw-800 text-dark mb-0">Akademik & Minat</h4>
                        </div>

                        <div class="row g-4 mb-5">
                            <div class="col-md-12">
                                <label class="form-label">Asal Sekolah (SMP/MTs)</label>
                                <input type="text" name="asal_sekolah" class="form-control-modern w-100" placeholder="Contoh: MTs Hidayatul Mubtadi'in" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Pilihan Jurusan Utama</label>
                                <select name="jurusan1" class="form-control-modern w-100" required>
                                    <option value="">Pilih Jurusan</option>
                                    <option value="TKJ">Teknik Komputer & Jaringan</option>
                                    <option value="TBSM">Teknik Bisnis Sepeda Motor</option>
                                    <option value="APHPI">Agribisnis Pengolahan Hasil Pertanian</option>
                                    <option value="LPS">Layanan Perbankan Syariah</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Program Pesantren?</label>
                                <select name="asrama" class="form-control-modern w-100" required>
                                    <option value="Tidak">Hanya Sekolah (Laju)</option>
                                    <option value="Ya">Sekolah + Mondok (Pesantren)</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg px-5 py-3 rounded-pill fw-bold shadow-lg">
                                Kirim Pendaftaran Sekarang <i class="bi bi-send ms-2"></i>
                            </button>
                            <p class="text-muted small mt-4">Data Anda akan kami jaga kerahasiaannya sesuai kebijakan privasi SMK IBNU SINA.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>