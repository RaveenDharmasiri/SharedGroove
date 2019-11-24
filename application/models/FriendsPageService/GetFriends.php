<?php
include('Friend.php');
class GetFriends extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getFollowingEmails()
    {
        $followingEmails = array();
        $this->db->select('followingUser');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $this->session->userdata('email'));
        $query = $this->db->get();

        if ($query->num_rows() > 0){
            foreach ($query->result() as $following) {
                array_push($followingEmails, $following->followingUser);
            }
    
            return $this->getFollowersEmails($followingEmails);
        } else {
            return null;
        }
    }

    private function getFollowersEmails($followingEmails)
    {
        $followerEmails = array();
        $this->db->select('mainUser');
        $this->db->from('UserFollowing');
        $this->db->where('followingUser', $this->session->userdata('email'));
        $query = $this->db->get();

        foreach ($query->result() as $follower) {
            array_push($followerEmails, $follower->mainUser);
        }

        return $this->getTheFriends($followerEmails, $followingEmails);
    }

    private function getTheFriends($followerEmails, $followingEmails)
    {
        $friendsEmails = array();
        for ($x = 0; $x < sizeof($followerEmails); $x++) {
            for ($y = 0; $y < sizeof($followingEmails); $y++) {
                if ($followerEmails[$x] == $followingEmails[$y]) {
                    array_push($friendsEmails, $followingEmails[$y]);
                }
            }
        }

        return $this->getFriendsDetails($friendsEmails);
    }

    public function getFriendsDetails($friendsEmails)
    {
        $friendsObjectArray = array();
        for ($x = 0; $x < sizeof($friendsEmails); $x++) {
            $this->db->select('*');
            $this->db->from('User');
            $this->db->where('email', $friendsEmails[$x]);
            $query = $this->db->get();

            $friend = new Friend();

            $friend->setUserId($query->row_array()['userId']);
            $friend->setFirstName($query->row_array()['firstName']);
            $friend->setLastName(($query->row_array()['lastName']));
            $friend->setEmail($query->row_array()['email']);
            $friend->setProfilePicture($query->row_array()['profilePicture']);

            array_push($friendsObjectArray, $friend);
        }

        return $this->configReturnObject($friendsObjectArray);
    }

    public function configReturnObject($friendsObjectArray)
    {
        $returnObject = array();

        foreach ($friendsObjectArray as $friend) {
            $friendObject = array(
                'userId' => $friend->getUserId(),
                'firstName' => $friend->getFirstName(),
                'lastName' => $friend->getLastName(),
                'email' => $friend->getEmail(),
                'profilePicture' => $friend->getProfilePicture()
            );

            array_push($returnObject, $friendObject);
        }

        return $returnObject;
    }
}
