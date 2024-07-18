<?php defined('BASEPATH') OR exit('no direct script access allowed');

    class Laporan extends CI_Controller{

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
        $config['base_url'] = site_url('laporan/index');
        $config['total_rows'] = $this->Madmin->get_transaksi_count(); // Use a method to get total row count
        $config['per_page'] = 10; // Adjust this based on your preferences
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
            $data['transaksi'] = $this->Madmin->get_transaksi_pelanggan($config['per_page'], $offset, $id_user);
            $data['pelanggan'] = $this->Madmin->get_all_data('pelanggan')->result();
        
            $this->load->view('user/layout/header');
            $this->load->view('user/layout/menu');
            $this->load->view('user/laporan/laporan',$data);
            $this->load->view('user/layout/footer');
        } else {
            $this->load->view('demo/layout/header');
            $this->load->view('demo/layout/menu');
            $this->load->view('demo/dashboard');
            $this->load->view('demo/layout/footer');
        }
    }

        public function print() {
            $this->load->library('pdfgenerator');
            $this->data['title_pdf'] = 'Laporan Penjualan';
        
            // filename dari pdf ketika didownload
            $file_pdf = 'laporan_pen';
            // setting paper
            $paper = 'A5';
            //orientasi paper potrait / landscape
            $orientation = "portrait";
            $id_user = $this->session->userdata('id_user');
            // Sesuaikan jumlah data yang ingin Anda ambil dan offset
            $limit = 10;  // Sesuaikan dengan jumlah data yang ingin Anda ambil
            $offset = 0;  // Sesuaikan offset jika perlu
            
            $data['transaksi'] = $this->Madmin->get_transaksi_pelanggan($id_user, $limit, $offset);
            $html = $this->load->view('user/laporan/pdf_laporan', $this->data, $data, true);	
            // run dompdf
            $this->pdfgenerator->generate($html, $file_pdf, $paper,$orientation);
        }
        public function delete($id){
            if(empty($this->session->userdata('username'))){
                redirect('userpanel');
            }
            $this->Madmin->delete('transaksi','id_transaksi',$id);
            $this->session->set_flashdata('massage','<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h6><i> Laporan berhasil dihapus </i></h6>
                    </div>');
            redirect('laporan');
        }

    }
?>