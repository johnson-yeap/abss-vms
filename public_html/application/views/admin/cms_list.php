<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>jqueryUI拖动</title>
</head>

<?php 
$get_str = '';
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

    tr{cursor: pointer;}
    
    img {border:0px;}
	p{
		-webkit-margin-before: 0em;
		-webkit-margin-after: 0em;
		-webkit-margin-start: 0px;
		-webkit-margin-end: 0px;
	}
	a{text-decoration: none;color: #1a5178;}
	a:hover{text-decoration:none;}
    
	.ma_actions{float:left;width:100%;margin-top:3px;}
	.ma_actions ul{float:left;padding:0px;margin:0px;list-style:none;}
	.ma_actions li{float:left;padding: 0px 5px 5px 5px;margin:0px;list-style:none;}
	
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
	
	.gksel_btn_action_on{float:left;height: 30px;line-height:30px;background: #F7B5B7;border: none;border-radius: 3px;color: #fff;text-align: center;padding:0px 10px;cursor: pointer;margin-right:10px;}
	.gksel_btn_action_off{float:left;height: 30px;line-height:30px;background: #EFEFEF;border: none;border-radius: 3px;color: #999;text-align: center;padding:0px 10px;cursor: pointer;margin-right:10px;}
	.gksel_btn_action_off .icon_loading{float:left;margin:5px 0px;width:20px;height:20px;}
	.gksel_btn_action_off .icon_success{float:left;margin:5px 0px;width:20px;height:20px;}
	.gksel_btn_action_off span{float:left;margin-left:5px;}
	    
</style>
<body>
<div style="float:left;width:calc(100% - 40px);margin-left:20px;">
	
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
$current_url = current_url();
$current_url_encode=str_replace('/','slash_tag',base64_encode($current_url.$get_str));

$event_id = $this->input->get('event_id');
$brand_id = $this->input->get('brand_id');
$keyword = $this->input->get('keyword');
$langtype = $this->input->get('langtype');

check_SQLinjection($keyword);//防止sql注入，防止js注入
?>
<?php if($group_id == 1 || $group_id == 10 || $group_id == 11 || $group_id == 12 || $group_id == 101 || $group_id == 102){?>
	<table class="gksel_normal_tabaction">
		<tr>
			<td>
				<div style="float:left;">
					<a href="<?php echo base_url().'admins/cms/toadd_cms/'.$group_id?>">
						<font class="nav_on">
							<font class="plus">
								<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
								<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
							</font>
							<span>
								<?php 
								    if($this->langtype == '_ch'){echo '添加';}else{echo 'Add ';}
    								if($group_id == 10){
    								    if($this->langtype == '_ch'){echo '校友新闻';}else if($this->langtype == '_jp'){echo '卒業生ニュース';}else if($this->langtype == '_sk'){echo '교우뉴스';}else if($this->langtype == '_ru'){echo 'Новости выпускников';}else{echo 'Alumni News';}
    								}else if($group_id == 203){
    								    if($this->langtype == '_ch'){echo '校友视频';}else{echo 'Alumni Video';}
    								}else if($group_id == 401){
    								    if($this->langtype == '_ch'){echo '校友图片';}else{echo 'Alumni Picture';}
    								}else if($group_id == 507){
    								    if($this->langtype == '_ch'){echo '校友故事';}else{echo 'Alumni Story';}
    								}else{
    								    if($this->langtype == '_ch'){echo '内容';}else{echo 'Content';}
    								}
								?>
							</span>
						</font>
					</a>
				</div>
			</td>
			<td>
				<?php if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){?>
    				<div class="searcharea">
        				<form action = "<?php echo base_url().'admins/cms/index'?>" method="get">
        					<script>
        						function tochoose_language(langtype){
        							if(langtype != '' && langtype != 0){
        								$('select[name="langtype"]').css({'color': 'black'});
        							}else{
        								$('select[name="langtype"]').css({'color': '#999'});
        							}
        						}
        					</script>
        					<?php 
        						if($langtype != ''){
        							$thiscolor = 'color:black;';
        						}else{
        							$thiscolor = 'color:#999;';
        						}
        					?>
        					<select name="langtype" onchange="tochoose_language(this.value)" style="<?php echo 'float: left;background: url('.base_url().'themes/default/images/select_arrow.png) no-repeat scroll right center rgba(255,255,255,0.8);border: solid 1px #ddd;'.$thiscolor.'appearance: none;-moz-appearance: none;-webkit-appearance: none;height: 35px;width: 210px;font-size: 14px;line-height: 20px;padding: 6px 0px 6px 10px;margin-right: 10px;';?>">
        						<option value=""><?php if($langtype == '_ch'){echo '语言';}else{echo 'Language';}?></option>
        						<option value="_en" <?php if($langtype == '_en'){echo 'selected';}?>>English</option>
            					<option value="_ch" <?php if($langtype == '_ch'){echo 'selected';}?>>中文</option>
            					<option value="_jp" <?php if($langtype == '_jp'){echo 'selected';}?>>日本語</option>
            					<option value="_sk" <?php if($langtype == '_sk'){echo 'selected';}?>>한국어</option>
            					<option value="_ru" <?php if($langtype == '_ru'){echo 'selected';}?>>Русский</option>
        					</select>
        					<input type="hidden" name="group_id" value="<?php echo $group_id?>"/>
        					<input type="text" name="keyword" placeholder="<?php echo lang('cy_enter_keyword')?>" value="<?php echo $keyword?>"/>
        					<input type="submit" value="<?php echo lang('cy_search')?>"/>
        				</form>
        			</div>
    			<?php }?>
				<?php if($group_id != 7 && $group_id != 10 && $group_id != 13 && $group_id != 203 && $group_id != 301 && $group_id != 401 && $group_id != 507){?>
					<?php 
    					if(isset($_COOKIE[DB_PRE().'listsort'])){
    					    $listsort = unserialize($_COOKIE[DB_PRE().'listsort']);
    					    $list_iscansort = $listsort['list_iscansort'];
    					}else{
    					    $list_iscansort = 0;
    					}
					?>
					<style>
			         .list_sort_floatright{float:right;}
.list_sort_closed{float:left;cursor:pointer;}
.list_sort_closed img{float:left;width:20px;}
.list_sort_closed .sortname{float:left;margin-left:5px;line-height:20px;}
.list_sort_open{float:left;cursor:pointer;}
.list_sort_open img{float:left;width:20px;}
.list_sort_open .sortname{float:left;margin-left:5px;line-height:20px;color:#008C00;}
.list_sort_loading{display:none;float:left;}
.list_sort_loading img{float:left;width:20px;}
.list_sort_loading .loadingname{float:left;margin-left:5px;line-height:20px;color:gray;}
			        </style>
					<div class="list_sort_floatright">
						<div class="list_sort_closed" onclick="tolistsort_open()" style="<?php if($list_iscansort == 1){echo 'display:none;';}?>">
        					<img src="<?php echo base_url().'themes/default/images/icon_list_sort_close.png';?>"/>
        					<div class="sortname"><?php if($this->langtype == '_ch'){echo '排序已锁定';}else{echo 'Sort Locked';}?></div>
    					</div>
    					<div class="list_sort_open" onclick="tolistsort_close()" style="<?php if($list_iscansort == 0){echo 'display:none;';}?>">
        					<img src="<?php echo base_url().'themes/default/images/icon_list_sort_open.png';?>"/>
        					<div class="sortname"><?php if($this->langtype == '_ch'){echo '排序已打开';}else{echo 'Sort Open';}?></div>
    					</div>
    					<div class="list_sort_loading">
        					<img src="<?php echo base_url().'themes/default/images/ajax_loading.gif';?>"/>
        					<div class="loadingname"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
    					</div>
					</div>
				<?php }?>
			</td>
		</tr>
	</table>
<?php }else if($group_id == 202){?>
	<table class="gksel_normal_tabaction">
		<tr>
			<td>
				<div style="float:left;">
					<a href="<?php echo base_url().'admins/cms/toadd_cms/'.$group_id?>">
						<font class="nav_on">
							<font class="plus">
								<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
								<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
							</font>
							<span>
								<?php if($this->langtype == '_ch'){echo 'Add Download';}else{echo 'Add Download';}?>
							</span>
						</font>
					</a>
				</div>
			</td>
			<td>
				<?php if($group_id != 7 && $group_id != 10 && $group_id != 13 && $group_id != 203 && $group_id != 301 && $group_id != 401 && $group_id != 507){?>
					<?php 
    					if(isset($_COOKIE[DB_PRE().'listsort'])){
    					    $listsort = unserialize($_COOKIE[DB_PRE().'listsort']);
    					    $list_iscansort = $listsort['list_iscansort'];
    					}else{
    					    $list_iscansort = 0;
    					}
					?>
					<style>
			         .list_sort_floatright{float:right;}
.list_sort_closed{float:left;cursor:pointer;}
.list_sort_closed img{float:left;width:20px;}
.list_sort_closed .sortname{float:left;margin-left:5px;line-height:20px;}
.list_sort_open{float:left;cursor:pointer;}
.list_sort_open img{float:left;width:20px;}
.list_sort_open .sortname{float:left;margin-left:5px;line-height:20px;color:#008C00;}
.list_sort_loading{display:none;float:left;}
.list_sort_loading img{float:left;width:20px;}
.list_sort_loading .loadingname{float:left;margin-left:5px;line-height:20px;color:gray;}
			        </style>
					<div class="list_sort_floatright">
						<div class="list_sort_closed" onclick="tolistsort_open()" style="<?php if($list_iscansort == 1){echo 'display:none;';}?>">
        					<img src="<?php echo base_url().'themes/default/images/icon_list_sort_close.png';?>"/>
        					<div class="sortname"><?php if($this->langtype == '_ch'){echo '排序已锁定';}else{echo 'Sort Locked';}?></div>
    					</div>
    					<div class="list_sort_open" onclick="tolistsort_close()" style="<?php if($list_iscansort == 0){echo 'display:none;';}?>">
        					<img src="<?php echo base_url().'themes/default/images/icon_list_sort_open.png';?>"/>
        					<div class="sortname"><?php if($this->langtype == '_ch'){echo '排序已打开';}else{echo 'Sort Open';}?></div>
    					</div>
    					<div class="list_sort_loading">
        					<img src="<?php echo base_url().'themes/default/images/ajax_loading.gif';?>"/>
        					<div class="loadingname"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
    					</div>
					</div>
				<?php }?>
			</td>
		</tr>
	</table>
<?php }else if($group_id == 507){?>
	<table class="gksel_normal_tabaction">
		<tr>
			<td>
				<div style="float:left;">
					<a href="<?php echo base_url().'admins/cms/toadd_cms/'.$group_id?>">
						<font class="nav_on">
							<font class="plus">
								<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
								<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
							</font>
							<span>
								<?php if($this->langtype == '_ch'){echo 'Add Alumni Story';}else{echo 'Add Alumni Story';}?>
							</span>
						</font>
					</a>
				</div>
			</td>
			<td>
				<?php if($group_id != 7 && $group_id != 10 && $group_id != 13 && $group_id != 203 && $group_id != 301 && $group_id != 401 && $group_id != 507){?>
					<?php 
    					if(isset($_COOKIE[DB_PRE().'listsort'])){
    					    $listsort = unserialize($_COOKIE[DB_PRE().'listsort']);
    					    $list_iscansort = $listsort['list_iscansort'];
    					}else{
    					    $list_iscansort = 0;
    					}
					?>
					<style>
			         .list_sort_floatright{float:right;}
.list_sort_closed{float:left;cursor:pointer;}
.list_sort_closed img{float:left;width:20px;}
.list_sort_closed .sortname{float:left;margin-left:5px;line-height:20px;}
.list_sort_open{float:left;cursor:pointer;}
.list_sort_open img{float:left;width:20px;}
.list_sort_open .sortname{float:left;margin-left:5px;line-height:20px;color:#008C00;}
.list_sort_loading{display:none;float:left;}
.list_sort_loading img{float:left;width:20px;}
.list_sort_loading .loadingname{float:left;margin-left:5px;line-height:20px;color:gray;}
			        </style>
					<div class="list_sort_floatright">
						<div class="list_sort_closed" onclick="tolistsort_open()" style="<?php if($list_iscansort == 1){echo 'display:none;';}?>">
        					<img src="<?php echo base_url().'themes/default/images/icon_list_sort_close.png';?>"/>
        					<div class="sortname"><?php if($this->langtype == '_ch'){echo '排序已锁定';}else{echo 'Sort Locked';}?></div>
    					</div>
    					<div class="list_sort_open" onclick="tolistsort_close()" style="<?php if($list_iscansort == 0){echo 'display:none;';}?>">
        					<img src="<?php echo base_url().'themes/default/images/icon_list_sort_open.png';?>"/>
        					<div class="sortname"><?php if($this->langtype == '_ch'){echo '排序已打开';}else{echo 'Sort Open';}?></div>
    					</div>
    					<div class="list_sort_loading">
        					<img src="<?php echo base_url().'themes/default/images/ajax_loading.gif';?>"/>
        					<div class="loadingname"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
    					</div>
					</div>
				<?php }?>
			</td>
		</tr>
	</table>
<?php }else{?>
	<div style="float:left;width:100%;margin-top:20px;">
		<?php if($group_id == 204 || $group_id == 205){?>
			<div onclick="javascript:location.href='<?php echo base_url().'admins/cms/index?group_id=204'?>';" style="float:left;line-height:30px;font-size:12px;cursor:pointer;<?php if($group_id == 204){echo 'background:#F7B5B7;color:white;';}else{echo 'background:#CCC;color:black;';}?>padding:0px 10px;border-radius:4px;margin-right:10px;"><?php if($this->langtype == '_ch'){echo '关于上海';}else{echo 'About Shanghai';}?></div>
			<div onclick="javascript:location.href='<?php echo base_url().'admins/cms/index?group_id=205'?>';" style="float:left;line-height:30px;font-size:12px;cursor:pointer;<?php if($group_id == 205){echo 'background:#F7B5B7;color:white;';}else{echo 'background:#CCC;color:black;';}?>padding:0px 10px;border-radius:4px;margin-right:10px;"><?php if($this->langtype == '_ch'){echo '景点';}else{echo 'Attractions';}?></div>
		<?php }?>
		<?php if($group_id == 205){?>
    		<div style="float:left;margin-left:50px;">
    			<a href="<?php echo base_url().'admins/cms/toadd_cms/'.$group_id?>">
    				<font class="nav_on">
    					<font class="plus">
    						<font style="float:left;width:14px;height:2px;margin-top:6px;background:white;"></font>
    						<font style="float:left;width:2px;margin-left:-8px;height:14px;background:white;"></font>
    					</font>
    					<span>
    						<?php if($this->langtype == '_ch'){echo '添加景点';}else{echo 'Add Attractions';}?>
    					</span>
    				</font>
    			</a>
    		</div>
		<?php }?>
		<?php if($group_id != 7 && $group_id != 10 && $group_id != 13 && $group_id != 203 && $group_id != 301 && $group_id != 401 && $group_id != 507){?>
				<?php 
					if(isset($_COOKIE[DB_PRE().'listsort'])){
					    $listsort = unserialize($_COOKIE[DB_PRE().'listsort']);
					    $list_iscansort = $listsort['list_iscansort'];
					}else{
					    $list_iscansort = 0;
					}
				?>
				<style>
			         .list_sort_floatright{float:right;}
.list_sort_closed{float:left;cursor:pointer;}
.list_sort_closed img{float:left;width:20px;}
.list_sort_closed .sortname{float:left;margin-left:5px;line-height:20px;}
.list_sort_open{float:left;cursor:pointer;}
.list_sort_open img{float:left;width:20px;}
.list_sort_open .sortname{float:left;margin-left:5px;line-height:20px;color:#008C00;}
.list_sort_loading{display:none;float:left;}
.list_sort_loading img{float:left;width:20px;}
.list_sort_loading .loadingname{float:left;margin-left:5px;line-height:20px;color:gray;}
			        </style>
				<div class="list_sort_floatright">
					<div class="list_sort_closed" onclick="tolistsort_open()" style="<?php if($list_iscansort == 1){echo 'display:none;';}?>">
    					<img src="<?php echo base_url().'themes/default/images/icon_list_sort_close.png';?>"/>
    					<div class="sortname"><?php if($this->langtype == '_ch'){echo '排序已锁定';}else{echo 'Sort Locked';}?></div>
					</div>
					<div class="list_sort_open" onclick="tolistsort_close()" style="<?php if($list_iscansort == 0){echo 'display:none;';}?>">
    					<img src="<?php echo base_url().'themes/default/images/icon_list_sort_open.png';?>"/>
    					<div class="sortname"><?php if($this->langtype == '_ch'){echo '排序已打开';}else{echo 'Sort Open';}?></div>
					</div>
					<div class="list_sort_loading">
    					<img src="<?php echo base_url().'themes/default/images/ajax_loading.gif';?>"/>
    					<div class="loadingname"><?php if($this->langtype == '_ch'){echo '加载中';}else{echo 'Loading';}?></div>
					</div>
				</div>
			<?php }?>
	</div>
<?php }?>
<div style="float:left;width:calc(100% - 20px);background-color:white;padding:10px 10px;border-radius:8px;">
	<table class="gksel_normal_tablist">
		<thead>
			<tr>
				<td width="50" align="center"><?php if($this->langtype == '_ch'){echo '序号';}else{echo 'SN';}?></td>
				<?php if($group_id == 1 || $group_id == 2 || $group_id == 3 || $group_id == 4 || $group_id == 5 || $group_id == 6 || $group_id == 7 || $group_id == 8 || $group_id == 9 || $group_id == 10 || $group_id == 11 || $group_id == 12 || $group_id == 14 || $group_id == 101 || $group_id == 119 || $group_id == 128 || $group_id == 203 || $group_id == 204 || $group_id == 205 || $group_id == 301 || $group_id == 401 || $group_id == 501 || $group_id == 507){?>
					<td width="<?php if($group_id == 7 || $group_id == 204 || $group_id == 205){echo 120;}else{echo 220;}?>" align="center"><p><?php if($this->langtype == '_ch'){echo '图片';}else{echo 'Picture';}?></p></td>
					<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?></p></td>
				<?php }else{?>
					<td><p>&nbsp;&nbsp;&nbsp;<?php if($this->langtype == '_ch'){echo '名称';}else{echo 'Name';}?></p></td>
				<?php }?>
				<?php if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){?>
					<td width="150" align="center"><p><?php if($this->langtype == '_ch'){echo '日期时间';}else{echo 'Date Time';}?></p></td>
				<?php }?>
				<?php if($group_id == 202){?>
					<td width="150" align="center"><p><?php if($this->langtype == '_ch'){echo '下载';}else{echo 'Download';}?></p></td>
				<?php }?>
				<?php if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){?>
					<td width="300" align="center"><p><?php if($this->langtype == '_ch'){echo '语言';}else{echo 'Language';}?></p></td>
				<?php }?>
				<td width="150" align="center"><p><?php if($this->langtype == '_ch'){echo '最后修改时间';}else{echo 'Last Time';}?></p></td>
				<td width="100" align="center"><p><?php if($this->langtype == '_ch'){echo '作者';}else{echo 'Author';}?></p></td>
				<td width="160" align="center"><p><?php if($this->langtype == '_ch'){echo '操作';}else{echo 'Actions';}?></p></td>
			</tr>
		</thead>
	</table>
	<ul id="tasks" style="float:left;width:100%;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
		<?php if(isset($cmslist)){for ($i = 0; $i < count($cmslist); $i++) {?>
			<li class="articlelist" id="<?php echo $cmslist[$i]['cms_id']?>" iid="<?php echo $i+1?>" style="width:100%;padding:0px;margin:0px;list-style-type: none;">
				<table class="gksel_normal_tablist" style="margin-top: 0px;<?php if($cmslist[$i]['status'] == 0){echo 'opacity:0.2;';}?>">
					<tbody>
        				<tr>
        					<td width="50" align="center" style="padding:10px 0px;"><?php echo ($i+1)?></td>
        					<?php if($group_id == 1 || $group_id == 2 || $group_id == 3 || $group_id == 4 || $group_id == 5 || $group_id == 6 || $group_id == 7 || $group_id == 8 || $group_id == 9 || $group_id == 10 || $group_id == 11 || $group_id == 12 || $group_id == 14 || $group_id == 101 || $group_id == 119 || $group_id == 128 || $group_id == 203 || $group_id == 204 || $group_id == 205 || $group_id == 301 || $group_id == 401 || $group_id == 501 || $group_id == 507){?>
        						<td valign="top" width="<?php if($group_id == 7 || $group_id == 204 || $group_id == 205){echo 120;}else{echo 220;}?>" align="center">
        							<?php 
        							if($group_id == 1){
        				    	    		$uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
        				    	    		if($uploadFile1 != ''){
        				    	    			$file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        				    	    			$uploadFile1_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $uploadFile1);
        				    	    		}else{
        				    	    			$uploadFile1_200x200 = '';
        				    	    		}
        				    				if($uploadFile1_200x200 != ''){
        										echo '<img style="float:left;width:200px;height:100px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_200x200.'"/>';
        									}else{
        										echo '<img style="float:left;width:200px;height:100px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        									}
        							}else if($group_id == 11){
        							    $uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
        							    if($uploadFile1 != ''){
        							        $file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        							        $uploadFile1_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $uploadFile1);
        							    }else{
        							        $uploadFile1_200x200 = '';
        							    }
        							    if($uploadFile1_200x200 != ''){
        							        echo '<img style="float:left;width:110px;height:200px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_200x200.'"/>';
        							    }else{
        							        echo '<img style="float:left;width:110px;height:200px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        							    }
        							}else if($group_id == 2 || $group_id == 3 || $group_id == 4 || $group_id == 5 || $group_id == 6 || $group_id == 8 || $group_id == 9 || $group_id == 12){
        							    $uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
        				    	    		if($uploadFile1 != ''){
        				    	    			$file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        				    	    			$uploadFile1_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $uploadFile1);
        				    	    		}else{
        				    	    			$uploadFile1_200x200 = '';
        				    	    		}
        				    				if($uploadFile1_200x200 != ''){
        										echo '<img style="float:left;width:200px;height:66px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_200x200.'"/>';
        									}else{
        										echo '<img style="float:left;width:200px;height:66px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        									}
        							}else if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){
        							    $uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
        							    if($uploadFile1 != ''){
        							        $file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        							        $uploadFile1_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $uploadFile1);
        							    }else{
        							        $uploadFile1_200x200 = '';
        							    }
        							    if($uploadFile1_200x200 != ''){
        							        echo '<img style="float:left;max-width:200px;max-height:200px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_200x200.'"/>';
        							    }else{
        							        echo '<img style="float:left;max-width:200px;max-height:200px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        							    }
        							}else if($group_id == 14){
        							    $uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
        							    if($uploadFile1 != ''){
        							        $file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        							        $uploadFile1_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $uploadFile1);
        							    }else{
        							        $uploadFile1_200x200 = '';
        							    }
        							    if($uploadFile1_200x200 != ''){
        							        echo '<img style="float:left;width:200px;height:112px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_200x200.'"/>';
        							    }else{
        							        echo '<img style="float:left;width:200px;height:112px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        							    }
        							}else if($group_id == 101 || $group_id == 119 || $group_id == 128){
        							    $uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
    							        $file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
    							        $uploadFile1_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $uploadFile1);
        							    if($uploadFile1_800x800 != ''){
        							        echo '<img style="float:left;width:200px;height:250px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_800x800.'"/>';
        							    }else{
        							        echo '<img style="float:left;width:200px;height:250px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        							    }
        							}else if($group_id == 204){
        							    $uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
        							    if($uploadFile1 != ''){
        							        $file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        							        $uploadFile1_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $uploadFile1);
        							    }else{
        							        $uploadFile1_200x200 = '';
        							    }
        							    if($uploadFile1_200x200 != ''){
        							        echo '<img style="float:left;width:100px;height:180px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_200x200.'"/>';
        							    }else{
        							        echo '<img style="float:left;width:100px;height:180px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        							    }
        							}else if($group_id == 205){
        							    $uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
        							    if($uploadFile1 != ''){
        							        $file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        							        $uploadFile1_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $uploadFile1);
        							    }else{
        							        $uploadFile1_200x200 = '';
        							    }
        							    if($uploadFile1_200x200 != ''){
        							        echo '<img style="float:left;width:100px;height:62px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_200x200.'"/>';
        							    }else{
        							        echo '<img style="float:left;width:100px;height:62px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        							    }
        							}else if($group_id == 501){
        							    $uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
        							    $file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        							    $uploadFile1_800x800 = str_replace('.'.$file_type, '_800x800.'.$file_type, $uploadFile1);
        							    if($uploadFile1_800x800 != ''){
        							        echo '<img style="float:left;width:200px;height:300px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_800x800.'"/>';
        							    }else{
        							        echo '<img style="float:left;width:200px;height:300px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        							    }
        							}else if($group_id == 7){?>
        								    <?php
                    								    $pic_maxnum = 5;//最大上传数量
                    								    $ishave_num = 0;
                    								    for($ppp = 0; $ppp < $pic_maxnum; $ppp++){
                    								        $filename = $cmslist[$i]['cms_pic_'.($ppp + 1).'_path'];
                    								        if($filename != ''){
                    								            $ishave_num ++;
                    								        }
                    								    }
                    						?>
                    		    			<div style="float:left;width:100%;height:64px;">
                    			    			<?php for($ppp = 0; $ppp < $pic_maxnum; $ppp++){?>
                    								<?php
                    				    	    		$filename = $cmslist[$i]['cms_pic_'.($ppp + 1).'_path'];
                    				    	    		$filename_arr = explode('.', $filename);
                    				    	    		$file_type = end($filename_arr);
                    				    	    		if($filename != ''){
                    				    	    			$filename_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $filename);
                    				    			?>
                    				    				<div class="cmslist_picture_<?php echo $cmslist[$i]['cms_id']?> cmslist_picture_<?php echo $cmslist[$i]['cms_id']?>_<?php echo ($ppp + 1)?>" style="<?php if($ppp != 0){echo 'display:none;';}?>float:left;width:100%;">
                    						    			<?php if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){?>
                    											<table cellspacing="0" cellpadding="0" style="width:100px;height:64px;border-radius:4px;border:0px;margin:0px;padding:0px;background-color:black;">
                    												<tr>
                    													<td valign="middle" style="border:0px;margin:0px;padding:0px;">
                    														<video id="video" width="100" style="float:left;width:100px;" src="<?php echo CDN_URL().$filename?>" controls></video>
                    													</td>
                    												</tr>
                    											</table>
                    										<?php }else{?>
                    											<img style="width:100px;height:64px;border-radius:4px;" src="<?php echo CDN_URL().$filename_200x200?>"/>
                    										<?php }?>
                    									</div>
                    								<?php }?>
                    							<?php }?>
                    						</div>
                    						<div style="float:left;width:calc(100% - 20px);margin-left:10px;">
                    							<?php if($ishave_num >= 2){?>
                    								<?php for($ppp = 0; $ppp < $pic_maxnum; $ppp++){?>
                    									<?php
                    					    	    		$filename = $cmslist[$i]['cms_pic_'.($ppp + 1).'_path'];
                    					    	    		$filename_arr = explode('.', $filename);
                    					    	    		$file_type = end($filename_arr);
                    					    	    		if($filename != ''){
                    					    	    			$filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                    					    			?>
                    						    			<?php if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){?>
                    											<div onclick="toshowcmspicqiehuan(<?php echo $cmslist[$i]['cms_id']?>, <?php echo ($ppp + 1)?>)" style="cursor:pointer;float:left;width:16px;height:16px;border-radius:2px;border:0px;margin:0px;padding:0px;margin-top:3px;margin-right:3px;background-color:black;">
                    												<img onclick="toshowcmspicqiehuan(<?php echo $cmslist[$i]['cms_id']?>, <?php echo ($ppp + 1)?>)" style="cursor:pointer;float:left;width:16px;height:16px;border-radius:2px;" src="<?php echo CDN_URL().'themes/default/images/icon_video_watermark.png'?>"/>
                    											</div>
                    											
                    										<?php }else{?>
                    											<img onclick="toshowcmspicqiehuan(<?php echo $cmslist[$i]['cms_id']?>, <?php echo ($ppp + 1)?>)" style="cursor:pointer;float:left;width:16px;height:16px;border-radius:2px;margin-top:3px;margin-right:3px;" src="<?php echo CDN_URL().$filename_100x100?>"/>
                    										<?php }?>
                    									<?php }?>
                    								<?php }?>
                    							<?php }?>
                    						</div>
        						
        							<?php }else if($group_id == 301){
        							    $uploadFile1 = $cmslist[$i]['cms_pic_1_path'];
        							    if($uploadFile1 != ''){
        							        $file_type = strtolower ( substr ( strrchr ( $uploadFile1, "." ), 1 ) );
        							        $uploadFile1_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $uploadFile1);
        							    }else{
        							        $uploadFile1_200x200 = '';
        							    }
        							    if($uploadFile1_200x200 != ''){
        							        echo '<img style="float:left;width:200px;height:123px;border-radius:4px;" src="'.CDN_URL().$uploadFile1_200x200.'"/>';
        							    }else{
        							        echo '<img style="float:left;width:200px;height:123px;border-radius:4px;" src="'.CDN_URL().'themes/default/images/none_cms.png"/>';
        							    }
        							}
        							?>
        							
        							<script type="text/javascript">
                                    	function toshowcmspicqiehuan(cms_id, num){
                                    		$('.cmslist_picture_'+cms_id).hide();
                                    		$('.cmslist_picture_'+cms_id+'_'+num).fadeIn(300);
                                    	}
                                    </script>
        						</td>
        						<td valign="top" style="padding-left:0px;padding-right:0px;">
        							<div style="float:left;width: 100%;color:black;font-size:14px;font-weight:bold;">
        								<?php echo actionsearchdaxiaoxiezimu($keyword, $cmslist[$i]['cms_name'.$this->langtype]);?>
            						</div>
            						<?php if($cmslist[$i]['cms_subname'.$this->langtype] != ''){?>
                						<div style="float:left;width: 100%;color:gray;font-size:14px;margin-top:5px;">
            								<?php echo actionsearchdaxiaoxiezimu($keyword, $cmslist[$i]['cms_subname'.$this->langtype]);?>
                						</div>
            						<?php }?>
            						<?php if($group_id == 1 || $group_id == 10 || $group_id == 11 || $group_id == 14 || $group_id == 101 || $group_id == 203 || $group_id == 501 || $group_id == 507 || $group_id == 128){?>
                						<?php if($cmslist[$i]['cms_link'] != ''){?>
            								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;color:#CCC;">
            									<?php 
                									$cmslist[$i]['cms_link'] = str_replace('/en/', '/'.$this->reland.'/', $cmslist[$i]['cms_link']);
                									$cmslist[$i]['cms_link'] = str_replace('/cn/', '/'.$this->reland.'/', $cmslist[$i]['cms_link']);
                									
                									echo debaseurlcontent($cmslist[$i]['cms_link']);
            									?>
            								</div>
        								<?php }?>
    								<?php }?>
    								<?php if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){?>
                						<?php if($cmslist[$i]['short_url'] != ''){?>
            								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;color:#CCC;">
            									<?php echo base_url().$this->reland.'/alumni/news/'.$cmslist[$i]['short_url'];?>
            								</div>
        								<?php }?>
    								<?php }?>
        						</td>
        					<?php }else{?>
        						<td>
        							<div style="float:left;width: 100%;font-weight:bold;">
        								<?php if($group_id == 202){?>
            								<div style="float:left;width: 100%;font-size:16px;fong-weight:bold;">
            									<?php echo actionsearchdaxiaoxiezimu($keyword, $cmslist[$i]['cms_name'.$this->langtype]);?>
            								</div>
        								<?php }else{?>
            								<div style="float:left;width: 100%;">
            									<?php echo actionsearchdaxiaoxiezimu($keyword, $cmslist[$i]['cms_name'.$this->langtype]);?>
            								</div>
        								<?php }?>
                						<?php if($cmslist[$i]['cms_link'] != ''){?>
            								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;color:#CCC;">
            									<?php echo debaseurlcontent($cmslist[$i]['cms_link']);?>
            								</div>
        								<?php }?>
        								<?php if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){?>
                    						<?php if($cmslist[$i]['short_url'] != ''){?>
                								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;color:#CCC;">
                									<?php echo base_url().$this->reland.'/alumni/news/'.$cmslist[$i]['short_url'];?>
                								</div>
            								<?php }?>
        								<?php }?>
        								<?php if($group_id == 202){?>
                    						<?php if($cmslist[$i]['common_type'] == 1){?>
                								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;">
                									<div style="float:left;background-color:blue;color:white;border-radius:4px;line-height:20px;padding:0px 6px;">
                    									<?php if($this->langtype == '_ch'){echo '招生简章';}else if($this->langtype == '_jp'){echo '学生募集要項';}else if($this->langtype == '_sk'){echo '학생모집요강';}else if($this->langtype == '_ru'){echo 'Вступительная брошюра';}else{echo 'Admission Brochure';}?>
                    								</div>
                								</div>
            								<?php }else if($cmslist[$i]['common_type'] == 2){?>
                								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;">
                									<div style="float:left;background-color:#F7B5B7;color:white;border-radius:4px;line-height:20px;padding:0px 6px;">
                    									<?php if($this->langtype == '_ch'){echo '申请材料';}else if($this->langtype == '_jp'){echo '申請書類';}else if($this->langtype == '_sk'){echo '신청서류';}else if($this->langtype == '_ru'){echo 'Документы для поступления';}else{echo 'Application Materials';}?>
                    								</div>
                								</div>
            								<?php }else if($cmslist[$i]['common_type'] == 3){?>
                								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;">
                									<div style="float:left;background-color:orange;color:white;border-radius:4px;line-height:20px;padding:0px 6px;">
                    									<?php if($this->langtype == '_ch'){echo '校内服务';}else if($this->langtype == '_jp'){echo '校内サービス';}else if($this->langtype == '_sk'){echo '교내서비스';}else if($this->langtype == '_ru'){echo 'Обслуживание на территории кампуса';}else{echo 'On-campus Services';}?>
                    								</div>
                								</div>
            								<?php }else if($cmslist[$i]['common_type'] == 4){?>
                								<div style="float:left;width: 100%;font-size:12px;margin-top:5px;">
                									<div style="float:left;background-color:gray;color:white;border-radius:4px;line-height:20px;padding:0px 6px;">
                    									<?php if($this->langtype == '_ch'){echo '其他';}else if($this->langtype == '_jp'){echo 'その他';}else if($this->langtype == '_sk'){echo '기타';}else if($this->langtype == '_ru'){echo 'Другое';}else{echo 'Other';}?>
                    								</div>
                								</div>
            								<?php }?>
        								<?php }?>
        							</div>
        						</td>
        					<?php }?>
        					<?php if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){?>
            					<td width="150" style="padding:10px 0px;" align="center"><?php echo date('Y-m-d H:i', $cmslist[$i]['cms_date_time'])?></td>
            				<?php }?>
            				<?php if($group_id == 202){?>
            					<td width="150" style="padding:10px 0px;" align="center">
            						<?php if($cmslist[$i]['cms_pic_1_path'] != ''){?>
										<a href="<?php echo base_url().$cmslist[$i]['cms_pic_1_path']?>" target="_blank"><img style="width:20px;height:20px;" src="<?php echo base_url().'themes/default/images/icon_download_on.png'?>"/></a>
									<?php }else{?>
										<img style="width:20px;height:20px;-webkit-filter: grayscale(100%);filter: grayscale(100%);opacity:0.5;" src="<?php echo base_url().'themes/default/images/icon_download_on.png'?>"/>
									<?php }?>
								</td>
            				<?php }?>
            				<?php if($group_id == 10 || $group_id == 203 || $group_id == 401 || $group_id == 507){?>
                				<td width="300" align="center" style="padding-left:0px;padding-right:0px;">
    								<?php 
        								if($cmslist[$i]['langtype_en'] == 1){
        								    echo '<div style="float:left;background:#2C82DF;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
        								    if($this->langtype == '_ch'){echo 'English';}else{echo 'English';}
        								    echo '</div>';
        								}
        								if($cmslist[$i]['langtype_ch'] == 1){
        								    echo '<div style="float:left;background:#1ED76D;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
        								    if($this->langtype == '_ch'){echo '中文';}else{echo '中文';}
        								    echo '</div>';
        								}
        								if($cmslist[$i]['langtype_jp'] == 1){
        								    echo '<div style="float:left;background:#FFD766;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
        								    if($this->langtype == '_ch'){echo '日本語';}else{echo '日本語';}
        								    echo '</div>';
        								}
        								if($cmslist[$i]['langtype_sk'] == 1){
        								    echo '<div style="float:left;background:#EF7320;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
        								    if($this->langtype == '_ch'){echo '한국어';}else{echo '한국어';}
        								    echo '</div>';
        								}
        								if($cmslist[$i]['langtype_ru'] == 1){
        								    echo '<div style="float:left;background:#FF2442;color:white;padding:0px 8px;line-height:30px;border-radius:5px;margin-right:5px;">';
        								    if($this->langtype == '_ch'){echo 'Русский';}else{echo 'Русский';}
        								    echo '</div>';
        								}
    								?>
    							</td>
							<?php }?>
        					<td width="150" style="padding:10px 0px;" align="center"><?php echo date('Y-m-d H:i', $cmslist[$i]['edited'])?></td>
        					<td width="100" style="padding:10px 0px;" align="center"><?php echo $cmslist[$i]['edited_author']?></td>
        					<td width="160" style="padding:10px 0px;" align="center">
        						<div style="display:flex;justify-content:center;float:left;width:100%;">
        							<?php 
            							if($group_id == 207){
            							    if($this->langtype == '_ch'){
            							        $btn_name = '添加老师';
            							    }else{
            							        $btn_name = 'Add Teacher';
            							    }
            							    echo '<a href="'.base_url().'admins/cms/toadd_subcms/'.$group_id.'/'.$cmslist[$i]['cms_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.$btn_name.'</a>';
            							}
        							?>
        							<?php 
                                        if($group_id != 13){
        								    echo '<a href="'.base_url().'admins/cms/toedit_cms/'.$group_id.'/'.$cmslist[$i]['cms_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
                                        }
                                        if($group_id == 1 ||  $group_id == 10 || $group_id == 11 || $group_id == 12 || $group_id == 101 || $group_id == 102){
        									echo '<a onclick="todel_cms('.$cmslist[$i]['cms_id'].', \''.$cmslist[$i]['cms_name'.$this->langtype].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
        								}
        							?>
        						</div>
        					</td>
        				</tr>
        				<tr>
                            <td colspan="6" style="padding:0px;margin:0px;border:0px;">
                            	<?php if($group_id == 207){?>
                            		<ul id="tasks_<?php echo $cmslist[$i]['cms_id'];?>" style="float:left;width:100%;padding:0px;margin:0px 0px 0px 0px;list-style-type:none;">
                					<?php 
                					    $con = array('group_id'=>$group_id, 'parent'=>$cmslist[$i]['cms_id'], 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
                					    $subcmslist = $this->CmsModel->getcmslist($con);
                    					
        //             					else if($cmslist[$i]['cms_id'] == 58){
        //             					    $subgroup_id = 105;
        //             					    $con = array('group_id'=>$subgroup_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
        //             					    $subcmslist = $this->CmsModel->getcmslist($con);
        //             					}else if($cmslist[$i]['cms_id'] == 59){
        //             					    $subgroup_id = 106;
        //             					    $con = array('group_id'=>$subgroup_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
        //             					    $subcmslist = $this->CmsModel->getcmslist($con);
        //             					}else if($cmslist[$i]['cms_id'] == 60){
        //             					    $subgroup_id = 107;
        //             					    $con = array('group_id'=>$subgroup_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
        //             					    $subcmslist = $this->CmsModel->getcmslist($con);
        //             					}else if($cmslist[$i]['cms_id'] == 61){
        //             					    $subgroup_id = 108;
        //             					    $con = array('group_id'=>$subgroup_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
        //             					    $subcmslist = $this->CmsModel->getcmslist($con);
        //             					}
                    					
        //             					else if($cmslist[$i]['cms_id'] == 1571){
        //             					    $subgroup_id = 601;
        //             					    $con = array('group_id'=>$subgroup_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
        //             					    $subcmslist = $this->CmsModel->getcmslist($con);
        //             					}else if($cmslist[$i]['cms_id'] == 1572){
        //             					    $subgroup_id = 602;
        //             					    $con = array('group_id'=>$subgroup_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
        //             					    $subcmslist = $this->CmsModel->getcmslist($con);
        //             					}else if($cmslist[$i]['cms_id'] == 1573){
        //             					    $subgroup_id = 603;
        //             					    $con = array('group_id'=>$subgroup_id, 'orderby'=>'a.sort', 'orderby_res'=>'ASC');
        //             					    $subcmslist = $this->CmsModel->getcmslist($con);
        //             					}else{
        //             					    $subcmslist = array();
        //             					}
                					?>
                					<?php if(!empty($subcmslist)){for ($j = 0; $j < count($subcmslist); $j++) {?>
                						<li class="sublist_<?php echo $cmslist[$i]['cms_id'];?>" id="<?php echo $subcmslist[$j]['cms_id']?>" iid="<?php echo $j+1?>" style="width:100%;padding:0px;margin:0px;list-style-type: none;">
                            				<table class="subtablelist gksel_normal_tablist" style="margin-top: 0px;<?php if($subcmslist[$j]['status'] == 0){echo 'opacity:0.2;';}?>">
                                				<tbody>
                                					<tr>
                                    					<td width="150" align="center" style="padding:5px 0px;border:0px;"></td>
                                    					<td valign="top" width="120" align="center">
                                    								    <?php
                                        								    $pic_maxnum = 5;//最大上传数量
                                        								    $ishave_num = 0;
                                        								    for($ppp = 0; $ppp < $pic_maxnum; $ppp++){
                                        								        $filename = $subcmslist[$j]['cms_pic_'.($ppp + 1).'_path'];
                                        								        if($filename != ''){
                                        								            $ishave_num ++;
                                        								        }
                                        								    }
                                        								    
                                        								    if($subcmslist[$j]['parent'] == 4849){
                                        								        $upload_show_width = 100;
                                        								        $upload_show_height = 70;
                                        								    }else{
                                        								        $upload_show_width = 100;
                                        								        $upload_show_height = 100;
                                        								    }
                                                						?>
                                                		    			<div style="float:left;width:100%;height:<?php echo $upload_show_height;?>px;">
                                                			    			<?php for($ppp = 0; $ppp < $pic_maxnum; $ppp++){?>
                                                								<?php
                                                				    	    		$filename = $subcmslist[$j]['cms_pic_'.($ppp + 1).'_path'];
                                                				    	    		$filename_arr = explode('.', $filename);
                                                				    	    		$file_type = end($filename_arr);
                                                				    	    		if($filename != ''){
                                                				    	    			$filename_200x200 = str_replace('.'.$file_type, '_200x200.'.$file_type, $filename);
                                                				    			?>
                                                				    				<div class="cmslist_picture_<?php echo $subcmslist[$j]['cms_id']?> cmslist_picture_<?php echo $subcmslist[$j]['cms_id']?>_<?php echo ($ppp + 1)?>" style="<?php if($ppp != 0){echo 'display:none;';}?>float:left;width:100%;">
                                                						    			<?php if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){?>
                                                											<table cellspacing="0" cellpadding="0" style="width:100px;height:<?php echo $upload_show_height;?>px;border-radius:4px;border:0px;margin:0px;padding:0px;background-color:black;">
                                                												<tr>
                                                													<td valign="middle" style="border:0px;margin:0px;padding:0px;">
                                                														<video id="video" width="100" style="float:left;width:100px;" src="<?php echo CDN_URL().$filename?>" controls></video>
                                                													</td>
                                                												</tr>
                                                											</table>
                                                										<?php }else{?>
                                                											<img style="width:100px;height:<?php echo $upload_show_height;?>px;border-radius:4px;" src="<?php echo CDN_URL().$filename_200x200?>"/>
                                                										<?php }?>
                                                									</div>
                                                								<?php }?>
                                                							<?php }?>
                                                						</div>
                                                						<div style="float:left;width:calc(100% - 20px);margin-left:10px;">
                                                							<?php if($ishave_num >= 2){?>
                                                								<?php for($ppp = 0; $ppp < $pic_maxnum; $ppp++){?>
                                                									<?php
                                                					    	    		$filename = $subcmslist[$j]['cms_pic_'.($ppp + 1).'_path'];
                                                					    	    		$filename_arr = explode('.', $filename);
                                                					    	    		$file_type = end($filename_arr);
                                                					    	    		if($filename != ''){
                                                					    	    			$filename_100x100 = str_replace('.'.$file_type, '_100x100.'.$file_type, $filename);
                                                					    			?>
                                                						    			<?php if($file_type == 'mp4' || $file_type == 'mov' || $file_type == 'm4v'){?>
                                                											<div onclick="toshowcmspicqiehuan(<?php echo $subcmslist[$j]['cms_id']?>, <?php echo ($ppp + 1)?>)" style="cursor:pointer;float:left;width:16px;height:16px;border-radius:2px;border:0px;margin:0px;padding:0px;margin-top:3px;margin-right:3px;background-color:black;">
                                                												<img onclick="toshowcmspicqiehuan(<?php echo $subcmslist[$j]['cms_id']?>, <?php echo ($ppp + 1)?>)" style="cursor:pointer;float:left;width:16px;height:16px;border-radius:2px;" src="<?php echo CDN_URL().'themes/default/images/icon_video_watermark.png'?>"/>
                                                											</div>
                                                											
                                                										<?php }else{?>
                                                											<img onclick="toshowcmspicqiehuan(<?php echo $subcmslist[$j]['cms_id']?>, <?php echo ($ppp + 1)?>)" style="cursor:pointer;float:left;width:16px;height:16px;border-radius:2px;margin-top:3px;margin-right:3px;" src="<?php echo CDN_URL().$filename_100x100?>"/>
                                                										<?php }?>
                                                									<?php }?>
                                                								<?php }?>
                                                							<?php }?>
                                                						</div>
                                    						
                                    							
                                    							<script type="text/javascript">
                                                                	function toshowcmspicqiehuan(cms_id, num){
                                                                		$('.cmslist_picture_'+cms_id).hide();
                                                                		$('.cmslist_picture_'+cms_id+'_'+num).fadeIn(300);
                                                                	}
                                                                </script>
                                    						</td>
                                    						<td valign="top" style="padding-left:0px;padding-right:0px;">
                                    							<div style="float:left;width: 100%;color:black;font-size:14px;font-weight:bold;">
                                    								<?php echo actionsearchdaxiaoxiezimu($keyword, $subcmslist[$j]['cms_name'.$this->langtype]);?>
                                        						</div>
                                        						<?php if($subcmslist[$j]['cms_subname'.$this->langtype] != ''){?>
                                            						<div style="float:left;width: 100%;color:black;font-size:14px;font-weight:bold;">
                                        								<?php echo actionsearchdaxiaoxiezimu($keyword, $subcmslist[$j]['cms_subname'.$this->langtype]);?>
                                            						</div>
                                        						<?php }?>
                                    						</td>
                                    					<td width="150" style="padding:5px 0px;" align="center"><?php echo date('Y-m-d H:i', $subcmslist[$j]['edited'])?></td>
                                    					<td width="100" style="padding:5px 0px;" align="center"><?php echo $subcmslist[$j]['edited_author']?></td>
                                    					<td width="160" style="padding:5px 0px;" align="center">
                                    						<div style="display:flex;justify-content:center;float:left;width:100%;">
                                    							<?php 
                                    								echo '<a href="'.base_url().'admins/cms/toedit_subcms/'.$group_id.'/'.$subcmslist[$j]['cms_id'].'?backurl='.$current_url_encode.'" class="gksel_btn_action_on">'.lang('cy_edit').'</a>';
                                    							
                                    								echo '<a onclick="todel_cms('.$subcmslist[$j]['cms_id'].', \''.$subcmslist[$j]['cms_name'.$this->langtype].'\')" href="javascript:;" class="gksel_btn_action_on">'.lang('cy_delete').'</a>';
                                    							?>
                                    						</div>
                                    					</td>
                                    				</tr>
                                				</tbody>
                                			</table>
                            			</li>
                    				<?php }}?>
                    				</ul>
                    				
                    				<?php 
                                    	if(isset($_COOKIE[DB_PRE().'listsort'])){
                                    	    $listsort = unserialize($_COOKIE[DB_PRE().'listsort']);
                                    	    $list_iscansort = $listsort['list_iscansort'];
                                    	}else{
                                    	    $list_iscansort = 0;
                                    	}
                                    ?>
                                    <?php if($list_iscansort == 1){?>
                                        <script type="text/javascript">
                                        	jQuery(function($) {
                                        		$('.sublist_<?php echo $cmslist[$i]['cms_id'];?>').each(function (){
                                        			var height=$(this).find('.subtablelist').height();
                                        			$(this).css({'height':height+'px'});
                                        		})
                                        		$('#tasks_<?php echo $cmslist[$i]['cms_id'];?>').sortable({
                                        			opacity:0.8,
                                        			revert:true,
                                        			forceHelperSize:true,
                                        			placeholder: 'draggable-placeholder',
                                        			forcePlaceholderSize:true,
                                        			tolerance:'pointer',
                                        			stop: function( event,ui) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
                                        				$(ui.item).css('z-index', 'auto');
                                        				var newsrot=[];
                                        				var idarr=[];
                                        				var i = 0;
                                        				$('.sublist_<?php echo $cmslist[$i]['cms_id'];?>').each(function (){
                                        					i++;
                                        					newsrot.push(i);
                                        					idarr.push($(this).attr('id'));
                                        				})
                                        				$.post(baseurl+'index.php/admins/cms/editcms_sort',{idarr:idarr,newsrot:newsrot},function (data){
                                        					
                                        				})
                                        			},
                                        			scroll: true,
                                        		});
                                        		
                                        	})
                                        </script>
                                    <?php }?>
                				<?php }?>
                            </td>
                        </tr>
        			</tbody>
            	</table>
            </li>
		<?php }}?>
	</ul>
	<?php if($group_id != 7 && $group_id != 10 && $group_id != 13 && $group_id != 203 && $group_id != 301 && $group_id != 401 && $group_id != 507){?>
    	<table class="gksel_normal_tablist" style="margin-top: 10px;margin-bottom: 0px;">
    		<thead>
    			<tr>
    				<td align="left" style="border-top: none;text-indent:15px;line-height:30px;border-bottom:0px;">
        				<?php echo lang('cy_list_dragtips')?>
        				<?php 
        					if($this->langtype == '_ch'){
        					    if($list_iscansort == 1){echo '<span style="color:#008C00;">【排序已打开】</span>';}else{echo '<span style="">【排序已锁定】</span>';}
        					}else{
        					    if($list_iscansort == 1){echo '<span style="color:#008C00;">【Sort Open】</span>';}else{echo '<span style="">【Sort Locked】</span>';}
        					}
        				?>
    				</td>
    			</tr>
    		</thead>
    	</table>
	<?php }?>
