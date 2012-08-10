<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Documentation extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('local/login_model');
		$this->login_model->check_isvalidated();
	}

	public function index() {
		$data['title'] = "Data structure documentation";
		$this->load->view('templates/header',$data);
		$this->load->view('documentation/assets');
		$this->load->view('templates/footer');
	}
}