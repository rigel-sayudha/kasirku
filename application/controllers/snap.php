<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-kt0wxJfAA_vwVSV-Ws779hgW', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }

    public function index()
    {
    	$this->load->view('checkout_snap');
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
		$result = json_decode($this->input->post('result_data'), true);

		$data = [
			'id_user' => $id_user,
			'order_id' => $result['order_id'],
			'gross_amount' => $result['gross_amount'],
			'payment_type' => $result['payment_type'],
			'transaction_time' => $result['transaction_time'],
			'bank' => $result['va_numbers'][0]["bank"],
			'va_number' => $result['va_numbers'][0]["va_number"],
			'pdf_url' => $result['pdf_url'],
			'status_code' => $result['status_code']
		];

		$simpan = $this->db->insert('transaksi_midtrans', $data);
		
		if ($simpan) {
			redirect('userpanel/demo');		
			// Memanggil fungsi updateStatusBasedOnTransaction dengan order_id
			$this->Madmin->updateStatusBasedOnTransaction($result['order_id']);
		} else {
			echo "Gagal";
		}
	}
}
