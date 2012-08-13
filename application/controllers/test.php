<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('eveapi/item_model');
    }

    function index() {
    	$this->load->view('templates/header');
    	var_dump($this->item_model->getItemPrices(array(35,44)));
    	$this->load->view('templates/footer');
    }
}