<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class Po_Controller extends App_Controller {
	
	public function index()
	{
		//$this->load->view('users/login');
	}
	
	/*** PO Detail ***/
	/***
	 * Add PO Detail
	 */
	public function add_po_detail($po_id) {
		$this->load->model("PoModel");
		$this->load->model("MasterModel");
		$this->load->library('form_validation');
		if($this->input->post("addbtn")) { 
			$this->form_validation->set_rules('product_id', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|xss_clean');
			$this->form_validation->set_rules('qty', 'Quantity', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('unit_id', 'Unit', 'required|trim|xss_clean');
			$this->form_validation->set_rules('unit_name', 'Unit', 'trim|xss_clean');
			$this->form_validation->set_rules('price', 'Price', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('disc', 'Discount', 'required|trim|decimal|xss_clean');
		
			if ($this->form_validation->run() == TRUE) {
				$data = $this->input->post(); 
				$data["po_id"] = $po_id;
				$this->PoModel->add_podetail($data);	
				$this->viewdata["is_error"] = $this->PoModel->is_error;
                if($this->PoModel->is_error==1) {
                    //echo $this->MasterModel->error_message;
                    $this->session->set_flashdata("error",$this->PoModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->PoModel->message);
                }
				redirect('po/detail/add/'.$po_id);
			}
		}
		
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);
		
		$this->viewdata["po_id"] = $po_id;	
		$this->viewdata["po_no"] = $this->PoModel->get_po_num($po_id);	
		$this->viewdata["unitlist"] = $this->MasterModel->get_unit();	
		$this->viewdata["formatdate"] = $tmp;	
		$this->load->view('po/add_po_detail',$this->viewdata);
	}
	
	/***
	 * Edit PO Detail
	 */
	public function edit_po_detail($po_id,$detail_id) {
		$this->load->model("PoModel");
		$this->load->model("MasterModel");
		$this->load->library('form_validation');
		if($this->input->post("editbtn")) { 
			$this->form_validation->set_rules('product_id', 'Product Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('product_name', 'Product Name', 'trim|xss_clean');
			$this->form_validation->set_rules('qty', 'Quantity', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('unit_id', 'Unit', 'required|trim|xss_clean');
			$this->form_validation->set_rules('unit_name', 'Unit', 'trim|xss_clean');
			$this->form_validation->set_rules('price', 'Price', 'required|trim|integer|xss_clean');
			$this->form_validation->set_rules('disc', 'Discount', 'required|trim|decimal|xss_clean');
		
			if ($this->form_validation->run() == TRUE) {
				$data = $this->input->post(); 
				$data["po_id"] = $po_id;
				$data["detail_id"] = $detail_id;
				$this->PoModel->edit_podetail($data);	
				$this->viewdata["is_error"] = $this->PoModel->is_error;
                if($this->PoModel->is_error==1) {
                    //echo $this->MasterModel->error_message;
                    $this->session->set_flashdata("error",$this->PoModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->PoModel->message);
                }
				redirect('po/detail/edit/'.$po_id."/".$detail_id);
			}
		}
		
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);
		
		$this->viewdata["po_id"] = $po_id;	
		$this->viewdata["detail_id"] = $detail_id;	
		$this->viewdata["po_no"] = $this->PoModel->get_po_num($po_id);	
		$this->viewdata["po"] = $this->PoModel->get_podetail_detail($detail_id);
		//echo debug($this->viewdata["po"]);
		$this->viewdata["unitlist"] = $this->MasterModel->get_unit();	
		$this->viewdata["formatdate"] = $tmp;	
		$this->load->view('po/edit_po_detail',$this->viewdata);
	}
	
	/***
	 * Get PO Detail List
	 */
	public function get_podetail_list($po_id,$p=0) {
		$this->load->library('form_validation');
		$this->load->library("pagination");
		$this->load->model("PoModel");
		
		$itm = $this->input->post("itm");
		if($this->input->post('po_delbtn')) {
			$data = $this->input->post();
			foreach($data["chkbox"] as $d) {
				//echo debug($d);
				$this->PoModel->delete_po($d);
			}
			if($this->PoModel->is_error==1) {
				//echo $this->MasterModel->error_message;
				$this->session->set_flashdata("error",$this->PoModel->error_message);
				//$this->session->unset_flashdata("message");
			}
			else {
				//$this->session->unset_flashdata("error");
				$this->session->set_flashdata("message",$this->PoModel->message);
			}
			redirect('po/list');
			
		}
		
		$limit = $this->siteconfig[2]["option_value"]; 
		
		$config['base_url'] 	= site_url('po/detail/list/'.$po_id);
		$config['total_rows'] 	= $this->PoModel->get_podetail_count($po_id,$itm);
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
		
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);
		
		$this->viewdata["po_id"] = $po_id;	
		$this->viewdata["po_no"] = $this->PoModel->get_po_num($po_id);		
		$this->viewdata["formatdate"] = $tmp;
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["podetaillist"] = $this->PoModel->get_podetail_list($po_id,$itm,$p,$limit);
		$this->load->view('po/get_podetail_list',$this->viewdata);
	}
	
	/*** PO ***/
	/***
	 * Add PO
	 */
	public function add_po() {
		$this->load->model("PoModel");
		$this->load->library('form_validation');
		if($this->input->post("addbtn")) { 
			$this->form_validation->set_rules('po_date', 'PO Date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('po_no', 'New Password', 'required|trim|is_unique[po.po_no]|xss_clean');
			$this->form_validation->set_rules('cust_id', 'Customer Full Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_name', 'Customer Full Name', 'trim|xss_clean');
			$this->form_validation->set_rules('ship_id', 'Shipping', 'required|trim|xss_clean');
			$this->form_validation->set_rules('ship_name', 'Shipping Name', 'trim|xss_clean');
		
			if ($this->form_validation->run() == TRUE) {
				$data = $this->input->post(); 
				$this->PoModel->add_po($data);	
				$this->viewdata["is_error"] = $this->PoModel->is_error;
                if($this->PoModel->is_error==1) {
                    //echo $this->MasterModel->error_message;
                    $this->session->set_flashdata("error",$this->PoModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->PoModel->message);
                }
				redirect('po/add');
			}
		
		}
		
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);
		$this->viewdata["formatdate"] = $tmp;	
		$this->load->view('po/add_po',$this->viewdata);
	}
	
	/***
	 * Edit PO
	 */
	public function edit_po($id) {
		$this->load->model("PoModel");
		$this->load->library('form_validation');
		if($this->input->post("editbtn")) { 
			$this->form_validation->set_rules('po_date', 'PO Date', 'required|trim|xss_clean');
			$this->form_validation->set_rules('po_no', 'New Password', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_id', 'Customer Full Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('cust_name', 'Customer Full Name', 'trim|xss_clean');
			$this->form_validation->set_rules('ship_id', 'Shipping', 'required|trim|xss_clean');
			$this->form_validation->set_rules('ship_name', 'Shipping Name', 'trim|xss_clean');
		
			if ($this->form_validation->run() == TRUE) {
				$data = $this->input->post(); 
				$data["po_id"] = $id;
				$this->PoModel->edit_po($data);	
				$this->viewdata["is_error"] = $this->PoModel->is_error;
                if($this->PoModel->is_error==1) {
                    //echo $this->MasterModel->error_message;
                    $this->session->set_flashdata("error",$this->PoModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->PoModel->message);
                }
				redirect('po/edit/'.$id);
			}
		
		}
		
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);
		$this->viewdata["po"] = $this->PoModel->get_po_detail($id);		
		$this->viewdata["po_id"] = $id;
		$this->viewdata["formatdate"] = $tmp;	
		$this->load->view('po/edit_po',$this->viewdata);
	}
	
	/***
	 * Get PO List
	 */
	public function get_po_list($p=0) {
		$this->load->library('form_validation');
		$this->load->library("pagination");
		$this->load->model("PoModel");
		
		$itm = $this->input->post("itm");
		if($this->input->post('po_delbtn')) {
			$data = $this->input->post();
			foreach($data["chkbox"] as $d) {
				//echo debug($d);
				$this->PoModel->delete_po($d);
			}
			if($this->PoModel->is_error==1) {
				//echo $this->MasterModel->error_message;
				$this->session->set_flashdata("error",$this->PoModel->error_message);
				//$this->session->unset_flashdata("message");
			}
			else {
				//$this->session->unset_flashdata("error");
				$this->session->set_flashdata("message",$this->PoModel->message);
			}
			redirect('po/list');
			
		}
		
		$limit = $this->siteconfig[2]["option_value"]; 
		
		$config['base_url'] 	= site_url('po/list');
		$config['total_rows'] 	= $this->PoModel->get_po_count($itm);
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
		
		if ($this->siteconfig[1]["option_value"]=="M d Y H:i:s")
			$tmp = substr($this->siteconfig[1]["option_value"],0,7);
		else
			$tmp = substr($this->siteconfig[1]["option_value"],0,6);
		$this->viewdata["formatdate"] = $tmp;
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["polist"] = $this->PoModel->get_po_list($itm,$p,$limit);
		$this->load->view('po/get_po_list',$this->viewdata);
	}
	
	/*** Browse ***/
	/***
	 * Customer
	 */
	public function get_cust_browse($p=0) {
		$this->load->model('MasterModel');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$itm = $this->input->post("itm");
		$p=(!$p)?0:$p;
		
		$limit = $this->siteconfig[2]["option_value"]; 
		
		$config['base_url'] 	= site_url('browse/customers');
		$config['total_rows'] 	= $this->MasterModel->get_customers_count($itm);
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
		
		$limit = $this->siteconfig[2]["option_value"]; 
		$r = $this->MasterModel->get_customers_all($itm,$p,$limit);
		$this->viewdata["page_link"] = $this->pagination->create_links();
		$this->viewdata["custlist"] = $r;
		$this->load->view("po/browse_customer",$this->viewdata);
	}	
	
	/***
	 * Shipping
	 */
	public function get_ship_browse($p=0) {
		$this->load->model('MasterModel');
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$itm = $this->input->post("itm");
		$p=(!$p)?0:$p;
		
		$limit = $this->siteconfig[2]["option_value"]; 
		
		$config['base_url'] 	= site_url('browse/customers');
		$config['total_rows'] 	= $this->MasterModel->get_customers_count($itm);
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
		$r = $this->MasterModel->get_shipper_all($itm,$p,$limit);
		$this->viewdata["shiplist"] = $r;
		$this->load->view("po/browse_ship",$this->viewdata);
	}
}	