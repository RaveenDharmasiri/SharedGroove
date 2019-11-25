<?php
include('Follower.php');

// Target aim of this function is to get all the followers of the currently logged in user.
class GetFollowers extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get the emails of the followers of the currently logged in user's.
     */
    public function getUserFollowersEmails()
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('followingUser', $this->session->userdata('email'));
        $query = $this->db->get();

        $userFollowersEmailsArray = array();

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $follower) {
                array_push($userFollowersEmailsArray, $follower->mainUser);
            }

            return $this->getUserFollowersDetails($userFollowersEmailsArray);
        } else {
            return null;
        }

    }

    // This method get the details of the followers by searching them in the User table based on the emails.
    public function getUserFollowersDetails($userFollowersEmailsArray)
    {
        $followersArray = array();
        for ($x = 0; $x < sizeof($userFollowersEmailsArray); $x++) {
            $this->db->select('*');
            $this->db->from('User');
            $this->db->where('email', $userFollowersEmailsArray[$x]);
            $query = $this->db->get();
            // An object is created to represent the followers of the currently logged in user.
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

    // This method will get the emails of all the users that the currently logged in user follows.
    public function getTheFollowingUsersEmails($followersArray)
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $this->session->userdata('email'));
        $query = $this->db->get();

        $followingsArray = $query->result();

        return $this->checkIfTheFollwersAreBeingFollowed($followersArray, $followingsArray);
    }

    // This method will check if the currently logged in user follows his or her followers.
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

    // This method will put all the information into a readable array that will be sent to the view once this method is called
    public function configReturnObject($followersArray)
    {
        $returnArray = array();

        foreach ($followersArray as $follower) {
            $followerDetails = array(
                'userId' => $follower->getUserId(),
                'firstName' => $follower->getFirstName(),
                'lastName' => $follower->getLastName(),
                'email' => $follower->getEmail(),
                'isFollowing' => $follower->getIsFollowing(),
                'profilePicture' => $follower->getProfilePicture()
            );
            array_push($returnArray, $followerDetails);
        }
        return $returnArray;
    }
}
