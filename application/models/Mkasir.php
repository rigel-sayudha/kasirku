<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mkasir extends CI_Model {

	private $table = 'transaksi';

	public function removeStok($id, $stok)
	{
		$this->db->where('id_barang', $id);
		$this->db->set('stok', $stok);
		return $this->db->update('barang');
	}

	public function addTerjual($id, $jumlah)
	{
		$this->db->where('id_barang', $id);
		$this->db->set('terjual', $jumlah);
		return $this->db->update('barang');;
	}

	public function create($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function read()
	{
		$this->db->select('transaksi.id, transaksi.tanggal, transaksi.barcode, transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, transaksi.diskon, pelanggan.nama as pelanggan');
		$this->db->from($this->table);
		$this->db->join('pelanggan', 'transaksi.pelanggan = pelanggan.id_pelanggan', 'left outer');
		return $this->db->get();
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete($this->table);
	}

	public function getProduk($barcode, $qty)
	{
		$total = explode(',', $qty);
		foreach ($barcode as $key => $value) {
			$this->db->select('nama_barang');
			$this->db->where('id_barang', $value);
			$data[] = '<tr><td>'.$this->db->get('barang')->row()->nama_barang.' ('.$total[$key].')</td></tr>';
		}
		return join($data);
	}


	public function penjualanBulan($date)
	{
		$qty = $this->db->query("SELECT qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$date'")->result();
		$d = [];
		$data = [];
		foreach ($qty as $key) {
			$d[] = explode(',', $key->qty);
		}
		foreach ($d as $key) {
			$data[] = array_sum($key);
		}
		return $data;
	}

	public function transaksiHari($hari)
	{
		return $this->db->query("SELECT COUNT(*) AS total FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari'")->row();
	}

	public function transaksiTerakhir($hari)
	{
		return $this->db->query("SELECT transaksi.qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari' LIMIT 1")->row();
	}

	public function getAll($id)
	{
		$this->db->select('transaksi.nota, transaksi.tanggal, transaksi.barcode, transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, pengguna.nama as kasir');
		$this->db->from('transaksi');
		$this->db->join('user', 'transaksi.kasir = user.id_user');
		$this->db->where('transaksi.id', $id);
		return $this->db->get()->row();
	}

	public function getName($barcode)
	{
		foreach ($barcode as $b) {
			$this->db->select('nama_barang, harga');
			$this->db->where('id_barang', $b);
			$data[] = $this->db->get('barang')->row();
		}
		return $data;
	}

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */