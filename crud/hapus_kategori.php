<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

include '../system/proses.php';

$hapus = $db->delete('kategori', ['id_kategori' => $_POST['id_kategori']]);
if ($hapus) {
    echo "<script>document.location.href='../index.php?p=kategori'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus')</script>";
    echo "<script>document.location.href='../index.php?p=kategori'</script>";
}
