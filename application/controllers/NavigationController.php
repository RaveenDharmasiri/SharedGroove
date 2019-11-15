<?php

class NavigationController extends CI_Controller {

    public function showLogin() {
        $this->load->view('properties/login');
    }

    public function showRegister() {
        $this->load->view('properties/register');
    }

}