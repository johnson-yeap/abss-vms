var currentcontrol_num = 0;
function tochangesubcontent(num){
// 	$('.btncontrol').removeClass('btncontrol_on');
// 	$('.btncontrol_'+num).addClass('btncontrol_on');

	var jutop = $('.subcontent_'+num).offset().top;
	$("body, html").stop().animate({
		scrollTop: (jutop - 82 - 25)
	}, 800);
}

function togotoparentpage(){
    console.log('document.referrer: '+document.referrer);
	document.referrer === '' ? window.location.href = baseurl+'study/discipline' : window.history.go(-1);
}
function autoscrollfixed(){
	var topDist = $(this).scrollTop();
	if(topDist <= 82){
		$('.disciplinedetail_area').find('.toparea').addClass('toparea_absolute').removeClass('toparea_fixed');
		$('.disciplinedetail_area').find('.controlcontent').addClass('controlcontent_absolute').removeClass('controlcontent_fixed');
		$('.disciplinedetail_area').find('.leftpicture').addClass('leftpicture_absolute').removeClass('leftpicture_fixed');
		$('.disciplinedetail_area').find('.rightpicture').addClass('rightpicture_absolute').removeClass('rightpicture_fixed');
	}else{
		$('.disciplinedetail_area').find('.toparea').addClass('toparea_fixed').removeClass('toparea_absolute');
		$('.disciplinedetail_area').find('.controlcontent').addClass('controlcontent_fixed').removeClass('controlcontent_absolute');
		$('.disciplinedetail_area').find('.leftpicture').addClass('leftpicture_fixed').removeClass('leftpicture_absolute');
		$('.disciplinedetail_area').find('.rightpicture').addClass('rightpicture_fixed').removeClass('rightpicture_absolute');
	}
	if($('.subcontent_1').length > 0){
		var subcontent_1_height = $('.subcontent_1').offset().top;
	}else{
		var subcontent_1_height = 1000000;
	}
	if($('.subcontent_2').length > 0){
		var subcontent_2_height = $('.subcontent_2').offset().top;
	}else{
		var subcontent_2_height = 1000000;
	}
	if($('.subcontent_3').length > 0){
		var subcontent_3_height = $('.subcontent_3').offset().top;
	}else{
		var subcontent_3_height = 1000000;
	}
	if($('.subcontent_4').length > 0){
		var subcontent_4_height = $('.subcontent_4').offset().top;
	}else{
		var subcontent_4_height = 1000000;
	}
	if($('.subcontent_5').length > 0){
		var subcontent_5_height = $('.subcontent_5').offset().top;
	}else{
		var subcontent_5_height = 1000000;
	}
	if($('.subcontent_6').length > 0){
		var subcontent_6_height = $('.subcontent_6').offset().top;
	}else{
		var subcontent_6_height = 1000000;
	}

	if(topDist < (subcontent_2_height - 118)){
		if(currentcontrol_num != 1){
			currentcontrol_num = 1;
			$('.btncontrol').removeClass('btncontrol_on');
	     	$('.btncontrol_1').addClass('btncontrol_on');
	     	$('.allblock').hide().css({'margin-left':'200%'});
	     	$('.block_1').show().stop().animate({'margin-left': '0px'});
	     	$('.block_1').rotate({
	            angle: 180,
	            animateTo: 0
	        })
	        $('.allleftblock').hide().css({'margin-left':'-200%'});
	        $('.leftblock_1').show().stop().animate({'margin-left': '0px'});
	     	$('.leftblock_1').rotate({
	            angle: 180,
	            animateTo: 0
	        })
		}
	}else if(topDist >= (subcontent_2_height - 118) && topDist < (subcontent_3_height - 118)){
		if(currentcontrol_num != 2){
			currentcontrol_num = 2;
			$('.btncontrol').removeClass('btncontrol_on');
	     	$('.btncontrol_2').addClass('btncontrol_on');
	     	$('.allblock').hide().css({'margin-left':'200%'});
	     	$('.block_2').show().stop().animate({'margin-left': '0px'});
	     	$('.block_2').rotate({
	            angle: -180,
	            animateTo: 0
	        })
	        $('.allleftblock').hide().css({'margin-left':'-200%'});
	        $('.leftblock_2').show().stop().animate({'margin-left': '0px'});
	     	$('.leftblock_2').rotate({
	            angle: -180,
	            animateTo: 0
	        })
		}
	}else if(topDist >= (subcontent_3_height - 118) && topDist < (subcontent_4_height - 118)){
     	if(currentcontrol_num != 3){
			currentcontrol_num = 3;
			$('.btncontrol').removeClass('btncontrol_on');
	     	$('.btncontrol_3').addClass('btncontrol_on');
	     	$('.allblock').hide().css({'margin-left':'200%'});
	     	$('.block_3').show().stop().animate({'margin-left': '0px'});
	     	$('.block_3').rotate({
	            angle: 180,
	            animateTo: 0
	        })
	        $('.allleftblock').hide().css({'margin-left':'-200%'});
	        $('.leftblock_3').show().stop().animate({'margin-left': '0px'});
	     	$('.leftblock_3').rotate({
	            angle: 180,
	            animateTo: 0
	        })
		}
	}else if(topDist >= (subcontent_4_height - 118) && topDist < (subcontent_5_height - 118)){
     	if(currentcontrol_num != 4){
			currentcontrol_num = 4;
			$('.btncontrol').removeClass('btncontrol_on');
	     	$('.btncontrol_4').addClass('btncontrol_on');
	     	$('.allblock').hide().css({'margin-left':'200%'});
	     	$('.block_4').show().stop().animate({'margin-left': '0px'});
	     	$('.block_4').rotate({
	            angle: 180,
	            animateTo: 0
	        })
	        $('.allleftblock').hide().css({'margin-left':'-200%'});
	        $('.leftblock_4').show().stop().animate({'margin-left': '0px'});
	     	$('.leftblock_4').rotate({
	            angle: 180,
	            animateTo: 0
	        })
		}
	}else if(topDist >= (subcontent_5_height - 118) && topDist < (subcontent_6_height - 118)){
     	if(currentcontrol_num != 5){
			currentcontrol_num = 5;
			$('.btncontrol').removeClass('btncontrol_on');
	     	$('.btncontrol_5').addClass('btncontrol_on');
	     	$('.allblock').hide().css({'margin-left':'200%'});
	     	$('.block_5').show().stop().animate({'margin-left': '0px'});
	     	$('.block_5').rotate({
	            angle: 180,
	            animateTo: 0
	        })
	        $('.allleftblock').hide().css({'margin-left':'-200%'});
	        $('.leftblock_5').show().stop().animate({'margin-left': '0px'});
	     	$('.leftblock_5').rotate({
	            angle: 180,
	            animateTo: 0
	        })
		}
	}else{
		if(currentcontrol_num != 6){
			currentcontrol_num = 6;
			$('.btncontrol').removeClass('btncontrol_on');
	     	$('.btncontrol_6').addClass('btncontrol_on');
	     	$('.allblock').hide().css({'margin-left':'200%'});
	     	$('.block_6').show().stop().animate({'margin-left': '0px'});
	     	$('.block_6').rotate({
	            angle: 180,
	            animateTo: 0
	        })
	        $('.allleftblock').hide().css({'margin-left':'-200%'});
	        $('.leftblock_6').show().stop().animate({'margin-left': '0px'});
	     	$('.leftblock_6').rotate({
	            angle: 180,
	            animateTo: 0
	        })
		}
	}
}

$(document).ready(function (){
	$(window).scroll(function(){
		autoscrollfixed();
	});
	autoscrollfixed();
	autoscrollfixed();
})