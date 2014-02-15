<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class Master_Controller extends App_Controller {
	
	public function index()
	{
		//$this->load->view('users/login');
	}
	
	/*** Shipping ***/
	/***
	 * Add Shipping
	 */
	public function add_shipper() {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		
		if($this->input->post("addbtn")) {
			$this->load->model("MasterModel");
			$this->form_validation->set_rules('shipper_name', 'Shipper Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('shipper_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				 $data = $this->input->post();
                
                $this->MasterModel->add_shipper($data);   
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
		$this->load->view('masters/add_shipper',$this->viewdata);
	}
	
	/***
	 * Edit Shipping
	 */
	public function edit_shipper($id) {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("editbtn")) {
			
			$this->form_validation->set_rules('shipper_name', 'Shipper Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('shipper_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
				$data["shipper_id"] = $id;	
                $this->MasterModel->edit_shipper($data);   
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
				redirect('shipper/edit/'.$id);
			}
		}
			
		$this->viewdata["formatdate"] = $tmp;
		$this->viewdata["shipper_id"] = $id;
		$this->viewdata["shipper"] = $this->MasterModel->get_shipper_detail($id);
		//echo debug($this->viewdata["cat"]);
		$this->load->view('masters/edit_shipper',$this->viewdata);
	}
	
	/***
	 * Get Shipper List
	 */
	public function get_shipper_list($p=0) {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		
		if($this->input->post('shipper_delbtn')) {
			$data = $this->input->post();
			foreach($data["chkbox"] as $d) {
				//echo debug($d);
				$this->MasterModel->delete_shipper($d);
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
			redirect('shipper/list');
			
		}
		
		$limit = $this->siteconfig[2]["option_value"]; 
		
		$config['base_url'] 	= site_url('shipper/list');
		$config['total_rows'] 	= $this->MasterModel->get_shipper_count($itm);
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
		$this->viewdata["shiplist"] = $this->MasterModel->get_shipper_list($itm,$p,$limit);
		$this->load->view('masters/get_shipper_list',$this->viewdata);
	}
	
	/*** Production ***/
	/***
	 * Add production
	 */
	public function add_production() {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("addbtn")) {
			$this->form_validation->set_rules('product_id', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('production_date','Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_name','Product Name', 'trim|xss_clean');
			$this->form_validation->set_rules('begin_stock', 'Beginning Stock', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('stock', 'Stock', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('end_stock', 'Ending Stock', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('production_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
                $this->MasterModel->add_production($data);   
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
				redirect('production/add');
			}
		}
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);
		$this->viewdata["formatdate"] = $tmp;			
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/add_production',$this->viewdata);
	}
	
	/***
	 * Edit Production
	 */
	public function edit_production($id) {
		$this->load->library("form_validation");
		//echo debug($this->input->post());
		$this->load->model("MasterModel");
		if($this->input->post("editbtn")) {
			$this->form_validation->set_rules('product_id', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('production_date','Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|xss_clean');
			$this->form_validation->set_rules('begin_stock', 'Beginning Stock', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('stock', 'Stock', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('end_stock', 'Ending Stock', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('production_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
				$data["production_id"] = $id;
                $this->MasterModel->edit_production($data);   
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
				redirect('production/edit/'.$id);
			}
			else
				echo validation_errors();
		}
		
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);	
		$this->viewdata["formatdate"] = $tmp;		
		$this->viewdata["prod_id"] = $id;
		$this->viewdata["prod"] = $this->MasterModel->get_production_detail($id);
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/edit_production',$this->viewdata);
	}
	
	
	/***
	 * Get Production List
	 */
	public function get_production_list($p=0) {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		
		if($this->input->post('production_delbtn')) {
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
			redirect('production/list');
			
		}
		
		$limit = $this->siteconfig[2]["option_value"]; 
		//echo debug($this->siteconfig);
		$config['base_url'] 	= site_url('production/list');
		$config['total_rows'] 	= $this->MasterModel->get_production_count($itm);
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
		$this->viewdata["productionlist"] = $this->MasterModel->get_production_list($itm,$p,$limit);
		//echo debug($this->viewdata["regionlist"]);
		$this->load->view('masters/get_production_list',$this->viewdata);
	}
	
	/*** Set Price ***/
	/***
	 * Get product for set price and Production 
	 */
	public function get_product_list($op=0,$p=0) {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		
		$limit = $this->siteconfig[2]["option_value"]; 
		//echo debug($this->siteconfig);
		$config['base_url'] 	= site_url('customer/browse/product');
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
		
		$this->viewdata["op"] = $op;
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["prodlist"] = $this->MasterModel->get_product_all($p,$limit);
		
		$this->load->view("masters/browse_product",$this->viewdata);
	}
	
	/***
	 * Add Set Price
	 */
	public function add_setprice($id) {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("OrderModel");
		if($this->input->post("addbtn")) {
			$this->form_validation->set_rules('product_id', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_name', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('price', 'Price', 'required|integer|xss_clean');
			$this->form_validation->set_rules('disc1', 'Discount 1', 'integer|xss_clean');
			$this->form_validation->set_rules('disc2', 'Discount 2', 'integer|xss_clean');
			$this->form_validation->set_rules('disc3', 'Discount 3', 'integer|xss_clean');
			$this->form_validation->set_rules('region_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
				$data["cust_id"] = $id; 
                $this->OrderModel->add_set_price($data);   
                $this->viewdata["is_error"] = $this->OrderModel->is_error;
                if($this->OrderModel->is_error==1) {
                    //echo $this->OrderModel->error_message;
                    $this->session->set_flashdata("error",$this->OrderModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->OrderModel->message);
                }
				redirect('customer/price/add/'.$id);
			}
		}
			
		$this->viewdata["cust_id"] = $id;
		$this->viewdata["cust_name"] = $this->OrderModel->get_customer_name($id);
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/add_cust_price',$this->viewdata);
	}
	
	/***
	 * Edit Set Price
	 */
	public function edit_setprice($cust_id,$price_id) {
		$this->load->library("form_validation");
		//echo debug($this->input->post());
		$this->load->model("OrderModel");
		if($this->input->post("editbtn")) {
			$this->form_validation->set_rules('product_id', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_name', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('price', 'Price', 'required|integer|xss_clean');
			$this->form_validation->set_rules('disc1', 'Discount 1', 'decimal|xss_clean');
			$this->form_validation->set_rules('disc2', 'Discount 2', 'decimal|xss_clean');
			$this->form_validation->set_rules('disc3', 'Discount 3', 'decimal|xss_clean');
			$this->form_validation->set_rules('region_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
				$data["price_id"] = $price_id;
				$data["cust_id"] = $cust_id; 
				//echo debug($data);
                $this->OrderModel->edit_set_price($data);   
                $this->viewdata["is_error"] = $this->OrderModel->is_error;
                if($this->OrderModel->is_error==1) {
                    //echo $this->MasterModel->error_message;
                    $this->session->set_flashdata("error",$this->OrderModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->OrderModel->message);
                }
				redirect('customer/price/edit/'.$cust_id."/".$price_id);
			}
			else {
				echo validation_errors();
			}
		}
		
		$this->viewdata["cust_id"] = $cust_id;	
		$this->viewdata["cust_name"] = $this->OrderModel->get_customer_name($cust_id);
		$this->viewdata["price_id"] = $price_id;
		$this->viewdata["price"] = $this->OrderModel->get_setprice_detail($price_id);
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/edit_cust_price',$this->viewdata);
	}
	
	
	/***
	 * Get Set Price List
	 */
	public function get_setprice_list($cust_id,$p=0) {
		$this->load->library("pagination");
		$this->load->model("OrderModel");
		
		if($this->input->post('price_delbtn')) {
			$data = $this->input->post();
			foreach($data["chkbox"] as $d) {
				//echo debug($d);
				$this->OrderModel->delete_setprice($d);
			}
			if($this->OrderModel->is_error==1) {
				//echo $this->MasterModel->error_message;
				$this->session->set_flashdata("error",$this->OrderModel->error_message);
				//$this->session->unset_flashdata("message");
			}
			else {
				//$this->session->unset_flashdata("error");
				$this->session->set_flashdata("message",$this->OrderModel->message);
			}
			redirect('customer/price/list/'.$cust_id);
			
		}
		
		$limit = $this->siteconfig[2]["option_value"]; 
		//echo debug($this->siteconfig);
		$config['base_url'] 	= site_url('region/list');
		$config['total_rows'] 	= $this->OrderModel->get_setprice_count($itm);
		$config['per_page'] 	= $limit;
		$config['uri_segment'] 	= 5;
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
		
		$this->viewdata["cust_id"] = $cust_id;	
		$this->viewdata["cust_name"] = $this->OrderModel->get_customer_name($cust_id);
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["pricelist"] = $this->OrderModel->get_setprice_list($itm,$p,$limit);
		//echo debug($this->viewdata["pricelist"]);
		$this->load->view('masters/get_custprice_list',$this->viewdata);
	}
	
	/*** Region ***/
	/***
	 * Add Region
	 */
	public function add_region() {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("addbtn")) {
			$this->form_validation->set_rules('region_name', 'Region Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('region_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
                $this->MasterModel->add_region($data);   
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
				redirect('region/add');
			}
		}
			
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/add_region',$this->viewdata);
	}
	
	/***
	 * Edit Region
	 */
	public function edit_region($id) {
		$this->load->library("form_validation");
		//echo debug($this->siteconfig[1]["option_value"]);
		$this->load->model("MasterModel");
		if($this->input->post("editbtn")) {
			$this->form_validation->set_rules('region_name', 'Region Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('region_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
				$data["region_id"] = $id;
                $this->MasterModel->edit_region($data);   
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
				redirect('region/edit/'.$id);
			}
		}
			
		$this->viewdata["region_id"] = $id;
		$this->viewdata["region"] = $this->MasterModel->get_region_detail($id);
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/edit_region',$this->viewdata);
	}
	
	
	/***
	 * Get Region List
	 */
	public function get_regions_list($p=0) {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		
		if($this->input->post('region_delbtn')) {
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
			redirect('region/list');
			
		}
		
		$limit = $this->siteconfig[2]["option_value"]; 
		//echo debug($this->siteconfig);
		$config['base_url'] 	= site_url('region/list');
		$config['total_rows'] 	= $this->MasterModel->get_region_count($itm);
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
		$this->viewdata["regionlist"] = $this->MasterModel->get_region_list($itm,$p,$limit);
		//echo debug($this->viewdata["regionlist"]);
		$this->load->view('masters/get_region_list',$this->viewdata);
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
		
		$limit = $this->siteconfig[2]["option_value"]; 
		
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
			$this->form_validation->set_rules('unit_id', 'Unit', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_price', 'Price', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('product_disc', 'Discount', 'trim|xss_clean');
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
		$this->viewdata["unitlist"] = $this->MasterModel->get_unit();
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
			$this->form_validation->set_rules('unit_id', 'Unit', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_price', 'Price', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('product_disc', 'Discount', 'trim|xss_clean');
			
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
		$this->viewdata["unitlist"] = $this->MasterModel->get_unit();
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
		
		$limit = $this->siteconfig[2]["option_value"]; 
		
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
		
		$limit = $this->siteconfig[2]["option_value"]; 
		
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
		$this->load->model("MasterModel");
		if($this->input->post("addbtn")) {
			
			$this->form_validation->set_rules('cust_regdate', 'Register Date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_type', 'Customer Type', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_npwp', 'NPWP Number', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_fullname', 'Contact Person', 'required|trim|xss_clean');
            $this->form_validation->set_rules('cust_address', 'Customer Address', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_city', 'Customer City', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_state', 'Customer State', 'required|trim|xss_clean');
			$this->form_validation->set_rules('region_id', 'Region', 'required|trim|xss_clean');
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
		$this->viewdata["regionlist"] = $this->MasterModel->get_region();
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
			$this->form_validation->set_rules('cust_npwp', 'NPWP Number', 'required|trim|xss_clean');	
			$this->form_validation->set_rules('cust_fullname', 'Contact Person', 'required|trim|xss_clean');
            $this->form_validation->set_rules('cust_address', 'Customer Address', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_city', 'Customer City', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_state', 'Customer State', 'required|trim|xss_clean');
			$this->form_validation->set_rules('region_id', 'Region', 'required|trim|xss_clean');
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
		$this->viewdata["regionlist"] = $this->MasterModel->get_region();
		$this->viewdata["cust"] = $this->MasterModel->get_customer_detail($id);
		$this->load->view('masters/edit_customer',$this->viewdata);
	}
	
	/***
	 * Get Customer List
	 */
	public function get_customers_list($p=0) {
		$this->load->library("pagination");
		$this->load->model("MasterModel");
		$this->load->model("OrderModel");
		//echo debug($this->input->post());
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
		
		$limit = $this->siteconfig[2]["option_value"]; 
		
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