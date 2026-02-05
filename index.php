<?php
include 'auth.php';
include '../config/koneksi.php';
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");


// hitung data
$admin = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_admin"));
$siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_siswa"));
$kategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_kategori"));
$aspirasi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM tb_aspirasi"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>

    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">

    <link rel="stylesheet" href="../asset/css/admin.css">

</head>
<div class="d-flex" style="min-height:100vh">

   <div class="sidebar-gradient sidebar-animated p-3" style="width:260px">

    <h5 class="text-center mb-4 text-white">Admin Panel</h5>

    <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item active">
            🏠 Dashboard
        </a>
        <a href="data_admin.php" class="list-group-item ">
            👤 Data Admin
        </a>
        <a href="data_siswa.php" class="list-group-item">
            👥 Data Siswa
        </a>
        <a href="data_kategori.php" class="list-group-item ">
            📂 Data Kategori
        </a>
        <a href="data_aspirasi.php" class="list-group-item ">
            🗣️ Data Aspirasi
        </a>
    </div>

</div>

    <div class="flex-fill bg-light">
        <div class="sidebar-gradient sidebar-animated p-3">

        <nav class="navbar navbar-light navbar-rounded px-4">
            <span class="navbar-text fw-semibold">
                Dashboard
            </span>
            <a href="logout.php" class="btn btn-sm btn-danger">
                Logout
            </a>
        </nav>
    

<body >
    <nav class="navbar navbar-light px-4 py-3">  
</nav>


    <div class="row g-5">
    

        <div class="col-md-6">
        <div class="card shadow-sm dashboard-card">
                <div class="card-body text-center">
                    <h1>👤</h1>
                    <h5 class="card-title">Admin</h5>
                    <h4 class="fw-bold"><?= $admin['total']; ?></h4>
                    <p class="card-text text-muted">Kelola Admin</p>
                    <a href="data_admin.php" class="btn btn-outline-secondary w-100">Kelola</a>

                </div>
            </div>
        </div>

        <!-- Card Kategori -->
        <div class="col-md-6">
            <div class="card shadow-sm dashboard-card">
                <div class="card-body text-center">
                    <h1>📂</h1>
                    <h5 class="card-title">Kategori</h5>
                    <h4 class="fw-bold"><?= $kategori['total']; ?></h4>
                    <p class="card-text text-muted">Kelola kategori laporan</p>
                    <a href="data_kategori.php" class="btn btn-outline-secondary w-100">
                        Kelola
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm dashboard-card">
                <div class="card-body text-center">
                    <h1>👥</h1>
                    <h5 class="card-title">Siswa</h5>
                    <h4 class="fw-bold"><?= $siswa['total']; ?></h4>
                    <p class="card-text text-muted">Kelola data siswa</p>
                    <a href="data_siswa.php" class="btn btn-outline-secondary w-100">
                        Kelola
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card shadow-sm dashboard-card">
                <div class="card-body text-center">
                    <h1>🗣️</h1>
                    <h5 class="card-title">Aspirasi</h5>
                    <h4 class="fw-bold"><?= $aspirasi['total']; ?></h4>
                    <p class="card-text text-muted">Kelola Aspirasi</p>
                    <a href="data_aspirasi.php" class="btn btn-outline-secondary w-100">
                        Kelola
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="../asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>
