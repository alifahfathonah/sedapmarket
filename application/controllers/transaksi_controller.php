<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class Transaksi_Controller extends App_Controller {
	
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
		$this->load->model("TranscationModel");
		if($this->input->post("addbtn")) {
			$this->form_validation->set_rules('unit_name', 'Unit Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('unit_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
                $this->TranscationModel->add_unit($data);   
                $this->viewdata["is_error"] = $this->TranscationModel->is_error;
                if($this->TranscationModel->is_error==1) {
                    //echo $this->TranscationModel->error_message;
                    $this->session->set_flashdata("error",$this->TranscationModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->TranscationModel->message);
                }
				redirect('transaksi/add');
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
		$this->load->model("TranscationModel");
		if($this->input->post("editbtn")) {
			$this->form_validation->set_rules('unit_name', 'Unit Name', 'required|trim|xss_clean');
			$this->form_validation->set_rules('unit_desc', 'Description', 'trim|xss_clean');
			
			if ($this->form_validation->run() == TRUE)
            {
				$data = $this->input->post();
				$data["unit_id"] = $id;
                $this->TranscationModel->edit_unit($data);   
                $this->viewdata["is_error"] = $this->TranscationModel->is_error;
                if($this->TranscationModel->is_error==1) {
                    //echo $this->TranscationModel->error_message;
                    $this->session->set_flashdata("error",$this->TranscationModel->error_message);
                    //$this->session->unset_flashdata("message");
                }
                else {
                    //$this->session->unset_flashdata("error");
                    $this->session->set_flashdata("message",$this->TranscationModel->message);
                }
				redirect('transaksi/edit/'.$id);
			}
		}
			
		$this->viewdata["unit_id"] = $id;
		$this->viewdata["unit"] = $this->TranscationModel->get_unit_detail($id);
		//echo debug($this->viewdata["catlist"]);
		$this->load->view('masters/edit_unit',$this->viewdata);
	}
	
	
	/***
	 * Get Unit List
	 */
	public function get_units_list($p=0) {
		$this->load->library("pagination");
		$this->load->model("TranscationModel");
		
		if($this->input->post('unit_delbtn')) {
			$data = $this->input->post();
			foreach($data["chkbox"] as $d) {
				//echo debug($d);
				$this->TranscationModel->delete_unit($d);
			}
			if($this->TranscationModel->is_error==1) {
				//echo $this->TranscationModel->error_message;
				$this->session->set_flashdata("error",$this->TranscationModel->error_message);
				//$this->session->unset_flashdata("message");
			}
			else {
				//$this->session->unset_flashdata("error");
				$this->session->set_flashdata("message",$this->TranscationModel->message);
			}
			redirect('transaksi/list');
			
		}
		
		$limit = $this->siteconfig[3]["value"]; 
		
		$config['base_url'] 	= site_url('transaksi/list');
		$config['total_rows'] 	= $this->TranscationModel->get_unit_count($itm);
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
		$this->viewdata["unitlist"] = $this->TranscationModel->get_unit_list($itm,$p,$limit);
		$this->load->view('masters/get_unit_list',$this->viewdata);
	}
	
	
	
}	