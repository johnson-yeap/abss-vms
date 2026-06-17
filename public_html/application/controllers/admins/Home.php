<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller{

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
	
	//删除无效的文件 -- 指定日期
	function delete_invalid_file_targetday($section = 'rizhi_jianli', $date_year = '2020', $date_month = '11', $date_day = ''){
	    $this->UserModel->delete_invalid_file($section, $date_year, $date_month, $date_day);//删除无效的文件
	}
	
	//提醒列表
	function index(){
		$this->load->view('admin/home');
	}
	function leftmenu(){
	    $this->load->view('admin/home_leftmenu');
	}
	function main(){
	    // 	    $this->load->view('admin/home_main');
	    
// 	    $this->session->set_userdata('menu','news');
// 	    $row = $this->input->get('row', TRUE);
// 	    if($row==""){$row=0;}
// 	    $page = 50;
// 	    $data['row']=$row;
// 	    $data['page']=$page;
	    
// 	    $keyword = $this->input->get('keyword', TRUE);
// 	    $category_id = $this->input->get('category_id', TRUE);
	    
// 	    check_NUMBERinjection($row);//数字类型
// 	    check_SQLinjection($keyword);//防止sql注入，防止js注入
	    
// 	    $con = array('orderby'=>'a.news_date_time', 'orderby_res'=>'DESC', 'row'=>$row, 'page'=>$data['page']);
// 	    if($keyword!=""){
// 	        $con['keyword'] = $keyword;
// 	    }
// 	    if($category_id!=""){
// 	        $con['category_id'] = $category_id;
// 	    }
// 	    $data['newslist'] = $this->NewsModel->getnewslist($con);
// 	    $data['count'] = $this->NewsModel->getnewslist($con, 1);
// 	    $url = base_url().'admins/news/index?category_id='.$category_id.'&keyword='.$keyword;
// 	    $data['fy'] = fy_backend($data['count'], $row, $url, $data['page'], 5, 2);
	    
// 	    $this->load->view('admin/news_list',$data);

	    
	    
	    
	    $this->session->set_userdata('menu','cms');
	    $row = $this->input->get('row', TRUE);
	    if($row==""){$row=0;}
	    $page = 50;
	    $data['row']=$row;
	    $data['page']=$page;
	    
	    $is_excel = $this->input->get('is_excel', TRUE);
	    $keyword = $this->input->get('keyword', TRUE);
	    $group_id = 1;
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
	function page_loading(){
	    //跳转到列表页面
	    $redirecturl = $this->input->get('redirecturl', TRUE);
	    if($redirecturl != ""){
	        $redirecturl = str_replace('slash_tag','/',$redirecturl);
	        if(base64_decode($redirecturl) != ""){
	            $decoderedirecturl = base64_decode(str_replace(" ", "+", $redirecturl));
	        }else{
	            $decoderedirecturl = '';
	        }
	    }else{
	        $decoderedirecturl = '';
	    }
	    if($decoderedirecturl != ''){
	        $data['redirecturl'] = $decoderedirecturl;
	        $this->load->view('admin/page_loading', $data);
	    }
	}
	function changelanguage($lan) {
	    $this->session->set_userdata('adminlang', $lan);
	    redirect(base_url().'admins/home');
	}
	
	
	/* 上传图片
	 * */
	function upfile(){
	    $pic = $_FILES ['logo'];
	    $picname = explode ( '.', $pic ['name'] );
	    $pic ['name'] = mktime ().rand(0,1000) . '.' . $picname [count ( $picname ) - 1];
	    
	    $uploaddir = "upload/";
	    if (! is_dir ( $uploaddir )) {
	        mkdir ( $uploaddir, 0755 );
	    }
	    $path = $uploaddir . $pic ['name'];
	    if (file_exists ( $path )) {
	        $path = 'upload/'.'(new)'.$pic ['name'];
	    }
	    move_uploaded_file ( $pic ['tmp_name'], $path );
	    //添加到临时文件表中
	    $this->WelModel->add_file_interim(array('file_path'=>$path,'created'=>time()));
	    
	    $jsonarr = array('name'=>$pic ['name'],'logo'=>$path);
	    $jsonarr = json_encode($jsonarr);
	    echo $jsonarr;
	}
	
	/* 上传图片
	 * */
	function uplogo($default_width = 0,$default_height = 0){
	    $this->load->library ( 'app' );
	    $pic = $_FILES ['logo'];
	    $picname = explode ( '.', $pic ['name'] );
	    $pic ['name'] = mktime ().rand(0,1000) . '.' . $picname [count ( $picname ) - 1];
	    
	    $uploaddir = "upload/";
	    if (! is_dir ( $uploaddir )) {
	        mkdir ( $uploaddir, 0755 );
	    }
	    $path = $uploaddir . $pic ['name'];
	    if (file_exists ( $path )) {
	        $path = 'upload/'.'(new)'.$pic ['name'];
	    }
	    move_uploaded_file ( $pic ['tmp_name'], $path );
	    if($default_width>0&&$default_height>0){
	        $img_width=getImgWidth($path);/*获取宽度*/
	        $img_height=getImgHeight($path);/*获取高度*/
	        if($img_width==$default_width&&$img_height==$default_height){
	            //				如果上传的图片大小和给定的图片尺寸大小一致则不操作
	        }else{
	            $this->app->my_image_resize($path, $path, $default_width, $default_height );
	        }
	    }
	    //添加到临时文件表中
	    $this->WelModel->add_file_interim(array('file_path'=>$path,'created'=>time()));
	    
	    $jsonarr = array('name'=>$pic ['name'],'logo'=>$path);
	    $jsonarr = json_encode($jsonarr);
	    echo $jsonarr;
	}

	
	function getcitylist($provinceID = 0){
	    $con = array('isdel'=>0, 'provinceID'=>$provinceID, 'orderby'=>'city_name_en', 'orderby_res'=>'ASC');
	    $city = $this->UserModel->getcitylist($con);
	    $citystr = '';
	    if (! empty ( $city )) {
	        for($i = 0; $i < count ( $city ); $i ++) {
	            $citystr .= '<option value="' . $city [$i] ['cityID'] . '">' . $city[$i]['city_name'.$this->langtype] . '</option>';
	        }
	    }
	    echo $citystr;
	}
	
	function getarealist($cityID = 0) {
	    $con = array('isdel'=>0, 'cityID'=>$cityID, 'orderby'=>'area_name_en', 'orderby_res'=>'ASC');
	    $area = $this->UserModel->getarealist($con);
	    $areastr = '';
	    if (! empty ( $area )) {
	        for($i = 0; $i < count ( $area ); $i ++) {
	            $areastr .= '<option value="'.$area[$i]['areaID'].'">'.$area[$i]['area_name'.$this->langtype].'</option>';
	        }
	    }
	    echo $areastr;
	}
	
	//下载图片
	function downloadpng(){
	    $path = $this->input->get('path', TRUE);
	    $filename = base_url().$path;
	    
	    header('Content-type: image/png');
	    header('Content-Disposition: attachment; filename="qrcode.png"');
	    readfile($filename);
	    // 		header("Location:".$filename);
	}
	
	/*
	 * 选择日历 -- 普通日历
	 */
	function calendar_select_date_normal($year = 0, $month = 0) {
	    if($year == 0 && $month == 0){
	        $year = date('Y');
	        $month = date('m');
	    }
	    
	    $select_date = $this->input->post('select_date', TRUE);
	    
	    check_SQLinjection($year);//防止sql注入，防止js注入
	    check_SQLinjection($month);//防止sql注入，防止js注入
	    check_SQLinjection($select_date);//防止sql注入，防止js注入
	    
	    $id = 'date3';
	    
	    $prefs = array ('show_next_prev' => TRUE,'day_type' => 'lshort' )
	    // 'next_prev_url' => 'javascript:;'
	    ;
	    
	    $str_year = '<div style="float:left;width:165px;margin-left:calc(50% - 83px);">';
	    
	    $str_year .= '<select name="calendar_show_year" onchange="tochangecalendar_yearmonth()" style="float:left;background: url('.base_url().'themes/default/images/select_arrow.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:75px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:3px 0px 3px 10px;border-radius:6px;">';
	    for($i = (date('Y') + 1); $i >= 1970; $i--){
	        if($year == $i){
	            $isselected = 'selected';
	        }else{
	            $isselected = '';
	        }
	        $str_year .= '<option value="'.$i.'" '.$isselected.'>'.$i.'</option>';
	    }
	    $str_year .= '</select>';
	    
	    
	    $str_year .= '<div style="float:left;margin:10px 10px;"> - </div>';
	    $str_year .= '<select name="calendar_show_month" onchange="tochangecalendar_yearmonth()" style="float:left;background: url('.base_url().'themes/default/images/select_arrow.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width:60px;margin:0px 0px 0px 0px;font-size:14px;line-height:20px;padding:3px 0px 3px 10px;border-radius:6px;">';
	    for($i = 1; $i <= 12; $i++){
	        if($i < 10){
	            $j = '0'.$i;
	        }else{
	            $j = $i;
	        }
	        if($month == $j){
	            $isselected = 'selected';
	        }else{
	            $isselected = '';
	        }
	        $str_year .= '<option value="'.$j.'" '.$isselected.'>'.$j.'</option>';
	    }
	    $str_year .= '</select>';
	    
	    $str_year .= '</div>';
	    
	    
	    $prefs ['template'] = '
	        
		   {table_open}<table border="0" cellpadding="0" cellspacing="0" style="float:left;width:100%;padding:0px;border:0px solid #CCC;text-align:center;-moz-border-radius: 5px;-webkit-border-radius: 5px;background:transparent;">{/table_open}
	        
	        
		   {heading_row_start}<tr style="background-color:transparent;">{/heading_row_start}
		   {heading_previous_cell}<th height="50" colspan="1" style="padding:0px;-moz-border-top-left-radius: 4px;-webkit-border-top-left-radius: 4px;"><a href="javascript:;" onclick="togetshiwucalendar_month(\''.$id.'\', {previous_url})"><span id="triangle-facing-left"></span><span id="triangle-facing-left-line"></span></a></th>{/heading_previous_cell}
		   {heading_title_cell}<th colspan="5" style="font-size:14px;padding:0px;text-transform:uppercase;">'.$str_year.'</th>{/heading_title_cell}
		   {heading_next_cell}<th colspan="1" style="padding:0px;-moz-border-top-right-radius: 4px;-webkit-border-top-right-radius: 4px;"><a href="javascript:;" onclick="togetshiwucalendar_month(\''. $id.'\', {next_url})"><span id="triangle-facing-right-line"></span><span id="triangle-facing-right"></span></a></th>{/heading_next_cell}
		   {heading_row_end}</tr>{/heading_row_end}
		       
		       
		   {week_row_start}<tr>{/week_row_start}
		   {week_day_cell}<td height="25" style="color:black;border-bottom:0px solid transparent;padding:0px;">{week_day}</td>{/week_day_cell}
		   {week_row_end}</tr>{/week_row_end}
		       
		       
		   {cal_row_start}<tr>{/cal_row_start}
		   {cal_cell_start}<td style="width:' . ((1 / 7) * 100) . '%;padding:0px;"><div style="float:left;text-align:center;width:calc(100% - 2px);height:40px;line-height:40px;margin-left:1px;margin-right:1px;margin-top:2px;">{/cal_cell_start}
		       
		   {cal_cell_content}<a href="{content}" id="shiwu_{day_id}" onclick="togetrilidatatoinput(\'' . $id . '\',{showthings})"><font style="float:left;width:100%;height:40px;line-height:40px;text-align:center;background:#f7d9d9;color:red;font-weight:bold;-moz-border-radius: 3px;-webkit-border-radius: 3px;">{day}</font></a>{/cal_cell_content}
		   {cal_cell_content_today}<a href="{content}" id="shiwu_{day_id}" onclick="togetrilidatatoinput(\'' . $id . '\',{showthings})"><font style="float:left;width:100%;height:40px;line-height:40px;text-align:center;background:#f7d9d9;color:red;font-weight:bold;-moz-border-radius: 3px;-webkit-border-radius: 3px;">{day}</font></a>{/cal_cell_content_today}
		       
		   {cal_cell_no_content}<a href="javascript:;" id="shiwu_{day_id}" onclick="togetrilidatatoinput(\'' . $id . '\',{showthings})"><font style="float:left;width:100%;height:40px;line-height:40px;text-align:center;background:#ffffff;color:#000000;font-weight:bold;-moz-border-radius: 3px;-webkit-border-radius: 3px;">{day}</font></a>{/cal_cell_no_content}
		   {cal_cell_no_content_today}<a href="javascript:;" id="shiwu_{day_id}" onclick="togetrilidatatoinput(\'' . $id . '\',{showthings})"><font style="float:left;width:100%;height:40px;line-height:40px;text-align:center;background:#ffffff;color:#000000;font-weight:bold;-moz-border-radius: 3px;-webkit-border-radius: 3px;">{day}</font></a>{/cal_cell_no_content_today}
		       
		   {cal_cell_blank}&nbsp;{/cal_cell_blank}
		       
		   {cal_cell_end}</div></td>{/cal_cell_end}
		   {cal_row_end}</tr>{/cal_row_end}
		       
		   {table_close}</table>{/table_close}
		';
	    
	    $this->load->library ( 'calendar', $prefs );
	    
	    $data = array ();
	    
	    //获取 Active plan -- 开始
	    // 		for($i = 1; $i <= 31; $i++){
	    // 			if($i < 10){
	    // 				$j = '0'.$i;
	    // 			}else{
	    // 				$j = $i;
	    // 			}
	    // 			$data[intval($j)] = 'javascript:;';
	    // 		}
	    
	    if($select_date != ''){
	        $select_date_split = explode('-', $select_date);
	        if(!empty($select_date_split)){
	            $data[intval($select_date_split[2])] = 'javascript:;';
	        }
	    }
	    //获取 Active plan -- 结束
	    
	    
	    if ($year == 0 && $month == 0) {
	        echo $this->calendar->generate ($this->langtype, $year, $month, $data);
	    } else {
	        echo $this->calendar->generate ($this->langtype, $year, $month, $data);
	    }
	}
	
	
	
	
}