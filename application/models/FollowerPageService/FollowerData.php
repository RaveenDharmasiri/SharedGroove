<?php
include('Follower.php');
class FollowerData extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUserFollowers()
    {
        return $this->getUserFollowersEmails();
    }

    public function getUserFollowersEmails()
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('followingUser', $this->session->userdata('email'));
        $query = $this->db->get();

        $userFollowersEmailsArray = array();

        foreach ($query->result() as $follower) {
            array_push($userFollowersEmailsArray, $follower->mainUser);
        }

        return $this->getFollowersDetails($userFollowersEmailsArray);
    }

    public function getFollowersDetails($userFollowersEmailsArray)
    {
        $followersArray = array();
        for ($x = 0; $x < sizeof($userFollowersEmailsArray); $x++) {
            $this->db->select('*');
            $this->db->from('User');
            $this->db->where('email', $userFollowersEmailsArray[$x]);
            $query = $this->db->get();
            $follower = new Follower();
            $follower->setUserId($query->row_array()['userId']);
            $follower->setFirstName($query->row_array()['firstName']);
            $follower->setLastName($query->row_array()['lastName']);
            $follower->setEmail($query->row_array()['email']);
            $follower->setProfilePicture($query->row_array()['profilePicture']);
            array_push($followersArray, $follower);
        }

        return $this->getTheFollowingUsersEmails($followersArray);
    }

    public function getTheFollowingUsersEmails($followersArray)
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $this->session->userdata('email'));
        $query = $this->db->get();

        $followingsArray = $query->result();

        return $this->checkIfTheFollwersAreBeingFollowed($followersArray, $followingsArray);
    }

    public function checkIfTheFollwersAreBeingFollowed($followersArray, $followingsArray)
    {
        foreach ($followersArray as $follower) {
            foreach ($followingsArray as $following) {
                if ($follower->getEmail() == $following->followingUser) {
                    $follower->setIsFollowing(true);
                }
            }
        }

        return $this->configReturnObject($followersArray);
    }

    public function configReturnObject($followersArray){
        $returnArray = array();

        foreach($followersArray as $follower) {
            $followerDetails = array (
                'userId'=>$follower->getUserId(),
                'firstName'=>$follower->getFirstName(),
                'lastName'=>$follower->getLastName(),
                'email'=>$follower->getEmail(),
                'isFollowing'=>$follower->getIsFollowing(),
                'profilePicture'=>$follower->getProfilePicture()
            );
            array_push($returnArray, $followerDetails);
        }
        return $returnArray;
    }
}
