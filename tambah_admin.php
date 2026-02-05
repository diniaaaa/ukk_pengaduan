
<?php
include '../config/koneksi.php';
include 'auth.php';

if (isset($_POST['simpan'])) {
    $username   = $_POST['username'];
    $password  = $_POST['password'];

    mysqli_query($koneksi, "
        INSERT INTO tb_admin (username, password)
        VALUES ('$username', '$password')
    ");

    echo "
    <script>
        alert('Data Admin berhasil ditambahkan');
        window.location='data_admin.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Admin</title>
<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
<link rel="stylesheet" href="../asset/css/admin.css">

</head>

<body class="bg-light sidebar-gradient">
    <a href="data_admin.php"
               class="btn btn-back-fixed m-3">
                ← Kembali
            </a>

<div class="container mt-5">
    <div class="card shadow-sm col-md-6 mx-auto">
        <div class="card-body">

            <h4 class="mb-4">Tambah Admin</h4>

            <form method="post">

                <div class="mb-3">
                

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="data_admin.php" class="btn btn-sidebar-style">Kembali</a>
                <button type="submit" name="simpan" class="btn btn-sidebar-style">
                        Simpan
                    </button>

            </form>

        </div>
    </div>
</div>

</body>
</html>
