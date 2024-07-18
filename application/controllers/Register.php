<?php
defined('BASEPATH') OR exit('no direct script access allowed');

class Register extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index() {
        $this->load->view('user/register');
    }

    public function register() {
        // Data dari form pendaftaran
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $status = $this->input->post('status');
    
        $data = array(
            'nama' => $nama,
            'email' => $email,
            'username' => $username,
            'password' => md5($password),
            'status' => $status,
        );
   
        if ($this->Madmin->insert_data($data)) {
            // Registrasi berhasil
            $this->session->set_flashdata('success_message', '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h6><i> Registrasi berhasil! </i></h6>
            </div>');
            redirect('userpanel');
        } else {
            // Registrasi gagal
            $this->session->set_flashdata('error_message', '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h6><i> Registrasi gagal! </i></h6>
            </div>');
            redirect('register');
        }
    }

}
?>
