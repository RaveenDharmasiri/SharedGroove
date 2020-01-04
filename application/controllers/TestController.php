<?php

class TestController extends CI_Controller {

    public function contacts_get()
    {
        $this->load->model('ContactListPageServices/GetContacts');
        $allContacts = $this->GetContacts->getAllContacts();

        var_dump($allContacts);
    }

    public function contact_post()
    {
        $datax = json_decode(file_get_contents('php://input'), true);

        var_dump($datax);

        $name = $datax['name'];
        $email = $datax['email'];
        $telephoneNo = $datax['telephoneNo'];

        // $this->load->model('ContactListPageServices/AddContact');
        // $response = $this->AddContact->addContactDetailsToDB($name, $email, $telephoneNo);


        $data = array (
            'datax' => $datax['name'],
        );
        
        var_dump($data);

        // header('Content-Type:application/json;charset=UTF-8');

        // $this->load->view('todoJSON', $data);

        // echo json_encode($data);
    }

    public function editContact() {

        $response = 'Failed to update the contact';

        // $datax = json_decode(file_get_contents('php://input'), true);

        $contactId = 31;
        $name = 'Anjula Ratnayaka';
        $email = 'anjula@email.com';
        $telephoneNo = 961234564;
        $tags = array(
            'friends'=> 'Friends',
            'work'=> null,
            'family'=>'Family'
        );

        $this->load->model('ContactListPageServices/UpdateContact');
        $response = $this->UpdateContact->editContact($contactId, $name, $email, $telephoneNo, $tags);

        $data = array(
            'response' => $response,
        );

        echo json_encode($data);
    }

}