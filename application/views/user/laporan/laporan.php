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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Laporan Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Penjualan</li>
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
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Laporan Penjualan</h3>
                
              </div>
              <!-- /.card-header -->
              <?= $this->session->flashdata('massage'); ?>
              <div class="card-body">
                <table class="table table-bordered" id="pelangganTable">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th class="text-center">Invoice</th>
                      <th class="text-center">Tanggal</th>
                      <th class="text-center">Nama Pelanggan</th>
                      <th class="text-center">Total</th>
                      <th style="width: 150px" class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php if (empty($transaksi)) { ?>
                          <tr>
                              <td colspan="6" class="text-center">Tidak ada item</td>
                          </tr>
                      <?php } else { ?>
                          <?php $no = 1; foreach ($transaksi as $val) { ?>
                              <tr>
                                  <td class="text-center"><?php echo $no; ?></td>
                                  <td class="text-center"><?php echo $val->invoice; ?></td>
                                  <td class="text-center"><?php echo $val->date; ?></td>
                                  <td class="text-center"><?php echo $val->nama_pelanggan; ?></td>
                                  <td class="text-center"><?php echo indo_currency($val->total); ?></td>
                                  <td>
                                      <div class="btn-group">
                                          <a href="<?= site_url('laporan/print/' .$val->id_transaksi); ?>" class="btn-sm btn-primary">
                                          <i class="fa-solid fa-print"></i>Print</a>
                                          <a href="<?php echo site_url('laporan/delete/' . $val->id_transaksi); ?>" 
                                          onclick="showDeleteConfirmation(event)"
                                           class="btn-sm btn-danger"><i class="fa-solid fa-trash"></i>Hapus</a>
                                      </div>
                                  </td>
                              </tr>
                              <?php $no++;
                          }; ?>
                      <?php } ?>
                  </tbody>
                </table>

            <div class="card-footer clearfix">
            <ul class="float-right">
                        <?php echo $this->pagination->create_links(); ?>
                    </ul>
            </div>
        </div>
    </div>
</div>
</div>
</section>
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
<script>
    $(document).ready(function() {
      $('#pelangganTable').DataTable({
        "lengthMenu": [10], // Menampilkan 10 data per halaman secara default
        "pageLength": 10, // Menampilkan 10 data per halaman secara default
        "pagingType": "full_numbers", // Menampilkan tombol pagination
        "dom": '<"top"lBf>rt<"bottom"ip><"clear">', // Menata elemen-elemen DataTables
        "buttons": [
          'pageLength', 'colvis' // Menampilkan tombol pilihan jumlah entri per halaman dan colvis (visibility kolom)
        ],
        "initComplete": function(settings, json) {
          $('#pagination').html($('.dataTables_paginate').parent().html()); // Memindahkan elemen pagination ke placeholder
          $('.dataTables_paginate').parent().remove(); // Menghapus elemen pagination asli
        }
      });
    });
  </script>                 
             