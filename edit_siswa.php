
<?php
include "../config/koneksi.php";
include 'auth.php';

$nis = $_GET['nis'];
$data = mysqli_fetch_array(mysqli_query(
    $koneksi,
    "SELECT * FROM tb_siswa WHERE nis='$nis'"
));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/admin.css">

</head>
<body class="bg-light sidebar-gradient">

<div class="container mt-5">
    <div class="card shadow-sm col-md-6 mx-auto">
        <div class="card-body">

            <h4 class="mb-4">Edit Siswa</h4>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">NIS</label>
                    <input type="text" class="form-control" value="<?= $data['nis']; ?>" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Siswa</label>
                    <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelas</label>
                    <input type="text" name="kelas" value="<?= $data['kelas']; ?>" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="data_siswa.php" class="btn btn-sidebar-style">Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-sidebar-style">
                        Update
                    </button>
                </div>

            </form>

            <?php
            if(isset($_POST['simpan'])){
                $nama  = $_POST['nama'];
                $kelas = $_POST['kelas'];

                mysqli_query(
                    $koneksi,
                    "UPDATE tb_siswa 
                     SET nama='$nama', kelas='$kelas' 
                     WHERE nis='$nis'"
                );
                ?>
                <script>
                    alert('Data siswa berhasil diupdate');
                    document.location.href = "data_siswa.php";
                </script>
                <?php
            }
            ?>

        </div>
    </div>
</div>

</body>
</html>
