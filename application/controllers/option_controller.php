<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class Option_Controller extends App_Controller {
	
	public function index()
	{
		//$this->load->view('users/login');
	}
	
	public function edit_setup() {
		$this->load->library('form_validation');
		$this->viewdata["setuplist"] = $this->OptionModel->get_config_detail();
		$this->load->view('setup',$this->viewdata);
	}
}	