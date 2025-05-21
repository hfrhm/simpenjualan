<?php

include 'system/proses.php';
error_reporting(0);

$hasId = $_GET['id_kategori'];
if (empty($hasId)) {
	$nextId = $db->getNextId('Kategori', 'id_kategori', 'KT', '3');
	$sub = 'simpan_kategori';
} else {
	$nextId = $hasId;
	$sub = 'edit_kategori';
	$query = $db->get('*', 'kategori', "WHERE id_kategori='$hasId'");
	$category = $query->fetch();
}

$title = $hasId ? 'Edit Kategori' : 'Tambah Kategori';

?>

<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
					<li class="breadcrumb-item"><a href="index.php?p=kategori">Kategori</a></li>
					<li class="breadcrumb-item active"><?= $hasId ? 'Edit' : 'Tambah' ?></li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
	<div class="container-fluid">
		<h3><b>Kategori</b></h3>
		<hr>
		<div class="row justify-content-center col-sm-12">
			<div class="card col-sm-7 col-md-6 shadow">
				<div class="card-body">
					<form action="crud/simpan_kategori.php" method="POST">
						<div class="mb-3">
							<label for="id_brg">ID Kategori</label>
							<input type="text" name="id_kategori" class="form-control" readonly id="id_brg" value="<?= $nextId; ?>">
						</div>
						<div class="mb-3">
							<label for="nama_brg">Nama Kategori</label>
							<input type="text" name="nama" class="form-control" required id="nama_brg" value="<?= $category['nama']; ?>">
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