<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Sampah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_sampah');
        $this->table = 'sampah';
    }

    public function index()
    {
        $data['title'] = 'Data Sampah';
        $data['item'] = $this->M_sampah->getall();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('V_sampah', $data);
        $this->load->view('template/footer');
    }


    function ajax_getbynin()
    {
        $id_sampah = $this->input->get('id_sampah');
        $data = $this->M_sampah->ajax_getbynin($id_sampah, 'sampah')->row(); // Kirim $nin,di table a_user_role_access untuk query di model
        echo json_encode($data); // Mengembalikan nilai data format json

    }


    public function ajax_delete()
    {
        $where = array('id_sampah' => $this->input->post('id_sampah')); // Buat array untuk kondisi query,id_sampah diambil dari input post nin
        $this->M_sampah->Delete_Data($where, 'sampah'); // Kirim kondisi where,di table a_user_role_access untuk query di model
        $data['status'] = "berhasil dihapus"; // Menarik dan menampung $msg menjadi status
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json
    }


    public function ajax_add()
    {

        // ********************* 2. Collect all data post *********************     
        $post_data = $this->input->post(); // Ambil semua data post    

        $msg = "success save"; // Menampung message untuk notif
        // ********************* 3. Merge data post *********************        
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data 

        // ********************** 4. Simpan data     *********************

        $this->M_sampah->Input_Data($post_datamerge, 'sampah'); // Kirim hasil gabungan data ke model untuk insert tb_tipe_transfer


        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }


    public function ajax_update()
    {

        // ********************* 1. Collect data post *********************
        // Ambil semua data post 
        $post_data = $this->input->post();
        $id_sampah = $this->input->post('id_sampah');

        $msg = "success Update"; // Menampung message untuk notif

        // *********************  Merge data All post *********************
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data

        // **********************  Simpan data ************************        
        $where = array('id_sampah' => $id_sampah); // Buat array untuk kondisi where di query        
        $this->M_sampah->update_data($where, $post_datamerge, 'sampah'); // Kirim hasil gabungan,kondisi sesuai nin data ke model untuk update a_user_role_access

        $data['status'] = $msg; // Menarik dan menampung $msg menjadi status

        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }
}
