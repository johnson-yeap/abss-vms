//首页banner滚动效果--START
var currentnum_homebanner = 1;
var isloaded_homebanner = 1;
var marginleft_homebanner = 0;
var jiange_homebanner = 100;
var isauto_homebanner = 1;//是否自动滚动
var timeid_homebanner = '';
function clickcontrol_homebanner(num, fangxiang){
	if(count_homebanner > 1){
		if((isloaded_homebanner == 1) && (num ==currentnum_homebanner) && count_homebanner == 1){//总数只有1个的情况下
			clearTimeout(timeid_homebanner);//清除之前的滚动
			isloaded_homebanner=0;
			
			if(fangxiang == 'prev'){
				marginleft_homebanner = 0;
			}else{
				marginleft_homebanner = "-"+((num+1)*jiange_homebanner);
			}
			
			$('.ecnu_homebanner_allwidth').animate({marginLeft:marginleft_homebanner+"%"},800,function(){
				currentnum_homebanner=num;
				isloaded_homebanner=1;
				$('.ecnu_homebanner_controllarea').find('.control').removeClass("control_on").removeClass("control_off").addClass("control_off");
				$('.ecnu_homebanner_controllarea').find('.control').eq((currentnum_homebanner - 1)).addClass("control_on").removeClass("control_off");
				
				$('.ecnu_homebanner_allwidth').css({marginLeft:"-"+(num*jiange_homebanner)+"%"});
				if(isauto_homebanner==1){
					timeid_homebanner=setTimeout('clickcontrol_homebanner('+(num+1)+', "next")',timeout_homebanner);
				}
			})
		}
		
		
		
		if((isloaded_homebanner==1)&&(num!=currentnum_homebanner)){
			clearTimeout(timeid_homebanner);//清除之前的滚动
			isloaded_homebanner=0;
			if(num == 1){
				if(currentnum_homebanner == count_homebanner){
					if(count_homebanner == 2){//总数只有2个的情况下
						if(fangxiang == 'prev'){
							marginleft_homebanner = "-"+(num*jiange_homebanner);
						}else{
							marginleft_homebanner = "-"+((num+count_homebanner)*jiange_homebanner);
						}
					}else{
						marginleft_homebanner = "-"+((num+count_homebanner)*jiange_homebanner);
					}
					$('.ecnu_homebanner_allwidth').animate({marginLeft:marginleft_homebanner+"%"},800,function(){
						currentnum_homebanner=num;
						isloaded_homebanner=1;
						$('.ecnu_homebanner_controllarea').find('.control').removeClass("control_on").removeClass("control_off").addClass("control_off");
						$('.ecnu_homebanner_controllarea').find('.control').eq((currentnum_homebanner - 1)).addClass("control_on").removeClass("control_off");
						
						
						$('.ecnu_homebanner_allwidth').css({marginLeft:"-"+(num*jiange_homebanner)+"%"});
						if(isauto_homebanner==1){
							timeid_homebanner=setTimeout('clickcontrol_homebanner('+(num+1)+', "next")',timeout_homebanner);
						}
					})
				}else{
					$('.ecnu_homebanner_allwidth').animate({marginLeft:"-"+(num*jiange_homebanner)+"%"},800,function(){
						currentnum_homebanner=num;
						isloaded_homebanner=1;
						$('.ecnu_homebanner_controllarea').find('.control').removeClass("control_on").removeClass("control_off").addClass("control_off");
						$('.ecnu_homebanner_controllarea').find('.control').eq((currentnum_homebanner - 1)).addClass("control_on").removeClass("control_off");
						
						
						if(isauto_homebanner==1){
							timeid_homebanner=setTimeout('clickcontrol_homebanner('+(num+1)+', "next")',timeout_homebanner);
						}
					})
				}
			}else if(num == count_homebanner){
				if(currentnum_homebanner==1){
					
					if(count_homebanner == 2){//总数只有两个的情况下
						if(fangxiang == 'prev'){
							marginleft_homebanner = 0;
						}else{
							marginleft_homebanner = "-"+(num*jiange_homebanner);
						}
					}else{
						marginleft_homebanner = "-"+((num-count_homebanner)*jiange_homebanner);
					}
					$('.ecnu_homebanner_allwidth').animate({marginLeft:marginleft_homebanner+"%"},800,function(){
						currentnum_homebanner = num;
						isloaded_homebanner=1;
						$('.ecnu_homebanner_controllarea').find('.control').removeClass("control_on").removeClass("control_off").addClass("control_off");
						$('.ecnu_homebanner_controllarea').find('.control').eq((currentnum_homebanner - 1)).addClass("control_on").removeClass("control_off");
						
						
						$('.ecnu_homebanner_allwidth').css({'margin-left':"-"+(num*jiange_homebanner)+"%"});
						if(isauto_homebanner==1){
							timeid_homebanner=setTimeout('clickcontrol_homebanner(1, "next")',timeout_homebanner);
						}
					})
				}else{
					marginleft_homebanner = "-"+(count_homebanner*jiange_homebanner);
					$('.ecnu_homebanner_allwidth').animate({marginLeft:marginleft_homebanner+"%"},800,function(){
						currentnum_homebanner=num;
						isloaded_homebanner=1;
						$('.ecnu_homebanner_controllarea').find('.control').removeClass("control_on").removeClass("control_off").addClass("control_off");
						$('.ecnu_homebanner_controllarea').find('.control').eq((currentnum_homebanner - 1)).addClass("control_on").removeClass("control_off");
						
						
						$('.ecnu_homebanner_allwidth').css({'margin-left':"-"+(num*jiange_homebanner)+"%"});
						
						if(isauto_homebanner==1){
							timeid_homebanner=setTimeout('clickcontrol_homebanner(1, "next")',timeout_homebanner);
						}
					})
				}
			}else{
				$('.ecnu_homebanner_allwidth').animate({marginLeft:"-"+(num*jiange_homebanner)+"%"}, 800 , function(){
					currentnum_homebanner=num;
					isloaded_homebanner=1;
					$('.ecnu_homebanner_controllarea').find('.control').removeClass("control_on").removeClass("control_off").addClass("control_off");
					$('.ecnu_homebanner_controllarea').find('.control').eq((currentnum_homebanner - 1)).addClass("control_on").removeClass("control_off");
					
					if(isauto_homebanner==1){
						timeid_homebanner=setTimeout('clickcontrol_homebanner('+(num+1)+', "next")',timeout_homebanner);
					}
				})
			}
		}
	}
}
//默认时间后滚动到第二个
$(document).ready(function (){
	if(isauto_homebanner==1){
		timeid_homebanner=setTimeout('clickcontrol_homebanner(2, "next")',timeout_homebanner);
	}
	
	$('.ecnu_homebanner_prevnext').find('.prev').click(function (){
		if(count_homebanner == 1){//总数只有1个的情况下
			clickcontrol_homebanner(1, 'prev');
		}else{
			if(currentnum_homebanner == 1){
				clickcontrol_homebanner(count_homebanner, 'prev');
			}else{
				clickcontrol_homebanner((currentnum_homebanner-1), 'prev');
			}
		}
	})
	$('.ecnu_homebanner_prevnext').find('.next').click(function (){
		if(count_homebanner == 1){//总数只有1个的情况下
			clickcontrol_homebanner(1, 'next');
		}else{
			if(currentnum_homebanner == count_homebanner){
				clickcontrol_homebanner(1, 'next');
			}else{
				clickcontrol_homebanner((currentnum_homebanner+1), 'next');
			}
		}
	})
	 $('.ecnu_homebanner_controllarea').find('.control').click(function (){
		 clickcontrol_homebanner(($(this).index() + 1), 'next');
	})
})

