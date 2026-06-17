<?php 
    header("X-XSS-Protection: 1");
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
<link rel="shortcut icon" href="<?php echo CDN_URL().'themes/default/images/favicon.png?date='.CACHE_USETIME()?>" type="image/x-icon" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
<meta name="format-detection" content="telephone=no" /> 
<script type="text/javascript" src="<?php echo CDN_URL().'themes/default/js/jquery-3.6.0.min.js?date='.CACHE_USETIME()?>"></script>
<link rel="stylesheet" href="<?php echo CDN_URL();?>themes/default/admin.css?date=<?php echo CACHE_USETIME()?>" />
<title>XXXXXX</title>
<script language="JavaScript" type="text/javascript">
	var baseurl = '<?php echo base_url()?>';
	var currenturl = '<?php echo current_url()?>';
	var cdnurl = "<?php echo CDN_URL()?>";

	function getauthimg(authur) {
		document.getElementById('authimg').src = authur+"?"+Math.random(1);
		document.getElementById('authimg1').src = document.getElementById('authimg').src;
	}
</script>
</head>
<body>

<div style="float:left;width:100%;height:100%;background-color:#E7E7E7;">
	&nbsp;
</div>
<div style="position:fixed;float:left;width:100%;height:100%;">
	<div style="display:flex;float:left;width:100%;height:100%;flex-direction: column;justify-content:center;align-items: center;">
    	<div style="display:none;float:left;width:400px;">
    		<img style="float:left;width:70%;margin-left:15%;" src="<?php echo base_url().'themes/default/images/logo.gif'?>"/>
    	</div>
    	<div style="float:left;width:400px;font-weight:bold;font-size:40px;color:white;text-align:center;">
    		XXXXXX
    	</div>
    	<div style="float:left;width:320px;margin-top:40px;background-color:white;border-radius:6px;border-bottom: 1px solid #CCC;box-shadow: 2px -1px 10px #ccc;">
        	<form name="loginform" action="<?php echo base_url().'admin/tologin/'.$admin_token?>" method="post">
        	
        		<div style="float:left;width:calc(100% - 120px);margin-left:60px;padding-bottom:20px;">
            		<div style="float:left;width:100%;color:#BFBFBF;font-size:15px;margin-top:20px;">USERNAME</div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<input name="username" type="text" autocomplete="off" style="float:left;width:calc(100% - 6px);height:30px;" value="<?php echo set_value('username')?>"/>
            		</div>
            		<div style="float:left;width:100%;color:red;">
            			<?php if(isset($username_error)) echo $username_error;?>
            		</div>
            		
            		<div style="float:left;width:100%;color:#BFBFBF;font-size:15px;margin-top:20px;">PASSWORD</div>
            		<div style="float:left;width:100%;margin-top:5px;">
            			<input name="password" type="password" autocomplete="off" style="float:left;width:calc(100% - 6px);height:30px;"/>
            		</div>
            		<div style="float:left;width:100%;color:red;">
            			<?php if(isset($password_error)) echo $password_error;?>
            		</div>
            		
            		
            		
            		<div style="float:left;width:100%;color:#BFBFBF;font-size:15px;margin-top:20px;">CAPTCHA</div>
            		<div style="float:left;width:100%;margin-top:5px;">
						<div style="float:left;width:calc(100% - 88px);">
							<input type="text" name="code" id="code" autocomplete="off" value="" style="float:left;width:calc(100% - 6px);height:30px;"/>
						</div>
						<div style="float:left;width:78px;margin-left:10px;">
							<?php $authurl = base_url()."admin/yanzhengma"; ?>
							<img class="houtai_login_code_img" src="<?php echo $authurl ?>" onclick="this.src=this.src+'?'+Math.random();" style="border-radius:2px;"/>
						</div>
            		</div>
            		<div style="float:left;width:100%;color:red;">
            			<?php if(isset($code_error)){echo $code_error;}?>
            		</div>
            		<div style="float:left;width:100%;margin-top:20px;">
            			<input style="float:left;border:0;width:100%;height:40px;background:#F7B5B7;color:white;border-radius:4px;font-weight:bold;" type="submit" value="LOGIN IN"  />
            		</div>
            		<div style="float:left;width:100%;">
        				<div style="float:left;color:red;margin-top:7px;"><?php if(isset($error)) echo $error;?></div>
            		</div>
        		</div>
        	</form>
    	</div>
	</div>
