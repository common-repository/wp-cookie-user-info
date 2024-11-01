<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<!-- Start of More Info button display configurations -->

	<div class="wpcui_color_customizations" id="wpcui_more_info_button_colors_tab" style="display: none;">

				<!-- More Info button text color -->
				<div class="wpcui_design_settings_field">
					<label><?php _e('More Info Button Text color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[more_info_bar_button_color]" value="<?php echo (!empty($custom_template['more_info_bar_button_color']))?esc_attr($custom_template['more_info_bar_button_color']):__('#ffffff',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
				<!-- More Info button bg color -->
				<div class="wpcui_design_settings_field">
					<label><?php _e('More Info Button Background color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[more_info_bar_button_bg]" value="<?php echo (!empty($custom_template['more_info_bar_button_bg']))?esc_attr($custom_template['more_info_bar_button_bg']):__('#dd9933',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>

				<!-- More Info button hover text change -->
				<div class="wpcui_design_settings_field">
					<label><?php _e('More Info Button Hover Text color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[more_info_bar_hover_button_text_color]" value="<?php echo (!empty($custom_template['more_info_bar_hover_button_text_color']))?esc_attr($custom_template['more_info_bar_hover_button_text_color']):__('#ffffff',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
				<!-- More Info button hover background color -->
				<div class="wpcui_design_settings_field">
					<label><?php _e('More Info Button Hover Background color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[more_info_bar_hover_button_bg_color]" value="<?php echo (!empty($custom_template['more_info_bar_hover_button_bg_color']))?esc_attr($custom_template['more_info_bar_hover_button_bg_color']):__('#e5731b',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
		</div>

<!-- End of More Info button display configurations -->