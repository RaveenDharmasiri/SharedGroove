<?php
class AddPost extends CI_Model{
    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function postMessage($postMessage){
        $timestamp = date('Y-m-d H:i:s');
        $data_array = array(
            'postContent' => $postMessage,
            'creatorEmail' => $this->session->userdata('email'),
            'postTimeStamp'=> $timestamp,
        );
        $this->db->insert('post',$data_array);
    }

}