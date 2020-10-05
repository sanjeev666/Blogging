<?php

class Core_Model extends CI_Model
{

// (KC) Get user data by user id
    public function getUserData($id = 0)
    {
        return $this->db->get_where('users', array('id' => $id))->row_array();
    }

    public function insertVisitor($visitor)
    {
        $this->db->where('visitorsIP', $visitor['visitorsIP']);
        $query = $this->db->get('visitors');
        if ($query->num_rows() > 0) {
            return true;

        } else {

            $this->db->insert('visitors', $visitor);
        }

    }

    public function insertImages($createimage)
    {
        $this->db->insert('images', $createimage);

    }

    public function getPendingData()
    {
        return $this->db->get_where('transaction', array('id' => $id, 'status' => 'PENDING'))->row_array();
    }
}
