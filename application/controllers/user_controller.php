<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class User_Controller extends App_Controller {
	
	public function index()
	{
		//$this->load->view('users/login');
	}
	
	/***
	 * Login Form
	 */
	 public function login() {
		$this->load->view("users/login");
	 }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */