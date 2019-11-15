<?php

class UserManagementController extends CI_Controller
{
    public function index()
    {
        $this->load->view('properties/register');
    }

    public function insertUser()
    {
        $firstName  = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->load->model('Register');
        $emailInstanceCount = $this->Register->checkIfEmailAlreadyExists($email);
        if ($emailInstanceCount > 0) {
            $returnData = array(
                'errorMessage' => 'Email Already Exists',
            );
            $this->load->view('properties/register', $returnData);
        } else {
            $this->Register->insertUser($firstName, $lastName, $email, $password);
        }
    }
}
