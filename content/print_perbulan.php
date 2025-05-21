<?php

include '../system/proses.php';

$bulan =  $_GET['bulan'];
$tahun =  $_GET['tahun'];
$qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, transaksi.total", "transaksi", "INNER JOIN petugas on transaksi.id_petugas=petugas.id_petugas WHERE month(transaksi.tanggal) = '$bulan' AND year(transaksi.tanggal)='$tahun'");
?>
<!DOCTYPE html>
<html>

<head>
	<title>Laporan Per Bulan</title>
	<link rel="stylesheet" type="text/css" href="../dist/css/style.css">
</head>

<body style="background-color: #fff;">
	<div class="judul-content">
		<h1 style="text-align: center; font-family: segoe ui; margin-top: 15px;">Laporan Per Bulan</h1>
	</div>
	<div class="isi-content">
		<div class="judul-home">
			<div class="divtabel">
				<table class="tabel98">
					<tr>
						<th>ID Transaksi</th>
						<th>Tanggal</th>
						<th>Nama User</th>
						<th>Total</th>
						<th>Total Bayar</th>

					</tr>
					<?php
					foreach ($qw as $tampil) {
						$totbay = $tampil['total'];
					?>
						<tr>
							<td><? $tampil['id_transaksi']; ?></td>
							<td><? $tampil['tanggal']; ?></td>
							<td><? $tampil['username']; ?></td>
							<td><? $tampil['total']; ?></td>
							<td><? $totbay; ?></td>

						</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>
	</div>
</body>

</html>