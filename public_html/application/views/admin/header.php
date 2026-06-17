<?php 
//     header("X-XSS-Protection: 1");
    header("X-Content-Type-Options: nosniff");
    header("X-Frame-Options: SAMEORIGIN");//(1) DENY 表示该页面不允许在 frame 中展示，即便是在相同域名的页面中嵌套也不允许。SAMEORIGIN 表示该页面可以在相同域名页面的 frame 中展示。ALLOW-FROM uri 表示该页面可以在指定来源的 frame 中展示。
    header("Referrer-Policy: same-origin");
    header("X-Permitted-Cross-Domain-Policies: same-origin");
    header("X-Download-Options: same-origin");
    if($this->langtype == '_ch'){
        header("content-language: zh-CN");
    }else{
        header("content-language: en");
    }
// 	header("Cache-Control: max-age=86400");
	header("Content-type: text/html; charset=utf-8");
	header("Server: close");
	header("Technology: close");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="UTF-8">
	<title>XXXXXX</title>
	<script type="text/javascript" src="<?php echo CDN_URL().'themes/default/js/admin/jquery-1.7.2.min.js?date='.CACHE_USETIME()?>"></script>
	<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/lan<?php echo $this->langtype?>.js?date=<?php echo CACHE_USETIME()?>'></script>
	<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_common.js?date=<?php echo CACHE_USETIME()?>'></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/admin.css?date=<?php echo CACHE_USETIME()?>"/>
	<link rel="shortcut icon" href="<?php echo CDN_URL().'themes/default/images/favicon.png?date='.CACHE_USETIME()?>" type="image/x-icon" />
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
$menu = $this->session->userdata('menu');
?>
<script type="text/javascript">
	var baseurl='<?php echo base_url()?>';
	var cdnurl='<?php echo CDN_URL()?>';
	var currenturl='<?php echo $current_url?>';
	var current_url_encode='<?php echo $current_url_encode?>';
</script>


<body>
<?php 
$admin = $this->session->userdata ( 'admin' );
if (isset($admin ['admin_id'])){
	$admin_id = $admin ['admin_id'];
}else {
	$admin_id = 0;
}
if (isset($admin ['admin_username'])){
	$admin_username = $admin ['admin_username'];
}else{
	$admin_username = '';
}
?>
<div class="Frame_Header">
	<img class="logo" src="<?php echo CDN_URL().'themes/default/images/logo_200.png'?>"/>
	<div class="infomation">
		<div class="infoarea">
			<div class="inforight">
				<div class="info">Hello!</div>
				<div class="userinfo"><?php echo $admin_username;?></div>
				<div class="logout"><a href="<?php echo base_url().'admin/logout'?>">【Logout】</a></div>
			</div>
		</div>
		<div class="languagearea">
			<div class="language">
				<a href="<?php echo base_url().'admin/changelanguage/en/'.$current_url_encode?>"><img src="<?php echo base_url().'themes/default/images/header_lan_en.png'?>"/></a>
				<a href="<?php echo base_url().'admin/changelanguage/ch/'.$current_url_encode?>"><img src="<?php echo base_url().'themes/default/images/header_lan_ch.png'?>"/></a>
			</div>
		</div>
	</div>
</div>
<div class="Frame_Leftmenu">
	<div class="title"><?php echo lang('cy_backend_center_manage')?></div>
	<div class="list">
		<ul class="menugroup">
			<li>
				<a class="active">
					<?php if($this->langtype == '_ch'){echo '管理员';}else{echo 'Admin';}?>
				</a>
			</li>
		</ul>
		<ul>
			<!--  
			<li><span><img src="<?php if($menu == 'user'){echo base_url().'themes/default/images/icon_id-card_on.png';}else{echo base_url().'themes/default/images/icon_id-card_off.png';}?>"/></span><font><a <?php if($menu == 'user'){echo 'class="subactive" ';}?>href="<?php echo base_url().'admins/user/index?user_type=1'?>"><?php echo lang('dz_user_manage')?></a></font></li>
			<li><span><img src="<?php if($menu == 'superadmin'){echo base_url().'themes/default/images/icon_placeholder_on.png';}else{echo base_url().'themes/default/images/icon_placeholder_off.png';}?>"/></span><font><a <?php if($menu == 'superadmin'){echo 'class="subactive" ';}?>href="<?php echo base_url().'admins/user/adminassistantlist?admin_type=1'?>"><?php echo lang('cy_admin_super')?></a></font></li>
			-->
			<li><span><img src="<?php if($menu == 'adminassistant'){echo base_url().'themes/default/images/icon_placeholder_on.png';}else{echo base_url().'themes/default/images/icon_placeholder_off.png';}?>"/></span><font><a <?php if($menu == 'adminassistant'){echo 'class="subactive" ';}?>href="<?php echo base_url().'admins/user/adminassistantlist?admin_type=2'?>"><?php echo lang('cy_admin_assistant')?></a></font></li>
		</ul>
	</div>
</div>



<div class="Frame_Body">

<?php if(isset($url)){?><div class="gksel_navigation"><?php echo $url;?></div><?php }?>
	
<div class="gksel_delete_box_bg"></div>
<div class="gksel_delete_box">
	<table>
		<tr>
			<td>
				<div class="gksel_delete_content">
					<div class="close"><img onclick="toclose_deletebox()" src="<?php echo base_url().'themes/default/images/close.png'?>"></div>
					<div class="title"></div>
					<div class="subtitle"></div>
					<div class="control">
						<div class="yes" onclick="del()">OK</div>
						<div class="no" onclick="toclose_deletebox()">Cancel</div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>

