<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class Master_Controller extends App_Controller {
	
	public function index()
	{
		//$this->load->view('users/login');
	}
	
	/*** Unit ***/
	/***
	 * Add Unit
	 */
	public function add_unit() {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("addbtn")) {
			$this->form_validation->set_rules('unit_name', 'Unit Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('unit_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
                $this->MasterModel->add_unit($data);   
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
				redirect('unit/add');
			}
		}
			
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/add_unit',$this->viewdata);
	}
	
	/***
	 * Edit Unit
	 */
	public function edit_unit($id) {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("editbtn")) {
			$this->form_validation->set_rules('unit_name', 'Unit Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('unit_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
				$data["unit_id"] = $id;
                $this->MasterModel->edit_unit($data);   
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
				redirect('unit/edit/'.$id);
			}
		}
			
		$this->viewdata["unit_id"] = $id;
		$this->viewdata["unit"] = $this->MasterModel->get_unit_detail($id);
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/edit_unit',$this->viewdata);
	}
	
	
	/***
	 * Get Unit List
	 */
	public function get_units_list($p=0) {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		
		if($this->input->post('unit_delbtn')) {
			$data = $this->input->post();
			foreach($data["chkbox"] as $d) {
				//echo debug($d);
				$this->MasterModel->delete_unit($d);
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
			redirect('unit/list');
			
		}
		
		$limit = $this->siteconfig[3]["value"]; 
		
		$config['base_url'] 	= site_url('unit/list');
		$config['total_rows'] 	= $this->MasterModel->get_unit_count($itm);
		$config['per_page'] 	= $limit;
		$config['uri_segment'] 	= 3;
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		//$config['anchor_class'] = "";	
		$this->pagination->initialize($config);
		
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["unitlist"] = $this->MasterModel->get_unit_list($itm,$p,$limit);
		$this->load->view('masters/get_unit_list',$this->viewdata);
	}
	
	/*** Products ***/
	/***
	 * Add Product
	 */
	public function add_product() {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("addbtn")) {
			$this->form_validation->set_rules('category_id', 'Category Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_name', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_kemasan', 'Kemasan', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_stock', 'Stock', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('product_price', 'Price', 'required|trim|integer|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
                $this->MasterModel->add_product($data);   
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
				redirect('products/add');
			}
		}
			
		$this->viewdata["formatdate"] = $tmp;
		$this->viewdata["catlist"] = $this->MasterModel->get_category();
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/add_product',$this->viewdata);
	}
	
	/***
	 * Edit Product
	 */
	public function edit_product($id) {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("editbtn")) {
			$this->form_validation->set_rules('category_id', 'Category Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_name', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_kemasan', 'Kemasan', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_stock', 'Stock', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('product_price', 'Price', 'required|trim|integer|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
				$data["product_id"] = $id;
                $this->MasterModel->edit_product($data);   
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
				redirect('products/add');
			}
		}
			
		$this->viewdata["product_id"] = $id;
		$this->viewdata["prod"] = $this->MasterModel->get_product_detail($id);
		$this->viewdata["catlist"] = $this->MasterModel->get_category();
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/edit_product',$this->viewdata);
	}
	
	/***
	 * Get Products List
	 */
	public function get_products_list($p=0) {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		
		if($this->input->post('product_delbtn')) {
			$data = $this->input->post();
			foreach($data["chkbox"] as $d) {
				//echo debug($d);
				$this->MasterModel->delete_product($d);
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
			redirect('product/list');
			
		}
		
		$limit = $this->siteconfig[3]["value"]; 
		
		$config['base_url'] 	= site_url('products/list');
		$config['total_rows'] 	= $this->MasterModel->get_product_count($itm);
		$config['per_page'] 	= $limit;
		$config['uri_segment'] 	= 3;
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		//$config['anchor_class'] = "";	
		$this->pagination->initialize($config);
		
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["prodlist"] = $this->MasterModel->get_products_list($itm,$p,$limit);
		$this->load->view('masters/get_products_list',$this->viewdata);
	}
	
	
	/*** Category ***/
	/***
	 * Add Category
	 */
	public function add_category() {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		
		if($this->input->post("addbtn")) {
			$this->load->model("MasterModel");
			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('category_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				 $data = $this->input->post();
                
                $this->MasterModel->add_category($data);   
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
				redirect('category/add');
			}
		}
		
		$this->viewdata["formatdate"] = $tmp;
		$this->load->view('masters/add_category',$this->viewdata);
	}
	
	/***
	 * Edit Category
	 */
	public function edit_category($id) {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("editbtn")) {
			
			$this->form_validation->set_rules('category_name', 'Category Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('category_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
				$data["category_id"] = $id;	
                $this->MasterModel->edit_category($data);   
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
				redirect('category/edit/'.$id);
			}
		}
			
		$this->viewdata["formatdate"] = $tmp;
		$this->viewdata["cat_id"] = $id;
		$this->viewdata["cat"] = $this->MasterModel->get_category_detail($id);
		//echo debug($this->viewdata["cat"]);
		$this->load->view('masters/edit_category',$this->viewdata);
	}
	
	/***
	 * Get Category List
	 */
	public function get_category_list($p=0) {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		
		if($this->input->post('category_delbtn')) {
			$data = $this->input->post();
			foreach($data["chkbox"] as $d) {
				//echo debug($d);
				$this->MasterModel->delete_category($d);
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
			redirect('category/list');
			
		}
		
		$limit = $this->siteconfig[3]["value"]; 
		
		$config['base_url'] 	= site_url('category/list');
		$config['total_rows'] 	= $this->MasterModel->get_category_count($itm);
		$config['per_page'] 	= $limit;
		$config['uri_segment'] 	= 3;
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		//$config['anchor_class'] = "";	
		$this->pagination->initialize($config);
		
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["catlist"] = $this->MasterModel->get_category_list($itm,$p,$limit);
		$this->load->view('masters/get_category_list',$this->viewdata);
	}
	
	/*** Customer ***/
	
	/***
	 * Add Customer
	 */
	public function add_customer() {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		
		if($this->input->post("addbtn")) {
			$this->load->model("MasterModel");
			$this->form_validation->set_rules('cust_regdate', 'Register Date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_type', 'Customer Type', 'required|trim|xss_clean');
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
	 * Edit Customer
	 */
	public function edit_customer($id) {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("editbtn")) {
			$this->form_validation->set_rules('cust_regdate', 'Register Date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_type', 'Customer Type', 'required|trim|xss_clean');	
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
	public function get_customers_list($p=0) {
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
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		//$config['anchor_class'] = "";	
		$this->pagination->initialize($config);
		
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["custlist"] = $this->MasterModel->get_customers_list($itm,$p,$limit);
		$this->load->view('masters/get_customers_list',$this->viewdata);
	}
	
}	