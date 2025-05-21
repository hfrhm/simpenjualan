<?php

include 'system/proses.php';

$tgl_awal = $_POST['tgl_awal'];
$tgl_akhir = $_POST['tgl_akhir'];
if (isset($_POST['cari'])
  ? $qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, transaksi.total", "transaksi", "INNER JOIN petugas on transaksi.id_petugas=petugas.id_petugas WHERE transaksi.tanggal >= '$tgl_awal' AND transaksi.tanggal <= '$tgl_akhir'")
  : $qw = $db->get("transaksi.id_transaksi, transaksi.tanggal, petugas.username, transaksi.total", "transaksi", "INNER JOIN petugas on transaksi.id_petugas=petugas.id_petugas")
);

$title = 'Laporan Per Tanggal';
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
    <h3><b>Laporan per Tanggal</b></h3>
    <hr>
    <div class="filter float-right">
      <form action="index.php?p=laporan_pertanggal" method="POST" class="form-inline">
        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control form-control-sm" value="<?= $_POST['tgl_awal'] ?? date('Y-m-d'); ?>">
        <span class="ml-1"><b>s/d</b></span>
        <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control form-control-sm ml-1" value="<?= $_POST['tgl_akhir'] ?? date('Y-m-d'); ?>">
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
    <table id="tabelLaporanTgl" class="table table-sm table-bordered">
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
        <?php
        foreach ($qw as $tampil) {
          $totbay = $tampil['total'];
        ?>
          <tr>
            <td><?= $tampil['id_transaksi']; ?></td>
            <td><?= $tampil['tanggal']; ?></td>
            <td><?= $tampil['username']; ?></td>
            <td><?= $tampil['total']; ?></td>
            <td><?= $totbay; ?></td>
            <td class="text-center">
              <button type="button" class="btn btn-sm btn-info" onclick="showDetailTgl('<?= $tampil['id_transaksi']; ?>')"><i class="fas fa-eye"></i></button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>
<iframe id="showPerTanggal" style="display: none"></iframe>

<script type="text/javascript">
  function cetak() {
    let tl = document.getElementById('tgl_awal').value;
    let tg = document.getElementById('tgl_akhir').value;
    if (tl == "" && tg == "") {
      alert("Lengkapi Tanggal Terlebih Dahulu");
      return false;
      tl.focus();
    }
    printFrame = document.getElementById('showPerTanggal');
    printFrame.src = "content/print_pertanggal.php?tgl_awal=" + tl + "&tgl_akhir=" + tg;
    printFrame.onload = function() {
      printFrame.contentWindow.focus();
      printFrame.contentWindow.print();
    };
  }

  function showDetailTgl(id) {
    let tl = document.getElementById('tgl_awal').value;
    let tg = document.getElementById('tgl_akhir').value;
    if (tl == "" && tg == "") {
      alert("Lengkapi Tanggal Terlebih Dahulu");
      return false;
      tl.focus();
    }
    printFrame = document.getElementById("showPerTanggal");
    printFrame.src = "struk/struk.php?idt=" + id;
    printFrame.onload = function() {
      printFrame.contentWindow.focus();
      printFrame.contentWindow.print();
    };
  }

  function showReports(count, element) {
    let table = document.getElementById("laporanTable");
    let rows = table.getElementsByTagName("tr");
    let paginationItems = document.querySelectorAll(".pagination .page-item");

    paginationItems.forEach(item => {
      item.classList.remove("active");
    });

    element.parentElement.classList.add("active");

    if (count === 'all') {
      for (let i = 1; i < rows.length; i++) {
        rows[i].style.display = "";
      }
    } else {
      for (let i = 1; i < rows.length; i++) {
        if (i <= count) {
          rows[i].style.display = "";
        } else {
          rows[i].style.display = "none";
        }
      }
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