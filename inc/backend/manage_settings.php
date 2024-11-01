<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui_container">
	<?php $title = esc_attr($action) . __('Settings',WPCUI_DOMAIN); ?>

	<?php include_once WPCUI_DIR_PATH . 'inc/backend/includes/wpcui-header.php'; ?>

	<?php
	$result_status = ($result)?true:false;
	?>


	<?php if (isset($_GET['message']) && $_GET['message'] == 1): ?>
		<div class="notice notice-success is-dismissible"><p><?php _e('Settings Updated Successfully',WPCUI_DOMAIN) ?></p></div>
	<?php elseif(isset($_GET['message']) && $_GET['message'] == 0): ?>
		<div class="notice notice-error is-dismissible"><p><?php _e('Settings Update Failed',WPCUI_DOMAIN) ?></p></div>
	<?php endif ?>

	<?php
		$general_settings = ($result_status && !empty($result->general_settings))?unserialize($result->general_settings):'';
		$display_settings = ($result_status && !empty($result->display_settings))?unserialize($result->display_settings):'';
		$extra_settings = ($result_status && !empty($result->extra_settings))?unserialize($result->extra_settings):'';
	?>

	<!-- Add a new Cookie bar -->
	<?php if ($action != 'Add New '): ?>

		<a href="<?php echo get_home_url(); ?>?wpcui_notice_preview=<?php echo intval($result->id) ?>" target="_blank">
			<button class="button button-secondary" class="wpcui-preview-button"><?php _e('Preview',WPCUI_DOMAIN) ?></button>
		</a>

	<?php endif ?>


	<form method="post" id="manageForm" action="<?php echo admin_url('admin-post.php'); ?>">

	<div class="wpcui-cookie-bar-form-container">

		
		<?php wp_nonce_field('wpcui_nonce','wpcui_nonce_field'); ?>

		<input type="hidden" name="action" value="save_manage_form_settings">

		<?php if (isset($_GET['id'])): ?>
			<input type="hidden" name="id" value="<?php echo intval($_GET['id']); ?>">
		<?php elseif ($result && !empty($result)):?>
			<input type="hidden" name="id" value="<?php echo intval($result->id); ?>">
		<?php endif ?>

		<!-- The title of cookie bar notice defined by user -->
			<div class="wpcui_title_field">
				<label><?php _e('Title',WPCUI_DOMAIN) ?></label>
				<input type="text" class="regular-text" name="title" value="<?php echo (!empty($result->name))?esc_attr($result->name):''; ?>">
			</div>

		<div class="nav-tab-wrapper">
					<a href="javascript:void(0)" class="nav-tab nav-tab-active" id="wpcui_content_nav_tab"><?php _e('Content',WPCUI_DOMAIN) ?></a>
					<a href="javascript:void(0)" class="nav-tab" id="wpcui_design_nav_tab"><?php _e('Layout',WPCUI_DOMAIN) ?></a>
					<a href="javascript:void(0)" class="nav-tab" id="wpcui_extra_nav_tab"><?php _e('Extra',WPCUI_DOMAIN) ?></a>
		</div>

	<?php
		include_once 'menu_settings_sections/general_settings.php';
		include_once 'menu_settings_sections/display_settings.php';
		include_once 'menu_settings_sections/extra_settings.php';
	?>

	<button type="submit" class="button button-primary"><?php _e('Save all settings',WPCUI_DOMAIN) ?></button>
	</div>

	</form>

</div>
<div id="wpcui-postbox-container-1" class="wpcui-postbox-container">
	<?php include(WPCUI_DIR_PATH . 'inc/backend/wpcui-sidebar.php'); ?>
</div>

