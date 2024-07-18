<?php 
defined('BASEPATH') OR exit('no direct script access allowed');

class Karyawan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index(){
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }
         // Load the pagination library
         $this->load->library('pagination');
    
         // Configure pagination
         $config['base_url'] = site_url('karyawan/index');
         $config['total_rows'] = $this->Madmin->get_karyawan_count(); // Use a method to get total row count
         $config['per_page'] = 5; // Adjust this based on your preferences
         $config['uri_segment'] = 3;
         
          // Membuat Style pagination untuk BootStrap v4
          $config['first_link']       = 'First';
          $config['last_link']        = 'Last';
          $config['next_link']        = 'Next';
          $config['prev_link']        = 'Prev';
          $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
          $config['full_tag_close']   = '</ul></nav></div>';
          $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
          $config['num_tag_close']    = '</span></li>';
          $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
          $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
          $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
          $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
          $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
          $config['prev_tagl_close']  = '</span>Next</li>';
          $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
          $config['first_tagl_close'] = '</span></li>';
          $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
          $config['last_tagl_close']  = '</span></li>';
         // Initialize pagination
         $this->pagination->initialize($config);
        
         // Get the offset from URI segment
         $offset = $this->uri->segment(3) ? $this->uri->segment(3) : 0;
         $id_user = $this->session->userdata('id_user');
           // Memeriksa status pengguna
        $user_status = $this->Madmin->get_user_status($id_user);

        if ($user_status == 'Aktif') {
         // Load data using the offset and limit
        $data['karyawan'] = $this->Madmin->get_karyawan($config['per_page'], $offset, $id_user)->result();
        $this->load->view('user/layout/header');
        $this->load->view('user/layout/menu');
        $this->load->view('user/karyawan/tampil',$data);
        $this->load->view('user/layout/footer');
        } else {
            $this->load->view('demo/layout/header');
            $this->load->view('demo/layout/menu');
            $this->load->view('demo/dashboard');
            $this->load->view('demo/layout/footer');
        }
    }

    public function save() {
        $this->form_validation->set_rules('nama_karyawan', 'Nama karyawan', 'required');
        $this->form_validation->set_rules('no_hp', 'No Handphone', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Data karyawan tidak valid! </i></h6>
                </div>');
        } else {
            $data = array(
                'nama_karyawan' => $this->input->post('nama_karyawan'),
                'no_hp' => $this->input->post('no_hp'),
                'email' => $this->input->post('email'),
                'id_user' => $this->input->post('id_user'),
            );
            $result = $this->Madmin->insert('karyawan',$data);

            if ($result) {
                $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> karyawan berhasil ditambahkan! </i></h6>
                </div>');
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h6><i> karyawan berhasil ditambahkan! </i></h6>
            </div>');
            }
        }

        redirect('karyawan'); // Redirect kembali ke halaman karyawan
    }

    public function update(){
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }

          // Ambil informasi dari formulir edit
          $id = $this->input->post('id_karyawan');
          $nama = $this->input->post('nama_karyawan');
          $no_hp = $this->input->post('no_hp');
          $email = $this->input->post('email');

           // Siapkan data yang akan diupdate
        $dataUpdate = array(
            'nama_karyawan' => $nama,
            'no_hp' => $no_hp,
            'email' => $email

        );

        // Panggil model untuk menyimpan perubahan
        $this->Madmin->update('karyawan', $dataUpdate, 'id_karyawan', $id);
        $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h6><i> Karyawan berhasil diperbarui! </i></h6>
    </div>');
        redirect('karyawan'); // Kembali ke halaman pelanggan setelah perubahan
    }
    public function delete($id){
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }
        $this->Madmin->delete('karyawan','id_karyawan',$id);
        $this->session->set_flashdata('massage','<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> karyawan berhasil dihapus </i></h6>
                </div>');
        redirect('karyawan');
    }
    
 
    
    

}