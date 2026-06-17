<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email extends CI_Controller{

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
	//邮件列表
	function index(){
		$this->session->set_userdata('menu', 'emaillist');
		$con = array('parent'=>0, 'orderby'=>'a.email_id', 'orderby_res'=>'ASC');
		$data['emaillist'] = $this->EmailModel->getemaillist($con);
		$this->load->view('admin/setting_email_list', $data);
	}
	
	//修改商品分类
	function toedit_email($email_id){
// 	    $arr = array();
// 	    $arr[] = '{from_page}';
// 	    $arr[] = '{full_name}';
// 	    $arr[] = '{phone_number}';
// 	    $arr[] = '{email_address}';
// 	    $arr[] = '{website_address}';
// 	    $arr[] = '{talk_about}';
// 	    echo serialize($arr);exit;
	    
		//跳转到列表页面
		$backurl = $this->input->get('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/product/categorylist';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/product/categorylist';
		}
		$data['decodebackurl'] = $decodebackurl;
		$data['backurl'] = $backurl;
		//导航栏
		$data['url'] = '<a href="'.$decodebackurl.'">Manage Auto Response</a> &gt; Edit Email';
	
		$data['emailinfo']=$this->EmailModel->getemailinfo($email_id);
		$this->load->view('admin/setting_email_edit',$data);
	}
	//修改商品分类 ------- 处理方法
	function edit_email($email_id){
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
	                ${$postLANGOBJ[$p].$lancodelist[$lc]['langtype']} = $this->input->post($postLANGOBJ[$p].$lancodelist[$lc]['langtype']);//教授名称
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
		$this->EmailModel->edit_email($email_id, $arr);
	
		//跳转到列表页面
		$backurl = $this->input->post('backurl');
		if($backurl!=""){
			$backurl=str_replace('slash_tag','/',$backurl);
			if(base64_decode($backurl)!=""){
				$decodebackurl = base64_decode(str_replace(" ", "+", $backurl));
			}else{
				$decodebackurl = base_url().'index.php/admins/email/index';
			}
		}else{
			$decodebackurl = base_url().'index.php/admins/email/index';
		}
		echo json_encode(array('backurl'=>$decodebackurl));
	}
	
	//修改发邮件设置
	function tosetting_email(){
		$this->load->view('admin/setting_email_setting');
	}
	//修改发邮件设置 ------- 处理方法
	function setting_email(){
		$email_type = $this->input->post('email_type');
		$smtp_server = $this->input->post('smtp_server');
		$smtp_serverport = $this->input->post('smtp_serverport');
		$smtp_usermail = $this->input->post('smtp_usermail');
		$smtp_user = $this->input->post('smtp_user');
		$smtp_pass = $this->input->post('smtp_pass');
	
		$arr = array('edited_author'=>$this->admin_username, 'edited'=>time());
		
		$this->db->update(DB_PRE().'email_setting', array('value'=>$email_type), array('name'=>'email_type'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_server), array('name'=>'smtp_server'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_serverport), array('name'=>'smtp_serverport'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_usermail), array('name'=>'smtp_usermail'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_user), array('name'=>'smtp_user'));
		$this->db->update(DB_PRE().'email_setting', array('value'=>$smtp_pass), array('name'=>'smtp_pass'));
	}
	
	
	
	
	
	
	
	
}