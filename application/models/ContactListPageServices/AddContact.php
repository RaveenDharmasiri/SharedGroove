<?php

class AddContact extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    public function addContactDetailsToDB($name, $email, $telephoneNo)
    {
        if ($this->userAlreadyExists($name)) {
            return "Contact already exsits";
        } else {
            $contactDetails = array(
                'contactName' => $name,
                'contactEmail' => $email,
                'contactTelephoneNo' => $telephoneNo
            );

            $this->db->insert('Contact', $contactDetails);

            return "New Contact Added";
        }
    }

    public function userAlreadyExists($name)
    {
        $this->db->select('*');
        $this->db->from('Contact');
        $this->db->where('contactName', $name);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
