<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/REST_Valid.php';

class ContactListController extends REST_Controller
{
    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function contacts_get()
    {
        $this->load->model('ContactListPageServices/GetContacts');
        $allContacts = $this->GetContacts->getAllContacts();

        echo json_encode($allContacts);
    }

    public function addContact_post()
    {
        $datax = json_decode(file_get_contents('php://input'), true);

        $name = $datax['name'];
        $email = $datax['email'];
        $telephoneNo = $datax['telephoneNo'];
        $tags = $datax['tags'];


        $this->load->model('ContactListPageServices/AddContact');
        $response = $this->AddContact->addContactDetailsToDB($name, $email, $telephoneNo, $tags);

        $data = array(
            'response' => $response,
        );

        echo json_encode($data);
    }

    public function editContact_post() {
        $datax = json_decode(file_get_contents('php://input'), true);

        $contactId = $datax['contactId'];
        $name = $datax['name'];
        $email = $datax['email'];
        $telephoneNo = $datax['telephoneNo'];
        $tags = $datax['tags'];

        $this->load->model('ContactListPageServices/UpdateContact');
        $response = $this->UpdateContact->editContact($contactId, $name, $email, $telephoneNo, $tags);

        $data = array(
            'response' => $response,
        );

        echo json_encode($data);
    }
}
