<?php $this->load->view('admin/common_header')?>

<script type="text/javascript" src='<?php echo CDN_URL();?>themes/default/js/admin/admin_user.js?date=<?php echo CACHE_USETIME()?>'></script>
	
<form method="post">
	<table class="gksel_normal_tabpost">
		<tr><td colspan="2"></td></tr>
		<tr>
			<td align="right" width="150"><?php echo lang('dz_user_username')?></td>
			<td align="left">
				<input type="text" name="admin_username" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '姓名';}else{echo 'Name';}?></td>
			<td align="left">
				<input type="text" name="admin_realname" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('dz_user_email')?></td>
			<td align="left">
				<input type="text" name="admin_email" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php echo lang('dz_user_phone')?></td>
			<td align="left">
				<input type="text" name="admin_phone" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '角色';}else{echo 'Roles';}?></td>
			<td align="left">
				<?php if($admin_type == 2){?>
					<?php if($this->langtype == '_ch'){echo '管理员助理';}else{echo 'Admin Assistant';}?>
				<?php }else{?>
					<?php if($this->langtype == '_ch'){echo 'Article Editor';}else{echo 'Article Editor';}?>
				<?php }?>
			</td>
		</tr>
		<tr style="display:none;">
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '角色';}else{echo 'Roles';}?></td>
			<td align="left">
				<div style="float:left;line-height:20px;">
					<input type="radio" name="rules_id" id="rules_id_1" value="1" class="mgr mgr-success mgr-lg" checked/>
					<label for="rules_id_1" style=""><?php if($this->langtype == '_ch'){echo '内容及管理';}else{echo 'Content and management';}?></label>
				</div>
				
				<div style="float:left;line-height:20px;margin-left:10px;">
					<input type="radio" name="rules_id" id="rules_id_2" value="2" class="mgr mgr-success mgr-lg" />
					<label for="rules_id_2" style=""><?php if($this->langtype == '_ch'){echo '订单管理';}else{echo 'Order management';}?></label>
				</div>
			</td>
		</tr>
		<tr>
			<td align="right" width="150"><?php if($this->langtype == '_ch'){echo '密码';}else{echo 'Password';}?></td>
			<td align="left">
				<input type="text" onfocus="this.type='password'" name="admin_password" value=""/>
				<div class="tipsgroupbox"><div class="request">*</div></div>
			</td>
		</tr>
		<tr>
			<td>
				<input name="backurl" type="hidden" value="<?php echo $backurl;?>"/>
			</td>
			<td align="left">
				<div class="gksel_btn_action_on" onclick="toadd_admininfo(<?php echo $admin_type;?>)"><?php echo lang('cy_save')?></div>
			</td>
		</tr>
	</table>
</form>

<script>
//管理员助手信息---保存
function toadd_admininfo(admin_type){
	if(isajaxsaveing == 0){
		//具体点击的按钮
		actionsubmit_button = $('div[onclick="toadd_admininfo('+admin_type+')"]');
		//ajax正在保存中
		isajaxsaveing = 1;
		//返回url
		var backurl = $('input[name="backurl"]').val();
		//将提交按钮设置为保存中
		actionsubmit_button.attr('class', 'gksel_btn_action_off');
		actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span><?php if($this->langtype == '_ch'){echo '保存中...';}else{echo 'Loading...';}?></span>');
		
		//用户信息
		var admin_username = $('input[name="admin_username"]').val();
		var admin_realname = $('input[name="admin_realname"]').val();
		var admin_phone = $('input[name="admin_phone"]').val();
		var admin_email = $('input[name="admin_email"]').val();
		var admin_password = $('input[name="admin_password"]').val();
		var rules_id = $('input[name="rules_id"]:checked').val();
		if(rules_id == undefined){
			rules_id = 1;
		}
		var ispass = 1;
		//验证姓名
		if(isNull.test(admin_username)){ispass=0;$('input[name="admin_username"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '用户名不能为空';}else{echo 'Username cannot be empty';}?>'));}else{$('input[name="admin_username"]').next().find('.requestbox').remove();}
		if(isNull.test(admin_realname)){ispass=0;$('input[name="admin_realname"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '用户名不能为空';}else{echo 'Username cannot be empty';}?>'));}else{$('input[name="admin_realname"]').next().find('.requestbox').remove();}
		//验证联系人手机号码
		if(isNull.test(admin_phone)){ispass = 0;$('input[name="admin_phone"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '手机号码不能为空';}else{echo 'Phone cannot be empty';}?>'));}else{if(isPhone(admin_phone)==false){ispass = 0;$('input[name="admin_phone"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '手机号码格式错误';}else{echo 'Phone format error';}?>'));}else{$('input[name="admin_phone"]').next().find('.requestbox').remove();}}
		if(isNull.test(admin_email)){ispass = 0;$('input[name="admin_email"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '邮箱不能为空';}else{echo 'Email cannot be empty';}?>'));}else{if(isEmail(admin_email)==false){ispass = 0;$('input[name="admin_email"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '邮箱格式错误';}else{echo 'Email format error';}?>'));}else{$('input[name="admin_email"]').next().find('.requestbox').remove();}}
		if(isNull.test(admin_password)){ispass = 0;$('input[name="admin_password"]').next().append(ajax_returnrequiredorerror_BOX('<?php if($this->langtype == '_ch'){echo '密码不能为空';}else{echo 'Password cannot be empty';}?>'));}else{$('input[name="admin_password"]').next().find('.requestbox').remove();}
		
		if(ispass == 1){
			$.post(baseurl+'index.php/admins/user/add_adminassistant/'+admin_type, {
				//返回url
				backurl: backurl,
				//用户信息
				admin_username: admin_username,
				admin_realname: admin_realname,
				admin_phone: admin_phone,
				admin_email: admin_email,
				admin_password: admin_password,
				rules_id: rules_id
			},function (data){
				var obj = eval( "(" + data + ")" );
				actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span><?php if($this->langtype == '_ch'){echo '保存成功';}else{echo 'Success';}?></span>');
//				isajaxsaveing = 0;//ajax正在保存中 --- 释放
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