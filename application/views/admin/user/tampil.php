
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">No</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Status Pembayaran</th>
                      <th style="width: 200px">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; foreach($user as $val){?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $val->nama; ?></td>
                      <td><?php echo $val->email; ?></td>
                      <td><?php echo $val->username; ?></td>
                      <td><?php echo $val->password; ?></td>
                      <td><?php if($val->status=="Aktif"){echo "Sudah Bayar";} else {echo "Belum Bayar";} ?></td>
                      <td>
                        <div class="btn-group">
                        <a href="<?php echo site_url('user/ubah_status/'.$val->id_user);?>" class="btn btn-warning">Ubah status</a>
                            <a href="<?php echo site_url('user/delete/'.$val->id_user);?>" onclick="return confirm('Yakin Akan Hapus Data ini?')" 
                             class="btn btn-danger">Hapus</a>
                        </div></td>
                    </tr>
                    <?php $no++; }?>
                  </tbody>
                </table>
              </div>
            <!-- /.card -->            
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
