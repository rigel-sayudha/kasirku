<?php 
defined('BASEPATH') OR exit('no direct script access allowed');
// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
require 'vendor/autoload.php';
class Barang extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
    }

    public function index() {
        if (empty($this->session->userdata('username'))) {
            redirect('userpanel');
        }
    
        // Load the pagination library
        $this->load->library('pagination');
    
        // Configure pagination
        $config['base_url'] = site_url('barang/index');
        $config['total_rows'] = $this->Madmin->get_barang_kategori_count(); // Use a method to get total row count
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
        // Load data using the offset and limit
        $data['barang'] = $this->Madmin->get_barang_kategori($config['per_page'], $offset, $id_user)->result();
    
        $data['kategori'] = $this->Madmin->get_category($id_user)->result();
    
        $this->load->view('user/layout/header');
        $this->load->view('user/layout/menu');
        $this->load->view('user/barang/tampil', $data);
        $this->load->view('user/layout/footer');
    } else {
        $this->load->view('demo/layout/header');
        $this->load->view('demo/layout/menu');
        $this->load->view('demo/dashboard');
        $this->load->view('demo/layout/footer');
        }
    }
    public function export() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
        'font' => ['bold' => true], // Set font nya jadi bold
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ],
        'borders' => [
            'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
            'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
            'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
            'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
        ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
        'alignment' => [
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
        ],
        'borders' => [
            'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
            'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
            'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
            'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
        ]
        ];
        $sheet->setCellValue('A1', "DATA BARANG"); // Set kolom A1 dengan tulisan "DATA BARANG"
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "NAMA BARANG"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "KATEGORI"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "HARGA"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "STOK"); // Set kolom E3 dengan tulisan "ALAMAT"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $data = $this->Madmin->get_barang_kategori();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($siswa as $data){ // Lakukan looping pada variabel siswa
        $sheet->setCellValue('A'.$numrow, $no);
        $sheet->setCellValue('B'.$numrow, $data->nama_barang);
        $sheet->setCellValue('C'.$numrow, $data->nama_kategori);
        $sheet->setCellValue('D'.$numrow, $data->harga);
        $sheet->setCellValue('E'.$numrow, $data->stok);
        
        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
        $sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
        $sheet->getStyle('E'.$numrow)->applyFromArray($style_row);
        
        $no++; // Tambah 1 setiap kali looping
        $numrow++; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $sheet->setTitle("Laporan Data Barang");
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Data Barang.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function get_barang_by_kategori($kategori) {
        $data['barang'] = $this->Madmin->get_barang_by_kategori($kategori);
        echo json_encode($data);
    }
    public function save() {
        $this->form_validation->set_rules('barcode', 'Barcode', 'required');
        $this->form_validation->set_rules('nama_barang', 'Nama barang', 'required');
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h6><i> Data barang tidak valid! </i></h6>
            </div>');
        } else {
            $id_user = $this->session->userdata('id_user');
            $barcode = $this->input->post('barcode');
    
            // Validasi apakah barcode sudah digunakan
            $isBarcodeExist = $this->Madmin->isBarcodeExist($barcode, $id_user);
    
            if ($isBarcodeExist) {
                // Jika barcode sudah digunakan, tampilkan pesan kesalahan
                $this->session->set_flashdata('massage', '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i>Barcode sudah digunakan! </i></h6>
                </div>');
            } else {
                // Barcode belum digunakan, lanjutkan proses penyimpanan
                $config['upload_path'] = FCPATH . 'assets/upload/'; // Sesuaikan dengan direktori upload Anda
                $config['allowed_types'] = 'jpeg|jpg|png';
                $config['max_size'] = 4096; // Ukuran maksimal file dalam kilobita
        
                $this->load->library('upload', $config);
    
                if ($this->upload->do_upload('foto')) {
                    // Jika upload berhasil, ambil data file
                    $upload_data = $this->upload->data();
                    $foto = $upload_data['file_name'];
    
                    $data = array(
                        'barcode' => $barcode,
                        'nama_barang' => $this->input->post('nama_barang'),
                        'harga' => $this->input->post('harga'),
                        'id_kategori' => $this->input->post('id_kategori'),
                        'stok' => $this->input->post('stok'),
                        'foto' => $foto,
                        'id_user' => $this->input->post('id_user'),
                    );
    
                    $result = $this->Madmin->insert('barang', $data);
    
                    if ($result) {
                        $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                            <h6><i> Barang berhasil ditambahkan! </i></h6>
                        </div>');
                    } else {
                        $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h6><i> Barang berhasil ditambahkan! </i></h6>
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
        }
    
        redirect('barang');
    }
    public function update(){
        // Pastikan ada sesi yang sesuai sebelum melakukan perubahan
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }
    
        // Ambil informasi dari formulir edit
        $id = $this->input->post('id_barang');
        $barcode = $this->input->post('barcode');
        $nama = $this->input->post('nama_barang');
        $kategori = $this->input->post('id_kategori');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
    
        // Proses foto baru jika diunggah
        $foto = ''; // Inisialisasi variabel
        if (!empty($_FILES['foto']['name'])) {
            // Konfigurasi upload foto
            $config['upload_path'] = FCPATH . 'assets/upload/'; // Ganti dengan path direktori penyimpanan foto
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 4096; // Atur sesuai kebutuhan
    
            $this->load->library('upload', $config);
    
            if (!$this->upload->do_upload('foto')) {
                // Penanganan jika gagal mengunggah foto
                $error = array('error' => $this->upload->display_errors());
                // Tindakan jika gagal mengunggah foto, bisa menampilkan pesan kesalahan atau melakukan penanganan lainnya
            } else {
                $data = $this->upload->data();
                $foto = $data['file_name']; // Simpan nama foto yang berhasil diunggah
            }
        }
    
        // Validasi apakah barcode sudah digunakan untuk barang lain
        $isBarcodeExist = $this->Madmin->isBarcodeExistForUpdate($id, $barcode);
    
        if ($isBarcodeExist) {
            // Jika barcode sudah digunakan, tampilkan pesan kesalahan
            $this->session->set_flashdata('massage', '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h6><i>Barcode sudah digunakan! </i></h6>
            </div>');
        } else {
            // Barcode belum digunakan, lanjutkan proses pembaruan
            // Siapkan data yang akan diupdate
            $dataUpdate = array(
                'barcode' => $barcode,
                'nama_barang' => $nama,
                'id_kategori' => $kategori,
                'harga' => $harga,
                'stok' => $stok,
                // Periksa apakah ada foto baru yang diunggah
                'foto' => ($foto != '') ? $foto : $this->input->post('foto_lama') // Menggunakan foto lama jika tidak ada foto baru
            );
    
            // Panggil model untuk menyimpan perubahan
            $this->Madmin->update('barang', $dataUpdate, 'id_barang', $id);
    
            $this->session->set_flashdata('massage', '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h6><i> Barang berhasil diperbarui! </i></h6>
            </div>');
        }
    
        redirect('barang'); // Kembali ke halaman barang setelah perubahan
    }


    public function delete($id){
        if(empty($this->session->userdata('username'))){
            redirect('userpanel');
        }
        $this->Madmin->delete('barang','id_barang',$id);
        $this->session->set_flashdata('massage','<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <h6><i> Barang berhasil dihapus </i></h6>
                </div>');
        redirect('barang');
    }

}