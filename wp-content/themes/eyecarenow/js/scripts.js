(function($){
$(document).ready(function(){
	
	//Check to see if the window is top if not then display button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.back-to-top a').fadeIn();
		} else {
			$('.back-to-top a').fadeOut();
		}
	});
	
	//Click event to scroll to top
	$('.back-to-top a').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
	$('.fancybox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
	
});
}(jQuery));