<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<!-- Cookie setting -->
<script>
	function setCookie(cname, cvalue, exdays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (exdays*24*60*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    expires = (exdays == 0)?'':expires; //For per session data
	    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	}
	var cname = 'cookieExpiry';
	var cvalue = 'hold';
	var exdays = '';
	<?php
	//Managing cookies for displaying the cookie bar in the frontend
	if ($extra_settings['extra']['cookie_expiry'] == 'show After') {
		echo "exdays = " . intval($extra_settings['extra']['days']) . ";";
	}
	elseif ($extra_settings['extra']['cookie_expiry'] == 'show Once') {
		echo "exdays = 365;";
	}
	elseif ($extra_settings['extra']['cookie_expiry'] == 'per Session') {
		echo "exdays = 0;";
	}
	else{
		echo "exdays = -1;";
	}
	?>
</script>