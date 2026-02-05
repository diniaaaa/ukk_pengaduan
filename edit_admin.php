
<?php
include "../config/koneksi.php";
include 'auth.php';

$id_admin = $_GET['id_admin'];
$data = mysqli_fetch_array(mysqli_query(
    $koneksi,
    "SELECT * FROM tb_admin WHERE id_admin='$id_admin'"
));
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


<div class="container mt-5">
    <div class="card shadow-sm col-md-6 mx-auto">
        <div class="card-body">
        

            <h4 class="mb-4">Edit Admin</h4>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control"
                        value="<?= $data['username']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control"
                        value="<?= $data['password']; ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="data_admin.php" class="btn btn-sidebar-style">Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-sidebar-style">
                        Update
                    </button>
                </div>

            </form>

        <?php
        if(isset($_POST['simpan'])){
            $username = $_POST['username'];
            $password = $_POST['password'];

            mysqli_query(
                    $koneksi,
                    "UPDATE tb_admin
                     SET username='$username', password='$password' 
                     WHERE id_admin='$id_admin'"
                );
                ?>
                <script>
                    alert('Data admin berhasil diupdate');
                    document.location.href = "data_admin.php";
                </script>
                <?php
        }
        ?>

        </div>
    </div>
</div>

</body>
</html>
