<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    private $_table = "jadwal";

    public function getall()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        return $this->db->get()->result();
    }

    function ajax_getbynin($id, $table)
    {
        return $this->db->get_where($table, array('id' => $id));
    }
    function Input_Data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function Delete_Data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
}
