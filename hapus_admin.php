
<?php
    {
    include "../config/koneksi.php";
    include 'auth.php';
        $id_admin = $_GET['id_admin'];
        mysqli_query($koneksi, "DELETE From tb_admin
        WHERE id_admin= '$id_admin'");
        ?>
            <script type= "text/javascript">
                alert('Data Berhasil Dihapus');
                document.location.href="data_admin.php";
            </script>
            <?php
        }
        ?>