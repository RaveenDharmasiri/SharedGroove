<?php
class FollowersManagementController extends CI_Controller{

    public function sendingToFollowerProfilePage($userId)
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('UserProfileService/UserProfileData');
            $userProfileData = $this->UserProfileData->getUserProfileData($userId);
            $this->load->view('properties/userProfile', $userProfileData);
            var_dump($userProfileData);
        }
    }

}