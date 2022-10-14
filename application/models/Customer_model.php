<?php 

Class Customer_model extends CI_Model {

    public function getAll()
    {
        return $this->db->get('m_customer')->result_array();
    }

    public function getCustomerByCode($kode)
    {
        $this->db->where('kode', $kode);
        return $this->db->get('m_customer')->row_array();
    }
}