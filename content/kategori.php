<?php

include 'system/proses.php';

$categories = $db->get('*', 'kategori', 'ORDER BY id_kategori ASC');
$title = 'Kategori';

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
          <li class="breadcrumb-item active">Kategori</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <h3><b>Kategori</b></h3>
    <hr>
    <table id="tabelKategori" class="table table-sm table-bordered">
      <thead>
        <tr class="text-center text-nowrap">
          <th>Kode</th>
          <th>Kategori</th>
          <?php if ($level == 'admin') { ?>
            <th>Action</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody id="result">
        <?php foreach ($categories as $category) { ?>
          <tr class="data-row">
            <td><?= $category['id_kategori'] ?></td>
            <td><?= $category['nama'] ?></td>
            <?php if ($level == 'admin') { ?>
              <td class="text-center text-nowrap">
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#<?= $category['nama'] ?>">
                  <i class="fas fa-trash"></i>
                </button>
                <a href="index.php?p=f_kategori&id_kategori=<?= $category['id_kategori'] ?>" class="btn btn-sm btn-warning">
                  <i class="fas fa-edit"></i>
                </a>
                <!-- Modal -->
                <div class="modal fade" id="<?= $category['nama'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Anda Yakin Ingin Menghapus Kategori Ini?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                        <a href="/crud/hapus_kategori.php?idj=<?= $category['id_kategori'] ?>" class="btn btn-danger btn-sm">
                          Ya, hapus
                        </a>
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