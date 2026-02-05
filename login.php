<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Sistem Pengaduan</title>

    <link rel="stylesheet" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="asset/css/admin.css">

</head>



<body>
<a href="index.php" class="btn btn-back-fixed">
    ← Kembali
</a>

<div class="gradient d-flex align-items-center justify-content-center">
    <div class="card login-card shadow p-4" style="max-width: 400px; width: 100%;">
        <div class="card-body">

            <h4 class="text-center mb-4">Login Admin</h4>
    

            <form method="post" action="proses_login.php">
                <input type="hidden" name="role" value="admin">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text"
                           name="username"
                           class="form-control"
                           placeholder="Masukkan Username"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="Masukkan Password"
                           required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-sidebar-style mb-2">
                        Login
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


</body>

</body>
</html>
