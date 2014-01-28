<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class Master_Controller extends App_Controller {
	
	public function index()
	{
		//$this->load->view('users/login');
	}
	
	/*** Customer ***/
	
	/***
	 * Add Customer List
	 */
	public function add_customer() {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		
		if($this->input->post("addbtn")) {
			$this->load->model("MasterModel");
			$this->form_validation->set_rules('cust_regdate', 'Register Date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_fullname', 'Customer Full Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('cust_address', 'Customer Address', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_phonenumber', 'Customer Phone number', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_faxnumber', 'Customer Fax number', 'trim|xss_clean');
			$this->form_validation->set_rules('cust_mobilenumber', 'Customer Mobile number', 'trim|xss_clean');
			$this->form_validation->set_rules('cust_emailaddress', 'Customer E-Mail Address', 'trim|valid_email|xss_clean');
			if ($this->form_validation->run() == TRUE)
            {
				 $data = $this->input->post();
                
                $this->MasterModel->add_customer($data);   
                $this->viewdata["is_error"] = $this->MasterModel->is_error;
                if($this->MasterModel->is_error==1) {
                    //echo $this->MasterModel->error_message;
                    $this->session->set_flashdata("error",$this->MasterModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->MasterModel->message);
                }
				redirect('customer/add');
			}
		}
		
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);
			
		$this->viewdata["formatdate"] = $tmp;
		$this->load->view('masters/add_customer',$this->viewdata);
	}
	
	/***
	 * Add Customer List
	 */
	public function edit_customer($id) {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		
		if($this->input->post("editbtn")) {
			$this->load->model("MasterModel");
			$this->form_validation->set_rules('cust_regdate', 'Register Date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_fullname', 'Customer Full Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('cust_address', 'Customer Address', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_phonenumber', 'Customer Phone number', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_faxnumber', 'Customer Fax number', 'trim|xss_clean');
			$this->form_validation->set_rules('cust_mobilenumber', 'Customer Mobile number', 'trim|xss_clean');
			$this->form_validation->set_rules('cust_emailaddress', 'Customer E-Mail Address', 'trim|valid_email|xss_clean');
			if ($this->form_validation->run() == TRUE)
            {
				 $data = $this->input->post();
                
                $this->MasterModel->edit_customer($data);   
                $this->viewdata["is_error"] = $this->MasterModel->is_error;
                if($this->MasterModel->is_error==1) {
                    //echo $this->MasterModel->error_message;
                    $this->session->set_flashdata("error",$this->MasterModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->MasterModel->message);
                }
				redirect('customer/edit');
			}
		}
		
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);
			
		$this->viewdata["formatdate"] = $tmp;
		$this->viewdata["cust_id"] = $id;
		$this->viewdata["cust"] = $this->MasterModel->get_customer_detail($id);
		$this->load->view('masters/edit_customer',$this->viewdata);
	}
	
	/***
	 * Get Customer List
	 */
	public function get_customers_list($itm="",$p=0) {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		
		$limit = $this->siteconfig[3]["value"]; 
		$config['base_url'] = site_url('customer/list');
		$config['total_rows'] = $this->MasterModel->get_customers_count($itm);
		$config['per_page'] = $limit;
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);
		
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["custlist"] = $this->MasterModel->get_customers_list($itm,$p);
		$this->load->view('masters/get_customers_list',$this->viewdata);
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