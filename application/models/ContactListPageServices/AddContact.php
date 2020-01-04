<?php

class AddContact extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    public function addContactDetailsToDB($name, $email, $telephoneNo, $tags)
    {
        if ($this->userAlreadyExists($name, $email, $telephoneNo)) {
            return "Contact already exsits";
        } else {
            $contactDetails = array(
                'contactName' => $name,
                'contactEmail' => $email,
                'contactTelephoneNo' => $telephoneNo
            );

            $this->db->insert('Contact', $contactDetails);

            $contactId = $this->getContactId($name, $email, $telephoneNo);

            $this->setTheContactTags($contactId, $tags);

            return "New Contact Added";
        }
    }

    public function userAlreadyExists($name, $email, $telephoneNo)
    {

        $array = array(
            'contactName' => $name,
            'contactEmail' => $email,
            'contactTelephoneNo' => $telephoneNo
        );

        $this->db->select('*');
        $this->db->from('Contact');
        $this->db->where($array);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getContactId($name, $email, $telephoneNo)
    {
        $array = array(
            'contactName' => $name,
            'contactEmail' => $email,
            'contactTelephoneNo' => $telephoneNo
        );

        $this->db->select('*');
        $this->db->from('Contact');
        $this->db->where($array);

        $query = $this->db->get();

        $contactId = $query->row_array()['contactId'];

        return $contactId;
    }

    public function setTheContactTags($contactId, $tags)
    {
        if (!$tags['friends'] == null) {
            $contactTag = array(
                'tagType' => $tags['friends'] ,
                'contactId' => $contactId,
            );

            $this->db->insert('ContactTag', $contactTag);
        }

        if (!$tags['work'] == null) {
            $contactTag = array(
                'tagType' => $tags['work'] ,
                'contactId' => $contactId,
            );

            $this->db->insert('ContactTag', $contactTag);
        }

        if (!$tags['family'] == null) {
            $contactTag = array(
                'tagType' => $tags['family'] ,
                'contactId' => $contactId,
            );

            $this->db->insert('ContactTag', $contactTag);
        }
    }
}
