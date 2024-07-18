<?php
    defined('BASEPATH') OR exit('no direct script access allowed');

    class User extends CI_Controller{
    
         function __construct(){
            parent::__construct();
            $this->load->model('Madmin');
        }
    
        public function index(){
            if(empty($this->session->userdata('username'))){
                redirect('adminpanel');
                
            }
            $data['user']=$this->Madmin->get_all_data('user')->result();
            $this->load->view('admin/layout/header');
            $this->load->view('admin/layout/menu');
            $this->load->view('admin/user/tampil',$data);
            $this->load->view('admin/layout/footer');
        }

        public function delete($id){
            if(empty($this->session->userdata('username'))){
            redirect('adminpanel');
            }
            $this->Madmin->delete('user','id_user',$id);
            redirect('user');
        }

        public function ubah_status($id_user) {
            if (empty($this->session->userdata('username'))) {
                redirect('adminpanel');
            }
            
            // Ambil data user berdasarkan ID
            $user = $this->Madmin->get_by_id('user', 'id_user', $id_user);
    
             // Periksa status saat ini sebelum mengubahnya
            if ($user->status == 'Aktif') {
                // Update status di database
                $this->Madmin->update('user', array('status' => 'Tidak Aktif'), 'id_user', $id_user);
            } else {
                // Update status di database
                $this->Madmin->update('user', array('status' => 'Aktif'), 'id_user', $id_user);
            }
            
            // Redirect kembali ke halaman user
            redirect('user');
        }
    }
?>