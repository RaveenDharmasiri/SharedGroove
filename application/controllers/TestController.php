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