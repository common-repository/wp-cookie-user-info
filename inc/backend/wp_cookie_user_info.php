<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui_container">
	<div class="wpcui_main_function_wrap">

		<?php
	//Declaring the inner join above
		global $wpdb;
		$wpcui_table = $wpdb->prefix . "wpcui_settings";
		$menu_lists = $wpdb->get_results("SELECT * FROM $wpcui_table");
		?>


		<?php include_once WPCUI_DIR_PATH . 'inc/backend/includes/wpcui-header.php'; ?>

		<?php if (count($menu_lists) == 0): ?>
			<a href="<?php echo admin_url('admin.php') . '?page=wpcui-manage-settings&action=add' ;?>" id="add_cookie_bar"><button class="wpcui_add_button button button-primary"><?php _e('Add New Cookie Info',WPCUI_DOMAIN) ?></button></a>
		<?php endif; ?>
		
		<div class="wpcui_body">

			<table class="wpcui-cookie-bar-display-table" cellspacing="0">

				<thead>
					<tr>
						<th><?php _e('Cookie Info Title',WPCUI_DOMAIN) ?></th>
						<th><?php _e('Position',WPCUI_DOMAIN) ?></th>
						<th><?php _e('Template',WPCUI_DOMAIN) ?></th>
						<th><?php _e('Actions',WPCUI_DOMAIN) ?></th>
					</tr>
				</thead>
				<tbody>

					<?php
					if (count($menu_lists) > 0)
					{
						foreach ($menu_lists as $menu):
							?>
							<tr>
								<td><a href="<?php echo admin_url('admin.php'); ?>?page=wpcui-manage-settings&action=edit&id=<?php echo $menu->id; ?>"><div class="wcui_cookie_bar_name"><?php echo esc_attr($menu->name); ?></div></a>

								</td>
								<?php $display_settings = maybe_unserialize($menu->display_settings); ?>
								<td><?php echo ucwords(esc_attr($display_settings['layout']['bar_position'])); ?></td>
								<td><?php echo esc_attr(($display_settings['layout']['display_type'] == 'bar')?($display_settings['layout']['bar_template_type']):($display_settings['layout']['popup_template_type'])); ?></td>
								<td><div class="cookie_settings_options">
									<a href="<?php echo admin_url('admin.php'); ?>?page=wpcui-manage-settings&action=edit&id=<?php echo intval($menu->id); ?>" class="wpcui_edit_button"></a>
									<a href="<?php echo get_home_url(); ?>?wpcui_notice_preview=<?php echo intval($menu->id) ?>" target="_blank" class="wpcui_preview_button"></a>
								</div></td>
							</tr>
						<?php endforeach; ?>
					<?php }

					else{

						?>
						<tr>
							<td>&nbsp;</td>
							<td><?php _e('No Cookie bar to display. Add a New Cookie Bar',WPCUI_DOMAIN) ?></td>
							<td>&nbsp;</td>
						</tr>
					<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th><?php _e('Cookie Info Title',WPCUI_DOMAIN) ?></th>
						<th><?php _e('Position',WPCUI_DOMAIN) ?></th>
						<th><?php _e('Template',WPCUI_DOMAIN) ?></th>
						<th><?php _e('Actions',WPCUI_DOMAIN) ?></th>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
<div id="wpcui-postbox-container-1" class="wpcui-postbox-container">
	<?php include(WPCUI_DIR_PATH . 'inc/backend/wpcui-sidebar.php'); ?>
</div>