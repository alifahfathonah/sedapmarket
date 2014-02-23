<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PoModel extends CI_Model {
    var $is_error = 0;
    var $error_message = "";
    var $message = "";
	
	/***
	 * Add Transcation Detail
	 */
	public function add_transdetail($data) {
		$d = array(
			"product_id"			=> $data["product_id"],
			"transcation_id"		=> $data["transcation_id"],
			"qty"					=> $data["qty"],
			"unit_id"				=> $data["unit_id"],
			"product_extra_id"		=> $data["product_extra_id"],
			"qty_extra"				=> $data["qty_extra"],
			"unit_extra_id"			=> $data["unit_extra_id"]
		);
		$this->db->insert('transcation_detail',$d);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="Transcation detail has been added successfully";
		
	}	
	
	/***
	 * Edit Transcation Detail
	 */
	public function edit_transdetail($data) {
		$this->db->where("detail_id",$data["detail_id"]);
		
		$d = array(
			"product_id"			=> $data["product_id"],
			"qty"					=> $data["qty"],
			"unit_id"				=> $data["unit_id"],
			"product_extra_id"		=> $data["product_extra_id"],
			"qty_extra"				=> $data["qty_extra"],
			"unit_extra_id"			=> $data["unit_extra_id"]
		);
		
		$this->db->update('transcation_detail',$d);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="Transcation has been updated successfully";
		
	}	
	
	/***
	 * Delete Transcation
	 */
	public function delete_transdetail($data) {
		$this->db->where("detail_id",$data["detail_id"]);
		
		$this->db->delete('transcation');
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="Transcation has been deleted successfully";
		
	}	
	
	/***
	 * Get Transcation Count
	 */
	public function get_transdetail_count($trans_id,$itm="") {
		$where=" WHERE transcation_id = ".$trans_id;
		if($itm) {
			$where.=" AND (b.product_name LIKE '%".$itm."%')";
		}
		return $this->db->count_all('transcation_detail a LEFT JOIN products b ON b.product_id=a.product_id LEFT JOIN products c ON c.product_id=a.product_extra_id '.$where);
	}
	
	/***
	 * Get transcation detail List
	 */
	public function get_transdetail_list($trans_id,$itm="",$p=0,$limit=10) {
		$this->db->where("a.transcation_id",$trans_id);
		if($itm) {
			$this->db->where("b.product_name LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$this->db->select("a.*, b.product_name,c.unit_name,d.product_name product_extra_name,e.unit_name unit_extra_name");
		$this->db->from("transcation_detail a");
		$this->db->join("products b","b.product_id=a.product_id","left");
		$this->db->join("unit c","c.unit_id=a.unit_id","left");
		$this->db->join("products d","d.product_id=a.product_extra_id","left");
		$this->db->join("unit e","e.unit_id=a.unit_extra_id","left");
		
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
	 * Get transcation detail
	 */
	public function get_transdetail_detail($data) {
		$this->db->where("detail_id", $data);
		
		$this->db->select("a.*, b.product_name,c.unit_name,d.product_name product_extra_name,e.unit_name unit_extra_name");
		$this->db->from("transcation_detail a");
		$this->db->join("products b","b.product_id=a.product_id","left");
		$this->db->join("unit c","c.unit_id=a.unit_id","left");
		$this->db->join("products d","d.product_id=a.product_extra_id","left");
		$this->db->join("unit e","e.unit_id=a.unit_extra_id","left");
		$r = $this->db->get(); 
		//echo debug($this->db->queries);
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	/*** Transcation ***/
	/***
	 * Add Transcation
	 */
	public function add_transcation($data) {
		if($data["trans_date"]) {
			$tmp = new DateTime($data["trans_date"]);
			$data["trans_date"] = $tmp->format("Y-m-d");
		}
		
		$d = array(
			"trans_date"			=> $data["trans_date"],
			"no_sj"					=> $data["no_sj"],
			"no_mobil"				=> $data["no_mobil"],
			"no_container"			=> $data["no_container"],
			"no_seal"				=> $data["no_seal"],
			"trans_desc"			=> $data["trans_desc"]
		);
		$this->db->insert('transcation',$d);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="Transcation has been added successfully";
		
	}	
	
	/***
	 * Edit Transcation
	 */
	public function edit_transcation($data) {
		$this->db->where("transcation_id",$data["transcation_id"]);
		
		if($data["trans_date"]) {
			$tmp = new DateTime($data["trans_date"]);
			$data["trans_date"] = $tmp->format("Y-m-d");
		}
		
		$d = array(
			"trans_date"			=> $data["trans_date"],
			"no_sj"					=> $data["no_sj"],
			"no_mobil"				=> $data["no_mobil"],
			"no_container"			=> $data["no_container"],
			"no_seal"				=> $data["no_seal"],
			"trans_desc"			=> $data["trans_desc"]
		);
		
		$this->db->update('transcation',$d);
		//echo debug($this->db->queries);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="Transcation has been updated successfully";
		
	}	
	
	/***
	 * Delete Transcation
	 */
	public function delete_transcation($data) {
		$this->db->where("transcation_id",$data["transcation_id"]);
		
		$this->db->delete('transcation');
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="Transcation has been deleted successfully";
		
	}	
	
	/***
	 * Get Transcation Count
	 */
	public function get_transcation_count($po_id,$itm="") {
		if($itm) {
			$where.=" WHERE no_sj LIKE '%".$itm."%'";
		}
		return $this->db->count_all('transcation '.$where);
	}
	
	/***
	 * Get Delivery Order Number
	 */
	public function get_do_num($trans_id) {
		$this->db->where("transcation_id",$trans_id);
		$r = $this->db->get("transcation");
		
		if($r) {
			$d = $r->row_array();
			//echo debug($d);
			return $d["no_sj"];
		}	
		else
			return false;
	}
	
	/***
	 * Get transcation List
	 */
	public function get_transcation_list($itm="",$p=0,$limit=10) {
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
	 * Get transcation detail
	 */
	public function get_transcation_detail($data) {
		$this->db->where("transcation_id", $data);
		
		$this->db->select("*");
		$this->db->from("transcation");
		$r = $this->db->get(); 
		//echo debug($this->db->queries);
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	/*** PO Detail ***/
	/***
	 * Add PO Detail
	 */
	public function add_podetail($data) {
		$bruto = $data["qty"] * $data["price"];
		$netto	= $bruto - (($data["disc"]/100) * $bruto);
		$d = array(
			"product_id"		=> $data["product_id"],
			"po_id"				=> $data["po_id"],
			"unit_id"			=> $data["unit_id"],
			"price"				=> $data["price"],
			"qty"				=> $data["qty"],
			"disc"				=> $data["disc"],
			"subtotal"			=> $netto
		);
		$this->db->insert('po_detail',$d);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="Product has been added successfully";
		
	}	
	
	/***
	 * Edit PO Detail
	 */
	public function edit_podetail($data) {
		$bruto = $data["qty"] * $data["price"];
		$netto	= $bruto - (($data["disc"]/100) * $bruto);
		$this->db->where("detail_id",$data["detail_id"]);
		$d = array(
			"product_id"		=> $data["product_id"],
			"unit_id"			=> $data["unit_id"],
			"price"				=> $data["price"],
			"qty"				=> $data["qty"],
			"disc"				=> $data["disc"],
			"subtotal"			=> $netto
		);
		$this->db->update('po_detail',$d);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="Product has been updated successfully";
	}
	
	/***
	 * Delete PO
	 */
	public function delete_podetail($data) {
		$this->db->where("detail_id",$data["detail_id"]);
		
		$this->db->delete('po_detail');
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="Product has been deleted successfully";
	}
	
	/***
	 *  Get PO Detail List
	 */
	public function get_podetail_list($po_id,$itm="",$p=0,$limit=10) { 
		$this->db->where("po_id",$po_id);
		if($itm)
			$this->db->where("product_name LIKE '%".$itm."%'");
			
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$this->db->select("a.*, b.product_name,c.unit_name");
		$this->db->from("po_detail a");
		$this->db->join("products b","b.product_id=a.product_id",'left');
		$this->db->join("unit c","c.unit_id=a.unit_id",'left');
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
	 *  Get PO Detail List
	 */
	public function get_podetail_detail($detail_id) { 
		$this->db->where("detail_id",$detail_id);
			
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$this->db->select("a.*, b.product_name,c.unit_name");
		$this->db->from("po_detail a");
		$this->db->join("products b","b.product_id=a.product_id",'left');
		$this->db->join("unit c","c.unit_id=a.unit_id",'left');
		$r = $this->db->get(); 
		//echo debug($this->db->queries);
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
		
	}
	
	/***
	 * Get PO Count
	 */
	public function get_podetail_count($po_id,$itm="") {
		$where =" WHERE po_id =".$po_id;
		if($itm) {
			$where.=" AND product_name LIKE '%".$itm."%'";
		}
		return $this->db->count_all('po_detail '.$where);
	}
	
	/*** PO ***/
	/***
	 * Get PO Number 	
	 */
	public function  get_po_num($po_id) {
		$this->db->where("po_id",$po_id);
		$this->db->select("po_no");
		$r = $this->db->get("po");
		if($r) {
			$d=$r->row_array();
			return $d["po_no"];
		}
		else {
			return false;
		}
	}
	
	/***
	 * Add PO
	 */
	public function add_po($data) {
		if($data["po_date"]) {
			$tmp = new DateTime($data["po_date"]);
			$data["po_date"] = $tmp->format("Y-m-d");
		}
		
		$d = array(
			"po_date"			=> $data["po_date"],
			"po_no"				=> $data["po_no"],
			"cust_id"			=> $data["cust_id"],
			"ship_id"			=> $data["ship_id"],
			"po_desc"			=> $data["po_desc"]
		);
		$this->db->insert('po',$d);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="PO has been added successfully";
		
	}	
	
	/***
	 * Edit PO
	 */
	public function edit_po($data) {
		if($data["po_date"]) {
			$tmp = new DateTime($data["po_date"]);
			$data["po_date"] = $tmp->format("Y-m-d");
		}
	
		$this->db->where('po_id',$data["po_id"]);
		$d = array(
			"po_date"			=> $data["po_date"],
			"cust_id"			=> $data["cust_id"],
			"ship_id"			=> $data["ship_id"],
			"po_desc"			=> $data["po_desc"]
		);
		$this->db->update('po',$d);
		$this->is_error = 0;
		$this->error_message ="";
		$this->message ="PO has been updated successfully";
		
	}	
	
	/***
	 * Get PO List
	 */
	public function get_po_list($itm="",$p=0,$limit=10) {
		if($itm) {
			$this->db->where("po_no LIKE '%".$itm."%'");
		}
		$p=(!$p)?0:$p;
		$limit=(!$limit)?10:$limit;
		
		$this->db->limit($limit,$p);
		$this->db->select("a.*, b.cust_fullname,c.ship_name");
		$this->db->from("po a");
		$this->db->join("customers b","b.cust_id=a.cust_id",'left');
		$this->db->join("shipper c","c.ship_id=a.ship_id",'left');
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
	 * Get PO Count
	 */
	public function get_po_count($itm="") {
		if($itm) {
			$where =" WHERE po_no LIKE '%".$itm."%'";
		}
		return $this->db->count_all('po');
	}
	
	/***
	 * Get Po detail
	 */
	public function get_po_detail($data) {
		$this->db->where("po_id",$data);
		$this->db->select("a.*, b.cust_fullname,c.ship_name");
		$this->db->from("po a");
		$this->db->join("customers b","b.cust_id=a.cust_id",'left');
		$this->db->join("shipper c","c.ship_id=a.ship_id",'left');
		$r = $this->db->get(); 
		if($r) {
			return $r->row_array();
		}
		else {
			return false;
		}
	}
	
	/***
	 * Delete po
	 */
	public function delete_po($data) {
		$this->db->where('po_id',$data);
		$this->db->delete("po",$d);
		$this->is_error = 0;
        $this->message = "PO has been deleted successfully";
        $this->error_message = "";
	}
}	