<?php
include 'system/proses.php';
$title = 'Laporan Per Tahun';

$tahun = $_POST['tahun'] ?? date('Y');
if (isset($_POST['cari'])
    ? $qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, transaksi.total", "transaksi", "INNER JOIN petugas on transaksi.id_petugas=petugas.id_petugas WHERE year(transaksi.tanggal)='$tahun'")
    : $qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, transaksi.total", "transaksi", "INNER JOIN petugas on transaksi.id_petugas=petugas.id_petugas")
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
        <h3><b>Laporan per Tahun</b></h3>
        <hr>
        <div class="filter float-right">
            <form action="index.php?p=laporan_pertahun" method="POST" class="form-inline">
                <label for="tahun" class="form-label">Tahun: </label>
                <select name="tahun" id="tahun" class="form-control form-control-sm ml-1">
                    <?php foreach ($years as $row) { ?>
                        <option value="<?= $row['tahun']; ?>" <?= $row['tahun'] == $tahun ? 'selected' : ''; ?>><?= $row['tahun']; ?></option>
                    <?php } ?>
                </select>
                <button type="submit" name="cari" class="btn btn-secondary btn-sm ml-2">
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
        <table id="tabelLaporanThn" class="table table-sm table-bordered">
            <thead>
                <tr class="text-nowrap">
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Nama User</th>
                    <th>Total</th>
                    <th>Total Bayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($qw as $tampil) {
                ?>
                    <tr>
                        <td><?= $tampil['id_transaksi']; ?></td>
                        <td><?= $tampil['tanggal']; ?></td>
                        <td><?= $tampil['username']; ?></td>
                        <td><?= $tampil['total']; ?></td>
                        <td><?= $tampil['total']; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-info" onclick="showDetailThn('<?= $tampil['id_transaksi']; ?>')"><i class="fas fa-eye"></i></button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</section>
<iframe id="showPerTahun" style="display: none;"></iframe>
<script type="text/javascript">
    function cetak() {
        let tahun = document.getElementById('tahun').value;
        if (tahun == '') {
            alert("Lengkapi Tahun Terlebih Dahulu.");
            return false;
            tahun.focus();
        }
        printFrame = document.getElementById('showPerTahun');
        printFrame.src = "content/print_pertahun.php?tahun=" + tahun;
        printFrame.onload = function() {
            printFrame.contentWindow.focus();
            printFrame.contentWindow.print();
        }
    }

    function showDetailThn(id) {
        let tahun = document.getElementById('tahun').value;
        if (tahun == '') {
            alert("Lengkapi Tahun Terlebih Dahulu.");
            return false;
            tahun.focus();
        }
        printFrame = document.getElementById('showPerTahun');
        printFrame.src = "struk/struk.php?idt=" + id;
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
