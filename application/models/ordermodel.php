<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OrderModel extends CI_Model {
    var $is_error = 0;
    var $error_message = "";
    var $message = "";
	
	/*** Set Price each customer ***/
	
	/***
	 * Add Set Price
	 */
	public function add_set_price($data) {
		$d = array (
			"cust_id" 			=> $data["cust_id"],
			"product_id" 		=> $data["product_id"],
			"price" 			=> $data["price"],
			"disc1" 			=> $data["disc1"],
			"disc2" 			=> $data["disc2"],
			"disc3" 			=> $data["disc3"],
			"price_desc"		=> $data["price_desc"],
		);
		$this->db->insert("customer_price",$d);
		$this->is_error = 0;
        $this->message = "Set Price has been added successfully";
        $this->error_message = "";
	}
	
	/***
	 * Edit Set Price
	 */
	public function edit_set_price($data) {
		$this->db->where('price_id',$data['price_id']);
		$d = array (
			"product_id" 		=> $data["product_id"],
			"price" 			=> $data["price"],
			"disc1" 			=> $data["disc1"],
			"disc2" 			=> $data["disc2"],
			"disc3" 			=> $data["disc3"],
			"price_desc"		=> $data["price_desc"],
		);
		$this->db->update("customer_price",$d);
		$this->is_error = 0;
        $this->message = "Set Price has been updated successfully";
        $this->error_message = "";
	}
	
	/***
	 * Get Customer Name
	 */
	public function get_customer_name($cust_id) {
		$this->db->where("cust_id",$cust_id);
		
		$this->db->select("cust_fullname");
		$this->db->from("customers");
		$r = $this->db->get(); 
		//echo debug($this->db->queries);
		if($r) {
			$tmp = $r->row_array();
			return $tmp["cust_fullname"];
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Set Price List
	 */
	public function get_setprice_list($p=0,$limit=10) {
		if($itm) {
			$this->db->where("product_name LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$this->db->select("a.*,b.product_name");
		$this->db->from("customer_price a");
		$this->db->join("products b","b.product_id=a.product_id","left");
		$r = $this->db->get(); 
		//echo debug($this->db->queries);
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Set Price Count
	 */
	public function get_setprice_count($itm="") {
		if($itm) {
			$where =" WHERE product_name LIKE '%".$itm."%'";
		}
		return $this->db->count_all('customer_price '.$where);
	}
	
	/***
	 * Delete Set Price
	 */
	public function delete_setprice($data) {
		$this->db->where('price_id',$data);
		$this->db->delete("customer_price",$d);
		$this->is_error = 0;
        $this->message = "Set Price has been deleted successfully";
        $this->error_message = "";
	}

	/***
	 * Get Set Price detail
	 */
	public function get_setprice_detail($data) {
		$this->db->where("price_id",$data);
		$this->db->select("a.*,b.product_name");
		$this->db->from("customer_price a");
		$this->db->join("products b","b.product_id=a.product_id","left");
		$r = $this->db->get(); 
		
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
}	