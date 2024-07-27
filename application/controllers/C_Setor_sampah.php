<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Setor_sampah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_setor_sampah', 'M_nasabah']);
        $this->table = 'setor_sampah';
    }

    public function index()
    {
        $data['title'] = 'Setor Sampah';
        $data['nin'] = $this->M_setor_sampah->tampil_nin();
        $data['sampah'] = $this->M_setor_sampah->tampil_sampah();
        $data['id'] = $this->M_setor_sampah->generate_nasabah_id();
        $nin_session = $this->session->userdata('no_induk');
        $level = $this->session->userdata('level');
        $data['setorSampah'] = $this->M_setor_sampah->view_data_where($nin_session, $level);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('V_setor_sampah', $data);
        $this->load->view('template/footer');
    }

    function ajax_getbynin()
    {
        $id_setor = $this->input->get('id_setor');
        // $nin = $this->input->get('nin');
        $data = $this->M_setor_sampah->ajax_getbynin($id_setor)->row(); // Kirim $nin,di table a_user_role_access untuk query di model
        echo json_encode($data); // Mengembalikan nilai data format json
    }


    public function ajax_delete()
    {
        // $nin = $this->input->post('nin');
        // $total = $this->input->post('total');
        $where = array('id_setor' => $this->input->post('id_setor'));
        
        // Buat array untuk kondisi query,id_setor diambil dari input post nin
        // $this->M_setor_sampah->updateSaldoHapus($nin, $total);
        $this->M_setor_sampah->Delete_Data($where, 'setor_sampah'); // Kirim kondisi where,di table a_user_role_access untuk query di model
        $data['status'] = "berhasil dihapus"; // Menarik dan menampung $msg menjadi status
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json
    }


    public function ajax_add()
    {
        // date_default_timezone_set('Asia/Jakarta');
        $nin = $this->input->post('nin');
        $total = $this->input->post('total');
        $new_id = $this->M_setor_sampah->generate_nasabah_id();
        $post_data = $this->input->post(); // Ambil semua data post    
        unset($post_data['saldo']);
        // Use $new_id as needed, e.g., save to database, pass to view, etc.
        $post_data['id_setor'] = $new_id;
      
        $msg = "success save"; // Menampung message untuk notif
  
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data 


        $this->M_setor_sampah->Input_Data($post_datamerge, 'setor_sampah'); // Kirim hasil gabungan data ke model untuk insert tb_tipe_transfer
        $this->M_setor_sampah->updateSaldoTambah($nin, $total);
        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }


    public function ajax_update()
    {

        // ********************* 1. Collect data post *********************
        // Ambil semua data post 
        $post_data = $this->input->post();
        $id_setor = $this->input->post('id_setor');
     
        $msg = "success Update"; // Menampung message untuk notif

        $post_datamerge = array_merge($post_data, $post_data); // Menggabungkan semua data

    
        $where = array('id_setor' => $id_setor); // Buat array untuk kondisi where di query        
        $this->M_setor_sampah->update_data($where, $post_datamerge, 'setor_sampah'); // Kirim hasil gabungan,kondisi sesuai nin data ke model untuk update a_user_role_access

        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }
}
