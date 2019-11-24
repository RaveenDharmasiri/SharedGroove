<?php

// The purpose of the this controller is to navigate users to pages based on the link they click.
class NavigationController extends CI_Controller {

    // This contoller method is used to navigate user to the login page when they click on the login link in the registration page.
    public function showLogin() {
        $this->load->view('properties/login');
    }

    // This controller method is used to navigate the user to the registration page when they click on the register link in the login page.
    public function showRegister() {
        $this->load->view('properties/register');
    }

}