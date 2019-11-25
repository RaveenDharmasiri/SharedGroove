<?php
include('Friend.php');
// Main functionality of this function is to find the friends of the logged in user.
class GetFriends extends CI_model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // First get the emails of the users followed by the logged in the user.
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

    // Get the emails of the followers of the logged in user.
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

    /**
     * Compare the follower emails and the following emails to see which email is common to both the array.
     * If an email is common to both the array that means the user who owns that email is a friend of the logged in user.
     */
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

    // Get the details of the friends from the Users array based on the emails
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

    // This function is used to send all the gathered information to the view.
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
