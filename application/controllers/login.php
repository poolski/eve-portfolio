<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login controller class
 */
class Login extends CI_Controller{
 
    function __construct(){
        parent::__construct();
    }
 
    public function index($msg = NULL,$alert_class = NULL){
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
            $this->index($msg,"alert-error");
        }else{
            // If user did validate,
            // Send them to members area
            redirect(base_url());
        }
    }
}
?>