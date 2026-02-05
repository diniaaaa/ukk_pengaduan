<?php
include 'auth.php';

include '../config/koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM tb_siswa ORDER BY nis DESC");


if (!$data) {
    die("Query error: " . mysqli_error($koneksi));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/admin.css">

</head>

<body>
<div class="d-flex" style="min-height:100vh">


    <div class="sidebar-gradient sidebar-animated p-3" style="width:260px">
        <h5 class="text-center mb-4 text-white">Admin Panel</h5>

        <div class="list-group list-group-flush">
            <a href="index.php" class="list-group-item">🏠 Dashboard</a>
            <a href="data_admin.php" class="list-group-item">👤 Data Admin</a>
            <a href="data_siswa.php" class="list-group-item active">👥 Data Siswa</a>
            <a href="data_kategori.php" class="list-group-item">📂 Data Kategori</a>
            <a href="data_aspirasi.php" class="list-group-item">🗣️ Data Aspirasi</a>
        </div>
    </div>

    <div class="flex-fill bg-light">
        <div class="sidebar-gradient p-3">


                <nav class="navbar navbar-light navbar-rounded px-4">
                <span class="navbar-text fw-semibold">Data Siswa</span>
                <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
            </nav>

            <div class="container mt-5">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-0">Data Siswa</h5>
                            <a href="tambah_siswa.php" class="btn btn-success btn-sm">
                                + Tambah Siswa
                            </a>
                        </div>

                        <!-- TABEL -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>NIS</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th width="20%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $no = 1;
                                while ($row = mysqli_fetch_assoc($data)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['nis']; ?></td>
                                        <td class="text-start"><?= $row['nama']; ?></td>
                                        <td><?= $row['kelas']; ?></td>
                                        <td>
                                            <a href="edit_siswa.php?nis=<?= $row['nis']; ?>"
                                               class="btn btn-sm btn-warning">
                                                Edit
                                            </a>
                                            <a href="hapus_siswa.php?nis=<?= $row['nis']; ?>"
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Yakin hapus data siswa ini?')">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>
