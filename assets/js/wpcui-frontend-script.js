jQuery(document).ready(function(){

	jQuery(".wpcui-cookie-bar-display").fadeIn();


	jQuery(".wpcui-cookie-bar-info-confirm , .wpcui-cookie-bar-close-button").click(function(){
		jQuery(".wpcui-cookie-bar-display").fadeOut();
	});
});


