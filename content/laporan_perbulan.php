<?php
include 'system/proses.php';
$title = 'Laporan Per Bulan';

$bulan = $_POST['bulan'] ?? date('m');
$tahun = $_POST['tahun'] ?? date('Y');
if (isset($_POST['cari'])
    ? $query = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, transaksi.total", "transaksi", "INNER JOIN petugas on transaksi.id_petugas=petugas.id_petugas WHERE month(transaksi.tanggal) = '$bulan' AND year(transaksi.tanggal)='$tahun'")
    : $query = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, transaksi.total", "transaksi", "INNER JOIN petugas on transaksi.id_petugas=petugas.id_petugas")
);
$data = $db->get("DISTINCT DATE_FORMAT(tanggal, '%Y') AS tahun", "transaksi", "ORDER BY tahun DESC");
$years = $data->fetchAll(PDO::FETCH_ASSOC);
if (empty($years)) {
    $years = [['tahun' => date('Y')]];
}
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
        <h3><b>Laporan per Bulan</b></h3>
        <hr>
        <div class="filter float-right">
            <form action="index.php?p=laporan_perbulan" method="POST" class="form-inline">
                <label for="bulan" class="form-label">Bulan: </label>
                <select name="bulan" id="bulan" class="form-control form-control-sm ml-1">
                    <?php
                    $months = [
                        ['value' => '01', 'name' => 'Januari'],
                        ['value' => '02', 'name' => 'Februari'],
                        ['value' => '03', 'name' => 'Maret'],
                        ['value' => '04', 'name' => 'April'],
                        ['value' => '05', 'name' => 'Mei'],
                        ['value' => '06', 'name' => 'Juni'],
                        ['value' => '07', 'name' => 'Juli'],
                        ['value' => '08', 'name' => 'Agustus'],
                        ['value' => '09', 'name' => 'September'],
                        ['value' => '10', 'name' => 'Oktober'],
                        ['value' => '11', 'name' => 'November'],
                        ['value' => '12', 'name' => 'Desember'],
                    ];
                    foreach ($months as $month) { ?>
                        <option value="<?= $month['value'] ?>" <?= $month['value'] == $bulan ? "selected" : "" ?>><?= $month['name'] ?></option>
                    <?php } ?>
                </select>
                <label for="tahun" class="form-label ml-1">Tahun: </label>
                <select name="tahun" id="tahun" class="form-control form-control-sm ml-2">
                    <?php
                    foreach ($years as $year) { ?>
                        <option value="<?= $year['tahun'] ?>" <?= $year['tahun'] == $tahun ? "selected" : "" ?>><?= $year['tahun'] ?></option>
                    <?php } ?>
                </select>
                <button type="submit" name="cari" class="btn btn-sm btn-secondary ml-2">
                    <i class="fas fa-search"></i> Cari
                </button>
                <button type="button" class="btn btn-sm btn-success ml-1" onclick="cetak()">
                    <i class="fas fa-print"></i> Cetak
                </button>
                <button type="button" class="btn btn-sm btn-info ml-1" onclick="downloadCSV()">
                    <i class="fas fa-download"></i> Download
                </button>
            </form>
        </div>
        <table id="tabelLaporanBln" class="table table-sm table-bordered">
            <thead>
                <tr class="text-nowrap">
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Nama User</th>
                    <th>Total</th>
                    <th>Total Bayar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($query->fetchAll(PDO::FETCH_ASSOC) as $tampil) { ?>
                    <tr>
                        <td><?= $tampil['id_transaksi']; ?></td>
                        <td><?= $tampil['tanggal']; ?></td>
                        <td><?= $tampil['username']; ?></td>
                        <td><?= $tampil['total']; ?></td>
                        <td><?= $tampil['total']; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<iframe id="showPerBulan" style="display: none"></iframe>

<script type="text/javascript">
    function cetak() {
        let bln = document.getElementById('bulan').value;
        let thn = document.getElementById('tahun').value;
        printFrame = document.getElementById('showPerBulan');
        printFrame.src = "content/print_perbulan.php?bulan=" + bln + "&tahun=" + thn;
        printFrame.onload = function() {
            printFrame.contentWindow.focus();
            printFrame.contentWindow.print();
        }
    }

    function downloadCSV() {
        let csv = [];
        let rows = document.querySelectorAll("table tr");

        for (let i = 0; i < rows.length; i++) {
            let row = [],
                cols = rows[i].querySelectorAll("td, th");

            for (let j = 0; j < cols.length; j++) {
                row.push(cols[j].innerText);
            }
            csv.push(row.join(","));
        }

        let csvFile = new Blob([csv.join("\n")], {
            type: "text/csv"
        });
        let downloadLink = document.createElement("a");
        downloadLink.download = "laporan.csv";
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = "none";

        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
</script>
