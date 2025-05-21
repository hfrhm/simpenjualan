<?php

include '../system/proses.php';

$query = $db->get('*', 'barang', "WHERE id_barang = '$_POST[id_barang]'");
$barang = $query->fetch();

$hasil = [
    'id_barang' => $barang['id_barang'],
    'nama_barang' => $barang['nama_barang'],
    'harga' => $barang['harga']
];

echo json_encode($hasil);
