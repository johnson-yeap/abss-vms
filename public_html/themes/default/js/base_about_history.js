$(document).ready(function (){
	$('.successivepresidentsarea').find('.list').hover(
		function() {
			$(this).find('.namearea_off, .year_off').hide();
			$(this).find('.namearea_on, .year_on').show();

			$(this).find('.avatararea').stop().animate({'height': 'show'}, 800, function (){
    			
    		});
			$(this).find('.summaryarea').stop().animate({'height': 'show'}, 800, function (){
    			
    		});
		},
		function() {
			$(this).find('.namearea_off, .year_off').show();
			$(this).find('.namearea_on, .year_on').hide();
			$(this).find('.avatararea').stop().hide();
			$(this).find('.summaryarea').stop().hide();
		}
	)
})