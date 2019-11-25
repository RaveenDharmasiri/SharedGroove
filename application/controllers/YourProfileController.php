<?php
class YourProfileController extends CI_Controller
{
    /**
     * This function will direct the user to page that shows all the users who are following the currently logged in user.
     */
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

    /**
     * This function will direct the user to the page that shows all the users who are being followed by the currently logged in user.
     */
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

    /**
     * This function will direct the user to the page that shows all the users who are being followed by the currently logged in user.
     */
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

    /**
     * This function will unset the session and take the user to the login page.
     */
    public function logout() {
        unset($_SESSION['email']);
        $this->load->view('properties/login');
    }
}
