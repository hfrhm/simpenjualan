<?php
$title = 'Beranda';
?>
<style>
    .card-footer a {
        color: #000;
        font-size: 14px;
    }

    .card-footer a:hover {
        text-decoration: underline;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-12 m-4">
                <div class="card text-center shadow">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title"><i class="fa fa-chart-bar"></i> <b>Stok Barang</b></h5>
                    </div>
                    <i class="fas fa-chart-bar fa-2x my-3"></i>
                    <div class="card-footer m-4">
                        <a href="index.php?p=barang">
                            Selengkapnya
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 m-4">
                <div class="card text-center shadow">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title"><i class="fa fa-bookmark"></i> <b>Kategori Barang</b></h5>
                    </div>
                    <i class="fa fa-bookmark fa-2x my-3"></i>
                    <div class="card-footer m-4">
                        <a href="index.php?p=kategori">
                            Selengkapnya
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-12 m-4">
                <div class="card text-center shadow">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title"><i class="fa fa-upload"></i> <b>Telah Terjual</b></h5>
                    </div>
                    <i class="fa-2x my-3 fas fa-upload"></i>
                    <div class="card-footer m-4">
                        <a href="index.php?p=laporan_pertanggal">
                            Selengkapnya
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12 m-4">
                <div class="card text-center shadow">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <h5 class="card-title"><i class="fa fa-users"></i> <b>Pelanggan</b></h5>
                    </div>
                    <i class="fa-2x my-3 fa fa-users"></i>
                    <div class="card-footer m-4">
                        <a href="index.php?p=pelanggan">
                            Selengkapnya
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>