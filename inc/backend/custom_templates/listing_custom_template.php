<?php defined( 'ABSPATH' ) or die( 'No script kiddies please!' ); ?>

<div class="wpcui_container">

		<div class="wpcui_main_function_wrap">

		<?php
		//Declaring the inner join above
		global $wpdb;
		$wpcui_table = $wpdb->prefix . "wpcui_custom_template";
		$menu_lists = $wpdb->get_results("SELECT * FROM $wpcui_table");
		?>


		<?php include_once WPCUI_DIR_PATH . 'inc/backend/includes/wpcui-header.php'; ?>

			<?php if (count($menu_lists) == 0): ?>
					<a href="<?php echo admin_url('admin.php') . '?page=wpcui-custom-template-settings&action=add' ;?>" id="add_custom_template"><button class="wpcui_add_button button button-primary"><?php _e('Add New Custom Template',WPCUI_DOMAIN) ?></button></a>
				<?php endif; ?>
			
			<div class="wpcui_body">
			
				<table class="wpcui-cookie-bar-display-table" cellspacing="0">

					<thead>
						<tr>
							<th><?php _e('Custom Template Title',WPCUI_DOMAIN) ?></th>
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
							<td><a href="<?php echo admin_url('admin.php'); ?>?page=wpcui-custom-template-settings&action=edit&id=<?php echo intval($menu->id); ?>"><div class="wcui_cookie_bar_name"><?php echo esc_attr($menu->template_name); ?></div></a>
							</td>
							<td><div class="cookie_settings_options">
								<a href="<?php echo admin_url('admin.php'); ?>?page=wpcui-custom-template-settings&action=edit&id=<?php echo intval($menu->id); ?>" class="wpcui_edit_button"></a>
							</div></td>
						</tr>
							<?php endforeach; ?>
					<?php }

					else{

					 ?>
						<tr>
							<td><?php _e('No Custom Template to display. Add a New Custom Template',WPCUI_DOMAIN) ?></td>
							<td>&nbsp;</td>
						</tr>
					<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<th><?php _e('Custom Template Title',WPCUI_DOMAIN) ?></th>
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