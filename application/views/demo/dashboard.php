<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Kasirku | Demo</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript"
            src="https://app.midtrans.com/snap/snap.js"
            data-client-key="Mid-client-c39eZ1L0MihlJe7R"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    
   <!-- Google Font: Source Sans Pro -->
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/adminlte.min.css');?>">
  <style>
  .card {
    max-width: 400px; /* Sesuaikan lebar sesuai keinginan */
    max-height: 800px; 
    margin: 0 auto; /* Membuat card berada di tengah halaman */
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
            <h1 class="m-0">Mulai Berlangganan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Demo</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12">
          <div class="container">
  <div class="row">
        <!-- Card untuk Berlangganan 1 -->
        <div class="col-md-6 mb-4">
          <div class="card">
            <div class="card-body text-center d-flex align-items-center justify-content-center">
              <div>
                <h1 class="card-title">Berlangganan 1 Bulan Via Midtrans</h1>
                <p class="card-text">Mulai berlangganan untuk menikmati fitur kami!</p>
                <form id="payment-form" method="post" action="<?= site_url()?>/userpanel/finish">
                  <input type="hidden" name="id_user" id="id_user" value="<?= $this->session->userdata('id_user') ?>">
                  <input type="hidden" name="result_type" id="result-type" value="">
                  <input type="hidden" name="result_data" id="result-data" value="">
                  <button id="pay-button" class="btn btn-primary">Mulai Berlangganan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Card untuk Berlangganan 2 -->
            <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body text-center d-flex align-items-center justify-content-center">
                    <div>
                        <h1 class="card-title">Berlangganan 1 Bulan Via Transfer Bank</h1>
                        <p class="card-text">Mulai berlangganan untuk menikmati fitur kami!</p>
                        <!-- Menggunakan atribut data-target untuk memanggil modal -->
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahBuktiModal">Mulai Berlangganan</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
         <!-- Card untuk Konfirmasi-->
         <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-body text-center d-flex align-items-center justify-content-center">
                    <div>
                        <h1 class="card-title text-center">Sudah Bayar ?</h1>
                        <p class="card-text">Silahkan hubungi Admin kami Jika anda sudah membayar tetapi akun belum aktif!</p>
                        <!-- Menggunakan atribut data-target untuk memanggil modal -->
                        <a href="https://api.whatsapp.com/send?phone=6285604450227&text=Halo Admin Saya mau Konfirmasi Pembayaran Username :     Email :" class="btn btn-success">Kontak Whatsapp</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
      </div>
    </div>
       <!-- Modal Form Input Pembayaran -->
          <div class="modal fade" id="tambahBuktiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran Berlangganan</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <!-- Card di atas formulir pembayaran -->
                          <div class="card mb-3">
                              
                          </div>
                          <!-- Form Form Pembayaran Berlangganan di sini -->
                          <form method="post" action="<?php echo site_url('berlangganan/save'); ?>" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label for="username">Username</label>
                                  <!-- Menggunakan nilai default dari sesi pengguna -->
                                  <input type="text" name="username" id="username" class="form-control" value="<?= $this->session->userdata('username'); ?>" required>
                              </div>
                              <div class="form-group">
                                  <label for="no_hp">Email</label>
                                  <!-- Menggunakan nilai default dari sesi pengguna -->
                                  <input type="text" name="email" id="email" class="form-control" required>
                              </div>
                              <div class="card-body">
                                  <h5 class="card-title">Transfer ke salah satu :</h5>
                                  <h3 class="card-text">1 Bulan</h3>
                                  <h3 class="card-text">Rp. 20.000</h3>
                                  <p class="card-text">&#8226; BCA : Virtual Account : 4561288644 A/N Rigel Donovan Sayudha</p>
                                  <p class="card-text">&#8226; Dana : 085604450227 A/N Rigel Donovan Sayudha</p>
                              </div>
                              <div class="form-group">
                                  <label for="alamat">Bukti Pembayaran</label>
                                  <input type="file" name="bukti" id="bukti" class="form-control" required>
                              </div>
                              <!-- Input hidden untuk id_user -->
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
          <!-- /.col -->
        </div><!--/. row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
        $('#pay-button').click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        
        var id_user = $('#id_user').val(); 
        var jmlbayar = 100;

        $.ajax({
            type: 'POST',
            url: '<?=site_url()?>/userpanel/tokens',
            data: {
                id_user: id_user,
                jmlbayar: jmlbayar
            },
            cache: false,
            success: function(data) {
                console.log('token = ' + data);
                var resultType = document.getElementById('result-type');
                var resultData = document.getElementById('result-data');

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                }

                snap.pay(data, {
                    onSuccess: function(result){
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $("#payment-form").submit();
                    },
                    onPending: function(result){
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    },
                    onError: function(result){
                        changeResult('error', result);
                        console.log(result.status_message);
                        $("#payment-form").submit();
                    }
                });
            }
        });
    });
    </script>

  <!-- /.content-wrapper -->
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
</body>
</html>