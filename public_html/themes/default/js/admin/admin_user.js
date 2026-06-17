	//删除用户
	function todel_user(id, name){
		var title = '您确定要删除用户<font style="color:red;">【'+name+'】</font>吗？';
		var subtitle = '将会删除该用户和该用户相关的内容';
		del_url = encodeURI(baseurl+"index.php/admins/user/del_user/"+id);
		todel(title, subtitle);
	}
	//删除管理员助手
	function todel_adminassistant(id, name){
		var title = '您确定要删除管理员助手<font style="color:red;">【'+name+'】</font>吗？';
		var subtitle = '';
		del_url = encodeURI(baseurl+"index.php/admins/user/del_adminassistant/"+id);
		todel(title, subtitle);
	}
	
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
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//用户信息
			var admin_username = $('input[name="admin_username"]').val();
			var admin_phone = $('input[name="admin_phone"]').val();
			var admin_email = $('input[name="admin_email"]').val();
			var admin_sex = $('input[name="admin_sex"]').val();
			var ispass=1;
			//验证姓名
			if(isNull.test(admin_username)){ispass=0;$('input[name="admin_username"]').next().append(ajax_returnrequiredorerror_BOX('用户名不能为空'));}else{$('input[name="admin_username"]').next().find('.requestbox').remove();}
			//验证联系人手机号码
			if(isNull.test(admin_phone)){ispass = 0;$('input[name="admin_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));}else{if(isPhone(admin_phone)==false){ispass = 0;$('input[name="admin_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式错误'));}else{$('input[name="admin_phone"]').next().find('.requestbox').remove();}}
			if(isNull.test(admin_email)){ispass = 0;$('input[name="admin_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱不能为空'));}else{if(isEmail(admin_email)==false){ispass = 0;$('input[name="admin_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱格式错误'));}else{$('input[name="admin_email"]').next().find('.requestbox').remove();}}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/user/add_adminassistant/'+admin_type, {
					//返回url
					backurl: backurl,
					//用户信息
					admin_username: admin_username,
					admin_phone: admin_phone,
					admin_email: admin_email
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
//					isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	
	
	//管理员助手信息---保存
	function tosave_admininfo(admin_type, admin_id){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_admininfo('+admin_type+', '+admin_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//用户信息
			var admin_username = $('input[name="admin_username"]').val();
			var admin_phone = $('input[name="admin_phone"]').val();
			var admin_email = $('input[name="admin_email"]').val();
			var admin_sex = $('input[name="admin_sex"]').val();
			
			var ispass=1;
			//验证姓名
			if(isNull.test(admin_username)){ispass=0;$('input[name="admin_username"]').next().append(ajax_returnrequiredorerror_BOX('用户名不能为空'));}else{$('input[name="admin_username"]').next().find('.requestbox').remove();}
			//验证联系人手机号码
			if(isNull.test(admin_phone)){ispass = 0;$('input[name="admin_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));}else{if(isPhone(admin_phone)==false){ispass = 0;$('input[name="admin_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式错误'));}else{$('input[name="admin_phone"]').next().find('.requestbox').remove();}}
			if(isNull.test(admin_email)){ispass = 0;$('input[name="admin_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱不能为空'));}else{if(isEmail(admin_email)==false){ispass = 0;$('input[name="admin_email"]').next().append(ajax_returnrequiredorerror_BOX('邮箱格式错误'));}else{$('input[name="admin_email"]').next().find('.requestbox').remove();}}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/user/edit_adminassistant/'+admin_type+'/'+admin_id, {
					//返回url
					backurl: backurl,
					//用户信息
					admin_username: admin_username,
					admin_phone: admin_phone,
					admin_email: admin_email,
					admin_sex: admin_sex
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
//					isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	//用户信息---助理---保存
	function toadd_assistantinfo(user_type, parent){
		
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_assistantinfo('+user_type+', '+parent+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			var ispass=1;
			//用户信息
			var user_nickname = $('input[name="user_nickname"]').val();
			var user_realname = $('input[name="user_realname"]').val();
			var user_phone = $('input[name="user_phone"]').val();
			var user_email = $('input[name="user_email"]').val();
			var user_profile = $('textarea[name="user_profile"]').val();
			
			//验证姓名
			if(isNull.test(user_realname)){ispass=0;$('input[name="user_realname"]').next().append(ajax_returnrequiredorerror_BOX('姓名不能为空'));}else{$('input[name="user_realname"]').next().find('.requestbox').remove();}
			//验证手机号码
			if(isNull.test(user_phone)){ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));}else{if(isPhone(user_phone)){$('input[name="user_phone"]').next().find('.requestbox').remove();}else{ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式错误'));}}
		
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/user/add_assistant/'+user_type+'/'+parent, {
					//返回url
					backurl: backurl,
					//用户信息
					user_nickname: user_nickname,
					user_realname: user_realname,
					user_phone: user_phone,
					user_email: user_email,
					user_profile: user_profile
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
					location.href = baseurl+'index.php/admins/user/assistant_list/'+user_type+'/'+parent+'?backurl='+backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
			
		}
	}
	//用户信息---助理---保存
	function tosave_assistantinfo(user_type, parent, uid){
		
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_assistantinfo('+user_type+', '+parent+', '+uid+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			var ispass=1;
			//用户信息
			var user_nickname = $('input[name="user_nickname"]').val();
			var user_realname = $('input[name="user_realname"]').val();
			var user_phone = $('input[name="user_phone"]').val();
			var user_email = $('input[name="user_email"]').val();
			var user_profile = $('textarea[name="user_profile"]').val();
			
			//验证姓名
			if(isNull.test(user_realname)){ispass=0;$('input[name="user_realname"]').next().append(ajax_returnrequiredorerror_BOX('姓名不能为空'));}else{$('input[name="user_realname"]').next().find('.requestbox').remove();}
			//验证手机号码
			if(isNull.test(user_phone)){ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码不能为空'));}else{if(isPhone(user_phone)){$('input[name="user_phone"]').next().find('.requestbox').remove();}else{ispass=0;$('input[name="user_phone"]').next().append(ajax_returnrequiredorerror_BOX('手机号码格式错误'));}}
		
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/user/edit_assistant/'+user_type+'/'+parent+'/'+uid, {
					//返回url
					backurl: backurl,
					//用户信息
					user_nickname: user_nickname,
					user_realname: user_realname,
					user_phone: user_phone,
					user_email: user_email,
					user_profile: user_profile
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
					location.href = baseurl+'index.php/admins/user/assistant_list/'+user_type+'/'+parent+'?backurl='+backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
			
		}
	}
	
	
	//填写客户首付款
	function topluspoint_order(id){
		var title = '您正在<font style="color:red;">添加</font>积分';
		
		var subtitle = '';
		del_url = id;
		
		$('.gksel_pluspoint_content .title').html(title);
		$('.gksel_pluspoint_content .subtitle').html(subtitle);
		$('.gksel_pluspoint_box_bg, .gksel_pluspoint_box').fadeIn(800);
	}
	//填写客户首付款----处理程序
	function pluspoint_order(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="pluspoint_order()"]');
			
			//ajax正在保存中
			isajaxsaveing = 1;
			//将提交按钮设置为保存中
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>提交中...</span>');
			
			var point = $('input[name="plus_point"]').val();
			var point_desc = $('textarea[name="plus_point_desc"]').val();
			
			var ispass=1;
			if(isNull.test(point)){
				ispass = 0;
				$('input[name="plus_point"]').next().append(ajax_returnrequiredorerror_BOX('分数不能为空'));
			}else{
				if(!isNaN(point)){
					$('input[name="plus_point"]').next().find('.requestbox').remove();
				}else{
					ispass = 0;
					$('input[name="plus_point"]').next().append(ajax_returnrequiredorerror_BOX('分数格式错误'));
				}
			}
			if(isNull.test(point_desc)){
				ispass = 0;
				$('textarea[name="plus_point_desc"]').next().append(ajax_returnrequiredorerror_BOX('说明不能为空'));
			}else{
				$('textarea[name="plus_point_desc"]').next().find('.requestbox').remove();
			}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/user/pluspoint/'+del_url, {
					point: point,
					point_desc: point_desc
				},function (data){
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>提交成功</span>');
					location.href = currenturl;
				})
			}else{
				actionsubmit_button.html('提交');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	//填写客户首付款 ---- 关闭
	function toclose_pluspointbox(){
		$('.gksel_pluspoint_box_bg, .gksel_pluspoint_box').fadeOut(800);
	}
	
	//填写客户付尾款
	function tominuspoint_order(id){
		var title = '您正在<font style="color:red;">减少</font>积分';
		
		var subtitle = '';
		del_url = id;
		
		$('.gksel_minuspoint_content .title').html(title);
		$('.gksel_minuspoint_content .subtitle').html(subtitle);
		$('.gksel_minuspoint_box_bg, .gksel_minuspoint_box').fadeIn(800);
	}
	//填写客户付尾款----处理程序
	function minuspoint_order(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="minuspoint_order()"]');
			
			//ajax正在保存中
			isajaxsaveing = 1;
			//将提交按钮设置为保存中
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>提交中...</span>');
			
			var point = $('input[name="minus_point"]').val();
			var point_desc = $('textarea[name="minus_point_desc"]').val();
			var ispass=1;
			if(isNull.test(point)){
				ispass = 0;
				$('input[name="minus_point"]').next().append(ajax_returnrequiredorerror_BOX('分数不能为空'));
			}else{
				if(!isNaN(point)){
					$('input[name="minus_point"]').next().find('.requestbox').remove();
				}else{
					ispass = 0;
					$('input[name="minus_point"]').next().append(ajax_returnrequiredorerror_BOX('分数格式错误'));
				}
			}
			if(isNull.test(point_desc)){
				ispass = 0;
				$('textarea[name="minus_point_desc"]').next().append(ajax_returnrequiredorerror_BOX('说明不能为空'));
			}else{
				$('textarea[name="minus_point_desc"]').next().find('.requestbox').remove();
			}
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/user/minuspoint/'+del_url, {
					point: point,
					point_desc: point_desc
				},function (data){
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>提交成功</span>');
					location.href = currenturl;
				})
			}else{
				actionsubmit_button.html('提交');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	//填写客户付尾款 ---- 关闭
	function toclose_minuspointbox(){
		$('.gksel_minuspoint_box_bg, .gksel_minuspoint_box').fadeOut(800);
	}
	
	
	
	
	
	
	
	
	
	
	//用户信息---保存
	function tosave_userpointsetting(pointsetting_id){
		
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_userpointsetting('+pointsetting_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			var ispass=1;
			//用户信息
			var pointsetting_value = $('input[name="pointsetting_value"]').val();
			if(isNull.test(pointsetting_value)){
				ispass=0;
				$('input[name="pointsetting_value"]').next().append(ajax_returnrequiredorerror_BOX('积分不能为空'));
			}else{
				if(isIntval(pointsetting_value)){
					$('input[name="pointsetting_value"]').next().find('.requestbox').remove();
				}else{
					ispass=0;
					$('input[name="pointsetting_value"]').next().append(ajax_returnrequiredorerror_BOX('积分格式错误'));
				}
			}
				
				if(ispass == 1){
					$.post(baseurl+'index.php/admins/user/edit_pointsetting/'+pointsetting_id, {
						//返回url
						backurl: backurl,
						//用户信息
						pointsetting_value: pointsetting_value
					},function (data){
						var obj = eval( "(" + data + ")" );
						actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
						location.href = obj.backurl;
					})
				}else{
					actionsubmit_button.attr('class', 'gksel_btn_action_on');
					actionsubmit_button.html('保存');
					isajaxsaveing = 0;//ajax正在保存中 --- 释放
				}
			
			
		}
	}