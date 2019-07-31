<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cPariwisata extends CI_Controller {

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
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('mPariwisata');
	}
	
	public function index() {
		$this->load->view('vHalamanUtama');
	}

	public function getDaftarPariwisata() {
		$data['daftarWisata'] = $this->mPariwisata->getDataDaftarPariwisata();
		if ($data['daftarWisata'] == null) {
			$this->load->view('components/404/v404');
		}
		else {
			$this->load->view('components/vDaftarWisata', $data);
		}
	}

	public function getSubdaftarPariwisata($subdaftar) {
		$data['ket_jenis'] = $this->mPariwisata->getJudulWisata($subdaftar);
		$data['subdaftarWisata'] = $this->mPariwisata->getSubdaftarDataPariwisata($subdaftar);
		if ($data['ket_jenis'] == null && $data['subdaftarWisata'] == null) {
			$this->load->view('components/404/v404');
		}
		else {
			$this->load->view('components/vSubdaftarWisata', $data);
		}
	}

	public function getDetailPariwisata($detail) {
		$data['detailWisata'] = $this->mPariwisata->getDetailDataPariwisata($detail);
		$data['wisataLain'] = $this->mPariwisata->getTempatWisataLain($detail);
		if ($data['detailWisata'] == null) {
			$this->load->view('components/404/v404');
		}
		else {
			$this->load->view('components/vDetailWisata', $data);
		}
	}
}