//活动 ----- START
var current_num = 1;
function togotoprev(){
    if(current_num != 1){
    	current_num = current_num - 1;
    	
    	$('.boxcontentalllength').stop().animate({'margin-left': '-'+(current_num - 1)*360+'px'}, function (){

		})
		$('.barcontent').find('.sublist').find('.circle').removeClass('circle_on').addClass('circle_off');
		$('.barcontent').find('.sublist').eq((current_num - 1)).find('.circle').removeClass('circle_off').addClass('circle_on');
		$('.barcontent').find('.sublist').find('.text').removeClass('text_on').addClass('text_off');
		$('.barcontent').find('.sublist').eq((current_num - 1)).find('.text').removeClass('text_off').addClass('text_on');
    }
}
function togotonext(){
	if(current_num != havehome_event_num){
		current_num = current_num + 1;
		
    	$('.boxcontentalllength').stop().animate({'margin-left': '-'+(current_num - 1)*360+'px'}, function (){

		})
		$('.barcontent').find('.sublist').find('.circle').removeClass('circle_on').addClass('circle_off');
		$('.barcontent').find('.sublist').eq((current_num - 1)).find('.circle').removeClass('circle_off').addClass('circle_on');
		$('.barcontent').find('.sublist').find('.text').removeClass('text_on').addClass('text_off');
		$('.barcontent').find('.sublist').eq((current_num - 1)).find('.text').removeClass('text_off').addClass('text_on');
    }
}
//跳转到指定
function togotowidthnum(num){
	current_num = num;
// 	if(current_num == 1 || current_num == 2 || current_num == 3){
// 		$('.boxcontentalllength').stop().animate({'margin-left': '0%'}, function (){

// 		})
//     }else if(current_num == (havehome_event_num - 2) || current_num == (havehome_event_num - 1) || current_num == havehome_event_num){
// 		$('.boxcontentalllength').stop().animate({'margin-left': '-'+(13 - 1 - 2)*360+'px'}, function (){

// 		})
//     }else{
//     	$('.boxcontentalllength').stop().animate({'margin-left': '-'+(current_num - 1 - 2)*360+'px'}, function (){

// 		})
// 	}
	$('.boxcontentalllength').stop().animate({'margin-left': '-'+(current_num - 1)*360+'px'}, function (){

	})
	$('.barcontent').find('.sublist').find('.circle').removeClass('circle_on').addClass('circle_off');
	$('.barcontent').find('.sublist').eq((current_num - 1)).find('.circle').removeClass('circle_off').addClass('circle_on');
	$('.barcontent').find('.sublist').find('.text').removeClass('text_on').addClass('text_off');
	$('.barcontent').find('.sublist').eq((current_num - 1)).find('.text').removeClass('text_off').addClass('text_on');
}
//活动 ----- END



