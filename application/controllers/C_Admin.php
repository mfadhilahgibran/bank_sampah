<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
        $this->table = 'admin';
    }

    public function index()
    {
        $data['title'] = 'Data Admin';
        // $data['admin'] = $this->M_admin->getall();
        $_session = $this->session->userdata('no_induk');
        $level = $this->session->userdata('level');
        $data['admin'] = $this->M_admin->view_data_where();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('V_admin', $data);
        $this->load->view('template/footer');
    }

 


    function ajax_getbyno_induk()
    {

        $nia = $this->input->get('nia');
        $data = $this->M_admin->ajax_getbyno_induk($nia)->row(); // Kirim $no_induk,di table a_user_role_access untuk query di model
        echo json_encode($data); // Mengembalikan nilai data format json

    }


    public function ajax_delete()
    {
        $where = array('nia' => $this->input->post('nia')); // Buat array untuk kondisi query,nia diambil dari input post nia
        $where1 = array('no_induk' => $this->input->post('nia')); // Buat array untuk kondisi query,nia diambil dari input post nia
        $this->M_admin->Delete_Data($where, 'admin'); // Kirim kondisi where,di table a_user_role_access untuk query di model
        $this->M_admin->Delete_Data($where1, 'user_login'); // Kirim kondisi where,di table a_user_role_access untuk query di model
        $data['status'] = "berhasil dihapus"; // Menarik dan menampung $msg menjadi status
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json
    }


    public function ajax_add()
    {
      

        // ********************* 2. Collect all data post *********************     
        $post_data = array(
            'nia' => $this->input->post('nia'),
            'nama' => $this->input->post('nama'),
            'rt' => $this->input->post('rt'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email')
        );// Ambil semua data post    
        // $post_data['level'] = 1;
        $msg = "success save"; // Menampung message untuk notif
     
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data 

        // ********************** 4. Simpan data     *********************

        $this->M_admin->Input_Data($post_datamerge, 'admin');
        
        
        $post_data_1 = array(
            'no_induk' => $this->input->post('nia'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
            'level' => 1
            
        );// Ambil semua data post  
        

        $post_datamerge_1 = array_merge($post_data_1); // Menggabungkan semua data
        // Kirim hasil gabungan data ke model untuk insert tb_tipe_transfer
        $this->M_admin->Input_Data($post_datamerge_1, 'user_login'); // Kirim hasil gabungan data ke model untuk insert tb_tipe_transfer


        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }


    public function ajax_update()
    {

        // ********************* 1. Collect data post *********************
        // Ambil semua data post 

        $post_data = array(
            'nia' => $this->input->post('nia'),
            'nama' => $this->input->post('nama'),
            'rt' => $this->input->post('rt'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email')
        );
        $nia = $this->input->post('nia');
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data
        
        $where = array('nia' => $nia); // Buat array untuk kondisi where di query        
        $msg = "success Update"; // Menampung message untuk notif

        // **********************  Simpan data ************************        
        $this->M_admin->update_data($where, $post_datamerge, 'admin'); 


        $post_data_pw = array(
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama')
    );// Kirim hasil gabungan,kondisi sesuai nia data ke model untuk update a_user_role_access
    $where1 = array('no_induk' => $nia);
    $post_datamerge_pw = array_merge($post_data_pw);
        $this->M_admin->update_data($where1, $post_datamerge_pw, 'user_login'); 
        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }
}
