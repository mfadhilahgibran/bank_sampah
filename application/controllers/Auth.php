<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


    public function index()
    {
        check_already_login();  
        $this->load->view('V_login');
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {

            $this->load->model('M_user');
            $query = $this->M_user->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $session = array(

                    'no_induk' => $row->no_induk,
                    'nama' => $row->nama,
                    'level' => $row->level
                );
                $this->session->set_userdata($session);
                echo "<script>
                window.location.href = '" . base_url('C_Dashboard') . "'; 
                alert('Berhasil login');
                </script>";
            } else {
                echo "<script>
                alert('Gagal login: Username / Password salah');
                window.location.href = '" . base_url('Auth') . "'; 
                </script>";
            }
        }
    }

    public function logout()
    {

        $this->session->sess_destroy();
        redirect('Auth');
    }
}
