<?php

include 'system/proses.php';

$users = $db->get('*', 'pelanggan', 'ORDER BY id_pelanggan ASC');
$title = 'Pelanggan';

?>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
          <li class="breadcrumb-item active">Pelanggan</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <h3><b>Pelanggan</b></h3>
    <hr>
    <table id="tabelPelanggan" class="table table-sm table-bordered">
      <thead>
        <tr class="text-nowrap">
          <th>ID</th>
          <th>Nama Pelanggan</th>
          <th>Alamat</th>
          <th>Telpon</th>
          <th>Keterangan</th>
          <?php if ($level == 'admin') { ?>
            <th class="text-center">Action</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($users as $user) {
        ?>
          <tr>
            <td><?= htmlspecialchars($user['id_pelanggan']); ?></td>
            <td><?= htmlspecialchars($user['nama']); ?></td>
            <td><?= htmlspecialchars($user['alamat']); ?></td>
            <td><?= htmlspecialchars($user['telpon']); ?></td>
            <td><?= htmlspecialchars($user['keterangan']); ?></td>
            <?php if ($level == 'admin') { ?>
              <td class="text-center text-nowrap">
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#<?= $user['id_pelanggan']; ?>">
                  <i class="fas fa-trash"></i>
                </button>
                <a href="index.php?p=f_pelanggan&id_pelanggan=<?= $user['id_pelanggan']; ?>" class="btn btn-sm btn-warning">
                  <i class="fas fa-edit"></i>
                </a>
                <!-- Modal -->
                <div class="modal fade" id="<?= $user['id_pelanggan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Anda Yakin Ingin Menghapus Pelanggan Ini?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="crud/hapus_pelanggan" method="post">
                          <input type="hidden" name="id_pelanggan" value="<?= $user['id_pelanggan']; ?>">
                          <button type="submit" class="btn btn-sm btn-danger">Ya, hapus</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            <?php } ?>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</section>