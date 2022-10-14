<?php 

Class Sales_Order_model extends CI_Model {

    public function getAll()
    {
        return $this->db->get('sales_order')->result_array();
    }

    public function getAllOrderByDesc()
    {
        $this->db->from('sales_order');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get(); 
        return $query->result_array();
    }

    public function storeSalesOrder($data)
    {
        $this->db->insert('sales_order', $data);
        return $this->db->insert_id();
    }
}