</div>
<script>

var imgList = [];
function start_bg(){
     $('.normal_background_lazyloading').not('[data-isLoading]').each(function () {
        if (isShow_bg($(this))) {
            loadImg_bg($(this));
        }
    })
}
// 判断图片是否出现在视窗的函数
function isShow_bg($node){
    return $node.offset().top <= $(window).height()+$(window).scrollTop();
}
// 加载图片的函数，就是把自定义属性data-src 存储的真正的图片地址，赋值给src
function loadImg_bg(targetimg){
//	 	  $("<img />").attr("src", baseurl+targetimg.attr('data-src')).load(function() {
//	 		  targetimg.css('background-image', "url('"+baseurl+targetimg.attr('data-src')+"')");
//	 		              // 已经加载的图片，我给它设置一个属性，值为1，作为标识
//	 		              // 弄这个的初衷是因为，每次滚动的时候，所有的图片都会遍历一遍，这样有点浪费，所以做个标识，滚动的时候只遍历哪些还没有加载的图片
//	 		              targetimg.attr('data-isLoading', 1);
//	 			})



      $("<img />").attr("src", baseurl+targetimg.attr('data-src')).on('load',function(){
      	targetimg.css('background-image', "url('"+baseurl+targetimg.attr('data-src')+"')");
          // 已经加载的图片，我给它设置一个属性，值为1，作为标识
          // 弄这个的初衷是因为，每次滚动的时候，所有的图片都会遍历一遍，这样有点浪费，所以做个标识，滚动的时候只遍历哪些还没有加载的图片
          targetimg.attr('data-isLoading', 1);
      });
}






function start_img(){
     $('.container img').not('[data-isLoading]').each(function () {
        if (isShow_img($(this))) {
            loadImg_img($(this));
        }
    })
}
// 判断图片是否出现在视窗的函数
function isShow_img($node){
    return $node.offset().top <= $(window).height()+$(window).scrollTop();
}
// 加载图片的函数，就是把自定义属性data-src 存储的真正的图片地址，赋值给src
function loadImg_img(targetimg){
//	  $("<img />").attr("src", baseurl+targetimg.attr('data-src')).load(function() {
//		  targetimg.attr('src', baseurl+targetimg.attr('data-src'));
//		              // 已经加载的图片，我给它设置一个属性，值为1，作为标识
//		              // 弄这个的初衷是因为，每次滚动的时候，所有的图片都会遍历一遍，这样有点浪费，所以做个标识，滚动的时候只遍历哪些还没有加载的图片
//		              targetimg.attr('data-isLoading', 1);
//			})


			$("<img />").attr("src", baseurl+targetimg.attr('data-src')).on('load',function(){
				targetimg.attr('src', baseurl+targetimg.attr('data-src'));
	              // 已经加载的图片，我给它设置一个属性，值为1，作为标识
	              // 弄这个的初衷是因为，每次滚动的时候，所有的图片都会遍历一遍，这样有点浪费，所以做个标识，滚动的时候只遍历哪些还没有加载的图片
	              targetimg.attr('data-isLoading', 1);
	        });
}
$(document).ready(function(){
	
	// 一开始没有滚动的时候，出现在视窗中的图片也会加载
	  start_bg();
	
	  // 当页面开始滚动的时候，遍历图片，如果图片出现在视窗中，就加载图片
	  var clock_bg; //函数节流
	  $(window).on('scroll',function(){
	      if(clock_bg){
	          clearTimeout(clock_bg);
	      }
	      clock_bg = setTimeout(function(){
	          start_bg()
	      },200)
	  })
	
	  // 一开始没有滚动的时候，出现在视窗中的图片也会加载
	  start_img();
	
	  // 当页面开始滚动的时候，遍历图片，如果图片出现在视窗中，就加载图片
	  var clock_img; //函数节流
	  $(window).on('scroll',function(){
	      if(clock_img){
	          clearTimeout(clock_img);
	      }
	      clock_img = setTimeout(function(){
	          start_img()
	      },200)
	  })
	
	
})
</script>

</body>
</html>