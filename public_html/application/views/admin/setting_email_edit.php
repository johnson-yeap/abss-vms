<?php $this->load->view('admin/common_header')?>
<?php $lancodelist = getlancodelist();?>



<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/lang/zh-cn/zh-cn.js"></script>
<!--以下两行加载秀米的ueditor插件的脚本和CSS，请编辑您的UEditor网页加入他们-->
<!--您也可以下载这两个文件并根据您的需要改动相关的内容，当然，改动后您必须将新文件存放到您的服务器上了-->
<!--
<script type="text/javascript" charset="utf-8" src="<?php echo base_url()?>ueditor/xiumi-ue-dialog-v5.js"></script>
<link rel="stylesheet" href="https://xiumi.us/connect/ue/v5/xiumi-ue-v5.css">
-->
<style type="text/css">
	.logo40{vertical-align: middle;}
	.tn-footer{font-size: 0.9em;}
	html, body{font-size:12px;}
</style>

<form method="post">
	<table class="gksel_normal_tabpost">
		<tr>
			<td align="right">Parameters</td>
			<td>
				<div style="float:left;border:1px solid #ccc;width:720px;padding:10px 10px 10px 10px;">
					<?php 
    					$parameter=$emailinfo['email_parameter'];
    					if($parameter!=""){
    						$parameter=unserialize($parameter);
    					}else{
    						$parameter=array();
    					}
    					if(!empty($parameter)){
    						for($i=0;$i<count($parameter);$i++){
    							echo '<div style="float:left;width:180px;line-height:30px;">'.$parameter[$i].'</div>';
    						}
    					}
					?>
				</div>
			</td>
		</tr>
		
		<tr>
			<td align="right">From</td>
			<td>
				<input type="text" name="email_from" value="<?php echo $emailinfo['email_from'];?>"/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right">Sender</td>
			<td>
				<input type="text" name="email_sender" value="<?php echo $emailinfo['email_sender'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">Reply to </td>
			<td><input type="text" name="email_replyto" id="email_replyto" value="<?php echo $emailinfo['email_replyto'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">To </td>
			<td><input type="text" name="email_to" id="email_to" value="<?php echo $emailinfo['email_to'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">CC </td>
			<td>
				<input type="text" name="email_cc" id="email_cc" value="<?php echo $emailinfo['email_cc'];?>"/>
			</td>
		</tr>
		<tr>
			<td align="right">BCC </td>
			<td>
				<input type="text" name="email_bcc" id="email_bcc" value="<?php echo $emailinfo['email_bcc'];?>"/>
			</td>
		</tr>
		
		<tr>
			<td></td>
			<td>
				<style>
		          .langcheckarea{display:none;float:left;width:100%;}
		          .langcheckarea .langcheck{cursor:pointer;float:left;width:80px;text-align:center;line-height:30px;padding:0px 10px;border-radius:4px;margin-right:10px;margin-bottom:10px;}
		        </style>
				<div class="langcheckarea">
    				<div class="langcheck"><input name="langtype_en" onclick="getfirstopenlanguage()" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked/></div>
    				<div class="langcheck"><input name="langtype_ch" onclick="getfirstopenlanguage()" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked/></div>
    				<div class="langcheck"><input name="langtype_jp" onclick="getfirstopenlanguage()" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked/></div>
    				<div class="langcheck"><input name="langtype_sk" onclick="getfirstopenlanguage()" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked/></div>
    				<div class="langcheck"><input name="langtype_ru" onclick="getfirstopenlanguage()" type="checkbox" defaultvalue="0" class="mgc-switch" value="1" checked/></div>
				</div>
				
				<style>
		          .langactionarea{float:left;width:100%;}
		          .langactionarea .langaction{cursor:pointer;float:left;width:80px;text-align:center;line-height:30px;padding:0px 10px;border-radius:4px;margin-right:10px;margin-bottom:10px;}
		          .langactionarea .langaction_off{background:rgba(163, 32, 53, 0.3);color:white;}
		          .langactionarea .langaction_on{background:#F7B5B7;color:white;}
		        </style>
		        <script>
					function ontochooselan(lang){
						$('.alllanbody').hide();
						$('.lanbody'+lang).show();

						$('.langaction').removeClass('langaction_on').addClass('langaction_off');
						$('div[onclick="ontochooselan(\''+lang+'\')"]').removeClass('langaction_off').addClass('langaction_on');
					}
					//获取第一个打开的语言
					function getfirstopenlanguage(){
						var langtype_en = $('input[name="langtype_en"]:checked').val();
						if(langtype_en == undefined){langtype_en = 0;}
						
						var langtype_ch = $('input[name="langtype_ch"]:checked').val();
						if(langtype_ch == undefined){langtype_ch = 0;}

						var langtype_jp = $('input[name="langtype_jp"]:checked').val();
						if(langtype_jp == undefined){langtype_jp = 0;}

						var langtype_sk = $('input[name="langtype_sk"]:checked').val();
						if(langtype_sk == undefined){langtype_sk = 0;}

						var langtype_ru = $('input[name="langtype_ru"]:checked').val();
						if(langtype_ru == undefined){langtype_ru = 0;}


						var firstlanguage = '';
						if(langtype_en == 1){
							firstlanguage = '_en';
						}else if(langtype_ch == 1){
							firstlanguage = '_ch';
						}else if(langtype_jp == 1){
							firstlanguage = '_jp';
						}else if(langtype_sk == 1){
							firstlanguage = '_sk';
						}else if(langtype_ru == 1){
							firstlanguage = '_ru';
						}

						ontochooselan(firstlanguage);//选择第一个语言
					}
				</script>
				<div class="langactionarea">
					<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
    					<div class="langaction <?php if($lancodelist[$lc]['langtype'] == '_en'){echo 'langaction_on';}else{echo 'langaction_off';}?>" onclick="ontochooselan('<?php echo $lancodelist[$lc]['langtype']?>')"><?php echo $lancodelist[$lc]['langname'];?></div>
    				<?php }?>
				</div>
			</td>
		</tr>
		
		<?php for ($lc = 0; $lc < count($lancodelist); $lc++) {?>
			<tbody class="alllanbody lanbody<?php echo $lancodelist[$lc]['langtype'];?>" <?php if($lancodelist[$lc]['langtype'] != '_en'){echo 'style="display:none;"';}?>>
    			<tr>
    				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '主题';}else{echo 'Subject';}?> <?php //if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
    				<td align="left">
    					<div style="float:left;">
        					<input type="text" name="email_subject<?php echo $lancodelist[$lc]['langtype']?>" style="width:300px;" value="<?php echo $emailinfo['email_subject'.$lancodelist[$lc]['langtype']]?>"/>
        					<div class="tipsgroupbox"><div class="request"></div></div>
    					</div>
    				</td>
    			</tr>
    			<tr>
    				<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '描述';}else{echo 'Description';}?> <?php //if(count($lancodelist) != 1){echo '('.$lancodelist[$lc]['langname'].')';}?></td>
    				<td align="left">
    					<?php 
    					    $email_content = debaseurlcontent($emailinfo['email_content'. $lancodelist[$lc]['langtype']]);
        					$email_content = str_replace('src="upfiles/', 'src="'.base_url().'upfiles/', $email_content);
        					$email_content = str_replace('newsite/', '', $email_content);
    					?>
    					<script id="email_content<?php echo $lancodelist[$lc]['langtype']?>" type="text/plain" style="width:800px;height:300px;"><?php echo $email_content;?></script>
    					<script type="text/javascript">
    						var email_content<?php echo $lancodelist[$lc]['langtype']?> = UE.getEditor('email_content<?php echo $lancodelist[$lc]['langtype']?>');
    					</script>
    				</td>
    			</tr>
    			<tr>
    				<td colspan="2">
    					<div style="float: left;width:100%;border-top:1px solid #ccc;margin:15px 0px;"></div>
    				</td>
    			</tr>
    		</tbody>
		<?php }?>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="tosave_emailinfo(<?php echo $emailinfo['email_id']?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
	<script type="text/javascript">
    	//获取第一个打开的语言
		getfirstopenlanguage();
	</script>
