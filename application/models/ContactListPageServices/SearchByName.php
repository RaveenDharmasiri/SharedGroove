<?php
include('Contact.php');
class SearchByName extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getContactIds($name)
    {
        $this->db->select('*');
        $this->db->from('Contact');
        $this->db->where('contactName', $name);
        $contactQuery = $this->db->get();

        $contactList = array();

        if ($contactQuery->num_rows() > 0) {

            foreach ($contactQuery->result() as $contact) {
                $contactObj = new Contact();

                $contactObj->setContactId($contact->contactId);
                $contactObj->setName($contact->contactName);
                $contactObj->setEmail($contact->contactEmail);
                $contactObj->setTelephoneNo($contact->contactTelephoneNo);
                $contactTags =  $this->getContactTags($contact->contactId);
                $contactObj->setTags($contactTags);

                array_push($contactList, $contactObj);
            }
            return $this->configReturnObject($contactList);
        } else {
            return null;
        }
    }

    public function getContactTags($contactId)
    {
        $contactTags = array();
        $this->db->select('*');
        $this->db->from('ContactTag');
        $this->db->where('contactId', $contactId);

        $query = $this->db->get();

        foreach ($query->result() as $contactTag) {
            array_push($contactTags, $contactTag->tagType);
        }

        return $contactTags;
    }

    public function configReturnObject($contactList)
    {
        $contactArray = array();
        foreach ($contactList as $contactObj) {
            $contactDetails = array(
                'contactId' => $contactObj->getContactId(),
                'contactName' => $contactObj->getName(),
                'contactEmail' => $contactObj->getEmail(),
                'contactTelephoneNo' => $contactObj->getTelephoneNo(),
                'contactTags' => $contactObj->getTags()
            );

            array_push($contactArray, $contactDetails);
        }

        $returnArray = array(
            'contacts' => $contactArray,
        );

        return $returnArray;
    }
}
