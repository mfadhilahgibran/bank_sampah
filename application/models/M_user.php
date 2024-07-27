<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where('no_induk', $post['no_induk']);
        $this->db->where('password', $post['password']);
        $query = $this->db->get();
        return $query;
    }
}
