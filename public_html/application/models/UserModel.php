<?php
class UserModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	//添加用户
	function add_user($arr){
		$this->db->insert(DB_PRE().'user_list', $arr);
		return $this->db->insert_id();
	}
	function edit_user($uid, $arr){
	    $this->db->update(DB_PRE().'user_list', $arr, array('uid'=>$uid));
	}
	//获取用户信息
	function getuserinfo($uid){
	    $sql = "
			SELECT a.*
			FROM ".DB_PRE()."user_list AS a
			WHERE a.uid = ".$uid."
		";
	    $result = $this->db->query($sql)->row_array();
	    if(!empty($result)){
	        return $result;
	    }else{
	        return null;
	    }
	}
	
}
