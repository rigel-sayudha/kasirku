
<?php $no = 1;
if($cart->num_rows() > 0) {
    foreach ($cart->result() as $c => $data) { ?>
        <tr>
            <td><?=$no++?>.</td>
            <td><?=$data->barcode?></td>
            <td><?=$data->nama_barang?></td>
            <td class="text-right"><?=number_format($data->harga)?></td>
            <td class="text-center"><?=$data->qty?></td>
            <td class="text-right total" data-total="<?=$data->total?>"><?=number_format($data->total)?></td>
            <td class="text-center" width="160px">               
                <a href="#" onclick="confirmDelete('<?=site_url('transaksi/delete/'.$data->id_cart)?>')" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> Hapus
                </a>
            </td>
        </tr>
    <?php }
} else {
    echo '<tr>
            <td colspan="7" class="text-center">Tidak ada item</td>
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