$(document).ready(function (){
	//News 效果
	var ishovering_big = 0;
	$('.ecnu_bigarea').hover(
		function() {
			if(ishovering_big == 0){
    			ishovering_big = 1;
    			$('.ecnu_bigarea').find('.picture').stop().animate({'width': '+=24px', 'padding-bottom': '+=24px', 'margin-left': '-12px', 'margin-top': '-12px'}, 300, function (){
    // 				$('.ecnu_bigarea').find('.picture').stop().animate({'width': '-=24px', 'padding-bottom': '-=24px', 'margin-left': '0px', 'margin-top': '0px'}, 50, function (){
    // 					$('.ecnu_bigarea').find('.picture').css({'width': '100%', 'padding-bottom': '59.917%', 'margin-left': '0px', 'margin-top': '0px'});
    //     			});
    				ishovering_big = 0;
        		});
			}
		},
		function() {
			$('.ecnu_bigarea').find('.picture').animate({'width': '100%', 'padding-bottom': '59.917%', 'margin-left': '0px', 'margin-top': '0px'}, 300, function (){
				ishovering_big = 0;
			});
		}
	)

	$('.ecnu_rightlist').find('.list').hover(
		function() {
			$(this).find('.rightarea').stop().animate({'width': '+=12px', 'height': '+=12px', 'margin-left': '-6px', 'margin-top': '-6px'}, 300, function (){
// 				$(this).find('.rightarea').animate({'width': '-=12px', 'height': '-=12px', 'margin-left': '0px', 'margin-top': '0px'}, 50, function (){
// 					$(this).find('.rightarea').css({'width': '100%', 'height': '100%', 'margin-left': '0px', 'margin-top': '0px'});
//     			});
    		});
		},
		function() {
			$(this).find('.rightarea').stop().animate({'width': '100%', 'height': '100%', 'margin-left': '0px', 'margin-top': '0px'}, 300, function (){

			});
		}
	)
	//Admission 效果
	$('.home_admissionarea').find('.list_bottom').hover(
		function() {
			var allbody_width = document.body.clientWidth;
			if(allbody_width <= 600){
				
			}else if(allbody_width > 600 && allbody_width <= 1100){
				
			}else{
				$(this).find('.fixedsize').stop().animate({'margin-top': '34.24%'}, 200, function (){
					
	    		});
			}
		},
		function() {
			var allbody_width = document.body.clientWidth;
			if(allbody_width <= 600){
				
			}else if(allbody_width > 600 && allbody_width <= 1100){
				
			}else{
				$(this).find('.fixedsize').stop().animate({'margin-top': '52.12%'}, 200, function (){
					
	    		});
			}
		}
	)
	$('.home_admissionarea').find('.list_top').hover(
		function() {
			var allbody_width = document.body.clientWidth;
			if(allbody_width <= 600){
				
			}else if(allbody_width > 600 && allbody_width <= 1100){
				
			}else{
				$(this).find('.fixedsize').stop().animate({'margin-top': '-17.88%'}, 200, function (){
					
	    		});
			}
		},
		function() {
			var allbody_width = document.body.clientWidth;
			if(allbody_width <= 600){
				
			}else if(allbody_width > 600 && allbody_width <= 1100){
				
			}else{
				$(this).find('.fixedsize').stop().animate({'margin-top': '0%'}, 200, function (){
					
	    		});
			}
		}
	)
	//Explore 效果
	var current_explore_id = 1;
	var new_explore_id = 0;
	$('.home_explore').find('.list').hover(
		function() {
			new_explore_id = $(this).attr('explore_id');
			console.log('new_explore_id：'+new_explore_id);
			if(current_explore_id != new_explore_id){
				//方法一 ------- START
				$('.home_explore').find('.list').each(function (){
					var bianli_explore_id = $(this).attr('explore_id');
					if(bianli_explore_id == new_explore_id){
						$(this).find('.bgopacity').removeClass('displayblock').addClass('displaynone');
						$(this).stop().animate({'width': '25%'}, 305, function (){
							
			    		});
					}else{
						$(this).find('.bgopacity').removeClass('displaynone').addClass('displayblock');
						$(this).stop().animate({'width': '15%'}, 300, function (){
							
			    		});
					}
				})
				//方法一 ------- END

// 				//方法二 ------- START
// 				$('div[explore_id="'+new_explore_id+'"]').find('.bgopacity').removeClass('displayblock').addClass('displaynone');
// 				$('div[explore_id="'+new_explore_id+'"]').stop().animate({'width': '25%'}, 300, function (){
					
// 	    		});
// 				$('div[explore_id="'+current_explore_id+'"]').find('.bgopacity').removeClass('displaynone').addClass('displayblock');
// 				$('div[explore_id="'+current_explore_id+'"]').stop().animate({'width': '15%'}, 300, function (){
					
// 	    		});
// 				//方法二 ------- END
	    		
				current_explore_id = new_explore_id;
				
			}
		},
		function() {
			
		}
	)
	
	
	var allbody_width = 0;
	var allbody_height = 0;

	function autotestwidth_page(){
		allbody_width = document.body.clientWidth;
		allbody_height = document.body.clientHeight;
	}

	$(window).resize(function() {
		autotestwidth_page();
	})
	autotestwidth_page();
	autotestwidth_page();
	
})