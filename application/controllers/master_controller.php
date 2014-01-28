<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class Master_Controller extends App_Controller {
	
	public function index()
	{
		//$this->load->view('users/login');
	}
	
	/*** Customer ***/
	
	/***
	 * Get Customer List
	 */
	public function get_customers_list() {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		$this->viewdata["custlist"] = $this->MasterModel->get_customers_list();
		$this->load->view('masters/get_customers_list');
	}
	
	/*** Product ***/
	
	public function edit_customer() {
		$this->load->library('form_validation');
		if($this->input->post("editbtn")) { 
			//$this->form_validation->set_rules('user_name', 'Full Name', 'required|trim|xss_clean');
			//$this->form_validation->set_rules('user_pass', 'New Password', 'trim|min_length[6]|xss_clean');
			//$this->form_validation->set_rules('confpass', 'Confirm Password', 'required|trim|matches[newpass]|xss_clean');
		
			//if ($this->form_validation->run() == TRUE) {
				$tmp = $this->input->post();
				$i=0;
                foreach($tmp["option_name"] as $t) {
					$data = array(
						"option_name"	=> $t,
						"option_value"	=> $tmp["option_value"][$i]	
					);
					//echo debug($data);
					$this->OptionModel->update_config($data);   
					$i++;
				}	
                $this->viewdata["is_error"] = $this->OptionModel->is_error;
                if($this->OptionModel->is_error==1) {
                    //echo $this->OptionModel->error_message;
                    $this->session->set_flashdata("error",$this->OptionModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->OptionModel->message);
                }
				redirect('setup');
			//}
		
		}
		
		$this->viewdata["setuplist"] = $this->OptionModel->get_config_detail();
		$this->load->view('setup',$this->viewdata);
	}
}	