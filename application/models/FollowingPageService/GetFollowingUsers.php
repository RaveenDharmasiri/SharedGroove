<?php
include('FollowingUser.php');
class GetFollowingUsers extends CI_Model {
    public function __construct()
    {
        parent:: __construct();
        $this->load->database();
    }

    public function getFollowingUserData() {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $this->session->userdata('email'));
        $query = $this->db->get();

        var_dump($query->result());

        $this->getTheEmailsOfTheFollowingUser($query->result());
    }

    public function getTheEmailsOfTheFollowingUser($followingUserObjects) {
        $followingUserEmails = array();

        
    }
}