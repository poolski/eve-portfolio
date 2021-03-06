<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
        $data['loginmsg'] = $msg;
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
        $this->load->view('templates/header',$data);
        if($result) {
    		$characters = array();
    		foreach($result as $char) {
    			if(is_array($char) && array_key_exists('name', $char)) {
    				$characters[] = array("name" => $char['name'],"characterID" => $char['characterID']);
    			}
    		}
    		$data['characters'] = $characters;
    		$this->load->view('account/list_registered_characters',$data);
        }
        else {
            $data['msg'] = 'You have no characters on this account. Click <a href="'.base_url().'add">here</a> to add one.';
            $this->load->view('common/error',$data);
        }
		$this->load->view('templates/footer');
	}
	public function logout() {
        $this->session->sess_destroy();
        redirect(base_url().'account/login');
    }
    public function register($msg = NULL,$alert_class = NULL) {
    	// Load our view to be displayed
        // to the user
        $data['loginmsg'] = $msg;
        $data['alert_class'] = $alert_class;
  		$this->load->view('templates/header',$data);
        $this->load->view('auth/register_view', $data);
        $this->load->view('templates/footer');
    }    
    public function do_register() {
    	$result = $this->user_model->register();
    	if($result) {
    		$this->index("Congratulations, you registered. You are a wonderful snowflake.");
    	}
    	else {
    		$this->register("Yeah, something broke. Probably whatever you typed was horrible and stupid");
    	}
    }
}