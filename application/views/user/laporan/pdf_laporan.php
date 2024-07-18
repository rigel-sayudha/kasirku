<!DOCTYPE html>
<html>
<head>
<title><?= $title_pdf;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #table td, #table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #table tr:nth-child(even){background-color: #f2f2f2;}

            #table tr:hover {background-color: #ddd;}

            #table th {
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
        </style>
</head>
    <body>
        <div class="card-body">
                <table class="table table-bordered" id="pelangganTable">
                    <h1>=========Laporan Penjualan===========</h1>
                  <thead>
                    <tr>
                      <td style="width: 10px">No</td>
                      <td class="text-center">Invoice</td>
                      <td class="text-center">Tanggal</td>
                      <td class="text-center">Nama Pelanggan</td>
                      <td class="text-center">Total</td>
                    </tr>
                  </thead>
                  <tbody>
                      <?php if (empty($transaksi)) { ?>
                          <tr>
                              <td colspan="6" class="text-center"></td>
                          </tr>
                      <?php } else { ?>
                          <?php $no = 1; foreach ($transaksi as $val) { ?>
                              <tr>
                                  <td class="text-center"><?php echo $no; ?></td>
                                  <td class="text-center"><?php echo $val->invoice; ?></td>
                                  <td class="text-center"><?php echo $val->date; ?></td>
                                  <td class="text-center"><?php echo $val->nama_pelanggan; ?></td>
                                  <td class="text-center"><?php echo indo_currency($val->total); ?></td>
                              </tr>
                              <?php $no++;
                          }; ?>
                      <?php } ?>
                  </tbody>
                </table>
                <script>
		window.print()
	</script>
    </body>
</html>