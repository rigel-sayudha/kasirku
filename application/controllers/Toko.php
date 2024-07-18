<?php 
defined('BASEPATH') OR exit('no direct script access allowed');

class Toko extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index(){
        if(empty($this->session->userdata('username'))){
			redirect('userpanel');
		}
        // Get user id from session
        $id_user = $this->session->userdata('id_user');
         // Memeriksa status pengguna
         $user_status = $this->Madmin->get_user_status($id_user);

         if ($user_status == 'Aktif') {
        $data['toko_karyawan'] = $this->Madmin->get_toko($id_user);
        $data['karyawan'] = $this->Madmin->get_employee($id_user)->result();
        $this->load->view('user/layout/header');
        $this->load->view('user/layout/menu');
        $this->load->view('user/toko/tampil', $data);
        $this->load->view('user/layout/footer');
        } else {
            $this->load->view('demo/layout/header');
            $this->load->view('demo/layout/menu');
            $this->load->view('demo/dashboard');
            $this->load->view('demo/layout/footer');
        }
    }
    public function get_toko_by_karyawan($karyawan) {
        $data['toko'] = $this->Madmin->get_toko_by_karyawan($karyawan);
        echo json_encode($data);
    }

    public function save() {
        $this->form_validation->set_rules('nama_toko', 'Nama toko', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required');
        $this->form_validation->set_rules('id_karyawan', 'Nama Karyawan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Data toko tidak valid! </i></h6>
                </div>');
        } else {
            $data['id_user'] = $this->session->userdata('id_user');
            $data = array(
                'nama_toko' => $this->input->post('nama_toko'),
                'alamat' => $this->input->post('alamat'),
                'kode_pos' => $this->input->post('kode_pos'),
                'id_karyawan' => $this->input->post('id_karyawan'),
                'id_user' => $this->input->post('id_user'),
            );
            $result = $this->Madmin->insert('toko',$data);

            if ($result) {
                $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Toko berhasil ditambahkan! </i></h6>
                </div>');
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h6><i> Toko berhasil ditambahkan! </i></h6>
            </div>');
            }
        }

        redirect('toko'); // Redirect kembali ke halaman toko
    }

    public function update() {
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }

            $id = $this->input->post('id_toko');
            $nama = $this->input->post('nama_toko');
            $alamat = $this->input->post('alamat');
            $kode_pos = $this->input->post('kode_pos');
            $karyawan = $this->input->post('id_karyawan');

            $data = array(
                'nama_toko' => $nama,
                'alamat' => $alamat,
                'kode_pos' => $kode_pos,
                'id_karyawan' => $karyawan,
            );
        $this->Madmin->update('toko', $data, 'id_toko', $id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h6><i>Toko berhasil diperbarui!</i></h6>
            </div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h6><i>Tidak ada perubahan dilakukan.</i></h6>
            </div>');
        }
        redirect('toko'); 
    }

    public function delete($id){
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }
        $this->Madmin->delete('toko','id_toko',$id);
        $this->session->set_flashdata('massage','<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Barang berhasil dihapus </i></h6>
                </div>');
        redirect('toko');
    }

}