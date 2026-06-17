<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller{

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
	//用户列表
	function index(){
	    $row = $this->input->get('row', TRUE);
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
		
		$is_excel = $this->input->get('is_excel', TRUE);
		$keyword = $this->input->get('keyword', TRUE);
		$user_type = $this->input->get('user_type', TRUE);
		
		check_NUMBERinjection($row);//数字类型
		check_SQLinjection($keyword);//防止sql注入，防止js注入
		
		if($user_type == 1){
			$this->session->set_userdata('menu','user');
		}else if($user_type == 2){
			$this->session->set_userdata('menu','client');
		}else if($user_type == 3){
			$this->session->set_userdata('menu','providers');
		}else{
			$this->session->set_userdata('menu','user');
		}
		$con=array('orderby'=>'u.uid','orderby_res'=>'DESC');
		if($is_excel != 1){
			$con['row']=$row;
			$con['page']=$data['page'];
		}
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		if($user_type != ""){
			$con['user_type'] = $user_type;
		}
		$data['userlist'] = $this->UserModel->getuserlist($con);
		$data['count'] = $this->UserModel->getuserlist($con, 1);
		$url = base_url().'admins/user/index?keyword='.$keyword.'&page='.$page;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		
		$data['user_type'] = $user_type;
		if($is_excel != 1){
			$this->load->view('admin/user_list',$data);
		}else{
			$this->load->view('admin/user_list_excel_'.$user_type, $data);
		}
		
	}
	
	//供应商助理列表
	function assistant_list($user_type, $parent){
		//跳转到列表页面
		$backurl = $this->input->get('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/user/index?user_type='.$user_type;
			}
		}else{
			$decodebackurl = base_url().'admins/user/index?user_type='.$user_type;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		
		//导航栏
		if($user_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_manage').'</a> &gt; '.lang('dz_company_business_assistant_manage');
		}else if($user_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_company_business_manage').'</a> &gt; '.lang('dz_company_business_assistant_manage');
		}else if($user_type == 3){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('dz_user_contentproviders_manage').'</a> &gt; '.lang('dz_company_business_assistant_manage');
		}
	
		$con=array('parent'=>$parent, 'orderby'=>'u.uid', 'orderby_res'=>'DESC');
		$data['user_type'] = $user_type;
		$data['parent'] = $parent;
		$data['userlist']=$this->UserModel->getuserlist($con);
		$this->load->view('admin/user_assistant_list', $data);
	}
	
	//管理员助手列表
	function adminassistantlist(){
		
	    $row = $this->input->get('row', TRUE);
		if($row==""){$row=0;}
		$page = 50;
		$data['row']=$row;
		$data['page']=$page;
	
		$is_excel = $this->input->get('is_excel', TRUE);
		$admin_type = $this->input->get('admin_type', TRUE);
		if($admin_type == 1){
			$this->session->set_userdata('menu','superadmin');
		}else if($admin_type == 2){
			$this->session->set_userdata('menu','adminassistant');
		}else{
			$this->session->set_userdata('menu','adminassistant');
		}
		$keyword = $this->input->get('keyword', TRUE);
		
		check_NUMBERinjection($row);//数字类型
		check_SQLinjection($keyword);//防止sql注入，防止js注入
		
		$con = array('orderby'=>'u.admin_id','orderby_res'=>'DESC','row'=>$row,'page'=>$data['page']);
		if($keyword!=""){
			$con['keyword'] = $keyword;
		}
		if($admin_type!=""){
			$con['admin_type'] = $admin_type;
		}
		$data['adminlist']=$this->AdminModel->getadminlist($con);
		$data['count']=$this->AdminModel->getadminlist($con,1);
		$url = base_url().'admins/user/adminassistantlist?admin_type='.$admin_type.'&keyword='.$keyword;
		$data['fy'] = fy_backend($data['count'],$row,$url,$data['page'],5,2);
		$data['admin_type'] = $admin_type;
		if($is_excel != 1){
			$this->load->view('admin/user_admin_list',$data);
		}else{
			$this->load->view('admin/user_admin_list_excel_2',$data);
		}
		
	}
	//添加管理员助手
	function toadd_adminassistant($admin_type){
		//跳转到列表页面
		$backurl = $this->input->get('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/user/adminassistantlist?admin_type='.$admin_type;
			}
		}else{
			$decodebackurl = base_url().'admins/user/adminassistantlist?admin_type='.$admin_type;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($admin_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_super_manage').'</a> &gt; '.lang('cy_admin_super_add');
		}else if($admin_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_assistant_manage').'</a> &gt; '.lang('cy_admin_assistant_add');
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_assistant_manage').'</a> &gt; '.lang('cy_admin_assistant_add');
		}
		$data['admin_type'] = $admin_type;
		$this->load->view('admin/user_admin_add',$data);
	}
	//添加管理员助手 ------- 处理方法
	function add_adminassistant($admin_type){
		//用户信息
		$admin_username = $this->input->post('admin_username');//用户名
		$admin_realname = $this->input->post('admin_realname');//用户名
		$admin_phone = $this->input->post('admin_phone');//手机号码
		$admin_email = $this->input->post('admin_email');//邮箱
		$admin_password = $this->input->post('admin_password');
		$rules_id = $this->input->post('rules_id');
		
		$arr = array('edited_author'=>$this->admin_username, 'admin_type'=>$admin_type, 'created'=>time(), 'edited'=>time());
		//用户信息
		$arr['admin_username'] = $admin_username;
		$arr['admin_realname'] = $admin_realname;
		$arr['admin_phone'] = $admin_phone;
		$arr['admin_email'] = $admin_email;
		if($admin_password != ''){
			$arr['admin_password'] = md5($admin_password);
		}
		$arr['rules_id'] = $rules_id;
		$admin_id = $this->AdminModel->add_admin($arr);
		
		//跳转到列表页面
		$backurl = $this->input->post('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/user/adminassistantlist?admin_type='.$admin_type;
			}
		}else{
			$decodebackurl = base_url().'admins/user/adminassistantlist?admin_type='.$admin_type;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//修改管理员助手
	function toedit_adminassistant($admin_type, $admin_id){
		//跳转到列表页面
		$backurl = $this->input->get('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/user/adminassistantlist?admin_type='.$admin_type;
			}
		}else{
			$decodebackurl = base_url().'admins/user/adminassistantlist?admin_type='.$admin_type;
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		if($admin_type == 1){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_super_manage').'</a> &gt; '.lang('cy_admin_super_edit');
		}else if($admin_type == 2){
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_assistant_manage').'</a> &gt; '.lang('cy_admin_assistant_edit');
		}else{
			$data['url'] = '<a href="'.$decodebackurl.'">'.lang('cy_admin_assistant_manage').'</a> &gt; '.lang('cy_admin_assistant_edit');
		}
		
		$data['admin_type'] = $admin_type;
	
		$data['admininfo']=$this->AdminModel->getadmininfo($admin_id);
		$this->load->view('admin/user_admin_edit',$data);
	}
	//修改管理员助手 ------- 处理方法
	function edit_adminassistant($admin_type, $admin_id){
		$old_admininfo = $this->AdminModel->getadmininfo($admin_id);
		//用户信息
		$admin_username = $this->input->post('admin_username');//用户名
		$admin_realname = $this->input->post('admin_realname');//用户名
		$admin_phone = $this->input->post('admin_phone');//手机号码
		$admin_email = $this->input->post('admin_email');//邮箱
		$admin_password = $this->input->post('admin_password');
		$rules_id = $this->input->post('rules_id');
		
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>time());
		//用户信息
		$arr['admin_username'] = $admin_username;
		$arr['admin_realname'] = $admin_realname;
		$arr['admin_phone'] = $admin_phone;
		$arr['admin_email'] = $admin_email;
		if($admin_password != ''){
			$arr['admin_password'] = md5($admin_password);
		}
		if($old_admininfo['admin_type'] == 1){
			$arr['rules_id'] = 0;
		}else{
			$arr['rules_id'] = $rules_id;
		}
		$this->AdminModel->edit_admin($admin_id, $arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl', TRUE);
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode($backurl);
			}else{
				$decodebackurl = base_url().'admins/user/adminassistantlist?admin_type='.$admin_type;
			}
		}else{
			$decodebackurl = base_url().'admins/user/adminassistantlist?admin_type='.$admin_type;
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	//删除管理员助手
	function del_adminassistant($admin_id){
		$this->AdminModel->del_admin($admin_id);
	}
	
	
	
}