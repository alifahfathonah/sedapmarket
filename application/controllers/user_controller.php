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
		$this->load->library("form_validation");
		
		if($this->input->post("loginbtn")) {
			$this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email|xss_clean');
			$this->form_validation->set_rules('user_pass', 'Password', 'required|trim|xss_clean');
			if ($this->form_validation->run() == TRUE)
            {
                $this->viewdata = array(
                    "username" => $this->input->post("user_email"),
                    "userpass" => $this->input->post("user_pass"),
                    "remember" => $this->input->post("remember"),
                );
                $this->UserModel->check_login($this->viewdata);
                if($this->UserModel->is_error==1) {
                    $this->session->set_flashdata("error",$this->UserModel->error_message);
                }
                else {
                    //redirect("home");
                }
            } else {
                $this->viewdata["is_error"] = 1;
            }
		}
		
		$this->load->view("users/login");
	 }
	 
	 /***
	  * Logout
	  */
	 public function logout() {
		$sess = $this->session->userdata("security");
		$sess = "";
		$this->session->unset_userdata("security");
		$this->UserModel->user_remove_cookie();
		redirect('login');
	 } 
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */