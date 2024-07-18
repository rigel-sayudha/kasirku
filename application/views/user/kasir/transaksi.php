    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fontawesome-free/css/all.min.css');?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/adminlte.min.css');?>">
      <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <div class="content-wrapper">
  <section class="content-header">
    <h1>Kasir
        <small>Penjualan</small>
    </h1>
    <ol class="breadcrumb float-sm-right">
      <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
      <li class="breadcrumb-item">Transaction</li>
      <li class="breadcrumb-item active">Kasir</li>
    </ol>
  </section>

  <section class="content">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <table width="100%">
                <tr>
                  <td style="vertical-align:top">
                    <label for="date">Date</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="date" id="date" value="<?=date('Y-m-d')?>" class="form-control">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align:top; width:30%">
                  <label for="pelanggan">Pelanggan</label>
                  </td>
                  <td>
                    <div>
                      <select id="pelanggan" name="pelanggan" class="form-control">
                        <option value="">Pilih Pelanggan</option>
                        <?php foreach($pelanggan as $pel => $value) {
                          echo '<option value="'.$value->id_pelanggan.'">'.$value->nama_pelanggan.'</option>';
                        } ?>
                      </select>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <table width="100%">
                <tr>
                  <td style="vertical-align:top; width:30%">
                    <label for="barcode">Barcode</label>
                  </td>
                  <td>
                    <div class="form-group input-group">
                      <input type="hidden" id="id_barang">
                      <input type="hidden" id="harga">
                      <input type="hidden" id="stok">
                      <input type="text" id="barcode" class="form-control" autofocus>
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-item">
                          <i class="fa fa-search"></i>
                        </button>
                      </span>
                    </div>
                  </td>
                </tr>
                <tr>
                  <td style="vertical-align:top">
                    <label for="qty">Qty</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="number" id="qty" value="1" min="1" class="form-control">
                    </div>
                  </td>
                </tr>
                <tr>
                  <td>
                    <div>
                      <button type="button" id="add_cart" class="btn btn-primary">
                        <i class="fa fa-cart-plus"></i>Add
                      </button>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <div align="right">
                <h4>Invoice <b><span id="invoice"><?= $invoice ?></span></b></h4>
                <h1><b><span id="grand_total2" style="font-size:50pt">0</span></b></h1>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Barcode</th>
                    <th>Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th width="10%">Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="cart_table">

                  <?php $this->view('user/kasir/cart_data') ?>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <table width="100%">
                <tr>
                  <td style="vertical-align:top; width:30%">
                    <label for="sub_total">Sub Total</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="number" id="sub_total" value="" class="form-control" readonly>
                    </div>
                  </td>
                </tr>    
                <tr>
                  <td style="vertical-align:top; width:30%">
                    <label for="grand_total">Grand Total</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="number" id="grand_total" value="" class="form-control" readonly>
                    </div>
                  </td>
                </tr>                  
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <table width="100%">
                <tr>
                  <td style="vertical-align:top; width:30%">
                    <label for="cash">Cash</label>
                  </td>
                  <td>
                    <div class="form-group">
                      <input type="number" id="cash" value="0" min="0" class="form-control">
                    </div>
                  </td>
                </tr>
                <tr>
                <td style="vertical-align:top; width:30%">
                    <label for="cash">Change</label>
                  </td>           
                  <td>
                    <div class="form-group">
                      <input type="number" id="change" class="form-control" readonly>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div class="card">
            <div class="card-body">
              <table width="100%">
                <tr>
                  <td style="vertical-align:top">
                    <label for="note">Note</label>
                  </td>
                  <td>
                    <div>
                      <textarea id="note" rows="3" class="form-control"></textarea>
                    </div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <div class="col-lg-3">
          <div>
            <button id="cancel_payment" class="btn btn-flat btn-warning">
              <i class="fa fa-refresh"></i> Bersihkan Cart
            </button><br><br>
            <button id="process_payment" class="btn btn-flat btn-lg btn-success">
              <i class="fa fa-paper-plane-o"></i> Proses Pembayaran
            </button>
          </div>
        </div>
      </div>
  </div>
  </section>
        <div class="modal fade" id="modal-item">
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">                      
                        <h4 class="modal-title">Add Barang Item</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                  <div class="modal-body table-responsive">
                        <table class="table table-bordered table-striped" id="table1">
                          <thead>
                            <tr>
                              <th>Barcode</th>
                              <th>Nama Barang</th>
                              <th>Harga</th>
                              <th>Stok</th>
                              <th>Aksi</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($barang as $data) { ?>
                              <tr>
                                <td><?php echo $data->barcode?></td>
                                <td><?php echo $data->nama_barang?></td>
                                <td class="text-right"><?php echo indo_currency($data->harga)?></td>
                                <td class="text-right"><?php echo $data->stok?></td>
                                <td class="text-right">
                                  <button class="btn btn-xs btn-info" id="select"
                                      data-id="<?php echo $data->id_barang?>"
                                      data-barcode="<?php echo $data->barcode?>"
                                      data-harga="<?php echo indo_currency($data->harga)?>"
                                      data-stok="<?php echo $data->stok?>">
                                      <i class="fa fa-check"></i> Select
                                  </button>
                                </td>
                              </tr>
                              <?php } ?>
                          </tbody>
                        </table>
                  </div>
              </div>
            </div>
        </div>
        <script>
function showDeleteConfirmation(event) {
    event.preventDefault(); // Prevent the default behavior of the link
    
    // Show SweetAlert confirmation dialog
    Swal.fire({
      title: 'Hapus Data',
      text: 'Yakin Hapus Data ini?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Ya, Hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // If the user clicks "Ya, Hapus!", proceed with the deletion
        window.location.href = event.target.href;
      }
    });
  }
</script>

  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Letakkan library jQuery terlebih dahulu -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/admin/plugins/jquery-ui/jquery-ui.min.js');?>"></script>
  <script>
    $(document).on('click', '#select', function() {
        $('#id_barang').val($(this).data('id'))
        $('#barcode').val($(this).data('barcode'))
        $('#harga').val($(this).data('harga'))
        $('#stok').val($(this).data('stok'))
        $('#modal-item').modal('hide')
    })

    $(document).on('click', '#add_cart', function() {
        var id_barang = $('#id_barang').val()
        var harga = $('#harga').val()
        var stok = $('#stok').val()
        var qty = $('#qty').val()
        if (id_barang == '') {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Barang belum dipilih!',
          });
          $('#barcode').focus();
    } else if (stok < 1) {
          Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Stok tidak mencukupi!',
          });
          $('#id_barang').val('');
          $('#barcode').val('');
          $('#barcode').focus();
      } else {
            $.ajax({
                type: 'POST',
                url: '<?=site_url('transaksi/proses');?>',
                data: {'add_cart': true, 'id_barang': id_barang, 'harga': harga, 'qty': qty},
                dataType: 'text',
                success: function(result) {
                  console.log(result); 
                    if (result.success == true) {
                        alert ('Gagal tambah item cart')
                    } else {
                      $('#cart_table').load('<?=site_url('transaksi/cart_data')?>', function() {
                        window.location.reload(); 
                        });
                    }
                }
            });
        }
    });

    $(document).on('click', '#update_cart_modal', function() {
    var id_cart = $(this).data('id');
    var barcode = $(this).data('barcode');
    var harga = $(this).data('harga');
    var stok = $(this).data('stok');
    var qty = $(this).data('qty');
    var total = $(this).data('total');

    // Populate modal fields with the retrieved data
    $('#id_cart_update').val(id_cart);
    $('#barcode_update').val(barcode);
    $('#harga_update').val(harga);
    $('#stok_update').val(stok);
    $('#qty_update').val(qty);
    $('#total_update').val(total);

    // Show the update modal
    $('#modal-item-update').modal('hide');
});

// Modify the AJAX call for update_cart
$(document).on('click', '#update_cart', function() {
    var id_cart = $('#id_cart_update').val();
    var harga = $('#harga_update').val();
    var qty = $('#qty_update').val();

    $.ajax({
        type: 'POST',
        url: '<?=site_url('transaksi/update_cart');?>',
        data: {'update_cart': true, 'id_cart': id_cart, 'harga': harga, 'qty': qty},
        dataType: 'json',
        success: function(result) {
            if (result.success == true) {
                alert('Berhasil update cart');
            } else {
                alert('Gagal update cart');
            }
        },
        error: function(xhr, status, error) {
            alert('AJAX Error: ' + error);
        }
    });
});
  
    function calculate() {
    var subtotal = 0;
    $('#cart_table tr').each(function() {
        subtotal += parseInt($(this).find('#total').text())
    })
    isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

    var grand_total = subtotal
    if (isNaN(grand_total)) {
        $('#grand_total').val(0)
        $('#grand_total2').text(0)
    } else {
        $('#grand_total').val(grand_total)
        $('#grand_total2').text(grand_total)
    }

    var cash = $('#cash').val();
    cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0)
}

$(document).on('keyup mouseup', '#cash', function() {
    calculate()
})

$(document).ready(function() {
    calculate()
})

$(document).on('click', '#process_payment', function() {
  var id_pelanggan = $('#pelanggan').val()
  var subtotal = $('#sub_total').val()
  var grandtotal = $('#grand_total').val()
  var cash = $('#cash').val()
  var change = $('#change').val()
  var note = $('#note').val()
  var date = $('#date').val()
  if (!id_pelanggan) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Pelanggan belum dipilih!',
        });
        return; // Hentikan proses selanjutnya jika pelanggan belum dipilih
    }

    if (subtotal < 1) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Belum ada produk yang dipilih!',
    });
    $('#barcode').focus();
  } else if (cash < 1) {
      Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Jumlah uang cash belum diinput!',
      });
      $('#cash').focus();
  } else {
    if (confirm('Yakin proses transaksi ini?')) {
    $.ajax({
        type: 'POST',
        url: '<?=site_url('transaksi/proses');?>', // Perbarui URL sesuai kebutuhan
        data: {
            'process_payment': true,
            'id_pelanggan': id_pelanggan,
            'subtotal': subtotal,
            'grandtotal': grandtotal,
            'cash': cash,
            'change': change,
            'note': note,
            'date': date
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success == true) {
                alert('Transaksi berhasil');
            } else {
                alert('Transaksi gagal');
            }
            location.href = '<?=site_url('transaksi')?>';
        },
        error: function (xhr, status) {
            console.error(xhr.responseText);
            Swal.fire({
                icon: 'success',
                title: 'Transaksi Berhasil',
                text: 'Transaksi telah berhasil dilakukan.',
            });
        }
    });
  }
  }
})

$(document).on('click', '#cancel_payment', function() {
  if (confirm('Yakin ingin membatalkan transaksi dan menghapus semua item dari keranjang?')) {
    $.ajax({
        type: 'POST',
        url: '<?=site_url('transaksi/reset_cart');?>', // Tambahkan URL reset_cart sesuai kebutuhan
        data: {
            'reset_cart': true,
        },
        dataType: 'json',
        success: function(result) {
            console.log(result);
            if (result.success == true) {
                  Swal.fire({
                      title: 'Keranjang dibersihkan',
                      text: 'Semua item dari keranjang dihapus.',
                      icon: 'success',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                  }).then((result) => {
                      if (result.isConfirmed) {
                          location.reload(); // Refresh halaman setelah reset
                      }
                  });
              } else {
                  Swal.fire({
                      title: 'Gagal Membatalkan Transaksi',
                      text: 'Terjadi kesalahan saat membatalkan transaksi.',
                      icon: 'error',
                      confirmButtonColor: '#3085d6',
                      confirmButtonText: 'OK'
                  });
              }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('AJAX Error: ' + error);
        }
    });
  }
});

</script>

  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url('assets/admin/plugins/chart.js/Chart.min.js');?>"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url('assets/admin/plugins/sparklines/sparkline.js');?>"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url('assets/admin/plugins/jqvmap/jquery.vmap.min.js');?>"></script>
  <script src="<?php echo base_url('assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js');?>"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url('assets/admin/plugins/jquery-knob/jquery.knob.min.js');?>"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url('assets/admin/plugins/moment/moment.min.js');?>"></script>
  <script src="<?php echo base_url('assets/admin/plugins/daterangepicker/daterangepicker.js');?>"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url('assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js');?>"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url('assets/admin/plugins/summernote/summernote-bs4.min.js');?>"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url('assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js');?>"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/admin/dist/js/adminlte.js');?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url('assets/admin/dist/js/demo.js');?>"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url('assets/admin/dist/js/pages/dashboard.js');?>"></script>