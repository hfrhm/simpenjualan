<?php

include '../system/proses.php';

$qwe1 = $db->get("transaksi.tanggal, transaksi.id_transaksi, petugas.username, petugas.level", "transaksi", "INNER JOIN petugas on petugas.id_petugas = transaksi.id_petugas WHERE transaksi.id_transaksi='$_GET[id_transaksi]'");
$qwe2 = $db->get("pelanggan.nama", "transaksi", "INNER JOIN pelanggan on pelanggan.id_pelanggan=transaksi.id_pelanggan WHERE transaksi.id_transaksi='$_GET[id_transaksi]'");
$qwe3 = $db->get("barang.nama_barang, barang.harga, detail_transaksi.jumlah_beli, detail_transaksi.subtotal", "detail_transaksi", "INNER JOIN barang on barang.id_barang = detail_transaksi.id_barang WHERE detail_transaksi.id_transaksi='$_GET[id_transaksi]'");
$qwe4 = $db->get("*", "transaksi", "WHERE id_transaksi='$_GET[id_transaksi]'");
$tamp = $qwe1->fetch();
$tamp2 = $qwe2->fetch();
$tamp4 = $qwe4->fetch();
?>

<!DOCTYPE html>
<html>

<head>
	<title>STRUK</title>
	<style>
		@media print {
			@page {
				margin: 0;
			}
		}

		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

		.kotak-struk {
			width: 380px;
			margin: 20px auto;
			padding: 20px;
			border: 1px double #b6b6b6;
			background-color: #ffffff;
		}

		.head {
			text-align: center;
			margin-bottom: 20px;
		}

		.head .logo {
			font-size: 20px;
			font-weight: bold;
			color: #333;
			margin: 0;
		}

		.head p {
			margin: 5px 0;
			color: #666;
			font-size: 14px;
		}

		.head .almt,
		.head .notelp {
			font-size: 12px;
		}

		.header-line {
			border-top: 2px solid #333;
			margin: 10px 0;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-bottom: 20px;
		}

		table td,
		table th {
			padding: 8px;
			border-bottom: 1px solid #eee;
			color: #333;
			text-align: left;
		}

		.tabel1 td:nth-child(1),
		.tabel3 td:nth-child(1),
		.tabel4 td:nth-child(1) {
			width: 30%;
		}

		.tabel1 td:nth-child(2),
		.tabel3 td:nth-child(2),
		.tabel4 td:nth-child(2) {
			text-align: center;
			color: #777;
			width: 5%;
		}

		.tabel1 td:nth-child(3),
		.tabel3 td:nth-child(3),
		.tabel4 td:nth-child(3) {
			width: 65%;
			text-align: right;
		}

		.tabel2 th {
			background-color: #f4f4f4;
			border-bottom: 2px solid #333;
			font-size: 12px;
		}

		.tabel2 td {
			font-size: 14px;
		}

		.foot {
			text-align: center;
			margin-top: 20px;
			color: #555;
		}

		.foot p {
			margin: 5px 0;
		}

		.separator {
			border-top: 1px dashed #ddd;
			margin: 10px 0;
		}
	</style>
</head>

<body>
	<div class="kotak-struk">
		<div class="head">
			<p class="logo">AJAI KOMPUTER BARABAI</p>
			<p class="almt">Jl. Ir.P.H.M.Noor - Tangkarau Luar</p>
			<p class="notelp">085248271215</p>
		</div>

		<div class="header-line"></div>

		<table class="tabel1">
			<tr>
				<td>Tanggal</td>
				<td>:</td>
				<td><?= date('d M Y'); ?></td>
			</tr>
			<tr>
				<td>Transaksi</td>
				<td>:</td>
				<td><?= $tamp['id_transaksi']; ?></td>
			</tr>
			<tr>
				<td>Petugas</td>
				<td>:</td>
				<td><?= $tamp['username']; ?>(<?= $tamp['level']; ?>)</td>
			</tr>
			<tr>
				<td>Pelanggan</td>
				<td>:</td>
				<td><?= $tamp2['nama'] ?? 'non-pelanggan' ?></td>
			</tr>
		</table>

		<div class="separator"></div>

		<table class="tabel2">
			<thead>
				<tr>
					<th>Nama Barang</th>
					<th>Harga</th>
					<th>Jumlah</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($qwe3 as $tamp3) {
				?>
					<tr>
						<td><?= $tamp3['nama_barang'] ?></td>
						<td><?= number_format($tamp3['harga'] ?? 0, 2, ',', '.') ?></td>
						<td><?= $tamp3['jumlah_beli'] ?></td>
						<td><?= number_format($tamp3['subtotal'], 2, ',', '.') ?></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>

		<div class="separator"></div>

		<table class="tabel3">
			<tr>
				<td>Total</td>
				<td>:</td>
				<td><?= number_format($tamp4['total'], 2, ',', '.') ?></td>
			</tr>
			<tr>
				<td>Tunai</td>
				<td>:</td>
				<td><?= number_format($tamp4['bayar'], 2, ',', '.') ?></td>
			</tr>
		</table>

		<table class="tabel4">
			<tr>
				<td>Kembali</td>
				<td>:</td>
				<td><?= number_format($tamp4['bayar'] - $tamp4['total'], 2, ',', '.') ?></td>
			</tr>
		</table>

		<div class="foot">
			<p>-----------------------------</p>
			<p>Terima Kasih Atas Kunjungan Anda</p>
		</div>
	</div>
</body>

</html>