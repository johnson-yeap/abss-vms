var current_category_id = 0;
function tosearchforcategory(category_id){
	var keyword = $('input[name="faculty_search"]').val();
	
	var jutop = $('.faculty_searcharea').offset().top;
	$("body, html").stop().animate({
		scrollTop: (jutop + 20)
	}, 500);
	
	if($('.faculty_searchcategoryarea').find('.list_'+category_id).hasClass('list_on')){
		current_category_id = 0;
		$('.faculty_searchcategoryarea').find('.list').removeClass('list_on');
		$('.groupsearchcategory_show').html('');
		$('.groupsearchcategory_closebox').hide();

		$('.faculty_grouparea').html('<div style="float:left;width:100%;text-align:center;padding:30px 0px;"><img style="width:20px;height:20px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
		$.post(baseurl+'faculty/search?category_id=0&keyword='+keyword, function (eventdata){
			$('.faculty_grouparea').html(eventdata);
		})
	}else{
		current_category_id = category_id;
		$('.faculty_searchcategoryarea').find('.list').removeClass('list_on');
		$('.faculty_searchcategoryarea').find('.list_'+category_id).addClass('list_on');
		$('.groupsearchcategory_show').html($('div[onclick="tosearchforcategory('+category_id+')"]').html());
		$('.groupsearchcategory_closebox').show();

		$('.faculty_grouparea').html('<div style="float:left;width:100%;text-align:center;padding:30px 0px;"><img style="width:20px;height:20px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
		$.post(baseurl+'faculty/search?category_id='+category_id+'&keyword='+keyword, function (eventdata){
			$('.faculty_grouparea').html(eventdata);
		})
	}
}
function toclear_searchforcategory(){
	var keyword = $('input[name="faculty_search"]').val();
	current_category_id = 0;
	$('.faculty_searchcategoryarea').find('.list').removeClass('list_on');
	$('.groupsearchcategory_show').html('');
	$('.groupsearchcategory_closebox').hide();

	$('.faculty_grouparea').html('<div style="float:left;width:100%;text-align:center;padding:30px 0px;"><img style="width:20px;height:20px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
	$.post(baseurl+'faculty/search?category_id=0&keyword='+keyword, function (eventdata){
		$('.faculty_grouparea').html(eventdata);
	})
}



var current_discipline_id = 0;
function tosearchfordiscipline(discipline_id){
	var keyword = $('input[name="faculty_search"]').val();

	var jutop = $('.faculty_searcharea').offset().top;
	$("body, html").stop().animate({
		scrollTop: (jutop + 20)
	}, 500);
	
	if($('.faculty_searchdisciplinearea').find('.list_'+discipline_id).hasClass('list_on')){
		current_discipline_id = 0;
		$('.faculty_searchdisciplinearea').find('.list').removeClass('list_on');
		$('.groupsearchdiscipline_show').html('');
		$('.groupsearchdiscipline_closebox').hide();

		$('.faculty_grouparea').html('<div style="float:left;width:100%;text-align:center;padding:30px 0px;"><img style="width:20px;height:20px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
		$.post(baseurl+'faculty/search?discipline_id=0&keyword='+keyword, function (eventdata){
			$('.faculty_grouparea').html(eventdata);
		})
	}else{
		current_discipline_id = discipline_id;
		$('.faculty_searchdisciplinearea').find('.list').removeClass('list_on');
		$('.faculty_searchdisciplinearea').find('.list_'+discipline_id).addClass('list_on');
		$('.groupsearchdiscipline_show').html($('div[onclick="tosearchfordiscipline('+discipline_id+')"]').html());
		$('.groupsearchdiscipline_closebox').show();

		$('.faculty_grouparea').html('<div style="float:left;width:100%;text-align:center;padding:30px 0px;"><img style="width:20px;height:20px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
		$.post(baseurl+'faculty/search?discipline_id='+discipline_id+'&keyword='+keyword, function (eventdata){
			$('.faculty_grouparea').html(eventdata);
		})
	}
}
function toclear_searchfordiscipline(){
	current_discipline_id = 0;
	var keyword = $('input[name="faculty_search"]').val();
	$('.faculty_searchdisciplinearea').find('.list').removeClass('list_on');
	$('.groupsearchdiscipline_show').html('');
	$('.groupsearchdiscipline_closebox').hide();

	$('.faculty_grouparea').html('<div style="float:left;width:100%;text-align:center;padding:30px 0px;"><img style="width:20px;height:20px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
	$.post(baseurl+'faculty/search?discipline_id=0&keyword='+keyword, function (eventdata){
		$('.faculty_grouparea').html(eventdata);
	})
}




function toclearforkeyword(){
	category_id = current_category_id;
	discipline_id = current_discipline_id;
	$('input[name="faculty_search"]').val('');
	var keyword = '';
	
	$('.btnsearch').removeClass('displayblock').addClass('displaynone');

	var jutop = $('.faculty_searcharea').offset().top;
	$("body, html").stop().animate({
		scrollTop: (jutop + 20)
	}, 500);
	
	$('.faculty_grouparea').html('<div style="float:left;width:100%;text-align:center;padding:30px 0px;"><img style="width:20px;height:20px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
	$.post(baseurl+'faculty/search?category_id='+category_id+'&discipline_id='+discipline_id+'&keyword='+keyword, function (eventdata){
		$('.faculty_grouparea').html(eventdata);
	})
}
function tosearchforkeyword(){
	category_id = current_category_id;
	discipline_id = current_discipline_id;
	var keyword = $('input[name="faculty_search"]').val();

	var jutop = $('.faculty_searcharea').offset().top;
	$("body, html").stop().animate({
		scrollTop: (jutop + 20)
	}, 500);
	
	$('.faculty_grouparea').html('<div style="float:left;width:100%;text-align:center;padding:30px 0px;"><img style="width:20px;height:20px;" src="'+baseurl+'themes/default/images/ajax_loading.gif"/></div>');
	$.post(baseurl+'faculty/search?category_id='+category_id+'&discipline_id='+discipline_id+'&keyword='+keyword, function (eventdata){
		$('.faculty_grouparea').html(eventdata);
	})
}
$(document).ready(function (){
	//回车键电脑版搜索
	$('input[name="faculty_search"]').keydown(function(event){//这个是你在页面按任意按钮的时候会触发该方法
		var aa = event.which;
		if(aa == 13){
			document.onkeydown=null;//这里需要将onkeydown置空，不然默认一直是188
			tosearchforkeyword();
		}
	});
})

$(document).ready(function(){
	/**
     * @param flag: 用于标记是否是非直接的文字输入
		* 即时搜索：对于ios自带输入法输入中文时多次触发input事件的处理
     */
	var flag = false;
	$('input[name="faculty_search"]').on({
        'compositionstart': function() {
          flag = true;
        },
        'compositionend': function() {
          flag = false;
          if(!flag) {
            //do something...
        	if($('input[name="faculty_search"]').val() != ''){
        		$('.btnsearch').removeClass('displaynone').addClass('displayblock');
        	}else{
        		$('.btnsearch').removeClass('displayblock').addClass('displaynone');
        	}
          }
        },
        'input propertychange': function() {
            if(!flag) {
            	//do something...
	        	if($('input[name="faculty_search"]').val() != ''){
	        		$('.btnsearch').removeClass('displaynone').addClass('displayblock');
	        	}else{
	        		$('.btnsearch').removeClass('displayblock').addClass('displaynone');
	        	}
            }
        }
	})
})