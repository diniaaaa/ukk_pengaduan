
<?php
 include "../config/koneksi.php";
 include 'auth.php';

if (isset($_POST['simpan'])) {

    $ket_kategori = $_POST['ket_kategori'];

    mysqli_query($koneksi, "INSERT INTO tb_kategori (ket_kategori)
    VALUES ('$ket_kategori')");
    ?>
    <script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'data_kategori.php';
    </script>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../asset/css/admin.css">

</head>
<body class="bg-light sidebar-gradient">
    <a href="data_kategori.php"
               class="btn btn-back-fixed m-3">
                ← Kembali
            </a>

<div class="container mt-5">
    <div class="card shadow-sm col-md-6 mx-auto">
        <div class="card-body">

            <h4 class="mb-4">Tambah Kategori</h4>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="ket_kategori" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="data_kategori.php" class="btn btn-sidebar-style">Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-sidebar-style">
                        Simpan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

</body>
</html>
