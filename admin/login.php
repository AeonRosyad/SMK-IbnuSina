<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SMK IBNU SINA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="modern-card p-5 shadow-lg border-0 bg-white" style="max-width: 400px; width: 100%;">
            <div class="text-center mb-4">
                <img src="../assets/img/logo.png" alt="Logo" height="60" class="mb-3">
                <h4 class="fw-900 text-dark">Panel Admin</h4>
                <p class="text-muted small">Silakan masuk untuk mengelola konten</p>
            </div>
            
            <form action="proses-login.php" method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold small">Username</label>
                    <input type="text" name="username" class="form-control-modern w-100" required>
                </div>
                <div class="mb-4">
                    <label class="form-label fw-bold small">Password</label>
                    <input type="password" name="password" class="form-control-modern w-100" required>
                </div>
                <button type="submit" class="btn btn-success w-100 py-3 rounded-pill fw-bold shadow">
                    Masuk ke Dashboard
                </button>
            </form>
            <div class="text-center mt-4">
                <a href="../index.php" class="text-decoration-none small text-success fw-bold">← Kembali ke Website</a>
            </div>
        </div>
    </div>
</body>
</html>