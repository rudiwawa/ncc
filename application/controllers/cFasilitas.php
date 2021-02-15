<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cFasilitas extends CI_Controller {

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
		$this->load->model('mFasilitas');
	}
	
	/*public function index() {
		$this->load->view('vHalamanUtama');
	}

	public function getDaftarFasilitas() {
		$data['daftarFasilitas'] = $this->mFasilitas->getDataDaftarFasilitas();
		if ($data['daftarFasilitas'] == null || count($data['daftarFasilitas']) == 0) {
			$this->load->view('components/404/v404');
		}
		else {
			$this->load->view('components/vDaftarFasilitas', $data);
		}
	}

	public function getSubdaftarFasilitas($subdaftar) {
		$data['ket_jenis'] = $this->mFasilitas->getJudulFasilitas($subdaftar);
		$data['subdaftarFasilitas'] = $this->mFasilitas->getSubdaftarDataFasilitas($subdaftar);
		if ($data['ket_jenis'] == null && $data['subdaftarFasilitas'] == null || (count($data['subdaftarFasilitas']) == 0)) {
			$this->load->view('components/404/v404');
		}
		else {
			$this->load->view('components/vSubdaftarFasilitas', $data);
		}
	}

	public function getDetailFasilitas($detail) {
		$data['detailFasilitas'] = $this->mFasilitas->getDetailDataFasilitas($detail);
		$data['fasilitasLain'] = $this->mFasilitas->getTempatFasilitasLain($detail);
		if ($data['detailFasilitas'] == null || count($data['detailFasilitas']) == 0) {
			$this->load->view('components/404/v404');
		}
		else {
			$this->load->view('components/vDetailFasilitas', $data);
		}
	}*/

	public function index() {
		$this->load->view('vHalamanUtama');
		$this->load->view('components/footer');
	}

	public function getDaftarFasilitas() {
		$data['daftarFasilitas'] = $this->mFasilitas->getDataDaftarFasilitas();
		if ($data['daftarFasilitas'] == null || count($data['daftarFasilitas']) == 0) {
			$this->load->view('components/404/v404');
			$this->load->view('components/footer');
		}
		else {
			$this->load->view('components/vDaftarFasilitas', $data);
			$this->load->view('components/footer');
		}
	}

	public function getSubdaftarFasilitas($subdaftar) {
		$data['ket_jenis'] = $this->mFasilitas->getJudulFasilitas($subdaftar);
		$data['jumlahSubdaftar'] = $this->mFasilitas->getJumlahSubdaftarFasilitas($subdaftar);
		$data['subdaftarFasilitas'] = $this->mFasilitas->getSubdaftarDataFasilitas($subdaftar);
		if ($data['ket_jenis'] == null && $data['subdaftarFasilitas'] == null || (count($data['subdaftarFasilitas']) == 0)) {
			$this->load->view('components/404/v404');
			$this->load->view('components/footer');
		}
		else {
			$this->load->view('components/vSubdaftarFasilitas', $data);
			$this->load->view('components/footer');
		}
	}

	public function getDetailFasilitas($detail) {
		$data['detailFasilitas'] = $this->mFasilitas->getDetailDataFasilitas($detail);
		$data['fasilitasLain'] = $this->mFasilitas->getTempatFasilitasLain($detail);
		echo '<script type="text/javascript">console.log('.json_encode($data).');</script>';
		if ($data['detailFasilitas'] == null || count($data['detailFasilitas']) == 0) {
			$this->load->view('components/404/v404');
			$this->load->view('components/footer');
		}
		else {
			$this->load->view('components/vDetailFasilitas', $data);
			$this->load->view('components/footer');
		}
	}
}
