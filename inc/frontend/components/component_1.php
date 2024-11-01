<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui-cookie-bar-info-wrap wpcui-1-column">
	<?php $allowed_html = wp_kses_allowed_html('post') ?>
	<p><?php echo (!empty($general_settings['content']['info']['general_text']))?wp_kses($general_settings['content']['info']['general_text'],$allowed_html):''; ?></p>
</div>