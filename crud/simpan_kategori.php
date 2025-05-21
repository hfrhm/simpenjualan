<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

include '../system/proses.php';

if (isset($_POST['simpan_kategori'])) {
    $simpan = $db->insert('kategori', [
        'id_kategori' => $_POST['id_kategori'],
        'nama' => $_POST['nama_kategori'],
    ]);

    if ($simpan) {
        echo "<script>alert('Data Berhasil Disimpan')</script>";
        echo "<script>document.location.href='../index.php?p=kategori'</script>";
    } else {
        echo "<script>alert('Data Gagal Disimpan')</script>";
        echo "<script>document.location.href='../index.php?p=kategori'</script>";
    }
} else {
    $edit = $db->update('kategori', [
        'id_kategori' => $_POST['id_kategori'],
        'nama' => $_POST['nama_kategori'],
    ], 'id_kategori = :id_kategori');

    if ($edit) {
        echo "<script>alert('Data Berhasil Diupdate')</script>";
        echo "<script>document.location.href='../index.php?p=kategori'</script>";
    } else {
        echo "<script>alert('Data Gagal Diupdate')</script>";
        echo "<script>document.location.href='../index.php?p=kategori'</script>";
    }
}
