<?php

class Login extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function checkIfEmailAlreadyExists($email, $password)
    {
        $array = array(
            'email' => $email,
        );
        $this->db->where($array);
        $query = $this->db->get('User');

        $dbPassword = $query->row_array()['password'];

        if(password_verify($password,$dbPassword)) {
            return true;
        } else {
            return false;
        }

        // $emailInstanceCount = $query->num_rows();

        // return $emailInstanceCount;
    }

    public function getUserDetails($email, $password)
    {
        $array = array(
            'email' => $email,
            'password' => $password
        );

        $this->db->select("*");
        $this->db->from("User");
        $this->db->where($array);
        $query = $this->db->get();

        $returnArray = array(
            'firstName'=>$query->row_array()["firstName"],
            'lastName'=>$query->row_array()["lastName"],
            'profilePicture'=>$query->row_array()["profilePicture"],
        );

        return $returnArray;
    }
}
