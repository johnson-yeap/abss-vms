<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cms extends CI_Controller{

	function __construct(){
		parent::__construct();
		
		if(isset($_COOKIE[DB_PRE().'admininfo'])){
		    $admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
		    $this->admin_id = $admininfo['admin_id'];
		    $this->admin_type = $admininfo['admin_type'];
		    $this->rules_id = $admininfo['rules_id'];
		    $this->admin_username = $admininfo['admin_username'];
		    $this->admin_realname = $admininfo['admin_realname'];
		    
		    //重新续期cookie
		    $arr = array('admin_id'=>$admininfo['admin_id'], 'admin_username'=>$admininfo['admin_username'], 'admin_type'=>$admininfo['admin_type'], 'rules_id'=>$admininfo['rules_id'], 'admin_realname'=>$admininfo['admin_realname']);
		    $arr = serialize($arr);
		    $this->input->set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
		}else{
		    $this->admin_id = 0;
		    $this->admin_type = 0;
		    $this->rules_id = 0;
		    $this->admin_username = '';
		    $this->admin_realname = '';
		    
		    exit('请进入登录入口重新登录');
		    return false;exit;
		}
		$lang = $this->session->userdata('adminlang');
		if($lang == 'ch'){
		    $this->session->set_userdata('adminlang', 'ch');
		    $this->langtype = '_ch';
		    $this->lang->load('gksel', 'chinese');
		}else{
		    $this->session->set_userdata('adminlang', 'en');
		    $this->langtype = '_en';
		    $this->lang->load('gksel', 'english');
		}
		if($this->langtype == '_ch'){
		    $this->reland = 'cn';
		}else{
		    $this->reland = 'en';
		}
	}
	
	//内容列表
	function index(){
		$this->session->set_userdata('menu','cms');
		$row = $this->input->get('row', TRUE);
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$is_excel = $this->input->get('is_excel', TRUE);
		$keyword = $this->input->get('keyword', TRUE);
		$group_id = $this->input->get('group_id', TRUE);
		$langtype = $this->input->get('langtype', TRUE);
		
		check_NUMBERinjection($row);//数字类型
		check_SQLinjection($keyword);//防止sql注入，防止js注入
		
		if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){
		    $con = array('orderby'=>'a.cms_date_time', 'orderby_res'=>'DESC','row'=>$row,'page'=>$data['page']);
		}else{
		    $con = array('orderby'=>'a.sort', 'orderby_res'=>'ASC','row'=>$row,'page'=>$data['page']);
		}
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		if($group_id != "" && $group_id != 0){
			$con['group_id'] = $group_id;
		}
		if($langtype != ""){
		    $con['langtype'.$langtype] = 1;
		}
		$con['parent'] = 0;
		
		$data['cmslist'] = $this->CmsModel->getcmslist($con);
		$data['count'] = $this->CmsModel->getcmslist($con, 1);
		$url = base_url().'admins/cms/index?langtype='.$langtype.'&keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		
		$data['group_id'] = $group_id;
		
		if($is_excel != 1){
			$this->load->view('admin/cms_list',$data);
		}else{
			$this->load->view('admin/cms_list_excel',$data);
		}
	}
	
	//添加商品
	function toadd_cms($group_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
			}
		}else{
			$decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_cms_manage').'</a> &gt; '.lang('dz_cms_add');
		
		$data['group_id'] = $group_id;
		
		$this->load->view('admin/cms_add', $data);
	}
	//添加商品 ------- 处理方法
	function add_cms($group_id){
		$lancodelist = getlancodelist();//多语言
		$postOBJ = $this->input->post('GETOBJ');
		$postOBJ_type = $this->input->post('GETOBJ_type');
		$postOBJ_realname = $this->input->post('GETOBJ_realname');
		$postLANGOBJ = $this->input->post('GETLANGOBJ');
		//获取内容
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
					${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
				}
			}
		}
		if (!empty($postLANGOBJ)) {
			for ($lc = 0; $lc < count($lancodelist); $lc++) {
				for ($p = 0; $p < count($postLANGOBJ); $p++) {
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//内容名称
					if($postLANGOBJ[$p] == 'cms_comment'){
					   ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					}
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = preg_replace_content(pregreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('{sign_douhao}', "'", ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('text-wrap: nowrap;', '', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('style="white-space: normal;"', 'style="max-width:100%;"', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('style=""', '', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace("style=''", "", ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = enbaseurlcontent(${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
				}
			}
		}
		$arr = array('group_id'=>$group_id, 'cms_key'=>randkey(32), 'edited_author'=>$this->admin_username, 'created'=>time(), 'edited'=>time());
		//处理内容到数据库
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					$arr[$postOBJ[$p]] = ${$postOBJ[$p]};
				}
			}
		}
		if (!empty($postLANGOBJ)) {
			for ($lc = 0; $lc < count($lancodelist); $lc++) {
				for ($p = 0; $p < count($postLANGOBJ); $p++) {
					$arr[$postLANGOBJ[$p].$lancodelist[$lc]['langtype']] = ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']};
				}
			}
		}
		
		if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){
		    $cms_date = $this->input->post('cms_date', TRUE);
		    $cms_date_time = strtotime($cms_date.':00');
		    
		    $arr['cms_date_time'] = $cms_date_time;
		    $arr['cms_date_year'] = date('Y', $cms_date_time);
		    $arr['cms_date_month'] = date('m', $cms_date_time);
		    $arr['cms_date_day'] = date('d', $cms_date_time);
		}
		$cms_id = $this->CmsModel->add_cms($arr);
		
		
	    //处理附件-----START
	    $linshi_pic_1_path = $this->input->post('linshi_pic_1_path', TRUE);
	    $linshi_pic_1_name = $this->input->post('linshi_pic_1_name', TRUE);
	    $table_name = DB_PRE().'cms_list';
	    $table_ziduan_name = 'cms';
	    $table_ziduan_subname = 'pic';
	    $dataunique_name = 'cms_id';
	    if($group_id == 7){
	        $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 6);////处理附件
	    }else if($group_id == 401){
	        $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 20);////处理附件
	    }else{
	        $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
	    }
	    //处理附件-----END
		
		
		//处理附件-----START
		$linshi_pic_2_path = $this->input->post('linshi_pic_2_path', TRUE);
		$linshi_pic_2_name = $this->input->post('linshi_pic_2_name', TRUE);
		$table_name = DB_PRE().'cms_list';
		$table_ziduan_name = 'cms';
		$table_ziduan_subname = 'pic2';
		$dataunique_name = 'cms_id';
		$this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_2_path, $linshi_pic_2_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
		//处理附件-----END
		
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
			}
		}else{
			$decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	//修改商品
	function toedit_cms($group_id, $cms_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
			}
		}else{
			$decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_cms_manage').'</a> &gt; '.lang('dz_cms_edit');
		
		$data['cmsinfo'] = $this->CmsModel->getcmsinfo($cms_id);
		
		$data['group_id'] = $group_id;
		$data['cms_id'] = $cms_id;
		
		$this->load->view('admin/cms_edit', $data);
	}
	//修改商品 ------- 处理方法
	function edit_cms($group_id, $cms_id){
		$lancodelist = getlancodelist();//多语言
		$postOBJ = $this->input->post('GETOBJ');
		$postOBJ_type = $this->input->post('GETOBJ_type');
		$postOBJ_realname = $this->input->post('GETOBJ_realname');
		$postLANGOBJ = $this->input->post('GETLANGOBJ');
		//获取内容
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
					${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
				}
			}
		}
		if (!empty($postLANGOBJ)) {
			for ($lc = 0; $lc < count($lancodelist); $lc++) {
				for ($p = 0; $p < count($postLANGOBJ); $p++) {
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//内容名称
					if($postLANGOBJ[$p] == 'cms_comment'){
					    ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					}
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = preg_replace_content(pregreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('{sign_douhao}', "'", ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('text-wrap: nowrap;', '', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('style="white-space: normal;"', 'style="max-width:100%;"', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('style=""', '', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace("style=''", "", ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
					
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = enbaseurlcontent(${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
				}
			}
		}
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>time());
		//处理内容到数据库
		if (!empty($postOBJ)) {
			for ($p = 0; $p < count($postOBJ); $p++) {
				if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
					$arr[$postOBJ[$p]] = ${$postOBJ[$p]};
				}
			}
		}
		if (!empty($postLANGOBJ)) {
			for ($lc = 0; $lc < count($lancodelist); $lc++) {
				for ($p = 0; $p < count($postLANGOBJ); $p++) {
					$arr[$postLANGOBJ[$p].$lancodelist[$lc]['langtype']] = ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']};
				}
			}
		}
		
		if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){
		    $cms_date = $this->input->post('cms_date', TRUE);
		    $cms_date_time = strtotime($cms_date.':00');
		    
		    $arr['cms_date_time'] = $cms_date_time;
		    $arr['cms_date_year'] = date('Y', $cms_date_time);
		    $arr['cms_date_month'] = date('m', $cms_date_time);
		    $arr['cms_date_day'] = date('d', $cms_date_time);
		}
		
// 		print_r($arr);exit;
		$this->CmsModel->edit_cms($cms_id, $arr);
		
		
		//处理附件-----START
		$linshi_pic_1_path = $this->input->post('linshi_pic_1_path', TRUE);
		$linshi_pic_1_name = $this->input->post('linshi_pic_1_name', TRUE);
		$table_name = DB_PRE().'cms_list';
		$table_ziduan_name = 'cms';
		$table_ziduan_subname = 'pic';
		$dataunique_name = 'cms_id';
		if($group_id == 7){
		    $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 6);////处理附件
		}else if($group_id == 401){
		    $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 20);////处理附件
		}else if($group_id == 206){
		    $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 10);////处理附件
		}else{
		    $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
		}
		//处理附件-----END
		
		//处理附件-----START
		$linshi_pic_2_path = $this->input->post('linshi_pic_2_path', TRUE);
		$linshi_pic_2_name = $this->input->post('linshi_pic_2_name', TRUE);
		$table_name = DB_PRE().'cms_list';
		$table_ziduan_name = 'cms';
		$table_ziduan_subname = 'pic2';
		$dataunique_name = 'cms_id';
		$this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_2_path, $linshi_pic_2_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
		//处理附件-----END
		
		
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
			}
		}else{
			$decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	//修改商品
	function toadd_subcms($group_id, $parent){
	    //跳转到列表页面
	    $backurl = $this->input->get('backurl', TRUE);
	    if($backurl!=""){
	        $backurl=str_replace('slash_tag','/',$backurl);
	        if(base64_decode($backurl)!=""){
	            $decodebackurl = base64_decode($backurl);
	        }else{
	            $decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
	        }
	    }else{
	        $decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
	    }
	    $data['decodebackurl'] = $decodebackurl;
	    $data['backurl'] = $backurl;
	    //导航栏
	    $data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_cms_manage').'</a> &gt; '.lang('dz_cms_edit');
	    
	    $data['group_id'] = $group_id;
	    $data['parent'] = $parent;
	    
	    $this->load->view('admin/cms_add_sub', $data);
	}
	//修改商品 ------- 处理方法
	function add_subcms($group_id, $parent){
	    $lancodelist = getlancodelist();//多语言
	    $postOBJ = $this->input->post('GETOBJ');
	    $postOBJ_type = $this->input->post('GETOBJ_type');
	    $postOBJ_realname = $this->input->post('GETOBJ_realname');
	    $postLANGOBJ = $this->input->post('GETLANGOBJ');
	    //获取内容
	    if (!empty($postOBJ)) {
	        for ($p = 0; $p < count($postOBJ); $p++) {
	            if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
	                ${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
	                ${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
	            }
	        }
	    }
	    if (!empty($postLANGOBJ)) {
	        for ($lc = 0; $lc < count($lancodelist); $lc++) {
	            for ($p = 0; $p < count($postLANGOBJ); $p++) {
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//内容名称
	                if($postLANGOBJ[$p] == 'cms_comment'){
	                    ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                }
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = preg_replace_content(pregreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('{sign_douhao}', "'", ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('text-wrap: nowrap;', '', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('style="white-space: normal;"', 'style="max-width:100%;"', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('style=""', '', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace("style=''", "", ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = enbaseurlcontent(${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	            }
	        }
	    }
	    $arr = array('group_id'=>$group_id, 'parent'=>$parent, 'edited_author'=>$this->admin_username, 'edited'=>time(), 'created'=>time());
	    //处理内容到数据库
	    if (!empty($postOBJ)) {
	        for ($p = 0; $p < count($postOBJ); $p++) {
	            if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
	                $arr[$postOBJ[$p]] = ${$postOBJ[$p]};
	            }
	        }
	    }
	    if (!empty($postLANGOBJ)) {
	        for ($lc = 0; $lc < count($lancodelist); $lc++) {
	            for ($p = 0; $p < count($postLANGOBJ); $p++) {
	                $arr[$postLANGOBJ[$p].$lancodelist[$lc]['langtype']] = ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']};
	            }
	        }
	    }
	    
        $cms_date = $this->input->post('cms_date', TRUE);
        $cms_date_time = strtotime($cms_date.':00');
        
        $arr['cms_date_time'] = $cms_date_time;
        $arr['cms_date_year'] = date('Y', $cms_date_time);
        $arr['cms_date_month'] = date('m', $cms_date_time);
        $arr['cms_date_day'] = date('d', $cms_date_time);
	    
	    // 		print_r($arr);exit;
	    $cms_id = $this->CmsModel->add_cms($arr);
	    
	    
	    //处理附件-----START
	    $linshi_pic_1_path = $this->input->post('linshi_pic_1_path', TRUE);
	    $linshi_pic_1_name = $this->input->post('linshi_pic_1_name', TRUE);
	    $table_name = DB_PRE().'cms_list';
	    $table_ziduan_name = 'cms';
	    $table_ziduan_subname = 'pic';
	    $dataunique_name = 'cms_id';
	    $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
	    //处理附件-----END
	    
	    //处理附件-----START
	    $linshi_pic_2_path = $this->input->post('linshi_pic_2_path', TRUE);
	    $linshi_pic_2_name = $this->input->post('linshi_pic_2_name', TRUE);
	    $table_name = DB_PRE().'cms_list';
	    $table_ziduan_name = 'cms';
	    $table_ziduan_subname = 'pic2';
	    $dataunique_name = 'cms_id';
	    $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_2_path, $linshi_pic_2_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
	    //处理附件-----END
	    
	    
	    
	    //跳转到列表页面
	    $backurl = $this->input->post('backurl', TRUE);
	    if($backurl!=""){
	        $backurl=str_replace('slash_tag','/',$backurl);
	        if(base64_decode($backurl)!=""){
	            $decodebackurl = base64_decode($backurl);
	        }else{
	            $decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
	        }
	    }else{
	        $decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
	    }
	    echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改商品
	function toedit_subcms($group_id, $cms_id){
	    //跳转到列表页面
	    $backurl = $this->input->get('backurl', TRUE);
	    if($backurl!=""){
	        $backurl=str_replace('slash_tag','/',$backurl);
	        if(base64_decode($backurl)!=""){
	            $decodebackurl = base64_decode($backurl);
	        }else{
	            $decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
	        }
	    }else{
	        $decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
	    }
	    $data['decodebackurl'] = $decodebackurl;
	    $data['backurl'] = $backurl;
	    //导航栏
	    $data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_cms_manage').'</a> &gt; '.lang('dz_cms_edit');
	    
	    $data['cmsinfo'] = $this->CmsModel->getcmsinfo($cms_id);
	    
	    $data['group_id'] = $group_id;
	    $data['cms_id'] = $cms_id;
	    
	    $this->load->view('admin/cms_edit_sub', $data);
	}
	//修改商品 ------- 处理方法
	function edit_subcms($group_id, $cms_id){
	    $lancodelist = getlancodelist();//多语言
	    $postOBJ = $this->input->post('GETOBJ');
	    $postOBJ_type = $this->input->post('GETOBJ_type');
	    $postOBJ_realname = $this->input->post('GETOBJ_realname');
	    $postLANGOBJ = $this->input->post('GETLANGOBJ');
	    //获取内容
	    if (!empty($postOBJ)) {
	        for ($p = 0; $p < count($postOBJ); $p++) {
	            if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
	                ${$postOBJ[$p]} = $this->input->post($postOBJ[$p]);
	                ${$postOBJ[$p]} = replace_content(defaultreparr(), ${$postOBJ[$p]});
	            }
	        }
	    }
	    if (!empty($postLANGOBJ)) {
	        for ($lc = 0; $lc < count($lancodelist); $lc++) {
	            for ($p = 0; $p < count($postLANGOBJ); $p++) {
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//内容名称
	                if($postLANGOBJ[$p] == 'cms_comment'){
	                    ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                }
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = preg_replace_content(pregreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('{sign_douhao}', "'", ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('text-wrap: nowrap;', '', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('style="white-space: normal;"', 'style="max-width:100%;"', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('max-max-width', 'max-width', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace('style=""', '', ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = str_replace("style=''", "", ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	                
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = enbaseurlcontent(${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
	            }
	        }
	    }
	    $arr = array('edited_author'=>$this->admin_username, 'edited'=>time());
	    //处理内容到数据库
	    if (!empty($postOBJ)) {
	        for ($p = 0; $p < count($postOBJ); $p++) {
	            if($postOBJ_type[$p] != 'image' && $postOBJ_type[$p] != 'file'){
	                $arr[$postOBJ[$p]] = ${$postOBJ[$p]};
	            }
	        }
	    }
	    if (!empty($postLANGOBJ)) {
	        for ($lc = 0; $lc < count($lancodelist); $lc++) {
	            for ($p = 0; $p < count($postLANGOBJ); $p++) {
	                $arr[$postLANGOBJ[$p].$lancodelist[$lc]['langtype']] = ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']};
	            }
	        }
	    }
	    
        $cms_date = $this->input->post('cms_date', TRUE);
        $cms_date_time = strtotime($cms_date.':00');
        
        $arr['cms_date_time'] = $cms_date_time;
        $arr['cms_date_year'] = date('Y', $cms_date_time);
        $arr['cms_date_month'] = date('m', $cms_date_time);
        $arr['cms_date_day'] = date('d', $cms_date_time);
	    
	    // 		print_r($arr);exit;
	    $this->CmsModel->edit_cms($cms_id, $arr);
	    
	    
	    //处理附件-----START
	    $linshi_pic_1_path = $this->input->post('linshi_pic_1_path', TRUE);
	    $linshi_pic_1_name = $this->input->post('linshi_pic_1_name', TRUE);
	    $table_name = DB_PRE().'cms_list';
	    $table_ziduan_name = 'cms';
	    $table_ziduan_subname = 'pic';
	    $dataunique_name = 'cms_id';
	    $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
	    //处理附件-----END
	    
	    //处理附件-----START
	    $linshi_pic_2_path = $this->input->post('linshi_pic_2_path', TRUE);
	    $linshi_pic_2_name = $this->input->post('linshi_pic_2_name', TRUE);
	    $table_name = DB_PRE().'cms_list';
	    $table_ziduan_name = 'cms';
	    $table_ziduan_subname = 'pic2';
	    $dataunique_name = 'cms_id';
	    $this->WelModel->action_normal_fujian_mul($cms_id, $dataunique_name, $linshi_pic_2_path, $linshi_pic_2_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
	    //处理附件-----END
	    
	    
	    //跳转到列表页面
	    $backurl = $this->input->post('backurl', TRUE);
	    if($backurl!=""){
	        $backurl=str_replace('slash_tag','/',$backurl);
	        if(base64_decode($backurl)!=""){
	            $decodebackurl = base64_decode($backurl);
	        }else{
	            $decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
	        }
	    }else{
	        $decodebackurl = base_url().'admins/cms/index?group_id='.$group_id;
	    }
	    echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除商品
	function del_cms($cms_id){
		$this->CmsModel->del_cms($cms_id);
	}
	
	//内容列表 -- 排序功能
	function editcms_sort(){
	    $idarr = $this->input->post('idarr', TRUE);
	    $newsrot = $this->input->post('newsrot', TRUE);
	    if(!empty($idarr)){
	        for($i = 0; $i < count($idarr); $i++){
	            $arr = array('sort'=>$newsrot[$i]);
	            $this->CmsModel->edit_cms($idarr[$i], $arr);
	        }
	    }
	}
	
	//检查短网址是否可用
	function checkavailable_shorturl($group_id, $short_url, $cms_id = 0){
	    $short_url = trim($short_url);
	    
	    check_SQLinjection($short_url);//防止sql注入，防止js注入
	    check_NUMBERinjection($cms_id);//数字类型
	    
	    $sql = "SELECT * FROM ".DB_PRE()."cms_list WHERE short_url = '".$short_url."' AND group_id = ".$group_id." AND cms_id != ".$cms_id;
	    $checkres = $this->db->query($sql)->row_array();
	    if(!empty($checkres)){
	        echo 0;
	    }else{
	        echo 1;
	    }
	}
	
	
}