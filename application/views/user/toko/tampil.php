  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Kasirku | Toko</title>
    <!-- Google Font: Source Sans Pro -->
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
    <style>
      .rounded-card {
        border-radius: 15px;
      }
      </style>
  </head>
  <body class="hold-transition sidebar-mini layout-fixed">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Toko Saya</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Toko</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
    
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                      <?php foreach ($toko_karyawan as $row): ?>
                          <div class="col-md-3">
                              <div class="card rounded-card">
                                  <div class="card-body">
                                      <h5 class="card-title"><?= $row->nama_toko; ?></h5>
                                      <p class="card-text"><?= $row->alamat; ?></p>
                                      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#detailModal<?= $row->id_toko; ?>">Detail</a>
                                      <a href="<?php echo site_url('toko/delete/'.$row->id_toko);?>" onclick="showDeleteConfirmation(event)"
                                      class="btn btn-danger"><i class="fa-solid fa-trash"></i>&nbsp;Hapus</a>              
                                      <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#editTokoModal<?= $row->id_toko; ?>">
                                      <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit</a>
                                  </div>
                              </div>
                          </div>
                      <?php endforeach; ?>
                      
                      <!-- Modal Detail untuk setiap toko -->
                      <?php foreach ($toko_karyawan as $row): ?>
                          <div class="modal fade" id="detailModal<?= $row->id_toko; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" 
                          aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="detailModalLabel">Detail Toko</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <p><strong>Nama Toko : </strong> <?= $row->nama_toko; ?></p>
                                          <p><strong>Alamat : </strong> <?= $row->alamat; ?></p>
                                          <p><strong>Kode Pos : </strong> <?= $row->kode_pos; ?></p>
                                          <p><strong>Nama Karyawan : </strong> <?= $row->nama_karyawan; ?></p>
                                          <p><strong>No HP : </strong> <?= $row->no_hp; ?></p> 
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      <?php endforeach; ?>
                      <!-- Add more cards as needed -->
                  </div>
              </div>
                    <!-- Add more cards as needed -->
                  </div>
                </div>
                <!-- /.card-body -->
                <!-- Modal Tambah toko -->
                <div class="modal fade" id="tambahTokoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Tambah Data toko</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- Form tambah data toko di sini -->
                          <form method="post" action="<?php echo site_url('toko/save'); ?>" enctype="multipart/form-data">
                          <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user'); ?>">
                            <div class="form-group">
                              <label for="nama_toko">Nama toko</label>
                              <input type="text" name="nama_toko" id="nama_toko" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat</label>
                              <input type="text" name="alamat" id="alamat" class="form-control" required>
                            </div>
                            <div class="form-group">
                              <label for="kode_pos">Kode Pos</label>
                              <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
                            </div>
                            <div class="form-group">
                                  <label for="id_karyawan">Karyawan</label>
                                  <select name="id_karyawan" id="id_karyawan" class="form-control" required>
                                      <option value="">Pilih Karyawan</option>
                                      <?php foreach ($karyawan as $row): ?>
                                          <option value="<?= $row->id_karyawan; ?>"><?= $row->nama_karyawan; ?></option>
                                      <?php endforeach; ?>
                                  </select>
                              </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </form>
                        </div>                     
                      </div>
                    </div>
           
              <!-- /.card -->
            </div>
               <!-- Modal Edit untuk setiap toko -->
               <?php foreach ($toko_karyawan as $row): ?>
                        <div class="modal fade" id="editTokoModal<?= $row->id_toko; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                         aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Toko</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form edit data toko di sini -->
                                        <form method="post" action="<?php echo site_url('toko/update'); ?>" enctype="multipart/form-data">
                                            <input type="hidden" name="id_toko" value="<?= $row->id_toko; ?>">
                                            <div class="form-group">
                                                <label for="edit_nama_toko">Nama toko</label>
                                                <input type="text" name="nama_toko" id="edit_nama_toko" class="form-control" value="<?= $row->nama_toko; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_alamat">Alamat</label>
                                                <input type="text" name="alamat" id="edit_alamat" class="form-control" value="<?= $row->alamat; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_kode_pos">Kode Pos</label>
                                                <input type="text" name="ode_pos" id="edit_kode_pos" class="form-control" value="<?= $row->kode_pos; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="edit_id_karyawan">Karyawan</label>
                                                <select name="id_karyawan" id="edit_id_karyawan" class="form-control" required>
                                                    <option value="">Pilih Karyawan</option>
                                                    <?php foreach ($karyawan as $k): ?>
                                                        <option value="<?= $k->id_karyawan; ?>" <?= ($row->id_karyawan == $k->id_karyawan) ? 'selected' : ''; ?>>
                                                            <?= $k->nama_karyawan; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
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
            <?php if (count($toko_karyawan) < 1): ?>
                      <div class="col-md-3">
                          <div class="card rounded-card">
                              <div class="card-body">
                                  <h5 class="card-title">Tambah Toko</h5>
                                  <p class="card-text">Anda belum memiliki toko. <br>Silakan tambahkan toko.</p>
                                  <a href="#" class="btn btn-success" data-toggle="modal" data-target="#tambahTokoModal">+ Tambah Toko</a>
                              </div>
                          </div>
                      </div>
                  <?php endif; ?>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
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
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/admin/dist/js/adminlte.js');?>"></script>
  </body>
  </html>