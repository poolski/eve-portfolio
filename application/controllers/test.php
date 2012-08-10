<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	function __construct(){
        parent::__construct();
        $this->load->model('eveapi/item_model');
    }

    function index() {
    	$this->item_model->checkTimestamp(35);
    }
}