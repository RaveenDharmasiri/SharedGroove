<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class ContactListController extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get()
    {
        $this->load->view('properties/contactList');
    }

    public function contacts_get()
    {
        $this->load->model('ContactListPageServices/GetContacts');
        $allContacts = $this->GetContacts->getAllContacts();

        $surname = array (
            'surname' => $allContacts,
        );

        echo json_encode($surname);
    }

    public function contact_post()
    {
        $firstName = $this->input->post('firstName');
        $surname = $this->input->post('surname');
        $email = $this->input->post('email');
        $telephoneNo = $this->input->post('telephoneNo');

        $this->load->model('ContactListPageServices/AddContact');
        $this->AddContact->addContactDetailsToDB($firstName, $surname, $email, $telephoneNo);


        // $data = array(
        //     'firstName' => $firstName,
        //     'lastName' => $lastName,
        //     'email' => $email,
        //     'telephoneNo' => $telephoneNo
        // );
        // echo json_encode($data);
    }
}
