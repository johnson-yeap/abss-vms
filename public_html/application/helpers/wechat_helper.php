<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	//微信APPID
	function WECHAT_APPID(){
		$CI =& get_instance();
		$WECHAT_APPID=$CI->config->item('WECHAT_APPID');
		return $WECHAT_APPID;
	}
	
	//微信APPSECRET
	function WECHAT_APPSECRET(){
		$CI =& get_instance();
		$WECHAT_APPSECRET=$CI->config->item('WECHAT_APPSECRET');
		return $WECHAT_APPSECRET;
	}
	
	//授权获取微信用户信息
	function getwechatuserinfo($code){
		
		$CI =& get_instance();
		$wechat_appid = WECHAT_APPID();
		$wechat_secret = WECHAT_APPSECRET();
	
		//echo urlencode('http://www.gogre3n.cn/index.php/weixin_oauth/index');exit;
		//获取code
// 		echo '<a href="';
// 		echo "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$wechat_appid&secret=$wechat_secret&code=".$code."&grant_type=authorization_code";
// 		echo '">hhh</a>';
// 		exit;
		//获取 code 后，请求以下链接获取 access_token：
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$wechat_appid&secret=$wechat_secret&code=".$code."&grant_type=authorization_code");
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
// 		$output = curl_exec($ch);
// 		curl_close($ch);
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$wechat_appid&secret=$wechat_secret&code=".$code."&grant_type=authorization_code";
		$output = file_get_contents($url);
		
		$output=json_decode($output);
		$access_token=$output->access_token;
	
		$expires_in=$output->expires_in;
		$refresh_token=$output->refresh_token;
		$openid=$output->openid;
		$scope=$output->scope;


// 获取第二步的 refresh_token 后，请求以下链接获取 access_token：
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$wechat_appid&grant_type=refresh_token&refresh_token=".$refresh_token);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
// 		$output = curl_exec($ch);
// 		curl_close($ch);

		$url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$wechat_appid&grant_type=refresh_token&refresh_token=".$refresh_token;
		$output = file_get_contents($url);
	
		$output=json_decode($output);
		$access_token=$output->access_token;
		$expires_in=$output->expires_in;
		$refresh_token=$output->refresh_token;
		$openid=$output->openid;
		$scope=$output->scope;
		
	
		//通过 access_token 拉取用户信息(仅限 scope= snsapi_userinfo)：
// 		$ch = curl_init();
// 		curl_setopt($ch, CURLOPT_URL, "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid);
// 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 		curl_setopt($ch, CURLOPT_HEADER, 0);
// 		$output = curl_exec($ch);
// 		// 		print_r($output);exit;
// 		curl_close($ch);
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid;
		$output = file_get_contents($url);
		
		$output=json_decode($output);
		//获取后得到的用户信息
		$wechat_openid = $output->openid;
		$wechat_nickname = $output->nickname;
		$wechat_headimgurl = $output->headimgurl;
	
		$arr = array('wechat_openid'=>$wechat_openid, 'wechat_nickname'=>$wechat_nickname, 'wechat_avatar'=>$wechat_headimgurl);

		//echo '<meta http-equiv="Content-Type" content="textml; charset=utf-8" />';
		return $arr;
	}
	
	
	//curl Post 数据
	function do_post_request_forprint($url, $post_Data){
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_POST, 1);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_Data);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	    $data = curl_exec($ch);
	    //		var_dump($data);
	    return $data;
	}
	
	
	