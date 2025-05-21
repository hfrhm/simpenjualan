function initDataTable(tableId, level = false, url = '', text = '') {
  $(tableId).DataTable({
    autoWidth: false,
    scrollX: true,
    language: {
      decimal: '',
      emptyTable: 'Tidak ada data tersedia di tabel',
      info: 'Menampilkan _START_ hingga _END_ dari _TOTAL_ entri',
      infoEmpty: 'Menampilkan 0 hingga 0 dari 0 entri',
      infoFiltered: '(disaring dari _MAX_ total entri)',
      infoPostFix: '',
      thousands: ',',
      lengthMenu: 'Tampilkan _MENU_ entri',
      loadingRecords: 'Memuat...',
      processing: 'Sedang memproses...',
      search: 'Cari:',
      zeroRecords: 'Tidak ada hasil yang cocok ditemukan',
      paginate: {
        first: 'Pertama',
        last: 'Terakhir',
        next: "<span aria-hidden='true'>&raquo;</span>",
        previous: "<span aria-hidden='true'>&laquo;</span>"
      },
      aria: {
        sortAscending: ': aktifkan untuk mengurutkan kolom secara ascending',
        sortDescending: ': aktifkan untuk mengurutkan kolom secara descending'
      }
    }
  })

  if (level) {
    $(tableId + '_filter').append(
      `<a href="${url}" class="btn btn-info btn-sm ml-2">${text}</a>`
    )
  }
}

$(document).ready(function () {
  $.ajax({
    type: 'POST',
    url: 'system/cek_level.php',
    success: function (data) {
      const level = data == 'admin'

      initDataTable(
        '#tabelPetugas',
        level,
        'index.php?p=f_petugas',
        '<i class="fas fa-user-plus"></i>'
      )

      initDataTable(
        '#tabelBarang',
        level,
        'index.php?p=f_barang',
        '<i class="fas fa-cart-plus"></i>'
      )

      initDataTable(
        '#tabelPelanggan',
        level,
        'index.php?p=f_pelanggan',
        '<i class="fas fa-user-plus"></i>'
      )

      initDataTable(
        '#tabelKategori',
        level,
        'index.php?p=f_kategori',
        '<i class="fas fa-plus"></i>'
      )

      initDataTable('#tabelLaporanTgl')
      $('#tabelLaporanTgl_filter label').remove()
      $('.filter').appendTo('#tabelLaporanTgl_wrapper .col-md-6:eq(1)')

      initDataTable('#tabelLaporanBln')
      $('#tabelLaporanBln_filter label').remove()
      $('.filter').appendTo('#tabelLaporanBln_wrapper .col-md-6:eq(1)')

      initDataTable('#tabelLaporanThn')
      $('#tabelLaporanThn_filter label').remove()
      $('.filter').appendTo('#tabelLaporanThn_wrapper .col-md-6:eq(1)')
    }
  })
})
