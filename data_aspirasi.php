
<?php
include '../config/koneksi.php';
include 'auth.php';

$where = [];

if (!empty($_GET['keyword'])) {
    $key = mysqli_real_escape_string($koneksi, $_GET['keyword']);
    $where[] = "(a.nis LIKE '%$key%' 
              OR s.nama LIKE '%$key%' 
              OR a.lokasi LIKE '%$key%' 
              OR a.ket LIKE '%$key%')";
}

if (!empty($_GET['tgl'])) {
    $tgl = $_GET['tgl'];
    $where[] = "a.tanggal = '$tgl'";
}

if (!empty($_GET['status'])) {
    $status = $_GET['status'];
    $where[] = "a.status = '$status'";
}

if (!empty($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    $where[] = "a.id_kategori = '$kategori'";
}

$whereSQL = count($where) > 0 ? "WHERE ".implode(" AND ", $where) : "";


$data = mysqli_query($koneksi, "
    SELECT 
        a.id_aspirasi,
        a.nis,
        s.nama,
        k.ket_kategori,
        a.lokasi,
        a.ket,
        a.status,
        a.feedback,
        a.tanggal
    FROM tb_aspirasi a
    JOIN tb_siswa s ON a.nis = s.nis
    JOIN tb_kategori k ON a.id_kategori = k.id_kategori
    $whereSQL
    ORDER BY a.id_aspirasi DESC
");

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Aspirasi</title>
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
            <a href="data_siswa.php" class="list-group-item">👥 Data Siswa</a>
            <a href="data_kategori.php" class="list-group-item">📂 Data Kategori</a>
            <a href="data_aspirasi.php" class="list-group-item active">🗣️ Data Aspirasi</a>
        </div>
    </div>


    <div class="flex-fill bg-light">
        <div class="sidebar-gradient sidebar-animated p-3">
        <nav class="navbar navbar-light navbar-rounded px-4">
            <span class="navbar-text fw-semibold">Data Aspirasi</span>
            <a href="logout.php" class="btn btn-sm btn-danger">Logout</a>
        </nav>
        <br>

        <form method="GET" class="row g-2 mb-3">
        <div class="col-md-3">
            <input type="text" name="keyword" class="form-control"
                placeholder="Cari NIS / Nama / Lokasi"
                value="<?= $_GET['keyword'] ?? '' ?>">
        </div>

    <div class="col-md-2">
        <input type="date" name="tgl" class="form-control"
               value="<?= $_GET['tgl'] ?? '' ?>">
    </div>

    <div class="col-md-2">
        <select name="status" class="form-select">
            <option value="">-- Status --</option>
            <option value="Menunggu" <?= ($_GET['status'] ?? '')=='Menunggu'?'selected':'' ?>>Menunggu</option>
            <option value="Diproses" <?= ($_GET['status'] ?? '')=='Diproses'?'selected':'' ?>>Diproses</option>
            <option value="Selesai" <?= ($_GET['status'] ?? '')=='Selesai'?'selected':'' ?>>Selesai</option>
        </select>
    </div>

    <div class="col-md-2">
        <select name="kategori" class="form-select">
            <option value="">-- Kategori --</option>
            <?php
            $kat = mysqli_query($koneksi,"SELECT * FROM tb_kategori");
            while($k = mysqli_fetch_assoc($kat)){
            ?>
            <option value="<?= $k['id_kategori']; ?>"
                <?= ($_GET['kategori'] ?? '')==$k['id_kategori']?'selected':'' ?>>
                <?= $k['ket_kategori']; ?>
            </option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-1 d-grid">
        <button class="btn btn-sidebar-style">Filter</button>

    </div>

            <?php if ($data) { ?>
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-3">
                        <a href="cetak_pdf1.php?<?= http_build_query($_GET); ?>" 
                        target="_blank"
                        class="btn btn-sidebar-style btn-sm">
                            Cetak PDF
                        </a>
                    </div>
            <?php } ?>


</form>


        <div class="container mt-4">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h5 class="mb-3">Data Aspirasi Siswa</h5>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
                                    <th>Feedback Admin</th>
                                    <th width="18%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($data)) {

                                
                                $badge = "secondary";
                                if ($row['status'] == "Menunggu") $badge = "warning";
                                elseif ($row['status'] == "Diproses") $badge = "info";
                                elseif ($row['status'] == "Selesai") $badge = "success";
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nis']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['ket_kategori']; ?></td>
                                    <td><?= $row['lokasi']; ?></td>
                                    <td><?= $row['ket']; ?></td>
                                    <td>
                                        <span class="badge bg-<?= $badge; ?>">
                                            <?= $row['status']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($row['feedback'] == '-' || $row['feedback'] == '') { ?>
                                            <span class="text-muted fst-italic">Belum ada</span>
                                        <?php } else { ?>
                                            <?= $row['feedback']; ?>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="edit_aspirasi.php?id_aspirasi=<?= $row['id_aspirasi']; ?>"
                                           class="btn btn-sm btn-primary mb-1">
                                            Proses
                                        </a>

                                        <a href="hapus_aspirasi.php?id_aspirasi=<?= $row['id_aspirasi']; ?>"
                                           class="btn btn-sm btn-danger mb-1">
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

<script src="../asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>
