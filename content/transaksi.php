<?php

include 'system/proses.php';

$id_transaksi = $db->getNextId('transaksi', 'id_transaksi', 'TR', 3);
$users = $db->get('*', 'pelanggan', "ORDER BY id_pelanggan ASC");
$id_petugas = $_SESSION['login_id'];
$title = 'Transaksi';

?>

<style>
	.tabel98 {
		width: 100%;
		border-collapse: collapse;
		margin-top: 10px;
	}

	.tabel98 tr th {
		padding: 10px;
		font-size: 14px;
		background-color: #afeeee;
		border: 1px solid #000;
	}

	.tabel98 tr td {
		text-align: center;
		border: 1px solid #000;
		padding: 3px 12px;
		font-size: 14px;
		background-color: #fff;
	}
</style>

<body onload="openTab()"></body>
<!-- Content Header (Page header) -->
<div class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
					<li class="breadcrumb-item active">Transaksi</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
	<div class="container-fluid">
		<h3><b>Transaksi</b></h3>
		<hr>
		<div class="card col-sm-12">
			<div class="card-body">
				<form action="crud/simpan_transaksi.php" method="POST">
					<input type="hidden" name="id_petugas" id="id_petugas" value="<?= $id_petugas ?>">

					<!-- ID Transaksi & Tanggal -->
					<div class="row mb-3">
						<label for="id_transaksi" class="col-sm-2 col-form-label">ID Transaksi</label>
						<div class="col-sm-3">
							<input type="text" name="id_transaksi" id="id_transaksi" class="form-control" readonly value="<?= $id_transaksi; ?>">
						</div>
					</div>
					<div class="row mb-3">
						<label for="tanggal" class="col-sm-2 col-form-label">Tanggal Transaksi</label>
						<div class="col-sm-3">
							<input type="text" name="tanggal" id="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" readonly>
						</div>
					</div>

					<!-- ID Pelanggan & Nama Pelanggan -->
					<div class="row mb-3 text-center">
						<div class="col-sm-4 col-md-3">
							<label for="kategori">Kategori</label>
							<select name="kategori" id="kategori" class="form-control">
								<option value="" selected disabled>Pilih...</option>
								<option value="pelanggan">Pelanggan</option>
								<option value="non_pelanggan">Non pelanggan</option>
							</select>
						</div>
						<div class="col-sm-4 col-md-3">
							<label for="id_pelanggan" class="form-label">ID Pelanggan</label>
							<select name="id_pelanggan" id="id_pelanggan" class="form-control" onchange="searchUserById()">
								<option value="" selected disabled>Pilih...</option>
								<?php foreach ($users as $user) { ?>
									<option value="<?= $user['id_pelanggan']; ?>"><?= $user['id_pelanggan']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="col-sm-4 col-md-3">
							<label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
							<input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" onkeyup="searchUserByName()">
						</div>
					</div>

					<!-- Detail Barang -->
					<div class="row mb-3 text-center">
						<div class="col-sm-4 col-md-3">
							<label for="id_barang" class="form-label">ID Barang</label>
							<input type="text" name="id_brg" id="id_barang" class="form-control" required autocomplete="off" onkeyup="searchProductById()">
						</div>
						<div class="col-sm-4 col-md-3">
							<label for="nama_barang" class="form-label">Nama Barang</label>
							<input type="text" name="nama_barang" id="nama_barang" class="form-control" disabled readonly>
						</div>
						<div class="col-sm-4 col-md-3">
							<label for="harga" class="form-label">Harga</label>
							<input type="text" name="harga" id="harga" class="form-control" disabled readonly>
						</div>
					</div>

					<div class="row mb-3 text-center">
						<div class="col-sm-4 col-md-3">
							<label for="jumlah_beli" class="form-label">Jumlah</label>
							<input type="text" name="jumlah_beli" id="jumlah_beli" class="form-control" required autocomplete="off" onkeyup="ttl()">
						</div>
						<div class="col-sm-4 col-md-3">
							<label for="subtotal" class="form-label">Total</label>
							<input type="text" name="subtotal" id="subtotal" class="form-control" readonly>
						</div>
						<div class="col-sm-2 col-md-1 mt-3 d-flex align-items-end">
							<button type="button" onclick="saveDetailTrans()" class="btn btn-info btn-sm text-nowrap">
								<i class="fas fa-plus mr-2"></i>Tambah
							</button>
						</div>
					</div>

					<!-- Details Box -->
					<div id="kotak-detail" class="mb-3"></div>

					<!-- Bayar, Subtotal & Kembali -->
					<div class="row mb-3 text-center">
						<div class="col-sm-4 col-md-3">
							<label for="bayar" class="form-label">Bayar</label>
							<input type="text" name="bayar" id="bayar" class="form-control" onkeyup="pay()" autocomplete="off" required>
						</div>
						<div class="col-sm-4 col-md-3">
							<label for="total" class="form-label">Subtotal</label>
							<input type="text" name="total" id="total" class="form-control" readonly>
						</div>
						<div class="col-sm-4 col-md-3">
							<label for="kembali" class="form-label">Kembali</label>
							<input type="text" name="kembali" id="kembali" class="form-control" readonly>
						</div>
					</div>

					<!-- Submit Button -->
					<div class="col-md-1 col-sm-2 mt-3 row text-center">
						<button type="button" class="btn btn-success btn-sm text-nowrap" data-toggle="modal" data-target="#Transaksi">
							<i class="fas fa-check mr-2"></i>Selesai
						</button>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="Transaksi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Transaksi</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									Lanjutkan Transaksi Ini?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
									<button type="button" name="simpan" class="btn btn-success" onclick="saveTrans()">
										<i class="fas fa-check"></i> Simpan
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<iframe id="printFrame" style="display: none"></iframe>