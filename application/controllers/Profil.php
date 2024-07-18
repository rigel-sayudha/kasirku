<?php
// controllers/Profil.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model yang digunakan
        $this->load->model('Madmin');
    }

    public function index() {
        if (empty($this->session->userdata('username'))) {
            redirect('userpanel');
        }

        $id_user = $this->session->userdata('id_user');
        $data['profil'] = $this->Madmin->get_user($id_user)->result();
        $this->load->view('user/profil/tampil', $data);
    }

    public function update() {
        $id = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $retype_password = md5($this->input->post('retype_password'));

         // Validasi retype password
        if ($password !== $retype_password) {
            $this->session->set_flashdata('message', 'error');
            redirect('profil');
        }
        $dataUpdate = array(
            'nama' => $nama,
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->Madmin->update('user', $dataUpdate, 'id_user', $id);
        $this->session->set_flashdata('message', 'success');
        // Redirect kembali ke halaman profil setelah pembaruan
        redirect('userpanel');
    }

}