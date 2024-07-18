<?php 
defined('BASEPATH') OR exit('no direct script access allowed');

class Kasir extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Mkasir');
    }

    public function index() {
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }

            $this->load->view('user/layout/header');
            $this->load->view('user/layout/menu');
            $this->load->view('user/kasir/kasir');
            $this->load->view('user/layout/footer');
    }
    public function read()
	{
		// header('Content-type: application/json');
		if ($this->Mkasir->read()->num_rows() > 0) {
			foreach ($this->Mkasir->read()->result() as $transaksi) {
				$barcode = explode(',', $transaksi->barcode);
				$tanggal = new DateTime($transaksi->tanggal);
				$data[] = array(
					'tanggal' => $tanggal->format('d-m-Y H:i:s'),
					'nama_produk' => '<table>'.$this->Mkasir->getProduk($barcode, $transaksi->qty).'</table>',
					'total_bayar' => $transaksi->total_bayar,
					'jumlah_uang' => $transaksi->jumlah_uang,
					'diskon' => $transaksi->diskon,
					'pelanggan' => $transaksi->pelanggan,
					'action' => '<a class="btn btn-sm btn-success" href="'.site_url('transaksi/cetak/').$transaksi->id.'">Print</a> <button class="btn btn-sm btn-danger" onclick="remove('.$transaksi->id.')">Delete</button>'
				);
			}
		} else {
			$data = array();
		}
		$transaksi = array(
			'data' => $data
		);
		echo json_encode($transaksi);
	}

	public function add()
	{
		$barang = json_decode($this->input->post('barang'));
		$tanggal = new DateTime($this->input->post('tanggal'));
		$barcode = array();
		foreach ($barang as $barang) {
			$this->Mkasir->removeStok($barang->id_barang, $barang->stok);
			$this->Mkasir->addTerjual($barang->id_barang, $barang->terjual);
			array_push($barcode, $barang->id_barang);
		}
		$data = array(
			'tanggal' => $tanggal->format('Y-m-d H:i:s'),
			'barcode' => implode(',', $barcode),
			'qty' => implode(',', $this->input->post('qty')),
			'total_bayar' => $this->input->post('total_bayar'),
			'jumlah_uang' => $this->input->post('jumlah_uang'),
			'diskon' => $this->input->post('diskon'),
			'pelanggan' => $this->input->post('pelanggan'),
			'nota' => $this->input->post('nota'),
			'kasir' => $this->session->userdata('id')
		);
		if ($this->Mkasir->create($data)) {
			echo json_encode($this->db->insert_id());
		}
		$data = $this->input->post('form');
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->Mkasir->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function cetak($id)
	{
		$produk = $this->Mkasir->getAll($id);
		
		$tanggal = new DateTime($produk->tanggal);
		$barcode = explode(',', $produk->barcode);
		$qty = explode(',', $produk->qty);

		$produk->tanggal = $tanggal->format('d m Y H:i:s');

		$dataProduk = $this->Mkasir->getName($barcode);
		foreach ($dataProduk as $key => $value) {
			$value->total = $qty[$key];
			$value->harga = $value->harga * $qty[$key];
		}

		$data = array(
			'nota' => $produk->nota,
			'tanggal' => $produk->tanggal,
			'produk' => $dataProduk,
			'total' => $produk->total_bayar,
			'bayar' => $produk->jumlah_uang,
			'kembalian' => $produk->jumlah_uang - $produk->total_bayar
		);
		$this->load->view('cetak', $data);
	}

	public function penjualan_bulan()
	{
		header('Content-type: application/json');
		$day = $this->input->post('day');
		foreach ($day as $key => $value) {
			$now = date($day[$value].' m Y');
			if ($qty = $this->Mkasir->penjualanBulan($now) !== []) {
				$data[] = array_sum($this->Mkasir->penjualanBulan($now));
			} else {
				$data[] = 0;
			}
		}
		echo json_encode($data);
	}

	public function transaksi_hari()
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		$total = $this->Mkasir->transaksiHari($now);
		echo json_encode($total);
	}

	public function transaksi_terakhir($value='')
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		foreach ($this->Mkasir->transaksiTerakhir($now) as $key) {
			$total = explode(',', $key);
		}
		echo json_encode($total);
	}
}
?>