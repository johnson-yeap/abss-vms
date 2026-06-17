<?php
class EmailModel extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	//邮件详细
	function getemailinfo($email_id){
		$sql="
				SELECT a.*
	
				FROM ".DB_PRE()."email_list AS a
	
				WHERE a.email_id = ".$email_id."
		";
		$result = $this->db->query($sql)->row_array();
		if(!empty($result)){
			return $result;
		}else{
			return null;
		}
	}
	
	//添加邮件
	function add_email($arr){
		$this->db->insert(DB_PRE().'email_list',$arr);
		return $this->db->insert_id();
	}
	
	//修改邮件
	function edit_email($email_id,$arr){
		$this->db->update(DB_PRE().'email_list',$arr,array('email_id'=>$email_id));
	}
	//删除邮件
	function del_email($email_id){
		$this->db->delete(DB_PRE().'email_list', array('email_id'=>$email_id));
	}
	
	//查询邮件列表
	function getemaillist($con = array(), $iscount = 0){
		$where="";
		$order_by="";
		$limit="";
		if(isset($con['other_con'])){if($where!=""){$where .=" AND";}else{$where .=" WHERE";} $where .= " ".$con['other_con'];}
		if(isset($con['orderby'])&&isset($con['orderby_res'])){$order_by .=" ORDER BY ".$con['orderby']." ".$con['orderby_res']."";}
		if(isset($con['row'])&&isset($con['page'])){$limit .=" LIMIT ".$con['row'].",".$con['page']."";}
	
		if($iscount == 0){
			$sql = "SELECT a.* FROM ".DB_PRE()."email_list a $where $order_by $limit";
			$result=$this->db->query($sql)->result_array();
			if(!empty($result)){
				return $result;
			}else{
				return null;
			}
		}else{
			$sql = "SELECT count(*) as count FROM ".DB_PRE()."email_list a $where $order_by";
			$result=$this->db->query($sql)->row_array();
			if(!empty($result)){
				return $result['count'];
			}else{
				return 0;
			}
		}
	}
	
	function sendemail_register($uid, $langtype){
	    $issend = 1;
	    $checkcon = array('localhost', '192.168.1');
	    for($i = 0; $i < count($checkcon); $i++){
	        $checkarr = explode($checkcon[$i], base_url());
	        if(count($checkarr) > 1){
	            $issend = 0;
	        }
	    }
	    $issend = 1;
	    $userinfo = $this->UserModel->getuserinfo($uid);
	    $emailinfo = $this->EmailModel->getemailinfo(1);
	    
	    if(!empty($emailinfo) && !empty($userinfo) && $issend == 1){
	        $reparr = array();
	        
	        $reparr[] = array('name'=>'{user_name}','value'=>$userinfo['user_firstname'].' '.$userinfo['user_lastname']);
	        $reparr[] = array('name'=>'{user_email}','value'=>$userinfo['user_email']);
	        $reparr[] = array('name'=>'{user_phone}','value'=>$userinfo['user_phone']);
	        
	        $reparr[] = array('name'=>'{active_url}','value'=>base_url().'account/toactive_account/'.$uid.'/'.$userinfo['user_randkey'].'/'.$langtype);
	        
	        $email_content = replace_content($reparr, $emailinfo['email_content'.$langtype]);
	        $email_sender = replace_content($reparr,$emailinfo['email_sender']);
	        $email_from = replace_content($reparr,$emailinfo['email_from']);
	        $email_replyto = replace_content($reparr,$emailinfo['email_replyto']);
	        $email_to = replace_content($reparr,$emailinfo['email_to']);
	        $email_cc = replace_content($reparr,$emailinfo['email_cc']);
	        $email_bcc = replace_content($reparr,$emailinfo['email_bcc']);
	        $email_subject = replace_content($reparr,$emailinfo['email_subject'.$langtype]);
	        
	        //内容
	        if($email_cc!=""&&$email_bcc!=""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "CC: <".$email_cc.">\r\n" . "BCC: <".$email_bcc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else if($email_cc==""&&$email_bcc!=""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "BCC: <".$email_bcc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else if($email_cc!=""&&$email_bcc==""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "CC: <".$email_cc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else{
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }
	        $subject = $email_subject;
	        $subject = "=?UTF-8?B?" . base64_encode ( $subject ) . "?=";
	        $content = $this->email_header();
	        $content .= '
				<div style="float:left;width:100%;">
					'.$email_content.'
				</div>
			';
	        $content .= $this->email_fooder();
// 	        echo $content;exit;
	        
	        
	        mail ( $email_to, $subject, $content,$header ,'-f '.$email_from);
	    }
	}
	
	
	/*
	 * 注册 邮件
	 * */
	function send_forget_email($uid = 0, $langtype = '_en'){
	    $issend = 1;
	    $checkcon = array('localhost', '192.168.1');
	    for($i = 0; $i < count($checkcon); $i++){
	        $checkarr = explode($checkcon[$i], base_url());
	        if(count($checkarr) > 1){
	            $issend = 0;
	        }
	    }
	    $issend = 1;
	    $userinfo = $this->UserModel->getuserinfo($uid);
	    $emailinfo = $this->EmailModel->getemailinfo(2);
	    if($issend == 1 &&!empty($emailinfo) && !empty($userinfo)){
	        $randkey = $userinfo['user_randkey'];
	        $reparr = array();
	        $reparr[] = array('name'=>'{user_name}','value'=>$userinfo['user_firstname'].' '.$userinfo['user_lastname']);
	        $reparr[] = array('name'=>'{user_email}','value'=>$userinfo['user_email']);
	        $reparr[] = array('name'=>'{user_phone}','value'=>$userinfo['user_phone']);
	        
	        $reparr[] = array('name'=>'{resetpassword_url}','value'=>base_url().'account/toresetpassword/'.$uid.'/'.$randkey.'/'.$langtype);
	        
	        $email_content=replace_content($reparr,$emailinfo['email_content'.$langtype]);
	        $email_sender=replace_content($reparr,$emailinfo['email_sender']);
	        $email_from=replace_content($reparr,$emailinfo['email_from']);
	        $email_replyto=replace_content($reparr,$emailinfo['email_replyto']);
	        $email_to=replace_content($reparr,$emailinfo['email_to']);
	        $email_cc=replace_content($reparr,$emailinfo['email_cc']);
	        $email_bcc=replace_content($reparr,$emailinfo['email_bcc']);
	        $email_subject=replace_content($reparr,$emailinfo['email_subject'.$langtype]);
	        
	        //内容
	        if($email_cc!=""&&$email_bcc!=""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "CC: <".$email_cc.">\r\n" . "BCC: <".$email_bcc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else if($email_cc==""&&$email_bcc!=""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "BCC: <".$email_bcc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else if($email_cc!=""&&$email_bcc==""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "CC: <".$email_cc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else{
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }
	        $subject = $email_subject;
	        $subject = "=?UTF-8?B?" . base64_encode ( $subject ) . "?=";
	        $content = $this->email_header();
	        $content .= '
				<div style="float:left;width:100%;line-height:25px;">
					'.$email_content.'
				</div>
			';
	        $content .= $this->email_fooder();
	        // 			print_r($content);exit;
	        mail ( $email_to, $subject, $content,$header ,'-f '.$email_from);
	    }
	}
	
	//发送Want to find out more?邮件
	function sendemail_wanttofindoutmore($request_id, $langtype = '_en'){
	    $issend = 1;
	    $checkcon = array('localhost', '192.168.1');
	    for($i = 0; $i < count($checkcon); $i++){
	        $checkarr = explode($checkcon[$i], base_url());
	        if(count($checkarr) > 1){
	            $issend = 0;
	        }
	    }
	    $issend = 1;
	    $sql = "SELECT * FROM ".DB_PRE()."request_list WHERE request_id = ".$request_id;
	    $requestinfo = $this->db->query($sql)->row_array();
	    
	    $emailinfo = $this->EmailModel->getemailinfo(3);
	    if($issend == 1 &&!empty($emailinfo) && !empty($requestinfo)){
	        $request_frompage = $requestinfo['request_frompage'];
	        $request_fullname = $requestinfo['request_fullname'];
	        $request_phone = $requestinfo['request_phone'];
	        $request_email = $requestinfo['request_email'];
	        $request_website = $requestinfo['request_website'];
	        $request_content = $requestinfo['request_content'];
	        
	        $reparr = array();
	        $reparr[] = array('name'=>'{from_page}','value'=>$request_frompage);
	        $reparr[] = array('name'=>'{full_name}','value'=>$request_fullname);
	        $reparr[] = array('name'=>'{phone_number}','value'=>$request_phone);
	        $reparr[] = array('name'=>'{email_address}','value'=>$request_email);
	        $reparr[] = array('name'=>'{website_address}','value'=>$request_website);
	        $reparr[] = array('name'=>'{talk_about}','value'=>$request_content);
	        
	        $email_content = replace_content($reparr,$emailinfo['email_content'.$langtype]);
	        $email_sender = replace_content($reparr,$emailinfo['email_sender']);
	        $email_from = replace_content($reparr,$emailinfo['email_from']);
	        $email_replyto = replace_content($reparr,$emailinfo['email_replyto']);
	        $email_to = replace_content($reparr,$emailinfo['email_to']);
	        $email_cc = replace_content($reparr,$emailinfo['email_cc']);
	        $email_bcc = replace_content($reparr,$emailinfo['email_bcc']);
	        $email_subject = replace_content($reparr,$emailinfo['email_subject'.$langtype]);
	        
	        //内容
	        if($email_cc!=""&&$email_bcc!=""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "CC: <".$email_cc.">\r\n" . "BCC: <".$email_bcc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else if($email_cc==""&&$email_bcc!=""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "BCC: <".$email_bcc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else if($email_cc!=""&&$email_bcc==""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "CC: <".$email_cc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else{
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }
	        $subject = $email_subject;
	        $subject = "=?UTF-8?B?" . base64_encode ( $subject ) . "?=";
	        $content = $this->email_header();
	        $content .= '
				<div style="float:left;width:100%;line-height:25px;">
					'.$email_content.'
				</div>
			';
	        $content .= $this->email_fooder();
// 	        print_r($content);exit;
	        mail ( $email_to, $subject, $content,$header ,'-f '.$email_from);
	    }
	}
	
	
	//发送get a quote邮件
	function sendemail_getaquote($request_id, $langtype = '_en'){
	    $issend = 1;
	    $checkcon = array('localhost', '192.168.1');
	    for($i = 0; $i < count($checkcon); $i++){
	        $checkarr = explode($checkcon[$i], base_url());
	        if(count($checkarr) > 1){
	            $issend = 0;
	        }
	    }
	    $issend = 1;
	    $sql = "SELECT * FROM ".DB_PRE()."request_list WHERE request_id = ".$request_id;
	    $requestinfo = $this->db->query($sql)->row_array();
	    
	    $emailinfo = $this->EmailModel->getemailinfo(4);
	    if($issend == 1 &&!empty($emailinfo) && !empty($requestinfo)){
	        $request_frompage = $requestinfo['request_frompage'];
	        $request_fullname = $requestinfo['request_fullname'];
	        $request_phone = $requestinfo['request_phone'];
	        $request_email = $requestinfo['request_email'];
	        $request_content = $requestinfo['request_content'];
	        
	        $reparr = array();
	        $reparr[] = array('name'=>'{from_page}','value'=>$request_frompage);
	        $reparr[] = array('name'=>'{full_name}','value'=>$request_fullname);
	        $reparr[] = array('name'=>'{phone_number}','value'=>$request_phone);
	        $reparr[] = array('name'=>'{email_address}','value'=>$request_email);
	        $reparr[] = array('name'=>'{website_address}','value'=>$requestinfo['request_website']);
	        $reparr[] = array('name'=>'{company_name}','value'=>$requestinfo['request_companyname']);
	        $reparr[] = array('name'=>'{isneed_rebuildorchange}','value'=>$requestinfo['isneed_rebuildorchange']);
	        $reparr[] = array('name'=>'{request_howmanypages}','value'=>$requestinfo['request_howmanypages']);
	        $reparr[] = array('name'=>'{request_howmanybudget}','value'=>$requestinfo['request_howmanybudget']);
	        $reparr[] = array('name'=>'{request_needfunctions}','value'=>$requestinfo['request_needfunctions']);
	        $reparr[] = array('name'=>'{request_content}','value'=>$requestinfo['request_content']);
	        $reparr[] = array('name'=>'{request_content_2}','value'=>$requestinfo['request_content_2']);
	        $reparr[] = array('name'=>'{request_expectedtime}','value'=>$requestinfo['request_expectedtime']);
	        
	        
	        
	        $email_content = replace_content($reparr,$emailinfo['email_content'.$langtype]);
	        $email_sender = replace_content($reparr,$emailinfo['email_sender']);
	        $email_from = replace_content($reparr,$emailinfo['email_from']);
	        $email_replyto = replace_content($reparr,$emailinfo['email_replyto']);
	        $email_to = replace_content($reparr,$emailinfo['email_to']);
	        $email_cc = replace_content($reparr,$emailinfo['email_cc']);
	        $email_bcc = replace_content($reparr,$emailinfo['email_bcc']);
	        $email_subject = replace_content($reparr,$emailinfo['email_subject'.$langtype]);
	        
	        //内容
	        if($email_cc!=""&&$email_bcc!=""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "CC: <".$email_cc.">\r\n" . "BCC: <".$email_bcc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else if($email_cc==""&&$email_bcc!=""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "BCC: <".$email_bcc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else if($email_cc!=""&&$email_bcc==""){
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" . "CC: <".$email_cc.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }else{
	            $header = "From: ".$email_sender."<".$email_from.">\r\n" . "Reply-To: <".$email_replyto.">\r\n" ."X-Mailer: PHP/" . phpversion () . "\r\n" . "MIME-Version: 1.0\r\n" . "Content-type: text/html; charset=UTF-8\r\n";
	        }
	        $subject = $email_subject;
	        $subject = "=?UTF-8?B?" . base64_encode ( $subject ) . "?=";
	        $content = $this->email_header();
	        $content .= '
				<div style="float:left;width:100%;line-height:25px;">
					'.$email_content.'
				</div>
			';
	        $content .= $this->email_fooder();
	        // 	        print_r($content);exit;
	        mail ( $email_to, $subject, $content,$header ,'-f '.$email_from);
	    }
	}
	
	function email_header(){
	    $content = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>XXXXXX</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
			</head>
			<body>
				<div style="float:center;width:100%;max-width:740px;margin:0 auto;">
				<div style="float:left;width:100%;padding:10px 0px 10px 0px;border:1px solid #73CDDB;background:#73CDDB;border-border-top-right-radius:6px;-moz-border-top-right-radius:6px;-webkit-border-top-right-radius:6px;border-border-top-left-radius:6px;-moz-border-top-left-radius:6px;-webkit-border-top-left-radius:6px;">
					<font style="font-weight:bold;font-size:20px;color:white;">&nbsp;XXXXXX</font>
				</div>
				<div style="float:left;font-family: Arial, Helvetica, SimSun, sans-serif;width: 100%;margin-top: 0px;border:1px solid #73CDDB;">
				<table cellspacing="0" cellpadding=0 width:100%; style="float:left;">
				<tr><td style="padding:20px;font-size:14px;line-height:22px;">
		';
	    return $content;
	}
	
	function email_fooder(){
	    $content = '
			</td></tr></table>
				    </div>
				  	<div style="float:left;border:1px solid #73CDDB;font-family: Arial, Helvetica, SimSun, sans-serif;width:100%;font-size:13px;font-weight:normal;margin:0 auto;padding:10px 0px 10px 0px;float:left;text-align:right;color:#000000;background:#73CDDB;border-border-bottom-right-radius:6px;-moz-border-bottom-right-radius:6px;-webkit-border-bottom-right-radius:6px;border-border-bottom-left-radius:6px;-moz-border-bottom-left-radius:6px;-webkit-border-bottom-left-radius:6px;">
				  	    <span style="float:left;color:white;">&nbsp;&nbsp;';
	    $content .= lang('cy_copyright');
	    
	    $content .= ' © '.date('Y').' XXXXXX</span>
				  	    <span style="float:right;color:white;">
				  	     ';
	    
	    $content .= lang('cy_allrightsreserved');
	    $content .= '  &nbsp;&nbsp;&nbsp;&nbsp;
					    </span>
					</div>
				</div>
			</body>
			</html>
			';
	    return $content;
	}
	
	
	
}
