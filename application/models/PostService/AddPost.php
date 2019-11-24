<?php
class AddPost extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function postContent($postContent){
        $timestamp = date('Y-m-d H:i:s');
        $data_array = array(
            'postContent' => $postContent,
            'creatorEmail' => $this->session->userdata('email'),
            'postTimeStamp'=> $timestamp,
        );
        $this->db->insert('Post', $data_array);
    }
}