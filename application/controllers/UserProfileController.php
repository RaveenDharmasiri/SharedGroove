<?php
class UserProfileController extends CI_Controller {
    public function sendToUserProfile(){
        $this->load->model('UserProfileService/UserProfileData');
        $this->UserProfileData->getUserProfileData();
    }
}