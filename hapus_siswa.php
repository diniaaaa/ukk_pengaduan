
<?php
    {
    include "../config/koneksi.php";
    include 'auth.php';
        $nis = $_GET['nis'];
        mysqli_query($koneksi, "DELETE From tb_siswa
        WHERE nis = '$nis'");
        ?>
            <script type= "text/javascript">
                alert('Data Berhasil Dihapus');
                document.location.href="data_siswa.php";
            </script>
            <?php
        }
        ?>