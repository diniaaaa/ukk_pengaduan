
<?php
include '../config/koneksi.php';
include 'auth.php';
if (isset($_POST['simpan'])) {
    $nis   = $_POST['nis'];
    $nama  = $_POST['nama'];
    $kelas = $_POST['kelas'];

    mysqli_query($koneksi, "
        INSERT INTO tb_siswa (nis, nama, kelas)
        VALUES ('$nis', '$nama', '$kelas')
    ");

    echo "
    <script>
        alert('Data siswa berhasil ditambahkan');
        window.location='data_siswa.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Siswa</title>
<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../asset/css/admin.css">

</head>
<body class="bg-light sidebar-gradient">
    <a href="data_siswa.php"
               class="btn btn-back-fixed m-3">
                ← Kembali
            </a>

<div class="container mt-5">
    <div class="card shadow-sm col-md-6 mx-auto">
        <div class="card-body">

            <h4 class="mb-4">Tambah Siswa</h4>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="int" name="nis" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="data_siswa.php" class="btn btn-sidebar-style">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-sidebar-style">
                        Simpan
                    </button>

            </form>

        </div>
    </div>
</div>

</body>
</html>
