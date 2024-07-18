<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $no = 1;
                  if($cart->num_rows() > 0) {
                    foreach ($cart->result() as $c =>$data) { ?>
                      <tr>
                        <td><?=$no++?>.</td>
                        <td><?=$data->barcode?></td>
                        <td><?=$data->nama_barang?></td>
                        <td class="text-right"><?= $data->harga?></td>
                        <td class="text-center"><?= $data->qty?></td>
                        <td class="text-right" id="total"><?= ($data->harga * $data->qty) ?></td>
                        <td class="text-center" width="160px">               
                        <a href="#" onclick="confirmDelete('<?php echo site_url('transaksi/delete/'.$data->id_cart); ?>')" class="btn-sm btn-danger">
                            <i class="fa fa-trash"></i>&nbsp;Hapus
                        </a>
                        </td>
                      </tr>
                    <?php
                    }
                  } else {
                    echo '<tr>
                        <td colspan="8" class="text-center">Tidak ada Item</td>
                        </tr>';
                  } ?>
       <script>
          function confirmDelete(deleteUrl) {
              Swal.fire({
                  title: 'Yakin Hapus Data ini?',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Hapus',
                  cancelButtonText: 'Batal',
              }).then((result) => {
                  if (result.isConfirmed) {
                      // Jika tombol "Hapus" ditekan, lakukan redirect ke URL penghapusan
                      window.location.href = deleteUrl;
                  }
              });

              // Mengembalikan false agar tautan tidak diikuti jika pengguna memilih "Batal"
              return false;
          }
          </script>