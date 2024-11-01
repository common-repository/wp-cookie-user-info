<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui-2-column">

		<!-- Confirmation button -->
		<button class="wpcui-cookie-bar-info-confirm" type="submit"
			<?php if (!isset($_GET['preview']) && $extra_settings['extra']['cookie_expiry'] != 'show Always'): ?>
				onclick="setCookie(cname, cvalue, exdays)"
			<?php endif ?>

		><?php echo (!empty($general_settings['content']['info']['confirmation_text']))?esc_attr($general_settings['content']['info']['confirmation_text']):''; ?></button>


	<?php if (isset($general_settings['content']['more_info']['status'])): ?>
		<a
		href="<?php echo (!empty($general_settings['content']['more_info']['link']))?esc_url($general_settings['content']['more_info']['link']):'' ; ?>"
		target="<?php echo (!empty($general_settings['content']['more_info']['link_target']))?esc_attr($general_settings['content']['more_info']['link_target']):''; ?>"
		><button class="wpcui-cookie-bar-more_info"><?php echo (!empty($general_settings['content']['more_info']['text']))?esc_attr($general_settings['content']['more_info']['text']):''; ?></button></a>
	<?php endif ?>
	
</div>