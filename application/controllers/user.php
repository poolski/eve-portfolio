<?php
class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('local/user_model');
	}
	public function login($user,$pass) {
		print_r($this->user_model->login($user,$pass));
	}
	public function index() {
		$data['title'] = "Login";
		                                   
		$this->load->view('templates/header',$data);
		$this->load->view('user/login');
		$this->load->view('templates/footer');
	}
}