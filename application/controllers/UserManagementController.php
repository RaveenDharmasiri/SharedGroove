<?php

class UserManagementController extends CI_Controller
{
    /**
     * This is the main function of the controller. 
     * This function checks if the session has the email of the currently logged in user.
     * IF the data is unavailable, then the user is then sent to the login page.
     * IF the data is available, then the user is sent to the Home page.
     */
    public function index()
    {

        $currentUserEmail = $this->session->userdata('email');
        if($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->sendingToHomePage();
        }
    }

    /**
     * This function insert a user information into a database when they Register.
     */
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

    /**
     * This controller method will accept email and password and then it will call the model to look for email and password
     */
    public function findUser()
    {
        $email = $this->input->get('email');
        $password = $this->input->get('password');

        /**
         * First calls the method to see if the email already exists. 
         * If true the user will is taken to the homepage 
         * else
         * The user will be again taken to the login page and will let him know that the email and password he entered are not correct.
         */
        $this->load->model('Login');
        $userExists = $this->Login->checkIfEmailAlreadyExists($email, $password);

        if ($userExists) {
            $this->session->set_userdata('email', $email);
            $this->sendingToHomePage();
        } else {
            $viewReturnData = array(
                'errorMessage' => 'Email or Password you entered are not correct',
            );
            $this->load->view('properties/login', $viewReturnData);
        }
    }

    /**
     * This controller method call the model which gathers all the information of the currently logged in user before sending them to the homepage.
     * It gathers data such as user firstname, lastname, follower count, following count, friends count and the posts of the user.
     */
    public function sendingToHomePage()
    {
        $currentUserEmail = $this->session->userdata('email');
        if ($currentUserEmail == null) {
            $this->load->view('properties/login');
        } else {
            $this->load->model('HomePageService/HomeData');
            $homePageData = $this->HomeData->getHomeInformation();
            $this->load->view('properties/Home', $homePageData);
        }
    }

    /**
     * This controller function is invoked when the user stars to edit their profile picture. Once after uploading their image and selecting the genres and when they click the save changes button, this function will ne invoked.
     */
    public function editProfileInfoUpdate()
    {
        $genres = $this->input->post('genres');
        $email = $this->input->post('userEmail');
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        // First uploading the image to the folder will be done
        $imageWasUploadedToDB = $this->uploadImageToFolder($firstName, $lastName, $email);
        // Based on whether the image was uploaded to database the method will proceed to add the user's selected genres to the UserGenre table.
        if ($imageWasUploadedToDB) {
            $this->uploadUserGenres($genres, $email);
            $this->load->view('properties/login');
        }
    }

    // This function will upload the image selected by the user as their profile picture to the uploads folder. It accpets files such as png, jpg, gif and JPEG
    private function uploadImageToFolder($firstName, $lastName, $email)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|JPEG';

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

    //uploading the image path to the database.
    private function uploadImageToDB($imageData, $email)
    {
        $imageFullPath = $imageData;
        $relativeImagePath = $this->getProfileImageRelativePath($imageFullPath);
        $this->load->model('EditProfile');
        $this->EditProfile->uploadImage($relativeImagePath, $email);
    }

    // Getting the relative path of the uploaded image.
    private function getProfileImageRelativePath($imageFullPath)
    {
        $splitImageFullPath = explode('/', $imageFullPath);
        $relativeImagePath = $splitImageFullPath[6] . '/' . $splitImageFullPath[7];
        return $relativeImagePath;
    }

    // This function invoked the model method that adds the user selected genres to the database.
    private function uploadUserGenres($genres, $email)
    {
        $this->load->model('EditProfile');
        $this->EditProfile->uploadGenres($genres, $email);
    }
}
