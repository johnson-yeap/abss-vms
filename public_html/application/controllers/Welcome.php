<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        
        $lang = $this->session->userdata('lang');
        if($lang == 'ch'){
            $this->session->set_userdata('lang', 'ch');
            $this->langtype = '_ch';
        }else{
            $this->session->set_userdata('lang', 'en');
            $this->langtype = '_en';
        }
    }
    
//     function ddddddd(){
//         $sql = "
//             SELECT a.*
//                 , b.form_pic_1_path AS volunteer_1_pic_1_path
//                 , b.input_1 AS volunteer_1_name
//                 , b.select_id_6 AS volunteer_1_shenfen
                
//                 , c.form_pic_1_path AS volunteer_2_pic_1_path
//                 , c.input_1 AS volunteer_2_name
//                 , c.select_id_6 AS volunteer_2_shenfen
                
//                 , d.form_pic_1_path AS volunteer_3_pic_1_path
//                 , d.input_1 AS volunteer_3_name
//                 , d.select_id_6 AS volunteer_3_shenfen
                
//                 , f.form_pic_1_path AS volunteer_4_pic_1_path
//                 , f.input_1 AS volunteer_4_name
//     	        , f.select_id_6 AS volunteer_4_shenfen
                
//                 , g.form_pic_1_path AS volunteer_5_pic_1_path
//                 , g.input_1 AS volunteer_5_name
//                 , g.select_id_6 AS volunteer_5_shenfen
                
//                 , i.form_pic_1_path AS volunteer_6_pic_1_path
//                 , i.input_1 AS volunteer_6_name
//                 , i.select_id_6 AS volunteer_6_shenfen
                
//                 , e.form_pic_1_path AS driver_pic_1_path
//                 , e.input_1 AS driver_name
//                 , e.select_id_6 AS driver_shenfen
                
//             FROM ".DB_PRE()."form_list AS a
                
//             LEFT JOIN ".DB_PRE()."form_list AS b ON a.volunteer_1_id = b.form_id
//             LEFT JOIN ".DB_PRE()."form_list AS c ON a.volunteer_2_id = c.form_id
//             LEFT JOIN ".DB_PRE()."form_list AS d ON a.volunteer_3_id = d.form_id
                
//             LEFT JOIN ".DB_PRE()."form_list AS f ON a.volunteer_4_id = f.form_id
//             LEFT JOIN ".DB_PRE()."form_list AS g ON a.volunteer_5_id = g.form_id
//             LEFT JOIN ".DB_PRE()."form_list AS i ON a.volunteer_6_id = i.form_id
                
//             LEFT JOIN ".DB_PRE()."form_list AS e ON a.driver_id = e.form_id
                
//             WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit')
//             ORDER BY a.form_id DESC
//         ";
//         $recordlist = $this->db->query($sql)->result_array();
        
//         if(!empty($recordlist)){
//             for ($i = 0; $i < count($recordlist); $i++) {
//                 $form_id = $recordlist[$i]['form_id'];
//                 $enrolmentform_id = $recordlist[$i]['enrolmentform_id'];
//                 $enrolmentforminfo = $this->WelModel->getrecordinfo($enrolmentform_id);//获取记录详细
                
