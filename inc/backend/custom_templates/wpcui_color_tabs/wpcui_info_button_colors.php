<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<!-- Start of Confirmation button display configurations -->
	<div class="wpcui_color_customizations" id="wpcui_info_button_colors_tab" style="display: none;">
				
				<!-- Confirmation button text color -->
				<div class="wpcui_design_settings_field">
					<label><?php _e('Confirmation Button Text color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[info_bar_button_color]" value="<?php echo (!empty($custom_template['info_bar_button_color']))?esc_attr($custom_template['info_bar_button_color']):__('#000000',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
				<!-- Confirmation button bg color -->
				<div class="wpcui_design_settings_field">
					<label><?php _e('Confirmation Button Background color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[info_bar_button_bg]" value="<?php echo (!empty($custom_template['info_bar_button_bg']))?esc_attr($custom_template['info_bar_button_bg']):__('#ffffff',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>


				<!-- Confirmation button hover text change -->
				<div class="wpcui_design_settings_field">
					<label><?php _e('Confirmation Button Hover Text color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[info_bar_hover_button_text_color]" value="<?php echo (!empty($custom_template['info_bar_hover_button_text_color']))?esc_attr($custom_template['info_bar_hover_button_text_color']):__('#ffffff',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
				<!-- Confirmation button hover background color -->
				<div class="wpcui_design_settings_field">
					<label><?php _e('Confirmation Button Hover Background color',WPCUI_DOMAIN) ?></label>
					<input type="text" class="wpcui-color-field color-field" name="custom_template[info_bar_hover_button_bg_color]" value="<?php echo (!empty($custom_template['info_bar_hover_button_bg_color']))?esc_attr($custom_template['info_bar_hover_button_bg_color']):__('#bababa',WPCUI_DOMAIN); ?>" data-alpha="true">
				</div>
		</div>
<!-- End of Confirmation button display configurations -->