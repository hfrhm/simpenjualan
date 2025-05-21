<?php

include '../system/proses.php';

$id_detail_transaksi = $db->getNextId('detail_transaksi', 'id_detail_transaksi', 'DT', 3);
$id_transaksi = $_POST['id_transaksi'];
$id_barang = $_POST['id_barang'];
$jumlah_beli = $_POST['jumlah_beli'];
$subtotal = $_POST['subtotal'];

$query = $db->get('*', 'barang', "WHERE id_barang = '$id_barang'");
$row = $query->fetch();

$nama_barang = $row['nama_barang'];
if ($row['stok'] < $jumlah_beli) {
    echo json_encode([
        'failed' => true,
        'message' => "Stok $nama_barang tidak cukup, sisa $row[stok]",
    ]);
    exit;
}

$stok = $row['stok'] - $jumlah_beli;
$db->update('barang', [
    'id_barang' => $id_barang,
    'stok' => $stok
], 'id_barang = :id_barang');

$simpan = $db->insert('detail_transaksi', [
    'id_detail_transaksi' => $id_detail_transaksi,
    'id_transaksi' => $id_transaksi,
    'id_barang' => $id_barang,
    'jumlah_beli' => $jumlah_beli,
    'subtotal' => $subtotal
]);

if (!$simpan) {
    echo json_encode('Data Gagal Disimpan');
} else {
    echo json_encode('Data Berhasil Disimpan');
}
