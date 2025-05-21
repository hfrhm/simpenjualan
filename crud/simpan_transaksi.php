<?php

include '../system/proses.php';

$id_pelanggan = isset($_POST['id_pelanggan']) ? $_POST['id_pelanggan'] : 'non-pelanggan';

$simpan = $db->insert('transaksi', [
	'id_transaksi' => $_POST['id_transaksi'],
	'tanggal' => $_POST['tanggal'],
	'id_pelanggan' => $id_pelanggan,
	'id_petugas' => $_POST['id_petugas'],
	'total' => $_POST['total'],
	'bayar' => $_POST['bayar'],
	'kembali' => $_POST['kembali'],
]);

$query = $db->get('*', 'transaksi', "WHERE id_transaksi = '$_POST[id_transaksi]'");
$trans = $query->fetch();

echo json_encode([
	'id_transaksi' => $trans['id_transaksi'],
	'tanggal' => $trans['tanggal'],
	'pelanggan' => $trans['id_pelanggan'],
	'username' => $trans['id_petugas'],
	'total' => $trans['total'],
	'bayar' => $trans['bayar'],
	'kembali' => $trans['kembali']
]);
