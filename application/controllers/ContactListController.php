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

    public function contact_post()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $telephoneNo = $this->input->post('telephoneNo');

        $this->load->model('ContactListPageServices/AddContact');
        $response = $this->AddContact->addContactDetailsToDB($name, $email, $telephoneNo);

        $data = array (
            'response' => $response,
        );

        echo json_encode($data);

        // $data = array(
        //     'firstName' => $firstName,
        //     'lastName' => $lastName,
        //     'email' => $email,
        //     'telephoneNo' => $telephoneNo
        // );
        // echo json_encode($data);
    }
}
