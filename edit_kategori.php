
<?php
include "../config/koneksi.php";
include 'auth.php';
    $id_kategori = $_GET['id_kategori'];
    $data = mysqli_fetch_array(mysqli_query($koneksi, "SELECT * From tb_kategori
    WHERE id_kategori= '$id_kategori'"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/admin.css">


</head>
<body class="bg-light sidebar-gradient">

<div class="container mt-5">
    <div class="card shadow-sm col-md-6 mx-auto">
        <div class="card-body">

            <h4 class="mb-4">Edit Kategori</h4>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="ket_kategori" value="<?= $data ['ket_kategori'];?>" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="data_kategori.php" class="btn btn-sidebar-style">Kembali</a>
                    <button type="submit" name="simpan" value="ubah" class="btn btn-sidebar-style">
                        Update
                    </button>
                </div>

            </form>
        <?php
        if(isset($_POST['simpan'])){
            $ket_kategori = $_POST['ket_kategori'];

            $sql = "UPDATE tb_kategori SET ket_kategori='$ket_kategori'
            WHERE id_kategori= '$id_kategori'";
            mysqli_query($koneksi,$sql);
            ?>
            <script type= "text/javascript">
                alert('Data Berhasil Diedit');
                document.location.href="data_kategori.php";
            </script>
            <?php
        }
        ?>
        </div>
    </div>
</div>

</body>
</html>