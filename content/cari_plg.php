<?php
include "../system/proses.php";

$id_pelanggan = isset($_POST['id_pelanggan']) ? $_POST['id_pelanggan'] : '';
$nama_pelanggan = isset($_POST['nama_pelanggan']) ? $_POST['nama_pelanggan'] : '';

if ($id_pelanggan) {
	$query = $db->get("*", "pelanggan", "WHERE id_pelanggan = '$id_pelanggan'");
	$tampil = $query->fetch();
	$hasilnya = array(
		'id_pelanggan' => $tampil['id_pelanggan'],
		'nama_pelanggan' => $tampil['nama']
	);
} else if ($nama_pelanggan) {
	$query = $db->get("*", "pelanggan", "WHERE nama = '$nama_pelanggan'");
	$tampil = $query->fetch();
	$hasilnya = array(
		'id_pelanggan' => $tampil['id_pelanggan'],
		'nama_pelanggan' => $tampil['nama']
	);
}

echo json_encode($hasilnya);