//                 if(!empty($enrolmentforminfo)){
//                     $newuparr = array();
//                     for($v = 1; $v <= 6; $v++){
//                         $newuparr['volunteer_'.$v.'_id'] = $enrolmentforminfo['volunteer_'.$v.'_id'];
//                     }
//                     $newuparr['driver_id'] = $enrolmentforminfo['driver_id'];
//                     $this->db->update(DB_PRE().'form_list', $newuparr, array('form_id'=>$form_id));
//                 }
//             }
//         }
//     }
    
    public function index(){
            //enrolmentform
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'enrolmentform' AND select_id_5 = 1";
            $result = $this->db->query($sql)->result_array();
            if(!empty($result)){
                for ($i = 0; $i < count($result); $i++) {
                    $this->db->update(DB_PRE().'form_list', array('checkbox_id_2_1'=>1), array('form_id'=>$result[$i]['form_id']));
                }
            }
            
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'enrolmentform' AND select_id_5 = 2";
            $result = $this->db->query($sql)->result_array();
            if(!empty($result)){
                for ($i = 0; $i < count($result); $i++) {
                    $this->db->update(DB_PRE().'form_list', array('checkbox_id_2_1'=>2), array('form_id'=>$result[$i]['form_id']));
                }
            }
            
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'enrolmentform' AND select_id_5 = 3";
            $result = $this->db->query($sql)->result_array();
            if(!empty($result)){
                for ($i = 0; $i < count($result); $i++) {
                    $this->db->update(DB_PRE().'form_list', array('checkbox_id_2_1'=>1, 'checkbox_id_2_2'=>2), array('form_id'=>$result[$i]['form_id']));
                }
            }
        
            //applyformforvolunteers - 说
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_4 = 1";
            $result = $this->db->query($sql)->result_array();
            if(!empty($result)){
                for ($i = 0; $i < count($result); $i++) {
                    $this->db->update(DB_PRE().'form_list', array('checkbox_id_2_1'=>1), array('form_id'=>$result[$i]['form_id']));
                }
            }
            
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_4 = 2";
            $result = $this->db->query($sql)->result_array();
            if(!empty($result)){
                for ($i = 0; $i < count($result); $i++) {
                    $this->db->update(DB_PRE().'form_list', array('checkbox_id_2_1'=>2), array('form_id'=>$result[$i]['form_id']));
                }
            }
            
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_4 = 3";
            $result = $this->db->query($sql)->result_array();
            if(!empty($result)){
                for ($i = 0; $i < count($result); $i++) {
                    $this->db->update(DB_PRE().'form_list', array('checkbox_id_2_1'=>1, 'checkbox_id_2_2'=>2), array('form_id'=>$result[$i]['form_id']));
                }
            }
        
            //applyformforvolunteers - 写
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_5 = 1";
            $result = $this->db->query($sql)->result_array();
            if(!empty($result)){
                for ($i = 0; $i < count($result); $i++) {
                    $this->db->update(DB_PRE().'form_list', array('checkbox_id_3_1'=>1), array('form_id'=>$result[$i]['form_id']));
                }
            }
            
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_5 = 2";
            $result = $this->db->query($sql)->result_array();
            if(!empty($result)){
                for ($i = 0; $i < count($result); $i++) {
                    $this->db->update(DB_PRE().'form_list', array('checkbox_id_3_1'=>2), array('form_id'=>$result[$i]['form_id']));
                }
            }
            
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' AND select_id_5 = 3";
            $result = $this->db->query($sql)->result_array();
            if(!empty($result)){
                for ($i = 0; $i < count($result); $i++) {
                    $this->db->update(DB_PRE().'form_list', array('checkbox_id_3_1'=>1, 'checkbox_id_3_2'=>2), array('form_id'=>$result[$i]['form_id']));
                }
            }
    }
    
    function checkexists(){
        echo 0;
    }
    
    function index_404(){
        $lang = $this->session->userdata('lang');
        if($lang == 'ch'){$this->langtype = '_ch';$this->reland = 'cn';}else if($lang == 'jp'){$this->langtype = '_jp';$this->reland = 'jp';}else if($lang == 'sk'){$this->langtype = '_sk';$this->reland = 'sk';}else if($lang == 'ru'){$this->langtype = '_ru';$this->reland = 'ru';}else{$this->langtype = '_en';$this->reland = 'en';}
        
        $this->load->view('page_404');
    }
    
    //刷新图形验证码
    function torefresh_captchha(){
        $hash = base64_encode(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVXYZ'), 0, 4));
        echo '
            <img class="captchha_img" onclick="torefresh_captchha()" src="'.base_url().'lib/captcha.php?hash='.$hash.'" alt="image verification">
        	<input type="hidden" id="captchha_hash" name="captchha_hash" value="'.$hash.'">
        	&nbsp;
        ';
    }
    
    function entercode_admin(){
        $code = $this->input->post('code');
        $captcha_code = $this->input->post('captcha_code');
        check_NUMBERinjection($code);//防止sql注入
        check_NUMBERinjection($captcha_code);//防止sql注入
        
        $captchha_hash = $this->input->post('captchha_hash');
        $captchha_hash = base64_decode($captchha_hash);
        
        if(strtolower($captcha_code) != strtolower($captchha_hash)){
            echo 'error_captcha';
            return ;exit;
        }
        
        $sql = "SELECT * FROM ".DB_PRE()."admin_list WHERE admin_code = '".$code."' AND admin_type = 1";
        $checkadmin = $this->db->query($sql)->row_array();
        if(!empty($checkadmin)){
            // 正常返回数据(json)
            $arr = array('admin_id'=>$checkadmin['admin_id'], 'admin_code'=>$code);
            $arr = serialize($arr);
            $this->input->set_cookie(DB_PRE().'admininfo', $arr, (3600*1), '', '/', '', FALSE, TRUE);//设置登录的session
            //set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', FALSE, TRUE);//设置登录的session
            
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    
    function entercode(){
        $code = $this->input->post('code');
        $captcha_code = $this->input->post('captcha_code');
        check_NUMBERinjection($code);//防止sql注入
        check_NUMBERinjection($captcha_code);//防止sql注入
        
        $captchha_hash = $this->input->post('captchha_hash');
        $captchha_hash = base64_decode($captchha_hash);
        
        if(strtolower($captcha_code) != strtolower($captchha_hash)){
            echo 'error_captcha';
            return ;exit;
        }
        
        $sql = "SELECT * FROM ".DB_PRE()."admin_list WHERE admin_code = '".$code."' AND admin_type = 2";
        $checkadmin = $this->db->query($sql)->row_array();
        if(!empty($checkadmin)){
            // 正常返回数据(json)
            $arr = array('admin_id'=>$checkadmin['admin_id'], 'code'=>$code);
            $arr = serialize($arr);
            $this->input->set_cookie(DB_PRE().'codeinfo', $arr, (3600*1), '', '/', '', FALSE, TRUE);//设置登录的session
            //set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', FALSE, TRUE);//设置登录的session
            
            echo 'yes';
        }else{
            echo 'no';
        }
    }
    
    //义工登录
    function login_volunteer(){
        $captcha_code = $this->input->post('captcha_code');
        check_NUMBERinjection($captcha_code);//防止sql注入
        
        $captchha_hash = $this->input->post('captchha_hash');
        $captchha_hash = base64_decode($captchha_hash);
        
        if(strtolower($captcha_code) != strtolower($captchha_hash)){
            echo 'error_captcha';
            return ;exit;
        }
        
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        //暂时放开：status = 0 也可以登录 AND status = 1
        $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type IN ('applyformforvolunteers') AND input_6 = '".$email."' AND is_closed = 0";
        $checkvolunteer = $this->db->query($sql)->row_array();
        if(!empty($checkvolunteer)){
            $input_4 = trim($checkvolunteer['input_4']);//联系手机号码
            //最后四位数
            $input_4_len = mb_strlen($input_4, 'UTF-8');
            if($input_4_len >= 4){
                $newStr = mb_substr($input_4, $input_4_len - 4, 4, 'UTF-8');
            }else{
                $newStr = $input_4;
            }
            if($password == $newStr){
                // 正常返回数据(json)
                $arr = array('volunteer_id'=>$checkvolunteer['form_id']);
                $arr = serialize($arr);
                $this->input->set_cookie(DB_PRE().'volunteerinfo', $arr, (3600*1), '', '/', '', FALSE, TRUE);//设置登录的session
                //set_cookie(DB_PRE().'volunteerinfo', $arr, (3600*2), '', '/', '', FALSE, TRUE);//设置登录的session
                
                echo 'yes';
            }else{
                echo 'emailorpassworderror';
            }
        }else{
            echo 'no';
        }
    }
    
    function agreepurpose($agreepurpose_num = 1){
        // 正常返回数据(json)
        $arr = array('agreepurpose_'.$agreepurpose_num=>1);
        $arr = serialize($arr);
        $this->input->set_cookie(DB_PRE().'agreepurposeinfo_'.$agreepurpose_num, $arr, (3600*1), '', '/', '', FALSE, TRUE);//设置登录的session
        //set_cookie(DB_PRE().'admininfo', $arr, (3600*2), '', '/', '', FALSE, TRUE);//设置登录的session
    }
    
    function action_formmethod($form_id = 0){
        $old_form_id = $form_id;
        if(isset($_COOKIE[DB_PRE().'codeinfo'])){
            $codeinfo = unserialize($_COOKIE[DB_PRE().'codeinfo']);
            $admin_id = $codeinfo['admin_id'];
        }else{
            $admin_id = 0;
        }
        
        $form_type = $this->input->post('form_type');
        $input_maxnum = 10;
        $signature_maxnum = 6;
        $select_maxnum = 23;
        $checkbox_maxnum = 3;
        for ($aaa = 1; $aaa <= $input_maxnum; $aaa++) {
            ${'input_'.$aaa} = $this->input->post('input_'.$aaa);
        }
        for ($aaa = 1; $aaa <= 1; $aaa++) {
            ${'datetime_'.$aaa} = $this->input->post('datetime_'.$aaa);
        }
        for ($aaa = 1; $aaa <= 1; $aaa++) {
            ${'textarea_'.$aaa} = $this->input->post('textarea_'.$aaa);
        }
        for ($aaa = 1; $aaa <= $signature_maxnum; $aaa++) {
            ${'signature_'.$aaa} = $this->input->post('signature_'.$aaa);
        }
        for ($aaa = 1; $aaa <= $select_maxnum; $aaa++) {
            ${'select_id_'.$aaa} = $this->input->post('select_id_'.$aaa);
        }
        for ($aaa = 1; $aaa <= $checkbox_maxnum; $aaa++) {
            ${'checkbox_id_'.$aaa} = $this->input->post('checkbox_id_'.$aaa);
        }
        
		$ispass = 1;
		if($old_form_id != 0){//修改
		    $arr = array('edited'=>time());
		}else{
		    $arr = array('form_type'=>$form_type, 'form_key'=>randkey(32), 'status'=>0, 'created'=>time(), 'edited'=>time());
		}
		for ($aaa = 1; $aaa <= $input_maxnum; $aaa++) {
		    if(${'input_'.$aaa} != ''){
		        $arr['input_'.$aaa] = ${'input_'.$aaa};
// 		        $chekck = check_SQLinjection_return(${'input_'.$aaa});//防止sql注入
// 		        if($chekck == '参数非法！'){
// 		            $ispass = 0;
// 		            break;
// 		        }
		    }
		}
		for ($aaa = 1; $aaa <= 1; $aaa++) {
		    if(${'datetime_'.$aaa} != ''){
		        ${'datetime_'.$aaa} = trim(str_replace('T', ' ', ${'datetime_'.$aaa})).':00';
		        ${'datetime_'.$aaa} = strtotime(${'datetime_'.$aaa});
		        
		        $arr['datetime_'.$aaa] = ${'datetime_'.$aaa};
		        $chekck = check_SQLinjection_return(${'datetime_'.$aaa});//防止sql注入
		        if($chekck == '参数非法！'){
		            $ispass = 0;
		            break;
		        }
		    }
		}
		for ($aaa = 1; $aaa <= 1; $aaa++) {
		    if(${'textarea_'.$aaa} != ''){
		        $arr['textarea_'.$aaa] = ${'textarea_'.$aaa};
// 		        $chekck = check_SQLinjection_return(${'textarea_'.$aaa});//防止sql注入
// 		        if($chekck == '参数非法！'){
// 		            $ispass = 0;
// 		            break;
// 		        }
		    }
		}
		for ($aaa = 1; $aaa <= $signature_maxnum; $aaa++) {
		    if(${'signature_'.$aaa} != ''){
		        $arr['signature_'.$aaa] = ${'signature_'.$aaa};
		        $chekck = check_SQLinjection_return(${'signature_'.$aaa});//防止sql注入
		        if($chekck == '参数非法！'){
		            $ispass = 0;
		            break;
		        }
		    }
		}
		for ($aaa = 1; $aaa <= $select_maxnum; $aaa++) {
		    if(${'select_id_'.$aaa} != ''){
		        $arr['select_id_'.$aaa] = ${'select_id_'.$aaa};
		        $chekck = check_SQLinjection_return(${'select_id_'.$aaa});//防止sql注入
		        if($chekck == '参数非法！'){
		            $ispass = 0;
		            break;
		        }
		    }
		}
		for ($aaa = 1; $aaa <= $checkbox_maxnum; $aaa++) {
		    $checkbox_id = $this->input->post('checkbox_id_'.$aaa);
		    if($checkbox_id != '' && !empty($checkbox_id)){
		        for ($ccc = 0; $ccc < count($checkbox_id); $ccc++) {
		            $arr['checkbox_id_'.$aaa.'_'.($ccc + 1)] = $checkbox_id[$ccc];
		        }
		        if(count($checkbox_id) < 10){
		            for ($ccc = count($checkbox_id); $ccc < 10; $ccc++) {
		                $arr['checkbox_id_'.$aaa.'_'.($ccc + 1)] = 0;
		            }
		        }
		    }
		}
		if($ispass == 1){
		    if($old_form_id != 0){//修改
		        $this->db->update(DB_PRE().'form_list', $arr, array('form_id'=>$form_id));
		    }else{
		        $arr['fillin_admin_id'] = $admin_id;
		        $this->db->insert(DB_PRE().'form_list', $arr);
		        $form_id = $this->db->insert_id();
		    }
		    
		    
		    if($old_form_id != 0){//修改
		        $old_recordinfo = $this->WelModel->getrecordinfo($form_id);
		        $form_number = $old_recordinfo['form_number'];
		        if($form_type == 'applyformforvolunteers'){
		            if($select_id_6 == 1){
		                $form_number = str_replace('ABSSV-V-', 'ABSSV-V-', $form_number);
		                $form_number = str_replace('ABSSV-D-', 'ABSSV-V-', $form_number);
		                $form_number = str_replace('ABSSV-B-', 'ABSSV-V-', $form_number);
		            }else if($select_id_6 == 2){
		                $form_number = str_replace('ABSSV-V-', 'ABSSV-D-', $form_number);
		                $form_number = str_replace('ABSSV-D-', 'ABSSV-D-', $form_number);
		                $form_number = str_replace('ABSSV-B-', 'ABSSV-D-', $form_number);
		            }else if($select_id_6 == 3){
		                $form_number = str_replace('ABSSV-V-', 'ABSSV-B-', $form_number);
		                $form_number = str_replace('ABSSV-D-', 'ABSSV-B-', $form_number);
		                $form_number = str_replace('ABSSV-B-', 'ABSSV-B-', $form_number);
		            }else{
		                
		            }
		            $this->db->update(DB_PRE().'form_list', array('form_number'=>$form_number), array('form_id'=>$form_id));
		        }
		    }else{
	            if($form_type == 'applyformforvolunteers'){
	                $month_start = strtotime(date('Y-m').'-01 00:00:00');
	                $month_end = date('Y-m-d', strtotime("first day of +1 month - 1 day", $month_start)).' 23:59:59';
	                $month_end = strtotime($month_end);
	                
	                //AND select_id_6 = ".$select_id_6." AND created >= ".$month_start." AND created <= .$month_end
	                $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE parent = 0 AND form_type = '".$form_type."'";
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
	                if($count < 10){
	                    $count_show = '000'.$count;
	                }else if($count >= 10 & $count < 100){
	                    $count_show = '00'.$count;
	                }else if($count >= 100 & $count < 1000){
	                    $count_show = '0'.$count;
	                }else{
	                    $count_show = $count;
	                }
	                if($select_id_6 == 1){
	                    $form_number = 'ABSSV-V-'.date('mY').'-'.$count_show;
	                }else if($select_id_6 == 2){
	                    $form_number = 'ABSSV-D-'.date('mY').'-'.$count_show;
	                }else if($select_id_6 == 3){
	                    $form_number = 'ABSSV-B-'.date('mY').'-'.$count_show;
	                }else{
	                    $form_number = 'ABSSV-'.date('mY').'-'.$count_show;
	                }
	                $this->db->update(DB_PRE().'form_list', array('form_number'=>$form_number), array('form_id'=>$form_id));
	            }else{
	                $month_start = strtotime(date('Y-m').'-01 00:00:00');
	                $month_end = date('Y-m-d', strtotime("first day of +1 month - 1 day", $month_start)).' 23:59:59';
	                $month_end = strtotime($month_end);
	                
	                // 		            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = '".$form_type."' AND created >= ".$month_start." AND created <= ".$month_end;
	                $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE parent = 0 AND form_type = '".$form_type."'";
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
	                if($count < 10){
	                    $count_show = '000'.$count;
	                }else if($count >= 10 & $count < 100){
	                    $count_show = '00'.$count;
	                }else if($count >= 100 & $count < 1000){
	                    $count_show = '0'.$count;
	                }else{
	                    $count_show = $count;
	                }
	                if($form_type == 'enrolmentform'){
	                    $form_number = 'ABSSP-'.date('mY').'-'.$count_show;
	                }else{
	                    $form_number = ''.date('mY').'-'.$count_show;
	                }
	                $this->db->update(DB_PRE().'form_list', array('form_number'=>$form_number), array('form_id'=>$form_id));
	            }
		    }
		    
		    //处理附件-----START
		    $linshi_pic_1_path = $this->input->post('linshi_pic_1_path', TRUE);
		    $linshi_pic_1_name = $this->input->post('linshi_pic_1_name', TRUE);
		    $table_name = DB_PRE().'form_list';
		    $table_ziduan_name = 'form';
		    $table_ziduan_subname = 'pic';
		    $dataunique_name = 'form_id';
		    $this->WelModel->action_normal_fujian_mul($form_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
		    //处理附件-----END
		}else{
		    echo 'feifacanshu';
		}
    }
    //家访表
    function action_formmethod_forhomevisit($enrolmentform_id = 0, $form_id = 0){
        $old_form_id = $form_id;
        if(isset($_COOKIE[DB_PRE().'codeinfo'])){
            $codeinfo = unserialize($_COOKIE[DB_PRE().'codeinfo']);
            $admin_id = $codeinfo['admin_id'];
        }else{
            $admin_id = 0;
        }
        
        $form_type = $this->input->post('form_type');
        $input_maxnum = 10;
        $signature_maxnum = 6;
        $select_maxnum = 23;
        $checkbox_maxnum = 3;
        for ($aaa = 1; $aaa <= $input_maxnum; $aaa++) {
            ${'input_'.$aaa} = $this->input->post('input_'.$aaa);
        }
        for ($aaa = 1; $aaa <= 2; $aaa++) {
            ${'datetime_'.$aaa} = $this->input->post('datetime_'.$aaa);
        }
        
        $datetime_2_duan = $this->input->post('datetime_2_duan');
        
        for ($aaa = 1; $aaa <= 1; $aaa++) {
            ${'textarea_'.$aaa} = $this->input->post('textarea_'.$aaa);
        }
        for ($aaa = 1; $aaa <= $signature_maxnum; $aaa++) {
            ${'volunteer_'.$aaa.'_id'} = $this->input->post('volunteer_'.$aaa.'_id');
        }
        $driver_id = $this->input->post('driver_id');
        
        for ($aaa = 1; $aaa <= $select_maxnum; $aaa++) {
            ${'select_id_'.$aaa} = $this->input->post('select_id_'.$aaa);
        }
        for ($aaa = 1; $aaa <= $checkbox_maxnum; $aaa++) {
            ${'checkbox_id_'.$aaa} = $this->input->post('checkbox_id_'.$aaa);
        }
        
        $ispass = 1;
        if($old_form_id != 0){//修改
            $arr = array('edited'=>time());
        }else{
            $arr = array('form_type'=>$form_type, 'form_key'=>randkey(32), 'status'=>0, 'created'=>time(), 'edited'=>time());
        }
        for ($aaa = 1; $aaa <= $input_maxnum; $aaa++) {
            if(${'input_'.$aaa} != ''){
                $arr['input_'.$aaa] = ${'input_'.$aaa};
//                 $chekck = check_SQLinjection_return(${'input_'.$aaa});//防止sql注入
//                 if($chekck == '参数非法！'){
//                     $ispass = 0;
//                     break;
//                 }
            }
        }
        for ($aaa = 1; $aaa <= 2; $aaa++) {
            if(${'datetime_'.$aaa} != ''){
                ${'datetime_'.$aaa} = trim(str_replace('T', ' ', ${'datetime_'.$aaa})).':00';
                ${'datetime_'.$aaa} = strtotime(${'datetime_'.$aaa});
                
                $arr['datetime_'.$aaa] = ${'datetime_'.$aaa};
                $chekck = check_SQLinjection_return(${'datetime_'.$aaa});//防止sql注入
                if($chekck == '参数非法！'){
                    $ispass = 0;
                    break;
                }
            }
        }
        if($datetime_2_duan != '' && $datetime_2_duan != 0){
            $arr['datetime_2_duan'] = $datetime_2_duan;
        }
        
        for ($aaa = 1; $aaa <= 1; $aaa++) {
            if(${'textarea_'.$aaa} != ''){
                $arr['textarea_'.$aaa] = ${'textarea_'.$aaa};
//                 $chekck = check_SQLinjection_return(${'textarea_'.$aaa});//防止sql注入
//                 if($chekck == '参数非法！'){
//                     $ispass = 0;
//                     break;
//                 }
            }
        }
        for ($aaa = 1; $aaa <= $signature_maxnum; $aaa++) {
            if(${'volunteer_'.$aaa.'_id'} != ''){
                $arr['volunteer_'.$aaa.'_id'] = ${'volunteer_'.$aaa.'_id'};
            }
        }
        if($driver_id != ''){
            $arr['driver_id'] = $driver_id;
        }
        
        for ($aaa = 1; $aaa <= $select_maxnum; $aaa++) {
            if(${'select_id_'.$aaa} != ''){
                $arr['select_id_'.$aaa] = ${'select_id_'.$aaa};
                $chekck = check_SQLinjection_return(${'select_id_'.$aaa});//防止sql注入
                if($chekck == '参数非法！'){
                    $ispass = 0;
                    break;
                }
            }
        }
        for ($aaa = 1; $aaa <= $checkbox_maxnum; $aaa++) {
            $checkbox_id = $this->input->post('checkbox_id_'.$aaa);
            if($checkbox_id != '' && !empty($checkbox_id)){
                for ($ccc = 0; $ccc < count($checkbox_id); $ccc++) {
                    $arr['checkbox_id_'.$aaa.'_'.($ccc + 1)] = $checkbox_id[$ccc];
                }
                if(count($checkbox_id) < 10){
                    for ($ccc = count($checkbox_id); $ccc < 10; $ccc++) {
                        $arr['checkbox_id_'.$aaa.'_'.($ccc + 1)] = 0;
                    }
                }
            }
        }
        if($ispass == 1){
            if($old_form_id != 0){//修改
                $this->db->update(DB_PRE().'form_list', $arr, array('form_id'=>$form_id));
            }else{
                $arr['enrolmentform_id'] = $enrolmentform_id;
                
                $arr['fillin_admin_id'] = $admin_id;
                $this->db->insert(DB_PRE().'form_list', $arr);
                $form_id = $this->db->insert_id();
            }
            
            if($old_form_id != 0){//修改
                
            }else{
                $sql = "SELECT count(*) AS numcount FROM ".DB_PRE()."form_list WHERE parent = 0 AND form_type IN ('homevisit_1st', 'homevisit_followupvisit')";
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
                if($count < 10){
                    $count_show = '000'.$count;
                }else if($count >= 10 & $count < 100){
                    $count_show = '00'.$count;
                }else if($count >= 100 & $count < 1000){
                    $count_show = '0'.$count;
                }else{
                    $count_show = $count;
                }
                $form_number = ''.date('mY').'-'.$count_show;
                
                $this->db->update(DB_PRE().'form_list', array('form_number'=>$form_number), array('form_id'=>$form_id));
            }
            
            //处理附件-----START
            $linshi_pic_1_path = $this->input->post('linshi_pic_1_path', TRUE);
            $linshi_pic_1_name = $this->input->post('linshi_pic_1_name', TRUE);
            $table_name = DB_PRE().'form_list';
            $table_ziduan_name = 'form';
            $table_ziduan_subname = 'pic';
            $dataunique_name = 'form_id';
            $this->WelModel->action_normal_fujian_mul($form_id, $dataunique_name, $linshi_pic_1_path, $linshi_pic_1_name, $table_name, $table_ziduan_name, $table_ziduan_subname, 1);////处理附件
            //处理附件-----END
            
            
            
            //同时更新 case 状态
            $arr = array();
            //此处需要判断家访记录
            $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE enrolmentform_id = ".$enrolmentform_id." ORDER BY form_id DESC LIMIT 0, 1";
            $dateres = $this->db->query($sql)->row_array();
            if(!empty($dateres)){
                $have_nextdatetime = $dateres['datetime_2'];
                $datetime_2_duan = $dateres['datetime_2_duan'];
                for ($ccc = 0; $ccc < 10; $ccc++) {
                    ${'checkbox_id_1_'.($ccc + 1)} = $dateres['checkbox_id_1_'.($ccc + 1)];
                }
                $select_id_3 = $dateres['select_id_3'];
                $select_id_4 = $dateres['select_id_4'];
                $form_type = $dateres['form_type'];
                if(($form_type == 'homevisit_1st' || $form_type == 'homevisit_followupvisit') && $select_id_4 == 1){
                    $arr['is_finished'] = 0;
                    $arr['datetime_last'] = $have_nextdatetime;
                    $arr['datetime_last_duan'] = $datetime_2_duan;
                    $arr['health_id_last'] = $select_id_3;
                    for ($ccc = 0; $ccc < 10; $ccc++) {
                        $arr['checkbox_id_1_'.($ccc + 1).'_last'] = ${'checkbox_id_1_'.($ccc + 1)};
                    }
                }else{
                    $arr['is_finished'] = 1;
                    $arr['datetime_last'] = 0;
                    $arr['datetime_last_duan'] = 0;
                    $arr['health_id_last'] = 0;
                    for ($ccc = 0; $ccc < 10; $ccc++) {
                        $arr['checkbox_id_1_'.($ccc + 1).'_last'] = 0;
                    }
                }
            }
            if(!empty($arr)){
                if($old_form_id != 0){//修改
                    
                }else{
                    $arr['last_fillin_reopen'] = 0;//最后填写家访的时间
                    $arr['last_fillin_time'] = time();//最后填写家访的时间
                }
                $this->db->update(DB_PRE().'form_list', $arr, array('form_id'=>$enrolmentform_id));
            }
        }else{
            echo 'feifacanshu';
        }
    }
    
    //操作批准表单
    function approve_formtable($form_id, $status){
        $is_experience = $this->input->post('is_experience');
        $select_id_8 = $this->input->post('select_id_8');
        
        $checkbox_maxnum = 3;
        
        for ($aaa = 1; $aaa <= $checkbox_maxnum; $aaa++) {
            ${'checkbox_id_'.$aaa} = $this->input->post('checkbox_id_'.$aaa);
        }
        
        if(isset($_COOKIE[DB_PRE().'admininfo'])){
            $admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
            $admin_id = $admininfo['admin_id'];
        }else{
            $admin_id = 0;
        }
        
        $arr = array('status'=>$status, 'status_admin_id'=>$admin_id, 'status_time'=>time());
        if($is_experience != ''){
            $arr['is_experience'] = $is_experience;
        }
        if($select_id_8 != ''){
            $arr['select_id_8'] = $select_id_8;
            $arr['health_id_last'] = $select_id_8;
        }
        $checkbox_id = $this->input->post('checkbox_id_1');
        if(!empty($checkbox_id)){
            for ($ccc = 0; $ccc < count($checkbox_id); $ccc++) {
                $arr['checkbox_id_1_'.($ccc + 1)] = $checkbox_id[$ccc];
                $arr['checkbox_id_1_'.($ccc + 1).'_last'] = $checkbox_id[$ccc];
            }
            if(count($checkbox_id) < 10){
                for ($ccc = count($checkbox_id); $ccc < 10; $ccc++) {
                    $arr['checkbox_id_1_'.($ccc + 1)] = 0;
                    $arr['checkbox_id_1_'.($ccc + 1).'_last'] = 0;
                }
            }
        }
        $this->db->update(DB_PRE().'form_list', $arr, array('form_id'=>$form_id));
    }
    
    //操作分配Case表单
    function approve_caseassign($form_id){
        if(isset($_COOKIE[DB_PRE().'admininfo'])){
            $admininfo = unserialize($_COOKIE[DB_PRE().'admininfo']);
            $admin_id = $admininfo['admin_id'];
        }else{
            $admin_id = 0;
        }
        
        $driver_id = $this->input->post('driver_id');
        $volunteer_1_id = $this->input->post('volunteer_1_id');
        $volunteer_2_id = $this->input->post('volunteer_2_id');
        $volunteer_3_id = $this->input->post('volunteer_3_id');
        $volunteer_4_id = $this->input->post('volunteer_4_id');
        $volunteer_5_id = $this->input->post('volunteer_5_id');
        $volunteer_6_id = $this->input->post('volunteer_6_id');
        
        $datetime_2 = $this->input->post('datetime_2');
        $datetime_2_duan = $this->input->post('datetime_2_duan');
        $assign_memo = $this->input->post('assign_memo');
        
        $arr = array('is_assigned'=>1, 'is_assigned_admin_id'=>$admin_id, 'is_assigned_time'=>time());
        if($driver_id != '' && $driver_id != 0){
            $arr['driver_id'] = $driver_id;
        }
        if($volunteer_1_id != ''){
            $arr['volunteer_1_id'] = $volunteer_1_id;
        }
        if($volunteer_2_id != ''){
            $arr['volunteer_2_id'] = $volunteer_2_id;
        }
        if($volunteer_3_id != ''){
            $arr['volunteer_3_id'] = $volunteer_3_id;
        }
        if($volunteer_4_id != ''){
            $arr['volunteer_4_id'] = $volunteer_4_id;
        }
        if($volunteer_5_id != ''){
            $arr['volunteer_5_id'] = $volunteer_5_id;
        }
        if($volunteer_6_id != ''){
            $arr['volunteer_6_id'] = $volunteer_6_id;
        }
        if($datetime_2 != ''){
            $datetime_2 = trim(str_replace('T', ' ', $datetime_2)).':00';
            $datetime_2 = strtotime($datetime_2);
            $arr['datetime_2'] = $datetime_2;
        }
        if($datetime_2_duan != '' && $datetime_2_duan != 0){
            $arr['datetime_2_duan'] = $datetime_2_duan;
        }
        
        if($assign_memo != ''){
            $arr['assign_memo'] = $assign_memo;
        }
        
        $arr['last_fillin_reopen'] = 1;//重新打开
        
        $this->db->update(DB_PRE().'form_list', $arr, array('form_id'=>$form_id));
        
        
        //同时更新 case 状态
        $arr = array();
        //此处需要判断家访记录
        $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE enrolmentform_id = ".$form_id." ORDER BY form_id DESC LIMIT 0, 1";
        $dateres = $this->db->query($sql)->row_array();
        if(!empty($dateres)){
            $have_nextdatetime = $dateres['datetime_2'];
            $datetime_2_duan = $dateres['datetime_2_duan'];
            for ($ccc = 0; $ccc < 10; $ccc++) {
                ${'checkbox_id_1_'.($ccc + 1)} = $dateres['checkbox_id_1_'.($ccc + 1)];
            }
            $select_id_3 = $dateres['select_id_3'];
            $select_id_4 = $dateres['select_id_4'];
            $form_type = $dateres['form_type'];
            if(($form_type == 'homevisit_1st' || $form_type == 'homevisit_followupvisit') && $select_id_4 == 1){
                $arr['is_finished'] = 0;
                $arr['datetime_last'] = $have_nextdatetime;
                $arr['datetime_last_duan'] = $datetime_2_duan;
                $arr['health_id_last'] = $select_id_3;
                for ($ccc = 0; $ccc < 10; $ccc++) {
                    $arr['checkbox_id_1_'.($ccc + 1).'_last'] = ${'checkbox_id_1_'.($ccc + 1)};
                }
            }else{
                $arr['is_finished'] = 1;
                $arr['datetime_last'] = 0;
                $arr['datetime_last_duan'] = 0;
                $arr['health_id_last'] = 0;
                for ($ccc = 0; $ccc < 10; $ccc++) {
                    $arr['checkbox_id_1_'.($ccc + 1).'_last'] = 0;
                }
            }
            $this->db->update(DB_PRE().'form_list', $arr, array('form_id'=>$form_id));
        }else{
            $datetime_2 = $this->input->post('datetime_2');
            $datetime_2_duan = $this->input->post('datetime_2_duan');
            if($datetime_2 != ''){
                $datetime_2 = trim(str_replace('T', ' ', $datetime_2)).':00';
                $datetime_2 = strtotime($datetime_2);
                
                $arr['is_finished'] = 0;
                $arr['datetime_last'] = $datetime_2;
                $arr['datetime_last_duan'] = $datetime_2_duan;
                
                $recordinfo = $this->WelModel->getrecordinfo($form_id);
                if(!empty($recordinfo)){
                    $arr['health_id_last'] = $recordinfo['select_id_8'];
                    for ($ccc = 0; $ccc < 10; $ccc++) {
                        $arr['checkbox_id_1_'.($ccc + 1).'_last'] = $recordinfo['checkbox_id_1_'.($ccc + 1)];
                    }
                }
                $this->db->update(DB_PRE().'form_list', $arr, array('form_id'=>$form_id));
            }
        }
    }
    
    function changelanguage($lan, $url) {
        $url = str_replace('slash_tag', '/', $url);
        $url = base64_decode($url);
        $this->session->set_userdata('lang', $lan);
        redirect($url);
    }
    
    
    function uploadpicturebyhtml($folder_name, $upload_show_width = 100, $upload_show_height = 100){
        // 		$this->load->library('app');
        $default_width = 2000;
        $default_height = 2000;
        
        $uploaddir = "upload/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        $uploaddir = "upload/".$folder_name."/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        $uploaddir = "upload/".$folder_name."/".date('Y')."/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        $uploaddir = "upload/".$folder_name."/".date('Y')."/".date('m')."/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        
        // 	    $verifyToken = md5('unique_salt' . $_POST['timestamp']);
        
        // 	    if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
        
        $file_size = floor($_FILES ['Filedata']['size'] / 1024);
        // 	        print_r($file_size.'kb');exit;
        
        $uploadFile = $uploaddir .'_'.rand(1, 1000). $_FILES ['Filedata'] ['name'];
        $file_type = strtolower ( substr ( strrchr ( $uploadFile, "." ), 1 ) );
        
        $nowthistime = date('Y_m_d_H_i_s').randkey(10);
        $uploadFile1 = $uploaddir . $nowthistime.'.' . $file_type;
        $uploadFile1_100x100 = $uploaddir.$nowthistime .'_100x100'.'.' . $file_type;
        $uploadFile1_200x200 = $uploaddir.$nowthistime .'_200x200'.'.' . $file_type;
        $uploadFile1_400x400 = $uploaddir.$nowthistime .'_400x400'.'.' . $file_type;
        $uploadFile1_800x800 = $uploaddir.$nowthistime .'_800x800'.'.' . $file_type;
        //echo $file_type;exit;
        
        if($file_type == 'jpg' || $file_type == 'jpeg' || $file_type == 'gif' || $file_type == 'png'){
            if (move_uploaded_file ( $_FILES ['Filedata'] ['tmp_name'], $uploadFile1 )) {
                
                // 	                if(file_exists($uploadFile1)){
                // 	                    $uploadFile1 = $uploaddir . 'big_'.$nowthistime  . '(new).' . $file_type;
                // 	                    $uploadFile1_100x100 = $uploaddir .'big_'.$nowthistime  . '(new).' .'_preview'.'.' . $file_type;
                // 	                }
                
                $res = copy($uploadFile1, $uploadFile1_100x100);
                $res = copy($uploadFile1, $uploadFile1_200x200);
                $res = copy($uploadFile1, $uploadFile1_400x400);
                $res = copy($uploadFile1, $uploadFile1_800x800);
                
                
                $img_width = getImgWidth ( $uploadFile1 ); /* 获取宽度 */
                $img_height = getImgHeight ( $uploadFile1 ); /* 获取高度 */
                
                if($file_type != 'gif'){
                    if ($img_width >= $img_height && $img_width > $default_width) {
                        resizeImage ( $uploadFile1, $img_width, $img_height, ($default_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $default_width) {
                        resizeImage ( $uploadFile1, $img_width, $img_height, ($default_width / $img_height) ); // 等比例压缩
                    }
                }
                
                //自动生成一个小图---缩略图
                $preview_width = 100;
                $preview_height = 100;
                if ($img_width >= $img_height && $img_width > $preview_width) {
                    resizeImage ( $uploadFile1_100x100, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                } else if ($img_height > $img_width && $img_height > $preview_width) {
                    resizeImage ( $uploadFile1_100x100, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                }
                
                
                //自动生成一个小图---缩略图
                $preview_width = 200;
                $preview_height = 200;
                if ($img_width >= $img_height && $img_width > $preview_width) {
                    resizeImage ( $uploadFile1_200x200, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                } else if ($img_height > $img_width && $img_height > $preview_width) {
                    resizeImage ( $uploadFile1_200x200, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                }
                
                //自动生成一个小图---缩略图
                $preview_width = 400;
                $preview_height = 400;
                if ($img_width >= $img_height && $img_width > $preview_width) {
                    resizeImage ( $uploadFile1_400x400, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                } else if ($img_height > $img_width && $img_height > $preview_width) {
                    resizeImage ( $uploadFile1_400x400, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                }
                
                //自动生成一个小图---缩略图
                $preview_width = 800;
                $preview_height = 800;
                if ($img_width >= $img_height && $img_width > $preview_width) {
                    resizeImage ( $uploadFile1_800x800, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                } else if ($img_height > $img_width && $img_height > $preview_width) {
                    resizeImage ( $uploadFile1_800x800, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                }
                
                echo '
                    <li style="float:left;padding:0px;margin:0px;list-style-type: none;">
    		    		<div class="list">
    						<input type="hidden" name="linshi_picpath[]" value="'.$uploadFile1.'"/>
    						<img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.base_url().$uploadFile1_200x200.'?datetime='.time().'"/>
                            <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.CDN_URL().'themes/default/images/ajax_loading.gif"/></div>
                            <div class="btndelete2">
                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.CDN_URL().'themes/default/images/icon_delete_1.png"/>
                            </div>
                            <div class="btnxuanzhuan">
                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.base_url().'themes/default/images/icon_xuanzhuan.png"/>
                            </div>
                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="linshi_picname[]" value=""/>
                            </div>
                        </div>
                    </li>
				';
            }else {
                echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
        }else if($file_type == 'doc' || $file_type == 'docx' || $file_type == 'xls' || $file_type == 'xlsx' || $file_type == 'ppt' || $file_type == 'pptx' || $file_type == 'rar' || $file_type == 'pdf' || $file_type == 'zip'){
            if (move_uploaded_file ( $_FILES ['Filedata'] ['tmp_name'], $uploadFile1 )) {
                echo '
                    <li style="float:left;padding:0px;margin:0px;list-style-type: none;">
    		    		<div class="list">
    						<input type="hidden" name="linshi_picpath[]" value="'.$uploadFile1.'"/>
    						<a class="suolvshowlink" href="'.base_url().$uploadFile1.'" target="_blank"><img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.CDN_URL().'themes/default/images/icon_file_'.$file_type.'.png"/></a>
                            <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.CDN_URL().'themes/default/images/ajax_loading.gif"/></div>
                            <div class="btndelete2">
                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.CDN_URL().'themes/default/images/icon_delete_1.png"/>
                            </div>
                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="linshi_picname[]" value=""/>
                            </div>
                        </div>
                    </li>
				';
            }else {
                echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
        }else if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){
            if (move_uploaded_file ( $_FILES ['Filedata'] ['tmp_name'], $uploadFile1 )) {
                echo '
                    <li style="float:left;padding:0px;margin:0px;list-style-type: none;">
    		    		<div class="list">
    						<input type="hidden" name="linshi_picpath[]" value="'.$uploadFile1.'"/>
    						<table cellspacing="0" cellpadding="0" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;border:0px;margin:0px;padding:0px;background-color:black;">
								<tr>
									<td valign="middle" style="border:0px;margin:0px;padding:0px;">
										<video id="video" width="'.$upload_show_width.'" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;object-fit:cover;" src="'.base_url().$uploadFile1.'?datetime='.time().'" controls></video>
									</td>
								</tr>
							</table>
                            <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.CDN_URL().'themes/default/images/ajax_loading.gif"/></div>
                            <div class="btndelete2">
                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.CDN_URL().'themes/default/images/icon_delete_1.png"/>
                            </div>
                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="linshi_picname[]" value=""/>
                            </div>
                        </div>
                    </li>
				';
            }else {
                echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
        }
        
        echo '
                <style>
                    #normalpicturelist_tbody{float:left;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;}
                    #normalpicturelist_tbody .list{position:relative;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;margin-top:10px;margin-right:8px;}
                    #normalpicturelist_tbody .list .btndelete{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
                    #normalpicturelist_tbody .list .btndelete2{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
					#normalpicturelist_tbody .list:hover .btndelete{display:block;}
				    #normalpicturelist_tbody .list:hover .btndelete2{display:block;}
                        
                    #normalpicturelist_tbody .list .btnxuanzhuan{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
                    #normalpicturelist_tbody .list .btnxuanzhuan2{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
                    #normalpicturelist_tbody .list:hover .btnxuanzhuan{display:block;}
                    #normalpicturelist_tbody .list:hover .btnxuanzhuan2{display:block;}
                    .draggable-placeholder{float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;margin-top:15px;margin-right:15px;}
                        
                    ::-webkit-input-placeholder {
                      color: #999;
                      font-size: 10px;
                    }
                    ::-moz-placeholder {
                      color: #999;
                      font-size: 10px;
                    }
                    :-ms-input-placeholder {
                      color: #999;
                      font-size: 10px;
                    }
               </style>
            ';
        // 	    }
    }
    
    function uploadpicturebyhtml_mul($folder_name, $fujianinputname = 'linshi_picpath', $upload_show_width = 100, $upload_show_height = 100){
        // 	    $this->load->library('app');
        
        $default_width = 2000;
        $default_height = 2000;
        
        $uploaddir = "upload/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        $uploaddir = "upload/".$folder_name."/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        $uploaddir = "upload/".$folder_name."/".date('Y')."/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        $uploaddir = "upload/".$folder_name."/".date('Y')."/".date('m')."/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        
        // 	    $verifyToken = md5('unique_salt' . $_POST['timestamp']);
        
        // 	    if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
        
        $file_size = floor($_FILES ['Filedata']['size'] / 1024);
        // 	        print_r($file_size.'kb');exit;
        
        $uploadFile = $uploaddir .'_'.rand(1, 1000). $_FILES ['Filedata'] ['name'];
        $file_type = strtolower ( substr ( strrchr ( $uploadFile, "." ), 1 ) );
        
        $nowthistime = date('Y_m_d_H_i_s').randkey(10);
        $uploadFile1 = $uploaddir . $nowthistime.'.' . $file_type;
        $uploadFile1_100x100 = $uploaddir.$nowthistime .'_100x100'.'.' . $file_type;
        $uploadFile1_200x200 = $uploaddir.$nowthistime .'_200x200'.'.' . $file_type;
        $uploadFile1_400x400 = $uploaddir.$nowthistime .'_400x400'.'.' . $file_type;
        $uploadFile1_800x800 = $uploaddir.$nowthistime .'_800x800'.'.' . $file_type;
        //echo $file_type;exit;
        
        if($file_type == 'jpg' || $file_type == 'jpeg' || $file_type == 'gif' || $file_type == 'png'){
            if (move_uploaded_file ( $_FILES ['Filedata'] ['tmp_name'], $uploadFile1 )) {
                
                // 	                if(file_exists($uploadFile1)){
                // 	                    $uploadFile1 = $uploaddir . 'big_'.$nowthistime  . '(new).' . $file_type;
                // 	                    $uploadFile1_100x100 = $uploaddir .'big_'.$nowthistime  . '(new).' .'_preview'.'.' . $file_type;
                // 	                }
                
                $res = copy($uploadFile1, $uploadFile1_100x100);
                $res = copy($uploadFile1, $uploadFile1_200x200);
                $res = copy($uploadFile1, $uploadFile1_400x400);
                $res = copy($uploadFile1, $uploadFile1_800x800);
                
                
                $img_width = getImgWidth ( $uploadFile1 ); /* 获取宽度 */
                $img_height = getImgHeight ( $uploadFile1 ); /* 获取高度 */
                
                if($file_type != 'gif'){
                    if ($img_width >= $img_height && $img_width > $default_width) {
                        resizeImage ( $uploadFile1, $img_width, $img_height, ($default_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $default_width) {
                        resizeImage ( $uploadFile1, $img_width, $img_height, ($default_width / $img_height) ); // 等比例压缩
                    }
                    
                    //自动生成一个小图---缩略图
                    $preview_width = 100;
                    $preview_height = 100;
                    if ($img_width >= $img_height && $img_width > $preview_width) {
                        resizeImage ( $uploadFile1_100x100, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $preview_width) {
                        resizeImage ( $uploadFile1_100x100, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                    }
                    
                    
                    //自动生成一个小图---缩略图
                    $preview_width = 200;
                    $preview_height = 200;
                    if ($img_width >= $img_height && $img_width > $preview_width) {
                        resizeImage ( $uploadFile1_200x200, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $preview_width) {
                        resizeImage ( $uploadFile1_200x200, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                    }
                    
                    //自动生成一个小图---缩略图
                    $preview_width = 400;
                    $preview_height = 400;
                    if ($img_width >= $img_height && $img_width > $preview_width) {
                        resizeImage ( $uploadFile1_400x400, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $preview_width) {
                        resizeImage ( $uploadFile1_400x400, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                    }
                    
                    //自动生成一个小图---缩略图
                    $preview_width = 800;
                    $preview_height = 800;
                    if ($img_width >= $img_height && $img_width > $preview_width) {
                        resizeImage ( $uploadFile1_800x800, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $preview_width) {
                        resizeImage ( $uploadFile1_800x800, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                    }
                }
                
                echo '
                        <li style="float:left;padding:0px;margin:0px;list-style-type: none;">
        		    		<div class="list">
        						<input type="hidden" name="'.$fujianinputname.'_path[]" value="'.$uploadFile1.'"/>
        						<img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.base_url().$uploadFile1_200x200.'?datetime='.time().'"/>
                                <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.CDN_URL().'themes/default/images/ajax_loading.gif"/></div>
                                <div class="btndelete2">
                                    <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.CDN_URL().'themes/default/images/icon_delete_1.png"/>
                                </div>
                                <div class="btnxuanzhuan">
                                    <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.base_url().'themes/default/images/icon_xuanzhuan.png"/>
                                </div>
                                <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
                                    <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="'.$fujianinputname.'_name[]" value=""/>
                                </div>
                            </div>
                        </li>
    				';
                
            }else {
                echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
        }else if($file_type == 'doc' || $file_type == 'docx' || $file_type == 'xls' || $file_type == 'xlsx' || $file_type == 'ppt' || $file_type == 'pptx' || $file_type == 'rar' || $file_type == 'pdf' || $file_type == 'zip'){
            if (move_uploaded_file ( $_FILES ['Filedata'] ['tmp_name'], $uploadFile1 )) {
                
                echo '
                    <li style="float:left;padding:0px;margin:0px;list-style-type: none;">
    		    		<div class="list">
    						<input type="hidden" name="'.$fujianinputname.'_path[]" value="'.$uploadFile1.'"/>
    						<a class="suolvshowlink" href="'.base_url().$uploadFile1.'" target="_blank"><img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.CDN_URL().'themes/default/images/icon_file_'.$file_type.'.png"/></a>
                            <div class="btndelete2">
                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.CDN_URL().'themes/default/images/icon_delete_1.png"/>
                            </div>
                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="'.$fujianinputname.'_name[]" value=""/>
                            </div>
    					</div>
                    </li>
				';
            }else {
                echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
        }else if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){
            if (move_uploaded_file ( $_FILES ['Filedata'] ['tmp_name'], $uploadFile1 )) {
                echo '
                    <li style="float:left;padding:0px;margin:0px;list-style-type: none;">
    		    		<div class="list">
    						<input type="hidden" name="'.$fujianinputname.'_path[]" value="'.$uploadFile1.'"/>
    						<table cellspacing="0" cellpadding="0" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;border:0px;margin:0px;padding:0px;background-color:black;">
								<tr>
									<td valign="middle" style="border:0px;margin:0px;padding:0px;">
										<video id="video" width="'.$upload_show_width.'" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;object-fit:cover;" src="'.base_url().$uploadFile1.'?datetime='.time().'" controls></video>
									</td>
								</tr>
							</table>
                            <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.CDN_URL().'themes/default/images/ajax_loading.gif"/></div>
                            <div class="btndelete2">
                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.CDN_URL().'themes/default/images/icon_delete_1.png"/>
                            </div>
                            <div style="display:none;float:left;width:100%;height:25px;margin-top:3px;">
                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="'.$fujianinputname.'_name[]" value=""/>
                            </div>
                        </div>
                    </li>
				';
            }else {
                echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
        }
        
        echo '
                <style>
                    #coursepicturelist_'.$fujianinputname.'{float:left;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;}
                    #coursepicturelist_'.$fujianinputname.' .list{position:relative;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;margin-top:10px;margin-right:8px;}
                    #coursepicturelist_'.$fujianinputname.' .list .btndelete{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
                    #coursepicturelist_'.$fujianinputname.' .list .btndelete2{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
					#coursepicturelist_'.$fujianinputname.' .list:hover .btndelete{display:block;}
				    #coursepicturelist_'.$fujianinputname.' .list:hover .btndelete2{display:block;}
				        
                    #coursepicturelist_'.$fujianinputname.' .list .btnxuanzhuan{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
                    #coursepicturelist_'.$fujianinputname.' .list .btnxuanzhuan2{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
                    #coursepicturelist_'.$fujianinputname.' .list:hover .btnxuanzhuan{display:block;}
                    #coursepicturelist_'.$fujianinputname.' .list:hover .btnxuanzhuan2{display:block;}
                    .draggable-placeholder{float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;margin-top:15px;margin-right:15px;}
                        
                    ::-webkit-input-placeholder {
                      color: #999;
                      font-size: 10px;
                    }
                    ::-moz-placeholder {
                      color: #999;
                      font-size: 10px;
                    }
                    :-ms-input-placeholder {
                      color: #999;
                      font-size: 10px;
                    }
               </style>
            ';
        // 	    }
    }
    
    function uploadpicturebyhtml_mul_memo($folder_name, $fujianinputname = 'linshi_picpath', $upload_show_width = 100, $upload_show_height = 100){
        // 	    $this->load->library('app');
        
        $default_width = 2000;
        $default_height = 2000;
        
        $uploaddir = "upload/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        $uploaddir = "upload/".$folder_name."/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        $uploaddir = "upload/".$folder_name."/".date('Y')."/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        $uploaddir = "upload/".$folder_name."/".date('Y')."/".date('m')."/";
        if (! is_dir ( $uploaddir )) {
            mkdir ( $uploaddir, 0755 );
        }
        
        // 	    $verifyToken = md5('unique_salt' . $_POST['timestamp']);
        
        // 	    if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
        
        $file_size = floor($_FILES ['Filedata']['size'] / 1024);
        // 	        print_r($file_size.'kb');exit;
        
        $uploadFile = $uploaddir .'_'.rand(1, 1000). $_FILES ['Filedata'] ['name'];
        $file_type = strtolower ( substr ( strrchr ( $uploadFile, "." ), 1 ) );
        
        $nowthistime = date('Y_m_d_H_i_s').randkey(10);
        $uploadFile1 = $uploaddir . $nowthistime.'.' . $file_type;
        $uploadFile1_100x100 = $uploaddir.$nowthistime .'_100x100'.'.' . $file_type;
        $uploadFile1_200x200 = $uploaddir.$nowthistime .'_200x200'.'.' . $file_type;
        $uploadFile1_400x400 = $uploaddir.$nowthistime .'_400x400'.'.' . $file_type;
        $uploadFile1_800x800 = $uploaddir.$nowthistime .'_800x800'.'.' . $file_type;
        //echo $file_type;exit;
        
        if($file_type == 'jpg' || $file_type == 'jpeg' || $file_type == 'gif' || $file_type == 'png'){
            if (move_uploaded_file ( $_FILES ['Filedata'] ['tmp_name'], $uploadFile1 )) {
                
                // 	                if(file_exists($uploadFile1)){
                // 	                    $uploadFile1 = $uploaddir . 'big_'.$nowthistime  . '(new).' . $file_type;
                // 	                    $uploadFile1_100x100 = $uploaddir .'big_'.$nowthistime  . '(new).' .'_preview'.'.' . $file_type;
                // 	                }
                
                $res = copy($uploadFile1, $uploadFile1_100x100);
                $res = copy($uploadFile1, $uploadFile1_200x200);
                $res = copy($uploadFile1, $uploadFile1_400x400);
                $res = copy($uploadFile1, $uploadFile1_800x800);
                
                $img_width = getImgWidth ( $uploadFile1 ); /* 获取宽度 */
                $img_height = getImgHeight ( $uploadFile1 ); /* 获取高度 */
                
                if($file_type != 'gif'){
                    if ($img_width >= $img_height && $img_width > $default_width) {
                        resizeImage ( $uploadFile1, $img_width, $img_height, ($default_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $default_width) {
                        resizeImage ( $uploadFile1, $img_width, $img_height, ($default_width / $img_height) ); // 等比例压缩
                    }
                    
                    
                    //自动生成一个小图---缩略图
                    $preview_width = 100;
                    $preview_height = 100;
                    if ($img_width >= $img_height && $img_width > $preview_width) {
                        resizeImage ( $uploadFile1_100x100, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $preview_width) {
                        resizeImage ( $uploadFile1_100x100, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                    }
                    
                    
                    //自动生成一个小图---缩略图
                    $preview_width = 200;
                    $preview_height = 200;
                    if ($img_width >= $img_height && $img_width > $preview_width) {
                        resizeImage ( $uploadFile1_200x200, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $preview_width) {
                        resizeImage ( $uploadFile1_200x200, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                    }
                    
                    //自动生成一个小图---缩略图
                    $preview_width = 400;
                    $preview_height = 400;
                    if ($img_width >= $img_height && $img_width > $preview_width) {
                        resizeImage ( $uploadFile1_400x400, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $preview_width) {
                        resizeImage ( $uploadFile1_400x400, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                    }
                    
                    //自动生成一个小图---缩略图
                    $preview_width = 800;
                    $preview_height = 800;
                    if ($img_width >= $img_height && $img_width > $preview_width) {
                        resizeImage ( $uploadFile1_800x800, $img_width, $img_height, ($preview_width / $img_width) ); // 等比例压缩
                    } else if ($img_height > $img_width && $img_height > $preview_width) {
                        resizeImage ( $uploadFile1_800x800, $img_width, $img_height, ($preview_width / $img_height) ); // 等比例压缩
                    }
                }
                
                
                echo '
                        <li style="float:left;padding:0px;margin:0px;list-style-type: none;">
        		    		<div class="list">
        						<input type="hidden" name="'.$fujianinputname.'_path[]" value="'.$uploadFile1.'"/>
        						<img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.base_url().$uploadFile1_200x200.'?datetime='.time().'"/>
                                <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.CDN_URL().'themes/default/images/ajax_loading.gif"/></div>
                                <div class="btndelete2">
                                    <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.CDN_URL().'themes/default/images/icon_delete_1.png"/>
                                </div>
                                <div class="btnxuanzhuan">
                                    <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.base_url().'themes/default/images/icon_xuanzhuan.png"/>
                                </div>
                                <div style="float:left;width:100%;height:25px;margin-top:3px;">
                                    <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="'.$fujianinputname.'_name[]" value=""/>
                                </div>
                            </div>
                        </li>
    				';
                
            }else {
                echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
        }else if($file_type == 'doc' || $file_type == 'docx' || $file_type == 'xls' || $file_type == 'xlsx' || $file_type == 'ppt' || $file_type == 'pptx' || $file_type == 'rar' || $file_type == 'pdf' || $file_type == 'zip'){
            if (move_uploaded_file ( $_FILES ['Filedata'] ['tmp_name'], $uploadFile1 )) {
                echo '
                    <li style="float:left;padding:0px;margin:0px;list-style-type: none;">
    		    		<div class="list">
    						<input type="hidden" name="'.$fujianinputname.'_path[]" value="'.$uploadFile1.'"/>
    						<a class="suolvshowlink" href="'.base_url().$uploadFile1.'" target="_blank"><img style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;" src="'.CDN_URL().'themes/default/images/icon_file_'.$file_type.'.png"/></a>
                            <div class="btndelete2">
                                <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.CDN_URL().'themes/default/images/icon_delete_1.png"/>
                            </div>
                            <div style="float:left;width:100%;height:25px;margin-top:3px;">
                                <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="'.$fujianinputname.'_name[]" value=""/>
                            </div>
    					</div>
                    </li>
				';
            }else {
                echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
        }else if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){
            if (move_uploaded_file ( $_FILES ['Filedata'] ['tmp_name'], $uploadFile1 )) {
                echo '
                        <li style="float:left;padding:0px;margin:0px;list-style-type: none;">
        		    		<div class="list">
        						<input type="hidden" name="'.$fujianinputname.'_path[]" value="'.$uploadFile1.'"/>
        						<table cellspacing="0" cellpadding="0" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;border:0px;margin:0px;padding:0px;background-color:black;">
									<tr>
										<td valign="middle" style="border:0px;margin:0px;padding:0px;">
											<video id="video" width="'.$upload_show_width.'" style="float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;object-fit:cover;" src="'.base_url().$uploadFile1.'?datetime='.time().'" controls></video>
										</td>
									</tr>
								</table>
                                <div class="btnloading" style="display:none;float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;border-radius:6px;"><img style="float:left;width:20px;height:20px;margin-left:19px;margin-top:19px;" src="'.CDN_URL().'themes/default/images/ajax_loading.gif"/></div>
                                <div class="btndelete2">
                                    <img style="float:left;width:20px;height:20px;margin-left:8px;margin-top:12px;" src="'.CDN_URL().'themes/default/images/icon_delete_1.png"/>
                                </div>
                                <div style="float:left;width:100%;height:25px;margin-top:3px;">
                                    <input type="text" placeholder="点击填写备注" style="float:left;width:calc(100% - 6px);font-size:10px;" name="'.$fujianinputname.'_name[]" value=""/>
                                </div>
                            </div>
                        </li>
    				';
            }else {
                echo '<p class="error">Please enter all of the information to add your high score.</p>';
            }
        }
        
        echo '
                <style>
                    #coursepicturelist_'.$fujianinputname.'{float:left;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;}
                    #coursepicturelist_'.$fujianinputname.' .list{position:relative;float:left;width:'.$upload_show_width.'px;height:'.($upload_show_height + 25).'px;margin-top:10px;margin-right:8px;}
                    #coursepicturelist_'.$fujianinputname.' .list .btndelete{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
                    #coursepicturelist_'.$fujianinputname.' .list .btndelete2{display:none;float:left;width:20px;height:20px;margin-left:-20px;margin-top:-20px;}
					#coursepicturelist_'.$fujianinputname.' .list:hover .btndelete{display:block;}
				    #coursepicturelist_'.$fujianinputname.' .list:hover .btndelete2{display:block;}
				        
                    #coursepicturelist_'.$fujianinputname.' .list .btnxuanzhuan{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
                    #coursepicturelist_'.$fujianinputname.' .list .btnxuanzhuan2{display:none;float:left;width:20px;height:20px;margin-left:-50px;margin-top:-20px;}
                    #coursepicturelist_'.$fujianinputname.' .list:hover .btnxuanzhuan{display:block;}
                    #coursepicturelist_'.$fujianinputname.' .list:hover .btnxuanzhuan2{display:block;}
                    .draggable-placeholder{float:left;width:'.$upload_show_width.'px;height:'.$upload_show_height.'px;margin-top:15px;margin-right:15px;}
                        
                    ::-webkit-input-placeholder {
                      color: #999;
                      font-size: 10px;
                    }
                    ::-moz-placeholder {
                      color: #999;
                      font-size: 10px;
                    }
                    :-ms-input-placeholder {
                      color: #999;
                      font-size: 10px;
                    }
               </style>
            ';
        // 	    }
    }
    
    function checkavailable_phone(){
        $phone = trim($this->input->post('phone'));
        $subsql = "";
        if($phone != ''){
            $subsql .= " AND input_4 = '".$phone."'";
        }
        $sql = "SELECT * FROM ".DB_PRE()."form_list WHERE form_type = 'applyformforvolunteers' ".$subsql." ORDER BY form_id DESC";
        $recordinfo = $this->db->query($sql)->row_array();
        if(!empty($recordinfo)){
            $rearr = array('form_id'=>$recordinfo['form_id']);
            $rearr['name'] = $recordinfo['input_1'];
            $rearr['gender'] = $recordinfo['select_id_1'];
            $rearr['age'] = $recordinfo['select_id_2'];
            $rearr['language_spoken'] = $recordinfo['select_id_4'];
            $rearr['area_id'] = $recordinfo['select_id_23'];
            $rearr['area_name'] = $recordinfo['input_5'];
            $rearr['email'] = $recordinfo['input_6'];
            $rearr['emergency_name'] = $recordinfo['input_7'];
            $rearr['emergency_contact'] = $recordinfo['input_8'];
            $rearr['emergency_relationship'] = $recordinfo['input_9'];
        }else{
            $rearr = array('form_id'=>0);
        }
        echo json_encode($rearr);
    }
    //旋转一个图片-- 顺时针旋转90度
    function xuanzhuanpicture(){
        $this->load->library('App');
        $filename = $this->input->post('filename', TRUE);
        
        check_SQLinjection($filename);//防止sql注入，防止js注入
        
        if(file_exists($filename)) {
            $this->app->xuanzhuanpicture($filename);
        }
        
        $filename_arr = explode('.', $filename);
        $file_type = end($filename_arr);
        
        $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
        if(file_exists($filename_100x100)) {
            $this->app->xuanzhuanpicture($filename_100x100);
        }
        
        $filename_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $filename);
        if(file_exists($filename_200x200)) {
            $this->app->xuanzhuanpicture($filename_200x200);
        }
        
        $filename_400x400 = str_replace('.'.$file_type, '_400x400.'.$file_type, $filename);
        if(file_exists($filename_400x400)) {
            $this->app->xuanzhuanpicture($filename_400x400);
        }
        
        $filename_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $filename);
        if(file_exists($filename_800x800)) {
            $this->app->xuanzhuanpicture($filename_800x800);
        }
    }
    function deletelinshifile(){
        $filename = $this->input->post('filename', TRUE);
        
        check_SQLinjection($filename);//防止sql注入，防止js注入
        
        if(file_exists($filename)) {
            @unlink($filename);
        }
        
        $filename_arr = explode('.', $filename);
        $file_type = end($filename_arr);
        
        $filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
        if(file_exists($filename_100x100)) {
            @unlink($filename_100x100);
        }
        
        $filename_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $filename);
        if(file_exists($filename_200x200)) {
            @unlink($filename_200x200);
        }
        
        $filename_400x400 = str_replace('.'.$file_type, '_400x400.'.$file_type, $filename);
        if(file_exists($filename_400x400)) {
            @unlink($filename_400x400);
        }
        
        $filename_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $filename);
        if(file_exists($filename_800x800)) {
            @unlink($filename_800x800);
        }
    }
    //更新家访表最后填写时间
    function update_homevisit_lastfillin(){
        $form_type = 'enrolmentform';
        $sql = "
            SELECT a.*
            FROM ".DB_PRE()."form_list AS a
            WHERE a.form_type = '".$form_type."' AND a.status = 1 AND a.is_assigned = 1
            ORDER BY a.form_id DESC
        ";
        $caselist = $this->db->query($sql)->result_array();
        if(!empty($caselist)){
            for ($i = 0; $i < count($caselist); $i++) {
                $sql = "
                    SELECT a.*
                    FROM ".DB_PRE()."form_list AS a
                    WHERE a.form_type IN ('homevisit_1st', 'homevisit_followupvisit') AND a.enrolmentform_id = ".$caselist[$i]['form_id']."
                    ORDER BY a.form_id DESC LIMIT 0, 1
                ";
                $res = $this->db->query($sql)->row_array();
                if(!empty($res)){
                    $this->db->update(DB_PRE().'form_list', array('last_fillin_time'=>$res['created']), array('form_id'=>$caselist[$i]['form_id']));
                }
            }
        }
    }
    
    function toaction_last_fillin_reopen($case_id, $last_fillin_reopen){
        $this->db->update(DB_PRE().'form_list', array('last_fillin_reopen'=>$last_fillin_reopen), array('form_id'=>$case_id));
    }


}