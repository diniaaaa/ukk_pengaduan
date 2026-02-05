
<?php
include '../config/koneksi.php';
include 'auth.php';

$id = $_GET['id_aspirasi'] ?? '';

if ($id == '') {
    header("Location: data_aspirasi.php");
    exit;
}

$q = mysqli_query($koneksi, "
    SELECT status, feedback
    FROM tb_aspirasi
    WHERE id_aspirasi = '$id'
");

$data = mysqli_fetch_assoc($q);

if (!$data) {
    header("Location: data_aspirasi.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $status   = $_POST['status'];
    $feedback = trim($_POST['feedback']);

    $update = mysqli_query($koneksi, "
        UPDATE tb_aspirasi SET
            status   = '$status',
            feedback = '$feedback'
        WHERE id_aspirasi = '$id'
    ");

    if ($update) {
        header("Location: data_aspirasi.php");
        exit;
    } else {
        $error = "Gagal menyimpan perubahan";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Aspirasi</title>
    <link rel="stylesheet" href="../asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="../asset/css/admin.css">


</head>
<body class="bg-light sidebar-gradient">


<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header btn-sidebar-style text-black text-center">
            UPDATE STATUS & FEEDBACK
        </div>

        <div class="card-body">
            <?php if(isset($error)){ ?>
                <div class="alert alert-danger">
                    <?= $error; ?>
                </div>
            <?php } ?>

            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="Menunggu" <?= $data['status']=='Menunggu'?'selected':''; ?>>Menunggu</option>
                        <option value="Proses" <?= $data['status']=='Proses'?'selected':''; ?>>Proses</option>
                        <option value="Selesai" <?= $data['status']=='Selesai'?'selected':''; ?>>Selesai</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Feedback</label>
                    <textarea name="feedback" class="form-control" rows="4" required><?= $data['feedback']; ?></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="data_aspirasi.php" class="btn btn-sidebar-style">
                        Kembali
                    </a>
                    <button type="submit" name="simpan" class="btn btn-sidebar-style">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script src="../asset/js/bootstrap.bundle.min.js"></script>
</body>
</html>
