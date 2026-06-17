<?php
/**
 * 上传附件和上传视频
 * User: Jinqn
 * Date: 14-04-09
 * Time: 上午10:17
 */
if(isset($_COOKIE['wordpressnostress_admininfo'])){
    $admininfo = unserialize($_COOKIE['wordpressnostress_admininfo']);
    if(isset($admininfo['admin_id'])){
        $admin_id = $admininfo['admin_id'];
    }else{
        $admin_id = 0;
    }
}else{
    $admin_id = 0;
}
if($admin_id != 0){//必须为登录状态才可以访问
    include "Uploader.class.php";
    
    /* 上传配置 */
    $base64 = "upload";
    
    //*****获取当前项目名称 --- START
    $pre_projectname = '';
    if($_SERVER['REQUEST_URI'] == '/'){
    	$pre_projectname = '';
    }else{
    	$REQUEST_URI = $_SERVER['REQUEST_URI'];
    	$spurl = explode('/', $REQUEST_URI);
    
    	if($spurl[1] != 'admins' && $spurl[1] != 'index.php'){
    		$pre_projectname = '/'.$spurl[1].'';
    	}else{
    		$pre_projectname = '';
    	}
    	
    }
    //*****获取当前项目名称 --- END
    
    switch (htmlspecialchars($_GET['action'])) {
        case 'uploadimage':
            $config = array(
                "pathFormat" => $pre_projectname.$CONFIG['imagePathFormat'],
                "maxSize" => $CONFIG['imageMaxSize'],
                "allowFiles" => $CONFIG['imageAllowFiles']
            );
            $fieldName = $CONFIG['imageFieldName'];
            break;
        case 'uploadscrawl':
            $config = array(
                "pathFormat" => $pre_projectname.$CONFIG['scrawlPathFormat'],
                "maxSize" => $CONFIG['scrawlMaxSize'],
                "allowFiles" => $CONFIG['scrawlAllowFiles'],
                "oriName" => "scrawl.png"
            );
            $fieldName = $CONFIG['scrawlFieldName'];
            $base64 = "base64";
            break;
        case 'uploadvideo':
            $config = array(
                "pathFormat" => $pre_projectname.$CONFIG['videoPathFormat'],
                "maxSize" => $CONFIG['videoMaxSize'],
                "allowFiles" => $CONFIG['videoAllowFiles']
            );
            $fieldName = $CONFIG['videoFieldName'];
            break;
        case 'uploadfile':
        default:
            $config = array(
                "pathFormat" => $pre_projectname.$CONFIG['filePathFormat'],
                "maxSize" => $CONFIG['fileMaxSize'],
                "allowFiles" => $CONFIG['fileAllowFiles']
            );
            $fieldName = $CONFIG['fileFieldName'];
            break;
    }
    
    /* 生成上传实例对象并完成上传 */
    $up = new Uploader($fieldName, $config, $base64);
    
    /**
     * 得到上传文件所对应的各个参数,数组结构
     * array(
     *     "state" => "",          //上传状态，上传成功时必须返回"SUCCESS"
     *     "url" => "",            //返回的地址
     *     "title" => "",          //新文件名
     *     "original" => "",       //原始文件名
     *     "type" => ""            //文件类型
     *     "size" => "",           //文件大小
     * )
     */
    
    /* 返回数据 */
    return json_encode($up->getFileInfo());
}else{
    echo '非法请求！';exit;
}
