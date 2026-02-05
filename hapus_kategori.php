
<?php
    {
    include "../config/koneksi.php";
    include 'auth.php';
        $id_kategori = $_GET['id_kategori'];
        mysqli_query($koneksi, "DELETE From tb_kategori
        WHERE id_kategori= '$id_kategori'");
        ?>
            <script type= "text/javascript">
                alert('Data Berhasil Dihapus');
                document.location.href="data_kategori.php";
            </script>
            <?php
        }
?>