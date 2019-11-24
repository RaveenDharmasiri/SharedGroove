<?php
include('User.php');
include('Post.php');
class YourProfileData extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUserProfileData()
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

        return $this->getFollowersEmails($user);
    }

    //Friends Count - Start
    public function getFollowersEmails($user)
    {
        $followerEmails = array();
        $this->db->select('mainUser');
        $this->db->from('UserFollowing');
        $this->db->where('followingUser', $user->getEmail());
        $query = $this->db->get();

        foreach ($query->result() as $follower) {
            array_push($followerEmails, $follower->mainUser);
        }

        return $this->getFollowingEmails($user, $followerEmails);
    }

    private function getFollowingEmails($user, $followerEmails)
    {
        $followingEmails = array();
        $this->db->select('followingUser');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $user->getEmail());
        $query = $this->db->get();

        foreach ($query->result() as $following) {
            array_push($followingEmails, $following->followingUser);
        }

        return $this->getTheFriends($user, $followerEmails, $followingEmails);
    }

    private function getTheFriends($user, $followerEmails, $followingEmails)
    {
        $friendsEmails = array();
        for ($x = 0; $x < sizeof($followerEmails); $x++) {
            for ($y = 0; $y < sizeof($followingEmails); $y++) {
                if ($followerEmails[$x] == $followingEmails[$y]) {
                    array_push($friendsEmails, $followingEmails[$y]);
                }
            }
        }

        $user->setFriendCount(sizeof($friendsEmails));

        return $this->getUserPosts($user);
    }
    //End

    private function getUserPosts($user)
    {
        $this->db->select('*');
        $this->db->from('Post');
        $this->db->where('creatorEmail', $this->session->userdata('email'));
        $query = $this->db->get();

        $allUserRelatedPostResults = $query->result();

        $yourPosts = array();

        if ($query->num_rows() > 0) {
            foreach ($allUserRelatedPostResults as $post) {
                $postObj = new Post();
                $postObj->setPostId($post->postId);
                $postObj->setPostContent($post->postContent);
                $postObj->setCreatorEmail($post->creatorEmail);
                $postObj->setPostTimeStamp($post->postTimestamp);
                $postObj->setCreatorId($user->getUserId());
                $postObj->setCreatorFirstName($user->getFirstName());
                $postObj->setCreatorLastName($user->getLastName());
                $postObj->setCreatorProfilePicture($user->getProfilePicture());

                array_push($yourPosts, $postObj);
            }
            return $this->configHomePostArray($yourPosts, $user);
        } else {
            return $this->configReturnObject($yourPosts, $user);
        }
    }

    private function configHomePostArray($yourPosts, $user)
    {
        $yourPostArray = array();
        arsort($yourPosts);
        foreach ($yourPosts as $yourPost) {
            $yourPostDetails = array(
                'postId' => $yourPost->getPostId(),
                'postContent' => $yourPost->getPostContent(),
                'creatorEmail' => $yourPost->getCreatorEmail(),
                'postTimeStamp' => $yourPost->getPostTimestamp(),
                'creatorId' => $yourPost->getCreatorId(),
                'creatorFirstName' => $yourPost->getCreatorFirstName(),
                'creatorLastName' => $yourPost->getCreatorLastName(),
                'creatorProfilePicture' => $yourPost->getCreatorProfilePicture(),
            );

            array_push($yourPostArray, $yourPostDetails);
        }

        return $this->configReturnObject($yourPostArray, $user);
    }

    public function configReturnObject($yourPosts, $user)
    {
        $returnArray = array(
            'userId' => $user->getUserId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'profilePicture' => $user->getProfilePicture(),
            'followerCount' => $user->getFollowerCount(),
            'followingCount' => $user->getFollowingCount(),
            'userGenres' => $user->getUserGenres(),
            'friendsCount' => $user->getFriendCount(),
            'yourPosts'=>$yourPosts,
        );

        return $returnArray;
    }
}
