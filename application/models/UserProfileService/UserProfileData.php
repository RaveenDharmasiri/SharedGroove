<?php
include('User.php');
class UserProfileData extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUserProfileData($userId)
    {
        return $this->getUserDetails($userId);
    }

    public function getUserDetails($userId)
    {
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('userId', $userId);
        $query = $this->db->get();

        $user = new User();
        $user->setUserId($query->row_array()['userId']);
        $user->setFirstName($query->row_array()['firstName']);
        $user->setLastName($query->row_array()['lastName']);
        $user->setEmail($query->row_array()['email']);
        $user->setProfilePicture($query->row_array()['profilePicture']);

        return $this->getUserFollowerCount($user);
    }

    private function getUserFollowerCount($user)
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('followingUser', $user->getEmail());
        $query = $this->db->get();

        $user->setFollowerCount($query->num_rows());

        return $this->getUserFollowingCount($user);
    }

    public function getUserFollowingCount($user)
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $user->getEmail());
        $query = $this->db->get();
        $user->setFollowingCount($query->num_rows());

        return $this->getUserGenres($user);
    }

    public function getUserGenres($user)
    {
        $this->db->select('genreType');
        $this->db->from('UserGenre');
        $this->db->where('userEmail', $user->getEmail());
        $query = $this->db->get();

        $userGenres = array();

        foreach ($query->result() as $genre) {
             array_push($userGenres, $genre->genreType);
        }

        $user->setUserGenres($userGenres);

        return $this->configReturnObject($user);
    }

    public function configReturnObject($user){
        $returnArray = array(
            'userId'=>$user->getUserId(),
            'firstName'=>$user->getFirstName(),
            'lastName'=>$user->getLastName(),
            'email'=>$user->getEmail(),
            'profilePicture'=>$user->getProfilePicture(),
            'followerCount'=>$user->getFollowerCount(),
            'followingCount'=>$user->getFollowingCount(),
            'userGenres'=>$user->getUserGenres(),
        );

        return $returnArray;
    }
}
