<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_dashboard');
        // $this->table = 'nasabah';
    }

    public function index()
    {
        check_not_login();
        $data['title'] = 'Jadwal Kegiatan';
        $data['jadwal'] = $this->M_dashboard->getall();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('V_dashboard', $data);
        $this->load->view('template/footer');
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function ajax_getbynin()
    {

        $id = $this->input->get('id');
        $data = $this->M_dashboard->ajax_getbynin($id, 'jadwal')->row(); // Kirim $nin,di table a_user_role_access untuk query di model
        echo json_encode($data); // Mengembalikan nilai data format json

    }

    public function ajax_add()
    {
   
        // ********************* 2. Collect all data post *********************     
        $post_data = $this->input->post(); // Ambil semua data post    

        // ********************* 3. Merge data post *********************        
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data 

        // ********************** 4. Simpan data     *********************

        $this->M_dashboard->Input_Data($post_datamerge, 'jadwal'); // Kirim hasil gabungan data ke model untuk insert tb_tipe_transfer
        $data['status'] = "berhasil ditambah"; 
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }


    public function ajax_update()
    {

        // ********************* 1. Collect data post *********************
        // Ambil semua data post 
        $post_data = $this->input->post();
        $id = $this->input->post('id');
    
        $post_datamerge = array_merge($post_data); // Menggabungkan semua data

        $where = array('id' => $id); // Buat array untuk kondisi where di query        
        $this->M_dashboard->update_data($where, $post_datamerge, 'jadwal'); // Kirim hasil gabungan,kondisi sesuai nin data ke model untuk update a_user_role_access
        $data['status'] = "berhasil diubah"; 
        // return value array
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json

    }

    public function ajax_delete()
    {
        $where = array('id' => $this->input->post('id')); // Buat array untuk kondisi query,nin diambil dari input post nin
        $this->M_dashboard->Delete_Data($where, 'jadwal'); // Kirim kondisi where,di table a_user_role_access untuk query di model
        $data['status'] = "berhasil dihapus"; // Menarik dan menampung $msg menjadi status
        // return value array
        $data['status'] = "berhasil dihapus"; 
        $this->output->set_content_type('application/json')->set_output(json_encode($data)); // Mengembalikan nilai data format json
    }
}