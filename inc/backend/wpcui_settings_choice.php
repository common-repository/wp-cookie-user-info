<?php defined('ABSPATH') or die('No scripts for you!!'); ?>

<!-- <pre><?php //print_r(get_option('wpcui_selected_cookie_option')) ?></pre> -->

<div class="wpcui_container">
	<div class="wpcui_main_function_wrap">
		
		<?php include_once WPCUI_DIR_PATH . 'inc/backend/includes/wpcui-header.php'; ?>
		

		<?php if (isset($_GET['choice_message']) && $_GET['choice_message'] == 'enabled'): ?>
			<div class="notice notice-success is-dismissible"><p><?php _e('Enabled and Saved',WPCUI_DOMAIN) ?></p></div>
			<?php elseif (isset($_GET['choice_message']) && $_GET['choice_message'] == 'disabled'):?>
				<div class="notice notice-info is-dismissible"><p><?php _e('Disabled',WPCUI_DOMAIN) ?></p></div>
				<?php elseif (isset($_GET['choice_message']) && $_GET['choice_message'] == 'onlyOptioned'):?>
					<div class="notice notice-info is-dismissible"><p><?php _e('Saved',WPCUI_DOMAIN) ?></p></div>
					<?php elseif (isset($_GET['choice_message']) && $_GET['choice_message'] == 'nothing'):?>
						<div class="notice notice-info is-dismissible"><p><?php _e('Changed Nothing',WPCUI_DOMAIN) ?></p></div>
						<?php elseif (isset($_GET['choice_message']) && $_GET['choice_message'] == 'fatalError'):?>
							<div class="notice notice-error is-dismissible"><p><?php _e('Fatal Error: Contact the developers for help',WPCUI_DOMAIN) ?></p></div>

						<?php endif ?>
						<div style="margin-top: 15px;"></div>

						<form method="post" action="<?php echo admin_url('admin-post.php')?>">
							
							<input type="hidden" name="action" value="save_choice_settings">

							<?php wp_nonce_field('wpcui_nonce','wpcui_nonce_field'); ?>
							<div class="wpcui_choice_settings_field">
								<label><?php _e('Enable/Disable Notice') ?></label>
								<div class="wpcui_checkbox_wrap">
									<input type="checkbox" name="status"

									<?php
									if ($selected_cookie['status']) {
										echo "checked='checked'";
									}
									?>
									id="wpcui_cookie_bar_status"
									>
									<label for="wpcui_cookie_bar_status"></label>
								</div>
							</div>
							<div class="wpcui_choice_settings_field">
								<label><?php _e('Cookie Info') ?></label>
								<?php if ($active): ?>
									<select name="selected_cookie">
										<?php foreach ($cookie_bars as $cookie_bar => $object): ?>
											<option value="<?php echo intval($object->id); ?>"

												<?php
												if ($selected_cookie['cookie-bar'] == $object->id) {
													echo "selected='selected'";
												}
												?>


												><?php echo esc_attr($object->name); ?></option>							
											<?php endforeach ?>
										</select>
										<?php else: ?>
											<i class="additional_field_message"><?php _e('Add a cookie bar first: ',WPCUI_DOMAIN) ?><a href="<?php echo admin_url('admin.php') . '?page=wpcui-manage-settings'; ?>"><?php _e('here',WPCUI_DOMAIN) ?></a><?php _e(' to select a cookie bar',WPCUI_DOMAIN) ?></i>
										<?php endif; ?>
									</div>
									<div class="wpcui_choice_settings_field">
										<label><?php _e('Display Page') ?></label>
										<select name="displayed_pages">
											<?php $options = get_option('wpcui_general_option');
											foreach ($options['displayed_pages'] as $key => $value): ?>
												<option value="<?php echo esc_attr($value); ?>"

													<?php
													if ($selected_cookie['displayed_pages'] == $value) {
														echo "selected='selected'";
													}
													?>

													><?php echo ucwords(esc_attr($value)); ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="wpcui_choice_settings_field-button">
											<button type="submit" class="button button-primary"

											<?php echo (!$active)?"disabled='disabled'":''; ?>

											><?php _e('Save Setting',WPCUI_DOMAIN) ?></button>
										</div>
									</form>
								</div>

							</div>

							<div id="wpcui-postbox-container-1" class="wpcui-postbox-container">
								<?php include(WPCUI_DIR_PATH . 'inc/backend/wpcui-sidebar.php'); ?>
							</div>