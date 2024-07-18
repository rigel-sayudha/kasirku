<?php
    defined('BASEPATH') OR exit('no direct script access allowed');

    class Pembayaran extends CI_Controller{
    
         function __construct(){
            parent::__construct();
            $this->load->model('Madmin');
        }
    
        public function index(){
            if(empty($this->session->userdata('username'))){
                redirect('adminpanel');
                
            }
            $data['pembayaran']=$this->Madmin->get_all_data('berlangganan')->result();
            $this->load->view('admin/layout/header');
            $this->load->view('admin/layout/menu');
            $this->load->view('admin/pembayaran/tampil',$data);
            $this->load->view('admin/layout/footer');
        }

        public function delete($id){
            if(empty($this->session->userdata('username'))){
            redirect('adminpanel');
            }
            $this->Madmin->delete('berlangganan','id_berlangganan',$id);
            redirect('user');
        }

    }
?>