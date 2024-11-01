<?php defined('ABSPATH') or die('No scripts for you!!'); ?>

<div class="wpcui_header">
	<div class="wpcui_logo">
		<img src="<?php echo WPCUI_IMAGE . 'logo/cookie-user-info-2.png' ?>">
	</div>
	<div class="wpcui_title">

		<?php if ($title == 'Info'): ?>
			<h1><?php _e('WPCUI',WPCUI_DOMAIN) ?> <?php esc_html_e($title); ?></h1>

		<?php elseif($title == 'Listing'): ?>
			<h1><?php _e('WP Cookie User Info',WPCUI_DOMAIN) ?></h1>

		<?php elseif($title): ?>
			<h1><?php esc_html_e($title); ?></h1>
		
		<?php endif ?>
	</div>
</div>