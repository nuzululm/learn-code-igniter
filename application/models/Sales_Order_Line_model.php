<?php 

Class Sales_Order_Line_model extends CI_Model {

    public function getAll()
    {
        return $this->db->get('sales_order_line')->result_array();
    }

    public function storeSalesOrderLine($data)
    {
        $this->db->insert('sales_order_line', $data);
    }
}
