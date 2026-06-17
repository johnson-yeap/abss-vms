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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand" />
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
    <script  language="JavaScript" type="text/javascript">
    	var baseurl = '<?php echo base_url()?>';
    	var currenturl = '<?php echo $current_url?>';
    </script>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/magic-input/dist/magic-input.min.css">
	<script type="text/javascript" src="<?php echo CDN_URL().'themes/default/js/admin/jquery-1.7.2.min.js?date='.CACHE_USETIME()?>"></script>
	<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/lan<?php echo $this->langtype?>.js?date=<?php echo CACHE_USETIME()?>'></script>
	<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_common.js?date=<?php echo CACHE_USETIME()?>'></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>themes/default/admin.css?date=<?php echo CACHE_USETIME()?>"/>
	<link rel="shortcut icon" href="<?php echo CDN_URL().'themes/default/images/favicon.png?date='.CACHE_USETIME()?>" type="image/x-icon" />
</head>

<body>

<style>
.gksel_delete_box{display:none;position:fixed;z-index:1000;left:0px;right:0px;top:0px;bottom:0px;background:rgba(0, 0, 0, 0.5);}
.gksel_delete_box table{float:left;width:450px;height:100%;margin-left:50%;border-collapse:collapse;border-spacing:0;padding:0;}
.gksel_delete_content{float:left;width:100%;margin-left:-225px;background:white;border-radius:4px;}
.gksel_delete_content .close{float:left;width:100%;}
.gksel_delete_content .close img{float:right;width:25px;height:25px;margin:20px 20px 0px 0px;cursor:pointer;}
.gksel_delete_content .title{float:left;width:80%;margin:20px 10% 0px 10%;font-size:17px;line-height:25px;}
.gksel_delete_content .subtitle{float:left;width:80%;margin:0px 10%;font-size:14px;line-height:17px;color:gray;margin-top:4px;}
.gksel_delete_content .control{float:left;width:100%;background:#f1f5f8;border-bottom-left-radius:4px;border-bottom-right-radius:4px;font-size:14px;line-height:17px;color:gray;margin-top:40px;}
.gksel_delete_content .control .yes{float:left;margin:15px 0px 15px 100px;height: 40px;line-height: 40px;width:120px;font-size:15px;background: #F7B5B7;border: 1px solid #F7B5B7;color: #fff;text-align: center;cursor: pointer;}
.gksel_delete_content .control .no{float:left;margin:15px 0px 15px 15px;height: 40px;line-height: 40px;width:120px;font-size:15px;background: #EFEFEF;border: 1px solid #ccc;color: #F7B5B7;text-align: center;cursor: pointer;}
</style>

<div class="gksel_delete_box">
	<table>
		<tr>
			<td>
				<div class="gksel_delete_content">
					<div class="close"><img onclick="toclose_deletebox()" src="<?php echo base_url().'themes/default/images/close.png'?>"></div>
					<div class="title"></div>
					<div class="subtitle"></div>
					<div class="control">
						<div class="yes" onclick="del()"><?php if($this->langtype == '_ch'){echo '确定';}else{echo 'OK';}?></div>
						<div class="no" onclick="toclose_deletebox()"><?php if($this->langtype == '_ch'){echo '关闭';}else{echo 'Cancel';}?></div>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>