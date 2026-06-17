function togototagarea(num){
	var jutop = $('.discipline_section_'+num).offset().top;
	$("body, html").stop().animate({
		scrollTop:jutop
	}, 800);
}