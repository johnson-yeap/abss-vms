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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>XXXXXX</title>
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
	<script type="text/javascript" src="<?php echo CDN_URL().'themes/default/js/admin/jquery-1.7.2.min.js?date='.CACHE_USETIME()?>"></script>
	<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/lan<?php echo $this->langtype?>.js?date=<?php echo CACHE_USETIME()?>'></script>
	<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_common.js?date=<?php echo CACHE_USETIME()?>'></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/admin.css?date=<?php echo CACHE_USETIME()?>"/>
	<link rel="shortcut icon" href="<?php echo CDN_URL().'themes/default/images/favicon.png?date='.CACHE_USETIME()?>" type="image/x-icon" />
</head>
<body scroll="no">

<table cellpadding="0" cellspacing="0" width="100%" border="0" height="100%">
	<tr>
		<td valign="top" colspan="2" style="height:70px;">
			<?php $this->load->view('admin/home_topmenu');?>
		</td>
	</tr>
	<tr>
		<td width="280" valign="top" class="lefttablemenu" style="background-color:#F7B5B7;width:280px;">
			<iframe src="<?php echo site_url('admins/home/leftmenu')?>" name="iframe_menu" target="iframe_main" width="280" height="100%" scrolling="yes" frameborder="0"></iframe>
		</td>
		<td class="righttablewidth" valign="top" style="background-color:#f3f3f3;">
			<iframe src="<?php echo site_url('admins/home/main')?>" name="iframe_main" width="100%" height="100%" frameborder="0" scrolling="yes" style="overflow:visible;"></iframe>
		</td>
	</tr>
</table>
<script type="text/javascript">


    var allbody_width = 0;
    var allbody_height = 0;

	function autotestwidth(){
// 		allbody_width = $(window).width();
// 		allbody_height = $(window).height();
		allbody_width = document.body.clientWidth;
		allbody_height = document.body.clientHeight;

		$('.righttablewidth').css({'width':(allbody_width - 250)+'px'});
	}
	
	$(window).resize(function() {
		autotestwidth();
	})
	autotestwidth();

</script>

	
</body>
</html>
