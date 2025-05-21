<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

include '../system/proses.php';

if (isset($_POST['simpan'])) {
    $simpan = $db->insert('barang', [
        'id_barang' => $_POST['id_barang'],
        'nama_barang' => $_POST['nama_barang'],
        'harga' => $_POST['harga'],
        'stok' => $_POST['stok'],
        'keterangan' => $_POST['keterangan'],
        'kategori' => $_POST['kategori']
    ]);

    if ($simpan) {
        echo "<script>alert('Data Berhasil Disimpan')</script>";
        echo "<script>document.location.href='../index.php?p=barang'</script>";
    } else {
        echo "<script>alert('Data Gagal Disimpan')</script>";
        echo "<script>document.location.href='../index.php?p=barang'</script>";
    }
} else {
    $edit = $db->update('barang', [
        'id_barang' => $_POST['id_barang'],
        'nama_barang' => $_POST['nama_barang'],
        'harga' => $_POST['harga'],
        'stok' => $_POST['stok'],
        'keterangan' => $_POST['keterangan'],
        'kategori' => $_POST['kategori']
    ], 'id_barang = :id_barang');

    if ($edit) {
        echo "<script>alert('Data Berhasil Diupdate')</script>";
        echo "<script>document.location.href='../index.php?p=barang'</script>";
    } else {
        echo "<script>alert('Data Gagal Diupdate')</script>";
        echo "<script>document.location.href='../index.php?p=barang'</script>";
    }
}
