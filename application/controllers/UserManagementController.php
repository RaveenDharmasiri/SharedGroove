<?php

class UserManagementController extends CI_Controller
{
    public function index()
    {
        $this->load->view('properties/editProfile');
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
            $this->load->view('properties/editProfile');
        }
    }

    public function findUser()
    {
        $email = $this->input->get('email');
        $password = $this->input->get('password');

        $this->load->model('Login');
        $emailInstanceCount = $this->Login->checkIfEmailAlreadyExists($email, $password);

        if ($emailInstanceCount > 0) {
            $this->load->view('properties/home');
        } else {
            $viewReturnData = array(
                'errorMessage' => 'Email or Password you entered are not correct',
            );

            $this->load->view('properties/login', $viewReturnData);
        }
    }

    public function editProfileInfoUpdate()
    {
        $genres = $this->input->post('genres');
        $image = $this->input->post('profileImage');

        $email = $this->input->post('userEmail');

        $this->uploadImageToFolder($email);
    }

    private function uploadImageToFolder($email)
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('profileImage')) {
            $error = array('error' => $this->upload->display_errors());
            // var_dump($error['error']);
            $returnArray = array(
                'error'=>$error['error'],
            );
            $this->load->view('properties/editProfile', $returnArray);
        } else {
            $imageData = array('upload_data' => $this->upload->data());

            $relativeImagePath = $this->uploadImageToDB($imageData);

            $returnArray = array(
                'relativeImagePath'=>$relativeImagePath,
            );

            $this->load->view('properties/editProfile', $returnArray);

            // var_dump($imageData['upload_data']['full_path']);

            // $this->load->view('upload_success', $data);
        }
    }

    private function uploadImageToDB($imageData) {
        $imageFullPath = $imageData['upload_data']['full_path'];
        $relativeImagePath = $this->getProfileImageRelativePath($imageFullPath);
        return $relativeImagePath;
    }

    private function getProfileImageRelativePath($imageFullPath) {
        $splitImageFullPath = explode('/', $imageFullPath);
        // var_dump($splitImageFullPath);

        $relativeImagePath = $splitImageFullPath[6].'/'.$splitImageFullPath[7];
        // var_dump($relativeImagePath);

        return $relativeImagePath;
    }
}
