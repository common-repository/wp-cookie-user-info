<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui_extra_settings_wrap" style="display: none;">
	
	<div class="wpcui_extra_settings_header">
		<h3><?php _e('Extra Settings',WPCUI_DOMAIN); ?></h3>
	</div>

	<div class="wpcui_extra_settings_body">

		<!-- Next display of the cookie notice -->
		<div class="wpcui_extra_settings_field">
			<label><?php _e('Cookie Expiry',WPCUI_DOMAIN) ?></label>
			<select name="extra_settings[extra][cookie_expiry]" class="wpcui-show-after-selector">
			<?php foreach ($options['cookie_expiry'] as $index => $value): ?>
				<option

				value="<?php echo esc_attr($value); ?>"

				<?php
					if (isset($extra_settings['extra']['cookie_expiry']) && $extra_settings['extra']['cookie_expiry'] == $value) {
						echo "selected='selected'";
					}
				?>

				><?php echo ucwords(esc_attr($value)); ?></option>
			<?php endforeach ?>
			</select>
		</div>

		<!-- Next display of the cookie notice in days -->
		<div class="wpcui_extra_settings_field wpcui-show-after-options">
			<label><?php _e('Day',WPCUI_DOMAIN) ?></label>
			<input type="number" min="0" name="extra_settings[extra][days]" value="<?php echo (!empty($extra_settings['extra']['days']))?esc_attr($extra_settings['extra']['days']):''; ?>"> <?php _e('Days',WPCUI_DOMAIN) ?>
		</div>



		
		
	</div>
</div>