<?php
session_start();
include 'config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role     = $_POST['role']; // admin

if ($role === 'admin') {

    $query = mysqli_query($koneksi,
        "SELECT * FROM tb_admin 
         WHERE username='$username' 
         AND password='$password'"
    );

    if (mysqli_num_rows($query) === 1) {

    
        $data = mysqli_fetch_assoc($query);

      
        $_SESSION['login']    = true;
        $_SESSION['id_admin'] = $data['id_admin'];
        $_SESSION['username'] = $data['username'];

        header("Location: admin/index.php");
        exit;

    } else {
        echo "<script>
            alert('Username atau password salah!');
            window.location='login.php';
        </script>";
    }

} else {
    echo "<script>
        alert('Akses tidak valid!');
        window.location='login.php';
    </script>";
}
