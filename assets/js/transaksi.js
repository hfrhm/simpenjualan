function searchUserById() {
  $.ajax({
    url: '/content/cari_plg.php',
    type: 'POST',
    dataType: 'json',
    data: {
      id_pelanggan: $('#id_pelanggan').val()
    },
    success: function (hasil) {
      $('#nama_pelanggan').val(hasil.nama_pelanggan)
    },
    error: function () {
      $('#nama_pelanggan').val('')
    }
  })
}

function searchUserByName() {
  $.ajax({
    url: '/content/cari_plg.php',
    type: 'POST',
    dataType: 'json',
    data: {
      nama_pelanggan: $('#nama_pelanggan').val()
    },
    success: function (hasil) {
      $('#id_pelanggan').val(hasil.id_pelanggan)
    },
    error: function () {
      $('#id_pelanggan').val('')
    }
  })
}

function searchProductById() {
  $.ajax({
    url: '/content/cari_brg.php',
    type: 'POST',
    dataType: 'json',
    data: {
      id_barang: $('#id_barang').val()
    },
    success: function (hasil) {
      $('#nama_barang').val(hasil.nama_barang)
      $('#harga').val(hasil.harga)
    },
    error: function () {
      $('#nama_barang').val('')
      $('#harga').val('')
    }
  })
}

function deteleDetailTrans(h) {
  $.ajax({
    url: '/crud/hapus_detail.php',
    type: 'POST',
    data: {
      id_detail_transaksi: h
    },
    success: function (hasil) {
      alert(hasil)
      openTab()
    }
  })
}

function ttl() {
  $('#subtotal').val($('#harga').val() * $('#jumlah_beli').val())
}

function saveDetailTrans() {
  $.ajax({
    url: '/crud/simpan_detail.php',
    type: 'POST',
    dataType: 'json',
    data: {
      id_transaksi: $('#id_transaksi').val(),
      id_barang: $('#id_barang').val(),
      jumlah_beli: $('#jumlah_beli').val(),
      subtotal: $('#subtotal').val()
    },
    success: function (response) {
      if (!response.failed) {
        alert(response)
        openTab()
        $('#bayar').focus()
      } else {
        alert(response.message)
      }
    }
  })
}

function deleteDetail(id) {
  $.ajax({
    url: '/crud/hapus_detail.php',
    type: 'POST',
    data: { id_detail_transaksi: id },
    success: function (params) {
      alert(params)
      openTab()
    }
  })
}

function openTab() {
  id = $('#id_transaksi').val()
  $('#kotak-detail').load('/content/detail_trans.php?id_transaksi=' + id)
}

function pay() {
  b = $('#bayar').val()
  tb = $('#total').val()
  rsl = b - tb
  $('#kembali').val(rsl)
}

function saveTrans() {
  $.ajax({
    url: '/crud/simpan_transaksi.php',
    type: 'POST',
    dataType: 'json',
    data: {
      id_transaksi: $('#id_transaksi').val(),
      id_pelanggan: $('#id_pelanggan').val() || 'non-pelanggan',
      id_petugas: $('#id_petugas').val(),
      tanggal: $('#tanggal').val(),
      total: $('#total').val(),
      bayar: $('#bayar').val(),
      kembali: $('#kembali').val()
    },
    success: function (data) {
      let confirmed = confirm('Transaksi Berhasil!. Print struk?')
      if (confirmed) {
        printStruck(data.id_transaksi)
      } else {
        window.location.href = 'index.php?p=transaksi'
      }
    },
    error: function (xhr, status, error) {
      console.error('AJAX Error: ', status, error)
      console.error('Response Text: ', xhr.responseText)
      alert('An error occurred. Check the console for details.')
    }
  })
}

function printStruck(id) {
  printFrame = document.getElementById('printFrame')
  printFrame.src = '/struk/struk.php?id_transaksi=' + id
  printFrame.onload = function () {
    printFrame.contentWindow.focus()
    printFrame.contentWindow.print()
  }
}

$(document).ready(function () {
  $('#lpr1').hide()
  $('#lpr2').hide()
  $('#lpr3').hide()
  $('#lpr').click(function () {
    $('#lpr1').slideToggle('slow')
    $('#lpr2').slideToggle('slow')
    $('#lpr3').slideToggle('slow')
  })

  $('#kategori').change(function () {
    selectedValue = $(this).val()
    if (selectedValue == 'non_pelanggan') {
      $('#id_pelanggan').val('').hide().prev('label').hide()
      $('#nama_pelanggan').val('').hide().prev('label').hide()
    } else {
      $('#id_pelanggan').show().prev('label').show()
      $('#nama_pelanggan').show().prev('label').show()
    }
  })
})
