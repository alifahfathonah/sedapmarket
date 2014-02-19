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
	public function get_setprice_list($itm="",$p=0,$limit=10) {
		if($itm) {
			$this->db->where("b.product_name LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$this->db->select("a.*,b.product_name");
		$this->db->from("customer_price a");
		$this->db->join("products b","b.product_id=a.product_id");
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
			$where =" WHERE b.product_name LIKE '%".$itm."%'";
		}
		return $this->db->count_all('customer_price a INNER JOIN products b ON b.product_id=a.product_id '.$where);
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
	
	/***
	 * Get Set Price Count
	 */
	public function get_setprice_count2($cust_id) {
		return $this->db->count_all("customer_price WHERE cust_id='".$cust_id."'");
		
	}
	
	/*** Transcation ***/
	
	/***
	 * Add transcation
	 */
	public function add_transcation($data) {
		$d = array (
			"trans_date" 		=> $data["trans_date"],
			"no_sj" 			=> $data["no_sj"],
			"no_mobil" 			=> $data["no_mobil"],
			"no_container" 		=> $data["no_container"],
			"no_seal" 			=> $data["no_seal"],
		);
		$this->db->insert("customer_price",$d);
		$this->is_error = 0;
        $this->message = "Transcation has been added successfully";
        $this->error_message = "";
	}
	
	/***
	 * Edit transcation
	 */
	public function edit_transcation($data) {
		$this->db->where('transcation_id',$data['transcation_id']);
		$d = array (
			"trans_date" 		=> $data["trans_date"],
			"no_sj" 			=> $data["no_sj"],
			"no_mobil" 			=> $data["no_mobil"],
			"no_container" 		=> $data["no_container"],
			"no_seal" 			=> $data["no_seal"],
		);
		$this->db->update("customer_price",$d);
		$this->is_error = 0;
        $this->message = "Set Price has been updated successfully";
        $this->error_message = "";
	}
	
	/***
	 * Get Transcation List
	 */
	public function get_transcation_list($p=0,$limit=10) {
		if($itm) {
			$this->db->where("no_sj LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$this->db->select("*");
		$this->db->from("transcation");
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
	 * Get Transcation Count
	 */
	public function get_transcation_count($itm="") {
		if($itm) {
			$where =" WHERE no_sj LIKE '%".$itm."%'";
		}
		return $this->db->count_all('transcation '.$where);
	}
	
	/***
	 * Delete Transcation
	 */
	public function delete_transcation($data) {
		$this->db->where('transcation_id',$data);
		$this->db->delete("transcation",$d);
		$this->is_error = 0;
        $this->message = "Transcation has been deleted successfully";
        $this->error_message = "";
	}

	/***
	 * Get Transcation detail
	 */
	public function get_transcation_detail($data) {
		$this->db->where("transcation_id",$data);
		$this->db->select("*");
		$this->db->from("transcation");
		$r = $this->db->get(); 
		
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Transcation Count
	 */
	public function get_transcation_count2($transcation_id) {
		return $this->db->count_all("transcation WHERE transcation_id='".$transcation_id."'");
		
	}
}	