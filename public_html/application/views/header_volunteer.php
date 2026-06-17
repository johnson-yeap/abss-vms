<?php 
    header("X-XSS-Protection: 1");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");//(1) DENY 表示该页面不允许在 frame 中展示，即便是在相同域名的页面中嵌套也不允许。SAMEORIGIN 表示该页面可以在相同域名页面的 frame 中展示。ALLOW-FROM uri 表示该页面可以在指定来源的 frame 中展示。
    header("Referrer-Policy: same-origin");
    header("X-Permitted-Cross-Domain-Policies: same-origin");
    header("X-Download-Options: same-origin");
    header("content-language: en");
// 	header("Cache-Control: max-age=86400");
	header("Content-type: text/html; charset=utf-8");
	header("Server: close");
	header("Technology: close");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?php if(isset($website_title)){echo $website_title;}?></title>
<meta name="keywords" content="<?php if(isset($website_keyword)){echo $website_keyword;}?>" />
<meta name="description" content="<?php if(isset($website_description)){echo $website_description;}?>" />
<meta name="author" content="" />
<meta name="Technology" content="" />
<meta name="Server" content="" />
<meta name="apple-mobile-web-app-capable" content="yes"/>
<meta name="format-detection" content="telephone=no" />
<script language="JavaScript" type="text/javascript">
	var baseurl = '<?php echo base_url()?>';
	var currenturl = '<?php echo current_url()?>';
	var cdnurl = "<?php echo CDN_URL()?>";
</script>
<script type="text/javascript" src="<?php echo CDN_URL().'themes/default/js/admin/jquery-1.7.2.min.js?date='.CACHE_USETIME()?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input/dist/magic-input.min.css">
<?php if(isset($private_js)){echo '<script type="text/javascript" src="'.CDN_URL().'themes/default/js/base_'.$private_js.'.js?date='.CACHE_USETIME().'"></script>';}?>
<script src="<?php echo CDN_URL().'themes/default/js/base_common.js?date='.CACHE_USETIME()?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo CDN_URL().'themes/default/base.css?date='.CACHE_USETIME()?>" />
<?php if(isset($private_css)){echo '<link rel="stylesheet" type="text/css" href="'.CDN_URL().'themes/default/base_'.$private_css.'.css?date='.CACHE_USETIME().'" />';}?>
<link rel="stylesheet" type="text/css" href="<?php echo CDN_URL().'themes/default/animate.min.css?date='.CACHE_USETIME()?>" />
<link rel="shortcut icon" href="<?php echo CDN_URL().'themes/default/images/favicon.png?date='.CACHE_USETIME()?>" type="image/x-icon" />
</head>
<body>
<noscript>您的浏览器不支持 JavaScript!</noscript>
<?php 
$get_str='';
if($_GET){
	$arr = geturlparmersGETS();
	for($i=0;$i<count($arr);$i++){
		if(isset($_GET[$arr[$i]])){
			if($get_str!=""){$get_str .='&';}else{$get_str .='?';}
			$get_str .=$arr[$i].'='.$_GET[$arr[$i]];
		}
	}
}
$current_url = current_url().$get_str;
$current_url_encode = str_replace('/','slash_tag',base64_encode(current_url().$get_str));
?>
<div style="position:fixed;float:left;width:100%;height:60px;background:#DF9C4D;z-index:10;">
	<div style="cursor:pointer;float:left;width:50px;height:50px;margin-top:5px;margin-left:5px;background: url(<?php echo base_url().'themes/default/images/logo_1.png'?>) center center / cover no-repeat;border-radius:50%;"></div>
	
    <?php 
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
    ?>
    <?php if($this->volunteer_id != 0){?>
    	<?php 
    	   $recordinfo = $this->WelModel->getrecordinfo($this->volunteer_id);//获取记录详细
    	?>
    	<div style="cursor:pointer;float:left;height:50px;line-height:50px;margin-top:5px;margin-left:10px;color:white;">
    		<?php if($this->langtype == '_ch'){echo '欢迎, ';}else{echo 'Welcome, ';}?><?php echo $recordinfo['input_1']?>
    		<?php 
    		if($recordinfo['select_id_6'] == 1){
    		    if($this->langtype == '_ch'){$role_name = '关怀义工';}else{$role_name = 'Caring Volunteer';}
    		}else if($recordinfo['select_id_6'] == 2){
    		    if($this->langtype == '_ch'){$role_name = '关怀司机';}else{$role_name = 'Caring Driver';}
    		}else if($recordinfo['select_id_6'] == 3){
    		    if($this->langtype == '_ch'){$role_name = '司机和关怀义工';}else{$role_name = 'Caring Volunteer and Driver';}
    		}else{
    		    $role_name = '';
    		}
    		?>
    		【<?php echo $role_name;?>】
    		, <a href="<?php echo base_url().'volunteer/logout'?>"><?php if($this->langtype == '_ch'){echo '退出';}else{echo 'Logout';}?></a>
    	</div>
    <?php }?>
	
	<div style="float:right;width:40px;height:40px;line-height:40px;text-align:center;font-size:14px;margin-top:10px;margin-right:5px;background:white;border-radius:50%;">
		<?php if($this->langtype == '_ch'){?>
			<a onclick="toloadingcontent()" href="<?php echo base_url().'welcome/changelanguage/en/'.$current_url_encode?>" style="color:#DF9C4D;">EN</a>
		<?php }else{?>
			<a onclick="toloadingcontent()" href="<?php echo base_url().'welcome/changelanguage/ch/'.$current_url_encode?>" style="color:#DF9C4D;">中文</a>
		<?php }?>
	</div>
