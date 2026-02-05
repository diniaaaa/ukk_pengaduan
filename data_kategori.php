
<?php include 'auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kategori</title>

    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/admin.css">

</head>
<div class="d-flex" style="min-height:100vh">

   <div class="sidebar-gradient sidebar-animated p-3" style="width:260px">

    <h5 class="text-center mb-4 text-white">Admin Panel</h5>

    <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item ">
            🏠 Dashboard
        </a>
        <a href="data_admin.php" class="list-group-item ">
            👤 Data Admin
        </a>
        <a href="data_siswa.php" class="list-group-item">
            👥 Data Siswa
        </a>
        <a href="data_kategori.php" class="list-group-item active">
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
                Data Kategori
            </span>
            <a href="logout.php" class="btn btn-sm btn-danger">
                Logout
            </a>
        </nav>
    


<div class="container mt-5">

    <div class="card shadow-sm">
        <div class="card-body position-relative">


            
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="mb-0">Data Kategori</h5>
                        <a href="tambah_kategori.php" class="btn btn-success btn-sm">
                            + Tambah Kategori
                        </a>
                    </div>

            <!-- Tabel -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include "../config/koneksi.php";

                    $no = 1;
                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                    while ($data = mysqli_fetch_array($sql)) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td class="text-start"><?= $data['ket_kategori']; ?></td>
                            <td>
                                <a href="edit_kategori.php?id_kategori=<?= $data['id_kategori']; ?>"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <a href="hapus_kategori.php?id_kategori=<?= $data['id_kategori']; ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin hapus data ini?')">
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

</body>
</html>
