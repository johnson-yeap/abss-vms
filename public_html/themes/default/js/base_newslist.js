function toloadmoreproducts(){
	if(isloading == 0 && ajaxfenye_total >= 1){
		isloading = 1;
		$('.ajaxnews_loading').show();
		var postOBJ = new Object();
		
		$.post(baseurl+'news/ajax_loadinglist/'+selected_category_id+'?row='+ajaxfenye_row, postOBJ, function (data){
			ajaxfenye_row = ajaxfenye_row + ajaxfenye_page;
			$('.news_content').show().append(data);
			if(ajaxfenye_row >= ajaxfenye_total){
				$('.ajaxnews_loading').hide();
				$('.ajaxnews_finish').show();
				isloading = 1;
			}else{
				$('.ajaxnews_loading').hide();
				isloading = 0;
			}
		})
	}else{
		if(ajaxfenye_row >= ajaxfenye_total && ajaxfenye_total > 0){
			$('.ajaxnews_loading').hide();
			$('.ajaxnews_finish').show();
			isloading = 1;
		}
	}
}
function autoscrollfixed(){
	var topDist = $(this).scrollTop();
	
	if(topDist < (218 + 35)){
		$('.news_category_area').addClass('news_category_absolute').removeClass('news_category_fixed');
	}else{
		$('.news_category_area').addClass('news_category_fixed').removeClass('news_category_absolute');
	}

	var scrollBottom = $(document).height() - $(window).height() - topDist;

	if(scrollBottom < 30){
		toloadmoreproducts();
	}

}