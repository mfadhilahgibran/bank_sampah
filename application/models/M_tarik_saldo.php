<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tarik_saldo extends CI_Model
{
    private $_table = "tarik_saldo";
    public function getall()
    {
        $this->db->select('*');
        $this->db->from($this->_table);
        return $this->db->get()->result();
    }

    public function insert($nsb)
    {
        if (!$nsb) {
            return;
        }
        return $this->db->insert($this->_table, $nsb);
    }

    public function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where)->result();
    }
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    public function hapus_data($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    function ajax_getbynin($id_tarik, $table)
    {
        return $this->db->get_where($table, array('id_tarik' => $id_tarik));
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

    public function tampil_nin()
    {
        $this->db->select('*');
        $this->db->from('nasabah');
        return $this->db->get()->result();
    }

    public function updateSaldoTambah($nin, $tarik_saldo)
    {
        $this->db->set('saldo', 'saldo - ' . (int)$tarik_saldo, FALSE);
        $this->db->where('nin', $nin);
        $this->db->update('nasabah');
    }
    public function updateSaldoHapus($nin, $tarik_saldo)
    {
        $this->db->set('saldo', 'saldo + ' . (int)$tarik_saldo, FALSE);
        $this->db->where('nin', $nin);
        $this->db->update('nasabah');
    }

    public function view_data_where($nin, $level)
    {
        if ($level == 1) {
            $this->db->select('*');
            $this->db->from($this->_table);
            return $this->db->get()->result();
        } else {
            $this->db->select('*');
            $this->db->from($this->_table);
            $this->db->where('nin', $nin);
            return $this->db->get()->result();
        }
    }

    public function generate_nasabah_id()
    {
        $prefix = 'T';
        $date = date('md');
        $last_id = $this->get_last_nasabah_id($prefix, $date);

        if ($last_id) {
            $last_number = (int) substr($last_id, 5); // Adjusted to match the new ID format
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }

        $new_id = $prefix . $date . str_pad($new_number, 2, '0', STR_PAD_LEFT);
        return $new_id;
    }

    private function get_last_nasabah_id($prefix, $date)
    {
        $this->db->like('id_tarik', $prefix . $date, 'after');
        $this->db->order_by('id_tarik', 'desc');
        $query = $this->db->get('tarik_saldo', 1);  // Assuming 'setor_sampah' is the table name

        if ($query->num_rows() > 0) {
            return $query->row()->id_tarik;
        }

        return null;
    }
}
