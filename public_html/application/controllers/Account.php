<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    
    //检查手机号码是否已经被注册
    function checkemailisexists(){
        $email = $this->input->post('email', true);
        check_SQLinjection($email);//防止sql注入
        
        echo $this->WelModel->checkemailisexists($email);
    }
    
    //检查手邮箱账号
    function checkemailisexists_returnaccount(){
        $lang = $this->session->userdata('lang');
        if($lang == 'ch'){$this->session->set_userdata('lang', 'ch');$this->langtype = '_ch';$this->lang->load('gksel', 'chinese');}else if($lang == 'jp'){$this->session->set_userdata('lang', 'jp');$this->langtype = '_jp';$this->lang->load('gksel', 'japanese');}else if($lang == 'sk'){$this->session->set_userdata('lang', 'sk');$this->langtype = '_sk';$this->lang->load('gksel', 'korean');}else if($lang == 'ru'){$this->session->set_userdata('lang', 'ru');$this->langtype = '_ru';$this->lang->load('gksel', 'russian');}else{$this->session->set_userdata('lang', 'en');$this->langtype = '_en';$this->lang->load('gksel', 'english');}
        if($lang == 'ch'){$this->reland = 'cn';}else if($lang == '_jp'){$this->reland = 'jp';}else if($lang == '_sk'){$this->reland = 'sk';}else if($lang == '_ru'){$this->reland = 'ru';}else{$this->reland = 'en';}
        
        $email = $this->input->post('email', true);
        check_SQLinjection($email);//防止sql注入
        
        $sql = "
			SELECT *
			FROM ".DB_PRE()."user_list
			WHERE (user_email = '".$email."')
		";
        $userPhoneResult = $this->db->query($sql)->row_array();
        if(!empty($userPhoneResult)){
            $this->EmailModel->send_forget_email($userPhoneResult['uid'], $this->langtype);
            echo json_encode(array('uid'=>$userPhoneResult['uid'], 'randkey'=>$userPhoneResult['user_randkey']));
        }else{
            echo json_encode(array('uid'=>0, 'randkey'=>''));
        }
    }
    
    //登录页面----处理方法
    function login(){
        $lang = $this->session->userdata('lang');
        if($lang == 'ch'){$this->session->set_userdata('lang', 'ch');$this->langtype = '_ch';$this->lang->load('gksel', 'chinese');}else if($lang == 'jp'){$this->session->set_userdata('lang', 'jp');$this->langtype = '_jp';$this->lang->load('gksel', 'japanese');}else if($lang == 'sk'){$this->session->set_userdata('lang', 'sk');$this->langtype = '_sk';$this->lang->load('gksel', 'korean');}else if($lang == 'ru'){$this->session->set_userdata('lang', 'ru');$this->langtype = '_ru';$this->lang->load('gksel', 'russian');}else{$this->session->set_userdata('lang', 'en');$this->langtype = '_en';$this->lang->load('gksel', 'english');}
        if($lang == 'ch'){$this->reland = 'cn';}else if($lang == '_jp'){$this->reland = 'jp';}else if($lang == '_sk'){$this->reland = 'sk';}else if($lang == '_ru'){$this->reland = 'ru';}else{$this->reland = 'en';}
        
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
        
        check_SQLinjection($email);//防止sql注入
		check_SQLinjection($password);//防止sql注入
        
		$result = $this->WelModel->checkUser_login($email, md5($password));
        if(!empty($result)){
            if($result['status'] == 1 && $result['is_active'] == 1){
                // 正常返回数据(json)
                $arr=array('uid'=>$result['uid'], 'email'=>$email, 'firstname'=>$result['user_firstname'], 'lastname'=>$result['user_lastname']);
                $arr=serialize($arr);
                $this->input->set_cookie(DB_PRE().'userinfo', $arr, time()+60*60*10);//设置登录的session
                
                $decodebackurl = base_url().$this->reland.'/home';
                echo json_encode(array('status'=>'yes', 'backurl'=>$decodebackurl));
            }else{
                if($result['is_active'] == 0){
                    echo json_encode(array('status'=>'notactive'));
                }else{
                    echo json_encode(array('status'=>'offline'));
                }
            }
        }else{
            echo json_encode(array('status'=>'no'));
        }
    }
    
    //注册页面 ----处理方法
    function register(){
        $lang = $this->session->userdata('lang');
        if($lang == 'ch'){$this->session->set_userdata('lang', 'ch');$this->langtype = '_ch';$this->lang->load('gksel', 'chinese');}else if($lang == 'jp'){$this->session->set_userdata('lang', 'jp');$this->langtype = '_jp';$this->lang->load('gksel', 'japanese');}else if($lang == 'sk'){$this->session->set_userdata('lang', 'sk');$this->langtype = '_sk';$this->lang->load('gksel', 'korean');}else if($lang == 'ru'){$this->session->set_userdata('lang', 'ru');$this->langtype = '_ru';$this->lang->load('gksel', 'russian');}else{$this->session->set_userdata('lang', 'en');$this->langtype = '_en';$this->lang->load('gksel', 'english');}
        if($lang == 'ch'){$this->reland = 'cn';}else if($lang == '_jp'){$this->reland = 'jp';}else if($lang == '_sk'){$this->reland = 'sk';}else if($lang == '_ru'){$this->reland = 'ru';}else{$this->reland = 'en';}
        
        if(isset($_COOKIE['code_register'])){
            $code_register = unserialize($_COOKIE['code_register']);
            $code_register = $code_register['sms_code'];
        }else{
            $code_register = '';
        }

        $user_firstname = $this->input->post('user_firstname', true);
        $user_lastname = $this->input->post('user_lastname', true);
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);
//         $sms_code = $this->input->post('sms_code', true);
        
        check_SQLinjection($user_firstname);//防止sql注入
        check_SQLinjection($user_lastname);//防止sql注入
		check_SQLinjection($email);//防止sql注入
		check_SQLinjection($password);//防止sql注入
