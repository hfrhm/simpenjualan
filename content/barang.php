<?php

include 'system/proses.php';

$title = 'Barang';
$products = $db->get('*', 'barang', 'ORDER BY id_barang ASC');

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
          <li class="breadcrumb-item active">Barang</li>
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
    <table id="tabelBarang" class="table table-sm table-bordered">
      <thead>
        <tr class="text-nowrap">
          <th>ID Barang</th>
          <th>Nama Barang</th>
          <th>Harga</th>
          <th>Stok</th>
          <th>Keterangan</th>
          <th>Kategori</th>
          <?php if ($level == 'admin') { ?>
            <th class="text-center">Action</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $product) { ?>
          <tr>
            <td><?= htmlspecialchars($product['id_barang']); ?></td>
            <td><?= htmlspecialchars($product['nama_barang']); ?></td>
            <td><?= htmlspecialchars($product['harga']); ?></td>
            <td><?= htmlspecialchars($product['stok']); ?></td>
            <td>
              <?= strlen($product['keterangan']) > 50 ? substr($product['keterangan'], 0, 50) . '...' : $product['keterangan']; ?>
            </td>
            <td><?= htmlspecialchars($product['kategori']); ?></td>
            <?php if ($level == 'admin') { ?>
              <td class="text-center text-nowrap">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete-modal-<?= $product['id_barang'] ?>">
                  <i class="fas fa-trash"></i>
                </button>
                <a href="index.php?p=f_barang&id_barang=<?= $product['id_barang']; ?>" class="btn btn-warning btn-sm">
                  <i class="fas fa-edit"></i>
                </a>

                <!-- Modal -->
                <div class="modal fade" id="delete-modal-<?= $product['id_barang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Anda Yakin Ingin Menghapus Barang Ini?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <form action="/crud/hapus_barang.php" method="post">
                          <input type="hidden" name="id_barang" value="<?= $product['id_barang']; ?>">
                          <button type="submit" class="btn btn-sm btn-danger">Ya, hapus</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            <?php } ?>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>