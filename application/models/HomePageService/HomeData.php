<?php
include('User.php');
class HomeData extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getHomeInformation()
    {
        return $this->getUserDetails();
    }

    public function getUserDetails()
    {
        $this->db->select('*');
        $this->db->from('User');
        $this->db->where('email', $this->session->userdata('email'));
        $query = $this->db->get();

        $user = new User();

        $user->setUserId($query->row_array()['userId']);
        $user->setFirstName($query->row_array()['firstName']);
        $user->setLastName($query->row_array()['lastName']);
        $user->setProfilePicture($query->row_array()['profilePicture']);

        return $this->getUserFollowerCount($user);
    }

    private function getUserFollowerCount($user)
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('followingUser', $this->session->userdata('email'));
        $query = $this->db->get();

        $user->setFollowerCount($query->num_rows());

        return $this->getUserFollowingCount($user);
    }

    public function getUserFollowingCount($user)
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $this->session->userdata('email'));
        $query = $this->db->get();
        $user->setFollowingCount($query->num_rows());

        return $this->getUserGenres($user);
    }

    public function getUserGenres($user)
    {
        $this->db->select('genreType');
        $this->db->from('UserGenre');
        $this->db->where('userEmail', $this->session->userdata('email'));
        $query = $this->db->get();

        $userGenres = array();

        foreach ($query->result() as $genre) {
            array_push($userGenres, $genre->genreType);
        }

        $user->setUserGenres($userGenres);

        return $this->configReturnObject($user);
    }

    public function configReturnObject($user)
    {
        $returnArray = array(
            'userId' => $user->getUserId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'profilePicture' => $user->getProfilePicture(),
            'followerCount' => $user->getFollowerCount(),
            'followingCount' => $user->getFollowingCount(),
            'userGenres' => $user->getUserGenres(),
        );

        return $returnArray;
    }
}
