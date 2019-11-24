<?php
class HomeManagementController extends CI_Controller
{

    public function sendingToYourProfilePage()
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('YourProfileService/YourProfileData');
            $userProfileData = $this->YourProfileData->getUserProfileData();
            $this->load->view('properties/yourProfile', $userProfileData);
            var_dump($userProfileData);
        }
    }

    public function sendingToFollowersPage()
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('FollowerPageService/GetFollowers');
            $userFollowers = $this->GetFollowers->getUserFollowersEmails();
            $returnArray = array(
                'userFollowers' => $userFollowers
            );
            var_dump($returnArray);
            $this->load->view('properties/followers', $returnArray);
        }
    }

    public function sendingToFollowingPage()
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('FollowingPageService/GetFollowingUsers');
            $followingUserResults = $this->GetFollowingUsers->getFollowingUserData();
            $returnArray = array(
                'followingUserResults' => $followingUserResults,
            );
            $this->load->view('properties/following', $returnArray);
            var_dump($returnArray);
        }
    }

    public function sendingToFriendsPage()
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('FriendsPageService/GetFriends');
            $friendsResult = $this->GetFriends->getFollowingEmails();
            $returnArray = array(
                'friendsResult'=>$friendsResult,
            );
            $this->load->view('properties/friends', $returnArray);
            var_dump($returnArray);
        }
    }

    public function setPost()
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $postContent = $this->input->post('userPost');
            var_dump($postContent);
            $this->load->model('PostService/AddPost');
            $this->AddPost->postContent($postContent);
        }
    }
}
