<?php

session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

include '../system/proses.php';

$hapus = $db->delete('pelanggan', ['id_pelanggan' => $_POST['id_pelanggan']]);
if ($hapus) {
    echo "<script>document.location.href='../index.php?p=pelanggan'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus')</script>";
    echo "<script>document.location.href='../index.php?p=pelanggan'</script>";
}
