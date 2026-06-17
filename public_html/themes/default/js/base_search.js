function toclearsearchtext(){
	$('input[name="keyword"]').val('');
	document.referrer === '' ? window.location.href = baseurl : window.history.go(-1);
}

function tochecksearchkeyword(){
	var keyword = $('input[name="keyword"]').val();
	if(keyword != ''){
		$('.searchpage_box').find('.searchinputarea').find('.btnclose').hide();
		$('.searchpage_box').find('.searchinputarea').find('.btnloading').show();
		
		location.replace(baseurl+reland+'/search?keyword='+keyword);//不可回退
		
		return false;
	}else{
		return false;
	}
}