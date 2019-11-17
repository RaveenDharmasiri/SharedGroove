<?php

class Login extends CI_Model {

    public function __construct( )
    {
        parent:: __construct();
        $this->load->database();
    }

    public function checkIfEmailAlreadyExists($email, $password) {
        $array = array (
            'email'=>$email,
            'password'=>$password
        );
        $this->db->where($array);
        $result = $this->db->get('User');

        $emailInstanceCount = $result->num_rows();

        return $emailInstanceCount;
    }

}