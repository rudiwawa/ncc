<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cLogin extends CI_Controller {

    public function index() {
        $this->load->helper('url');
        $this->load->view('components/vHalamanLogin');
    }

    public function cekLogin() {
        $username = $this->input->post("email");
        $password = $this->input->post("password");

        if ($username = "admin" && $password == "admin") {

        }
        else {
            
        }
    }

}