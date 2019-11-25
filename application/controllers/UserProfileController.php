<?php
class UserProfileController extends CI_Controller
{
    /**
     * This function will allow the currently logged in user to follow another user by visiting their profiles
     */
    public function followUser($userId)
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('FollowUser');
            $this->FollowUser->getEmailOfFollowingUser($userId);
            $this->load->model('UserProfileService/UserProfileData');
            $userProfileData = $this->UserProfileData->getUserProfileData($userId);
            $this->load->view('properties/userProfile', $userProfileData);
        }
    }

    /**
     * This function sends the user back to their profile pages. 
     * 
     * This function is invoked when the user clicks the YourProfile link when in another users profile.
     */
    public function sendToYourProfile()
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('YourProfileService/YourProfileData');
            $userProfileData = $this->YourProfileData->getUserProfileData();
            $this->load->view('properties/yourProfile', $userProfileData);
        }
    }
}
