<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterModel extends CI_Model {
    var $is_error = 0;
    var $error_message = "";
    var $message = "";
	
	/*** Customer ***/
	
	/***
	 * Get customers list
	 */
	public function get_customers_list() {
		$r = $this->db->get('customers'); 
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Configuration
	 */
	public function get_config_detail() {
		$this->db->order_by('urut');
		return $this->db->get('configuration')->result_array(); 
	}
	
	/***
	 * Update Configuration
	 */
	public function update_config($data) {
		$this->db->where('option_name',$data["option_name"]);
		$d = array (
			"option_value" => $data["option_value"]
		);
		$this->db->update("configuration",$d);
		$this->is_error = 0;
        $this->message = "Settings has been changed successfully";
        $this->error_message = "";
	}
}