</form>
<script type="text/javascript">

//1、window.location.href(设置或获取整个 URL 为字符串)
var jsurl_fullurl = window.location.href;
//返回：http://i.cnblogs.com/EditPosts.aspx?opt=1

//2、window.location.protocol(设置或获取 URL 的协议部分)
var jsurl_protocol = window.location.protocol;
//返回：http:

//3、window.location.host(设置或获取 URL 的主机部分)
var jsurl_host = window.location.host;
//返回：i.cnblogs.com

var jsurl_sp = jsurl_fullurl.split(jsurl_host);

var jsurl_sp2 = jsurl_sp[1];
jsurl_sp2 = jsurl_sp2.split('/');
if(jsurl_sp2[1] != 'admins' && jsurl_sp2[1] != 'index.php'){
	var project_name = jsurl_sp2[1]+'/';
}else{
	var project_name = '';
}
var jsurl_baseurl = jsurl_protocol+'//'+jsurl_host+'/'+project_name;


//商品子分类---保存
function tosave_emailinfo(email_id){
	var lancodelist = getlancodelist();
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="tosave_emailinfo('+email_id+')"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('class', 'gksel_btn_action_off');
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span><?php if($this->langtype == '_ch'){echo '保存中...';}else{{echo 'Loading...';}}?></span>');
		
		//----定义的字段------START
			var GETOBJ = [];
			var GETOBJ_num = 0;
			GETOBJ[GETOBJ_num] = new Array();
			GETOBJ[GETOBJ_num]['field_name'] = 'email_from';
			GETOBJ[GETOBJ_num]['field_realname'] = 'email_from';
			GETOBJ[GETOBJ_num]['field_type'] = "input";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

			GETOBJ_num = GETOBJ_num + 1;
			GETOBJ[GETOBJ_num] = new Array();
			GETOBJ[GETOBJ_num]['field_name'] = 'email_sender';
			GETOBJ[GETOBJ_num]['field_realname'] = 'email_sender';
			GETOBJ[GETOBJ_num]['field_type'] = "input";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

			GETOBJ_num = GETOBJ_num + 1;
			GETOBJ[GETOBJ_num] = new Array();
			GETOBJ[GETOBJ_num]['field_name'] = 'email_replyto';
			GETOBJ[GETOBJ_num]['field_realname'] = 'email_replyto';
			GETOBJ[GETOBJ_num]['field_type'] = "input";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

			GETOBJ_num = GETOBJ_num + 1;
			GETOBJ[GETOBJ_num] = new Array();
			GETOBJ[GETOBJ_num]['field_name'] = 'email_to';
			GETOBJ[GETOBJ_num]['field_realname'] = 'email_to';
			GETOBJ[GETOBJ_num]['field_type'] = "input";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

			GETOBJ_num = GETOBJ_num + 1;
			GETOBJ[GETOBJ_num] = new Array();
			GETOBJ[GETOBJ_num]['field_name'] = 'email_cc';
			GETOBJ[GETOBJ_num]['field_realname'] = 'email_cc';
			GETOBJ[GETOBJ_num]['field_type'] = "input";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = '';

			GETOBJ_num = GETOBJ_num + 1;
			GETOBJ[GETOBJ_num] = new Array();
			GETOBJ[GETOBJ_num]['field_name'] = 'email_bcc';
			GETOBJ[GETOBJ_num]['field_realname'] = 'email_bcc';
			GETOBJ[GETOBJ_num]['field_type'] = "input";
			GETOBJ[GETOBJ_num]['field_CMNAME'] = '';
		//----定义的字段------END
		
		//----定义多语言的字段------START
			var GETLANGOBJ = new Array();
			var GETLANGOBJ_num = 0;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'email_subject';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "input";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '';

			GETLANGOBJ_num = GETLANGOBJ_num + 1;
			GETLANGOBJ[GETLANGOBJ_num] = new Array();
			GETLANGOBJ[GETLANGOBJ_num]['field_name'] = 'email_content';
			GETLANGOBJ[GETLANGOBJ_num]['field_type'] = "ueditor";
			GETLANGOBJ[GETLANGOBJ_num]['field_CMNAME'] = '';
		//----定义多语言的字段------END
		
		var returnOBJ = checkjsformcontent(lancodelist, GETOBJ, GETLANGOBJ);//----定义字段变量, 检查是否为空或格式错误------START
		var postOBJ = returnOBJ.postOBJ;
		postOBJ.backurl = backurl;
		postOBJ.GETOBJ = returnOBJ.GETOBJ_arr;
		postOBJ.GETOBJ_type = returnOBJ.GETOBJ_type_arr;
		postOBJ.GETOBJ_realname = returnOBJ.GETOBJ_realname_arr;
		postOBJ.GETLANGOBJ = returnOBJ.GETLANGOBJ_arr;

		$('.requestbox').click(function() {
	        $(this).remove();
	    });
		
		if(returnOBJ.ispass == 1){
			$.post(baseurl+'index.php/admins/email/edit_email/'+email_id, postOBJ, function (data){
				var obj = eval( "(" + data + ")" );
				actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span><?php if($this->langtype == '_ch'){echo '保存成功';}else{echo 'Success';}?></span>');
				location.href = obj.backurl;
			})
		}else{
			actionsubmit_button.attr('class', 'gksel_btn_action_on');
			actionsubmit_button.html('<?php if($this->langtype == '_ch'){echo '保存';}else{echo 'Save';}?>');
			isajaxsaveing = 0;//ajax正在保存中 --- 释放

			$('.requestbox').eq(0).each(function (){
				var togoto_top = parseInt($(this).offset().top);
		    	$('html, body').stop().animate({
		            scrollTop: (togoto_top - 0 - 2)
		        }, 1000);
			})
		}
	}
}


</script>
<?php $this->load->view('admin/common_footer')?>