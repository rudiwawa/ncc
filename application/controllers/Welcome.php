<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function index()
	{
		$ready = true;
		if($ready ){
			$this->load->view('template/header', [
				'bootstrap'=>true, 
				'home_page'=>true,
				'style'=>true,
				'colorBlue'=>true,
				'jquery'=>true,
				'morris'=>true,
				'style'=>true,
				'font_awesome_brand'=>true,
				'font_awesome_solid'=>true]);
			// Untuk view utama
			$this->load->view('wisata');
			// Untuk view footer
			$this->load->view('template/footer', [
				'jquery'=>true,
				'bootstrapjs'=>true,
				'slimscroll'=>true,
				'wave'=>true,
				'sidebarmenu'=>true,
				'stickykit'=>true,
				'customJS'=>true,
				'sparkline'=>true,
				'morris'=>false,
				'chart'=>false,
				'app'=>true,
				'switcher'=>true
			]);
		}else{
			x();
			redirect("https://kampungbudaya.com/user_authentication/index");
		}
	}

	public function x (){

	}
}
