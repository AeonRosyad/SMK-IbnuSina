<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Query disesuaikan: Mengambil status_kerja yang diinput dari tracer-study.php
$query = mysqli_query($koneksi, "SELECT a.*, j.nama_jurusan 
                                 FROM alumni a 
                                 JOIN jurusan j ON a.jurusan_id = j.id 
                                 ORDER BY a.tahun_lulus DESC, a.nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Database Alumni - SMK IBNU SINA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .wrapper { display: flex; align-items: stretch; }
        #sidebar { min-width: 280px; max-width: 280px; background: #ffffff; height: 100vh; position: sticky; top: 0; border-right: 1px solid #e2e8f0; padding: 30px; }
        #content { width: 100%; padding: 40px; }
    </style>
</head>
<body class="bg-light">

<div class="wrapper">
    <?php include 'sidebar.php'; ?>

    <div id="content">
        <header class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h2 class="fw-900 text-dark mb-1">Database Alumni</h2>
                <p class="text-secondary fw-bold">Manajemen data lulusan hasil Tracer Study.</p>
            </div>
            <div class="d-flex gap-2">
                <button onclick="window.print()" class="btn btn-outline-dark px-4 py-2 rounded-pill fw-bold">
                    <i class="bi bi-printer me-2"></i> Cetak Laporan
                </button>
            </div>
        </header>

        <div class="modern-card p-4 border-0 shadow-sm bg-white rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="border-0 px-4 py-3">Alumni</th>
                            <th class="border-0 py-3">Jurusan & Angkatan</th>
                            <th class="border-0 py-3">Status & Instansi</th>
                            <th class="border-0 py-3 text-end px-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($query)) : 
                            $foto = (!empty($row['foto'])) ? "../assets/img/alumni/".$row['foto'] : "https://ui-avatars.com/api/?name=".urlencode($row['nama'])."&background=10b981&color=fff";
                        ?>
                        <tr>
                            <td class="px-4">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="<?php echo $foto; ?>" class="rounded-circle object-fit-cover" style="width: 45px; height: 45px; border: 2px solid #ecfdf5;">
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0"><?php echo $row['nama']; ?></h6>
                                        <small class="text-muted">ID: #ALM-<?php echo $row['id']; ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-dark d-block"><?php echo $row['nama_jurusan']; ?></span>
                                <small class="text-success fw-bold">Lulusan <?php echo $row['tahun_lulus']; ?></small>
                            </td>
                            <td>
                                <?php 
                                // Label warna disesuaikan dengan status_kerja di proses-tracer.php
                                $status_labels = [
                                    'Bekerja' => 'bg-primary-subtle text-primary',
                                    'Kuliah' => 'bg-info-subtle text-info',
                                    'Wirausaha' => 'bg-warning-subtle text-warning',
                                    'Mencari Kerja' => 'bg-secondary-subtle text-secondary'
                                ];
                                $label_class = $status_labels[$row['status_kerja']] ?? 'bg-light text-dark';
                                ?>
                                <span class="badge <?php echo $label_class; ?> rounded-pill px-3 py-2 mb-1 d-inline-block">
                                    <?php echo $row['status_kerja']; ?>
                                </span>
                                <small class="d-block text-muted" style="font-size: 0.75rem;">@ <?php echo $row['nama_instansi']; ?></small>
                            </td>
                            <td class="text-end px-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="hapus-alumni.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-light rounded-3 text-danger" onclick="return confirm('Hapus data ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>