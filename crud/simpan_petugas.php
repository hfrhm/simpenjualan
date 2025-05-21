<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

include '../system/proses.php';

if (isset($_POST['simpan_petugas'])) {
    $simpan = $db->insert('petugas', [
        'id_petugas' => $_POST['id_petugas'],
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'level' => $_POST['level'],
    ]);
    if ($simpan) {
        echo "<script>alert('Data Berhasil Disimpan')</script>";
        echo "<script>document.location.href='../index.php?p=petugas'</script>";
    } else {
        echo "<script>alert('Data Gagal Disimpan')</script>";
        echo "<script>document.location.href='../index.php?p=petugas'</script>";
    }
} else {
    $edit = $db->update('petugas', [
        'id_petugas' => $_POST['id_petugas'],
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'level' => $_POST['level']
    ], 'id_petugas = :id_petugas');

    if ($edit) {
        echo "<script>alert('Data Berhasil Diupdate')</script>";
        echo "<script>document.location.href='../index.php?p=petugas'</script>";
    } else {
        echo "<script>alert('Data Gagal Diupdate')</script>";
        echo "<script>document.location.href='../index.php?p=petugas'</script>";
    }
}