</div>
<div style="float:left;width:100%;height:60px;">&nbsp;</div>

<script type="text/javascript">
	function togotohome(){
		toloadingcontent();
		location.href = baseurl;
	}
	function toloadingcontent(){
		$('.formtable_tabletitle, .formtable_submit, .formtable_homepage, .formtable_termsandconditions').hide();
		$('.formtable_loading').show();
	}
</script>

<style>
    /* 设置 整个日期选择器 外边框的样式 以及 年月日字体的大小 */
    input[type="date"] {
        border: 0px solid #CCC;
        border-radius: 0px;
        padding: 0px 0px;
        font-size: 14px;
    }
    input[type="date"]:hover, input[type="date"]:focus {
        border: 0px solid #CCC;
        border-radius: 0px;
    	outline: none;
    }

    /* 设置年月日的外边框为黑色边框 */
    input[type="date"]::-webkit-datetime-edit { 
        padding: 8px; 
        /* background: #000000;  */
        border: #999 solid 1px;
    	background-color: #EFEFEF;
    	border-radius:4px;
        margin-right: 10px;

        /* 设置 年月日 的大小，如果这里不指定就取上面设置的18px */
        /* font-size: 20px; */
    } 

    /* 设置年月日的背景 */
    input[type="date"]::-webkit-datetime-edit-fields-wrapper { 
    	margin-left: 8px;
        background-color: #EFEFEF;
        /* padding-right: 12px; */
    } 

    /* text的padding(年月日的padding) */
    input[type="date"]::-webkit-datetime-edit-text { 
        padding: 0.3em; 
        /* 年月日分隔符“/”的颜色 */
        color: #2964d3; 
        /* direction: rtl; */
        /* unicode-bidi: bidi-override; */
    } 

    /* 年的颜色 */
    input[type="date"]::-webkit-datetime-edit-year-field {
    	background-color: #EFEFEF;
        color: purple;
    } 

    /* 月的颜色 */
    input[type="date"]::-webkit-datetime-edit-month-field {
    	background-color: #EFEFEF;
        color: blue; 
    } 

    /* 日的颜色 */
    input[type="date"]::-webkit-datetime-edit-day-field {
    	background-color: #EFEFEF;
        color: green; 
    }

    /* 隐藏按钮 
       注意，-webkit-inner-spin-button只适用于Webkit浏览器，如果要实现在其他浏览器中隐藏箭头按钮，可能需要使用其他方法或属性。
    */
    /* input[type="date"]::-webkit-inner-spin-button { 
        visibility: hidden; 
    }  */

    /* 自定义 日历选择器指示器 的样式 */
    input[type="date"]::-webkit-calendar-picker-indicator { 
        /* 设置立体感的边框 */
/*         border: 1px solid #890404; */
/*         background-color: #1d0909; */
/*         border-radius: 5px; */
/*         box-shadow: inset 0 1px #722222, 0 1px #732323; */
        
        /* 设置边框里面的颜色 */
/*         background-image: -webkit-linear-gradient(top, green, green); */

        /* 设置 日历选择器指示器 的大小，如果这里不指定就取上面设置的18px */
        font-size: 30px;
    }
    
    
    
    
    
    
    
    
    
    
    /* 设置 整个日期选择器 外边框的样式 以及 年月日字体的大小 */
    input[type="datetime-local"] {
        border: 0px solid #CCC;
        border-radius: 0px;
        padding: 0px;
        font-size: 14px;
    }
    input[type="datetime-local"]:hover, input[type="datetime-local"]:focus {
        border: 0px solid #CCC;
        border-radius: 0px;
    	outline: none;
    }

    /* 设置年月日的外边框为黑色边框 */
    input[type="datetime-local"]::-webkit-datetime-edit { 
        padding: 2px; 
        /* background: #000000;  */
        border: #999 solid 1px;
    	background-color: #EFEFEF;
    	border-radius:4px;
        margin-right: 10px;

        /* 设置 年月日 的大小，如果这里不指定就取上面设置的18px */
        /* font-size: 20px; */
    } 

    /* 设置年月日的背景 */
    input[type="datetime-local"]::-webkit-datetime-edit-fields-wrapper { 
    	margin-left: 8px;
        background-color: #EFEFEF;
        /* padding-right: 12px; */
    } 

    /* text的padding(年月日的padding) */
    input[type="datetime-local"]::-webkit-datetime-edit-text { 
        padding: 0.3em; 
        /* 年月日分隔符“/”的颜色 */
        color: #2964d3; 
        /* direction: rtl; */
        /* unicode-bidi: bidi-override; */
    } 

    /* 年的颜色 */
    input[type="datetime-local"]::-webkit-datetime-edit-year-field {
    	background-color: #EFEFEF;
        color: purple;
    } 

    /* 月的颜色 */
    input[type="datetime-local"]::-webkit-datetime-edit-month-field {
    	background-color: #EFEFEF;
        color: blue; 
    } 

    /* 日的颜色 */
    input[type="datetime-local"]::-webkit-datetime-edit-day-field {
    	background-color: #EFEFEF;
        color: green; 
    }

    /* 隐藏按钮 
       注意，-webkit-inner-spin-button只适用于Webkit浏览器，如果要实现在其他浏览器中隐藏箭头按钮，可能需要使用其他方法或属性。
    */
    /* input[type="date"]::-webkit-inner-spin-button { 
        visibility: hidden; 
    }  */

    /* 自定义 日历选择器指示器 的样式 */
    input[type="datetime-local"]::-webkit-calendar-picker-indicator { 
        /* 设置立体感的边框 */
/*         border: 1px solid #890404; */
/*         background-color: #1d0909; */
/*         border-radius: 5px; */
/*         box-shadow: inset 0 1px #722222, 0 1px #732323; */
        
        /* 设置边框里面的颜色 */
/*         background-image: -webkit-linear-gradient(top, green, green); */

        /* 设置 日历选择器指示器 的大小，如果这里不指定就取上面设置的18px */
        font-size: 30px;
    }
