<?php defined('ABSPATH') or die('No scripts for you!!'); ?>
<?php
$previouslyEmpty = false;
?>
<?php
$data = array();
$general_settings=$this->sanitize_general_setting($_POST['general_settings']);
$display_settings = $this->sanitize_text_or_array_field($_POST['display_settings']);
$extra_settings = $this->sanitize_text_or_array_field($_POST['extra_settings']);
$title = sanitize_text_field($_POST['title']);
// Sanitizing all values
// foreach ($display_settings as $main_index => $first_dim) {
// 	foreach ($first_dim as $valued_index => $value) {
// 			$display_settings[$main_index][$valued_index] = sanitize_text_field($value) ;
// 	}
// }
// foreach ($extra_settings as $main_index => $first_dim) {
// 	foreach ($first_dim as $valued_index => $value) {
// 			$extra_settings[$main_index][$valued_index] = sanitize_text_field($value) ;
// 	}
// }
setcookie('cookieExpiry' , '' , time() - (86400 * 365 * 3),'/'); //worst case 3 years
global $wpdb;
$wpdb->show_errors(); //Displays errors in wpdb in this place despite the source of error of wpdb
$table = $wpdb->prefix . 'wpcui_settings';
//For Activation on initial choice
// var_dump($prev);
$prev = $wpdb->get_row("SELECT * FROM $table");
// echo("<pre>");
// print_r($prev);
// echo("</pre>");
if($prev==NULL){
		$previouslyEmpty = true;
}
//Updating or inserting on database
$status = '';
$replaced_id = 0;
if (isset($_POST['id'])) {
	$id = intval($_POST['id']);
	$status = $wpdb->replace(
			$table,
			array(
				'id'			   => $id,
				'name'			   => $title,
				'general_settings' => maybe_serialize($general_settings),
				'display_settings' => maybe_serialize($display_settings),
				'extra_settings'   => maybe_serialize($extra_settings)
				),
					array(
						'%s',
						'%s',
						'%s',
						'%s'
					)
	);
	$replaced_id = $id;
}
else{
	$status = $wpdb->replace(
			$table,
			array(
				'name'			   => $title,
				'general_settings' => maybe_serialize($general_settings),
				'display_settings' => maybe_serialize($display_settings),
				'extra_settings'   => maybe_serialize($extra_settings)
				),
					array(
						'%s',
						'%s',
						'%s',
						'%s'
					)
	);
	$replaced_id = $wpdb->insert_id;
}
if ($previouslyEmpty) {
	$option = array(
		'status'			=> 1,
		'cookie-bar'		=> intval($wpdb->insert_id),
		'displayed_pages'	=> 'show on Home page',
    		);
	update_option('wpcui_selected_cookie_option',$option);
}
if ($status) {
		wp_redirect(admin_url('admin.php') . "?page=wpcui-manage-settings&message=1&replaced=$replaced_id");
}
else{
	wp_redirect(admin_url('admin.php') . "?page=wpcui-manage-settings&message=0");
}