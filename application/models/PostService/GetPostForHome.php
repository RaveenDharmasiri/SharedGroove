<?php
class GetPostForHome extends CI_Model {
    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getAllPosts(){
        
    }

    public function getProfilePosts(){
        $this->db->where('user', $this->session->userdata('email'));
        $posts = $this->db->get('posts');
    }
}