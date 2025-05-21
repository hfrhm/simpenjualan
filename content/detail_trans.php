<?php

include '../system/proses.php';

$id_transaksi = $_GET['id_transaksi'];
$detail_trans = $db->get("detail_transaksi.id_transaksi, detail_transaksi.id_detail_transaksi,barang.nama_barang, barang.harga, detail_transaksi.jumlah_beli, detail_transaksi.subtotal", "detail_transaksi", "INNER JOIN barang on detail_transaksi.id_barang = barang.id_barang WHERE detail_transaksi.id_transaksi = '$id_transaksi' order by detail_transaksi.id_detail_transaksi ASC");

?>
<div class="table-responsive">
	<table class="table table-sm table-bordered text-nowrap">
		<tr>
			<th>No</th>
			<th>ID Transaksi</th>
			<th>Nama Barang</th>
			<th>Harga</th>
			<th>Jumlah Beli</th>
			<th>Subtotal</th>
			<th>Aksi</th>
		</tr>
		<?php
		$no = 1;
		$total = 0;
		foreach ($detail_trans as $detail) {
			$total = $total + $detail['subtotal'];
		?>
			<tr>
				<td><?= $no; ?></td>
				<td><?= $detail['id_transaksi']; ?></td>
				<td><?= $detail['nama_barang']; ?></td>
				<td><?= $detail['harga']; ?></td>
				<td><?= $detail['jumlah_beli']; ?></td>
				<td><?= $detail['subtotal']; ?></td>
				<td>
					<button type="button" onclick="deleteDetail(`<?= $detail['id_detail_transaksi']; ?>`)" class="btn btn-danger">
						<i class="fas fa-trash"></i>
					</button>
				</td>
			</tr>
		<?php $no++;
		} ?>
	</table>
</div>

<script type="text/javascript">
	$('#total').val("<?= $total; ?>");
</script>