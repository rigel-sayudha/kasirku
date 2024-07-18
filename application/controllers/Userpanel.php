<?php
    class Userpanel extends CI_Controller
    {
    function __construct()
       {
        parent::__construct();
         $params = array('server_key' => 'Mid-server-CflG9_mVG4tnCAXC3mlZe9bk', 'production' => true);
         $this->load->library('midtrans');
         $this->midtrans->config($params);
         $this->load->helper('url');
         $this->load->library('form_validation');
         $this->load->model('Madmin');
        }
        public function index()
        {
            $this->load->view('user/login');
        }
      public function dashboard()
        {
            if (empty($this->session->userdata('username'))) {
                redirect('userpanel');
            }
        
            $id_user = $this->session->userdata('id_user');
            
            //Eksekusi status setelah pembayaran midtrans
            if (!is_array($id_user)) {
            }
            $midtrans = $this->db->get_where('transaksi_midtrans', ['id_user' => $id_user])->result_array();
            foreach ($midtrans as $m) {
                if ($m['status_code'] == 200) {
                    $update = [
                        'status' => 'Aktif',
                        'batas_langganan' => date('Y-m-d', strtotime('+1 month'))
                    ];
                    $this->Madmin->update('user', $update, 'id_user', $m['id_user']);
                    $this->Madmin->delete('transaksi_midtrans', 'order_id', $m['order_id']);
                }
            }

             // Memeriksa status pengguna
            $user_status = $this->Madmin->get_user_status($id_user);
            if ($user_status == 'Aktif') {
            // Mengambil jumlah data yang sesuai
            $data['record_counts'] = $this->Madmin->getRecordCounts($id_user);

            $this->load->view('user/layout/header');
            $this->load->view('user/layout/menu', $data);
            $this->load->view('user/dashboard', $data);
            $this->load->view('user/layout/footer');
            } else {
                $this->load->view('demo/layout/header');
                $this->load->view('demo/layout/menu');
                $this->load->view('demo/dashboard');
                $this->load->view('demo/layout/footer');
            }
        }

        public function demo()
        {
            if (empty($this->session->userdata('username'))) {
                redirect('userpanel');
            }

            $this->load->view('demo/layout/header');
            $this->load->view('demo/layout/menu');
            $this->load->view('demo/dashboard');
            $this->load->view('demo/layout/footer');
        
        }

        public function login() {
            $u = $this->input->post('username');
            $p = md5($this->input->post('password'));
        
            $user = $this->Madmin->user_login($u, $p);
        
            if ($user) {
                if ($user->status == 'Aktif') {
                    $data_session = array(
                        'id_user'   => $user->id_user,
                        'username' => $user->username,
                    );
                    $this->session->set_userdata($data_session);
                    redirect('userpanel/dashboard');
                    
                } else if($user->status == 'Tidak Aktif') {
                    $data_session = array(
                        'id_user'   => $user->id_user,
                        'username' => $user->username,
                    );
                    $this->session->set_userdata($data_session);
                    redirect('userpanel/demo');
                }
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Password salah! </i></h6>
                </div>');
                redirect('userpanel');
            }
        }

        public function logout(){
        
            $this->session->sess_destroy();
            redirect('userpanel');
        }
        
       public function notif()
            {
    		echo 'test notification handler';
    		$json_result = file_get_contents('php://input');
    		$result = json_decode($json_result, true);
    
    		$order_id = $result['order_id'];
    		$user = $this->db->get_where('transaksi_midtrans', ['order_id' => $order_id]) ->row_array();
    		$data = [
    			'status_code' => $result['status_code']
    		];	
    		$update = [
    		    'status' => "Aktif",
    		    'batas_langganan' => date('Y-m-d', strtotime('+1 month'))
    		    ];
    		if($result['status_code'] == 200){
    			$this->db->update('transaksi_midtrans', $data, array('order_id' => $order_id));
    			$this->db->update('user', $update, array('id_user' => $user['id_user']));
    		}
    
    		error_log(print_r($result,TRUE));
    
    		//notification handler sample
    
    		/*
    		$transaction = $notif->transaction_status;
    		$type = $notif->payment_type;
    		$order_id = $notif->order_id;
    		$fraud = $notif->fraud_status;
    
    		if ($transaction == 'capture') {
    		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
    		  if ($type == 'credit_card'){
    		    if($fraud == 'challenge'){
    		      // TODO set payment status in merchant's database to 'Challenge by FDS'
    		      // TODO merchant should decide whether this transaction is authorized or not in MAP
    		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
    		      } 
    		      else {
    		      // TODO set payment status in merchant's database to 'Success'
    		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
    		      }
    		    }
    		  }
    		else if ($transaction == 'settlement'){
    		  // TODO set payment status in merchant's database to 'Settlement'
    		  echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
    		  } 
    		  else if($transaction == 'pending'){
    		  // TODO set payment status in merchant's database to 'Pending'
    		  echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
    		  } 
    		  else if ($transaction == 'deny') {
    		  // TODO set payment status in merchant's database to 'Denied'
    		  echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
    		}*/
    
    	    }

	public function tokens() {
		$id_user = $this->session->userdata('id_user');
		$username = $this->session->userdata('username');
		$jmlbayar = $this->input->post('jmlbayar');
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => $jmlbayar, // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => $jmlbayar,
		  'quantity' => 1,
		  'name' => "Berlangganan 1 Bulan"
		);

		// // Optional
		// $item2_details = array(
		//   'id' => 'a2',
		//   'price' => 50000,
		//   'quantity' => 1,
		//   'name' => "Orange"
		// );

		// Optional
		$item_details = array ($item1_details);

		// // Optional
		$billing_address = array(
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'address'       => "Mangga 20",
		  'city'          => "Jakarta",
		  'postal_code'   => "16602",
		  'phone'         => "081122334455",
		  'country_code'  => 'IDN'
		);

		// // Optional
		$shipping_address = array(
		  'first_name'    => "Obet",
		  'last_name'     => "Supriadi",
		  'address'       => "Manggis 90",
		  'city'          => "Jakarta",
		  'postal_code'   => "16601",
		  'phone'         => "08113366345",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => $username,
		//   'billing_address'  => $billing_address,
		//   'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'hours', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

        public function finish()
        {
            $id_user = $this->session->userdata('id_user');
            
            // Jika $id_user bukan array, set sebagai array
            if (!is_array($id_user)) {
                $id_user = ['user' => $id_user];
            }
        
            $result = json_decode($this->input->post('result_data'), true);
        
            $data = [
                'order_id' => $result['order_id'],
                'gross_amount' => $result['gross_amount'],
                'payment_type' => $result['payment_type'],
                'transaction_time' => $result['transaction_time'],
                'status_code' => $result['status_code'],
                'id_user' => isset($id_user['user']) ? $id_user['user'] : $id_user
            ];
        
            $this->Madmin->insert('transaksi_midtrans', $data);
            $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success left-icon-big alert-dismissible fade show">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span></button>
         <div class="media">
            <div class="alert-left-icon-big">
                <span><i class="mdi mdi-check-circle-outline"></i></span>
            </div>
            <div class="media-body">
                <h5 class="mt-1 mb-1">Terima kasih Sudah berlangganan.!</h5>
                <p>Selamat menggunakan..</p>
            </div>
        </div>
        </div>'
        );
            redirect('userpanel/dashboard');
        }

		
    }
?>