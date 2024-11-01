<?php defined('ABSPATH') or die('No scripts for you!!'); ?>



<?php

$save_choice_setting_array=$this->sanitize_text_or_array_field($_POST);
	foreach ($save_choice_setting_array as $key => $value) {
		$$key = $value;
	}

$selected_cookie = (is_numeric($selected_cookie))?intval($selected_cookie):false;

$displayed_pages = sanitize_text_field($displayed_pages);


		//First update the database with the displayable pages
		global $wpdb;
		$table = $wpdb->prefix . 'wpcui_settings';
		$database_result = $wpdb->update($table,
			array(
				'displayed_pages'=>$displayed_pages
			),
			array(
				'id'=>$selected_cookie
			),
			array(
				'%s'
			),
			array(
				'%d'
			)
		);

		
$wpdb->show_errors(); //Displays errors in wpdb in this place despite the source of error of wpdb


if (isset($selected_cookie)) {
	if (isset($status) && $status == true) {
		$data = array(
			'status'			=> $status,
			'cookie-bar'		=> $selected_cookie,
			'displayed_pages'	=> $displayed_pages,
		);
		$option_result = update_option('wpcui_selected_cookie_option',$data);
		if ($database_result || $option_result) {
			wp_redirect(admin_url('admin.php') . '?page=wpcui-choice-settings&choice_message=enabled');
		}
		else{
			wp_redirect(admin_url('admin.php') . '?page=wpcui-choice-settings&choice_message=nothing');
		}
	}
	else{

		//checking previous state for choice_message notices
		$previousStatus = 'disabled';
		if ($wpcui_selected_cookie_options = get_option('wpcui_selected_cookie_option')) {
			if ($wpcui_selected_cookie_options['status']) {
				$previousStatus = 'enabled';
			}
			else{
				$previousStatus = 'disabled';
			}
		}


				$data = array(
				'status'			=> $status,
				'cookie-bar'		=> $selected_cookie,
				'displayed_pages'	=> $displayed_pages,
					);
			$option_result = update_option('wpcui_selected_cookie_option',$data);

		if ($option_result && $previousStatus == 'enabled') {
			wp_redirect(admin_url('admin.php') . '?page=wpcui-choice-settings&choice_message=disabled');
		}
		elseif($option_result){
			wp_redirect(admin_url('admin.php') . '?page=wpcui-choice-settings&choice_message=onlyOptioned');
		}
		else{
			wp_redirect(admin_url('admin.php') . '?page=wpcui-choice-settings&choice_message=nothing');
		}
	}
	
}

?>

