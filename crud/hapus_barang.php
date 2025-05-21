<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

include '../system/proses.php';

$hapus = $db->delete('barang', ['id_barang' => $_POST['id_barang']]);
if ($hapus) {
    echo "<script>document.location.href='../index.php?p=barang'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus')</script>";
    echo "<script>document.location.href='../index.php?p=barang'</script>";
}
