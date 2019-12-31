<?php

class GetContacts extends CI_Model {
    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getAllContacts() {
        $this->db->select('*');
        $this->db->from('Contact');

        $query = $this->db->get();

        $surname = $query->row_array()['contactSurname'];

        return $surname;
    }
}