</div>
</div>




<?php 
	if(isset($_COOKIE[DB_PRE().'listsort'])){
	    $listsort = unserialize($_COOKIE[DB_PRE().'listsort']);
	    $list_iscansort = $listsort['list_iscansort'];
	}else{
	    $list_iscansort = 0;
	}
?>
<?php if($list_iscansort == 1){?>
    <?php if($group_id != 7 && $group_id != 10 && $group_id != 13 && $group_id != 203 && $group_id != 301 && $group_id != 401 && $group_id != 507){?>
        <script src="<?php echo base_url()?>themes/default/js/jquery-ui-1.10.3.custom.min.js"></script>
        <script type="text/javascript">
        	jQuery(function($) {
        		$('.articlelist').each(function (){
        			var height=$(this).find('table').height();
        			$(this).css({'height':height+'px'});
        		})
        		
        		
        		$('#tasks').sortable({
        			opacity:0.8,
        			revert:true,
        			forceHelperSize:true,
        			placeholder: 'draggable-placeholder',
        			forcePlaceholderSize:true,
        			tolerance:'pointer',
        			start: function() {
        				$("iframe").css("pointer-events", "none");
        			},
        			stop: function( event,ui) {//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved   //组件拖动结束后触发，去除所有的遮罩层
        
        				$("iframe").css("pointer-events", "");
        
        				$(ui.item).css('z-index', 'auto');
        				var newsrot=[];
        				var idarr=[];
        				var i=0;
        				$('.articlelist').each(function (){
        					i++;
        					newsrot.push(i);
        					idarr.push($(this).attr('id'));
        				})
        				$.post(baseurl+'index.php/admins/cms/editcms_sort',{idarr:idarr,newsrot:newsrot},function (data){
        					
        				})
        			},
        			scroll: true,
        		});
        		
        	})
        </script>
    <?php }?>
<?php }?>

<script type="text/javascript">
//删除商品
function todel_cms(id, name){
	var title = '<?php if($this->langtype == '_ch'){echo '您确定要删除 ';}else{echo 'Are you sure to delete ';}?><font style="color:red;">【'+name+'】</font><?php if($this->langtype == '_ch'){echo '吗？';}else{echo '?';}?>';
	var subtitle = '';
	del_url = encodeURI(baseurl+"index.php/admins/cms/del_cms/"+id);
	todel(title, subtitle);
}
							
</script>
<?php $this->load->view('admin/common_footer')?>