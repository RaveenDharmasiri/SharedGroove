<?php
class YourProfileController extends CI_Controller
{
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
                'friendsResult' => $friendsResult,
            );
            $this->load->view('properties/friends', $returnArray);
        }
    }
}
