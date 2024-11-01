<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<!-- This is composed of close button -->

<?php if (isset($general_settings['content']['info']['close_button'])): ?>
	<div class="wpcui_close_btn">
	<div class="wpcui-cookie-bar-close-button wpcui-3-column"
		<?php if (!isset($_GET['preview']) && $extra_settings['extra']['cookie_expiry'] != 'show Always'): ?>
			onclick="setCookie(cname, cvalue, exdays)"
		<?php endif ?>
	></div>
</div>
<?php endif ?>