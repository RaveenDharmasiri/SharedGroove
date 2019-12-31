<?php
include('Contact.php');
class GetContacts extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getAllContacts()
    {
        $this->db->select('*');
        $this->db->from('Contact');

        $contactQuery = $this->db->get();

        $contactList = array();

        if ($contactQuery->num_rows() > 0) {
            foreach ($contactQuery->result() as $contact) {
                $contactObj = new Contact();

                $contactObj->setContactId($contact->contactId);
                $contactObj->setName($contact->contactName);
                $contactObj->setEmail($contact->contactEmail);
                $contactObj->setTelephoneNo($contact->contactTelephoneNo);

                array_push($contactList, $contactObj);
            }
            return $this->configReturnObject($contactList);
        } else {
            return null;
        }   
    }

    public function configReturnObject($contactList) {
        $contactArray = array();
        foreach($contactList as $contactObj) {
            $contactDetails = array (
                'contactId' => $contactObj->getContactId(),
                'contactName' => $contactObj->getName(),
                'contactEmail' => $contactObj->getEmail(),
                'contactTelephoneNo' => $contactObj->getTelephoneNo(),
            );

            array_push($contactArray, $contactDetails);
        }

        $returnArray = array(
            'contacts' => $contactArray,
        );

        return $returnArray;
    }
}
