<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui_design_settings_wrap" style="display: none;" >
	
	<div class="wpcui_design_settings_header">
		<h3><?php _e('Display Settings',WPCUI_DOMAIN); ?></h3>
	</div>

	<div class="wpcui_design_settings_body">

		<!-- Where to display the cookie notice -->
		<div class="wpcui_design_settings_field">
			<label><?php _e('Info Display Type',WPCUI_DOMAIN) ?></label>
			<select name="display_settings[layout][display_type]">
			<?php foreach ($options['display_type'] as $index => $value): ?>
				<option
				value="<?php echo esc_attr($value);?>"

				<?php
					if (isset($display_settings['layout']['display_type']) && $display_settings['layout']['display_type'] == $value) {
						echo "selected='selected'";
					}
				?>

				><?php echo ucwords(esc_attr($value)); ?></option>
			<?php endforeach ?>
			</select>
		</div>

		<!-- Where to display the cookie notice -->
		<div class="wpcui_design_settings_field">
			<label><?php _e('Bar Position',WPCUI_DOMAIN) ?></label>
			<select name="display_settings[layout][bar_position]">
			<?php foreach ($options['bar_position'] as $index => $value): ?>
				<option

				value="<?php echo esc_attr($value);?>"

				<?php
					if (isset($display_settings['layout']['bar_position']) && $display_settings['layout']['bar_position'] == $value) {
						echo "selected='selected'";
					}
				?>

				><?php echo ucwords(esc_attr($value)); ?></option>
			<?php endforeach ?>
			</select>
		</div>



		<!-- The template to use on cookie notice -->
		<div class="wpcui_design_settings_field">
			<label><?php _e('Template Type',WPCUI_DOMAIN) ?></label>
			<select name="display_settings[layout][bar_template_type]" class="wpcui-template-bar-image-selector">

				<?php $img_url =  WPCUI_IMAGE . 'template_images/template1.PNG'; ?>
				
				<?php foreach ($options['bar_template_type'] as $index => $value): ?>
				<!-- <pre>
					<?php //print_r($value) ?>
				</pre> -->
				<option

				value="<?php echo esc_attr($index); ?>"
				data-img="<?php echo esc_attr($value['img']); ?>"

				<?php
					if (isset($display_settings['layout']['bar_template_type']) && $display_settings['layout']['bar_template_type'] == $index) {
						echo "selected='selected'";
						$img_url = $value['img'];
					}
				?>

				><?php echo esc_attr(esc_attr($index)); ?></option>
			<?php endforeach ?>
			</select>
			<img class="wpcui-template-bar-image-container" style="display: block;" src="<?php echo $img_url; ?>">
		</div>

		<!-- Choosing Custom Template -->
		<div class="wpcui_design_settings_field">
			<label><?php _e('Custom Template',WPCUI_DOMAIN) ?></label>
			<select name="display_settings[layout][select_template_type]" id="wpcui_select_template_type">
			<?php foreach ($options['select_template_type'] as $index => $value): ?>
				<option

				value="<?php echo esc_attr($value);?>"

				<?php
					if (isset($display_settings['layout']['select_template_type']) && $display_settings['layout']['select_template_type'] == $value) {
						echo "selected='selected'";
					}
				?>

				><?php echo ucwords(esc_attr($value)); ?></option>
			<?php endforeach ?>
			</select>
		</div>

		<!-- Choosing Custom Template -->
		<div class="wpcui_design_settings_field wpcui_select_custom_template_section">
			<label><?php _e('Select Custom Template',WPCUI_DOMAIN) ?></label>
			<?php global $custom_templates; ?>
			<?php if ($custom_templates): ?>
				<select name="display_settings[layout][selected_custom_template]">
				<?php foreach ($custom_templates as $index => $value): ?>
					<option

					value="<?php echo esc_attr($value->public_id);?>"

					<?php
						if (isset($display_settings['layout']['selected_custom_template']) && $display_settings['layout']['selected_custom_template'] == $value->public_id) {
							echo "selected='selected'";
						}
					?>

					><?php echo ucwords(esc_attr($value->template_name)); ?></option>
				<?php endforeach ?>
				</select>
			<?php else: ?>
				<span><?php _e('No Custom Template added so far. Add',WPCUI_DOMAIN) ?> <a href="<?php echo admin_url('admin.php') . '?page=wpcui-custom-template-settings&action=add';?>"><?php _e('here',WPCUI_DOMAIN) ?></a></span>
			<?php endif ?>
			
		</div>

		
		
		
	</div>
</div>