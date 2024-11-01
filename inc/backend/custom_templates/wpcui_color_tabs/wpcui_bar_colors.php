<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui_color_customizations" id="wpcui_bar_colors_tab">

			<div class="wpcui_custom_template_field">
				<label><?php _e('Typography',WPCUI_DOMAIN) ?></label>
				<select name="custom_template[font_family]" class="wpcui_custom_template_preview_selector" id="wpcui_preview_font_family">
				<?php
				$families = get_option('wpcui_typo_fonts');
	            // $families = array('Raleway','ABeeZee','Aguafina Script','Open Sans','Roboto','Roboto Slab','Lato','Titillium Web','Source Sans Pro','Playfair Display','Montserrat','Khand','Oswald','Ek Mukta','Rubik','PT Sans Narrow','Poppins');
	            foreach ($families as $family): ?>
	            	<option value="<?php echo esc_attr($family) ?>"

	            		<?php
	            		if (isset($custom_template) && $custom_template['font_family'] == $family) {
	            			echo "selected='selected'";
	            		}
	            		?>

	            		><?php echo esc_attr($family) ?></option>
	            <?php endforeach ?>
				</select>
			</div>
			
			
			
			<div class="wpcui_design_settings_field">
				<label><?php _e('Confirmation Text color',WPCUI_DOMAIN) ?></label>
				<input type="text" class="wpcui-color-field color-field" name="custom_template[info_bar_color]" value="<?php echo (!empty($custom_template['info_bar_color']))?esc_attr($custom_template['info_bar_color']):__('#ffffff',WPCUI_DOMAIN); ?>" data-alpha="true" id="wpcui_preview_font_color">
			</div>
			<div class="wpcui_design_settings_field">
				<label><?php _e('Confirmation Background color',WPCUI_DOMAIN) ?></label>
				<input type="text" class="wpcui-color-field color-field" name="custom_template[info_bar_bg]" value="<?php echo (!empty($custom_template['info_bar_bg']))?esc_attr($custom_template['info_bar_bg']):__('#000000',WPCUI_DOMAIN); ?>" data-alpha="true" id="wpcui_preview_bg_color">
			</div>

			<!-- Preview Bar -->
			<div class="wpcui_custom_template_preview_wrap" id="wpcui_custom_template_preview_wrap">
					<span id="wpcui_custom_template_font"><?php _e('This is the content of the cookie bar',WPCUI_DOMAIN) ?></span>
			</div>
</div>