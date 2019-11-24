<?php
include('ResultUser.php');
class SearchGenre extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function findUsersBasedOnGenre($genreType)
    {
        $array = array(
            'genreType' => $genreType,
            'userEmail !=' => $this->session->userdata('email'),
        );

        $this->db->select('*');
        $this->db->from('UserGenre');
        $this->db->where($array);
        $query = $this->db->get();

        if (sizeof($query->result()) > 0) {
            $returnArray = $this->getGenreUserEmails($query->result());
            return $returnArray;
        } else {
            return null;
        }
    }

    public function getGenreUserEmails($genreUserArray)
    {
        $arraySize = sizeof($genreUserArray);
        $genreUserEmails = array();

        for ($x = 0; $x < $arraySize; $x++) {
            array_push($genreUserEmails, $genreUserArray[$x]->userEmail);
        }

        return $this->getUserDetails($genreUserEmails);
    }

    public function getUserDetails($genreUserEmails)
    {
        $arraySize = sizeof($genreUserEmails);
        $genreUserDetailArray = array();

        for ($x = 0; $x < $arraySize; $x++) {
            $resultUser = new ResultUser();

            $this->db->select('*');
            $this->db->from('User');
            $this->db->where('email', $genreUserEmails[$x]);
            $query = $this->db->get();
            $resultUser->setUserId($query->row_array()['userId']);
            $resultUser->setFirstName($query->row_array()['firstName']);
            $resultUser->setLastName($query->row_array()['lastName']);
            $resultUser->setProfilePicture($query->row_array()['profilePicture']);
            $resultUser->setEmail($query->row_array()['email']);

            array_push($genreUserDetailArray, $resultUser);
        }

        return $this->getFollowingUsers($genreUserDetailArray);
    }

    public function getFollowingUsers($genreUserDetailArray)
    {
        $followingUsers = array();

        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $this->session->userdata('email'));
        $query = $this->db->get();

        $resultArraySize = sizeof($query->result());

        for ($x = 0; $x < $resultArraySize; $x++) {
            array_push($followingUsers, $query->result()[$x]->followingUser);
        }

        return $this->setFollowingUsers($followingUsers, $genreUserDetailArray);
    }

    public function setFollowingUsers($followingUsers, $genreUserDetailArray)
    {
        $genreUserDetailArraySize = sizeof($genreUserDetailArray);
        $followingUsersSize = sizeof($followingUsers);

        for ($x = 0; $x < $genreUserDetailArraySize; $x++) {
            for ($y = 0; $y < $followingUsersSize; $y++) {
                if ($genreUserDetailArray[$x]->getEmail() == $followingUsers[$y]) {
                    $genreUserDetailArray[$x]->setIsFollowing(true);
                }
            }
        }

        return $this->getAllFollowers($genreUserDetailArray);
    }

    public function getAllFollowers($genreUserDetailArray) {
        $followers = array();
        $this->db->select('mainUser');
        $this->db->from('UserFollowing');
        $this->db->where('followingUser', $this->session->userdata('email'));
        $query = $this->db->get();

        foreach($query->result() as $follower){
            array_push($followers, $follower->mainUser);
        }

        return $this->findTheFriends($followers, $genreUserDetailArray);
    }

    public function findTheFriends($followers, $genreUserDetailArray) {
        $genreUserDetailArraySize = sizeof($genreUserDetailArray);
        $followersSize = sizeof($followers);

        for ($x = 0; $x < $genreUserDetailArraySize; $x++) {
            for ($y = 0; $y < $followersSize; $y++) {
                if ($genreUserDetailArray[$x]->getEmail() == $followers[$y] && $genreUserDetailArray[$x]->getIsFollowing()) {
                    $genreUserDetailArray[$x]->setIsFriend(true);
                }
            }
        }

        return $this->configTheReturnObject($genreUserDetailArray);
    }

    public function configTheReturnObject($genreUserDetailArray)
    {
        $genreUserDetailArraySize = sizeof($genreUserDetailArray);

        $returnArray = array();

        for ($x = 0; $x < $genreUserDetailArraySize; $x++) {
            $genreUserDetails = array(
                'userId' => $genreUserDetailArray[$x]->getUserId(),
                'firstName' => $genreUserDetailArray[$x]->getFirstName(),
                'lastName' => $genreUserDetailArray[$x]->getLastName(),
                'profilePicture' => $genreUserDetailArray[$x]->getProfilePicture(),
                'isFollowing' => $genreUserDetailArray[$x]->getIsFollowing(),
                'email' => $genreUserDetailArray[$x]->getEmail(),
                'isFriend'=>$genreUserDetailArray[$x]->getIsFriend(),
            );

            array_push($returnArray, $genreUserDetails);
        }

        return $returnArray;
    }
}
