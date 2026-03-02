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
            $user = $this->Madmin->get_by_id('user', 'id_user', $id_user)->row();
    
            if ($user) {
                 // Periksa status saat ini sebelum mengubahnya
                if ($user->status == 'Aktif') {
                    $new_status = 'Tidak Aktif';
                } else {
                    $new_status = 'Aktif';
                }

                // Update status di database
                $this->db->where('id_user', $id_user);
                $this->db->update('user', array('status' => $new_status));
                
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">Status user berhasil diubah!</div>');
            }
            
            // Redirect kembali ke halaman user
            redirect('user');
        }
    }
?>