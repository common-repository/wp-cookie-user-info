<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<!-- Close Button display configuration -->
	<div class="wpcui_color_customizations" id="wpcui_close_button_colors_tab" style="display: none;">

				<div class="wpcui_design_settings_field">
					<label><?php _e('Close Button Text Color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[close_button_button_color]" value="<?php echo (!empty($custom_template['close_button_button_color']))?esc_attr($custom_template['close_button_button_color']):__('#ffffff',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
				<div class="wpcui_design_settings_field">
					<label><?php _e('Close Button Background Color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[close_button_button_bg]" value="<?php echo (!empty($custom_template['close_button_button_bg']))?esc_attr($custom_template['close_button_button_bg']):__('#ff3a3a',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
				<div class="wpcui_design_settings_field">
					<label><?php _e('Close Button Hover Text Color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[close_button_hover_button_text_color]" value="<?php echo (!empty($custom_template['close_button_hover_button_text_color']))?esc_attr($custom_template['close_button_hover_button_text_color']):__('#dd3333',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
				<div class="wpcui_design_settings_field">
					<label><?php _e('Close Button Hover Background Color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[close_button_hover_button_bg_color]" value="<?php echo (!empty($custom_template['close_button_hover_button_bg_color']))?esc_attr($custom_template['close_button_hover_button_bg_color']):__('#ffffff',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
		</div>