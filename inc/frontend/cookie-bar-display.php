<?php defined('ABSPATH') or die('No scripts for you!!'); ?>


	<?php
	$displayType = esc_attr($display_settings['layout']['display_type']);
	$position = ($display_settings['layout']['display_type'] == 'bar')?((esc_attr($display_settings['layout']['bar_position'] == 'top absolute'))?'top_absolute':(($display_settings['layout']['bar_position'] == 'top fixed')?'top_fixed':esc_attr($display_settings['layout']['bar_position']))):'center';
	$template = ($display_settings['layout']['display_type'] == 'bar')?(esc_attr($display_settings['layout']['bar_template_type'])):(esc_attr($display_settings['layout']['popup_template_type']));


	$display_class =  "wpcui_display_" . $displayType . "_$position" ;
	$body_class =  'wpcui_template_' . $template;
	?>

	<div class="wpcui-cookie-bar-display <?php esc_attr_e($display_class); ?>" id="wpcui_cookie_bar_main_display">


		<div class="wpcui-cookie-bar-body <?php esc_attr_e($body_class); ?>" id="wpcui_cookie_bar_main_body">
			<?php
			$display_sequence = array('1','2','3');
			foreach ($display_sequence as $index => $value) {
				include_once "components/component_$value.php";
			}
			?>
		</div>
	</div>

<?php
include_once WPCUI_DIR_PATH . 'inc/frontend/cookie_bar_expiry/cookie_button_event.php';
include_once WPCUI_DIR_PATH . 'inc/frontend/templates/custom_template_display.php';
?>
