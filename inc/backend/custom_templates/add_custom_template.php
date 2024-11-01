<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui_container">

	<?php include_once WPCUI_DIR_PATH . 'inc/backend/includes/wpcui-header.php'; ?>

	<?php if(isset($_GET['template_message']) && $_GET['template_message'] == 'notadded'): ?>
		<div class="notice notice-error is-dismissible"><p><?php _e('Adding Template Failed',WPCUI_DOMAIN) ?></p></div>
	<?php endif ?>


	<form method="post" action="<?php echo admin_url('admin-post.php'); ?>" class="wpcui_custom_template_form">
		
		<input type="hidden" name="action" value="save_custom_template">

		<?php wp_nonce_field('wpcui_template_nonce_field','wpcui_template_nonce'); ?>

		<div class="wpcui_custom_template_struct_wrap">
			
			<div class="wpcui_custom_template_field">
				<div class="wpcui_custom_template_title">
					<label><?php _e('Template Name',WPCUI_DOMAIN) ?></label>
					<input type="text" name="template_name" value="<?php echo (!empty($selected_template->template_name))?esc_attr($selected_template->template_name):''; ?>" class="wpcui_custom_template_name">
				</div>
			</div>
			
			<div class="wpcui_custom_color_tab_wrapper">
				<div class="wpcui_custom_template_color_tab_selector">
					<a href="javascript:void(0)" id="wpcui_bar_colors" class="wpcui_color_tab_selector wpcui_active_color_tab">
						<div class="wpcui_color_tab_content">
							<?php _e('General Settings',WPCUI_DOMAIN) ?>
						</div></a>
					<a href="javascript:void(0)" id="wpcui_info_button_colors" class="wpcui_color_tab_selector">
						<div class="wpcui_color_tab_content">
							<?php _e('Confirmation Button',WPCUI_DOMAIN) ?>
						</div></a>
					<a href="javascript:void(0)" id="wpcui_more_info_button_colors" class="wpcui_color_tab_selector">
						<div class="wpcui_color_tab_content">
							<?php _e('More Info Button',WPCUI_DOMAIN) ?>
						</div></a>
					<a href="javascript:void(0)" id="wpcui_close_button_colors" class="wpcui_color_tab_selector">
						<div class="wpcui_color_tab_content">
							<?php _e('Close Button',WPCUI_DOMAIN) ?>
						</div></a>
				</div>
				

				<div class="wpcui_custom_tab">
					<?php
					include_once 'wpcui_color_tabs/wpcui_bar_colors.php';
					include_once 'wpcui_color_tabs/wpcui_info_button_colors.php';
					include_once 'wpcui_color_tabs/wpcui_more_info_button_colors.php';
					include_once 'wpcui_color_tabs/wpcui_close_button_colors.php';
					?>
				</div>
			</div>

		</div>


		<button class="button button-primary" type="submit"><?php _e('Add',WPCUI_DOMAIN) ?></button>

	</form>

</div>