<?php

include 'system/proses.php';
error_reporting(0);

$hasId = $_GET['id_barang'];
if (empty($hasId)) {
  $id_barang = $db->getNextId('barang', 'id_barang', 'BR', '3');
  $sub = 'simpan';
} else {
  $id_barang = $hasId;
  $sub = 'edit';
  $qr = $db->get('*', 'barang', "WHERE id_barang='$hasId'");
  $barang = $qr->fetch();
}

$categories = $db->get('*', 'kategori', "ORDER BY id_kategori ASC");
$title = $hasId ? 'Edit Barang' : 'Tambah Barang';

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
          <li class="breadcrumb-item"><a href="index.php?p=barang">Barang</a></li>
          <li class="breadcrumb-item active"><?= $hasId ? 'Edit' : 'Tambah' ?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <h3><b>Barang</b></h3>
    <hr>
    <div class="row justify-content-center col-sm-12">
      <div class="card col-sm-7 col-md-6 shadow">
        <div class="card-body">
          <form action="crud/simpan_barang.php" method="POST">
            <div class="row">
              <div class="col-sm-12">
                <div class="mb-3">
                  <label for="id_barang">ID Barang</label>
                  <input type="text" name="id_barang" class="form-control" id="id_barang" value="<?= $id_barang; ?>" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="nama_barang">Nama Barang</label>
                  <input type="text" name="nama_barang" class="form-control" required id="nama_barang" value="<?= $barang['nama_barang']; ?>" onkeypress="return huruf(event)">
                </div>
                <div class="mb-3">
                  <label for="kategori">Kategori</label>
                  <select name="kategori" class="form-control" id="kategori">
                    <option value="" disabled selected>Pilih Kategori</option>
                    <?php
                    foreach ($categories as $category) { ?>
                      <option value="<?= $category['nama']; ?>" <?= $barang['kategori'] == $category['nama'] ? 'selected' : ''; ?>><?= $category['nama']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="harga">Harga</label>
                  <input type="text" name="harga" class="form-control" required id="harga" value="<?= $barang['harga']; ?>" onkeypress="return angka(event)">
                </div>
                <div class="mb-3">
                  <label for="stok">Stok</label>
                  <input type="text" name="stok" class="form-control" required id="stok" value="<?= $barang['stok']; ?>">
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="keterangan">Keterangan</label>
              <textarea type="text" name="keterangan" class="form-control" rows="3" required id="keterangan"><?= $barang['keterangan']; ?></textarea>
            </div>
            <div class="text-center">
              <button type="submit" name="<?= $sub; ?>" class="btn btn-sm btn-info">
                <i class="fas fa-check"></i> Selesai
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>