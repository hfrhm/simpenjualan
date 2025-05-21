<?php
session_start();
error_reporting(0);

if (!isset($_SESSION['login'])) {
  header('Location: login.php');
  exit;
}

$level = $_SESSION['level'];

ob_start();
$current_page = $_GET['p'] ?? 'beranda';

if (empty($current_page)) {
  header('Location: index.php?p=beranda');
  exit;
} else {
  $page_file = "content/$current_page.php";
  if (file_exists($page_file)) {
    include $page_file;
  } else {
    echo "<div>Page not found.</div>";
  }
}

$content = ob_get_clean();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? $title . ' | Ajai Komputer' : 'Ajai Komputer' ?></title>

  <!-- Favicon -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/css/fontawesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/css/icheck-bootstrap.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/css/OverlayScrollbars.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <form action="/logout.php" method="post" onsubmit="return confirm('Yakin ingin logout?')">
            <button type="submit" class="btn btn-sm btn-outline-info">
              Logout <i class="nav-icon fas fa-sign-out-alt"></i>
            </button>
          </form>
        </li>
      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-dark elevation-4">
      <!-- Brand Logo -->
      <a href="index.php" class="brand-link text-center">
        <span class="brand-text font-weight-bold">AJAI KOMPUTER</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"><?= ucfirst($level); ?></a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php
            function active_class($page)
            {
              global $current_page;
              return in_array($current_page, (array)$page) ? 'active' : '';
            }
            function is_dropdown_active($page)
            {
              global $current_page;
              return in_array($current_page, (array)$page) ? 'menu-open' : '';
            }
            ?>
            <li class="nav-item">
              <a href="index.php" class="nav-link <?= active_class('beranda') ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>Beranda</p>
              </a>
            </li>
            <?php if ($level == "admin") { ?>
              <li class="nav-item">
                <a href="index.php?p=petugas" class="nav-link <?= active_class(['petugas', 'f_petugas']) ?>">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Petugas</p>
                </a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="index.php?p=barang" class="nav-link <?= active_class(['barang', 'f_barang']) ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?p=kategori" class="nav-link <?= active_class(['kategori', 'f_kategori']) ?>">
                <i class="nav-icon fas fa-list"></i>
                <p> Kategori</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?p=pelanggan" class="nav-link <?= active_class(['pelanggan', 'f_pelanggan']) ?>">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>Pelanggan</p>
              </a>
            </li>
            <?php if ($level != "manager") { ?>
              <li class="nav-item">
                <a href="index.php?p=transaksi" class="nav-link <?= active_class('transaksi') ?>">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Transaksi</p>
                </a>
              </li>
            <?php } ?>
            <?php if ($level != "kasir") { ?>
              <li class="nav-item <?= is_dropdown_active(['laporan_pertanggal', 'laporan_perbulan', 'laporan_pertahun']) ?>">
                <a href="#" class="nav-link <?= active_class(['laporan_pertanggal', 'laporan_perbulan', 'laporan_pertahun']) ?>">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>Laporan<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php?p=laporan_pertanggal" class="nav-link <?= active_class('laporan_pertanggal') ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Per Tanggal</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?p=laporan_perbulan" class="nav-link <?= active_class('laporan_perbulan') ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Per Bulan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?p=laporan_pertahun" class="nav-link <?= active_class('laporan_pertahun') ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Per Tahun</p>
                    </a>
                  </li>
                </ul>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="index.php?p=ganti_password" class="nav-link <?= active_class('ganti_password') ?>">
                <i class="nav-icon fas fa-user-lock"></i>
                <p>Ganti Password</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <div class="content-wrapper">
      <?= $content ?>
    </div>
  </div>

  <!-- jQuery -->
  <script src="assets/js/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="assets/js/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 4 -->
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables & Plugins -->
  <script src="assets/js/jquery.dataTables.min.js"></script>
  <script src="assets/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/js/dataTables.responsive.min.js"></script>
  <script src="assets/js/responsive.bootstrap4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="assets/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/js/adminlte.js"></script>
  <!-- JS -->
  <script src="assets/js/init-datatable.js"></script>
  <script src="assets/js/validasi.js"></script>
  <script src="assets/js/transaksi.js"></script>
</body>

</html>