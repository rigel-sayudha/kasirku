<?php 
defined('BASEPATH') OR exit('no direct script access allowed');

class Kategori extends CI_Controller {

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
        $config['base_url'] = site_url('kategori/index');
        $config['total_rows'] = $this->Madmin->get_kategori_count(); // Use a method to get total row count
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
    
        // Get user id from session
        $id_user = $this->session->userdata('id_user');
        // Memeriksa status pengguna
        $user_status = $this->Madmin->get_user_status($id_user);

        if ($user_status == 'Aktif') {
        // Load data using the offset and limit
        $data['kategori'] = $this->Madmin->get_kategori($config['per_page'], $offset, $id_user)->result();
    
        $this->load->view('user/layout/header');
        $this->load->view('user/layout/menu');
        $this->load->view('user/kategori/tampil', $data);
        $this->load->view('user/layout/footer');
        } else {
            $this->load->view('demo/layout/header');
            $this->load->view('demo/layout/menu');
            $this->load->view('demo/dashboard');
            $this->load->view('demo/layout/footer');
        }
    }

    public function save() {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h6><i> Data kategori tidak valid! </i></h6>
            </div>');
        } else {
            $data = array(
                'nama_kategori' => $this->input->post('nama_kategori'),
                'id_user' => $this->input->post('id_user'),
            );
    
            $result = $this->Madmin->insert('kategori', $data);
    
            if ($result) {
                $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Kategori berhasil ditambahkan! </i></h6>
                </div>');
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h6><i> Kategori berhasil ditambahkan! </i></h6>
            </div>');
            }
        }
    
        redirect('kategori');
    }
    public function update(){
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }

          // Ambil informasi dari formulir edit
          $id = $this->input->post('id_kategori');
          $nama = $this->input->post('nama_kategori');


           // Siapkan data yang akan diupdate
        $dataUpdate = array(
            'nama_kategori' => $nama
        );

        // Panggil model untuk menyimpan perubahan
        $this->Madmin->update('kategori', $dataUpdate, 'id_kategori', $id);

        redirect('kategori'); // Kembali ke halaman pelanggan setelah perubahan
    }


    public function delete($id){
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }
        $this->Madmin->delete('kategori','id_kategori',$id);
        $this->session->set_flashdata('massage','<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> kategori berhasil dihapus </i></h6>
                </div>');
        redirect('kategori');
    }
    
}