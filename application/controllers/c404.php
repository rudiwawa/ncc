<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c404 extends CI_Controller {

    public function index() {
        $this->load->view('components/404/v404');
    }

}