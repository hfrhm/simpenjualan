<?php

include "system/proses.php";
error_reporting(0);

$hasId = $_GET['id_petugas'];
if (empty($hasId)) {
	$id_petugas = $db->getNextId('petugas', 'id_petugas', 'U', '2');;
	$sub = 'simpan_petugas';
} else {
	$id_petugas = $hasId;
	$sub = 'edit_petugas';
}

$qr = $db->get("*", "petugas", "WHERE id_petugas='$hasId'");
$user = $qr->fetch();
$title = $hasId ? 'Edit Petugas' : 'Tambah Petugas';

?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
					<li class="breadcrumb-item"><a href="index.php?p=petugas">Petugas</a></li>
					<li class="breadcrumb-item active"><?= $hasId ? 'Edit' : 'Tambah' ?></li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
		<h3><b>Petugas</b></h3>
		<hr>
		<div class="row justify-content-center col-sm-12">
			<div class="card col-sm-7 col-md-6 shadow">
				<div class="card-body">
					<form action="crud/simpan_petugas.php" method="POST">
						<div class="mb-3">
							<label class="form-label" for="id_petugas">ID Petugas</label>
							<input type="text" name="id_petugas" class="form-control" id="id_petugas" value="<?= $id_petugas; ?>" readonly>
						</div>
						<div class="mb-3">
							<label class="form-label" for="username">Username</label>
							<input type="text" name="username" class="form-control" required id="username" value="<?= $user['username']; ?>">
						</div>
						<div class="mb-3">
							<label class="form-label" for="password">Password</label>
							<input type="password" name="password" class="form-control" required id="password" value="<?= $user['password']; ?>">
						</div>
						<div class="mb-3">
							<label for="level" class="form-label">Level</label>
							<select class="form-control" name="level">
								<option disabled selected>-- Pilih Level --</option>
								<option value="admin" <?= $user['level'] == 'admin' ? 'selected' : '' ?>>Admin</option>
								<option value="manager" <?= $user['level'] == 'manager' ? 'selected' : '' ?>>Manajer</option>
								<option value="kasir" <?= $user['level'] == 'kasir' ? 'selected' : '' ?>>Kasir</option>
							</select>
						</div>
						<div class="text-center">
							<button type="submit" name="<?= $sub; ?>" class="btn btn-sm btn-info">
								<i class="fas fa-check"></i> Selesai
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>