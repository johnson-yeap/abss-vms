<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$lang = $this->session->userdata('lang');
		if($lang == 'ch'){
		    $this->session->set_userdata('lang', 'ch');
		    $this->langtype = '_ch';
		}else{
		    $this->session->set_userdata('lang', 'en');
		    $this->langtype = '_en';
		}
	}
	
	function index(){
	    if(isset($_COOKIE[DB_PRE().'admininfo'])){
	        $admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
	        $this->admin_id = $admininfo['admin_id'];
	        
	        //重新续期cookie
	        $arr = array('admin_id'=>$admininfo['admin_id'], 'admin_code'=>$admininfo['admin_code']);
	        $arr = serialize($arr);
	        $this->input->set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
	    }else{
	        $this->admin_id = 0;
	    }
	    if($this->admin_id != 0){
	        if($this->admin_id == 1){//管理员
	            $this->session->set_userdata('menu', 'dashboard');
	            if($this->langtype == '_ch'){
	                $data['website_title'] = 'AMB';
	                $data['website_description'] = '';
	            }else{
	                $data['website_title'] = 'AMB';
	                $data['website_description'] = '';
	            }
	            $this->load->view('admin_home', $data);
	        }else{//其他管理员
	            redirect(base_url().'admin/formtable');
	        }
	    }else{//没有登录
	        $this->session->set_userdata('menu', 'dashboard');
	        if($this->langtype == '_ch'){
	            $data['website_title'] = 'AMB';
	            $data['website_description'] = '';
	        }else{
	            $data['website_title'] = 'AMB';
	            $data['website_description'] = '';
	        }
	        $this->load->view('admin_home', $data);
	    }
	}
	
	function formtable(){
	    $this->session->set_userdata('menu', 'form');
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $this->load->view('formtable_home', $data);
	}
	//保存数据记录列表 -- 待批准
	function formtable_record_list($form_type){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    $this->load->view('formtable_record_list', $data);
	}
	//保存数据记录列表 -- 已通过
	function formtable_record_list_passed($form_type){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    $this->load->view('formtable_record_list_passed', $data);
	}
	//保存数据记录列表 -- 已拒绝
	function formtable_record_list_denied($form_type){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    $this->load->view('formtable_record_list_denied', $data);
	}
	//保存数据记录列表 -- 已关闭
	function formtable_record_list_closed($form_type){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    $this->load->view('formtable_record_list_closed', $data);
	}
	
	//待分配案例
	function case_pending(){
	    if(isset($_COOKIE[DB_PRE().'admininfo'])){
	        $admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
	        $this->admin_id = $admininfo['admin_id'];
	        
	        //重新续期cookie
	        $arr = array('admin_id'=>$admininfo['admin_id'], 'admin_code'=>$admininfo['admin_code']);
	        $arr = serialize($arr);
	        $this->input->set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
	    }else{
	        $this->admin_id = 0;
	    }
	    if($this->admin_id != 0){
	        if($this->admin_id == 1){//管理员
	            $this->session->set_userdata('menu', 'case');
	            $form_type = 'enrolmentform';
	            if($this->langtype == '_ch'){
	                $data['website_title'] = 'AMB';
	                $data['website_description'] = '';
	            }else{
	                $data['website_title'] = 'AMB';
	                $data['website_description'] = '';
	            }
	            $data['form_type'] = $form_type;
	            $this->load->view('case_list_pending', $data);
	        }else{//其他管理员
	            redirect(base_url().'admin/formtable');
	        }
	    }else{//没有登录
	        $this->session->set_userdata('menu', 'case');
	        $form_type = 'enrolmentform';
	        if($this->langtype == '_ch'){
	            $data['website_title'] = 'AMB';
	            $data['website_description'] = '';
	        }else{
	            $data['website_title'] = 'AMB';
	            $data['website_description'] = '';
	        }
	        $data['form_type'] = $form_type;
	        $this->load->view('case_list_pending', $data);
	    }
	}
	
	//进行中的案例
	function case_success(){
	    $this->session->set_userdata('menu', 'case');
	    $form_type = 'enrolmentform';
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    $this->load->view('case_list_success', $data);
	}
	
	//已完成的案例
	function case_complete(){
	    $this->session->set_userdata('menu', 'case');
	    $form_type = 'enrolmentform';
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    $this->load->view('case_list_complete', $data);
	}
	
	//已完成的案例
	function case_closed(){
	    $this->session->set_userdata('menu', 'case');
	    $form_type = 'enrolmentform';
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    $this->load->view('case_list_closed', $data);
	}
	
	function case_record_info($form_id){
	    $form_type = 'enrolmentform';
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $this->load->view('case_record_info', $data);
	}
	//选择司机
	function tochoosedriver($form_id){
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $data['role_name'] = 'driver';
	    
	    $this->load->view('case_choose_volunteer', $data);
	}
	//选择义工 1
	function tochoosevolunteer_1($form_id){
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $data['role_name'] = 'volunteer_1';
	    
	    $this->load->view('case_choose_volunteer', $data);
	}
	//选择义工 2
	function tochoosevolunteer_2($form_id){
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $data['role_name'] = 'volunteer_2';
	    
	    $this->load->view('case_choose_volunteer', $data);
	}
	//选择义工 3
	function tochoosevolunteer_3($form_id){
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $data['role_name'] = 'volunteer_3';
	    
	    $this->load->view('case_choose_volunteer', $data);
	}
	//选择义工 4
	function tochoosevolunteer_4($form_id){
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $data['role_name'] = 'volunteer_4';
	    
	    $this->load->view('case_choose_volunteer', $data);
	}
	//选择义工 5
	function tochoosevolunteer_5($form_id){
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $data['role_name'] = 'volunteer_5';
	    
	    $this->load->view('case_choose_volunteer', $data);
	}
	//选择义工 6
	function tochoosevolunteer_6($form_id){
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $data['role_name'] = 'volunteer_6';
	    
	    $this->load->view('case_choose_volunteer', $data);
	}
	
	function formtable_record_info($form_type, $form_id){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $this->load->view('formtable_record_info', $data);
	}
	
	function formtable_record_edit($form_type, $form_id){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $this->load->view('formtable_record_edit', $data);
	}
	
	function random($length) {
	    $hash = '';
	    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	    //	$chars = '0123456789';
	    
	    $max = strlen ( $chars ) - 1;
	    
	    for($i = 0; $i < $length; $i ++) {
	        $hash .= $chars [mt_rand ( 0, $max )];
	    }
	    return $hash;
	    
	}
	function yanzhengma(){
	    if (!session_id()) session_start();
	    
	    $authnum = $this->random ( 4 );
	    
	    $_SESSION ['yan'] = $authnum;
	    //$authnum = $_SESSION ['yan'];
	    //$this->session->set_userdata('yan',$authnum);
	    
	    Header ( "Content-type: image/PNG" );
	    $im = imagecreate ( 78, 40 );
	    $red = ImageColorAllocate ( $im, 157, 191, 237 );
	    $white = ImageColorAllocate ( $im, 10, 10, 10 );
	    $gray = ImageColorAllocate ( $im, 102, 102, 0 );
	    
	    imagefill ( $im, 90, 40, $gray );
	    for($i = 0; $i < strlen ( $authnum ); $i ++) {
	        imagestring ( $im, 30, 13 * $i + 15, 11, substr ( $authnum, $i, 1 ), $white );
	    }
	    for($i = 0; $i < 150; $i ++) {
	        imagesetpixel ( $im, rand () % 90, rand () % 40, $gray );
	    }
	    ImagePNG ( $im );
	    ImageDestroy ( $im );
	}
	function tologin($admin_token) {
	    check_SHORTURL($admin_token);//判断短网址格式
	    if($admin_token != 'tyddkmiv9e'){
	        exit('参数入口错误！');
	        return false;
	    }
	    //$ishaveyanzhengma = strip_tags($this->input->post('ishaveyanzhengma', TRUE));
	    $ishaveyanzhengma = 1;
	    $username = strip_tags($this->input->post('username', TRUE));
	    $password = strip_tags($this->input->post('password', TRUE));
	    
	    check_SHORTURL($username);//判断短网址格式
	    check_SHORTURL($password);//判断短网址格式
	    
	    $ispass = 1;
	    $result = $this->AdminModel->checkAdmin($username, md5($password));
	    $result_username = $this->AdminModel->checkAdmin_username($username);
	    
	    if(!empty($_SERVER ["HTTP_CLIENT_IP"] )) {
	        $ip_address = $_SERVER ["HTTP_CLIENT_IP"];
	    }else if(!empty($_SERVER ["HTTP_X_FORWARDED_FOR"] )) {
	        $ip_address = $_SERVER ["HTTP_X_FORWARDED_FOR"];
	    }else if(!empty($_SERVER ["REMOTE_ADDR"] )) {
	        $ip_address = $_SERVER ["REMOTE_ADDR"];
	    }else{
	        $ip_address = "127.0.0.1";
	    }
	    if($ip_address == '::1') {
	        $ip_address = '127.0.0.1';
	    }
	    
        //添加后台管理员登录日志--开始
        $err_num = 0;
        $sql = "SELECT * FROM ".DB_PRE()."admin_login WHERE ip_address = '".$ip_address."' ORDER BY created DESC LIMIT 0, 5";
        $resdlogin = $this->db->query($sql)->result_array();
        if (!empty($resdlogin)) {
            for ($i = 0; $i < count($resdlogin); $i++) {
                if($resdlogin[$i]['status'] == 0){
                    $err_num = $err_num + 1;
                }
            }
        }
        if($err_num >= 3){
            $data ['ishaveyanzhengma'] = 1;
        }
        if($err_num == 5){
            if(($resdlogin[0]['created'] + 600) > time()){
                $data ['error'] = '请十分钟后再登录';
                $data['admin_token'] = $admin_token;
                $this->load->view('admin/hlogin', $data);
                return ;exit;
            }
        }
        //添加后台管理员登录日志--结束
	    
	    if($ishaveyanzhengma == 1){
	        $code = $this->input->post('code', TRUE);
	        check_SHORTURL($code);//判断短网址格式
	        
	        if(strtolower($code) != strtolower ($_SESSION ["yan"])){
	            $data ['code_error'] = 'Verification code error';
	            $data['admin_token'] = $admin_token;
	            $this->load->view('admin/hlogin', $data);
	            return ;exit;
	        }
	    }
	    
	    if($result) {
	        // 正常返回数据(json)
	        $arr = array('admin_id'=>$result ['admin_id'], 'admin_username'=>$result['admin_username'], 'admin_type'=>$result['admin_type'], 'rules_id'=>$result['rules_id'], 'admin_realname'=>$result['admin_realname']);
	        $arr = serialize($arr);
	        $this->input->set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', FALSE, TRUE);//设置登录的session
	        // 	        set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', FALSE, TRUE);//设置登录的session
	        
	        //添加后台管理员登录日志--开始
	        $arr = array('status'=>1, 'admin_id'=>$result ['admin_id'], 'IP_address'=>$ip_address, 'created'=>time(), 'date_year'=>date('Y'), 'date_month'=>date('m'), 'date_day'=>date('d'));
	        $this->db->insert(DB_PRE().'admin_login', $arr);
	        //添加后台管理员登录日志--结束
	        
	        redirect(base_url().'admins/home');
	    }else{
	        if($result == "" && $username != '' && $password != '') {
	            $ispass = 0;
	            $data ['error'] = 'Username or password error';
	            
	            if(!empty($result_username)){
	                //添加后台管理员登录日志--开始
	                $arr = array('status'=>0, 'admin_id'=>$result_username ['admin_id'], 'IP_address'=>$ip_address, 'created'=>time(), 'date_year'=>date('Y'), 'date_month'=>date('m'), 'date_day'=>date('d'));
	                $this->db->insert(DB_PRE().'admin_login', $arr);
	                //添加后台管理员登录日志--结束
	            }else{
	                //添加后台管理员登录日志--开始
	                $arr = array('status'=>0, 'admin_id'=>0, 'IP_address'=>$ip_address, 'created'=>time(), 'date_year'=>date('Y'), 'date_month'=>date('m'), 'date_day'=>date('d'));
	                $this->db->insert(DB_PRE().'admin_login', $arr);
	                //添加后台管理员登录日志--结束
	            }
	        }
	        
	        if($username == '') {
	            $data ['username_error'] = 'Please enter your username';
	            $ispass = 0;
	        }
	        
	        if($password == '') {
	            $data ['password_error'] = 'Please enter your password';
	            $ispass = 0;
	        }
	    }
	    if($ispass == 0) {
	        $data['admin_token'] = $admin_token;
	        $this->load->view('admin/hlogin', $data);
	    }
	}
	
	function logout_admin() {
	    $this->load->helper('cookie');
	    delete_cookie(DB_PRE().'admininfo');
	    redirect(base_url().'admin');
	}
	
	function logout() {
	    $this->load->helper('cookie');

	    delete_cookie(DB_PRE().'admininfo');

	    redirect(base_url().'admin/index/tyddkmiv9e');
// 	    exit('请进入登录入口重新登录');
// 	    return false;exit;
	}
	
	function changelanguage($lan, $url) {
	    $url = str_replace('slash_tag', '/', $url);
	    $url = base64_decode($url);
	    $this->session->set_userdata ('adminlang', $lan);
	    redirect($url);
	}
	
	function tolistsort_open() {
        // 正常返回数据(json)
        $arr = array('list_iscansort'=>1);
        $arr = serialize($arr);
        $this->input->set_cookie(DB_PRE().'listsort', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
	}
	
	function tolistsort_close() {
	    // 正常返回数据(json)
	    $arr = array('list_iscansort'=>0);
	    $arr = serialize($arr);
	    $this->input->set_cookie(DB_PRE().'listsort', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
	}
	//家访记录
	function homevisit_record_list($enrolmentform_id){
	    $form_type = 'enrolmentform';
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    
	    $data['enrolmentforminfo'] = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
	    
	    $this->load->view('case_record_homevisit_list', $data);
	}
	
	function homevisit_1st($enrolmentform_id = 0){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = '关怀组家访表格 （初次）';
	        $data['website_description'] = '关怀组家方表格是一种用于记录和管理关怀组成员及其家庭信息的表格。';
	    }else{
	        $data['website_title'] = 'Caring Unit Home Visit Form (1st visit)';
	        $data['website_description'] = 'The Care Group Family Form is a form used to record and manage information about care group members and their families.';
	    }
	    $data['enrolmentforminfo'] = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
	    
	    $data['form_type'] = 'homevisit_1st';
	    
	    $this->load->view('case_formtable_homevisit_1st', $data);
	}
	function homevisit_followupvisit($enrolmentform_id = 0){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = '家访跟进表';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'Home Visit Form (follow up visit)';
	        $data['website_description'] = '';
	    }
	    $data['enrolmentforminfo'] = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
	    
	    $data['form_type'] = 'homevisit_followupvisit';
	    
	    $this->load->view('case_formtable_homevisit_followupvisit', $data);
	}
	
	function formtable_record_edit_forhomevisit($form_type, $enrolmentform_id, $form_id){
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    
	    $data['enrolmentforminfo'] = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
	    
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($form_id);//获取记录详细
	    
	    $this->load->view('case_record_edit', $data);
	}
	
	//关闭案例
	function toclose_case($form_id){
	    if(isset($_COOKIE[DB_PRE().'admininfo'])){
	        $admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
	        $this->admin_id = $admininfo['admin_id'];
	        
	        //重新续期cookie
	        $arr = array('admin_id'=>$admininfo['admin_id'], 'admin_code'=>$admininfo['admin_code']);
	        $arr = serialize($arr);
	        $this->input->set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
	    }else{
	        $this->admin_id = 0;
	    }
	    
	    $is_closed_reason = $this->input->post('is_closed_reason');
	    
	    $arr = array('is_closed'=>1, 'is_closed_admin_id'=>$this->admin_id, 'is_closed_reason'=>$is_closed_reason);
	    $this->db->update(DB_PRE().'form_list', $arr, array('form_id'=>$form_id));
	}
	
	
	//还原关闭案例
	function torestoreclose_case($form_id){
	    if(isset($_COOKIE[DB_PRE().'admininfo'])){
	        $admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
	        $this->admin_id = $admininfo['admin_id'];
	        
	        //重新续期cookie
	        $arr = array('admin_id'=>$admininfo['admin_id'], 'admin_code'=>$admininfo['admin_code']);
	        $arr = serialize($arr);
	        $this->input->set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
	    }else{
	        $this->admin_id = 0;
	    }
	    
	    $arr = array('is_closed'=>0);
	    $this->db->update(DB_PRE().'form_list', $arr, array('form_id'=>$form_id));
	}
	function todownload_case($statusname){
	    if(isset($_COOKIE[DB_PRE().'volunteerinfo'])){
	        $volunteerinfo = unserialize($_COOKIE[DB_PRE().'volunteerinfo']);
	        $this->volunteer_id = $volunteerinfo['volunteer_id'];
	        
	        //重新续期cookie
	        $arr = array('volunteer_id'=>$volunteerinfo['volunteer_id']);
	        $arr = serialize($arr);
	        $this->input->set_cookie(DB_PRE().'volunteerinfo', $arr, (3600*2), '', '/', '', TRUE, TRUE);//设置登录的session
	    }else{
	        $this->volunteer_id = 0;
	    }
	    $form_id_str = $this->input->get('form_id_str');
	    // 	    if($statusname == 'closed'){
	    // 	        $subsql = " AND a.is_closed = 1";
	    // 	    }else if($statusname == 'complete'){
	    // 	        $subsql = " AND a.is_closed = 0 AND a.is_finished = 1";
	    // 	    }else if($statusname == 'success'){
	    // 	        $subsql = " AND a.is_closed = 0 AND a.is_assigned = 1 AND a.is_finished = 0";
	    // 	    }else{
	    $subsql = "";
	    // 	    }
	    
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
                
            WHERE a.form_type = 'enrolmentform' ".$subsql." AND a.status = 1
            AND a.form_id IN (".$form_id_str.")
            ORDER BY a.form_id DESC
        ";
	    $recordlist = $this->db->query($sql)->result_array();
	    $data['recordlist'] = $recordlist;
	    
	    $this->load->view('case_list_pdf', $data);
	}
	
	//超过48hrs未填写家访记录
	function case_over48hrs(){
	    $this->session->set_userdata('menu', 'over48hrs');
	    $form_type = 'enrolmentform';
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    $this->load->view('case_list_over48hrs', $data);
	}
	//创建一个新的案例
	function createanewcase($enrolmentform_id){
	    $form_type = 'enrolmentform';
	    if($this->langtype == '_ch'){
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }else{
	        $data['website_title'] = 'AMB';
	        $data['website_description'] = '';
	    }
	    $data['form_type'] = $form_type;
	    
	    $data['recordinfo'] = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
	    
	    $this->load->view('case_createanewcase', $data);
	}
	
	function action_createanewcase($enrolmentform_id = 0){
	    $assign_memo = $this->input->post('assign_memo');
	    
	    $sql = "
            SELECT a.*
            FROM ".DB_PRE()."form_list AS a
            WHERE a.form_id = ".$enrolmentform_id."
        ";
	    $recordinfo = $this->db->query($sql)->row_array();
	    
	    if(isset($_COOKIE[DB_PRE().'codeinfo'])){
	        $codeinfo = unserialize($_COOKIE[DB_PRE().'codeinfo']);
	        $admin_id = $codeinfo['admin_id'];
	    }else{
	        $admin_id = 0;
	    }
	    unset($recordinfo['form_id']);
	    $recordinfo['parent'] = $enrolmentform_id;
	    $recordinfo['form_key'] = randkey(32);
	    $recordinfo['status'] = 1;
	    $recordinfo['created'] = time();
	    $recordinfo['edited'] = time();
	    $recordinfo['fillin_admin_id'] = $admin_id;
	    $recordinfo['is_closed'] = 0;
	    $recordinfo['is_closed_admin_id'] = 0;
	    
	    $recordinfo['is_assigned'] = 0;
	    $recordinfo['is_assigned_admin_id'] = 0;
	    $recordinfo['is_assigned_time'] = 0;
	    $recordinfo['assign_memo'] = $assign_memo;
	    
	    $recordinfo['is_finished'] = 0;
	    
	    $recordinfo['volunteer_1_id'] = 0;
	    $recordinfo['volunteer_2_id'] = 0;
	    $recordinfo['volunteer_3_id'] = 0;
	    $recordinfo['volunteer_4_id'] = 0;
	    $recordinfo['volunteer_5_id'] = 0;
	    $recordinfo['volunteer_6_id'] = 0;
	    $recordinfo['driver_id'] = 0;
	    
	    
	    $select_id = $this->input->post('select_id_8');
	    if($select_id != ''){
	        $recordinfo['select_id_8'] = $select_id;
	        $recordinfo['health_id_last'] = $select_id;
        }
        $checkbox_id = $this->input->post('checkbox_id_1');
        if($checkbox_id != '' && !empty($checkbox_id)){
            for ($ccc = 0; $ccc < count($checkbox_id); $ccc++) {
                $recordinfo['checkbox_id_1_'.($ccc + 1)] = $checkbox_id[$ccc];
                $recordinfo['checkbox_id_1_'.($ccc + 1).'_last'] = $checkbox_id[$ccc];
            }
            if(count($checkbox_id) < 10){
                for ($ccc = count($checkbox_id); $ccc < 10; $ccc++) {
                    $recordinfo['checkbox_id_1_'.($ccc + 1)] = 0;
                    $recordinfo['checkbox_id_1_'.($ccc + 1).'_last'] = 0;
                }
            }
        }
	    
	    $this->db->insert(DB_PRE().'form_list', $recordinfo);
        $form_id = $this->db->insert_id();
	        
        $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE parent = ".$enrolmentform_id."";
        $res = $this->db->query($sql)->row_array();
        if(!empty($res)){
            if($res['numcount'] != ''){
                $count = $res['numcount'];
            }else{
                $count = 0;
            }
        }else{
            $count = 0;
        }
        if($count == 1){
            $count_show = '(a)';
        }else if($count == 2){
            $count_show = '(b)';
        }else if($count == 3){
            $count_show = '(c)';
        }else if($count == 4){
            $count_show = '(d)';
        }else if($count == 5){
            $count_show = '(e)';
        }else if($count == 6){
            $count_show = '(f)';
        }else if($count == 7){
            $count_show = '(g)';
        }else if($count == 8){
            $count_show = '(h)';
        }else if($count == 9){
            $count_show = '(i)';
        }else if($count == 10){
            $count_show = '(j)';
        }else{
            $count_show = '('.$count.')';
        }
        $form_number = $recordinfo['form_number'].' '.$count_show;
        $this->db->update(DB_PRE().'form_list', array('form_number'=>$form_number), array('form_id'=>$form_id));
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */