<?php
class CmsModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//商品详细
	function getcmsinfo($cms_id){
		$sql = "select * from ".DB_PRE()."cms_list where cms_id=".$cms_id;
		$query=$this->db->query($sql);
		if($query->num_rows()>0){
			return $query->row_array();
		}else{
			return false;
		}
	}
	//商品分类详细
	function getcmsinfo_byshorturl($group_id, $short_url, $langtype){
// 	    AND langtype = '".$langtype."'
	    $sql = "select * from ".DB_PRE()."cms_list WHERE group_id = ".$group_id." AND short_url = '".$short_url."'";
	    $query=$this->db->query($sql);
	    if($query->num_rows()>0){
	        return $query->row_array();
	    }else{
	        return false;
	    }
	}
	//添加商品
	function add_cms($arr){
		$this->db->insert(DB_PRE().'cms_list',$arr);
		return $this->db->insert_id();
	}
	//修改商品
	function edit_cms($cms_id,$arr){
		// 配置图片字段
		$picarr = array ('cms_pic_1_path');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " .DB_PRE()."cms_list WHERE cms_id=$cms_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if (isset ( $arr [$picarr [$i]] ) && $arr [$picarr [$i]] != '' && $filename != "" && $arr [$picarr [$i]] != $filename && file_exists ( $filename )) {
					@unlink ( $filename );
				}
			}
			$this->db->update (DB_PRE().'cms_list', $arr, array ('cms_id' => $cms_id ) );
		}
	}
	//修改商品
	function del_cms($cms_id){
		// 配置图片字段
		$picarr = array ('cms_pic_1_path');
		$picstr = '';
		for($i = 0; $i < count ( $picarr ); $i ++) {
			if ($i != 0) {
				$picstr .= ',';
			}
			$picstr .= $picarr [$i];
		}
		// 同时删除图片
		$sql = "SELECT $picstr FROM " .DB_PRE()."cms_list WHERE cms_id = $cms_id";
		$info = $this->db->query ( $sql )->row_array ();
		if (! empty ( $info )) {
			for($i = 0; $i < count ( $picarr ); $i ++) {
				$filename = $info [$picarr [$i]]; // 只能是相对路径
				if ($filename != "" && file_exists ( $filename )) {
					$filename_arr = explode('.', $filename);
					$file_type = end($filename_arr);
					$filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
					$filename_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $filename);
					$filename_400x400 = str_replace('.'.$file_type, '_400x400.'.$file_type, $filename);
					$filename_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $filename);
						
					@unlink($filename_100x100);
					@unlink($filename_200x200);
					@unlink($filename_400x400);
					@unlink($filename_800x800);
					@unlink($filename);
				}
			}
			$this->db->delete(DB_PRE().'cms_list', array('cms_id'=>$cms_id));
		}
	}

	//查询商品列表
	function getcmslist($con=array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		$leftjoin = "";
		if(isset($con['category_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.category_id = ".$con['category_id'];}
		
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['cms_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.cms_id = ".$con['cms_id'];}
		if(isset($con['cms_id_IN'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.cms_id IN (".$con['cms_id_IN'].")";}
		if(isset($con['cms_id_NOTIN'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.cms_id NOT IN (".$con['cms_id_NOTIN'].")";}
		if(isset($con['group_id'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.group_id = ".$con['group_id'];}
		if(isset($con['group_id_IN'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.group_id IN (".$con['group_id_IN'].")";}
		if(isset($con['group_id_XIAOYU'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.group_id < ".$con['group_id_XIAOYU'];}
		if(isset($con['parent'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.parent = ".$con['parent'];}
		if(isset($con['common_type'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.common_type = ".$con['common_type'];}
		if(isset($con['langtype'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.langtype = '".$con['langtype']."'";}
		if(isset($con['langtype_en'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.langtype_en = ".$con['langtype_en'];}
		if(isset($con['langtype_ch'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.langtype_ch = ".$con['langtype_ch'];}
		if(isset($con['langtype_jp'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.langtype_jp = ".$con['langtype_jp'];}
		if(isset($con['langtype_sk'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.langtype_sk = ".$con['langtype_sk'];}
		if(isset($con['langtype_ru'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.langtype_ru = ".$con['langtype_ru'];}
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
		if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.cms_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_name_ch LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_name_jp LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_name_sk LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_name_ru LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_subname_en LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_subname_ch LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_subname_jp LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_subname_sk LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_subname_ru LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_comment_en LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_comment_ch LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_comment_jp LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_comment_sk LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_comment_ru LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_description_en LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_description_ch LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_description_jp LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_description_sk LIKE '%".addslashes($con['keyword'])."%') OR (a.cms_description_ru LIKE '%".addslashes($con['keyword'])."%')) ";}
		if(isset($con['keyword_en'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.cms_name_en LIKE '%".addslashes($con['keyword_en'])."%') OR (a.cms_subname_en LIKE '%".addslashes($con['keyword_en'])."%') OR (a.cms_comment_en LIKE '%".addslashes($con['keyword_en'])."%') OR (a.cms_description_en LIKE '%".addslashes($con['keyword_en'])."%')) ";}
		if(isset($con['keyword_ch'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.cms_name_ch LIKE '%".addslashes($con['keyword_ch'])."%') OR (a.cms_subname_ch LIKE '%".addslashes($con['keyword_ch'])."%') OR (a.cms_comment_ch LIKE '%".addslashes($con['keyword_ch'])."%') OR (a.cms_description_ch LIKE '%".addslashes($con['keyword_ch'])."%')) ";}
		if(isset($con['keyword_jp'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.cms_name_jp LIKE '%".addslashes($con['keyword_jp'])."%') OR (a.cms_subname_jp LIKE '%".addslashes($con['keyword_jp'])."%') OR (a.cms_comment_jp LIKE '%".addslashes($con['keyword_jp'])."%') OR (a.cms_description_jp LIKE '%".addslashes($con['keyword_jp'])."%')) ";}
		if(isset($con['keyword_sk'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.cms_name_sk LIKE '%".addslashes($con['keyword_sk'])."%') OR (a.cms_subname_sk LIKE '%".addslashes($con['keyword_sk'])."%') OR (a.cms_comment_sk LIKE '%".addslashes($con['keyword_sk'])."%') OR (a.cms_description_sk LIKE '%".addslashes($con['keyword_sk'])."%')) ";}
		if(isset($con['keyword_ru'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.cms_name_ru LIKE '%".addslashes($con['keyword_ru'])."%') OR (a.cms_subname_ru LIKE '%".addslashes($con['keyword_ru'])."%') OR (a.cms_comment_ru LIKE '%".addslashes($con['keyword_ru'])."%') OR (a.cms_description_ru LIKE '%".addslashes($con['keyword_ru'])."%')) ";}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount == 0){
			$sql = "
				SELECT a.*
					
				FROM ".DB_PRE()."cms_list AS a 
				
				$leftjoin
				
				$where $order_by $limit
			";
			$result = $this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="
					SELECT count(*) as count 
					
					FROM ".DB_PRE()."cms_list AS a 
					
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
