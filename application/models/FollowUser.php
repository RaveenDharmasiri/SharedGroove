<?php
class FollowUser extends CI_Model {
    public function __construct() {
        parent:: __construct();
        $this->load->database();
    }

    public function getEmailOfFollowingUser($userId) {
        $this->db->select('email');
        $this->db->from('User');
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        $email = $query->row_array()['email'];
        return $this->followTheUser($email);
    }

    public function followTheUser($email) {
        $data_array = array(
            'mainUser' => $this->session->userdata('email'),
            'followingUser'=>$email,
        );
        $this->db->insert('UserFollowing',$data_array);
    }
}