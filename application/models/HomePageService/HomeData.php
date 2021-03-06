<?php
include('User.php');
include('Post.php');
// Main purpose of this function is to sent all the user related data to the frontend when they visit theie home page.
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

    // This information get the details of the currently logged in user from the User table based on their email saved in the session.
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

    // This function get the followers of the logged in user and then count them which will give the followers count.
    private function getUserFollowerCount($user)
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('followingUser', $this->session->userdata('email'));
        $query = $this->db->get();

        $user->setFollowerCount($query->num_rows());

        return $this->getUserFollowingCount($user);
    }

    // This function get the emails of the users followed by the logged in user. Then get the count for the count of the followers.
    public function getUserFollowingCount($user)
    {
        $this->db->select('*');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $this->session->userdata('email'));
        $query = $this->db->get();
        $user->setFollowingCount($query->num_rows());

        return $this->getUserGenres($user);
    }

    // This function get the genres selected by the logged in user. Email saved inthe session will be searched in the UserGenre table to look for all the egnres selected by the logged in user.
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

        return $this->getFollowersEmails($user);
    }

    //Friends Count - Start - This function get the count of the friend
    public function getFollowersEmails($user)
    {
        $followerEmails = array();
        $this->db->select('mainUser');
        $this->db->from('UserFollowing');
        $this->db->where('followingUser', $this->session->userdata('email'));
        $query = $this->db->get();

        foreach ($query->result() as $follower) {
            array_push($followerEmails, $follower->mainUser);
        }

        return $this->getFollowingEmails($user, $followerEmails);
    }

    // First will get the emails of the users followed by the logged in user. 
    private function getFollowingEmails($user, $followerEmails)
    {
        $followingEmails = array();
        $this->db->select('followingUser');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $this->session->userdata('email'));
        $query = $this->db->get();

        foreach ($query->result() as $following) {
            array_push($followingEmails, $following->followingUser);
        }

        return $this->getTheFriends($user, $followerEmails, $followingEmails);
    }

    // Then compare the follower emails with the emails of the users followed by the logged user. The count of the user emails belonging to both the arrays is the friends count.
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

    // This get the posts shared by the logged user.
    private function getUserPosts($user)
    {
        $this->db->select('*');
        $this->db->from('Post');
        $this->db->where('creatorEmail', $this->session->userdata('email'));
        $query = $this->db->get();

        $allUserRelatedPostResults = $query->result();

        $homePosts = array();

        if ($query->num_rows() > 0) {
            foreach ($allUserRelatedPostResults as $post) {
                $postObj = new Post();
                // Each post result is represented by a Post object
                $postObj->setPostId($post->postId);
                $postObj->setPostContent($post->postContent);
                $postObj->setCreatorEmail($post->creatorEmail);
                $postObj->setPostTimeStamp($post->postTimestamp);
                $postObj->setCreatorId($user->getUserId());
                $postObj->setCreatorFirstName($user->getFirstName());
                $postObj->setCreatorLastName($user->getLastName());
                $postObj->setCreatorProfilePicture($user->getProfilePicture());

                array_push($homePosts, $postObj);
            }
        }

        return $this->getFollowingUserEmails($homePosts, $user);
    }

    // Get the posts of the users followed by the currently logged in user - START
    private function getFollowingUserEmails($homePosts, $user)
    {
        $followingEmails = array();
        $this->db->select('followingUser');
        $this->db->from('UserFollowing');
        $this->db->where('mainUser', $this->session->userdata('email'));
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $followingEmails = $query->result();
            return $this->getFollowingUserPosts($homePosts, $user, $followingEmails);
        } else {
            return $this->configHomePostArray($homePosts, $user);
        }
    }

    private function getFollowingUserPosts($homePosts, $user, $followingEmails)
    {
        foreach ($followingEmails as $following) {
            $this->db->select('*');
            $this->db->from('Post');
            $this->db->where('creatorEmail', $following->followingUser);
            $postQuery = $this->db->get();

            if ($postQuery->num_rows() > 0) {
                $this->db->select('*');
                $this->db->from('User');
                $this->db->where('email', $following->followingUser);
                $followingUserQuery = $this->db->get();

                $userDetails = $followingUserQuery->row_array();

                foreach ($postQuery->result() as $post) {
                    $postObj = new Post();
                    $postObj->setPostId($post->postId);
                    $postObj->setPostContent($post->postContent);
                    $postObj->setCreatorEmail($post->creatorEmail);
                    $postObj->setPostTimeStamp($post->postTimestamp);
                    $postObj->setCreatorId($userDetails['userId']);
                    $postObj->setCreatorFirstName($userDetails['firstName']);
                    $postObj->setCreatorLastName($userDetails['lastName']);
                    $postObj->setCreatorProfilePicture($userDetails['profilePicture']);

                    array_push($homePosts, $postObj);
                }
            }
        }

        return $this->configHomePostArray($homePosts, $user);
    }

    private function configHomePostArray($homePosts, $user)
    {
        if (sizeof($homePosts) > 0) {
            arsort($homePosts);
            $homePostArray = array();
            foreach ($homePosts as $homePost) {
                $homePostDetails = array(
                    'postId'=>$homePost->getPostId(),
                    'postContent' => $homePost->getPostContent(),
                    'creatorEmail' => $homePost->getCreatorEmail(),
                    'postTimeStamp' => $homePost->getPostTimestamp(),
                    'creatorId' => $homePost->getCreatorId(),
                    'creatorFirstName' => $homePost->getCreatorFirstName(),
                    'creatorLastName' => $homePost->getCreatorLastName(),
                    'creatorProfilePicture' => $homePost->getCreatorProfilePicture(),
                );

                array_push($homePostArray, $homePostDetails);
            }
            return $this->configReturnObject($homePostArray, $user);
        } else {
            return $this->configReturnObject($homePosts, $user);
        }
    }
    //END

    private function configReturnObject($homePosts, $user)
    {
        $returnArray = array(
            'userId' => $user->getUserId(),
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'profilePicture' => $user->getProfilePicture(),
            'followerCount' => $user->getFollowerCount(),
            'followingCount' => $user->getFollowingCount(),
            'userGenres' => $user->getUserGenres(),
            'friendsCount' => $user->getFriendCount(),
            'homePosts' => $homePosts,
        );

        return $returnArray;
    }
}