// 		check_SQLinjection($sms_code);//防止sql注入
        
//         if($code_register == $sms_code){
		    $con = array('is_active'=>0, 'user_firstname'=>$user_firstname, 'user_lastname'=>$user_lastname, 'user_email'=>$email, 'password'=>md5($password), 'status'=>1, 'created'=>time(), 'edited'=>time());
            $con['user_randkey'] = randkey(32);
            $uid = $this->UserModel->add_user($con);
            
            $this->EmailModel->sendemail_register($uid, $this->langtype);
            
            echo $uid;
//         }else{
//             echo 'codeerror';
//         }
    }
    
    function toactive_account($uid = 0, $user_randkey = ''){
        $userinfo = $this->UserModel->getuserinfo($uid);
        if(!empty($userinfo)){
            if($userinfo['user_randkey'] == $user_randkey){
                // 正常返回数据(json)
                $arr = array('uid'=>$uid, 'email'=>$userinfo['user_email'], 'firstname'=>$userinfo['user_firstname'], 'lastname'=>$userinfo['user_lastname']);
                $arr = serialize($arr);
                $this->input->set_cookie(DB_PRE().'userinfo', $arr, time() + 60*60*10);//设置登录的session
                
                $lang = $this->session->userdata('lang');
                if($lang == 'ch'){$this->langtype = '_ch';$this->reland = 'cn';}else if($lang == 'jp'){$this->langtype = '_jp';$this->reland = 'jp';}else if($lang == 'sk'){$this->langtype = '_sk';$this->reland = 'sk';}else if($lang == 'ru'){$this->langtype = '_ru';$this->reland = 'ru';}else{$this->langtype = '_en';$this->reland = 'en';}
                
                $this->UserModel->edit_user($uid, array('is_active'=>1, 'user_randkey'=>randkey(32)));
                
                redirect(base_url().$this->reland.'/register-success');
            }else{
                echo 'Link has expired';
            }
        }
    }
    
    function toresetpassword($uid = 0, $user_randkey = ''){
        $userinfo = $this->UserModel->getuserinfo($uid);
        if(!empty($userinfo)){
            if($userinfo['user_randkey'] == $user_randkey){
                
                $con = array('group_id_IN'=>'124', 'parent'=>0, 'status'=>1, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
                $cmslist = $this->CmsModel->getcmslist($con);
                
                $this->common_phone_name_en = '';
                $this->common_phone_name_ch = '';
                $this->common_phone_name_jp = '';
                $this->common_phone_name_sk = '';
                $this->common_phone_name_ru = '';
                
                $this->common_phone_value_en = '';
                $this->common_phone_value_ch = '';
                $this->common_phone_value_jp = '';
                $this->common_phone_value_sk = '';
                $this->common_phone_value_ru = '';
                
                $this->common_email_name_en = '';
                $this->common_email_name_ch = '';
                $this->common_email_name_jp = '';
                $this->common_email_name_sk = '';
                $this->common_email_name_ru = '';
                
                $this->common_email_value_en = '';
                $this->common_email_value_ch = '';
                $this->common_email_value_jp = '';
                $this->common_email_value_sk = '';
                $this->common_email_value_ru = '';
                
                if(isset($cmslist)){
                    for ($i = 0; $i < count($cmslist); $i++) {
                        if($cmslist[$i]['cms_id'] == 1987){
                            $this->common_phone_name_en = strip_tags($cmslist[$i]['cms_name_en']);
                            $this->common_phone_name_ch = strip_tags($cmslist[$i]['cms_name_ch']);
                            $this->common_phone_name_jp = strip_tags($cmslist[$i]['cms_name_jp']);
                            $this->common_phone_name_sk = strip_tags($cmslist[$i]['cms_name_sk']);
                            $this->common_phone_name_ru = strip_tags($cmslist[$i]['cms_name_ru']);
                            
                            $this->common_phone_value_en = strip_tags($cmslist[$i]['cms_description_en']);
                            $this->common_phone_value_ch = strip_tags($cmslist[$i]['cms_description_ch']);
                            $this->common_phone_value_jp = strip_tags($cmslist[$i]['cms_description_jp']);
                            $this->common_phone_value_sk = strip_tags($cmslist[$i]['cms_description_sk']);
                            $this->common_phone_value_ru = strip_tags($cmslist[$i]['cms_description_ru']);
                        }
                        if($cmslist[$i]['cms_id'] == 1988){
                            $this->common_email_name_en = strip_tags($cmslist[$i]['cms_name_en']);
                            $this->common_email_name_ch = strip_tags($cmslist[$i]['cms_name_ch']);
                            $this->common_email_name_jp = strip_tags($cmslist[$i]['cms_name_jp']);
                            $this->common_email_name_sk = strip_tags($cmslist[$i]['cms_name_sk']);
                            $this->common_email_name_ru = strip_tags($cmslist[$i]['cms_name_ru']);
                            
                            $this->common_email_value_en = strip_tags($cmslist[$i]['cms_description_en']);
                            $this->common_email_value_ch = strip_tags($cmslist[$i]['cms_description_ch']);
                            $this->common_email_value_jp = strip_tags($cmslist[$i]['cms_description_jp']);
                            $this->common_email_value_sk = strip_tags($cmslist[$i]['cms_description_sk']);
                            $this->common_email_value_ru = strip_tags($cmslist[$i]['cms_description_ru']);
                        }
                    }
                }
                
                
                
                $lang = $this->session->userdata('lang');
                if($lang == 'ch'){$this->langtype = '_ch';$this->reland = 'cn';}else if($lang == 'jp'){$this->langtype = '_jp';$this->reland = 'jp';}else if($lang == 'sk'){$this->langtype = '_sk';$this->reland = 'sk';}else if($lang == 'ru'){$this->langtype = '_ru';$this->reland = 'ru';}else{$this->langtype = '_en';$this->reland = 'en';}
                
                $this->session->set_userdata('menu', 'forgetpassword');
                $this->session->set_userdata('submenu', 'forgetpassword');
                
                $data['cmsinfo'] = $this->CmsModel->getcmsinfo(66);
                
                $data['uid'] = $uid;
                $data['user_randkey'] = $user_randkey;
                
                $this->load->view('forgetpassword_setnewpassword', $data);
            }else{
                echo 'Link has expired';
            }
        }
    }
    
    //登录页面----处理方法
    function setnewpassword($uid, $user_randkey){
        $lang = $this->session->userdata('lang');
        if($lang == 'ch'){$this->session->set_userdata('lang', 'ch');$this->langtype = '_ch';$this->lang->load('gksel', 'chinese');}else if($lang == 'jp'){$this->session->set_userdata('lang', 'jp');$this->langtype = '_jp';$this->lang->load('gksel', 'japanese');}else if($lang == 'sk'){$this->session->set_userdata('lang', 'sk');$this->langtype = '_sk';$this->lang->load('gksel', 'korean');}else if($lang == 'ru'){$this->session->set_userdata('lang', 'ru');$this->langtype = '_ru';$this->lang->load('gksel', 'russian');}else{$this->session->set_userdata('lang', 'en');$this->langtype = '_en';$this->lang->load('gksel', 'english');}
        if($lang == 'ch'){$this->reland = 'cn';}else if($lang == '_jp'){$this->reland = 'jp';}else if($lang == '_sk'){$this->reland = 'sk';}else if($lang == '_ru'){$this->reland = 'ru';}else{$this->reland = 'en';}
        
        $password = $this->input->post('password', true);
        
        check_SQLinjection($password);//防止sql注入
        
        $result = $this->UserModel->getuserinfo($uid);
        
        if(!empty($result)){
            $this->UserModel->edit_user($uid, array('password'=>md5($password), 'user_randkey'=>randkey(8)));
            // 正常返回数据(json)
            $arr = array('uid'=>$result['uid'], 'email'=>$email, 'firstname'=>$result['user_firstname'], 'lastname'=>$result['user_lastname']);
            $arr = serialize($arr);
            $this->input->set_cookie(DB_PRE().'userinfo', $arr, time()+60*60*10);//设置登录的session
            
            $decodebackurl = base_url().$this->reland.'/home';
            echo json_encode(array('status'=>'yes', 'backurl'=>$decodebackurl));
        }else{
            echo json_encode(array('status'=>'no'));
        }
    }
    
    function tologout(){
        $this->load->helper('cookie');
        
        $lang = $this->session->userdata('lang');
        if($lang == 'ch'){$this->session->set_userdata('lang', 'ch');$this->langtype = '_ch';$this->lang->load('gksel', 'chinese');}else if($lang == 'jp'){$this->session->set_userdata('lang', 'jp');$this->langtype = '_jp';$this->lang->load('gksel', 'japanese');}else if($lang == 'sk'){$this->session->set_userdata('lang', 'sk');$this->langtype = '_sk';$this->lang->load('gksel', 'korean');}else if($lang == 'ru'){$this->session->set_userdata('lang', 'ru');$this->langtype = '_ru';$this->lang->load('gksel', 'russian');}else{$this->session->set_userdata('lang', 'en');$this->langtype = '_en';$this->lang->load('gksel', 'english');}
        if($lang == 'ch'){$this->reland = 'cn';}else if($lang == '_jp'){$this->reland = 'jp';}else if($lang == '_sk'){$this->reland = 'sk';}else if($lang == '_ru'){$this->reland = 'ru';}else{$this->reland = 'en';}
        
        delete_cookie(DB_PRE().'userinfo');
        redirect(base_url().''.$this->reland.'/home');
    }


}