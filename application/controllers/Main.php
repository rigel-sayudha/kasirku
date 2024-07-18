<?php 
defined('BASEPATH') OR exit('no direct script access allowed');
class main extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
    }

   public function index()
   {
        $this->load->view('home/layout/header');
        $this->load->view('home/home');
        $this->load->view('home/layout/footer');
    }
}
?>