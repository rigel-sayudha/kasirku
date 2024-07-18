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
            <h1>Tabel Supplier</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tabel Supplier</li>
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
                <h3 class="card-title">Data supplier</h3>
                
              </div>
              <!-- /.card-header -->
              <?= $this->session->flashdata('massage'); ?>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th class="text-center">Nama Supplier</th>
                      <th class="text-center">Alamat</th>
                      <th class="text-center">No Handphone</th>
                      <th style="width: 150px" class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($supplier)) { ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada item</td>
                        </tr>
                    <?php } else { ?>
                        <?php $no = 1; foreach ($supplier as $val) { ?>
                            <tr>
                                <td class="text-center"><?php echo $no; ?></td>
                                <td class="text-center"><?php echo $val->nama_supplier; ?></td>
                                <td class="text-center"><?php echo $val->alamat; ?></td>
                                <td class="text-center"><?php echo $val->no_hp; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editSupplierModal<?= 
                                        $val->id_supplier; ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</a>
                                        <a href="<?php echo site_url('supplier/delete/' . $val->id_supplier); ?>" 
                                        onclick="showDeleteConfirmation(event)"
                                        class="btn btn-danger"><i class="fa-solid fa-trash"></i>&nbsp;Hapus</a>
                                    </div>
                                </td>
                            </tr>
                            <?php $no++;
                        }; ?>
                    <?php } ?>
                </tbody>
                </table>
            <!-- Modal Tambah supplier -->
            <div class="modal fade" id="tambahSupplierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Form tambah data supplier di sini -->
                            <form method="post" action="<?php echo site_url('supplier/save'); ?>">
                                <div class="form-group">
                                    <label for="nama_supplier">Nama supplier</label>
                                    <input type="text" name="nama_supplier" id="nama_supplier" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" name="alamat" id="alamat" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No Handphone</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control" required>
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
               <!-- Modal Edit Supplier -->
               <?php foreach ($supplier as $val) : ?>
                <div class="modal fade" id="editSupplierModal<?= $val->id_supplier; ?>" tabindex="-1" role="dialog" 
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!-- Form edit data Barang di sini -->
                        <form method="post" action="<?php echo site_url('supplier/update'); ?>" enctype="multipart/form-data">
                          <input type="hidden" name="id_supplier" value="<?php echo $val->id_supplier; ?>" id="edit_id_supplier"
                           class="form-control" required>
                          <div class="form-group">
                            <label for="edit_nama_supplier">Nama supplier</label>
                            <input type="text" name="nama_supplier" id="edit_nama_supplier" value="<?php echo $val->nama_supplier; ?>"
                             class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="edit_alamat">Alamat</label>
                            <input type="text" name="alamat" id="edit_alamat" value="<?php echo $val->alamat; ?>" class="form-control" required>
                          </div>
                          <div class="form-group">
                            <label for="edit_no_hp">No Handphone</label>
                            <input type="text" name="no_hp" id="edit_no_hp" value="<?php echo $val->no_hp; ?>" class="form-control" required>
                          </div>
                          <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user'); ?>">
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
            <a href="#" class="btn btn-sm btn-info float-left" data-toggle="modal" data-target="#tambahSupplierModal">+ Tambah Data Supplier</a>
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
                     
             