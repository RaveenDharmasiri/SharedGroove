<?php
class UserProfileController extends CI_Controller
{
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
            var_dump($userProfileData);
        }
    }

    public function sendToYourProfile()
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
}
