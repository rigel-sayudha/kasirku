    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Kasirku | Tabel Barang</title>
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
          <!-- SweetAlert2 CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
        <!-- SweetAlert2 JS -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <h1>Tabel Barang</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Tabel Barang</li>
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
                          <th style="width: 50px">Barcode</th>
                          <th style="width: 220px" class="text-center">Nama Barang</th>
                          <th style="width: 50px">Kategori</th>
                          <th style="width: 50px">Harga</th>
                          <th style="width: 50px">Stok</th>
                          <th style="width: 200px" class="text-center">Foto</th>
                          <th style="width: 50px">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php if (empty($barang)) { ?>
                              <tr>
                                  <td colspan="8" class="text-center">Tidak ada item</td>
                              </tr>
                          <?php } else { ?>
                              <?php $no = $this->uri->segment('3') + 1; foreach ($barang as $val) { ?>
                                  <tr>
                                      <td><?php echo $no; ?></td>
                                      <td><?php echo $val->barcode; ?></td>
                                      <td><?php echo $val->nama_barang; ?></td>
                                      <td><?php echo $val->nama_kategori; ?></td>
                                      <td><?php echo indo_currency($val->harga); ?></td>
                                      <td><?php echo $val->stok; ?></td>
                                      <td><img src="<?php echo base_url('assets/upload/' . $val->foto); ?>" alt="Foto Barang" style="width: 130px;"
                                       data-toggle="modal" 
                                      data-target="#photoModal" onclick="showPhoto('<?php echo base_url('assets/upload/' . $val->foto); ?>')"></td>
                                      <td>
                                          <div class="btn-group">
                                              <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editBarangModal<?= $val->id_barang; ?>">
                                              <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</a>
                                              <a href="<?php echo site_url('barang/delete/' . $val->id_barang); ?>" onclick="showDeleteConfirmation(event)"
                                              class="btn btn-danger"><i class="fa-solid fa-trash"></i>&nbsp;Hapus</a>
                                          </div>
                                      </td>
                                  </tr>
                                  <?php $no++;
                              }; ?>
                          <?php } ?>
                      </tbody>
                    </table class="table table-bordered" id="barangTable">
                    <!-- Modal for Displaying Photo -->
                        <div class="modal fade" id="photoModal" tabindex="-1" role="dialog" aria-labelledby="photoModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="photoModalLabel">Foto Barang</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <img id="modalPhoto" src="" alt="Foto Barang" style="width: 100%;">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        <script>
                            function showPhoto(photoUrl) {
                              // Set the image source in the modal
                              document.getElementById('modalPhoto').src = photoUrl;
                            }
                          </script>
                    <!-- Modal Tambah Barang -->
                    <div class="modal fade" id="tambahBarangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form tambah data Barang di sini -->
                            <form method="post" action="<?php echo site_url('barang/save'); ?>" enctype="multipart/form-data">
                              <div class="form-group">
                                <label for="barcode">Barcode</label>
                                <input type="text" name="barcode" id="barcode" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label for="nama_barang">Nama Barang</label>
                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                              </div>
                              <div class="form-group">
                                    <label for="id_kategori">Kategori</label>
                                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($kategori as $row): ?>
                                            <option value="<?= $row->id_kategori; ?>"><?= $row->nama_kategori; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                              <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="text" name="harga" id="harga" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label for="stok">Stok</label>
                                <input type="text" name="stok" id="stok" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" id="foto" class="form-control" required>
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
                  <!-- Modal Edit Barang -->
                  <?php foreach ($barang as $val) : ?>
                    <div class="modal fade" id="editBarangModal<?= $val->id_barang; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form edit data Barang di sini -->
                            <form method="post" action="<?php echo site_url('barang/update'); ?>" enctype="multipart/form-data">
                              <input type="hidden" name="id_barang" value="<?php echo $val->id_barang; ?>" id="edit_id_barang" class="form-control" 
                              required>
                              <div class="form-group">
                                <label for="edit_barcode">Barcode</label>
                                <input type="text" name="barcode" id="edit_barcode" value="<?php echo $val->barcode; ?>" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label for="edit_nama_barang">Nama Barang</label>
                                <input type="text" name="nama_barang" id="edit_nama_barang" value="<?php echo $val->nama_barang; ?>" class="form-control" 
                                required>
                              </div>
                              <div class="form-group">
                                <label for="edit_id_kategori">Kategori</label>
                                <select name="id_kategori" id="edit_id_kategori" class="form-control" required>
                                  <option value="">Pilih Kategori</option>
                                  <?php foreach ($kategori as $row) : ?>
                                    <option value="<?= $row->id_kategori; ?>" <?php echo ($row->id_kategori == $val->id_kategori) ? 'selected' : ''; ?>>
                                    <?php echo $row->nama_kategori; ?></option>
                                  <?php endforeach; ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="edit_harga">Harga</label>
                                <input type="text" name="harga" id="edit_harga" value="<?php echo $val->harga; ?>" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label for="edit_stok">Stok</label>
                                <input type="text" name="stok" id="edit_stok" value="<?php echo $val->stok; ?>" class="form-control" required>
                              </div>
                              <div class="form-group">
                                <label for="edit_foto">Ubah Foto</label>
                                <input type="file" name="foto" id="edit_foto" class="form-control">
                                <input type="hidden" name="foto_lama" value="<?php echo $val->foto; ?>" id="edit_foto_lama">
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
                    <a href="#" class="btn btn-sm btn-info float-left" data-toggle="modal" data-target="#tambahBarangModal">+ Tambah Data Barang</a>
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