<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mbarang extends CI_Model {
    private $table = 'barang';
public function getNama($id)
	{
		$this->db->select('nama_barang, stok');
		$this->db->where('id_barang', $id);
		return $this->db->get($this->table)->row();
	}

	public function getStok($id)
	{
		$this->db->select('stok, nama_barang, harga, barcode');
		$this->db->where('id_barang', $id);
		return $this->db->get($this->table)->row();
	}
}
?>
