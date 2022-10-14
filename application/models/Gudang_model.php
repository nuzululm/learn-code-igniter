<?php 

Class Gudang_model extends CI_Model {

    public function getAll()
    {
        return $this->db->get('m_gudang')->result_array();
    }
}