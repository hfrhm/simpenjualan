<?php

session_start();

if (!isset($_SESSION['login'])) {
    header('Location: ../login.php');
    exit;
}

include '../system/proses.php';

if (isset($_POST['simpan_pelanggan'])) {
    $simpan = $db->insert('pelanggan', [
        'id_pelanggan' => $_POST['id_pelanggan'],
        'nama' => $_POST['nama_pelanggan'],
        'alamat' => $_POST['alamat'],
        'telpon' => $_POST['telpon'],
        'keterangan' => $_POST['keterangan'],
    ]);

    if ($simpan) {
        echo "<script>alert('Data Berhasil Disimpan')</script>";
        echo "<script>document.location.href='../index.php?p=pelanggan'</script>";
    } else {
        echo "<script>alert('Data Gagal Disimpan')</script>";
        echo "<script>document.location.href='../index.php?p=pelanggan'</script>";
    }
} else {
    $edit = $db->update('pelanggan', [
        'id_pelanggan' => $_POST['id_pelanggan'],
        'nama' => $_POST['nama_pelanggan'],
        'alamat' => $_POST['alamat'],
        'telpon' => $_POST['telpon'],
        'keterangan' => $_POST['keterangan'],
    ], 'id_pelanggan = :id_pelanggan');

    if ($edit) {
        echo "<script>alert('Data Berhasil Diupdate')</script>";
        echo "<script>document.location.href='../index.php?p=pelanggan'</script>";
    } else {
        echo "<script>alert('Data Gagal Diupdate')</script>";
        echo "<script>document.location.href='../index.php?p=pelanggan'</script>";
    }
}
