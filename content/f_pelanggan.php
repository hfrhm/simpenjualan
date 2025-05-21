<?php

include "system/proses.php";
error_reporting(0);

$hasId = $_GET['id_pelanggan'];
if (empty($_GET['id_pelanggan'])) {
	$id_pelanggan = $db->getNextId('pelanggan', 'id_pelanggan', 'P', '3');
	$sub = 'simpan_pelanggan';
} else {
	$id_pelanggan = $_GET['id_pelanggan'];
	$sub = 'edit_pelanggan';
}

$query = $db->get('*', 'pelanggan', "WHERE id_pelanggan='$_GET[id_pelanggan]'");
$user = $query->fetch();
$title = $hasId ? 'Edit Pelanggan' : 'Tambah Pelanggan';

?>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
					<li class="breadcrumb-item"><a href="index.php?p=pelanggan">Pelanggan</a></li>
					<li class="breadcrumb-item active"><?= $hasId ? 'Edit' : 'Tambah' ?></li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
	<div class="container-fluid">
		<h3><b>Pelanggan</b></h3>
		<hr>
		<div class="row justify-content-center col-sm-12">
			<div class="card col-sm-7 col-md-6 shadow">
				<div class="card-body">
					<form action="crud/simpan_pelanggan.php" method="POST">
						<div class="row">
							<div class="col-md-6">
								<div class="mb-3">
									<label for="id_pelanggan">ID Pelanggan</label>
									<input type="text" name="id_pelanggan" class="form-control" id="id_pelanggan" value="<?= $id_pelanggan; ?>" readonly>
								</div>
								<div class="mb-3">
									<label for="nama_pelanggan">Nama Pelanggan</label>
									<input type="text" name="nama_pelanggan" class="form-control" id="nama_pelanggan" value="<?= $row['nama_pelanggan']; ?>" onkeypress="return huruf(event)">
								</div>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<label for="alamat">Alamat Pelanggan</label>
									<input type="text" name="alamat" class="form-control" id="alamat" value="<?= $user['alamat']; ?>">
								</div>
								<div class="mb-3">
									<label for="telpon">Telpon</label>
									<input type="text" name="telpon" class="form-control" id="telpon" value="<?= $user['telpon']; ?>">
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label for="keterangan">Keterangan</label>
							<textarea type="text" name="keterangan" class="form-control" rows="3" id="keterangan"><?= $user['keterangan']; ?></textarea>
						</div>
						<div class="text-center">
							<button type="submit" name="<?= $sub; ?>" class="btn btn-sm btn-info"><i class="fas fa-check"></i> Selesai</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>