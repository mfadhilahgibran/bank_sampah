<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_FirstPage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('M_dashboard');
        // $this->table = 'nasabah';
    }

    public function index()
    {
   
    
        $this->load->view('V_firstpage');
    
    }

}