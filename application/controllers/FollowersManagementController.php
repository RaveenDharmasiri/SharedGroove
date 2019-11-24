<?php
/**
 * This controller is used to handle all the funtionalities when the user is taken to a page where there is list of users they can follow. 
 */
class FollowersManagementController extends CI_Controller
{
    // Thsi function takes the user to another users profile pages when they click on those user's names.
    public function sendingToFollowerProfilePage($userId)
    {
        /**
         * This is to check if the session still have the data of the currently logged in user.
         * Only if the data is available the model function is accessed.
         * If not the user is sent to the login page. 
         */
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('UserProfileService/UserProfileData');
            $userProfileData = $this->UserProfileData->getUserProfileData($userId);
            $this->load->view('properties/userProfile', $userProfileData);
        }
    }

    /**
     * This function is invoked when the currently logged in user clicks on the follow button to follow a user.
     * This function is invoked when the user click on the follow button in a users profile page.
     * Also this function is invoked when the user clicks the follow button from a list of users.
     * */  
    public function followUser($userId)
    {
        /**
         * This is to check if the session still have the data of the currently logged in user.
         * Only if the data is available the model function is accessed.
         * If not the user is sent to the login page. 
         */
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('FollowUser');
            $this->FollowUser->getEmailOfFollowingUser($userId);
            $this->load->model('FollowerPageService/GetFollowers');
            $userFollowers = $this->GetFollowers->getUserFollowersEmails();
            $returnArray = array(
                'userFollowers' => $userFollowers
            );
            $this->load->view('properties/followers', $returnArray);
        }
    }
}
