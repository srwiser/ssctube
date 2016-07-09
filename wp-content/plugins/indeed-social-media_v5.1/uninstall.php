<?php
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) exit();
//delete statistic table
global $wpdb;
$table_name = $wpdb->prefix . "ism_share_counts";
$sql = "DROP TABLE IF EXISTS $table_name;";
$wpdb->query($sql);

require( plugin_dir_path ( __FILE__ ) . 'includes/functions.php' );
$arr1 = array('wd', 'id', 'md', 'g_o', 's_in', 'popup', 'genie');
foreach($arr1 as $value){
	$meta_arr = ism_return_arr( $value );
	foreach($meta_arr as $k=>$v){
		delete_option($k);
	}	
	unset($meta_arr);
}

/************* uninstall follow *****************/
if(file_exists(plugin_dir_path ( __FILE__ ) . 'social_follow/social_follow.php')){
	include plugin_dir_path ( __FILE__ ) . 'social_follow/includes/functions.php';
	$meta_arr = isf_get_metas();
	foreach($meta_arr as $k=>$v){
		delete_option($k);
	}
	unset($meta_arr);
	delete_option( 'isf_follow_counts' );
	delete_option( 'ism_general_sm_labels' );
}
/************* uninstall follow *****************/

delete_post_meta_by_key( 'ism_disable_wd' );
delete_post_meta_by_key( 'ism_disable_id' );
delete_post_meta_by_key( 'ism_disable_s_in' );
delete_post_meta_by_key( 'ism_disable_popup' );
delete_post_meta_by_key( 'ism_disable_genie' );

$arr2 = array('facebook', 'twitter', 'google', 'pinterest', 'linkedin', 'stumbleupon', 'vk', 'reddit', 'print', 'email');
$arr3 = array('ism_sm_internal_counts_share', 'ism_special_count_all', 'ism_min_count', 'ism_go_custom_share_c');
foreach($arr2 as $v){
	$arr3[] = 'ism_special_count_' . $v;
}
foreach($arr3 as $val){
	if(get_option($val)!==FALSE) delete_option($val);
}
?>