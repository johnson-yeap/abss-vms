	var isNull = /^[\s' ']*$/;
	function isEmail(email){
		var isEmail = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email);
		if(isEmail!=true){
			return false;
		}else{
			return true;
		}
	}
	//判断是否为手机号码格式
	/** 
    * 检查字符串是否为合法手机号码 
    * @param {String} 字符串 
    * @return {bool} 是否为合法手机号码 
    */  
    function isPhone(aPhone) {
    	var bValidate = RegExp(/^(0|86|17951)?(11[0-9]|12[0-9]|13[0-9]|14[0-9]|15[0-9]|16[0-9]|17[0-9]|18[0-9]|19[0-9])[0-9]{8}$/).test(aPhone);  
        if (bValidate) {
            return true;  
        }else {
        	return false;
        }
    }
	//跳转到url
	function jumptourl(url){
		if(url != ''){
			location.href = baseurl + url;	
		}
	}
	//新打开url
	function toopennewurl(url){
		if(url != ''){
			window.open(url);
		}
	}
	
	function toopen_searchbox(){
    	$('.popupsearch_box').css({'display': 'block', 'margin-left': '50%', 'width': '0px'});
    	$('.popupsearch_box').animate({'margin-left': '0px', 'width': '100%'}, 300, function (){
    		
    	})
    }
	function toclose_searchbox(){
		$('.popupsearch_box').css({'margin-left': '0px', 'width': '100%'});
		$('.popupsearch_box').animate({'margin-left': '50%', 'width': '0px'}, 300, function (){
			$('.popupsearch_box').hide();
		})
	}
	
	function tocheckheadersearch(){
		var keyword = $('input[name="keyword"]').val();
		if(keyword != ''){
			$('.searchiconbtn').hide();
			$('.searchiconloading').show();
			return true;
		}else{
			return false;
		}
	}
	
	function tosubmitheadersearch(){
		var keyword = $('input[name="keyword"]').val();
		if(keyword != ''){
			$('.searchiconbtn').hide();
			$('.searchiconloading').show();
			location.href = baseurl+reland+'/search?keyword='+keyword;
		}else{
			
		}
	}
	
	function toshowtest(){
		$('#menu_control_01').hide();
		$('#menu_control_02').show();
		$('#menu_mobile_logo').parent().parent().hide();
		$('#mobile_menu').animate({height:"show"},300,function (data){
			$("body,html").animate({
    			scrollTop:0 //让body的scrollTop等于pos的top，就实现了滚动
    		},1000);
		});
	}
	function tohidetest(){
		$('#menu_control_01').show();
		$('#menu_control_02').hide();
		$('#menu_mobile_logo').parent().parent().show();
		$('#mobile_menu').animate({height:"hide"},300,function (data){

		});
	}
	function autowidth_header(allbody_width, allbody_height){
		if(allbody_width < 890){
			 $('.header_list_two').show();
			 $('.header_list_one').hide();

		}else{
			 $('.header_list_two').hide();
			 $('.header_list_one').show();

			 tohidetest();
		}
	}
	
	var allbody_section = '';
    var allbody_width = 0;
    var allbody_height = 0;
    
    function autotestwidth(){
    	allbody_width = document.body.clientWidth;  //宽度
    	allbody_height = document.body.clientHeight;  //高度
    	
    	autowidth_header(allbody_width, allbody_height);
    }
    
	$(document).ready(function (){
		//回车键电脑版搜索
		$('input[name="header_keyword"]').keydown(function(event){//这个是你在页面按任意按钮的时候会触发该方法
			var aa = event.which;
			if(aa == 13){
				document.onkeydown=null;//这里需要将onkeydown置空，不然默认一直是188
				toheadersearch();
			}
		});
		//手机版搜索
		$('input[name="mobile_keyword"]').keydown(function(event){//这个是你在页面按任意按钮的时候会触发该方法
			var aa = event.which;
			if(aa == 13){
				document.onkeydown=null;        //这里需要将onkeydown置空，不然默认一直是188
				tomobilesearch();
			}
		});
		//高度和宽度改变
		$(window).resize(function() {
	    	autotestwidth();
	    })
	    autotestwidth();
	})
	//列表页搜索
	function tosearch_innerlist(){
		$('#innerlistsearch_form').submit();
	}
	
	function tosignup_newsletter(){
		var ispass = tochecknewsletteremail();
		if(ispass == 1){
			$('.newsletter_submit').hide();
			$('.newsletter_loading').show();
			var newsletter_email = $('input[name="newsletter_email"]').val();
			var postOBJ = new Object();
			postOBJ.newsletter_email = newsletter_email;
			$.post(baseurl+'subscribe/tosignup_newsletter', postOBJ, function (data){
				$('.newsletter_submit').show();
				$('.newsletter_loading').hide();
				$('input[name="newsletter_email"]').val('');

				$('.newsletter_formarea').hide();
				if(data == 'yes'){
					if(reland == 'cn'){
						$('.newsletter_resultarea').show().css({'color': 'white', 'font-size': '18px'}).html('感谢您的订阅');
					}else{
						$('.newsletter_resultarea').show().css({'color': 'white', 'font-size': '18px'}).html('Thanks for your subscription');
					}
				}else if(data == 'has'){
					if(reland == 'cn'){
						$('.newsletter_resultarea').show().css({'color': 'orange', 'font-size': '18px'}).html('您已经订阅过了');
					}else{
						$('.newsletter_resultarea').show().css({'color': 'orange', 'font-size': '18px'}).html('You have already subscribed');
					}
				}else{
					if(reland == 'cn'){
						$('.newsletter_resultarea').show().css({'color': 'white', 'font-size': '18px'}).html('订阅失败');
					}else{
						$('.newsletter_resultarea').show().css({'color': 'white', 'font-size': '18px'}).html('Subscribe failed');
					}
				}
			})
		}
	}
	
	function toactionmobile_submenuarea(num){
		if($('.mobile_submenuarea_'+num).css('display') == 'none'){
			$('.mobile_submenuarea_'+num).stop().animate({'height': 'show'}, 300, function (){
				$('div[onclick="toactionmobile_submenuarea('+num+')"]').find('.mobile_action_do').hide();
				$('div[onclick="toactionmobile_submenuarea('+num+')"]').find('.mobile_action_up').show();
			})
		}else{
			$('.mobile_submenuarea_'+num).stop().animate({'height': 'hide'}, 300, function (){
				$('div[onclick="toactionmobile_submenuarea('+num+')"]').find('.mobile_action_do').show();
				$('div[onclick="toactionmobile_submenuarea('+num+')"]').find('.mobile_action_up').hide();
			})
		}
	}
	
	function backtotop(){
		$('html, body').stop().animate({
            scrollTop: 0
        }, 1000);
	}
	
	function tochecknewsletteremail(){
		var ispass = 1;
		var newsletter_email = $('input[name="newsletter_email"]').val();
		if(isNull.test(newsletter_email)){
			ispass = 0;
			$('.newsletter_email_error').show();
			$('.newsletter_email_formaterror').hide();
		}else{
			if(isEmail(newsletter_email) == false){
				ispass = 0;
				$('.newsletter_email_formaterror').show();
			}else{
				$('.newsletter_email_formaterror').hide();
			}
			$('.newsletter_email_error').hide();
		}
		return ispass;
	}
	
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
//	 	  $("<img />").attr("src", baseurl+targetimg.attr('data-src')).load(function() {
//	 		  targetimg.attr('src', baseurl+targetimg.attr('data-src'));
//	 		              // 已经加载的图片，我给它设置一个属性，值为1，作为标识
//	 		              // 弄这个的初衷是因为，每次滚动的时候，所有的图片都会遍历一遍，这样有点浪费，所以做个标识，滚动的时候只遍历哪些还没有加载的图片
//	 		              targetimg.attr('data-isLoading', 1);
//	 			})


				$("<img />").attr("src", baseurl+targetimg.attr('data-src')).on('load',function(){
					targetimg.attr('src', baseurl+targetimg.attr('data-src'));
		              // 已经加载的图片，我给它设置一个属性，值为1，作为标识
		              // 弄这个的初衷是因为，每次滚动的时候，所有的图片都会遍历一遍，这样有点浪费，所以做个标识，滚动的时候只遍历哪些还没有加载的图片
		              targetimg.attr('data-isLoading', 1);
		        });
	  }
	
	
	
	
	
	
	$(document).ready(function(){
		/**
	     * @param flag: 用于标记是否是非直接的文字输入
			* 即时搜索：对于ios自带输入法输入中文时多次触发input事件的处理
	     */
		var flag_101 = false;
		$('input[name="newsletter_email"]').on({
            'compositionstart': function() {
              flag_101 = true;
            },
            'compositionend': function() {
              flag_101 = false;
              if(!flag_101) {
                //do something...
            	  tochecknewsletteremail();
              }
            },
            'input propertychange': function() {
                if(!flag_101) {
                  //do something...
                	tochecknewsletteremail();
                }
            }
		})
		
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
		
		
		$(".hoverbackground-zoom_big").hover(
			function() {
				$(this).parent().stop().animate({'opacity': '0.8'}, 200, function (){
					
				});
				$(this).prev().stop().animate({'background-size':'110%'}, 200, function (){
					
				});
				$(this).find('.bigshowtitle, .bigshowmore, .normaltitleshow').addClass('addnewhover-zoom');
			},
			function() {
				$(this).parent().stop().animate({'opacity': '1'}, 200, function (){
	
				});
				$(this).prev().stop().animate({'background-size':'100%'}, 200, function (){
	
				});
				$(this).find('.bigshowtitle, .bigshowmore, .normaltitleshow').removeClass('addnewhover-zoom');
			}
		)
		
		$(".hoverbackground-zoom_110").hover(
			function() {
				$(this).parent().stop().animate({'opacity': '0.8'}, 200, function (){
					
				});
				$(this).prev().stop().animate({'background-size':'120%'}, 200, function (){
					
				});
				$(this).find('.bigshowtitle, .bigshowmore, .normaltitleshow').addClass('addnewhover-zoom');
			},
			function() {
				$(this).parent().stop().animate({'opacity': '1'}, 200, function (){
	
				});
				$(this).prev().stop().animate({'background-size':'110%'}, 200, function (){
	
				});
				$(this).find('.bigshowtitle, .bigshowmore, .normaltitleshow').removeClass('addnewhover-zoom');
			}
		)
		
		$(".hoverbackground-zoom").hover(
			function() {
				$(this).parent().stop().animate({'opacity': '0.8'}, 200, function (){
					
				});
				$(this).prev().stop().animate({'background-size':'120%'}, 200, function (){
					
				});
				$(this).find('.bigshowtitle, .bigshowmore, .normaltitleshow').addClass('addnewhover-zoom');
			},
			function() {
				$(this).parent().stop().animate({'opacity': '1'}, 200, function (){
	
				});
				$(this).prev().stop().animate({'background-size':'100%'}, 200, function (){
	
				});
				$(this).find('.bigshowtitle, .bigshowmore, .normaltitleshow').removeClass('addnewhover-zoom');
			}
		)
			
		$(".selfhoverbackground-zoom").hover(
			function() {
				$(this).stop().animate({'opacity': '0.8', 'background-size':'120%'}, 500, function (){
					
				});
			},
			function() {
				$(this).stop().animate({'opacity': '1', 'background-size':'105%'}, 200, function (){
	
				});
			}
		)
	})
	
	//导航菜单的效果
	$(document).ready(function (){
		$('.ecnu_menuwhite').hover(
			function() {
    			$(this).find('.submenulist').stop().animate({'height': 'show'}, 500, function (){
        			
        		});
			},
			function() {
				$(this).find('.submenulist').stop().animate({'height': 'hide'}, 500, function (){
        		
				});
			}
		)

		$('.secondlist').hover(
			function() {
				$(this).find('.thirdarea').show();
				$(this).find('.thirdarea').css({'width': '80px', 'right': '-80px'});
    			$(this).find('.thirdarea').stop().animate({'width': '238px', 'right': '-238px'}, 500, function (){
        			
        		});
			},
			function() {
				$(this).find('.thirdarea').hide();
				$(this).find('.thirdarea').stop().css({'width': '238px', 'right': '-238px'});
			}
		)
	})
