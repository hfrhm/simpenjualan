<?php

session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../login.php");
    exit;
}

include "../system/proses.php";

$hapus = $db->delete("petugas", ['id_petugas' => $_POST['id_petugas']]);

if ($hapus) {
    echo "<script>document.location.href='../index.php?p=petugas'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus')</script>";
    echo "<script>document.location.href='../index.php?p=petugas'</script>";
}
