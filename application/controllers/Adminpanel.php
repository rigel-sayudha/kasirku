<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Adminpanel extends CI_Controller
    {
       function __construct()
        {
            parent::__construct();
            $params = array('server_key' => 'Mid-server-CflG9_mVG4tnCAXC3mlZe9bk', 'production' => true);
            $this->load->library('veritrans');
            $this->veritrans->config($params);
            $this->load->helper('url');
            $this->load->library('form_validation');
            $this->load->model('Madmin');      
        }

        public function index()
        {
            $this->load->view('admin/login');
        }

        public function dashboard()
        {
            if(empty($this->session->userdata('username'))){
                redirect('adminpanel');
            }
            $id_user = $this->session->userdata('id_user');
            // Mengambil jumlah data yang sesuai
            $data['record_counts'] = $this->Madmin->getRecordCounts($id_user);
            $this->load->view('admin/layout/header');
            $this->load->view('admin/layout/menu');
            $this->load->view('admin/dashboard', $data);
            $this->load->view('admin/layout/footer');
        }
        public function login(){
            $this->load->model('Madmin');
            $u = $this->input->post('username');
            $p = $this->input->post('password');

            $cek = $this->Madmin->cek_login($u,$p)->num_rows();

            if($cek==1){
                $data_session = array(
                    'username' => $u,
                    'status'   => 'login'
                );
                $this->session->set_userdata($data_session);
                redirect('adminpanel/dashboard');
            }else{
                $this->session->set_flashdata('massage','<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> password salah! </i></h6>
                    </div>');
                redirect('adminpanel');
            }
        }

        public function berlangganan() {
            $data['midtrans'] = $this->Madmin->get_midtrans_user()->result();
            $this->load->view('admin/layout/header');
            $this->load->view('admin/layout/menu');
            $this->load->view('admin/pembayaran/tampil', $data);
            $this->load->view('admin/layout/footer');
        }
        public function notif()
        {
            echo 'test notification handler';
            $json_result = file_get_contents('php://input');
            $result = json_decode($json_result, "true");
    
    
            $order_id = $result['order_id'];
            $user = $this->db->get_where('transaksi_midtrans', ['order_id' => $order_id])->row_array();
            $data = [
                'status_code' => $result['status_code']
            ];
            $update = [
                'status' => "Aktif"
            ];
            if ($result['status_code'] == 200) {
                $this->db->update('transaksi_midtrans', $data, array('order_id' => $order_id));
                $this->db->update('user', $update, array('username' => $user['username']));
            }
        }
        
        public function logout(){
        
            $this->session->sess_destroy();
            redirect('adminpanel');
        }
    }
?>