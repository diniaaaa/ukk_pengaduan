<?php
include "../config/koneksi.php";
include "auth.php";

if (!isset($_GET['id_aspirasi'])) {
    echo "<script>
        alert('ID tidak valid');
        location.href='data_aspirasi.php';
    </script>";
    exit;
}

$id_aspirasi = mysqli_real_escape_string($koneksi, $_GET['id_aspirasi']);

$hapus = mysqli_query(
    $koneksi,
    "DELETE FROM tb_aspirasi WHERE id_aspirasi = '$id_aspirasi'"
);

if ($hapus) {
    echo "<script>
        alert('Data berhasil dihapus');
        location.href='data_aspirasi.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menghapus data');
        location.href='data_aspirasi.php';
    </script>";
}
