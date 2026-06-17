	//删除兑换特色专业
	function todel_cms(id, name){
		var title = '您确定要删除商品<font style="color:red;">【'+name+'】</font>吗？';
		var subtitle = '';
		del_url = encodeURI(baseurl+"index.php/admins/cms/del_cms/"+id);
		todel(title, subtitle);
	}
	//兑换特色专业信息---添加
	function toadd_cmsinfo(){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_cmsinfo()"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//兑换特色专业信息
			var cms_name_en = $('input[name="cms_name_en"]').val();
			var cms_name_ch = $('input[name="cms_name_ch"]').val();
			
			var cms_description_en = CKEDITOR.instances.cms_description_en.getData();
			var cms_description_ch = CKEDITOR.instances.cms_description_ch.getData();
			
			var ispass=1;
			if(isNull.test(cms_name_en)){ispass=0;$('input[name="cms_name_en"]').next().append(ajax_returnrequiredorerror_BOX('商品名称不能为空'));}else{$('input[name="cms_name_en"]').next().find('.requestbox').remove();}
			if(isNull.test(cms_name_ch)){ispass=0;$('input[name="cms_name_ch"]').next().append(ajax_returnrequiredorerror_BOX('商品名称不能为空'));}else{$('input[name="cms_name_ch"]').next().find('.requestbox').remove();}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/cms/add_cms', {
					//返回url
					backurl: backurl,
					//商品信息
					cms_name_en: cms_name_en,
					cms_name_ch: cms_name_ch,
					
					cms_description_en: cms_description_en,
					cms_description_ch: cms_description_ch					
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
	//				isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	//兑换特色专业信息---保存
	function tosave_cmsinfo(cms_id){
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_cmsinfo('+cms_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//兑换特色专业信息
			var cms_name_en = $('input[name="cms_name_en"]').val();
			var cms_name_ch = $('input[name="cms_name_ch"]').val();
			
			var cms_description_en = CKEDITOR.instances.cms_description_en.getData();
			var cms_description_ch = CKEDITOR.instances.cms_description_ch.getData();
			
			var ispass=1;
			if(isNull.test(cms_name_en)){ispass=0;$('input[name="cms_name_en"]').next().append(ajax_returnrequiredorerror_BOX('商品名称不能为空'));}else{$('input[name="cms_name_en"]').next().find('.requestbox').remove();}
			if(isNull.test(cms_name_ch)){ispass=0;$('input[name="cms_name_ch"]').next().append(ajax_returnrequiredorerror_BOX('商品名称不能为空'));}else{$('input[name="cms_name_ch"]').next().find('.requestbox').remove();}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/cms/edit_cms/'+cms_id, {
					//返回url
					backurl: backurl,
					//商品信息
					cms_name_en: cms_name_en,
					cms_name_ch: cms_name_ch,
					
					cms_description_en: cms_description_en,
					cms_description_ch: cms_description_ch
				},function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
	//				isajaxsaveing = 0;//ajax正在保存中 --- 释放
					location.href = obj.backurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	
	
	//banner信息---添加
	function toadd_bannerinfo(parent){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_bannerinfo('+parent+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			var subbackurl = $('input[name="subbackurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//信息
			var img1_gksel = $('input[name="img1_gksel"]').val();
			var img2_gksel = $('input[name="img2_gksel"]').val();
			var img3_gksel = $('input[name="img3_gksel"]').val();
			var img4_gksel = $('input[name="img4_gksel"]').val();
			for(var lc = 0; lc < lancodelist.length; lc++){
				eval("var cms_name"+lancodelist[lc]['langtype']+" = '"+$('input[name="cms_name'+lancodelist[lc]['langtype']+'"]').val()+"'");
				eval("var cms_description"+lancodelist[lc]['langtype']+" = '"+$('textarea[name="cms_description'+lancodelist[lc]['langtype']+'"]').val()+"'");
			}
			
			var ispass=1;
			
			var postOBJ = new Object();
			postOBJ.img1_gksel = img1_gksel;
			postOBJ.img2_gksel = img2_gksel;
			postOBJ.img3_gksel = img3_gksel;
			postOBJ.img4_gksel = img4_gksel;
			postOBJ.backurl = backurl;
			postOBJ.subbackurl = subbackurl;
			
			for(var lc = 0; lc < lancodelist.length; lc++){
				eval("postOBJ.cms_name"+lancodelist[lc]['langtype']+" = '" + eval("cms_name"+lancodelist[lc]['langtype'])+"'");
				eval("postOBJ.cms_description"+lancodelist[lc]['langtype']+" = '" + eval("cms_description"+lancodelist[lc]['langtype'])+"'");
			}
			
			
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/cms/add_sub_banner/'+parent, postOBJ, function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
					location.href = obj.subbackurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	
	//banner信息---添加
	function toadd_bannerinfo_third(parent, second_id){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="toadd_bannerinfo_third('+parent+', '+second_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			var subbackurl = $('input[name="subbackurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//信息
			var img1_gksel = $('input[name="img1_gksel"]').val();
			for(var lc = 0; lc < lancodelist.length; lc++){
				eval("var cms_name"+lancodelist[lc]['langtype']+" = '"+$('input[name="cms_name'+lancodelist[lc]['langtype']+'"]').val()+"'");
			}
			
			var ispass=1;
			
			var postOBJ = new Object();
			postOBJ.img1_gksel = img1_gksel;
			postOBJ.backurl = backurl;
			postOBJ.subbackurl = subbackurl;
			
			for(var lc = 0; lc < lancodelist.length; lc++){
				eval("postOBJ.cms_name"+lancodelist[lc]['langtype']+" = '" + eval("cms_name"+lancodelist[lc]['langtype'])+"'");
			}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/cms/add_third_banner/'+parent+'/'+second_id, postOBJ, function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
					location.href = obj.subbackurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}
	//banner信息---添加
	function tosave_bannerinfo_third(parent, second_id, cms_id){
		var lancodelist = getlancodelist();
		if(isajaxsaveing == 0){
			//具体点击的按钮
			actionsubmit_button = $('div[onclick="tosave_bannerinfo_third('+parent+', '+second_id+', '+cms_id+')"]');
			//ajax正在保存中
			isajaxsaveing = 1;
			//返回url
			var backurl = $('input[name="backurl"]').val();
			var subbackurl = $('input[name="subbackurl"]').val();
			//将提交按钮设置为保存中
			actionsubmit_button.attr('class', 'gksel_btn_action_off');
			actionsubmit_button.html('<img class="icon_loading" src="'+baseurl+'themes/default/images/ajax_loading.gif"/><span>保存中...</span>');
			
			//信息
			var img1_gksel = $('input[name="img1_gksel"]').val();
			for(var lc = 0; lc < lancodelist.length; lc++){
				eval("var cms_name"+lancodelist[lc]['langtype']+" = '"+$('input[name="cms_name'+lancodelist[lc]['langtype']+'"]').val()+"'");
			}
			
			var ispass=1;
			
			var postOBJ = new Object();
			postOBJ.img1_gksel = img1_gksel;
			postOBJ.backurl = backurl;
			postOBJ.subbackurl = subbackurl;
			
			for(var lc = 0; lc < lancodelist.length; lc++){
				eval("postOBJ.cms_name"+lancodelist[lc]['langtype']+" = '" + eval("cms_name"+lancodelist[lc]['langtype'])+"'");
			}
			
			if(ispass == 1){
				$.post(baseurl+'index.php/admins/cms/edit_third_banner/'+parent+'/'+second_id+'/'+cms_id, postOBJ, function (data){
					var obj = eval( "(" + data + ")" );
					actionsubmit_button.html('<img class="icon_success" src="'+baseurl+'themes/default/images/global_ok.png"/><span>保存成功</span>');
					location.href = obj.subbackurl;
				})
			}else{
				actionsubmit_button.attr('class', 'gksel_btn_action_on');
				actionsubmit_button.html('保存');
				isajaxsaveing = 0;//ajax正在保存中 --- 释放
			}
		}
	}