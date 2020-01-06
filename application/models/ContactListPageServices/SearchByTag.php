<?php

class SearchByTag extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getContactIds($friends, $work, $family)
    {
        $contactsIdArray = array();

        if ($friends != null) {
            $this->db->select('*');
            $this->db->from('ContactTag');
            $this->db->where('tagType', 'Friends');

            $query = $this->db->get();

            foreach($query->result() as $contactTag){
                array_push($contactsIdArray, $contactTag->contactId);
            }
        }

        if ($work != null) {
            $this->db->select('*');
            $this->db->from('ContactTag');
            $this->db->where('tagType', 'Work');

            $query = $this->db->get();

            foreach($query->result() as $contactTag){
                array_push($contactsIdArray, $contactTag->contactId);
            }
        }

        if ($family != null) {
            $this->db->select('*');
            $this->db->from('ContactTag');
            $this->db->where('tagType', 'Family');

            $query = $this->db->get();

            foreach($query->result() as $contactTag){
                array_push($contactsIdArray, $contactTag->contactId);
            }
        }

        if (is_array($contactsIdArray)){
            return $contactsIdArray;
        } else {
            return null;
        }
    }
}
