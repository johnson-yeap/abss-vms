<?php
class SeoModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//SEO详细
	function getseoinfo($seo_id){
		$sql="select * from ".DB_PRE()."seo_list where seo_id=".$seo_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//添加SEO
	function add_seo($arr){
		$this->db->insert(DB_PRE().'seo_list',$arr);
		return $this->db->insert_id();
	}
	//修改SEO
	function edit_seo($seo_id,$arr){
        $this->db->update (DB_PRE().'seo_list', $arr, array ('seo_id' => $seo_id ) );
	}
	//修改SEO
	function del_seo($seo_id){
        $this->db->delete(DB_PRE().'seo_list', array('seo_id'=>$seo_id));
	}

	//查询SEO列表
	function getseolist($con=array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$leftjoin = "";
		if(isset($con['category_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.category_id = ".$con['category_id'];}
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.seo_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.seo_name_ch LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql="
				SELECT a.*
					
				FROM ".DB_PRE()."seo_list AS a 
				
				$leftjoin
				
				$where $order_by $limit
			";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
					SELECT count(*) as count 
					
					FROM ".DB_PRE()."seo_list AS a 
					
					$leftjoin
					
					$where $order_by
			";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	
}
