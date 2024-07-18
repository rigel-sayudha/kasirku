    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/fontawesome-free/css/all.min.css'); ?>">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"'); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/dist/css/adminlte.min.css'); ?>">
       <!-- SweetAlert2 CSS -->
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo site_url('userpanel/dashboard');?>" class="brand-link">
        <img src="<?php echo base_url('assets/img/logo.png');?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Kasirku</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url('assets/admin/dist/img/user2-160x160.jpg');?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?php echo site_url('profil');?>"><?php echo $this->session->userdata('username'); ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
          <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-box"></i>
                <p>Produk<i class="right fas fa-angle-left"></i></p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?php echo site_url('barang'); ?>"  class="nav-link">
                  <i class="nav-icon fas fa-box"></i>
                    <p>Barang</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?php echo site_url('kategori'); ?>" class="nav-link">
                    <i class="nav-icon fas fa-sort"></i>
                    <p>Kategori</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('transaksi'); ?>" class="nav-link">
                  <i class="nav-icon fas fa-calculator"></i>
                  <p>Kasir</p>
              </a>
              </li>
              <li class="nav-item">
              <a href="<?php echo site_url('supplier'); ?>" class="nav-link">
                  <i class="nav-icon fas fa-truck"></i>
                  <p>Supplier</p>
              </a>
              </li>
                <li class="nav-item">
                  <a href="<?php echo site_url('pelanggan'); ?>" class="nav-link">
                    <i class="nav-icon fas fa-person"></i>
                    <p>Pelanggan</p>
                  </a>
                </li>
            <li class="nav-item">
              <a href="<?php echo site_url('karyawan'); ?>" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>Karyawan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('laporan'); ?>" class="nav-link">
              <i class="nav-icon fa-solid fa-money-bill"></i>
                <p>Transaksi</p>
              </a>
            </li>
          
            <li class="nav-item">
              <a href="#" class="nav-link" onclick="logoutConfirmation()">
                <i class="nav-icon fas fa-right-from-bracket "></i>
                <p>Logout</p>
              </a>
            </li>
          </ul>
        
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <script>
  function logoutConfirmation() {
    Swal.fire({
      icon: 'question',
      title: 'Logout',
      text: 'Apakah Anda yakin ingin logout?',
      showCancelButton: true,
      confirmButtonText: 'Ya',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        // Jika pengguna menekan Ya pada alert, arahkan ke halaman logout
        window.location.href = "<?php echo site_url('userpanel/logout'); ?>";
      }
    });
  }
</script>