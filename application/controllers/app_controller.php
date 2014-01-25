<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Controller extends CI_Controller {
	public $viewdata;
	
	public function __construct()
    {
        parent::__construct();
        // $sess = $this->session->userdata("security");
        // if(!$sess["userkey"] && substr($this->uri->segment(1),0,3)!="log") {
           // redirect('login'); 
        // }
        // $this->viewdata["uname"] = $sess["uname"];
        // $this->viewdata["role"] = $role = $sess["group_id"];
        // $this->viewdata["tema"] = "user";
        
        // $this->siteconfig = $this->OptionModel->get_config();
        // //echo debug($this->siteconfig);
        // $this->viewdata["sitetitle"] = $this->siteconfig[0]["option_value"];
        
        // if($role>1 && ($this->uri->segment(1)!="logout" && $this->uri->segment(1)!="login"))
           // redirect('home');
    }
	
	public function index()
	{
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */