<!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Kasirku | Tabel Transaksi</title>
      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fontawesome-free/css/all.min.css');?>">
      <!-- icheck bootstrap -->
      <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
      <!-- Theme style -->
      <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/adminlte.min.css');?>">
      <!-- DataTables -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
      <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Tabel Transaksi</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Tabel Transaksi</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-11">
                <div class="card" style="width: 110%;">
   
                  <!-- /.card-header -->
                  <?= $this->session->flashdata('massage'); ?>
                  <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="text-center">
                          <th style="width: 10px" class="text-center">No</th>
                          <th style="width: 50px">Invoice</th>
                          <th style="width: 220px" class="text-center">Barang</th>
                          <th style="width: 50px">Pelanggan</th>
                          <th style="width: 50px">Jumlah</th>
                          <th style="width: 50px">Total</th>
                          <th style="width: 50px">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php if (empty($transaksi)) { ?>
                              <tr>
                                  <td colspan="8" class="text-center">Tidak ada item</td>
                              </tr>
                          <?php } else { ?>
                              <?php $no = $this->uri->segment('3') + 1; foreach ($transaksi as $val) { ?>
                                  <tr>
                                      <td><?php echo $no; ?></td>
                                      <td><?php echo $val->invoice; ?></td>
                                      <td><?php echo $val->nama_barang; ?></td>
                                    <td><?php echo $val->nama_pelanggan; ?></td>
                                    <td><?php echo $val->jumlah; ?></td>
                                      <td><?php echo indo_currency($val->total); ?></td>
                                      <td>
                                          <div class="btn-group">
                                              <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editTransaksiModal<?= $val->id_transaction; ?>"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</a>
                                              <a href="<?php echo site_url('transaksi/delete/' . $val->id_transaction); ?>" onclick="return confirm('Yakin Hapus Data ini?')" class="btn btn-danger"><i class="fa-solid fa-trash"></i>&nbsp;Hapus</a>
                                          </div>
                                      </td>
                                  </tr>
                                  <?php $no++;
                              }; ?>
                          <?php } ?>
                      </tbody>
                    </table class="table table-bordered" id="barangTable">

                    <!-- Modal Tambah Transaksi -->
                    <div class="modal fade" id="tambahTransaksiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form tambah data Transaksi di sini -->
                            <form method="post" action="<?php echo site_url('transaction/save'); ?>" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="invoice">Invoice</label>
                                <input type="text" name="invoice" id="invoice" class="form-control"  value="<?= generate_invoice_code(); ?>" readonly required>
                              </div>
                              <div class="form-group">
                              <label for="id_barang">Barang</label>
                                    <select name="id_barang_1" id="id_barang_1" class="form-control" required>
                                        <option value="">Pilih Barang</option>
                                        <?php foreach ($barang as $row): ?>
                                            <option value="<?= $row->id_barang; ?>"><?= $row->nama_barang; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                              </div>
                              <div class="form-group">
                                <label for="id_pelanggan">Pelanggan</label>
                                    <select name="id_pelanggan" id="id_pelanggan" class="form-control" required>
                                        <option value="">Pilih Pelanggan</option>
                                        <?php foreach ($pelanggan as $row): ?>
                                            <option value="<?= $row->id_pelanggan; ?>"><?= $row->nama_pelanggan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                              </div>
                              <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" name="total" id="total" class="form-control" required>
                              </div>
                                <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user'); ?>">
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                              </div>
                            </form>
                          </div>                     
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Edit Transaksi -->
                  <?php foreach ($transaksi as $val) : ?>
                    <div class="modal fade" id="editTransaksiModal<?= $val->id_transaction; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Transaksi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form edit data Transaksi di sini -->
                            <form method="post" action="<?php echo site_url('transaksi/update'); ?>" enctype="multipart/form-data">
                              <input type="hidden" name="id_transaction" value="<?php echo $val->id_transaction; ?>" id="edit_id_transaksi" class="form-control" required>
                              <div class="form-group">
                                <label for="edit_invoice">Invoice</label>
                                <input type="text" name="invoice" id="edit_invoice" value="<?php echo $val->invoice; ?>" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label for="edit_id_barang">Barang </label>
                                <select name="id_barang" id="edit_id_barang" class="form-control" required>
                                  <option value="">Pilih Barang </option>
                                  <?php foreach ($barang as $row) : ?>
                                    <option value="<?= $row->id_barang; ?>" <?php echo ($row->id_barang == $val->id_barang) ? 'selected' : ''; ?>><?php echo $row->nama_barang; ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="edit_pelanggan">Pelanggan</label>
                                <select name="id_pelanggan" id="edit_id_pelanggan" class="form-control" required>
                                  <option value="">Pilih Pelanggan</option>
                                  <?php foreach ($pelanggan as $row) : ?>
                                    <option value="<?= $row->id_pelanggan; ?>" <?php echo ($row->id_pelanggan == $val->id_pelanggan) ? 'selected' : ''; ?>><?php echo $row->nama_pelanggan; ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="total">Total</label>
                                <input type="text" name="total" id="total" class="form-control" required>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                  <!-- /. card body -->
                  <div class="card-footer clearfix">
                    <a href="#" class="btn btn-sm btn-info float-left" data-toggle="modal" data-target="#tambahTransaksiModal">+ Tambah Data Transaksi</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      
    <script>
      document.getElementById('kategori').addEventListener('change', function() {
        var selectedCategoryId = this.value;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
          if (this.readyState === 4 && this.status === 200) {
            document.getElementById('barang').innerHTML = this.responseText;
          }
        };

        var url = "<?php echo base_url('index.php/barang/get_barang_by_kategori/'); ?>" + selectedCategoryId;
        xhr.open('GET', url, true);
        xhr.send();
      });
    </script>
    <script>
        document.getElementById('exportExcelBtn').addEventListener('click', function () {
            // Implementasi logika untuk mengirim data ke server dan membuat file Excel
            // Anda dapat menggunakan library atau meng-handle server-side di sini
            // Contoh sederhana: window.location.href = "<?php echo site_url('barang/export_excel'); ?>";
            alert('Implementasi export Excel di sini');
        });
    </script>
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/admin/plugins/jquery/jquery.min.js');?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url('assets/admin/plugins/jquery-ui/jquery-ui.min.js');?>"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
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