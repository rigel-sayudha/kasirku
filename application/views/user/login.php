<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kasirku | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/adminlte.min.css') ?>">
     <!-- SweetAlert2 CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
          <?php
            if ($this->session->flashdata('success_message')) {
                echo '<p>' . $this->session->flashdata('success_message') . '</p>';
            }
            ?>
           <?= $this->session->flashdata('massage'); ?>
            <h3 class="mb-5">Sign in</h3>
            <form action="<?php echo site_url('userpanel/login');?>" method="post">
            <div class="form-outline mb-4">
              <input type="text" name="username" id="typeEmailX-2" class="form-control form-control-lg" placeholder="Username" 
              value="<?=set_value('username'); ?>" required>
            </div>

            <div class="form-outline mb-4">
              <input type="password" name="password" id="typePasswordX-2" class="form-control form-control-lg" placeholder="Password" 
              value="<?=set_value('password'); ?>" required>
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
            </form>
            <hr class="my-4">

          <p class="mb-0" align="center">
             <a href="<?php echo site_url('register');?>" class="text-center">Registrasi</a>
          </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php if ($this->session->flashdata('message') == 'success') : ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Data berhasil diperbarui!',
            showConfirmButton: false,
            timer: 1500
        });
    </script>
<?php endif; ?>
<!-- jQuery -->
<script src="<?php echo base_url('assets/admin/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/admin/dist/js/adminlte.min.js') ?>"></script>
</body>
</html>