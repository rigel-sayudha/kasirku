<?php
    class Madmin extends CI_Model
    {
        public function cek_login($u, $p){
            $q = $this->db->get_where('admin', array('username'=>$u, 'password'=>$p));
            return $q;
        }

        public function user_login($u, $p){
            $q = $this->db->get_where('user', array('username'=>$u, 'password'=>$p));
            return $q->row();
        }

        public function insert($tabel,$data){
            $this->db->insert($tabel,$data);
        }
        
        public function get_all_data($tabel){
            $q=$this->db->get($tabel);
            return $q;
        }


        public function get_toko($id_user) {
          
            $this->db->select('toko.*, karyawan.*');
            $this->db->from('toko');
            $this->db->join('karyawan', 'toko.id_karyawan = karyawan.id_karyawan', 'left');
            $this->db->where('toko.id_user', $id_user);
            $query = $this->db->get(); 
            return $query->result();
        }

        public function get_user_status($id_user) {
            $this->db->select('status');
            $this->db->where('id_user', $id_user);
            $query = $this->db->get('user'); // Sesuaikan dengan nama tabel Anda
    
            if ($query->num_rows() > 0) {
                $result = $query->row();
                return $result->status;
            } else {
                return null; // atau sesuaikan dengan logika aplikasi Anda
            }
        }
        public function get_by_id($tabel, $field_id, $id)
            {
                return $this->db->get_where($tabel, array($field_id => $id));
            }
        public function get_toko_by_karyawan($karyawan) {
            $this->db->select('*');
            $this->db->from('toko');
            $this->db->where('id_karyawan', $karyawan);
            return $this->db->get()->result();
        }

        public function data($number, $offset) {
            $this->db->select('*');
            $this->db->from('barang');
            $this->db->limit($number, $offset);
            $query = $this->db->get();
            return $query->result();
        }    
        
        public function get_midtrans_user(){
            {
                $this->db->select('transaksi_midtrans.*, user.*');
                $this->db->from('transaksi_midtrans');
                $this->db->join('user', 'user.id_user = transaksi_midtrans.id_user', 'left');
                $query = $this->db->get();
                return $query;
            }
        }

        public function getBerlangganan() {
            $this->db->select('berlangganan.*, user.*');
            $this->db->from('berlangganan');
            $this->db->join('user', 'user.id_user = berlangganan.id_user', 'left');
            $query = $this->db->get();
            return $query;
        }

        public function updateStatusBasedOnTransaction()
        {
            // Ambil data transaksi dari tabel transaksi_midtrans dengan status_code '201' beserta data user terkait
            $transactions = $this->db
                ->select('transaksi_midtrans.id_user, transaksi_midtrans.status_code')
                ->where('transaksi_midtrans.status_code', '200')
                ->join('user', 'user.id_user = transaksi_midtrans.id_user')
                ->get('transaksi_midtrans')
                ->result();
        
            foreach ($transactions as $transaction) {
                // Ambil id_user dan status_code dari data transaksi
                $id_user = $transaction->id_user;
                $status_code = $transaction->status_code;
        
                // Ubah status user menjadi 'Aktif' jika status_code adalah '201'
                if ($status_code == '200') {
                    $this->db->where('id_user', $id_user)->update('user', ['status' => 'Aktif']);
                    // Tambahkan informasi debugging
                    error_log("User ID $id_user status updated to 'Aktif'");
                }
            }
        
            return "Status updated successfully";
        }
        
        public function get_barang_kategori($limit, $offset, $id_user) {
            $this->db->select('barang.*, kategori.*');
            $this->db->from('barang');
            $this->db->join('kategori', 'barang.id_kategori = kategori.id_kategori', 'left');
            $this->db->where('barang.id_user', $id_user);
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            return $query;
        }
        public function get_barang_category($id_user) {
            $this->db->select('barang.*, kategori.*');
            $this->db->from('barang');
            $this->db->join('kategori', 'barang.id_kategori = kategori.id_kategori', 'left');
            $this->db->where('barang.id_user', $id_user);
            $query = $this->db->get();
            return $query;
        }
        //Mengambil count data dari database
        public function get_barang_kategori_count() {
            return $this->db->count_all_results('barang');
        }
        public function get_transaksi_count() {
            return $this->db->count_all_results('transaksi');
        }
        public function get_karyawan_count() {
            return $this->db->count_all_results('karyawan');
        }
        public function get_pelanggan_count() {
            return $this->db->count_all_results('pelanggan');
        }
        public function get_kategori_count() {
            return $this->db->count_all_results('kategori');
        }
        public function get_supplier_count() {
            return $this->db->count_all_results('supplier');
        }
        public function get_transaction_count() {
            return $this->db->count_all_results('transaction');
        }

        public function isBarcodeExist($barcode, $id_user) {
            $this->db->where('barcode', 'id_user', $barcode, $id_user);
            $query = $this->db->get('barang');
            return $query->num_rows() > 0;
        }
        public function isBarcodeExistForUpdate($id, $barcode) {
            $this->db->where('barcode', $barcode);
            $this->db->where('id_barang !=', $id); // Mengecualikan barang dengan ID yang sedang diperbarui
            $query = $this->db->get('barang');
        
            return $query->num_rows() > 0;
        }

        public function get_transaksi_pelanggan($limit, $offset, $id_user) {
            $this->db->select('transaksi.*, pelanggan.*');
            $this->db->from('transaksi');
            $this->db->join('pelanggan', 'transaksi.id_pelanggan = pelanggan.id_pelanggan', 'left');
            $this->db->where('transaksi.id_user', $id_user);
            $this->db->limit($limit, $offset);
            $query = $this->db->get(); 
            return $query->result();
        }
       
        public function get_user($id_user) {
            $this->db->select('user.*');
            $this->db->from('user');
            $this->db->where('id_user', $id_user);
            $query = $this->db->get();
            return $query;
        }

        public function get_barang_by_kategori($kategori) {
            $this->db->select('*');
            $this->db->from('barang');
            $this->db->where('id_kategori', $kategori);
            return $this->db->get()->result();
        }

        public function get_barang_by_id($id_barang) {
            $this->db->select('*');
            $this->db->from('barang');
            $this->db->where_in('id_barang', $id_barang);
            $query = $this->db->get();
            return $query;
        }

        public function get_category($id_user) {
            $this->db->select('kategori.*');
            $this->db->from('kategori');
            $this->db->where('id_user', $id_user);
            $query = $this->db->get();
            return $query;
        }
        public function get_transaction($id_user){
            $this->db->select('transaction.*, barang.nama_barang, pelanggan.nama_pelanggan');
            $this->db->from('transaction');
            $this->db->join('barang', 'transaction.id_barang = barang.id_barang', 'left');
            $this->db->join('pelanggan', 'transaction.id_pelanggan = pelanggan.id_pelanggan', 'left');
            $this->db->where('transaction.id_user', $id_user);
            $query = $this->db->get();
            return $query;
        }
        public function get_item($id_user){
            $this->db->select('barang.*');
            $this->db->from('barang');
            $this->db->where('id_user', $id_user);
            $query = $this->db->get();
            return $query;
        }

        public function get_employee($id_user){
            $this->db->select('karyawan.*');
            $this->db->from('karyawan');
            $this->db->where('id_user', $id_user);
            $query = $this->db->get();
            return $query;
        }

        public function get_customer($id_user){
            $this->db->select('pelanggan.*');
            $this->db->from('pelanggan');
            $this->db->where('id_user', $id_user);
            $query = $this->db->get();
            return $query;
        }

        //Mengambil data dari database
        public function get_kategori($limit, $offset, $id_user) {
            $this->db->select('kategori.*');
            $this->db->from('kategori');
            $this->db->where('id_user', $id_user); 
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            return $query;
        }
        public function get_karyawan($limit, $offset, $id_user) {
            $this->db->select('karyawan.*');
            $this->db->from('karyawan');
            $this->db->where('id_user', $id_user); 
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            return $query;

        }
        public function get_pelanggan($limit, $offset, $id_user) {
            $this->db->select('pelanggan.*');
            $this->db->from('pelanggan');
            $this->db->where('id_user', $id_user); 
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            return $query;
        }
        public function get_supplier($limit, $offset, $id_user) {
            $this->db->select('supplier.*');
            $this->db->from('supplier');
            $this->db->where('id_user', $id_user); 
            $this->db->limit($limit, $offset);
            $query = $this->db->get();
            return $query;
        }
    
        //Update data
        public function update($tabel, $data, $field, $id){
            $this->db->where($field, $id);
            $this->db->update($tabel, $data);
        }

        public function insert_data($data) {
            return $this->db->insert('user', $data);
        }

        public function get_invoice_data($invoice_id) {
            // Assuming you have a table named 'invoices' in your database
            $this->db->where('id_transaksi', $invoice_id);
            $query = $this->db->get('transaksi');
        
            // Check if the query was successful
            if ($query->num_rows() > 0) {
                return $query->row(); // Return a single row of the result
            } else {
                return false; // Return false if no data is found
            }
        }
        public function get_user_data($user_id) {

            $this->db->where('id_user', $user_id);
            $query = $this->db->get('user');           
            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                return array(); // Return array kosong jika pengguna tidak ditemukan
            }
        }

        public function getRecordCounts($id_user) {
            $this->load->database();
        
            $record_counts = array(
                'barang' => $this->db->where('id_user', $id_user)->count_all('barang'),
                'supplier' => $this->db->where('id_user', $id_user)->count_all('supplier'),
                'transaksi' => $this->db->where('id_user', $id_user)->count_all('transaksi'),
                'pelanggan' => $this->db->where('id_user', $id_user)->count_all('pelanggan'),
                'user'  => $this->db->count_all('user')
            );
            return $record_counts;
        }

        public function get_user_stores($id_user) {
            $this->db->select('*');
            $this->db->from('toko'); 
            $this->db->where('id_user', $id_user);
            $query = $this->db->get();
        
            return $query->result();
        }

        public function cek_login_user($u,$p){
        $q=$this->db->get_where('tbl_user',array('username'=>$u,'password'=>$p,'status_bayar'=>'Y'));
        return $q;
    }    

        public function delete($tabel,$id,$val){
            $this->db->delete($tabel,array($id => $val));
        }
    
        public function delete_cart_item($id_cart, $params = null) {
            if($params != null) {
                $this->db->where($params);
            }
            $this->db->where('id_cart', $id_cart);
            $this->db->delete('cart');
        }
        public function invoice_no()
        {
            $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no 
                    FROM transaksi 
                    WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(), '%y%m%d')";
            $query = $this->db->query($sql);
            if($query->num_rows() > 0) {
                $row = $query->row();
                $n = ((int)$row->invoice_no) + 1;
                $no = sprintf("%'.04d", $n);
            } else {
                $no = "0001";
            }
            $invoice = "MP".date('ymd').$no;
            return $invoice;
        }
        public function add_cart($post) {
            $query = $this->db->query("SELECT MAX(id_cart) AS no_cart FROM cart");
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $cart_no = ((int)$row->no_cart) + 1;
            } else {
                $cart_no = "1";
            }
        
            $params = array(
                'id_cart' => $cart_no,
                'id_barang' => $post['id_barang'],
                'harga' => $post['harga'],
                'qty' => $post['qty'],
                'total' => ($post['harga'] * $post['qty']),
                'id_user' => $this->session->userdata('id_user'),
            );
            $this->db->insert('cart', $params);
        }
        public function update_cart($post) {
            $params = array(
                'harga' => $post['harga'],
                'qty' => $post['qty'],
                'total' => ($post['harga'] * $post['qty']),
            );
        
            $this->db->where('id_cart', $post['id_cart']);
            $this->db->update('cart', $params);
        }

        public function del_cart($params = null) {
            if($params != null) {
                $this->db->where($params);
            }
            $this->db->delete('cart');
        }
        public function get_cart($id_user, $params = null){
            $this->db->select('*','barang.nama_barang as barang_nama, cart.harga as cart_harga');
            $this->db->from('cart');
            $this->db->join('barang', 'cart.id_barang = barang.id_barang');
            $this->db->where('cart.id_user', $id_user); 
            if($params != null) {
                $this->db->where($params);
            }
            $query = $this->db->get();
            return $query;
        }

        
        public function add_sale($post) {
            $params = array (
                'invoice' => $this->invoice_no(),
                'id_pelanggan' => $post['id_pelanggan'],
                'total' => $post['subtotal'],
                'final_price' => $post['grandtotal'],
                'cash' => $post['cash'],
                'remaining' => $post['change'],
                'note' => $post['note'],
                'date' => $post['date'],
                'id_user' => $this->session->userdata('id_user')
            );
            $this->db->insert('transaksi',$params);
            return $this->db->insert_id();
        }
        function add_sale_detail($params) {
            $this->db->insert_batch('transaksi_detail', $params);
        }
    }
?>