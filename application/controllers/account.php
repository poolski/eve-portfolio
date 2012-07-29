<?php
class Account extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('eveapi/account_model');
		$this->load->model('eveapi/character_model');
		$this->load->model('local/user_model');
		$this->load->model('local/login_model');
	}

	public function login($msg = NULL,$alert_class = NULL){
        // Load our view to be displayed
        // to the user
        $data['msg'] = $msg;
        $data['title'] = "Please login";
        $data['alert_class'] = $alert_class;
  		$this->load->view('templates/header',$data);
        $this->load->view('auth/login_view', $data);
        $this->load->view('templates/footer');
    }
 
    public function process(){
        // Load the model
        $this->load->model('local/login_model');
        // Validate the user can login
        $result = $this->login_model->validate();
        // Now we verify the result
        if(! $result){
            // If user did not validate, then show them login page again
            $msg = 'Invalid username and/or password.';
            $this->login($msg,"alert-error");
        }else{
            // If user did validate,
            // Send them to members area
            redirect(base_url());
        }
    }
	public function index() {
		$this->login_model->check_isvalidated();
		$data['title'] = "Your characters";
		if($this->session->flashdata('msg')=="") {
			$data['msg'] = NULL;
		}
		else {
			$data['msg'] = $this->session->flashdata('msg');
		}
		$data['alert_class'] = "alert-notice";
		$result = $this->user_model->listAccountCharacters();
		$characters = array();
		foreach($result as $char) {
			if(is_array($char) && array_key_exists('name', $char)) {
				$balance = $this->character_model->accountBalance($char['characterID']);
				$characters[] = array("name" => $char['name'],"characterID" => $char['characterID'],
					"balance" => number_format($balance['attributes']['balance']));
			}
		}
		$data['characters'] = $characters;
		$this->load->view('templates/header',$data);
		$this->load->view('account/list_registered_characters',$data);
		$this->load->view('templates/footer');
	}
	public function logout() {
        $this->session->sess_destroy();
        redirect(base_url().'account/login');
    }    
}