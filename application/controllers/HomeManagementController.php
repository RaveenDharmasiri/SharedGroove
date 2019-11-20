<?php
class HomeManagementController extends CI_Controller
{

    public function sendingToUserProfilePage($userId)
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('UserProfileService/UserProfileData');
            $userProfileData = $this->UserProfileData->getUserProfileData($userId);
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
                'followingUserResults'=>$followingUserResults,
            );
            $this->load->view('properties/following', $returnArray);
            var_dump($returnArray);
        }
    }

    public function postMessage()
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $postMessage = $this->input->post('userPost');
            $this->load->model('PostService/AddPost');
            $this->AddPost->postMessage($postMessage);
        }
    }
}
