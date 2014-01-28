<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterModel extends CI_Model {
    var $is_error = 0;
    var $error_message = "";
    var $message = "";
	
	/*** Category ***/
	/***
	 * Add Category
	 */
	public function add_category($data) {
		$d = array (
			"category_name" 		=> $data["category_name"],
			"category_desc" 		=> $data["category_desc"],
		);
		$this->db->insert("category",$d);
		$this->is_error = 0;
        $this->message = "Category has been added successfully";
        $this->error_message = "";
	}
	
	/***
	 * Edit Category
	 */
	public function edit_category($data) {
		$this->db->where('category_id',$data['category_id']);
		$d = array (
			"category_name" 		=> $data["category_name"],
			"category_desc" 		=> $data["category_desc"],
		);
		$this->db->update("category",$d);
		$this->is_error = 0;
        $this->message = "Category has been updated successfully";
        $this->error_message = "";
	}
	
	/***
	 * Get Category List
	 */
	public function get_category_list($itm="",$p=0,$limit=10) {
		if($itm) {
			$this->db->where("category_name LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$r = $this->db->get('category'); 
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Category detail
	 */
	public function get_category_detail($data) {
		$this->db->where("category_id",$data);
		$r = $this->db->get('category'); 
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get customers Count
	 */
	public function get_category_count($itm="") {
		if($itm) {
			$where =" WHERE category_name LIKE '%".$itm."%'";
		}
		return $this->db->count_all('category '.$where);
	}
	
	/***
	 * Delete Category
	 */
	public function delete_category($data) {
		$this->db->where('category_id',$data);
		$this->db->delete("category",$d);
		$this->is_error = 0;
        $this->message = "Category has been deleted successfully";
        $this->error_message = "";
	}

	
	/*** Customer ***/
	
	/***
	 * Get customers list
	 */
	public function get_customers_list($itm="",$p=0,$limit=10) {
		if($itm) {
			$this->db->where("cust_fullname LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$r = $this->db->get('customers'); 
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get customers detail
	 */
	public function get_customer_detail($id) {
		$this->db->where("cust_id",$id);
		$r = $this->db->get('customers'); 
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get customers Count
	 */
	public function get_customers_count($itm="") {
		if($itm) {
			$where =" WHERE cust_fullname LIKE '%".$itm."%'";
		}
		return $this->db->count_all('customers '.$where);
	}
	
	/***
	 * Add Customer
	 */
	public function add_customer($data) {
		if($data["cust_regdate"]) {
			$tmp = new DateTime($data["cust_regdate"]);
			$data["cust_regdate"] = $tmp->format("Y-m-d");
		}
		
		$d = array (
			"cust_regdate" 			=> $data["cust_regdate"],
			"cust_fullname" 		=> $data["cust_fullname"],
			"cust_address" 			=> $data["cust_address"],
			"cust_city" 			=> $data["cust_city"],
			"cust_state" 			=> $data["cust_state"],
			"cust_phonenumber" 		=> $data["cust_phonenumber"],
			"cust_faxnumber" 		=> $data["cust_faxnumber"],
			"cust_mobilenumber" 	=> $data["cust_mobilenumber"],
			"cust_emailaddress" 	=> $data["cust_emailaddress"],
		);
		$this->db->insert("customers",$d);
		$this->is_error = 0;
        $this->message = "Customer has been added successfully";
        $this->error_message = "";
	}
	
	/***
	 * Edit Customer
	 */
	public function edit_customer($data) {
		$this->db->where('cust_id',$data["cust_id"]);
		$d = array (
			"cust_fullname" 		=> $data["cust_fullname"],
			"cust_address" 			=> $data["cust_address"],
			"cust_city" 			=> $data["cust_city"],
			"cust_state" 			=> $data["cust_state"],
			"cust_phonenumber" 		=> $data["cust_phonenumber"],
			"cust_faxnumber" 		=> $data["cust_faxnumber"],
			"cust_mobilenumber" 	=> $data["cust_mobilenumber"],
			"cust_emailaddress" 	=> $data["cust_emailaddress"],
		);
		//echo debug($d);
		$this->db->update("customers",$d);
		$this->is_error = 0;
        $this->message = "Customer has been updated successfully";
        $this->error_message = "";
	}
	
	/***
	 * Delete Customer
	 */
	public function delete_customer($data) {
		$this->db->where('cust_id',$data);
		$this->db->delete("customers",$d);
		$this->is_error = 0;
        $this->message = "Customer has been deleted successfully";
        $this->error_message = "";
	}
}