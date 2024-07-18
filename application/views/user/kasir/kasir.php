<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fontawesome-free/css/all.min.css');?>">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/adminlte.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/sweetalert2/sweetalert2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/select2/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') ?>">

  <div class="content-wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col">
            <h1 class="m-0 text-dark">Transaksi</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label>Barcode</label>
              <div class="form-inline">
                <select id="barcode" class="form-control select2 col-sm-6" onchange="getNama()"></select>
                <span class="ml-3 text-muted" id="nama_produk"></span>
              </div>
              <small class="form-text text-muted" id="sisa"></small>
            </div>
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" class="form-control col-sm-6" placeholder="Jumlah" id="jumlah" onkeyup="checkEmpty()">
            </div>
            <div class="form-group">
              <button id="tambah" class="btn btn-success" onclick="checkStok()" disabled>Tambah</button>
              <button id="bayar" class="btn btn-success" data-toggle="modal" data-target="#modal" disabled>Bayar</button>
            </div>
          </div>
          <div class="col-sm-6 d-flex justify-content-end text-right nota">
            <div>
              <div class="mb-0">
                <b class="mr-2">Nota</b> <span id="nota"></span>
              </div>
              <span id="total" style="font-size: 80px; line-height: 1" class="text-danger">0</span>
            </div>
          </div>
        </div>
        </div>
        <div class="card-body">
          <table class="table w-100 table-bordered table-hover" id="transaksi">
            <thead>
              <tr>
                <th>Barcode</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>

<div class="modal fade" id="modal">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Bayar</h5>
    <button class="close" data-dismiss="modal">
      <span>&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form id="form">
      <div class="form-group">
        <label>Tanggal</label>
        <input type="text" class="form-control" name="tanggal" id="tanggal" required>
      </div>
      <div class="form-group">
        <label>Pelanggan</label>
        <select name="pelannggan" id="pelanggan" class="form-control select2"></select>
      </div>
      <div class="form-group">
        <label>Jumlah Uang</label>
        <input placeholder="Jumlah Uang" type="number" class="form-control" name="jumlah_uang" onkeyup="kembalian()" required>
      </div>
      <div class="form-group">
        <label>Diskon</label>
        <input placeholder="Diskon" type="number" class="form-control" onkeyup="kembalian()" name="diskon">
      </div>
      <div class="form-group">
        <b>Total Bayar:</b> <span class="total_bayar"></span>
      </div>
      <div class="form-group">
        <b>Kembalian:</b> <span class="kembalian"></span>
      </div>
      <button id="add" class="btn btn-success" type="submit" onclick="bayar()" disabled>Bayar</button>
      <button id="cetak" class="btn btn-success" type="submit" onclick="bayarCetak()" disabled>Bayar Dan Cetak</button>
      <button class="btn btn-danger" data-dismiss="modal">Close</button>
    </form>
  </div>
</div>
</div>
</div>
<script src="<?php echo base_url('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?php echo base_url('assets/adminlte/plugins/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="<?php echo base_url('assets/adminlte/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/adminlte/plugins/select2/js/select2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/adminlte/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') ?>"></script>
<script src="<?php echo base_url('assets/adminlte/plugins/moment/moment.min.js') ?>"></script>
<script>
  var barangGetNamaUrl = '<?php echo site_url('barang/get_nama') ?>';
  var barangGetStokUrl = '<?php echo site_url('barang/get_stok') ?>';
  var addUrl = '<?php echo site_url('transaksi/add') ?>';
  var getBarcodeUrl = '<?php echo site_url('produk/get_barcode') ?>';
  var pelangganSearchUrl = '<?php echo site_url('pelanggan/search') ?>';
  var cetakUrl = '<?php echo site_url('transaksi/cetak/') ?>';
</script>
<script src="<?php echo base_url('assets/js/unminify/transaksi.js') ?>"></script>
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