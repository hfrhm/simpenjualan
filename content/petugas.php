<?php

include 'system/proses.php';

$users = $db->get('*', 'petugas', 'ORDER BY id_petugas ASC');
$title = 'Petugas';

?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
          <li class="breadcrumb-item active">Petugas</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <h3><b>Petugas</b></h3>
    <hr>
    <table id="tabelPetugas" class="table table-sm table-bordered">
      <thead>
        <tr class="text-nowrap">
          <th>ID</th>
          <th>Username</th>
          <th>Password</th>
          <th>Level</th>
          <th class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($users as $user) {
        ?>
          <tr>
            <td><?= $user['id_petugas']; ?></td>
            <td><?= $user['username']; ?></td>
            <td><?= $user['password']; ?></td>
            <td><?= $user['level']; ?></td>
            <td class="text-center">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#<?= $user['id_petugas']; ?>">
                <i class="fas fa-trash"></i>
              </button>
              <a href="index.php?p=f_petugas&id_petugas=<?= $user['id_petugas']; ?>" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
              </a>
            </td>
          </tr>
          <!-- Modal -->
          <div class="modal fade" id="<?= $user['id_petugas']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Anda Yakin Ingin Menghapus petugas Ini?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                  <form action="crud/hapus_petugas.php" method="post">
                    <input type="hidden" name="id_petugas" value="<?= $user['id_petugas'] ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Ya, hapus</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</section>