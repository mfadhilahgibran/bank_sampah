<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Nasabah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_nasabah');
        $this->table = 'nasabah';
    }

    public function index()
    {
        $data['title'] = 'Data Nasabah';
        // $data['nasabah'] = $this->M_nasabah->getall();
        $no_induk_session = $this->session->userdata('no_induk');
        $level = $this->session->userdata('level');
        $data['nasabah'] = $this->M_nasabah->view_data_where();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('V_nasabah', $data);
        $this->load->view('template/footer');
    }
// 
    function ajax_getbyno_induk()
    {

        $nin = $this->input->get('nin');
        $data = $this->M_nasabah->ajax_getbyno_induk($nin)->row(); // Kirim $no_induk,di table a_user_role_access untuk query di model
        echo json_encode($data); // Mengembalikan nilai data format json

    }
    public function ajax_delete()
    {
        $where = array('nin' => $this->input->post('nin')); // Buat array untuk kondisi query,no_induk diambil dari input post no_induk
        $where1 = array('no_induk' => $this->input->post('nin')); // Buat array untuk kondisi query,no_induk diambil dari input post no_induk
        $this->M_nasabah->Delete_Data($where, 'nasabah'); // Kirim kondisi where,di table a_user_role_access untuk query di model
        $this->M_nasabah->Delete_Data($where1, 'user_login'); // Kirim kondisi where,di table a_user_role_access untuk query di model
        $data['status'] = "berhasil dihapus"; // Menarik dan menampung $msg menjadi status
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json
    }


    public function ajax_add()
    {

        $post_data = array(
            'nin' => $this->input->post('nin'),
            'nama' => $this->input->post('nama'),
            'rt' => $this->input->post('rt'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email')
        ); // Ambil semua data post
        // $post_data['level'] = 1;
        $msg = "success save"; // Menampung message untuk notif

        $post_datamerge = array_merge($post_data); // Menggabungkan semua data 

        // ********************** 4. Simpan data     *********************

        $this->M_nasabah->Input_Data($post_datamerge, 'nasabah');

        $post_data_1 = array(
            'no_induk' => $this->input->post('nin'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
            'level' => 2
        ); // Ambil semua data post  

        $post_datamerge_1 = array_merge($post_data_1); // Menggabungkan semua data
        // Kirim hasil gabungan data ke model untuk insert tb_tipe_transfer
        $this->M_nasabah->Input_Data($post_datamerge_1, 'user_login'); // Kirim hasil gabungan data ke model untuk insert tb_tipe_transfer

        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }

    public function ajax_update()
    {

        $post_data = array(
            'nin' => $this->input->post('nin'),
            'nama' => $this->input->post('nama'),
            'rt' => $this->input->post('rt'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'email' => $this->input->post('email')
        );
        $nin = $this->input->post('nin');
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data

        $where = array('nin' => $nin); // Buat array untuk kondisi where di query        
        $msg = "success Update"; // Menampung message untuk notif

        // **********************  Simpan data ************************        
        $this->M_nasabah->update_data($where, $post_datamerge, 'nasabah');

        $where1 = array('no_induk' => $nin);
        $post_data_pw = array(
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama')
        ); // Kirim hasil gabungan,kondisi sesuai no_induk data ke model untuk update a_user_role_access
        $post_datamerge_pw = array_merge($post_data_pw);

        // Kirim hasil gabungan,kondisi sesuai no_induk data ke model untuk update a_user_role_access
        $this->M_nasabah->update_data($where1, $post_datamerge_pw, 'user_login');
        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data));  // Mengembalikan nilai data format json

    }
}
