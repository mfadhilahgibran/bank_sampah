<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sampah extends CI_Model
{
    private $_table = "sampah";
    public function getall()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        return $this->db->get()->result();
    }

    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
   
    function ajax_getbynin($id_sampah, $table)
    {
        return $this->db->get_where($table, array('id_sampah' => $id_sampah));
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


}
