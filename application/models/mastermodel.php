<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MasterModel extends CI_Model {
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
	 * Get Set Price List
	 */
	public function get_setprice_list($itm="",$p=0,$limit=10) {
		if($itm) {
			$this->db->where("product_name LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$r = $this->db->get('customer_price'); 
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
		$r = $this->db->get('region'); 
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	
	/*** Region ***/
	
	/***
	 * Add Region
	 */
	public function add_region($data) {
		$d = array (
			"region_name" 		=> $data["region_name"],
			"region_desc" 		=> $data["region_desc"],
		);
		$this->db->insert("region",$d);
		$this->is_error = 0;
        $this->message = "Region has been added successfully";
        $this->error_message = "";
	}
	
	/***
	 * Edit Region
	 */
	public function edit_region($data) {
		$this->db->where('region_id',$data['region_id']);
		$d = array (
			"region_name" 			=> $data["region_name"],
			"region_desc" 			=> $data["region_desc"],
		);
		$this->db->update("region",$d);
		$this->is_error = 0;
        $this->message = "Region has been updated successfully";
        $this->error_message = "";
	}
	
	
	/***
	 * Get Region List
	 */
	public function get_region_list($itm="",$p=0,$limit=10) {
		if($itm) {
			$this->db->where("region_name LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$r = $this->db->get('region'); 
		//echo debug($this->db->queries);
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Region Count
	 */
	public function get_region_count($itm="") {
		if($itm) {
			$where =" WHERE region_name LIKE '%".$itm."%'";
		}
		return $this->db->count_all('region '.$where);
	}
	
	/***
	 * Delete Region
	 */
	public function delete_region($data) {
		$this->db->where('region_id',$data);
		$this->db->delete("region",$d);
		$this->is_error = 0;
        $this->message = "Region has been deleted successfully";
        $this->error_message = "";
	}

	/***
	 * Get Region detail
	 */
	public function get_region_detail($data) {
		$this->db->where("region_id",$data);
		$r = $this->db->get('region'); 
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Region Into form
	 */
	public function get_region() {
		$r = $this->db->get('region'); 
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
	}
	
	/*** Products ***/
	
	/***
	 * Add Product
	 */
	public function add_product($data) {
		$d = array (
			"category_id" 		=> $data["category_id"],
			"product_name" 		=> $data["product_name"],
			"product_kemasan" 	=> $data["product_kemasan"],
			"product_stock" 	=> $data["product_stock"],
			"unit_id" 			=> $data["unit_id"],
			"product_price" 	=> $data["product_price"],
			"product_disc" 		=> $data["product_disc"],
		);
		$this->db->insert("products",$d);
		$this->is_error = 0;
        $this->message = "Product has been added successfully";
        $this->error_message = "";
	}
	
	/***
	 * Edit Product
	 */
	public function edit_product($data) {
		$d = array (
			"category_id" 		=> $data["category_id"],
			"product_name" 		=> $data["product_name"],
			"product_kemasan" 	=> $data["product_kemasan"],
			"product_stock" 	=> $data["product_stock"],
			"unit_id" 			=> $data["unit_id"],
			"product_price" 	=> $data["product_price"],
			"product_disc" 		=> $data["product_disc"],
		);
		$this->db->update("products",$d);
		$this->is_error = 0;
        $this->message = "Product has been updated successfully";
        $this->error_message = "";
	}
	
	/***
	 * Get Products List
	 */
	public function get_products_list($itm="",$p=0,$limit=10) {
		if($itm) {
			$this->db->where("product_name LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$this->db->select('a.*,b.category_name, c.unit_name'); 
		$this->db->from('products a'); 
		$this->db->join('category b','b.category_id = a.category_id','left'); 
		$this->db->join('unit c','c.unit_id = a.unit_id','left'); 
		$r = $this->db->get(); 
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Products List
	 */
	public function get_product_detail($data) {
		$this->db->where('a.product_id',$data);
		$this->db->select('a.*, b.category_name, c.unit_id');
		$this->db->from('products a');
		$this->db->join('category b','b.category_id=a.category_id','left');
		$this->db->join('unit c','c.unit_id = a.unit_id','left'); 
		$r = $this->db->get(); 
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Product Count
	 */
	public function get_product_count($itm="") {
		if($itm) {
			$where =" WHERE product_name LIKE '%".$itm."%'";
		}
		return $this->db->count_all('products '.$where);
	}
	
	/***
	 * Delete products
	 */
	public function delete_product($data) {
		$this->db->where('product_id',$data);
		$this->db->delete("products",$d);
		$this->is_error = 0;
        $this->message = "Product has been deleted successfully";
        $this->error_message = "";
	}
	
	/*** Unit ***/
	
	/***
	 * Add Unit
	 */
	public function add_unit($data) {
		$d = array (
			"unit_name" 		=> $data["unit_name"],
			"unit_desc" 		=> $data["unit_desc"],
		);
		$this->db->insert("unit",$d);
		$this->is_error = 0;
        $this->message = "Unit has been added successfully";
        $this->error_message = "";
	}
	
	/***
	 * Edit Unit
	 */
	public function edit_unit($data) {
		$this->db->where('unit_id',$data['unit_id']);
		$d = array (
			"unit_name" 			=> $data["unit_name"],
			"unit_desc" 			=> $data["unit_desc"],
		);
		$this->db->update("unit",$d);
		$this->is_error = 0;
        $this->message = "Unit has been updated successfully";
        $this->error_message = "";
	}
	
	
	/***
	 * Get Unit List
	 */
	public function get_unit_list($itm="",$p=0,$limit=10) {
		if($itm) {
			$this->db->where("unit_name LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$r = $this->db->get('unit'); 
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Unit Count
	 */
	public function get_unit_count($itm="") {
		if($itm) {
			$where =" WHERE unit_name LIKE '%".$itm."%'";
		}
		return $this->db->count_all('unit '.$where);
	}
	
	/***
	 * Delete Unit
	 */
	public function delete_unit($data) {
		$this->db->where('unit_id',$data);
		$this->db->delete("unit",$d);
		$this->is_error = 0;
        $this->message = "Unit has been deleted successfully";
        $this->error_message = "";
	}

	/***
	 * Get Unit detail
	 */
	public function get_unit_detail($data) {
		$this->db->where("unit_id",$data);
		$r = $this->db->get('unit'); 
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Get Unit Into form
	 */
	public function get_unit() {
		$r = $this->db->get('unit'); 
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
	}
	
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
	 * Get Category Into form
	 */
	public function get_category() {
		$r = $this->db->get('category'); 
		if($r) {
			return $r->result_array();
		}
		else {
			return false;
		}
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
	 * Get Category Count
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
		$this->db->select("a.*, b.region_name");
		$this->db->from('customers a'); 
		$this->db->join('region b','a.region_id=b.region_id','left'); 
		$r = $this->db->get(); 
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
		$this->db->select("a.*, b.region_name");
		$this->db->from('customers a'); 
		$this->db->join('region b','a.region_id=b.region_id','left'); 
		$r = $this->db->get(); 
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
			"cust_type" 			=> $data["cust_type"],
			"cust_npwp" 			=> $data["cust_npwp"],
			"cust_regdate" 			=> $data["cust_regdate"],
			"cust_fullname" 		=> $data["cust_fullname"],
			"cust_address" 			=> $data["cust_address"],
			"cust_city" 			=> $data["cust_city"],
			"cust_state" 			=> $data["cust_state"],
			"region_id" 			=> $data["region_id"],
			"cust_payby" 			=> $data["cust_payby"],
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
			"cust_type" 			=> $data["cust_type"],
			"cust_npwp" 			=> $data["cust_npwp"],
			"cust_fullname" 		=> $data["cust_fullname"],
			"cust_address" 			=> $data["cust_address"],
			"cust_city" 			=> $data["cust_city"],
			"cust_state" 			=> $data["cust_state"],
			"region_id" 			=> $data["region_id"],
			"cust_payby" 			=> $data["cust_payby"],
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