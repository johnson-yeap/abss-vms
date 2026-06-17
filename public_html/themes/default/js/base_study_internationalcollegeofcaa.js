function autoscrollfixed(){
	var allbody_width = document.body.clientWidth;
	var internationalcollegeofecnu_section_width = parseInt(allbody_width * 0.78 - 1 - 44);
	var section_1_top = $('.internationalcollegeofecnu_section_1_kuang').offset().top;
	var section_2_top = $('.internationalcollegeofecnu_section_2_kuang').offset().top;
	var section_3_top = $('.internationalcollegeofecnu_section_3_kuang').offset().top;
	var topDist = $(this).scrollTop();

	
	if(topDist <= section_1_top){
		if($('.internationalcollegeofecnu_section_1_content').css('position') != 'relative'){
			$('.internationalcollegeofecnu_section_1_content').css({'position': 'relative', 'width':'100%'});
			$('.internationalcollegeofecnu_section_1_float').hide();
		}
	}else{
		if($('.internationalcollegeofecnu_section_1_content').css('position') != 'fixed'){
			$('.internationalcollegeofecnu_section_1_float').show();
			$('.internationalcollegeofecnu_section_1_content').css({'position': 'fixed', 'top': '0px', 'width': internationalcollegeofecnu_section_width+'px'});
		}
	}

	if(topDist <= (section_2_top - 75)){
		if($('.internationalcollegeofecnu_section_2_content').css('position') != 'relative'){
			$('.internationalcollegeofecnu_section_2_content').css({'position': 'relative', 'width':'100%'});
			$('.internationalcollegeofecnu_section_2_float').hide();
		}
	}else{
		if($('.internationalcollegeofecnu_section_2_content').css('position') != 'fixed'){
			$('.internationalcollegeofecnu_section_2_float').show();
			$('.internationalcollegeofecnu_section_2_content').css({'position': 'fixed', 'top': '75px', 'width': internationalcollegeofecnu_section_width+'px'});
		}
	}

	if(topDist <= (section_3_top - 150)){
		//3浮动
		$('.internationalcollegeofecnu_section_1_content').find('.listcontent').show();
		$('.internationalcollegeofecnu_section_2_content').find('.listcontent').show();
		$('.internationalcollegeofecnu_section_3_content').find('.listcontent').show();
		if($('.internationalcollegeofecnu_section_3_content').css('position') != 'relative'){
			$('.internationalcollegeofecnu_section_3_content').css({'position': 'relative', 'width':'100%'});
			$('.internationalcollegeofecnu_section_3_float').hide();
		}
	}else{
		//3固定
		$('.internationalcollegeofecnu_section_1_content').find('.listcontent').hide();
		$('.internationalcollegeofecnu_section_2_content').find('.listcontent').hide();
		$('.internationalcollegeofecnu_section_3_content').find('.listcontent').show();
		if($('.internationalcollegeofecnu_section_3_content').css('position') != 'fixed'){
			$('.internationalcollegeofecnu_section_3_float').show();
			$('.internationalcollegeofecnu_section_3_content').css({'position': 'fixed', 'top': '150px', 'width': internationalcollegeofecnu_section_width+'px'});
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