<?php 
include 'config/koneksi.php';
include 'includes/header.php'; 
?>

<main class="bg-white pb-5">
    <section class="py-5" style="background: radial-gradient(circle at 0% 100%, #ecfdf5 0%, #ffffff 100%);">
        <div class="container py-4 text-center">
            <div class="badge bg-success-subtle text-success px-3 py-2 rounded-pill mb-3 fw-bold">TRACER STUDY</div>
            <h1 class="fw-900 text-dark mb-2" style="font-size: 3rem; letter-spacing: -2px;">Update Data <span class="text-success">Alumni.</span></h1>
            <p class="text-secondary mx-auto" style="max-width: 600px;">Kontribusi Anda dalam memperbarui data sangat berharga untuk pengembangan mutu pendidikan di SMK IBNU SINA Genteng.</p>
        </div>
    </section>

    <section class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="registration-card p-5 shadow-sm border-0 bg-white rounded-5">
                    <form action="proses-tracer.php" method="POST" enctype="multipart/form-data">
                        <h5 class="fw-800 text-dark mb-4 border-bottom pb-2">Identitas Alumni</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control-modern w-100" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tahun Lulus</label>
                                <input type="number" name="tahun_lulus" class="form-control-modern w-100" placeholder="Contoh: 2023" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Jurusan</label>
                                <select name="jurusan_id" class="form-control-modern w-100" required>
                                    <option value="">Pilih Jurusan</option>
                                    <?php 
                                    $q_jur = mysqli_query($koneksi, "SELECT * FROM jurusan");
                                    while($j = mysqli_fetch_array($q_jur)){
                                        echo "<option value='".$j['id']."'>".$j['nama_jurusan']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <h5 class="fw-800 text-dark mb-4 border-bottom pb-2">Status & Karir</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Status Saat Ini</label>
                                <select name="status_alumni" class="form-control-modern w-100" required>
                                    <option value="Bekerja">Bekerja</option>
                                    <option value="Kuliah">Kuliah</option>
                                    <option value="Wirausaha">Wirausaha</option>
                                    <option value="Mencari Kerja">Mencari Kerja</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Instansi / Usaha</label>
                                <input type="text" name="nama_instansi" class="form-control-modern w-100" placeholder="Nama Perusahaan/Kampus">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Testimoni untuk Sekolah</label>
                                <textarea name="testimoni" class="form-control-modern w-100" rows="3" placeholder="Bagikan pengalaman singkat Anda selama bersekolah..."></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-bold">Foto Profil (Opsional)</label>
                                <input type="file" name="foto" class="form-control w-100">
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow">Kirim Data Alumni</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>