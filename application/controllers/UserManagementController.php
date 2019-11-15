<?php

class UserManagementController extends CI_Controller
{
    public function index()
    { 
        $this->load->view('properties/register');
    }
}
