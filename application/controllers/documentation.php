<?php
class Documentation extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['title'] = "Data structure documentation";
		$this->load->view('templates/header',$data);
		$this->load->view('documentation/assets');
		$this->load->view('templates/footer');
	}
}