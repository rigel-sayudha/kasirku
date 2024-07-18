<?php
defined('BASEPATH') OR exit('no direct script access allowed');
class Berlangganan extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index()
    {
        if (empty($this->session->userdata('username'))) {
            redirect('adminpanel');
        }
        $id_user = $this->session->userdata('id_user');
        $data['berlangganan'] = $this->Madmin->getBerlangganan()->result();
        $this->load->view('admin/layout/header');
        $this->load->view('admin/layout/menu');
        $this->load->view('admin/berlangganan/tampil', $data);
        $this->load->view('admin/layout/footer');
    }
    public function success() {
        if (empty($this->session->userdata('username'))) {
            redirect('userpanel');
        }
        $this->load->view('demo/layout/header');

        
        $this->load->view('demo/layout/menu');
        $this->load->view('demo/success');
        $this->load->view('demo/layout/footer');
    }
    public function save() {
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('id_user', 'User', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Data tidak valid! </i></h6>
                </div>');
        } else {
            $config['upload_path'] = FCPATH . 'assets/bukti/'; // Sesuaikan dengan direktori upload Anda
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size'] = 4096; // Ukuran maksimal file dalam kilobita
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('bukti')) {
                // Jika upload berhasil, ambil data file
                $upload_data = $this->upload->data();
                $bukti = $upload_data['file_name'];
    
                $data = array(
                    'email' => $this->input->post('email'),
                    'bukti' => $bukti,
                    'id_user' => $this->input->post('id_user'),
                );
    
                $result = $this->Madmin->insert('berlangganan', $data);
    
                if ($result) {
                    $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h6><i> Data berhasil Diinput, silahkan kontak Admin untuk Konfirmasi! </i></h6>
                    </div>');
                } else {
                    $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Data Berhasil Diinput! </i></h6>
                </div>');
                }
            } else {
                // Jika upload gagal, tampilkan pesan kesalahan
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('massage', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i>' . $error . '</i></h6>
                </div>');
            }
        }
    
        redirect('berlangganan/success');
    }

    public function delete($id) {
        if(empty($this->session->userdata('username'))){
            redirect('adminpanel');
        }
        $this->Madmin->delete('berlangganan','id_berlangganan',$id);
        $this->session->set_flashdata('massage','<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Data berhasil dihapus </i></h6>
                </div>');
        redirect('berlangganan');
    }
}

?>