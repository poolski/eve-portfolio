<?php
class Add extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('eveapi/account_model');
		$this->load->model('eveapi/character_model');
		$this->load->model('local/user_model');
	}
	public function index($msg = NULL,$alert_class = NULL) {
		$data['msg'] = $msg;
    	$data['title'] = "Add API";
    	$data['alert_class'] = $alert_class;
    	if($this->session->userdata('userid') && $this->session->userdata('userid')) {
    		redirect(base_url("add/show"));
    	}
    	else {
	    	$this->load->view('templates/header',$data);
			$this->load->view('account/add_api_key',$data);
			$this->load->view('templates/footer');
		}
    }
    // Used when you click the "try different API key link"
    public function new_api() {
    	$this->session->set_userdata('userid',NULL);
    	$this->session->set_userdata('vcode',NULL);
		$this->index();
    }

    public function show($msg = NULL,$alert_class = NULL) {
    	if(isset($_POST['userid'])&&isset($_POST['vcode'])) {
    		$this->session->set_userdata('userid',$this->security->xss_clean($this->input->post('userid')));
        	$this->session->set_userdata('vcode',$this->security->xss_clean($this->input->post('vcode')));
    	}
        $userid = $this->session->userdata('userid');
        $vcode = $this->session->userdata('vcode');
        $data['msg'] = $msg;
        $data['alert_class'] = $alert_class;
        $data['title'] = "Characters on this account";
		$result = $this->account_model->list_characters($userid,$vcode);
		if(!array_key_exists('error', $result)) {
			$characters = array();
			foreach($result as $char) {
				if(is_array($char) && array_key_exists('name', $char)) {
					$balance = $this->character_model->accountBalance($char['characterID']);
					$characters[] = array("name" => $char['name'],"characterID" => $char['characterID'],
						"corporationName" => $char['corporationName'],
						"balance" => number_format($balance['attributes']['balance']));
				}
			}
			$data['characters'] = $characters;
			$this->load->view('templates/header',$data);
			$this->load->view('account/list',$data);
			$this->load->view('templates/footer');
		}
		else {
			$data['title'] = "Invalid API Stuffs";
			$msg = $result['error'];
			$this->index($msg,"alert-error");
		}
    }

    public function process($msg = NULL,$alert_class = NULL) {
        if(!isset($_POST['charID'])) {
	        $this->show();
		}
		else {
			// Args to be passed in to the insertymejob function
			$charID = $this->input->post('charID');
			$args = array(
				"owner" => $this->session->userdata('id'),
				//Note that these two are different Things. 
				"userid" => $this->session->userdata('userid'),
				"vcode" => $this->session->userdata('vcode'),
				"characterID" => $charID,
				"name" => $this->character_model->characterName($charID),
			);
			$this->add_char($args);
		}
    }
    private function add_char($data) {
    	if($this->user_model->addCharToAccount($data) == true) {
    		$this->show("Suces! U add spaceguy!","alert-success");
    	}
    	else {
    		$data['msg'] = "Your character was not added. Chances are you're stupid and trying to add an existing one.";
    		$this->show($data['msg'],"alert-error");
    	}
    }
}