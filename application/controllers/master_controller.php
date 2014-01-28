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
			$this->form_validation->set_rules('cust_city', 'Customer City', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_state', 'Customer State', 'required|trim|xss_clean');
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
	 * Edit Customer List
	 */
	public function edit_customer($id) {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("editbtn")) {
			$this->form_validation->set_rules('cust_regdate', 'Register Date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_fullname', 'Customer Full Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('cust_address', 'Customer Address', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_city', 'Customer City', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_state', 'Customer State', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_phonenumber', 'Customer Phone number', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_faxnumber', 'Customer Fax number', 'trim|xss_clean');
			$this->form_validation->set_rules('cust_mobilenumber', 'Customer Mobile number', 'trim|xss_clean');
			$this->form_validation->set_rules('cust_emailaddress', 'Customer E-Mail Address', 'trim|valid_email|xss_clean');
			if ($this->form_validation->run() == TRUE)
            {
				 $data = $this->input->post();
				 $data["cust_id"] = $id;	
                
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
				redirect('customer/edit/'.$id);
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
		
		if($this->input->post('cust_delbtn')) {
			$data = $this->input->post();
			foreach($data["chkbox"] as $d) {
				//echo debug($d);
				$this->MasterModel->delete_customer($d);
			}
			if($this->MasterModel->is_error==1) {
				//echo $this->MasterModel->error_message;
				$this->session->set_flashdata("error",$this->MasterModel->error_message);
				//$this->session->unset_flashdata("message");
			}
			else {
				//$this->session->unset_flashdata("error");
				$this->session->set_flashdata("message",$this->MasterModel->message);
			}
			redirect('customer/list');
			
		}
		
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
	
}	