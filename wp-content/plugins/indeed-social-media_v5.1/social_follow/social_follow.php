<?php 
define('ISF_PATH', plugin_dir_path(__FILE__) );
define('ISF_URL', plugin_dir_url(__FILE__) );

//shortcode admin tab
function isf_shortcode_tab(){
	include_once ISF_PATH . 'includes/functions.php';
	include_once ISF_PATH . 'includes/shortcode_tab.php';
}

//general options
function isf_general_options(){	
	include_once ISF_PATH . 'includes/functions.php';
	include_once ISF_PATH . 'includes/general_options.php';	
}

////////SHORTCODE
add_shortcode( 'ism-social-followers', 'isf_shortcode' );
function isf_shortcode($attr){
	include_once ISF_PATH . 'includes/functions.php';
	
	$meta_arr = isf_get_metas();
	$css = '';
	$js = '';
	$html = '';
	
	//Mobile
	if(isset($attr['disable_mobile']) && $attr['disable_mobile']==1 && ism_is_mobile() ) return;
	
	include ISF_PATH . 'includes/view.php';
	if(isset($attr['preview'])){
		//without JS
		return $css . $html;
	}
	return $final_str;
}

add_action("admin_enqueue_scripts", 'isf_be_head');
function isf_be_head(){
	wp_enqueue_style('isf_style', ISF_URL . 'files/css/style-backend.css' );
	if(!isset($_REQUEST['page']) || $_REQUEST['page']!='ism_manage' || !isset($_REQUEST['tab']) || $_REQUEST['tab']!='follow' )return;
	wp_enqueue_script ( 'isf_backend', ISF_URL . 'files/js/isf_back_end.js', array(), null );
	//for preview:
	wp_enqueue_style('isf_style-front_end', ISF_URL . 'files/css/style-frond_end.css' );
	wp_enqueue_style('isf_pack_social_follow', ISF_URL . 'files/css/pack_social_follow.css' );
}
add_action('wp_enqueue_scripts', 'isf_fe_head');
function isf_fe_head(){
	wp_enqueue_style('isf_style', ISF_URL . 'files/css/style-frond_end.css' );
	wp_enqueue_style('isf_pack_social_follow', ISF_URL . 'files/css/pack_social_follow.css' );
	wp_register_script( 'isf_front_end', ISF_URL . 'files/js/isf_front_end.js', array(), null  );
}

add_action( 'wp_ajax_isf_return_offline_counts', 'isf_return_offline_counts' );
add_action('wp_ajax_nopriv_isf_return_offline_counts', 'isf_return_offline_counts');
function isf_return_offline_counts(){
	include ISF_PATH . 'includes/functions.php';
	$meta_arr = isf_get_metas();
	$offline_values = array();
	$db_counts = isf_get_db_counts();
	
	//OFFLINE COUNTS
	foreach($_REQUEST['sm_types'] as $type){
		if(isset($meta_arr['isf_initial_counts'][$type])){
			$offline_values[$type] = $meta_arr['isf_initial_counts'][$type];
			if(isset($db_counts[$type])){
				$offline_values[$type.'_count'] = $db_counts[$type]['count'];
				$offline_values[$type.'_time'] = $db_counts[$type]['the_time'];
			}
		}
	}
	$data = json_encode($offline_values);
	echo $data;
	
	die();
}

//Ajax Functions for Front End
add_action( 'wp_ajax_isf_return_counts', 'isf_return_counts' );
add_action('wp_ajax_nopriv_isf_return_counts', 'isf_return_counts');
function isf_return_counts(){
	include ISF_PATH . 'includes/functions.php';
	$value = 0;
	$offline_value = $_REQUEST['off_count'];
	$type = $_REQUEST['sm_type'];
	if($offline_value=='') $offline_value = 0;
	
	//if type it's not in array return offline value
	$sm_with_counts = array('facebook', 'twitter', 'linkedin', 'pinterest', 'vk', 'google', 'delicious');
	if(!in_array($type, $sm_with_counts)){
		echo $offline_value;
		die();
	} 

	//DB COUNTS OR GETTING VALUES FROM SM IF IT'S TIME	
	if( isset($_REQUEST['the_time']) && $_REQUEST['the_time']!='' && isset($_REQUEST['db_count']) && $_REQUEST['db_count']!='' ){
		//db value exists
		$check_time = get_option('isf_check_time');
		if($check_time===FALSE) $check_time = 12; //in case isf_check_time was deleted or not saved
		$check_time = (int)$check_time * 3600;// the number of hours * 3600 seconds
		$max_date = (int)$_REQUEST['the_time'] + (int)$check_time;
		$current_time = time();
		if($current_time>$max_date){
			//its time to update
			$new_value = isf_call_get_counts($type);
			if($new_value!=FALSE){
				//update db
				isf_update_db_counts($type, $new_value);
				$value = (int)$new_value;
			}
		}else{
			//no update, just put the value from db in $value var
			$value = (int)$_REQUEST['db_count'];
		}
	}else{
		//first time 
		$new_value = isf_call_get_counts($type);
		if($new_value!=FALSE){
			//update db
			isf_update_db_counts($type, $new_value);
			$value = (int)$new_value;
		}		
	}
	
	//returning the count
	if($value==0 || $value=='') $value = $offline_value;
	echo $value;
	die();
}

add_action( 'wp_ajax_isf_admin_preview', 'isf_admin_preview' );
add_action('wp_ajax_nopriv_isf_admin_preview', 'isf_admin_preview');
function isf_admin_preview(){
	$attr = array( 'list' => $_REQUEST['list'],
					'template' => $_REQUEST['template'], 
					'list_align' => $_REQUEST['align'],
					'display_counts' => $_REQUEST['count'],
					'display_full_name' => $_REQUEST['label'],
					'display_sublabel' => $_REQUEST['sublabel'],
					'preview' => 1
				 );
	echo isf_shortcode($attr);
	die();
}



