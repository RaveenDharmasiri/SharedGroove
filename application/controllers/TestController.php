<?php

class TestController extends CI_Controller {

    public function contacts_get()
    {
        $this->load->model('ContactListPageServices/GetContacts');
        $allContacts = $this->GetContacts->getAllContacts();

        var_dump($allContacts);
    }

    public function addContact()
    {
        $datax = json_decode(file_get_contents('php://input'), true);


        $name = "sdfsdfsdf";
        $email = "dfsdf@gmail.com";
        $telephoneNo = 6786785684;
        $tags = array(
            'friends'=> "Friends", 'work' =>null, 'family'=> null
        );

        $this->load->model('ContactListPageServices/AddContact');
        $response = $this->AddContact->addContactDetailsToDB($name, $email, $telephoneNo, $tags);


        $data = array (
            'datax' => $response,
        );
        
        var_dump($data);

        // header('Content-Type:application/json;charset=UTF-8');

        // $this->load->view('todoJSON', $data);

        // echo json_encode($data);
    }

    public function editContact() {

        $response = 'Failed to update the contact';

        // $datax = json_decode(file_get_contents('php://input'), true);

        $contactId = 29;
        $name = 'Raveen Dharmasiri';
        $email = 'raveen.dharmasiri@gmail.com';
        $telephoneNo = 711090637;
        $tags = array(
            'friends'=> null,
            'work'=> 'Work',
            'family'=>null
        );

        $this->load->model('ContactListPageServices/UpdateContact');
        $response = $this->UpdateContact->editContact($contactId, $name, $email, $telephoneNo, $tags);

        $data = array(
            'response' => $response,
        );

        var_dump($data);

        // echo json_encode($data);
    }

    public function deleteContact() {
        // $datax = json_decode(file_get_contents('php://input'), true);

        $contactId = 41;

        $this->load->model('ContactListPageServices/DeleteContact');
        $response = $this->DeleteContact->removeContact($contactId);

        $data = array(
            'response' => $response,
        );

        echo json_encode($data);

    } 

}