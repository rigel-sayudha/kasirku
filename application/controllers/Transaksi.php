<?php 
defined('BASEPATH') OR exit('no direct script access allowed');

class Transaksi extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index(){
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }
        $id_user = $this->session->userdata('id_user');
         // Memeriksa status pengguna
         $user_status = $this->Madmin->get_user_status($id_user);

         if ($user_status == 'Aktif') {
        $pelanggan = $this->Madmin->get_customer($id_user)->result();
        $barang = $this->Madmin->get_barang_category($id_user)->result();
        $cart = $this->Madmin->get_cart(null, $id_user);
        $data = array(
            'pelanggan' => $pelanggan,
            'barang' => $barang,
            'cart' => $cart,
            'invoice' => $this->Madmin->invoice_no(),
            
        );
        $data['transaksi']=$this->Madmin->get_all_data('transaksi')->result();
        $this->load->view('user/layout/header');
        $this->load->view('user/layout/menu');
        $this->load->view('user/kasir/transaksi',$data);
        $this->load->view('user/layout/footer');
        
        } else {
            $this->load->view('demo/layout/header');
            $this->load->view('demo/layout/menu');
            $this->load->view('demo/dashboard');
            $this->load->view('demo/layout/footer');
        }
    }
    public function proses() {
        $data = $this->input->post(null, TRUE);
    
        if(isset($data['add_cart'])) {
            $this->Madmin->add_cart($data);
            if($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
        if(isset($data['process_payment'])) {
            $id_transaksi = $this->Madmin->add_sale($data);
            $cart = $this->Madmin->get_cart()->result();
            $row = [];
            foreach($cart as $c => $value){
                array_push($row, array(
                    'id_transaksi' => $id_transaksi,
                    'id_barang' => $value->id_barang,
                    'harga' => $value->harga,
                    'qty' => $value->qty,
                    'total' => $value->total,
                )
                );
            }
            $this->Madmin->add_sale_detail($row);
            $this->Madmin->del_cart(['id_user' => $this->session->userdata('id_user')]);

            if($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }

    public function reset_cart() {
        $this->Madmin->del_cart(['id_user' => $this->session->userdata('id_user')]);
    
        if ($this->db->affected_rows() > 0) {
            $params = array("success" => true);
        } else {
            $params = array("success" => false);
        }
    
        echo json_encode($params);
    }

    public function update_cart() {
        $data = $this->input->post(null, TRUE);
    
        if(isset($_POST['update_cart'])) {
            $this->Madmin->update_cart($data);
        }
    
        if($this->db->affected_rows() > 0) {
            $params = array("success" => true);
        } else {
            $params = array("success" => false);
        }
        echo json_encode($params);
    }

    function cart_data(){
        $id_user = $this->session->userdata('id_user');
        $cart = $this->Madmin->get_cart(null, $id_user);
        $data['cart'] = $cart;
        $this->load->view('user/kasir/cart_data',$data);
    }

    public function delete($id_cart, $params = null) {
        if($params != null) {
            $this->db->where($params);
        }
        $this->Madmin->delete_cart_item($id_cart);
        redirect('transaksi'); 
    }

}