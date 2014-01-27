<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class User_Controller extends App_Controller {
	
	public function index()
	{
		//$this->load->view('users/login');
	}
	
	/***
	 * Home page
	 */
	public function home()
	{
		//echo debug($this->session->all_userdata());
		$this->load->view('users/home',$this->viewdata);
	}
	
	/***
	 * Edit Profile
	 */
	public function editprofile()
    {
		//echo debug($this->input->post());
        $this->load->library("form_validation");
        $sess = $this->session->userdata("security");
        $this->viewdata["uname"] = $sess["uname"];
        if($this->input->post('editbtn')) {
            //$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
            $this->form_validation->set_rules('user_name', 'Full Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('user_pass', 'New Password', 'trim|min_length[6]|xss_clean');
            //$this->form_validation->set_rules('confpass', 'Confirm Password', 'required|trim|matches[newpass]|xss_clean');
            
            if ($this->form_validation->run() == TRUE)
            {
                $data = $this->input->post();
                
                $this->UserModel->update_profile($data);   
                $this->viewdata["is_error"] = $this->UserModel->is_error;
                if($this->UserModel->is_error==1) {
                    //echo $this->UserModel->error_message;
                    $this->session->set_flashdata("error",$this->UserModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->UserModel->message);
                }
				redirect('profile/edit');
            } 
            
        }
        $this->load->view('users/editprofile',$this->viewdata);    
    }
	
	/***
	 * Login Form
	 */
	 public function login() {
		$this->load->library("form_validation");
		
		if($this->input->post("loginbtn")) {
			$this->form_validation->set_rules('user_email', 'Email Address', 'required|trim|valid_email|callback_email_check|xss_clean');
			$this->form_validation->set_rules('user_pass', 'Password', 'required|trim|xss_clean');
			if ($this->form_validation->run() == TRUE)
            {
                $this->viewdata = array(
                    "user_email" => $this->input->post("user_email"),
                    "user_pass" => $this->input->post("user_pass"),
                    "remember" => $this->input->post("remember"),
                );
                $this->UserModel->check_login($this->viewdata);
                if($this->UserModel->is_error==1) {
                    $this->session->set_flashdata("error",$this->UserModel->error_message);
                }
                else {
                    redirect("home");
                }
            } else {
                $this->viewdata["is_error"] = 1;
            }
		}
		
		$this->load->view("users/login",$this->viewdata);
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
	 
	 /***
	  * Check Email address
	  */
	 public function email_check($str) {
		$cek = $this->UserModel->email_check($str);
		if(!$cek) {
			$this->form_validation->set_message('email_check', 'Sorry, you can\'t access with your e-mail address');
			return false;
		}
		else {
			return true;
		}
	 }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */