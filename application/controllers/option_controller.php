<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH."/controllers/app_controller.php";
class Option_Controller extends App_Controller {
	
	public function index()
	{
		//$this->load->view('users/login');
	}
	
	public function edit_setup() {
		$this->load->library('form_validation');
		if($this->input->post("editbtn")) { 
			//$this->form_validation->set_rules('user_name', 'Full Name', 'required|trim|xss_clean');
			//$this->form_validation->set_rules('user_pass', 'New Password', 'trim|min_length[6]|xss_clean');
			//$this->form_validation->set_rules('confpass', 'Confirm Password', 'required|trim|matches[newpass]|xss_clean');
		
			//if ($this->form_validation->run() == TRUE) {
				$tmp = $this->input->post();
				$i=0;
				// echo debug($tmp);
				// exit();
                foreach($tmp["option_name"] as $t) {
				    
					if($t=="LOGO" || $t=="FAVICON") {
						$path = dirname(BASEPATH)."/images";
						/* if($t=="LOGO") {
							$g1= $_FILES["filegmb1"];
							$tmp1 = explode(".",$g1["name"]);
							if($g1["tmp_name"]) {
								$nama_file1 = sha1($tmp1[0]."-".date("dmyHis")).".".$tmp1[1];
								//echo debug($nama_file1);
								move_uploaded_file($g1["tmp_name"],$path."/".$nama_file1);
								$data = array(
									"option_name"	=> $t,
									"option_value"	=> $nama_file1	
								);
							}
							else {
								$data = array(
									"option_name"	=> $t,
									"option_value"	=> $tmp["backfile1"]
								);	
							}
						} */
						
						if($t=="FAVICON") {
							$g2= $_FILES["filegmb2"];
							$tmp2 = explode(".",$g2["name"]);
							if($g2["tmp_name"]) {
								$nama_file2 = sha1($tmp2[0]."-".date("dmyHis")).".".$tmp2[1];
								move_uploaded_file($g2["tmp_name"],$path."/".$nama_file2);				
								$data = array(
									"option_name"	=> $t,
									"option_value"	=> $nama_file2	
								);
							}
							else {
								$data = array(
									"option_name"	=> $t,
									"option_value"	=> $tmp["backfile2"]
								);	
							}
						}	
						//exit();
					}
					else {
						$data = array(
							"option_name"	=> $t,
							"option_value"	=> $tmp["option_value"][$i]	
						);
					}	
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