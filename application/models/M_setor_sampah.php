<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_setor_sampah extends CI_Model
{
    private $_table = "setor_sampah";
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

    function ajax_getbynin($id_setor)
    {
        $this->db->select('ss.id_setor, ss.tanggal, ss.nin, ss.nama, ss.id_sampah, ss.jenis_sampah, ss.berat, ss.harga, ss.total, n.saldo');
        $this->db->from('setor_sampah as ss');
        $this->db->join('nasabah as n', 'ss.nin = n.nin', 'left');
        $this->db->where('ss.id_setor', $id_setor);
        return $this->db->get();
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
    public function tampil_sampah()
    {
        $this->db->from('sampah');
        
        return $this->db->get()->result();
    }

    public function updateSaldoTambah($nin, $total) {
        $this->db->set('saldo', 'saldo + ' . (int)$total, FALSE);
        $this->db->where('nin', $nin);
        $this->db->update('nasabah');
    }
    public function updateSaldoHapus($nin, $total) {
        $this->db->set('saldo', 'saldo - ' . (int)$total, FALSE);
        $this->db->where('nin', $nin);
        $this->db->update('nasabah');
    }

    public function view_data_where($nin, $level) {
        
        if($level == 1){
            $this->db->select('*');
            $this->db->from($this->_table);
            return $this->db->get()->result();
        }else{
        $this->db->select('*');
        $this->db->from($this->_table);
        $this->db->where('nin', $nin);
        return $this->db->get()->result();
        }
    }

    public function generate_nasabah_id() {
        $prefix = 'S';
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
    
    private function get_last_nasabah_id($prefix, $date) {
        $this->db->like('id_setor', $prefix . $date, 'after');
        $this->db->order_by('id_setor', 'desc');
        $query = $this->db->get('setor_sampah', 1);  // Assuming 'setor_sampah' is the table name
    
        if ($query->num_rows() > 0) {
            return $query->row()->id_setor;
        }
    
        return null;
    }
    
    

}
