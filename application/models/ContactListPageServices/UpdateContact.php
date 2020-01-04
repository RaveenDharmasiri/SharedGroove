<?php

class UpdateContact extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function editContact($contactId, $name, $email, $telephoneNo, $tags)
    {

        $array = array(
            'contactId' => $contactId,
            'contactName' => $name,
            'contactEmail' => $email,
            'contactTelephoneNo' => $telephoneNo
        );

        $this->db->replace('Contact', $array);

        return 'Updated the contact';
    }

    public function updateTags($contactId, $tags)
    {

        // Updating contacts friends tag - start
        if (!$tags['friends'] == null) {

            $array = array(
                'tagType' => $tags['friends'],
                'contactId' => $contactId
            );

            $this->db->select('*');
            $this->db->from('ContactTag');
            $this->db->where($array);
            $query = $this->db->get();

            if ($query->num_rows() < 0) {
                $contactTag = array(
                    'tagType' => $tags['friends'],
                    'contactId' => $contactId,
                );

                $this->db->insert('ContactTag', $contactTag);
            }
        } else {
            $array = array(
                'tagType' => $tags['friends'],
                'contactId' => $contactId
            );

            $this->db->select('*');
            $this->db->from('ContactTag');
            $this->db->where($array);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $contactTag = array(
                    'tagType' => $tags['friends'],
                    'contactId' => $contactId,
                );

                $this->db->where($contactTag);
                $this->db->delete('ContactTag');
            }
        }
        // Updating contacts friends tag - end



        // Updating contacts work tag - start
        if (!$tags['work'] == null) {

            $array = array(
                'tagType' => $tags['work'],
                'contactId' => $contactId
            );

            $this->db->select('*');
            $this->db->from('ContactTag');
            $this->db->where($array);
            $query = $this->db->get();

            if ($query->num_rows() < 0) {
                $contactTag = array(
                    'tagType' => $tags['work'],
                    'contactId' => $contactId,
                );

                $this->db->insert('ContactTag', $contactTag);
            }
        } else {
            $array = array(
                'tagType' => $tags['work'],
                'contactId' => $contactId
            );

            $this->db->select('*');
            $this->db->from('ContactTag');
            $this->db->where($array);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $contactTag = array(
                    'tagType' => $tags['work'],
                    'contactId' => $contactId,
                );

                $this->db->where($contactTag);
                $this->db->delete('ContactTag');
            }
        }
        // Updating contacts work tag - end


        // Updating contacts family tag - start
        if (!$tags['family'] == null) {

            $array = array(
                'tagType' => $tags['family'],
                'contactId' => $contactId
            );

            $this->db->select('*');
            $this->db->from('ContactTag');
            $this->db->where($array);
            $query = $this->db->get();

            if ($query->num_rows() < 0) {
                $contactTag = array(
                    'tagType' => $tags['family'],
                    'contactId' => $contactId,
                );

                $this->db->insert('ContactTag', $contactTag);
            }
        } else {
            $array = array(
                'tagType' => $tags['family'],
                'contactId' => $contactId
            );

            $this->db->select('*');
            $this->db->from('ContactTag');
            $this->db->where($array);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                $contactTag = array(
                    'tagType' => $tags['family'],
                    'contactId' => $contactId,
                );

                $this->db->where($contactTag);
                $this->db->delete('ContactTag');
            }
        }
        // Updating contacts family tag - end
    }
}
