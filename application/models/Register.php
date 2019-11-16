<?php
class Register extends CI_Model
{

    public function __construct()
    { 
        parent:: __construct();
        $this->load->database();
    }

    public function checkIfEmailAlreadyExists($email) {
        $this->db->where('email', $email);
        $result = $this->db->get('User');
        $emailInstanceCount = $result->num_rows();

        return $emailInstanceCount;
    }

    public function insertUser($firstName, $lastName, $email, $password) {
        $userData = array(
            'firstName'=>$firstName,
            'lastName'=>$lastName,
            'email'=>$email,
            'password'=>$password
        );

        $this->db->insert('User', $userData);    
    }
}
