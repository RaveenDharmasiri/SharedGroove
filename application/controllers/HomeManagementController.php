<?php
class HomeManagementController extends CI_Controller
{
    /**
     * 
     */
    public function sendingToYourProfilePage()
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
            $this->load->model('YourProfileService/YourProfileData');
            $userProfileData = $this->YourProfileData->getUserProfileData();
            $this->load->view('properties/yourProfile', $userProfileData);
        }
    }

    public function sendingToFollowersPage()
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
        /**
         * This is to check if the session still have the data of the currently logged in user.
         * Only if the data is available the model function is accessed.
         * If not the user is sent to the login page. 
         */
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
        /**
         * This is to check if the session still have the data of the currently logged in user.
         * Only if the data is available the model function is accessed.
         * If not the user is sent to the login page. 
         */
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

    public function setPost()
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
            $postContent = $this->input->post('userPost');
            $postContent = $this->reCreatePost($postContent);
            if ($postContent != "") {
                $this->load->model('PostService/AddPost');
                $this->AddPost->postContent($postContent);
                $this->load->model('HomePageService/HomeData');
                $homePageData = $this->HomeData->getHomeInformation();
                $this->load->view('properties/home', $homePageData);
            } else {
                $this->load->model('HomePageService/HomeData');
                $homePageData = $this->HomeData->getHomeInformation();
                $this->load->view('properties/home', $homePageData);
            }
        }
    }

    public function reCreatePost($postContent)
    {
        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        // $text = "My name is http://example.com. My age is https://www.google.com/ and my profile pic is https://www.qries.com/images/banner_logo.png";
        $text = $postContent;

        $newText = explode(" ", $text);

        $finalPost = "";

        for ($x = 0; $x < sizeof($newText); $x++) {
            if (preg_match($reg_exUrl, $newText[$x], $url)) {
                $linkType = explode(".", $newText[$x]);
                if ($linkType[sizeof($linkType) - 1] == "") {
                    if ($linkType[sizeof($linkType) - 2] == 'png' || $linkType[sizeof($linkType) - 2] == 'jpg' || $linkType[sizeof($linkType) - 2] == 'JPEG' || $linkType[sizeof($linkType) - 2] == 'gif') {
                        $newUrl = rtrim($url[0], ". ");
                        $finalPost .= " " . preg_replace($reg_exUrl, "<br><img style='width:160px' src='{$newUrl}'/>", $newText[$x]) . " <br>";
                    } else {
                        $finalPost .= " " . preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $newText[$x]) . " ";
                    }
                } else {
                    if ($linkType[sizeof($linkType) - 1] == 'png' || $linkType[sizeof($linkType) - 1] == 'jpg' || $linkType[sizeof($linkType) - 1] == 'JPEG' || $linkType[sizeof($linkType) - 1] == 'gif') {
                        $finalPost .= " " . preg_replace($reg_exUrl, "<br><img style='width:160px' src='{$url[0]}'/>", $newText[$x]) . " <br>";
                    } else {
                        $finalPost .= " " . preg_replace($reg_exUrl, "<a href='{$url[0]}'>{$url[0]}</a>", $newText[$x]) . " ";
                    }
                }
            } else {
                $finalPost .= $newText[$x] . " ";
            }
        }

        return $finalPost;
    }
}
