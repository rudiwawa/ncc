<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		// $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		// Variable ready menendakan apakah website masih coming soon atau sudah siap
		$ready = true;
		if($ready ){
			// echo $this->cache->clean();
			// var_dump($this->cache->cache_info());
			// Untuk view header
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
			redirect("https://kampungbudaya.com/user_authentication/index");
		}
	}
}
