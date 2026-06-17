<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe extends CI_Controller{

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
	
	//订阅列表
	function index(){
		$this->session->set_userdata('menu','subscribe');
		$row = $this->input->get('row', TRUE);
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$is_excel = $this->input->get('is_excel', TRUE);
		$keyword = $this->input->get('keyword', TRUE);
		$category_id = $this->input->get('category_id', TRUE);
		
		check_NUMBERinjection($row);//数字类型
		check_SQLinjection($keyword);//防止sql注入，防止js注入
		
		$con = array('orderby'=>'a.subscribe_date_time', 'orderby_res'=>'DESC', 'row'=>$row, 'page'=>$data['page']);
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		if($category_id!=""){
			$con['category_id'] = $category_id;
		}
		$data['subscribelist'] = $this->SubscribeModel->getsubscribelist($con);
		$data['count'] = $this->SubscribeModel->getsubscribelist($con, 1);
		$url = base_url().'admins/subscribe/index?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'], $row, $url, $data['page'], 5, 2);
		
		if($is_excel != 1){
			$this->load->view('admin/subscribe_list',$data);
		}else{
			$this->load->view('admin/subscribe_list_excel',$data);
		}
	}
	//检查短网址是否可用
	function checkavailable_shorturl($short_url, $subscribe_id = 0){
	    $short_url = trim($short_url);
	    check_SQLinjection($short_url);//防止sql注入，防止js注入
	    $sql = "SELECT * FROM ".DB_PRE()."subscribe_list WHERE short_url = '".$short_url."' AND subscribe_id != ".$subscribe_id;
	    $checkres = $this->db->query($sql)->row_array();
	    if(!empty($checkres)){
	        echo 0;
	    }else{
	        echo 1;
	    }
	}
	
	//添加订阅
	function toadd_subscribe(){
		//跳转到列表页面
		$backurl = base64_encode(base_url().'admins/subscribe/index');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/subscribe/index';
			}
		}else{
			$decodebackurl = base_url().'admins/subscribe/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_subscribe_manage').'</a> &gt; '.lang('dz_subscribe_add');
		
		$this->load->view('admin/subscribe_add',$data);
	}
	//添加订阅 ------- 处理方法
	function add_subscribe(){
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
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//订阅名称
// 					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
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
		$arr = array('subscribe_key'=>randkey(32), 'edited_author'=>$this->admin_username, 'created'=>time(), 'edited'=>time());
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
		$subscribe_id = $this->SubscribeModel->add_subscribe($arr);
		

		$subscribe_date = $this->input->post('subscribe_date', TRUE);
		$subscribe_date_time = strtotime($subscribe_date.':00');
		
		$arr = array();
		$arr['subscribe_date_time'] = $subscribe_date_time;
		$arr['subscribe_date_year'] = date('Y', $subscribe_date_time);
		$arr['subscribe_date_month'] = date('m', $subscribe_date_time);
		$arr['subscribe_date_day'] = date('d', $subscribe_date_time);
		$this->SubscribeModel->edit_subscribe($subscribe_id, $arr);
		
		
		//处理附件-----START
		$linshi_picpath = $this->input->post('linshi_picpath', TRUE);
		$linshi_picname = $this->input->post('linshi_picname', TRUE);
		$table_name = DB_PRE().'subscribe_list';
		$table_ziduan_name = 'subscribe';
		$dataunique_name = 'subscribe_id';
		$this->WelModel->action_normal_fujian_single($subscribe_id, $dataunique_name, $linshi_picpath, $linshi_picname, $table_name, $table_ziduan_name);////处理附件
		//处理附件-----END
		
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/subscribe/index';
			}
		}else{
			$decodebackurl = base_url().'admins/subscribe/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	//修改订阅
	function toedit_subscribe($subscribe_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/subscribe/index';
			}
		}else{
			$decodebackurl = base_url().'admins/subscribe/index';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_subscribe_manage').'</a> &gt; '.lang('dz_subscribe_edit');
		
		$data['subscribeinfo'] = $this->SubscribeModel->getsubscribeinfo($subscribe_id);
		$this->load->view('admin/subscribe_edit',$data);
	}
	//修改订阅 ------- 处理方法
	function edit_subscribe($subscribe_id){
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
					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//订阅名称
// 					${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = replace_content(defaultreparr(), ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']});
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
		$this->SubscribeModel->edit_subscribe($subscribe_id, $arr);
		
		
		$subscribe_date = $this->input->post('subscribe_date', TRUE);
		$subscribe_date_time = strtotime($subscribe_date.':00');
		
		$arr = array();
		$arr['subscribe_date_time'] = $subscribe_date_time;
		$arr['subscribe_date_year'] = date('Y', $subscribe_date_time);
		$arr['subscribe_date_month'] = date('m', $subscribe_date_time);
		$arr['subscribe_date_day'] = date('d', $subscribe_date_time);
		$this->SubscribeModel->edit_subscribe($subscribe_id, $arr);
		
		
		//处理附件-----START
		$linshi_picpath = $this->input->post('linshi_picpath', TRUE);
		$linshi_picname = $this->input->post('linshi_picname', TRUE);
		$table_name = DB_PRE().'subscribe_list';
		$table_ziduan_name = 'subscribe';
		$dataunique_name = 'subscribe_id';
		$this->WelModel->action_normal_fujian_single($subscribe_id, $dataunique_name, $linshi_picpath, $linshi_picname, $table_name, $table_ziduan_name);////处理附件
		//处理附件-----END
		
		
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/subscribe/index';
			}
		}else{
			$decodebackurl = base_url().'admins/subscribe/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除订阅
	function del_subscribe($subscribe_id){
		$this->SubscribeModel->del_subscribe($subscribe_id);
	}
	//订阅列表 -- 排序功能
	function editsubscribe_sort(){
		$idarr = $this->input->post('idarr', TRUE);
		$newsrot = $this->input->post('newsrot', TRUE);
		if(!empty($idarr)){
			for($i = 0; $i < count($idarr); $i++){
				$arr = array('sort'=>$newsrot[$i]);
				$this->SubscribeModel->edit_subscribe($idarr[$i], $arr);
			}
		}
	}
	
	
	
}