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

        return $this->getTheEmailsOfTheFollowingUser($query->result());
    }

    private function getTheEmailsOfTheFollowingUser($followingUserObjects) {
        $followingUserEmails = array();

        foreach($followingUserObjects as $followingUser) {
            array_push($followingUserEmails, $followingUser->followingUser);
        }

        return $this->getFollowingUserDetails($followingUserEmails);
    }

    private function getFollowingUserDetails($followingUserEmails) {
        $followingUserObjectArray = array();
        for($x=0; $x<sizeof($followingUserEmails); $x++) {
            $this->db->select('*');
            $this->db->from('User');
            $this->db->where('email', $followingUserEmails[$x]);
            $query = $this->db->get();

            $followingUser = new FollowingUser();

            $followingUser->setUserId($query->row_array()['userId']);
            $followingUser->setFirstName($query->row_array()['firstName']);
            $followingUser->setLastName($query->row_array()['lastName']);
            $followingUser->setProfilePicture($query->row_array()['profilePicture']);
            $followingUser->setEmail($query->row_array()['email']);

            array_push($followingUserObjectArray, $followingUser);
        }

        return $this->checkIfFriends($followingUserObjectArray);
    }

    private function checkIfFriends($followingUserObjectArray) {
        foreach($followingUserObjectArray as $followingUser){
            $this->db->select('mainUser');
            $this->db->from('UserFollowing');
            $conditionArray = array(
                'mainUser'=>$followingUser->getEmail(),
                'followingUser'=>$this->session->userdata('email'),
            );
            $this->db->where($conditionArray);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $followingUser->setIsFriend(true);
            }
        }

        return $this->configReturnObject($followingUserObjectArray);
    }

    private function configReturnObject($followingUserObjectArray) {

        $returnObject = array();
        foreach($followingUserObjectArray as $followingUser) {
            $followingUserDetails = array(
                'userId'=>$followingUser->getUserId(),
                'firstName'=>$followingUser->getFirstName(),
                'lastName'=>$followingUser->getLastName(),
                'email'=>$followingUser->getEmail(),
                'profilePicture'=>$followingUser->getProfilePicture(),
                'isFriend'=>$followingUser->getIsFriend(),
            );

            array_push($returnObject, $followingUserDetails);
        }

        return $returnObject;
    }
}