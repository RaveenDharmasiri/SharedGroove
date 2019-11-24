<?php
include('User.php');
include('Post.php');
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

    public function getUserFollowerCount($user)
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

        return $this->isMainUserFollowing($user);
    }

    public function isMainUserFollowing($user) {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $condition = array(
            'mainUser'=>$this->session->userdata('email'),
            'followingUser'=>$user->getEmail(),
        );
        $this->db->where($condition);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $user->setIsFollowing(true);
        }

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

    public function getFollowingEmails($user, $followerEmails)
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

    public function getTheFriends($user, $followerEmails, $followingEmails)
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

        return $this->checkIfTheUserIsAFriend($user, $friendsEmails);
    }
    //End

    public function checkIfTheUserIsAFriend($user) {
        $this->db->select('followingUser');
        $this->db->from('UserFollowing');
        $conditionArray = array (
            'mainUser'=>$this->session->userdata('email'),
            'followingUser'=>$user->getEmail(),
        );
        $this->db->where($conditionArray);
        $query = $this->db->get();
        $isFollowing = $query->num_rows();

        $this->db->select('mainUser');
        $this->db->from('UserFollowing');
        $conditionArray = array (
            'mainUser'=>$user->getEmail(),
            'followingUser'=>$this->session->userdata('email'),
        );
        $this->db->where($conditionArray);
        $query = $this->db->get();
        $isAFollower = $query->num_rows();

        if ($isFollowing > 0 && $isAFollower > 0) {
            $user->setIsFriend(true);
        }

        return $this->getUserPosts($user);
    }

    public function getUserPosts($user) {
        $this->db->select('*');
        $this->db->from('Post');
        $this->db->where('creatorEmail', $user->getEmail());
        $query = $this->db->get();

        $allUserRelatedPostResults = $query->result();

        $userPosts = array();

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

                array_push($userPosts, $postObj);
            }
            return $this->configHomePostArray($userPosts, $user);
        } else {
            return $this->configReturnObject($userPosts, $user);
        }
    }

    private function configHomePostArray($userPosts, $user)
    {
        $userPostArray = array();
        arsort($userPosts);
        foreach ($userPosts as $userPost) {
            $userPostDetails = array(
                'postId' => $userPost->getPostId(),
                'postContent' => $userPost->getPostContent(),
                'creatorEmail' => $userPost->getCreatorEmail(),
                'postTimeStamp' => $userPost->getPostTimestamp(),
                'creatorId' => $userPost->getCreatorId(),
                'creatorFirstName' => $userPost->getCreatorFirstName(),
                'creatorLastName' => $userPost->getCreatorLastName(),
                'creatorProfilePicture' => $userPost->getCreatorProfilePicture(),
            );

            array_push($userPostArray, $userPostDetails);
        }

        return $this->configReturnObject($userPostArray, $user);
    }

    public function configReturnObject($userPosts, $user)
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
            'friendsCount'=>$user->getFriendCount(),
            'isFollowing'=>$user->getIsFollowing(),
            'isFriend'=>$user->getIsFriend(),
            'userPosts'=>$userPosts,
        );

        return $returnArray;
    }
}
