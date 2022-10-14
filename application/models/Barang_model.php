<?php 

Class Barang_model extends CI_Model {

    public function getAll()
    {
        return $this->db->get('m_barang')->result_array(); 
    }

    public function getBarangByCode($kode)
    {
        $this->db->where('kode', $kode);
        return $this->db->get('m_barang')->row_array();
    }
}