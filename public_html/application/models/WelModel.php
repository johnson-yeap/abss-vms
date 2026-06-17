<?php
class WelModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	//添加临时文件
	function add_file_interim($arr){
		$this->db->insert(DB_PRE().'file_interim',$arr);
		return $this->db->insert_id();
	}
	
	//删除临时文件信息
	function delete_file_interim($path){
		$this->db->delete(DB_PRE().'file_interim',array('file_path'=>$path));
	}
	
	//删除临时文件
	function truncate_file_interim(){
		$sql="SELECT * FROM ".DB_PRE()."file_interim WHERE created < ".(time()-86400);
		$result=$this->db->query($sql)->result_array();
		if(!empty($result)){
			for($i=0;$i<count($result);$i++){
				$filename="".$result[$i]['file_path'];  //只能是相对路径
				@unlink($filename);
				$this->db->delete(DB_PRE().'file_interim',array('file_path'=>$result[$i]['file_path']));
			}
		}
	}
	
	
	//获取语言列表
	function getlanguage_list($con = array(),$iscount=0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " status = ".$con['status'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
		
		if($iscount==0){
			$sql="SELECT * FROM ".DB_PRE()."language_list $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql="SELECT count(*) as count FROM ".DB_PRE()."language_list $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	//获取新闻分类的列表
	function getnewscategory_select($langtype, $category_id = 0){
	    $str='';
	    $categorylist = $this->NewsModel->getnewscategorylist(array('status'=>1, 'orderby'=>'a.sort', 'orderby_res'=>'ASC'));
	    if(!empty($categorylist)){
	        for($i = 0; $i < count($categorylist);$i++){
	            if($category_id == $categorylist[$i]['category_id']){$isselect=' selected';}else{$isselect='';}
	            $str .='<option value="'.$categorylist[$i]['category_id'].'" '.$isselect.'>'.$categorylist[$i]['category_name'.$langtype].'</option>';
	        }
	    }
	    return $str;
	}
	
	//处理通用表单 -----的附件
	function action_normal_fujian_single($xiangmu_id, $dataunique_name, $linshi_picpath, $linshi_picname, $table_name, $table_ziduan_name){
		//----修改图片路径--START-----//
		$pic_maxnum = 10;//最大上传数量
	
		if(!empty($linshi_picpath)){
			$sql = "SELECT * FROM ".$table_name." WHERE ".$dataunique_name." = ".$xiangmu_id;
			$fujianinfo = $this->db->query($sql)->row_array();
	
			//删除以前的图片或文件--无效的。-------START
			if($fujianinfo[$table_ziduan_name.'_pic_path'] != ''){
				if($fujianinfo[$table_ziduan_name.'_pic_path'] == $linshi_picpath[0]){
					
				}else{
					//删除以前的图片或文件--无效的。
					$filename = $fujianinfo[$table_ziduan_name.'_pic_path']; // 只能是相对路径
					if(file_exists($filename)) {
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
					$this->db->update($table_name, array($table_ziduan_name.'_pic_path'=>'', $table_ziduan_name.'_pic_name'=>''), array($dataunique_name=>$xiangmu_id));
				}
			}
			//删除以前的图片或文件--无效的。-------END
	
	
	
	
			$arr_pic = array();
			$arr_pic[$table_ziduan_name.'_pic_path'] = NULL;
			$arr_pic[$table_ziduan_name.'_pic_name'] = NULL;
			$this->db->update($table_name, $arr_pic, array($dataunique_name=>$xiangmu_id));
	
			$arr_pic = array();
			$arr_pic[$table_ziduan_name.'_pic_path'] = $linshi_picpath[0];
			$arr_pic[$table_ziduan_name.'_pic_name'] = $linshi_picname[0];
			if(!empty($arr_pic)){
				$this->db->update($table_name, $arr_pic, array($dataunique_name=>$xiangmu_id));
			}
		}else{
			$sql = "SELECT * FROM ".$table_name." WHERE ".$dataunique_name." = ".$xiangmu_id;
			$fujianinfo = $this->db->query($sql)->row_array();
			if(!empty($fujianinfo)){
				//删除以前的图片或文件--无效的。-------START
				if($fujianinfo[$table_ziduan_name.'_pic_path'] != ''){
					//删除以前的图片或文件--无效的。
					$filename = $fujianinfo[$table_ziduan_name.'_pic_path']; // 只能是相对路径
					if(file_exists($filename)) {
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
					$this->db->update($table_name, array($table_ziduan_name.'_pic_path'=>'', $table_ziduan_name.'_pic_name'=>''), array($dataunique_name=>$xiangmu_id));
				}
				//删除以前的图片或文件--无效的。-------END
			}
		}
		//----修改图片路径--END-----//
	}
	
	
	//处理通用表单 -----的附件
	function action_normal_fujian_mul($xiangmu_id, $dataunique_name, $linshi_picpath, $linshi_picname, $table_name, $table_ziduan_name, $table_ziduan_subname = 'pic', $pic_maxnum = 10){
		//----修改图片路径--START-----//
		// 		$pic_maxnum = 10;//最大上传数量
		
		if(!empty($linshi_picpath)){
			$sql = "SELECT * FROM ".$table_name." WHERE ".$dataunique_name." = ".$xiangmu_id;
			$fujianinfo = $this->db->query($sql)->row_array();
			
			//删除以前的图片或文件--无效的。-------START
			for ($ppp = 0; $ppp < $pic_maxnum; $ppp++) {
				if($fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] != ''){
					$isthishave = 0;
	                for ($i = 0; $i < count($linshi_picpath); $i++) {
	                    if($fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] == $linshi_picpath[$i]){
	                        $isthishave = 1;
	                    }
	                }
					if($isthishave == 1){
				
					}else{
						//删除以前的图片或文件--无效的。
						$filename = $fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path']; // 只能是相对路径
						if(file_exists($filename)) {
							$filename_arr = explode('.', $filename);
							$file_type = end($filename_arr);
							if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){
								@unlink($filename);
							}else{
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
						$this->db->update($table_name, array($table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'=>'', $table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_name'=>''), array($dataunique_name=>$xiangmu_id));
					}
				}
			}
			//删除以前的图片或文件--无效的。-------END
	
	
	
			$arr_pic = array();
			for ($ppp = 0; $ppp < $pic_maxnum; $ppp++) {
				$arr_pic[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] = NULL;
				$arr_pic[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_name'] = NULL;
			}
			$this->db->update($table_name, $arr_pic, array($dataunique_name=>$xiangmu_id));
	
			$arr_pic = array();
			for ($ppp = 0; $ppp < count($linshi_picpath); $ppp++) {
				if(count($linshi_picpath) <= $pic_maxnum){
					$arr_pic[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] = $linshi_picpath[$ppp];
					$arr_pic[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_name'] = $linshi_picname[$ppp];
				}
			}
			if(!empty($arr_pic)){
				$this->db->update($table_name, $arr_pic, array($dataunique_name=>$xiangmu_id));
			}
		}else{
			$sql = "SELECT * FROM ".$table_name." WHERE ".$dataunique_name." = ".$xiangmu_id;
			$fujianinfo = $this->db->query($sql)->row_array();
			if(!empty($fujianinfo)){
				//删除以前的图片或文件--无效的。-------START
				for ($ppp = 0; $ppp < $pic_maxnum; $ppp++) {
					if($fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] != ''){
						//删除以前的图片或文件--无效的。
						$filename = $fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path']; // 只能是相对路径
						if(file_exists($filename)) {
							$filename_arr = explode('.', $filename);
							$file_type = end($filename_arr);
							if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){
								@unlink($filename);
							}else{
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
						$this->db->update($table_name, array($table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'=>'', $table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_name'=>''), array($dataunique_name=>$xiangmu_id));
					}
				}
				//删除以前的图片或文件--无效的。-------END
			}
		}
		//----修改图片路径--END-----//
	}
	
	
	
	//处理通用表单 -----的附件 ---- 不删除附件
	function action_normal_fujian_mul_nodelete($xiangmu_id, $dataunique_name, $linshi_picpath, $linshi_picname, $table_name, $table_ziduan_name, $table_ziduan_subname = 'pic', $pic_maxnum = 10){
	    //----修改图片路径--START-----//
	    // 		$pic_maxnum = 10;//最大上传数量
	    
	    if(!empty($linshi_picpath)){
	        $sql = "SELECT * FROM ".$table_name." WHERE ".$dataunique_name." = ".$xiangmu_id;
	        $fujianinfo = $this->db->query($sql)->row_array();
	        
	        //删除以前的图片或文件--无效的。-------START
	        for ($ppp = 0; $ppp < $pic_maxnum; $ppp++) {
	            if($fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] != ''){
	                $isthishave = 0;
	                for ($i = 0; $i < count($linshi_picpath); $i++) {
	                    if($fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] == $linshi_picpath[$i]){
	                        $isthishave = 1;
	                    }
	                }
	                if($isthishave == 1){
	                    
	                }else{
	                    //删除以前的图片或文件--无效的。
	                    $filename = $fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path']; // 只能是相对路径
// 	                    if(file_exists($filename)) {
// 	                        $filename_arr = explode('.', $filename);
// 	                        $file_type = end($filename_arr);
// 	                        if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){
// 	                            @unlink($filename);
// 	                        }else{
// 	                            $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
// 	                            $filename_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $filename);
// 	                            $filename_400x400 = str_replace('.'.$file_type, '_400x400.'.$file_type, $filename);
// 	                            $filename_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $filename);
	                            
// 	                            @unlink($filename_100x100);
// 	                            @unlink($filename_200x200);
// 	                            @unlink($filename_400x400);
// 	                            @unlink($filename_800x800);
// 	                            @unlink($filename);
// 	                        }
// 	                    }
	                    $this->db->update($table_name, array($table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'=>'', $table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_name'=>''), array($dataunique_name=>$xiangmu_id));
	                }
	            }
	        }
	        //删除以前的图片或文件--无效的。-------END
	        
	        
	        
	        $arr_pic = array();
	        for ($ppp = 0; $ppp < $pic_maxnum; $ppp++) {
	            $arr_pic[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] = NULL;
	            $arr_pic[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_name'] = NULL;
	        }
	        $this->db->update($table_name, $arr_pic, array($dataunique_name=>$xiangmu_id));
	        
	        $arr_pic = array();
	        for ($ppp = 0; $ppp < count($linshi_picpath); $ppp++) {
	            if(count($linshi_picpath) <= $pic_maxnum){
	                $arr_pic[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] = $linshi_picpath[$ppp];
	                $arr_pic[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_name'] = $linshi_picname[$ppp];
	            }
	        }
	        if(!empty($arr_pic)){
	            $this->db->update($table_name, $arr_pic, array($dataunique_name=>$xiangmu_id));
	        }
	    }else{
	        $sql = "SELECT * FROM ".$table_name." WHERE ".$dataunique_name." = ".$xiangmu_id;
	        $fujianinfo = $this->db->query($sql)->row_array();
	        if(!empty($fujianinfo)){
	            //删除以前的图片或文件--无效的。-------START
	            for ($ppp = 0; $ppp < $pic_maxnum; $ppp++) {
	                if($fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'] != ''){
	                    //删除以前的图片或文件--无效的。
	                    $filename = $fujianinfo[$table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path']; // 只能是相对路径
// 	                    if(file_exists($filename)) {
// 	                        $filename_arr = explode('.', $filename);
// 	                        $file_type = end($filename_arr);
// 	                        if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){
// 	                            @unlink($filename);
// 	                        }else{
// 	                            $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
// 	                            $filename_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $filename);
// 	                            $filename_400x400 = str_replace('.'.$file_type, '_400x400.'.$file_type, $filename);
// 	                            $filename_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $filename);
	                            
// 	                            @unlink($filename_100x100);
// 	                            @unlink($filename_200x200);
// 	                            @unlink($filename_400x400);
// 	                            @unlink($filename_800x800);
// 	                            @unlink($filename);
// 	                        }
// 	                    }
	                    $this->db->update($table_name, array($table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_path'=>'', $table_ziduan_name.'_'.$table_ziduan_subname.'_'.($ppp + 1).'_name'=>''), array($dataunique_name=>$xiangmu_id));
	                }
	            }
	            //删除以前的图片或文件--无效的。-------END
	        }
	    }
	    //----修改图片路径--END-----//
	}
	
	
	
	
	//查询系统颜色列表
	function getsystemcolorlist($con = array(), $iscount = 0){
	    $where="";
	    $order_by="";
	    $limit="";
	    if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
	    if(isset($con['status'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " a.status = ".$con['status'];}
	    if(isset($con['keyword'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ((a.systemcolor_name_en LIKE '%".addslashes($con['keyword'])."%') OR (a.systemcolor_name_ch LIKE '%".addslashes($con['keyword'])."%')) ";}
	    if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
	    if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	    
	    if($iscount == 0){
	        $sql = "SELECT a.* FROM ".DB_PRE()."systemcolor_list a $where $order_by $limit";
	        $result=$this->db->query($sql)->result_array();
	        if(!empty($result)){
	            return $result;
	        }else{
	            return null;
	        }
	    }else{
	        $sql = "SELECT count(*) as count FROM ".DB_PRE()."systemcolor_list a $where $order_by";
	        $result = $this->db->query($sql)->row_array();
	        if(!empty($result)){
	            return $result['count'];
	        }else{
	            return 0;
	        }
	    }
	}
	
	function getmonthshortshow($date_month){
	    $date_month_show = '';
	    if($date_month == '12'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '12月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '12月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '12월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Декабрь';
	        }else{
	            $date_month_show = 'Dec';
	        }
	    }else if($date_month == '11'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '11月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '11月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '11월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Ноябрь';
	        }else{
	            $date_month_show = 'Nov';
	        }
	    }else if($date_month == '10'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '10月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '10月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '10월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Октябрь';
	        }else{
	            $date_month_show = 'Oct';
	        }
	    }else if($date_month == '09'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '9月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '9月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '9월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Сентябрь';
	        }else{
	            $date_month_show = 'Sep';
	        }
	    }else if($date_month == '08'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '8月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '8月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '8월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Август';
	        }else{
	            $date_month_show = 'Aug';
	        }
	    }else if($date_month == '07'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '7月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '7月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '7월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Июль';
	        }else{
	            $date_month_show = 'Jul';
	        }
	    }else if($date_month == '06'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '6月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '6月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '6월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Июнь';
	        }else{
	            $date_month_show = 'Jun';
	        }
	    }else if($date_month == '05'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '5月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '5月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '5월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Май';
	        }else{
	            $date_month_show = 'May';
	        }
	    }else if($date_month == '04'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '4月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '4月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '4월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Апрель';
	        }else{
	            $date_month_show = 'Apr';
	        }
	    }else if($date_month == '03'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '3月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '3月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '3월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Март';
	        }else{
	            $date_month_show = 'Mar';
	        }
	    }else if($date_month == '02'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '2月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '2月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '2월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Февраль';
	        }else{
	            $date_month_show = 'Feb';
	        }
	    }else if($date_month == '01'){
	        if($this->langtype == '_ch'){
	            $date_month_show = '1月';
	        }else if($this->langtype == '_jp'){
	            $date_month_show = '1月';
	        }else if($this->langtype == '_sk'){
	            $date_month_show = '1월';
	        }else if($this->langtype == '_ru'){
	            $date_month_show = 'Январь';
	        }else{
	            $date_month_show = 'Jan';
	        }
	    }
	    return $date_month_show;
	}
	
	function getcampuslist(){
	    $arr = array();
	    $arr[] = array('campus_id'=>1, 'campus_name_en'=>'Black', 'campus_name_ch'=>'黑色', 'campus_name_jp'=>'黑色', 'campus_name_sk'=>'黑色', 'campus_name_ru'=>'黑色');
	    $arr[] = array('campus_id'=>2, 'campus_name_en'=>'White', 'campus_name_ch'=>'白色', 'campus_name_jp'=>'白色', 'campus_name_sk'=>'白色', 'campus_name_ru'=>'白色');
	    return $arr;
	}
	
	function getcampus_name($campus_id, $langtype){
	    $arr = array();
	    if($campus_id == 1){
	        $arr = array('campus_id'=>1, 'campus_name_en'=>'Black', 'campus_name_ch'=>'黑色', 'campus_name_jp'=>'黑色', 'campus_name_sk'=>'黑色', 'campus_name_ru'=>'黑色');
	    }else if($campus_id == 2){
	        $arr = array('campus_id'=>2, 'campus_name_en'=>'White', 'campus_name_ch'=>'白色', 'campus_name_jp'=>'白色', 'campus_name_sk'=>'白色', 'campus_name_ru'=>'白色');
	    }
	    if(!empty($arr)){
	        return $arr['campus_name'.$langtype];
	    }else{
	        return null;
	    }
	}
	function getlengthlist(){
	    $arr = array();
	    $arr[] = array('length_id'=>2, 'length_name_en'=>'2 years', 'length_name_ch'=>'2 年', 'length_name_jp'=>'2 years', 'length_name_sk'=>'2 years', 'length_name_ru'=>'2 years');
	    $arr[] = array('length_id'=>3, 'length_name_en'=>'3 years', 'length_name_ch'=>'3 年', 'length_name_jp'=>'3 years', 'length_name_sk'=>'3 years', 'length_name_ru'=>'3 years');
	    $arr[] = array('length_id'=>4, 'length_name_en'=>'4 years', 'length_name_ch'=>'4 年', 'length_name_jp'=>'4 years', 'length_name_sk'=>'4 years', 'length_name_ru'=>'4 years');
	    $arr[] = array('length_id'=>5, 'length_name_en'=>'Master: 2 years <br />PhD: 4 years', 'length_name_ch'=>'硕士：2年 <br />博士：4年', 'length_name_jp'=>'硕士: 2年 <br />博士: 4年', 'length_name_sk'=>'석사과정: 2년 <br />박사과정: 4년 ', 'length_name_ru'=>'магистратура 2 года <br />докторантура 4 года');
	    $arr[] = array('length_id'=>6, 'length_name_en'=>'Master: 3 years <br />PhD: 4 years', 'length_name_ch'=>'硕士：3年 <br />博士：4年', 'length_name_jp'=>'硕士: 3年 <br />博士: 4年', 'length_name_sk'=>'석사과정: 3년 <br />박사과정: 4년 ', 'length_name_ru'=>'магистратура 3 года <br />докторантура 4 года');
	    return $arr;
	}
	function getlength_name($length_id, $langtype){
	    $arr = array();
	    if($length_id == 2){
	        $arr = array('length_id'=>2, 'length_name_en'=>'2 years', 'length_name_ch'=>'2年', 'length_name_jp'=>'2 years', 'length_name_sk'=>'2 years', 'length_name_ru'=>'2 years');
	    }else if($length_id == 3){
	        $arr = array('length_id'=>3, 'length_name_en'=>'3 years', 'length_name_ch'=>'3年', 'length_name_jp'=>'3 years', 'length_name_sk'=>'3 years', 'length_name_ru'=>'3 years');
	    }else if($length_id == 4){
	        $arr = array('length_id'=>4, 'length_name_en'=>'4 years', 'length_name_ch'=>'4年', 'length_name_jp'=>'4 years', 'length_name_sk'=>'4 years', 'length_name_ru'=>'4 years');
	    }else if($length_id == 5){
	        $arr = array('length_id'=>5, 'length_name_en'=>'Master: 2 years <br />PhD: 4 years', 'length_name_ch'=>'硕士：2年 <br />博士：4年', 'length_name_jp'=>'硕士: 2年 <br />博士: 4年', 'length_name_sk'=>'석사과정: 2년 <br />박사과정: 4년 ', 'length_name_ru'=>'магистратура 2 года <br />докторантура 4 года');
	    }else if($length_id == 6){
	        $arr = array('length_id'=>6, 'length_name_en'=>'Master: 3 years <br />PhD: 4 years', 'length_name_ch'=>'硕士：3年 <br />博士：4年', 'length_name_jp'=>'硕士: 3年 <br />博士: 4年', 'length_name_sk'=>'석사과정: 3년 <br />박사과정: 4년 ', 'length_name_ru'=>'магистратура 3 года <br />докторантура 4 года');
	    }
	    if(!empty($arr)){
	        return $arr['length_name'.$langtype];
	    }else{
	        return null;
	    }
	}
	
	function getlanguagelist(){
	    $arr = array();
	    $arr[] = array('language_id'=>1, 'language_name_en'=>'English', 'language_name_ch'=>'英文', 'language_name_jp'=>'English', 'language_name_sk'=>'English', 'language_name_ru'=>'English');
	    $arr[] = array('language_id'=>2, 'language_name_en'=>'Chinese', 'language_name_ch'=>'中文', 'language_name_jp'=>'Chinese', 'language_name_sk'=>'Chinese', 'language_name_ru'=>'Chinese');
	    return $arr;
	}
	
	function getlanguage_name($language_id, $langtype){
	    $arr = array();
	    if($language_id == 1){
	        $arr = array('language_id'=>1, 'language_name_en'=>'English', 'language_name_ch'=>'英文', 'language_name_jp'=>'English', 'language_name_sk'=>'English', 'language_name_ru'=>'English');
	    }else if($language_id == 2){
	        $arr = array('language_id'=>2, 'language_name_en'=>'Chinese', 'language_name_ch'=>'中文', 'language_name_jp'=>'Chinese', 'language_name_sk'=>'Chinese', 'language_name_ru'=>'Chinese');
	    }
	    if(!empty($arr)){
	        return $arr['language_name'.$langtype];
	    }else{
	        return null;
	    }
	}
	
	function getabcindex($num = 1){
	    if($num == 1){
	        $index = 'a';
	    }else if($num == 2){
	        $index = 'b';
	    }else if($num == 3){
	        $index = 'c';
	    }else if($num == 4){
	        $index = 'd';
	    }else if($num == 5){
	        $index = 'e';
	    }else if($num == 6){
	        $index = 'f';
	    }else if($num == 7){
	        $index = 'g';
	    }else if($num == 8){
	        $index = 'h';
	    }else if($num == 9){
	        $index = 'i';
	    }else if($num == 10){
	        $index = 'j';
	    }else if($num == 11){
	        $index = 'k';
	    }else if($num == 12){
	        $index = 'l';
	    }else if($num == 13){
	        $index = 'm';
	    }else if($num == 14){
	        $index = 'n';
	    }else if($num == 15){
	        $index = 'o';
	    }else if($num == 16){
	        $index = 'p';
	    }else if($num == 17){
	        $index = 'q';
	    }else if($num == 18){
	        $index = 'r';
	    }else if($num == 19){
	        $index = 's';
	    }else if($num == 20){
	        $index = 't';
	    }else if($num == 21){
	        $index = 'u';
	    }else if($num == 22){
	        $index = 'v';
	    }else if($num == 23){
	        $index = 'w';
	    }else if($num == 24){
	        $index = 'x';
	    }else if($num == 25){
	        $index = 'y';
	    }else if($num == 26){
	        $index = 'z';
	    }else{
	        $index = '';
	    }
	    return $index;
	}
	
	//检查邮箱是否已经被注册
	function checkemailisexists($email){
	    $sql = "
			SELECT *
			FROM ".DB_PRE()."user_list
			    
			WHERE (user_email = '".$email."')
		";
	    $userPhoneResult = $this->db->query($sql)->row_array();
	    if(!empty($userPhoneResult)){
	        return 'yes';
	    }else{
	        return 'no';
	    }
	}
	
	//用户登录
	function checkUser_login($email, $pwd){
	    $sql = "
			SELECT
			*
			FROM ".DB_PRE()."user_list
			WHERE (
			    (user_email = '$email' and password = '$pwd')
			)
		";
	    $result = $this->db->query($sql)->row_array();
	    if(!empty($result)){
	        return $result;
	    }else{
	        return null;
	    }
	}
	//获取新加坡区域option
	function getarea_select($area_id = 0){
	    $str = '';
	    
	    if($area_id == 1){$isselect = ' selected';}else{$isselect = '';}
	    $str .='<option value="1" '.$isselect.'>'.$this->WelModel->getarea_show(1).'</option>';
	    
	    if($area_id == 2){$isselect = ' selected';}else{$isselect = '';}
	    $str .='<option value="2" '.$isselect.'>'.$this->WelModel->getarea_show(2).'</option>';
	    
	    if($area_id == 3){$isselect = ' selected';}else{$isselect = '';}
	    $str .='<option value="3" '.$isselect.'>'.$this->WelModel->getarea_show(3).'</option>';
	    
	    if($area_id == 4){$isselect = ' selected';}else{$isselect = '';}
	    $str .='<option value="4" '.$isselect.'>'.$this->WelModel->getarea_show(4).'</option>';
	    
	    if($area_id == 5){$isselect = ' selected';}else{$isselect = '';}
	    $str .='<option value="5" '.$isselect.'>'.$this->WelModel->getarea_show(5).'</option>';
	    
	    return $str;
	}
	function getarea_show($area_id){
	    if($area_id == 1){
	        if($this->langtype == '_ch'){$area_name = '北区';}else{$area_name = 'North';}
	    }else if($area_id == 2){
	        if($this->langtype == '_ch'){$area_name = '南区';}else{$area_name = 'South';}
	    }else if($area_id == 3){
	        if($this->langtype == '_ch'){$area_name = '东区';}else{$area_name = 'East';}
	    }else if($area_id == 4){
	        if($this->langtype == '_ch'){$area_name = '西区';}else{$area_name = 'West';}
	    }else if($area_id == 5){
	        if($this->langtype == '_ch'){$area_name = '中心区';}else{$area_name = 'Central';}
	    }else{
	        $area_name = '';
	    }
	    return $area_name;
	}
	//获取语言option
	function getlanguage_select($area_id = 0){
	    $str = '';
	    
	    $this_lang_id = 1;
	    if($area_id == $this_lang_id){$isselect = ' selected';}else{$isselect = '';}
	    if($this->langtype == '_ch'){
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>中文</option>';
	    }else{
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Chinese</option>';
	    }
	    
	    $this_lang_id = 2;
	    if($area_id == $this_lang_id){$isselect = ' selected';}else{$isselect = '';}
	    if($this->langtype == '_ch'){
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>英文</option>';
	    }else{
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>English</option>';
	    }
	    
	    $this_lang_id = 3;
	    if($area_id == $this_lang_id){$isselect = ' selected';}else{$isselect = '';}
	    if($this->langtype == '_ch'){
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Teochew</option>';
	    }else{
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Teochew</option>';
	    }
	    
	    $this_lang_id = 4;
	    if($area_id == $this_lang_id){$isselect = ' selected';}else{$isselect = '';}
	    if($this->langtype == '_ch'){
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Cantonese</option>';
	    }else{
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Cantonese</option>';
	    }
	    
	    $this_lang_id = 5;
	    if($area_id == $this_lang_id){$isselect = ' selected';}else{$isselect = '';}
	    if($this->langtype == '_ch'){
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Hakka</option>';
	    }else{
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Hakka</option>';
	    }
	    
	    $this_lang_id = 6;
	    if($area_id == $this_lang_id){$isselect = ' selected';}else{$isselect = '';}
	    if($this->langtype == '_ch'){
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Hokkien</option>';
	    }else{
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Hokkien</option>';
	    }
	    
	    $this_lang_id = 7;
	    if($area_id == $this_lang_id){$isselect = ' selected';}else{$isselect = '';}
	    if($this->langtype == '_ch'){
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>其他</option>';
	    }else{
	        $str .='<option value="'.$this_lang_id.'" '.$isselect.'>Others</option>';
	    }
	    return $str;
	}
	function getlanguage_show($recordinfo, $section_name = 'checkbox_id_2', $input_name = 'input_3'){
	    $form_language_show = '';
	    for($ccc = 1; $ccc <= 10; $ccc++){
	        if($recordinfo[$section_name.'_'.$ccc] == 1){
	            if($form_language_show != ''){$form_language_show .= ',';}
	            if($this->langtype == '_ch'){$form_language_show .= '中文';}else{$form_language_show .= 'Chinese';}
	        }else if($recordinfo[$section_name.'_'.$ccc] == 2){
	            if($form_language_show != ''){$form_language_show .= ',';}
	            if($this->langtype == '_ch'){$form_language_show .= '英文';}else{$form_language_show .= 'English';}
	        }else if($recordinfo[$section_name.'_'.$ccc] == 3){
	            if($form_language_show != ''){$form_language_show .= ',';}
	            if($this->langtype == '_ch'){$form_language_show .= 'Teochew';}else{$form_language_show .= 'Teochew';}
	        }else if($recordinfo[$section_name.'_'.$ccc] == 4){
	            if($form_language_show != ''){$form_language_show .= ',';}
	            if($this->langtype == '_ch'){$form_language_show .= 'Cantonese';}else{$form_language_show .= 'Cantonese';}
	        }else if($recordinfo[$section_name.'_'.$ccc] == 5){
	            if($form_language_show != ''){$form_language_show .= ',';}
	            if($this->langtype == '_ch'){$form_language_show .= 'Hakka';}else{$form_language_show .= 'Hakka';}
	        }else if($recordinfo[$section_name.'_'.$ccc] == 6){
	            if($form_language_show != ''){$form_language_show .= ',';}
	            if($this->langtype == '_ch'){$form_language_show .= 'Hokkien';}else{$form_language_show .= 'Hokkien';}
	        }else if($recordinfo[$section_name.'_'.$ccc] == 7){
	            if($form_language_show != ''){$form_language_show .= ',';}
	            if($this->langtype == '_ch'){$form_language_show .= '其他: '.$recordinfo['input_3'];}else{$form_language_show .= 'Others: '.$recordinfo['input_3'];}
	        }
	    }
	    if($form_language_show == ''){
	        $form_language_show = '&nbsp;';
	    }
	    return $form_language_show;
	}
	function getlanguage_show_colorful($recordinfo, $section_name = 'checkbox_id_2', $input_name = 'input_3'){
	    $form_language_show = '';
	    for($ccc = 1; $ccc <= 10; $ccc++){
	        if($recordinfo[$section_name.'_'.$ccc] == 1){
	            $form_language_show .= '<div style="float:left;background:rgba(54, 162, 235, 0.2);border:1px solid rgb(54, 162, 235);border-radius:4px;padding:0px 5px;margin-left:5px;">';
	            if($this->langtype == '_ch'){$form_language_show .= '中文';}else{$form_language_show .= 'Chinese';}
	            $form_language_show .= '</div>';
	        }else if($recordinfo[$section_name.'_'.$ccc] == 2){
	            $form_language_show .= '<div style="float:left;background:rgba(255, 99, 132, 0.2);border:1px solid rgb(255, 99, 132);border-radius:4px;padding:0px 5px;margin-left:5px;">';
	            if($this->langtype == '_ch'){$form_language_show .= '英文';}else{$form_language_show .= 'English';}
	            $form_language_show .= '</div>';
	        }else if($recordinfo[$section_name.'_'.$ccc] == 3){
	            $form_language_show .= '<div style="float:left;background:rgba(38, 255, 255, 0.2);border:1px solid rgb(38, 255, 255);border-radius:4px;padding:0px 5px;margin-left:5px;">';
	            if($this->langtype == '_ch'){$form_language_show .= 'Teochew';}else{$form_language_show .= 'Teochew';}
	            $form_language_show .= '</div>';
	        }else if($recordinfo[$section_name.'_'.$ccc] == 4){
	            $form_language_show .= '<div style="float:left;background:rgba(255, 153, 153, 0.2);border:1px solid rgb(255, 153, 153);border-radius:4px;padding:0px 5px;margin-left:5px;">';
	            if($this->langtype == '_ch'){$form_language_show .= 'Cantonese';}else{$form_language_show .= 'Cantonese';}
	            $form_language_show .= '</div>';
	        }else if($recordinfo[$section_name.'_'.$ccc] == 5){
	            $form_language_show .= '<div style="float:left;background:rgba(153, 102, 255, 0.2);border:1px solid rgb(153, 102, 255);border-radius:4px;padding:0px 5px;margin-left:5px;">';
	            if($this->langtype == '_ch'){$form_language_show .= 'Hakka';}else{$form_language_show .= 'Hakka';}
	            $form_language_show .= '</div>';
	        }else if($recordinfo[$section_name.'_'.$ccc] == 6){
	            $form_language_show .= '<div style="float:left;background:rgba(255, 207, 191, 0.2);border:1px solid rgb(255, 207, 191);border-radius:4px;padding:0px 5px;margin-left:5px;">';
	            if($this->langtype == '_ch'){$form_language_show .= 'Hokkien';}else{$form_language_show .= 'Hokkien';}
	            $form_language_show .= '</div>';
	        }else if($recordinfo[$section_name.'_'.$ccc] == 7){
	            $form_language_show .= '<div style="float:left;background:rgba(255, 153, 153, 0.2);border:1px solid rgb(255, 153, 153);border-radius:4px;padding:0px 5px;margin-left:5px;">';
	            if($this->langtype == '_ch'){$form_language_show .= '其他: '.$recordinfo['input_3'];}else{$form_language_show .= 'Others: '.$recordinfo['input_3'];}
	            $form_language_show .= '</div>';
	        }
	    }
	    if($form_language_show == ''){
	        $form_language_show = '&nbsp;';
	    }
	    return $form_language_show;
	}
	//获取语言option
	function gettime_select($area_id = 0){
	    $str = '';
	    
	    if($area_id == 1){$isselect = ' selected';}else{$isselect = '';}
	    if($this->langtype == '_ch'){
	        $str .='<option value="1" '.$isselect.'>是</option>';
	    }else{
	        $str .='<option value="1" '.$isselect.'>Yes</option>';
	    }
	    
	    if($area_id == 2){$isselect = ' selected';}else{$isselect = '';}
	    if($this->langtype == '_ch'){
	        $str .='<option value="2" '.$isselect.'>否</option>';
	    }else{
	        $str .='<option value="2" '.$isselect.'>No</option>';
	    }
	    
	    return $str;
	}
	//显示可利用的时间
	function availabletimetableshow($recordinfo){
	    $availabletime_show = '';
	    if($this->langtype == '_ch'){$availabletime_leftwidth = '50';}else{$availabletime_leftwidth = '70';}
	    $availabletime_show .= '
            <table cellpadding="0" style="width:calc(100% - 10px);">
	        
        ';
	    //         <tr>
	    //         <td style="font-size:12px;padding:0px 0px;" width="'.$availabletime_leftwidth.'" align="center">&nbsp;</td>
	    //         <td style="font-size:12px;padding:0px 0px;" align="center">AM : 10–12pm</td>
	    //         <td style="font-size:12px;padding:0px 0px;" align="center">PM : 2-4pm</td>
	    //         </tr>
	    
	    if($this->langtype == '_ch'){$gou_title_name = '周一';}else{$gou_title_name = 'Monday';}
	    $section_name = 'select_id_9';
	    if($recordinfo[$section_name] == 1){$gou_left_show = '√';}else{$gou_left_show = '&nbsp;';}
	    $section_name = 'select_id_10';
	    if($recordinfo[$section_name] == 1){$gou_right_show = '√';}else{$gou_right_show = '&nbsp;';}
	    $availabletime_show .= '
        	<tr>
            	<td style="font-size:12px;padding:0px 0px;" align="center" width="'.$availabletime_leftwidth.'">'.$gou_title_name.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_left_show.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_right_show.'</td>
        	</tr>
        ';
	    
	    if($this->langtype == '_ch'){$gou_title_name = '周二';}else{$gou_title_name = 'Tuesday';}
	    $section_name = 'select_id_11';
	    if($recordinfo[$section_name] == 1){$gou_left_show = '√';}else{$gou_left_show = '&nbsp;';}
	    $section_name = 'select_id_12';
	    if($recordinfo[$section_name] == 1){$gou_right_show = '√';}else{$gou_right_show = '&nbsp;';}
	    $availabletime_show .= '
        	<tr>
            	<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_title_name.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_left_show.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_right_show.'</td>
        	</tr>
        ';
	    
	    if($this->langtype == '_ch'){$gou_title_name = '周三';}else{$gou_title_name = 'Wednesday';}
	    $section_name = 'select_id_13';
	    if($recordinfo[$section_name] == 1){$gou_left_show = '√';}else{$gou_left_show = '&nbsp;';}
	    $section_name = 'select_id_14';
	    if($recordinfo[$section_name] == 1){$gou_right_show = '√';}else{$gou_right_show = '&nbsp;';}
	    $availabletime_show .= '
        	<tr>
            	<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_title_name.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_left_show.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_right_show.'</td>
        	</tr>
        ';
	    
	    if($this->langtype == '_ch'){$gou_title_name = '周四';}else{$gou_title_name = 'Thursday';}
	    $section_name = 'select_id_15';
	    if($recordinfo[$section_name] == 1){$gou_left_show = '√';}else{$gou_left_show = '&nbsp;';}
	    $section_name = 'select_id_16';
	    if($recordinfo[$section_name] == 1){$gou_right_show = '√';}else{$gou_right_show = '&nbsp;';}
	    $availabletime_show .= '
        	<tr>
            	<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_title_name.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_left_show.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_right_show.'</td>
        	</tr>
        ';
	    
	    if($this->langtype == '_ch'){$gou_title_name = '周五';}else{$gou_title_name = 'Friday';}
	    $section_name = 'select_id_17';
	    if($recordinfo[$section_name] == 1){$gou_left_show = '√';}else{$gou_left_show = '&nbsp;';}
	    $section_name = 'select_id_18';
	    if($recordinfo[$section_name] == 1){$gou_right_show = '√';}else{$gou_right_show = '&nbsp;';}
	    $availabletime_show .= '
        	<tr>
            	<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_title_name.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_left_show.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_right_show.'</td>
        	</tr>
        ';
	    
	    if($this->langtype == '_ch'){$gou_title_name = '周六';}else{$gou_title_name = 'Saturday';}
	    $section_name = 'select_id_19';
	    if($recordinfo[$section_name] == 1){$gou_left_show = '√';}else{$gou_left_show = '&nbsp;';}
	    $section_name = 'select_id_20';
	    if($recordinfo[$section_name] == 1){$gou_right_show = '√';}else{$gou_right_show = '&nbsp;';}
	    $availabletime_show .= '
        	<tr>
            	<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_title_name.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_left_show.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_right_show.'</td>
        	</tr>
        ';
	    
	    if($this->langtype == '_ch'){$gou_title_name = '周日';}else{$gou_title_name = 'Sunday';}
	    $section_name = 'select_id_21';
	    if($recordinfo[$section_name] == 1){$gou_left_show = '√';}else{$gou_left_show = '&nbsp;';}
	    $section_name = 'select_id_22';
	    if($recordinfo[$section_name] == 1){$gou_right_show = '√';}else{$gou_right_show = '&nbsp;';}
	    $availabletime_show .= '
        	<tr>
            	<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_title_name.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_left_show.'</td>
        		<td style="font-size:12px;padding:0px 0px;" align="center">'.$gou_right_show.'</td>
        	</tr>
        ';
	    
	    $availabletime_show .= '</table>';
	    return $availabletime_show;
	}
	//获取记录详细
	function getrecordinfo($form_id){
	    $sql = "
            SELECT a.* 
            
            , b.form_pic_1_path AS volunteer_1_pic_1_path
            , b.input_1 AS volunteer_1_name
            , b.select_id_6 AS volunteer_1_shenfen
	        
            , c.form_pic_1_path AS volunteer_2_pic_1_path
            , c.input_1 AS volunteer_2_name
            , c.select_id_6 AS volunteer_2_shenfen
	        
            , d.form_pic_1_path AS volunteer_3_pic_1_path
            , d.input_1 AS volunteer_3_name
            , d.select_id_6 AS volunteer_3_shenfen
	        
            , f.form_pic_1_path AS volunteer_4_pic_1_path
            , f.input_1 AS volunteer_4_name
	        , f.select_id_6 AS volunteer_4_shenfen
	        
            , g.form_pic_1_path AS volunteer_5_pic_1_path
            , g.input_1 AS volunteer_5_name
            , g.select_id_6 AS volunteer_5_shenfen
	        
            , i.form_pic_1_path AS volunteer_6_pic_1_path
            , i.input_1 AS volunteer_6_name
            , i.select_id_6 AS volunteer_6_shenfen

            , e.form_pic_1_path AS driver_pic_1_path
            , e.input_1 AS driver_name
            , e.select_id_6 AS driver_shenfen

            FROM ".DB_PRE()."form_list AS a
            LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
            LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
            LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id

            LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
            LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
            LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
            LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
            
            WHERE a.form_id = ".$form_id."
        ";
	    $recordinfo = $this->db->query($sql)->row_array();
	    if(!empty($recordinfo)){
	        return $recordinfo;
	    }else{
	        return null;
	    }
	}
	//显示可利用的时间
	function toshowvolunteer_listbox($volunteerinfo, $con = array()){
	    if(isset($con['isneed_timeavailable'])){
	        $isneed_timeavailable = $con['isneed_timeavailable'];
	    }else{
	        $isneed_timeavailable = 1;
	    }
	    if(isset($con['isneed_address'])){
	        $isneed_address = $con['isneed_address'];
	    }else{
	        $isneed_address = 1;
	    }
	    if(isset($con['isneed_age'])){
	        $isneed_age = $con['isneed_age'];
	    }else{
	        $isneed_age = 1;
	    }
	    
	    
	    if($this->langtype == '_ch'){
	        $text_ishave_animal = '有动物吗？';
	        $text_gender = '性别';
	        $text_area = '区域';
	        $text_language_1 = ' 说: ';
	        $text_language_2 = ' 写: ';
	        $text_health = '当前健康';
	        $text_health_good = '良好';
	        $text_health_normal = '正常';
	        $text_health_poorweek = '状况不佳';
	        $text_health_bedbound = '卧床不起';
	        $text_enrolment = '关怀者';
	        $text_choose_volunteer = '选择义工';
	        $text_choose_fearofanimal = '害怕动物?';
	        $text_choose_address = '地址';
	        $text_needcarefortime = '关怀者需要家访的时间';
	        $text_yes = '是';
	        $text_no = '否';
	    }else{
	        $text_ishave_animal = 'Have Animal?';
	        $text_gender = 'Gender';
	        $text_area = 'Area';
	        $text_language_1 = ' Spoken';
	        $text_language_2 = ' Written';
	        $text_health = 'Current Health';
	        $text_health_good = 'Good';
	        $text_health_normal = 'Normal';
	        $text_health_poorweek = 'Poor/Weak';
	        $text_health_bedbound = 'Bed Bound';
	        $text_enrolment = 'Enrolment';
	        $text_choose_volunteer = 'Choose Volunteer';
	        $text_choose_fearofanimal = 'Fear of Animal?';
	        $text_choose_address = 'Address';
	        $text_needcarefortime = 'Enrolment Available';
	        $text_yes = 'Yes';
	        $text_no = 'No';
	    }
	    
	    $filename = $volunteerinfo['form_pic_1_path'];
	    $filename_arr = explode('.', $filename);
	    $file_type = end($filename_arr);
	    if($filename != ''){
	        $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
	    }else{
	        $filename_100x100 = '';
	    }
	    
	    if($volunteerinfo['select_id_1'] == 1){
	        $gender_show = '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/sex_male.jpg"/>';
	    }else if($volunteerinfo['select_id_1'] == 2){
	        $gender_show = '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/sex_female.jpg"/>';
	    }else{
	        $gender_show = '&nbsp;';
	    }
	    
	    if($volunteerinfo['select_id_8'] == 1){
	        $fearanimal_show = '
                <div style="float:left;"><input type="radio" class="mgr mgr-danger mgr-lg" checked disabled="disabled"></div>
                <div style="float:left;line-height:20px;margin-left:6px;color:#cf3b3a;">'.$text_yes.'</div>
            ';
	    }else if($volunteerinfo['select_id_8'] == 2){
	        $fearanimal_show = '
                <div style="float:left;"><input type="radio" class="mgr mgr-success mgr-lg" checked disabled="disabled"></div>
                <div style="float:left;line-height:20px;margin-left:6px;color:green;">'.$text_no.'</div>
            ';
	    }else{
	        $fearanimal_show = '&nbsp;';
	    }
	    
	    if($volunteerinfo['select_id_2'] != 0){
	        $age_show = $volunteerinfo['select_id_2'];if($this->langtype == '_ch'){$age_show .= '岁';}else{$age_show .= ' years old';}
	    }else{
	        $age_show = '&nbsp;';
	    }
	    
	    if($volunteerinfo['select_id_6'] == 3){
	        $drinver_shenfen_show = '<img style="width:16px;height:16px;" src="'.base_url().'themes/default/images/icon_driver_both_blue.png"/>';
	        $drinver_shenfen_color = 'color:#0788FF;';
	        $drinver_shenfen_value = 1;
	    }else{
	        $drinver_shenfen_show = '';
	        $drinver_shenfen_color = '';
	        $drinver_shenfen_value = 0;
	    }
	    
	    $address_select = $this->WelModel->getarea_show($volunteerinfo['select_id_23']).' '.$volunteerinfo['input_5'];
	    
	    
	    if($isneed_timeavailable == 1){
	        $leftinfoshow_css = 'width:260px;';
	        $availabletime_show = '<div style="float:left;width:calc(100% - 260px);line-height:12px;text-align:left;font-size:14px;margin-top:4px;">'.$this->WelModel->availabletimetableshow($volunteerinfo).'</div>';//显示可利用的时间
	    }else{
	        $leftinfoshow_css = 'width:100%;';
	        $availabletime_show = '';
	    }
	    if($isneed_address == 1){
	        $isneed_address_show = '<div style="float:left;width:100%;height:20px;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;word-break:break-all;" title="'.$address_select.'">'.$text_choose_address.'：<span style="font-weight:normal;">'.$address_select.'</span></div>';
	    }else{
	        $isneed_address_show = '';
	    }
// 	    if($isneed_age == 1){
// 	        $isneed_age_show = '<span style="font-weight:normal;">'.$age_show.'</span>';
// 	    }else{
	        $isneed_age_show = '';
// 	    }
	    $restr = '
            <div style="float:left;width:100%;">
                <div style="float:left;width:30px;">
                    <div style="cursor:pointer;float:left;width:30px;">
                        <div style="float:left;width:30px;height:30px;border-radius:4px;">
                            <div style="float:left;width:28px;height:28px;border:1px solid #EFEFEF;border-radius:50%;background:url('.base_url().$filename_100x100.') center center / cover no-repeat;">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <div style="float:left;width:calc(100% - 30px - 5px);margin-left:5px;">
                    <div style="float:left;'.$leftinfoshow_css.'line-height:20px;text-align:left;font-size:12px;">
                        <div style="float:left;width:100%;height:20px;font-weight:bold;'.$drinver_shenfen_color.'">
                            '.$volunteerinfo['input_1'].' '.$gender_show.' '.$isneed_age_show.' '.$drinver_shenfen_show.'
                        </div>
                        <div style="float:left;width:100%;height:20px;">
                           <div style="float:left;">'.$text_choose_fearofanimal.'</div><div style="float:left;margin-left:5px;font-weight:normal;">'.$fearanimal_show.'</div>
                        </div>
                        '.$isneed_address_show.'
                        <div style="float:left;width:100%;height:20px;">
                            <div style="float:left;margin-right:5px;"><div style="float:left;">'.$text_language_1.'：</div><div style="float:left;font-weight:normal;">'.$this->WelModel->getlanguage_show_colorful($volunteerinfo, 'checkbox_id_2', 'input_2').'</div></div>
                            <div style="float:left;"><div style="float:left;">'.$text_language_2.'：</div><div style="float:left;font-weight:normal;">'.$this->WelModel->getlanguage_show_colorful($volunteerinfo, 'checkbox_id_3', 'input_3').'</div></div>
                        </div>
                    </div>
                    '.$availabletime_show.'
                </div>
            </div>
        ';
	    return $restr;
	    
	}
	//获取当前义工或司机正在进行中的case 有多少个
	function getprocessing_casenum($volunteer_id){
	    $sql = "
            SELECT count(*) AS numcount
            FROM ".DB_PRE()."form_list AS a
            WHERE a.form_type = 'enrolmentform' AND a.status = 1 AND a.is_assigned = 1 AND a.is_closed = 0 AND a.is_finished = 0
            AND
            (
                (a.volunteer_1_id = ".$volunteer_id.")
                OR (a.volunteer_2_id = ".$volunteer_id.")
                OR (a.volunteer_3_id = ".$volunteer_id.")
                OR (a.volunteer_4_id = ".$volunteer_id.")
                OR (a.volunteer_5_id = ".$volunteer_id.")
                OR (a.volunteer_6_id = ".$volunteer_id.")
                OR (a.driver_id = ".$volunteer_id.")
            )
        ";
	    $havecaseres = $this->db->query($sql)->row_array();
	    if(!empty($havecaseres)){
	        if($havecaseres['numcount'] != ''){
	            $havecaseres_num = $havecaseres['numcount'];
	        }else{
	            $havecaseres_num = 0;
	        }
	    }else{
	        $havecaseres_num = 0;
	    }
	    return $havecaseres_num;
	}
	
	
	
	
	
	
}
