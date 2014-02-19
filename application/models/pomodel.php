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