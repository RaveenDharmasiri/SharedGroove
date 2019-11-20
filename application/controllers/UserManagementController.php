<?php

class UserManagementController extends CI_Controller
{
    public function index()
    {

        // $currentUserEmail = $this->session->userdata('email');
        // if($currentUserEmail == null) {
        //     $this->load->view('properties/login');
        // } else {
        //     $this->sendingToHomePage();
        // }

        $this->load->view('properties/login');
    }

    public function insertUser()
    {
        $firstName  = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->load->model('Register');
        $emailInstanceCount = $this->Register->checkIfEmailAlreadyExists($email);
        if ($emailInstanceCount > 0) {
            $returnData = array(
                'errorMessage' => 'Email Already Exists',
            );
            $this->load->view('properties/register', $returnData);
        } else {
            $this->Register->insertUser($firstName, $lastName, $email, $password);
            $returnData = array(
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email,
            );
            $this->load->view('properties/editProfile', $returnData);
        }
    }

    public function findUser()
    {
        $email = $this->input->get('email');
        $password = $this->input->get('password');

        $this->load->model('Login');
        $emailInstanceCount = $this->Login->checkIfEmailAlreadyExists($email, $password);
        $userDetailsArray = $this->Login->getUserDetails($email, $password);

        if ($emailInstanceCount > 0) {
            // $this->session->set_userdata('firstName', $userDetailsArray['firstName']);
            // $this->session->set_userdata('lastName', $userDetailsArray['lastName']);
            // $this->session->set_userdata('profilePicture', $userDetailsArray['profilePicture']);
            $this->session->set_userdata('email', $email);
            $this->sendingToHomePage();
        } else {
            $viewReturnData = array(
                'errorMessage' => 'Email or Password you entered are not correct',
            );
            $this->load->view('properties/login', $viewReturnData);
        }
    }

    public function sendingToHomePage()
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('HomePageService/HomeData');
            $homePageData = $this->HomeData->getHomeInformation();
            $this->load->view('properties/Home', $homePageData);
            var_dump($homePageData);
        }
    }

    public function editProfileInfoUpdate()
    {
        $genres = $this->input->post('genres');
        $email = $this->input->post('userEmail');
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $imageWasUploadedToDB = $this->uploadImageToFolder($firstName, $lastName, $email);
        if ($imageWasUploadedToDB) {
            $this->uploadUserGenres($genres, $email);
        }
    }

    private function uploadImageToFolder($firstName, $lastName, $email)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('profileImage')) {
            $error = array('error' => $this->upload->display_errors());
            $returnArray = array(
                'error' => $error['error'],
                'firstName' => $firstName,
                'lastName' => $lastName,
                'email' => $email
            );
            $this->load->view('properties/editProfile', $returnArray);
            return false;
        } else {
            $imageData = array('upload_data' => $this->upload->data());
            $this->uploadImageToDB($imageData['upload_data']['full_path'], $email);
            return true;
        }
    }

    private function uploadImageToDB($imageData, $email)
    {
        $imageFullPath = $imageData;
        $relativeImagePath = $this->getProfileImageRelativePath($imageFullPath);
        $this->load->model('EditProfile');
        $this->EditProfile->uploadImage($relativeImagePath, $email);
    }

    private function getProfileImageRelativePath($imageFullPath)
    {
        $splitImageFullPath = explode('/', $imageFullPath);
        $relativeImagePath = $splitImageFullPath[6] . '/' . $splitImageFullPath[7];
        return $relativeImagePath;
    }

    private function uploadUserGenres($genres, $email)
    {
        $this->load->model('EditProfile');
        $this->EditProfile->uploadGenres($genres, $email);
    }
}
