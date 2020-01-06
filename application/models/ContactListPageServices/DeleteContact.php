<?php

class DeleteContact extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function removeContact($contactId)
    {

        $this->removeTags($contactId);

        var_dump($contactId);
        $this->db->where('contactId', $contactId);
        $this->db->delete('Contact');

        return 'Deleted the contact';
    }

    public function removeTags($contactId)
    {
        $this->db->where('contactId', $contactId);
        $this->db->delete('ContactTag');
    }
}
