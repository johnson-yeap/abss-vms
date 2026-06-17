<?php
/**
 * 抓取远程图片
 * User: Jinqn
 * Date: 14-04-14
 * Time: 下午19:18
 */
set_time_limit(0);
include("Uploader.class.php");

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
    /* 上传配置 */
    $config = array(
        "pathFormat" => $CONFIG['catcherPathFormat'],
        "maxSize" => $CONFIG['catcherMaxSize'],
        "allowFiles" => $CONFIG['catcherAllowFiles'],
        "oriName" => "remote.png"
    );
    $fieldName = $CONFIG['catcherFieldName'];
    
    /* 抓取远程图片 */
    $list = array();
    if (isset($_POST[$fieldName])) {
        $source = $_POST[$fieldName];
    } else {
        $source = $_GET[$fieldName];
    }
    foreach ($source as $imgUrl) {
        $item = new Uploader($imgUrl, $config, "remote");
        $info = $item->getFileInfo();
        array_push($list, array(
            "state" => $info["state"],
            "url" => $info["url"],
            "size" => $info["size"],
            "title" => htmlspecialchars($info["title"]),
            "original" => htmlspecialchars($info["original"]),
            "source" => htmlspecialchars($imgUrl)
        ));
    }
    
    /* 返回抓取数据 */
    return json_encode(array(
        'state'=> count($list) ? 'SUCCESS':'ERROR',
        'list'=> $list
    ));
}else{
    echo '非法请求！';exit;
}