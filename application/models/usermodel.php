<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {
    var $is_error = 0;
    var $error_message = "";
    var $message = "";

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
      
    }
    
    /**
     * Checking Login
     */
    
    public function check_login($data) {
        $where = array (
            "user_email" => $data["user_email"],
            "user_pass" => sha1($data["user_pass"]),
        );
        $this->db->where($where);
        $this->db->select("user_email,user_name,user_pass,user_lastlogindate,group_id");
        $r = $this->db->get("users");
        
        if($r->num_rows() > 0) {
                $d = $r->row_array();
                $usrkey = sha1($data["user_email"].date("YmdHis"));
                $lastlgn = $d["user_lastlogindate"];
                $sess = array (
                    "security" => array(
                        "userkey"   => $usrkey,
						"email"     => $d["user_email"],
                        "uname"     => $d["user_name"],
                        "last"      => $lastlgn,
                        "group_id"  => $d["group_id"],
                        "remember"  => 0
                    )
                );
               
                $this->update_lastlogindate($d["user_email"]);
                $this->is_error 	= 0;
                
                if($data["remember"]==1) {
                        $sess["security"]["remember"]	= 1;
                        $this->user_create_cookie($usrkey,$d["user_email"],$d["user_name"],$lastlgn,$d["group_id"]);
                }
                
                $this->session->set_userdata($sess);
        }
        else {
                $this->is_error = 1;
                $this->error_message = "Incorrect your email address or password";
        }
            
    }
    
    /**
     * Get User ID
     */
    public function get_userid($user_email) {
            $this->db->where('user_email',$user_email);
            $this->db->select("user_id");
            $r = $this->db->get("users");
            $tmp	= $this->loadquery(1, $sql);
            if($r->num_rows() > 0) {
                $d = $r->row_array();    
                return $d["user_id"];
            }
    }
    
    /**
     * Updating Lastlogindate
     */
    public function update_lastlogindate($email) {
        $this->db->where("user_email",$email);
        $data = array(
            'user_lastlogindate' => date("Y-m-d H:i:s")
        );
        $this->db->update("users",$data);
    }
    
    /**
     * Create Cookie
     */
    public function user_create_cookie($usrkey,$email,$uname,$lastlgn, $grp_id) {
            setcookie("userkey",$usrkey,time()+3600);
			setcookie("uname",$uname,time()+3600);
            setcookie("email",$email,time()+3600);
            setcookie("lastlgn",$_SESSION["last"],time()+3600);
            setcookie("group_id",$_SESSION["group_id"],time()+3600);
    }
    
	/**
     * Removing Cookie
     */
    public function user_remove_cookie() {
            setcookie("userkey","",time()-3600);
			setcookie("uname","",time()-3600);
            setcookie("email","",time()-3600);
            setcookie("lastlgn","",time()-3600);
            setcookie("group_id","",time()-3600);
    }
	
    /**
     * Check User Cookie
     */
    public function user_check_cookie() {
            if($_COOKIE["userkey"]) {
                    setcookie("userkey",$_COOKIE["userkey"],time()+3600);
                    setcookie("email",$_COOKIE["email"],time()+3600);
					setcookie("uname",$_COOKIE["uname"],time()+3600);
                    setcookie("lastlgn",$_COOKIE["lastlgn"],time()+3600);
                    setcookie("group_id",$_COOKIE["grp_id"],time()+3600);
                            
                    $_SESSION["expire"]		= time()+3600;
                    return true;
            }
            else if($_SESSION["userkey"]) {
                    setcookie("userkey",$_SESSION["userkey"],time()+3600);
                    setcookie("email",$_SESSION["email"],time()+3600);
					setcookie("uname",$_SESSION["uname"],time()+3600);
                    setcookie("lastlgn",$_SESSION["lastlgn"],time()+3600);
                    setcookie("group_id",$_SESSION["group_id"],time()+3600);
                    
                    $_SESSION["expire"]		= time()+3600;
                    return true;
            }	
            else {
                    return false;
            }			
    } 

    /**
     * Get User Group
     */
    public function get_group() {        
            $sql = "SELECT * FROM groups";
            $r = $this->loadquery(2, $sql);
            return $r;
    }
    
    /**
     * Update Password
     */
    public function update_password($newpass) {
        $sess = $this->session->userdata("security");
        //Updating password 
        $where = array(
            "user_email" => $sess["email"]    
        );
        $d = array("user_pass" => sha1($newpass));
        $this->db->where($where);
        $this->db->update("users",$d);
        $this->is_error = 0;
        $this->message = "Your password has been changed successfully";
        $this->error_message = "";
    }
    
    /**
     * Get Group Name
     */
    public function get_group_name($grp_id) {
            $sql = "SELECT * FROM groups WHERE group_id =".$grp_id;
            $r = $this->loadquery(1,$sql);
            return $r["group_name"];
    }
    
    /**
     * Get User Mgt
     */
    public function get_user_all($p=0,$limit=10) {
        if(!isset($p)) {
                $p = 0;
        }
        else
                $p = $p*$limit;
        
        if(!isset($limit)) {
                $limit = 10;
        }
        
        $this->db->select("a.*, b.group_name");
        $this->db->from("users a");
        $this->db->join("groups b", "b.group_id = a.group_id", "left");
        $r = $this->db->get();
        if($r->num_rows() > 0) {
            return $r->result_array();
        }
        else {
            return false;
        }
    }
    
    /**
     * Get User Mgt detail
     */
    public function get_user_detail($uid) {
        $this->db->where("user_id",$uid);    
        $r = $this->db->get("users");
        if($r->num_rows() > 0) {
            return $r->row_array();
        }
        else
            return false;
    }
    
    /**
     * Add User
     */
    public function add_user($data) {
        $d = array(
            "user_email"    => $data["user_email"],
			"user_name"    	=> $data["user_name"],
            "user_pass"     => sha1($data["user_pass"]),
            "group_id"      => $data["group_id"]
        );
        $this->db->insert("users",$d);
        $this->is_error = 0;
        $this->message = "User has been added successfully";
        $this->error_message = "";
    }
    
    /**
     * Update User
     */
    public function update_user($data) {
        $this->db->where("user_id",$data["user_id"]);
        $d = array(
            "user_email"     => $data["user_email"],
			"user_name"    	=> $data["user_name"],
            "user_pass"     => sha1($data["user_pass"]),
            "group_id"      => $data["group_id"]
        );
        $this->db->update("users",$d);
        $this->is_error = 0;
        $this->message = "User has been updated successfully";
        $this->error_message = "";    
    }
    
    /**
     * Delete User
     */
    public function delete_user($uid) {
        $this->db->where("user_id",$uid);
        $this->db->delete("users");
        $this->is_error = 0;
        $this->message = "User has been deleted successfully";
        $this->error_message = "";
    }
    
    /**
     * Check User name unique or not
     */
    public function is_unique($uname) {
        $this->db->like("user_email",$uname);    
        $r = $this->db->get("users");    
        if($r->num_rows() > 0) {
                return false;
        }
        else
                return true;
            
    }
    
    /**
     * Check password
     */
    public function is_password($pass) {
        $sess = $this->session->userdata("security");
        $email = $sess["email"];
        $this->db->where(array("user_email" => $email, "user_pass" => sha1($pass)));
        $r = $this->db->get("users");
        //$d = $r->row_array();
        //print_r(array("user_email" => $uname, "user_pass" => sha1($pass)));
        if($r->num_rows() > 0) {
                return true;
        }
        else {

                return false;
        }    
    }
    
    /**
     * Get Count of Users
     */
    public function get_count($itm) {
        if($itm) {
            $this->db->like("user_email",$itm);
        }
        return $this->db->count_all("`users`");
    }
}    
?>    