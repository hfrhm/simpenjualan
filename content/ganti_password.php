<?php
$id_petugas = $_SESSION['login_id'];
$username = $_SESSION['username'];
$title = 'Ganti Password';
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Ganti Password</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <h3><b>Ganti Password</b></h3>
        <hr>
        <div class="row justify-content-center col-sm-12">
            <div class="card col-sm-7 col-md-6 col-lg-5 shadow">
                <div class="card-body">
                    <form action="crud/ganti_pass.php" method="POST">
                        <div class="mb-3">
                            <label for="id_petugas" class="form-label">ID Petugas</label>
                            <input type="text" name="id_user" class="form-control" id="id_petugas" value="<?php echo $id_petugas; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" value="<?php echo $username; ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="old" class="form-label">Password Lama</label>
                            <input type="password" name="password_old" class="form-control" id="old" required>
                        </div>
                        <div class="mb-3">
                            <label for="new" class="form-label">Password Baru</label>
                            <input type="password" name="password_new" class="form-control" id="new" required>
                        </div>
                        <div class="mb-3">
                            <label for="conf" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_conf" class="form-control" id="conf" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-check"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
