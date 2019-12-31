<?php

class AddContact extends CI_Model {
    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function addContactDetailsToDB($firstName, $surname, $email, $telephoneNo) {
        $contactDetails = array(
            'firstName'=>$firstName,
            'surname'=>$surname,
            'email'=>$email,
            'telephoneNo'=>$telephoneNo
        );

        $this->db->insert('User', $contactDetails);
    }
}