<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OptionModel extends CI_Model {
    var $is_error = 0;
    var $error_message = "";
    var $message = "";
	
	/***
	 * Get Configuration
	 */
	public function get_config_all() {
		return $this->db->get('configuration')->result_array(); 
	}	
}