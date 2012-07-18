<?php
class Account extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('api');
	}
	public function index() {
		$args = array("keyID"=>210429,"vCode"=>"TwEwWA3j9EBaTgPSI5PynHp7jP2LGUGWROsUYCbOfXlXzfTFE14vmJ8fbY0vCTmw");
		$data['characters'] = $this->api->call("eveapi","account", "Characters", $args);
		$data['title'] = "Your characters";

		$this->load->view('templates/header',$data);
		$this->load->view('account/list',$data);
		$this->load->view('templates/footer');
	}
}