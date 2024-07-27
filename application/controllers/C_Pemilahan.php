<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Pemilahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dashboard');
        // $this->table = 'nasabah';
    }

    public function index()
    {
        // check_not_login();
        $data['title'] = 'Edukasi Pemilahan Sampah';
        // $data['dashboard'] = $this->M_dashboard-->getall();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('V_pemilahan');
        $this->load->view('template/footer');
    }

}