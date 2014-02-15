<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PoModel extends CI_Model {
    var $is_error = 0;
    var $error_message = "";
    var $message = "";
	
	/***
	 * Add PO
	 */
	public function add_po($data) {
		$this->db->insert('po',$data);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="PO has been added successfully";
		
	}	
	
	/***
	 * Edit PO
	 */
	public function update_po($data) {
		$this->db->where('po_id',$data["po_id"]);
		$d = array(
			
		)
		$this->db->update('po',$data);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="PO has been updated successfully";
		
	}	
}	