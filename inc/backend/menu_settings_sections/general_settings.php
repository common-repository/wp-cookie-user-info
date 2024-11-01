<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui_struct_settings_wrap">
	
	<div class="wpcui_struct_settings_header">
		<h3><?php _e('General Settings',WPCUI_DOMAIN); ?></h3>
	</div>

	<?php
	//To fill in the options in the form
	$options = get_option('wpcui_general_option'); ?>

	<pre><?php //print_r($options) ?></pre>

	<div class="wpcui_struct_settings_body">

		<!-- Cookie Info Text or General Text notice is shown in cookie bar -->
		<div class="wpcui_struct_settings_field">
			<label><?php _e('General Text',WPCUI_DOMAIN) ?></label>

			<?php
			$allowed_html = wp_kses_allowed_html( 'post' );
			$general_value = (($result_status) && (!empty($general_settings['content']['info']['general_text'])))?($general_settings['content']['info']['general_text']):__('This site uses cookies',WPCUI_DOMAIN);
			$content = wp_kses($general_value,$allowed_html);
			$editor_id = 'wpcui_wp_editor_in_settings';
			$settings = array(
				'textarea_name' => 'general_settings[content][info][general_text]',
				'media_buttons'	=> false,
				'editor_class'	=> 'wpcui_wp_editor_in_settings',
				'editor_height'	=> 200,
				// 'quicktags'		=> array('buttons'=>'a,b,i,strong,em,ul,ol,li'),
			);
			wp_editor($content,$editor_id,$settings);?>
			
			<i class="additional_field_message">You can use basic HTML Tags such as &lt;a&gt;, &lt;strong&gt;, &lt;em&gt;, &lt;br&gt; and so on</i>	
		</div>

		<!-- Info dismiss text Agreeing to the cookie notice is confirmation text -->
		<div class="wpcui_struct_settings_field">
			<label><?php _e('Confirmation Text',WPCUI_DOMAIN) ?></label>
			<textarea name="general_settings[content][info][confirmation_text]" cols="79" rows="5"><?php echo (($result_status) && !empty($general_settings['content']['info']['confirmation_text']))?esc_attr($general_settings['content']['info']['confirmation_text']):__('Got it',WPCUI_DOMAIN); ?></textarea>		
		</div>

		<!-- Enable or Disable the close button -->
		<div class="wpcui_struct_settings_field">
			<label><?php _e('Close Button',WPCUI_DOMAIN) ?></label>
			<div class="wpcui_checkbox_wrap">
				<input type="checkbox" name="general_settings[content][info][close_button]"
			<?php
				if (($result_status) && isset($general_settings['content']['info']['close_button'])) {
					echo "checked='checked'";
				}
			?>
			id="wpcui_close_button_status"
			>
			<label for="wpcui_close_button_status"></label>
			</div>
		</div>



		<!-- Enable or Disable the More Info bar -->
		<div class="wpcui_struct_settings_field">
			<label><?php _e('More Info Status',WPCUI_DOMAIN) ?></label>
			<div class="wpcui_checkbox_wrap">
				<input class="wpcui-bulb-switch" type="checkbox" name="general_settings[content][more_info][status]"
			<?php
				if (($result_status) && isset($general_settings['content']['more_info']['status'])) {
					echo "checked='checked'";
				}
			?>
			id="wpcui_more_info_status"
			>
			<label for="wpcui_more_info_status"></label>
			</div>
		</div>

		<div class="wpcui-bulb-light">
			<!-- What text to show in more info notice -->
			<div class="wpcui_struct_settings_field">
				<label><?php _e('More Info Text',WPCUI_DOMAIN) ?></label>
				<textarea name="general_settings[content][more_info][text]" cols="79" rows="5"><?php echo (($result_status) && !empty($general_settings['content']['more_info']['text']))?esc_attr($general_settings['content']['more_info']['text']):__('More Info',WPCUI_DOMAIN); ?></textarea>
			</div>

			<div class="wpcui_struct_settings_field">
				<label><?php esc_attr_e('More Info Action',WPCUI_DOMAIN) ?></label>
				<select name="general_settings[content][more_info][action]" id="wpcui_more_info_action_selector">
					<?php foreach ($options['more_info_action'] as $index => $value): ?>
					<option value="<?php echo $value; ?>"

						<?php
							if ( isset($general_settings['content']['more_info']['action']) && $general_settings['content']['more_info']['action'] == $value) {
								echo "selected='selected'";
							}
						?>
						><?php echo ucwords(esc_attr($value)); ?></option>
					<?php endforeach ?>
				</select>
			</div>

			<!-- Link to redirect to -->
			<div class="wpcui_struct_settings_field">
				<label><?php _e('More Info Redirect Link',WPCUI_DOMAIN) ?></label>
				<input name="general_settings[content][more_info][link]" class="regular-text" type="text" name="" value="<?php echo (($result_status) && !empty($general_settings['content']['more_info']['link']))?esc_attr($general_settings['content']['more_info']['link']):__('https://en.wikipedia.org/wiki/HTTP_cookie',WPCUI_DOMAIN);?>">
			</div>

			<!-- Link target -->
			<div class="wpcui_struct_settings_field">
				<label><?php _e('Link Target',WPCUI_DOMAIN) ?></label>
				<select name="general_settings[content][more_info][link_target]">
					<?php foreach ($options['link_target'] as $index => $value): ?>
					<option

					value="<?php echo esc_attr($value); ?>"

					<?php
						if (($result_status) && isset($general_settings['content']['more_info']['link_target']) && $general_settings['content']['more_info']['link_target'] == $value) {
							echo "selected='selected'";
						}
					?>

					><?php echo ucwords(esc_attr($value)); ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		
	</div>
</div>