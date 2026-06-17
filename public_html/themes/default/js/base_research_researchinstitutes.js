var current_num = 0;
function toresearchinstitute(num){
	if(current_num == num){//取消选择
		current_num = 0;
		$('.researchinstitute_summary_'+num).animate({'height': 'hide'});
		$('div[onclick="toresearchinstitute('+num+')"]').removeClass('list_on');
	}else{
		$('.researchinstitutes_content').find('.list').removeClass('list_on');
		$('.researchinstitute_summary').hide();
		
		current_num = num;
		$('div[onclick="toresearchinstitute('+num+')"]').addClass('list_on');
		$('.researchinstitute_summary_'+num).animate({'height': 'show'});
	}
}