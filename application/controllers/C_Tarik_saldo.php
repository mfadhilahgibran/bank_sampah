<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Tarik_saldo extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_tarik_saldo', 'M_nasabah']);
        $this->table = 'tarik_saldo';
    }

    public function index()
    {
        $data['title'] = 'Tarik Saldo';
        $data['nin'] = $this->M_tarik_saldo->tampil_nin();
        $data['id'] = $this->M_tarik_saldo->generate_nasabah_id();
        
        $nin_session = $this->session->userdata('no_induk');
        $level = $this->session->userdata('level');
        $data['tarikSampah'] = $this->M_tarik_saldo->view_data_where($nin_session, $level);
        // $data['tarikSampah'] = $this->M_tarik_saldo->getall();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('V_tarik_saldo', $data);
        $this->load->view('template/footer');
    }


    function ajax_getbynin()
    {

        $id_tarik = $this->input->get('id_tarik');
        $data = $this->M_tarik_saldo->ajax_getbynin($id_tarik, 'tarik_saldo')->row(); // Kirim $nin,di table a_user_role_access untuk query di model
        echo json_encode($data); // Mengembalikan nilai data format json

    }


    public function ajax_delete()
    {
        // $post_data = $this->input->post();
        // $nin = $this->input->post('nin');
        // $tarik_saldo = $this->input->post('jumlah_tarik');
        // $post_datamerge = array_merge($post_data);
        $where = array('id_tarik' => $this->input->post('id_tarik'));

        // Buat array untuk kondisi query,id_setor diambil dari input post nin
        // $this->M_tarik_saldo->updateSaldoHapus($nin, $tarik_saldo);
        $this->M_tarik_saldo->Delete_Data($where, 'tarik_saldo'); // Kirim kondisi where,di table a_user_role_access untuk query di model
        $data['status'] = "berhasil dihapus"; // Menarik dan menampung $msg menjadi status
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json
    }



    public function ajax_add()
    {
        // ********************* 0. Generate nomor transaksi  *********************          
        // date_default_timezone_set('Asia/Jakarta');
        $nin = $this->input->post('nin');
        
        // ********************* 2. Collect all data post *********************     
        $new_id = $this->M_tarik_saldo->generate_nasabah_id();
        $post_data = $this->input->post(); // Ambil semua data post   
        $post_data['id_tarik'] = $new_id;

        $msg = "success save"; // Menampung message untuk notif
        $tarik_saldo = $this->input->post('jumlah_tarik');

      
        // ********************* 3. Merge data post *********************        
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data 

        // ********************** 4. Simpan data     *********************
       
        $this->M_tarik_saldo->Input_Data($post_datamerge, 'tarik_saldo'); // Kirim hasil gabungan data ke model untuk insert tb_tipe_transfer
        $this->M_tarik_saldo->updateSaldoTambah($nin, $tarik_saldo);

        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }


    public function ajax_update()
    {
        // ********************* 1. Collect data post *********************
        // Ambil semua data post 
        $post_data = $this->input->post();
        $id_tarik = $this->input->post('id_tarik');
     
        $msg = "success Update"; // Menampung message untuk notif

        // *********************  Merge data All post *********************
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data

        // **********************  Simpan data ************************        
        $where = array('id_tarik' => $id_tarik); // Buat array untuk kondisi where di query        
        $this->M_tarik_saldo->update_data($where, $post_datamerge, 'tarik_saldo'); // Kirim hasil gabungan,kondisi sesuai nin data ke model untuk update a_user_role_access

        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }

    
}
