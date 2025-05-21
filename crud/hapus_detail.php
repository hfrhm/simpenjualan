<?php

include '../system/proses.php';

$hapus = $db->delete('detail_transaksi', ['id_detail_transaksi' => $_POST['id_detail_transaksi']]);
if ($hapus) {
    echo 'Detail transaksi Berhasil Dihapus';
} else {
    echo 'Detail transaksi Gagal Dihapus';
}
