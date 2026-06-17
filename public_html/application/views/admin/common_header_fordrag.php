<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XXXXXX</title>
</head>

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
<script  language="JavaScript" type="text/javascript">
    	var baseurl = '<?php echo base_url()?>';
    	var currenturl = '<?php echo $current_url?>';
</script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input/dist/magic-input.min.css">
<script type="text/javascript" src="<?php echo CDN_URL().'themes/default/js/admin/jquery-1.7.2.min.js?date='.CACHE_USETIME()?>"></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/lan<?php echo $this->langtype?>.js?date=<?php echo CACHE_USETIME()?>'></script>
<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_common.js?date=<?php echo CACHE_USETIME()?>'></script>

<style>
    input[type=text],input[type=password], textarea {
    	float:left;
        -webkit-transition: all 0.30s ease-in-out;
        -moz-transition: all 0.30s ease-in-out;
        -ms-transition: all 0.30s ease-in-out;
        -o-transition: all 0.30s ease-in-out;
        outline: none;
        padding: 5px 0px 5px 5px;
        border: 1px solid #ddd;
    	background:#ffffff;
    }
    input[disabled=disabled], textarea[disabled=disabled] {
    	background:#EFEFEF;
    }
    input[type=text]:focus,input[type=password]:focus, textarea:focus {
    	background:#fcfecf;
        box-shadow: 0 0 5px #F7B5B7;
    	border: 1px solid #F7B5B7;
    }
    select{
    	-webkit-transition: all 0.30s ease-in-out;
        -moz-transition: all 0.30s ease-in-out;
        -ms-transition: all 0.30s ease-in-out;
        -o-transition: all 0.30s ease-in-out;
    	outline: none;
        padding: 2px;
        border: 1px solid #ddd;
    	background:#ffffff;
    }
    select:focus {
    	background:#fcfecf;
    	box-shadow: 0 0 5px #F7B5B7;
        padding: 2px;
        border: 1px solid #F7B5B7;
    }

    img {border:0px;}
	p{
		-webkit-margin-before: 0em;
		-webkit-margin-after: 0em;
		-webkit-margin-start: 0px;
		-webkit-margin-end: 0px;
	}
	a{text-decoration: none;color: #1a5178;}
	a:hover{text-decoration:none;}
	
	.gksel_navigation{float:left;width:99%;background:#EFEFEF;height:35px;margin-top:20px;line-height:35px;text-indent:10px;}
	
	.nav_on{float:left;color:#fff;background:#F7B5B7;margin-right:10px;padding:0px 16px;font-size:13px;line-height:35px;border-radius:4px;}
	.nav_on .plus{float:left;width:14px;height:14px;margin-top:10px;}
	.nav_on span{float:left;margin-left:5px;}
	
	.nav_off{float:left;color:#999;background:#EFEFEF;margin-right:10px;padding:0px 16px;font-size:13px;line-height:35px;border-radius:4px;}
	.nav_off .plus{width:14px;height:14px;margin-top:10px;}
	    
    
	.gksel_normal_tabaction{float:left;width:100%;border-collapse: collapse;margin-top:20px;font-size:12px;}
	.gksel_normal_tabaction tr td{font-weight: bold;padding: 0px 0px 5px 0px;}
	.gksel_normal_tabaction tr td .searcharea{float:right;margin-right:10px;}
	.gksel_normal_tabaction tr td input[type=text]{padding: 9px 0px 9px 7px;width:240px;margin-right:10px;}
	.gksel_normal_tabaction tr td input[type=submit]{float:left;height: 35px;line-height:35px;background: #F7B5B7;border: none;border-radius: 3px;color: #fff;text-align: center;padding:0px 20px;cursor: pointer;margin-right:10px;}
	.gksel_normal_tabaction tr td .select_usertype{float:left;/*Chrome和Firefox里面的边框是不一样的，所以复写了一下*//*在选择框的最右侧中间显示小箭头图片*/background: url('../../themes/default/images/select_arrow.png') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;/*很关键：将默认的select选择框样式清除*/appearance:none;-moz-appearance:none;-webkit-appearance:none;/*为下拉小箭头留出一点位置，避免被文字覆盖*/height:35px;width: 120px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;margin-right:10px;}
	.gksel_normal_tabaction tr td .category_id{float:left;/*Chrome和Firefox里面的边框是不一样的，所以复写了一下*//*在选择框的最右侧中间显示小箭头图片*/background: url('../../themes/default/images/select_arrow.png') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;/*很关键：将默认的select选择框样式清除*/appearance:none;-moz-appearance:none;-webkit-appearance:none;/*为下拉小箭头留出一点位置，避免被文字覆盖*/height:35px;width: 240px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;margin-right:10px;}
	.gksel_normal_tabaction tr td select[name=category_id]{float:left;background: url('../../themes/default/images/select_arrow.png') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width: 210px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;margin-right:10px;}
	.gksel_normal_tabaction tr td select[name=brand_id]{float:left;background: url('../../themes/default/images/select_arrow.png') no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;color:gray;appearance:none;-moz-appearance:none;-webkit-appearance:none;height:35px;width: 100px;font-size:14px;line-height:20px;padding:6px 0px 6px 10px;margin-right:10px;}
    
	.gksel_normal_tablist{float:left;width:100%;margin-top: 20px;border-collapse: collapse;font-size:12px;}
	.gksel_normal_tablist thead{background-color:white;padding: 10px 0;}
	.gksel_normal_tablist thead tr td{font-weight: bold;padding: 0px 0px 0px 0px;border-top: 1px solid #CCC;border-bottom: 1px solid #CCC;margin: 10px 0;}
	.gksel_normal_tablist thead tr td p{border-left: 1px solid #CCC;padding: 14px 0px 14px 0px;}
	.gksel_normal_tablist tbody tr td{color: #666;padding: 5px 10px 5px 10px;border-bottom: 1px solid #EFEFEF;}
	
    .gksel_normal_tabpost{float:left;width:calc(100% - 20px);margin-top: 10px;margin-left:10px;background-color:white;border-collapse: collapse;font-size:12px;}
    .gksel_normal_tabpost tr td{padding: 5px 15px 5px 15px;margin: 10px 0;}
    .gksel_normal_tabpost .thead td{background:#EFEFEF;padding: 10px 15px 10px 15px;margin: 20px 0px;font-size:15px;}
    .gksel_normal_tabpost tr td .tipsgroupbox{float:left;}
    .gksel_normal_tabpost tr td .tipsgroupbox .tips{float:left;color:#999;margin:4px 0px 0px 5px;}
    .gksel_normal_tabpost tr td .tipsgroupbox .request{float:left;font-size:16px;font-weight:bold;color:red;margin:5px 0px 0px 5px;}
    .gksel_normal_tabpost tr td .tipsgroupbox .requestbox{position:relative;margin-left:15px;}
    .gksel_normal_tabpost tr td .tipsgroupbox .requestbox .sanjiao{float:left;margin-top:8px;}
    .gksel_normal_tabpost tr td .tipsgroupbox .requestbox .sanjiao img{width:6px;height:11px;}
    .gksel_normal_tabpost tr td .tipsgroupbox .requestbox .content{float:left;height:30px;line-height:30px;color:white;padding:0px 15px 0px 10px;margin-top:-1px;background:#FF5900;border-radius:3px;}
	
	.gksel_btn_action_on{float:left;height: 30px;line-height:30px;background: #F7B5B7;border: none;border-radius: 3px;color: #fff;text-align: center;padding:0px 10px;cursor: pointer;margin-right:10px;}
	.gksel_btn_action_off{float:left;height: 30px;line-height:30px;background: #EFEFEF;border: none;border-radius: 3px;color: #999;text-align: center;padding:0px 10px;cursor: pointer;margin-right:10px;}
	.gksel_btn_action_off .icon_loading{float:left;margin:5px 0px;width:20px;height:20px;}
	.gksel_btn_action_off .icon_success{float:left;margin:5px 0px;width:20px;height:20px;}
	.gksel_btn_action_off span{float:left;margin-left:5px;}
	    
</style>
<body>