</style>
<style>
    @media screen and (max-width: 700px) {
        .formtable_submit .sectiontitle{line-height:35px;font-size:26px;font-weight:bold;}
        .formtable_submit .sectionsummary{line-height:24px;font-size:16px;margin-top:10px;}
        .formtable_submit .bodycontentarea{line-height:24px;font-size:16px;margin-top:10px;}
        .formtable_submit .bodycontentarea .tdleftside{width:120px;line-height:24px;font-size:16px;}
        .formtable_submit .remarkscontent{line-height:26px;font-size:16px;margin-top:10px;}
        .formtable_submit .agreecontent{line-height:26px;font-size:16px;margin-top:20px;}
        .formtable_submit .signincontent{line-height:26px;font-size:16px;margin-top:20px;}
        .formtable_submit .signincontent .left{width:140px;}
        .formtable_submit .signincontent .right{width:calc(100% - 140px);}
    	.formtable_submit .signincontent .left2{width:150px;}
        .formtable_submit .signincontent .right2{width:calc(100% - 150px);}
        .formtable_submit .signincontent .left3{width:100px;}
        .formtable_submit .signincontent .right3{width:calc(100% - 100px);}
    }
    @media screen and (min-width: 700px){
        .formtable_submit .sectiontitle{line-height:50px;font-size:34px;font-weight:bold;}
        .formtable_submit .sectionsummary{line-height:28px;font-size:20px;margin-top:10px;}
        .formtable_submit .bodycontentarea{line-height:28px;font-size:20px;margin-top:10px;}
        .formtable_submit .bodycontentarea .tdleftside{width:160px;line-height:28px;font-size:20px;}
        .formtable_submit .remarkscontent{line-height:30px;font-size:22px;margin-top:10px;}
        .formtable_submit .agreecontent{line-height:30px;font-size:22px;margin-top:20px;}
        .formtable_submit .signincontent{line-height:30px;font-size:22px;margin-top:20px;}
        .formtable_submit .signincontent .left{width:180px;}
        .formtable_submit .signincontent .right{width:calc(100% - 180px);}
        .formtable_submit .signincontent .left2{width:185px;}
        .formtable_submit .signincontent .right2{width:calc(100% - 185px);}
        .formtable_submit .signincontent .left3{width:150px;}
        .formtable_submit .signincontent .right3{width:calc(100% - 150px);}
    }
    .formtable_submit{float:left;width:100%;padding:20px 0px 30px 0px;background:white;}
    .formtable_submit .sectiontitle{float:left;width:100%;}
    .formtable_submit .sectionsummary{float:left;width:100%;}
    .formtable_submit .bodycontentarea{float:left;width:100%;}
    .formtable_submit .bodycontentarea table{float:left;width:100%;background:black;border-spacing: 1px;border-collapse:separate;}
    .formtable_submit .bodycontentarea table tr{background:white;}
    .formtable_submit .bodycontentarea table tr td{padding:8px;}
    .formtable_submit .remarkscontent{float:left;width:100%;}
    .formtable_submit .agreecontent{float:left;width:100%;}
    .formtable_submit .signincontent{float:left;width:100%;}
    .formtable_submit .signincontent .left{float:left;line-height:36px;}
    .formtable_submit .signincontent .right{float:left;}
    .formtable_submit .signincontent .left2{float:left;line-height:36px;}
    .formtable_submit .signincontent .right2{float:left;}
    .formtable_submit .signincontent .left3{float:left;line-height:36px;}
    .formtable_submit .signincontent .right3{float:left;}
    
    
    .formtable_loading{display:none;float:left;width:100%;padding:20px 0px 30px 0px;background:white;}
    .formtable_loading .innercontent{display: flex;flex-direction: row;justify-content: center;align-items: center;float:left;width:100%;margin-top:100px;}
    .formtable_loading .innercontent img{width:40px;height:40px;}
</style>