<?php
/*
Plugin Name: Indeed Social Share & Locker Pro (shared on wplocker.com)
Plugin URI: http://www.wpindeed.com/
Description: Share your content on Social Media Networks or Lock your content before the page is shared.
Version: 5.1
Author: Nulled
Author URI: http://www.wpindeed.com/
*/
define('ISM_DIR_PATH', plugin_dir_path(__FILE__));
define('ISM_DIR_URL', plugin_dir_url(__FILE__));
define('ISM_PROTOCOL', ism_site_protocol());
define('IMTST_FLAG_LIMIT', 100);
define('IMTST_FLAG_CRASH_LIMIT', -20);

//include social_follow
if(file_exists(ISM_DIR_PATH . 'social_follow/social_follow.php')){
	include ISM_DIR_PATH . 'social_follow/social_follow.php';
}

function ism_site_protocol() {
	if(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&  $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){
		return 'https://';
	}
	return 'http://';
}

require_once( ISM_DIR_PATH . 'includes/functions.php' );
add_action ( 'admin_menu', 'ism_menu', 81 );
function ism_menu() {
	add_menu_page ( 'Social Share&Locker', 'Social Share & Locker Pro', 'manage_options',
                     'ism_manage', 'ism_manage', ISM_DIR_URL . 'files/images/icon.png' );
}

add_action('wp_enqueue_scripts', 'ism_fe_head');
function ism_fe_head(){
    wp_enqueue_style ( 'ism_font-awesome', ISM_DIR_URL . 'files/css/font-awesome.css' );
	
    wp_enqueue_style ( 'ism_style', ISM_DIR_URL . 'files/css/style-front_end.css' );
	wp_enqueue_style ( 'ism_templates', ISM_DIR_URL . 'files/css/templates.css' );

	wp_enqueue_style ( 'ism_show_effects_css', ISM_DIR_URL . 'files/css/animate.css' );	
	//include scripts in header
		wp_enqueue_script ( 'jquery');
	
    wp_enqueue_script ( 'ism_front_end_h', ISM_DIR_URL . 'files/js/front_end_header.js', array(), null );
	
    	wp_enqueue_script( 'ism_plusone', 'https://apis.google.com/js/plusone.js', array(), null );
    //register scripts
	wp_register_script( 'jquery-ui-effects', ISM_DIR_URL . 'files/js/jquery-ui-effects.min.js', array(), null );
    wp_register_script( 'ism_front_end_f', ISM_DIR_URL . 'files/js/front_end_footer.js', array(), null  );
	
    	wp_register_script ( 'ism_twitter', 'https://platform.twitter.com/widgets.js', array(), null );
    	wp_register_script( 'ism_linkedinjs', 'http://platform.linkedin.com/in.js', array(), null ); 

    //additional templates
    ism_enqueue_additional_templates();
}

add_action("admin_enqueue_scripts", 'ism_be_head');
function ism_be_head(){
    if(!isset($_REQUEST['page']) || $_REQUEST['page']!='ism_manage')return;
    wp_enqueue_style ( 'ism_style', ISM_DIR_URL . 'admin/files/css/style-back_end.css' );
    wp_enqueue_style ( 'ism_colorpicker_css', ISM_DIR_URL . 'admin/files/css/colorpicker.css' );
	wp_enqueue_script ( 'jquery' );
    	wp_enqueue_style ( 'ism_font-awesome', ISM_DIR_URL . 'files/css/font-awesome.css' );
	
   		wp_enqueue_style ( 'ism_front_end', ISM_DIR_URL . 'files/css/style-front_end.css' );
   		wp_enqueue_style ( 'ism_templates', ISM_DIR_URL . 'files/css/templates.css' );
    
    if( function_exists( 'wp_enqueue_media' ) ){
        wp_enqueue_media();
        wp_enqueue_script ( 'ism_open_media_3_5', ISM_DIR_URL . 'admin/files/js/open_media_3_5.js', array(), null );
    }else{
        wp_enqueue_style( 'thickbox' );
        wp_enqueue_script( 'thickbox' );
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_script ( 'ism_open_media_3_4', ISM_DIR_URL . 'admin/files/js/open_media_3_4.js', array(), null );
    }
    wp_enqueue_script ( 'ism_colorpicker_js', ISM_DIR_URL . 'admin/files/js/colorpicker.js', array(), null );
    wp_enqueue_script ( 'ism_js_functions', ISM_DIR_URL . 'admin/files/js/functions.js', array(), null );   

    if(isset($_REQUEST['tab']) && $_REQUEST['tab']=='statistics'){
    	#statistic page
    	wp_enqueue_script ( 'ism_jquery_flot', ISM_DIR_URL . 'admin/files/js/jquery.flot.js', array(), null );
    	wp_enqueue_script ( 'ism_jquery_flot_time', ISM_DIR_URL . 'admin/files/js/jquery.flot.time.js', array(), null );
    	wp_enqueue_style ( 'ism_jquery-ui.min.css', ISM_DIR_URL . 'files/css/jquery-ui.min.css' );//for date picker
    	wp_enqueue_script ( 'ism_date_picker', ISM_DIR_URL . 'admin/files/js/date_picker-jquery-ui.min.js', array(), null );//for date picker    	
    }
    
    //additional templates
    ism_enqueue_additional_templates();
}
function ism_manage(){
    require( ISM_DIR_PATH . 'admin/manage.php' );
}

/**************GENERAL CUSTOM CSS*********************/
add_action('wp_head', 'ism_print_general_custom_css', 99, 0);
function ism_print_general_custom_css(){
	$css = get_option('ism_general_custom_css');
	if($css){
		echo '<style type="text/css">'.$css.'</style>';
	}
}


/********************* SHORTCODE *********************/
add_shortcode( 'indeed-social-media', 'ism_shortcode' );
function ism_shortcode($attr){
    $html = "";
    $js = "";
    $css = "";
    $shortcode_meta = ism_remove_arr_prefix($attr, 'sm_');//remove sm from each shortcode attr array key
    $meta_arr = $shortcode_meta;
    if(!isset($meta_arr['type'])) $meta_arr['type'] = 'ism-shortcode-display';
    $meta_arr = array_merge($meta_arr, ism_return_arr_val('g_o') );// adding general options to meta_arr
    
    //if NO items return
    if(!isset($meta_arr['list']) || $meta_arr['list']=='') return;
    
    //Mobile
    if(isset($meta_arr['disable_mobile']) && $meta_arr['disable_mobile']==1 && ism_is_mobile() ) return '';
    
    require( ISM_DIR_PATH . 'includes/ism_view.php' );
    //for isi:
    if(isset($attr['isi_type_return']) && $attr['isi_type_return']==true){
    	$return_arr['html'] = $html;
    	$return_arr['css'] = $css;
    	return $return_arr;
    }
    //default:
    return $js . $css . $html;
}

/********************* SHORTCODE LOCKER *********************/
add_shortcode( 'indeed-social-locker', 'ism_locker_shortcode' );
function ism_locker_shortcode($attr, $content=null, $vc_set = false){
	//Mobile
	if(isset($attr['disable_mobile']) && $attr['disable_mobile']==1 && ism_is_mobile() ){
		if($vc_set===true) return '';
		return do_shortcode($content);
	}

	//REGISTERED USER
	if(isset($attr['not_registered_u']) && $attr['not_registered_u']==1 && is_user_logged_in() == 1){
		if($vc_set===true) return '';
		return do_shortcode($content);
	}
	wp_enqueue_script ( 'ism_json2', ISM_DIR_URL . 'files/js/json2.js', array(), null );
    wp_enqueue_script ( 'ism_jstorage', ISM_DIR_URL . 'files/js/jstorage.js', array(), null );
	
	$attr['locker_rand'] = rand( 1,5000 );
	$attr['content_id'] = "indeed_locker_content_" . $attr['locker_rand'];
	$attr['locker_div_id'] = "indeed_locker_" . $attr['locker_rand'];
	if(!isset($attr['ism_overlock']) || $attr['ism_overlock']=='' ) $attr['ism_overlock'] = 'default';

	//TWITTER HIDE
	if(isset($attr['twitter_hide_mobile']) && $attr['twitter_hide_mobile']==1 && strpos($attr['sm_list'], 'tw')!==FALSE && ism_is_mobile() ){
		$attr['sm_list'] = str_replace('tw', '', $attr['sm_list']);// exclude twitter from the list
		if($attr['sm_list']==''){
			if($vc_set===true) return '';
			return do_shortcode($content);//if the remaining list it's empty return the content
		}
	}

	if(!isset($attr['type'])) $attr['type'] = 'ism-locker';
	$ism = ism_shortcode($attr);
	include_once ISM_DIR_PATH . 'lockers/content.php';
	if(!isset($attr['locker_template']) || $attr['locker_template']=='') $attr['locker_template'] = 1;
	$content_box = GetLockerContent($attr['locker_template'], $ism, $attr);

	///URL
	if(isset($attr['ism_url_type']) && $attr['ism_url_type']=='permalink') $url = get_permalink();
	else $url = ISM_PROTOCOL.$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

	$url = ism_custom_share_url_return($url);// if custom share url
	$return_str = "";

	//TIMEOUT
	if(isset($attr['enable_timeout_lk']) && $attr['enable_timeout_lk']==1 && isset($attr['sm_timeout_locker'])) $return_str .= ism_add_timeout($attr['content_id'], $attr['locker_div_id'], $attr['sm_timeout_locker']);
	if(isset($attr['reset_locker']) && $attr['reset_locker']==1 && isset($attr['locker_reset_after']) && isset($attr['locker_reset_type'])) $return_str .= ism_return_reset_after($attr['locker_reset_after'], $attr['locker_reset_type'], $url, $return_str);

	if($vc_set===true){
		/////////// VISUAL COMPOSER
		$lock_msg = "<div style='text-align: center;'>".htmlspecialchars_decode($attr['sm_d_text'])."</div>";
		$return_str .= "<div id='".$attr['locker_div_id']."' style='display: none;'>" . $content_box . "</div>";
		$return_str .= "<div class='ism-before-row' data-ism_overlock='".$attr['ism_overlock']."' data-ism_url='".$url."' data-vc_set='1' data-lockerId='".$attr['locker_div_id']."' data-id='".$attr['content_id']."' style='display: none;'></div>";
	}else{
		$return_str .= "<div id='".$attr['content_id']."' style='display: none;'>" . do_shortcode($content) . "</div>";
		$return_str .= "<div id='".$attr['locker_div_id']."' style='display: none;' >" . $content_box . "</div>";
		$return_str .= "<div class='ism-before-row' data-ism_overlock='".$attr['ism_overlock']."' data-ism_url='".$url."' data-vc_set='0' data-lockerId='".$attr['locker_div_id']."' data-id='".$attr['content_id']."' style='display: none;'></div>";
	}
	return $return_str;
}

/*************************** WEBSITE DISPLAY ****************************/
add_action('wp_footer', 'ism_filter');
function ism_filter(){
	$html = "";
	$js = "";
	$css = "";
		
	$meta_arr = ism_return_arr_val('wd');
	$meta_arr = ism_remove_arr_prefix($meta_arr, 'wd_');
	if(!isset($meta_arr['type'])) $meta_arr['type'] = 'ism-website-display';

	$meta_arr = array_merge($meta_arr, ism_return_arr_val('g_o') );// adding general options to meta_arr
	
	//if NO items return
	if(!isset($meta_arr['list']) || $meta_arr['list']=='') return;  
		  
	//Mobile
	if(isset($meta_arr['disable_mobile']) && $meta_arr['disable_mobile']==1 && ism_is_mobile() ) return;
	
	if( ism_if_display($meta_arr['display_where'], 'ism_disable_wd') ){
		require( ISM_DIR_PATH . 'includes/ism_view.php' );
		echo $js . $css . $html;
	}
}

/************************ CONTENT DISPLAY ****************************/
add_filter( 'the_content', 'ism_before_content_check', 12 );
function ism_before_content_check( $content ) {
	$html = "";
    $js = "";
    $css = "";
    $arr = ism_return_arr_val('id');
    $meta_arr = ism_remove_arr_prefix($arr, 'id_');
    if(!isset($meta_arr['type'])) $meta_arr['type'] = 'ism-content-display';
    
    $meta_arr = array_merge($meta_arr, ism_return_arr_val('g_o') );// adding general options to meta_arr 

	//if NO items return
	if(!isset($meta_arr['list']) || $meta_arr['list']=='') return $content;  
  
    //Mobile
    if(isset($meta_arr['disable_mobile']) && $meta_arr['disable_mobile']==1 && ism_is_mobile() ) return $content;
  
    if( ism_if_display($meta_arr['display_where'], 'ism_disable_id') ){
		require( ISM_DIR_PATH . 'includes/ism_view.php' );
  	}
  	switch($meta_arr['position']){
        case 'both':  //before & after
            $content = $js . $css . $html . $content . $html;
        break;
        case 'before': //before
            $content = $js . $css . $html . $content;
        break;
        case 'after':
            $content .= $js . $css . $html;
        break;
        default:
        break;
  	}
  	//PRINT OUTSIDE
	if(isset($meta_arr['position']) && $meta_arr['position']=='custom'){
        global $ism_string_return;
        $ism_string_return = $js . $css . $html;
        add_action('wp_footer', 'ism_print_content_outside');
        $content = '<div id="indeed_top_ism" class="indeed_top_ism"></div><div id="fb-root"></div>'.$content.'<div id="indeed_bottom_ism" class="indeed_bottom_ism"></div>';        
  	}
  	
    if( isset($post->post_type) && ($post->post_type=='bp_members' || $post->post_type=='bp_activity' || $post->post_type=='bp_group') ) echo $content;
    else return $content;
}

/********************** MOBILE DISPLAY ************************/
add_action('wp_footer', 'ism_mobile_display');
function ism_mobile_display(){
	if(!ism_is_mobile()) return;

	$html = "";
	$js = "";
	$css = "";
	$meta_arr = ism_return_arr_val('md');
	$meta_arr = ism_remove_arr_prefix($meta_arr, 'md_');
	$meta_arr = array_merge($meta_arr, ism_return_arr_val('g_o') );// adding general options to meta_arr
	
	//if NO items return
	if(!isset($meta_arr['list']) || $meta_arr['list']=='') return;
	if(!isset($meta_arr['type'])) $meta_arr['type'] = 'ism-mobile-display';
	

	if( ism_if_display($meta_arr['display_where']) ){
		require( ISM_DIR_PATH . 'includes/ism_view.php' );
		echo $js . $css . $html;
	}
}

/********************** SLIDE IN DISPLAY ************************/
add_action('wp_footer', 'ism_slide_in_display');
function ism_slide_in_display(){
	$html = "";
	$js = "";
	$css = "";
	$meta_arr = ism_return_arr_val('s_in');
	$meta_arr = ism_remove_arr_prefix($meta_arr, 's_in_');
	if(!isset($meta_arr['type'])) $meta_arr['type'] = 'ism-slider';
	$meta_arr = array_merge($meta_arr, ism_return_arr_val('g_o') );// adding general options to meta_arr
	
	//if no items return
	if(!isset($meta_arr['list']) || $meta_arr['list']=='') return;

	//if Mobile
	if(isset($meta_arr['disable_mobile']) && $meta_arr['disable_mobile']==1 && ism_is_mobile() ) return;
	
	if( ism_if_display($meta_arr['display_where'], 'ism_disable_s_in') ){
		require( ISM_DIR_PATH . 'includes/views/ism_view-slide.php' );
		echo $js . $css . $html;
	}
}
/********************** POPUP DISPLAY ************************/
add_action('wp_footer', 'ism_popup_display');
function ism_popup_display(){
	$html = "";
	$js = "";
	$css = "";
	$meta_arr = ism_return_arr_val('popup');
	$meta_arr = ism_remove_arr_prefix($meta_arr, 'popup_');
	if(!isset($meta_arr['type'])) $meta_arr['type'] = 'ism-popup';
	$meta_arr = array_merge($meta_arr, ism_return_arr_val('g_o') );// adding general options to meta_arr
	
	//if no items return
	if(!isset($meta_arr['list']) || $meta_arr['list']=='') return;	
	
	//if Mobile
	if(isset($meta_arr['disable_mobile']) && $meta_arr['disable_mobile']==1 && ism_is_mobile() ) return;
	
	if( ism_if_display($meta_arr['display_where'], 'ism_disable_popup') ){
		require( ISM_DIR_PATH . 'includes/views/ism_view-popup.php' );
		echo $js . $css . $html;
	}
}


add_filter('get_the_excerpt', 'ism_cancel_inside_display', 5); 
function ism_cancel_inside_display($content) {
	remove_filter('the_content', 'ism_before_content_check');
	return $content;
}

function ism_print_content_outside(){
    global $ism_string_return;
    if(isset($ism_string_return) && $ism_string_return!='')
    echo $ism_string_return;
    unset($ism_string_return);
}

/////////////AJAX
add_action( 'wp_ajax_ism_a_return_counts', 'ism_a_return_counts' );
add_action('wp_ajax_nopriv_ism_a_return_counts', 'ism_a_return_counts');
function ism_a_return_counts() {
    $arr = array();
    $num = 0;
    switch($_REQUEST['sm_type']){
        //facebook
        case 'facebook':
        	$url = "http://graph.facebook.com/?id=".$_REQUEST['dir_url'];
        	$data = ism_get_data_from_url( $url );
            @$result = json_decode($data);
            if(isset($result->shares)) $num = (int)$result->shares;
        break;
        case 'twitter':
        	$url = "http://cdn.api.twitter.com/1/urls/count.json?url=".$_REQUEST['dir_url']."&callback=?";
			$data = ism_get_data_from_url( $url );
            @$result = json_decode($data);
            if(isset($result->count)) $num = (int)$result->count;
        break;
        case 'google':
        	$url = "https://plusone.google.com/u/0/_/+1/fastbutton?url=".$_REQUEST['dir_url']."&count=true";
        	$data = ism_get_data_from_url( $url );
        	if (preg_match("/window\.__SSR\s=\s\{c:\s([0-9]+)\.0/", $data, $matches)) $num = (int)$matches[1];
        break;
        case 'linkedin':
        	$url = "http://www.linkedin.com/countserv/count/share?format=json&url=".$_REQUEST['dir_url']."&callback=?";
            $data = ism_get_data_from_url( $url );
            if(strpos($data, 'IN.Tags.Share.handleCount(')!==FALSE){
                $data = str_replace('IN.Tags.Share.handleCount(', '', $data);
                $data = str_replace(');', '', $data);
            }
            @$result = json_decode($data);
            if(isset($result->count)) $num = (int)$result->count;
        break;
        case 'pinterest':
        	$url = "http://api.pinterest.com/v1/urls/count.json?url=".$_REQUEST['dir_url'];
            $data = ism_get_data_from_url( $url );
          	@$data = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $data);
          	@$result = json_decode($data);
          	if (isset($result->count) && is_int($result->count)) $num = (int)$result->count;
        break;
        case 'stumbleupon':
        	$url = "http://www.stumbleupon.com/services/1.01/badge.getinfo?url=".$_REQUEST['dir_url'];
            $data = ism_get_data_from_url( $url );
        	@$result = json_decode($data);
            if (isset($result->result->views)) $num = (int)$result->result->views;
        break;
        case 'vk':
        	$url = 'http://vk.com/share.php?act=count&url='.$_REQUEST['dir_url'];
            $data = ism_get_data_from_url( $url );
        	if (preg_match( '/^VK\.Share\.count\(\d, (\d+)\);$/i', $data, $matches ))  $num = (int)$matches[1];
        break;
		case 'reddit':
			$url = 'http://www.reddit.com/api/info.json?url='.$_REQUEST['dir_url'];
			@$data = ism_get_data_from_url( $url );
			@$result = json_decode($data);
            if (isset($result->data->children[0]->data->score)) $num = (int)$result->data->children[0]->data->score;
		break;
		case 'print':
			$data = get_option('ism_sm_internal_counts_share');
			if($data!==FALSE){
				$arr = json_decode($data, TRUE);
				if(!isset($arr[$_REQUEST['dir_url']]['print'])) $num = 0;
				else $num = $arr[$_REQUEST['dir_url']]['print'];
			}else $num = 0;
		break;
		case 'email':
			$data = get_option('ism_sm_internal_counts_share');
			if($data!==FALSE){
				$arr = json_decode($data, TRUE);
				if(!isset($arr[$_REQUEST['dir_url']]['email'])) $num = 0;
				else $num = $arr[$_REQUEST['dir_url']]['email'];
			}else $num = 0;
		break;
		case 'ok':
			$url = 'http://ok.ru/dk?st.cmd=extLike&uid=odklcnt0&ref='.$_REQUEST['dir_url'];
			$data = ism_get_data_from_url( $url );
			if($data!==FALSE){
				preg_match('/^ODKL\.updateCount\(\'odklcnt0\',\'(\d+)\'\);$/i', $data, $arr );
				if(isset($arr[1]) && $arr[1]!=FALSE) $num = $arr[1];				
			}else $num = 0;

		break;
		case 'bufferapp':
			$num = 0;
			$url = 'https://api.bufferapp.com/1/links/shares.json?url='.$_REQUEST['dir_url'];
			$data = ism_get_data_from_url( $url );
			if($data!==FALSE){
				@$result = json_decode($data);
				if (isset($result->shares) && $result->shares!='') $num = (int)$result->shares;				
			}		
		break;
    }
    $num = $num + ism_test_special_counts($_REQUEST['sm_type'], $_REQUEST['dir_url']);
    if(ism_return_min_count_sm($_REQUEST['sm_type'])!==FALSE){
    	if($num>=ism_return_min_count_sm($_REQUEST['sm_type'])) echo $num;
    	else echo '';
    }else echo $num;
    die();
}

add_action( 'wp_ajax_ism_admin_items_preview', 'ism_admin_items_preview' );
add_action('wp_ajax_nopriv_ism_admin_items_preview', 'ism_admin_items_preview');
function ism_admin_items_preview() {
    $str = '';
    $ism_list = ism_return_general_labels_sm( $type='long_keys', true, '' );
    $items = array( array(
                            'type' => 'facebook',
                            'label' => '',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'twitter',
                            'label' => '',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'google',
                            'label' => '',
                            'icon' => true,
                            'count' => false
                         ),
                    array(
                            'type' => 'pinterest',
                            'label' => '',
                            'icon' => true,
                            'count' => false
                         ),
                    array(
                            'type' => 'linkedin',
                            'label' => '',
                            'icon' => true,
                            'count' => false
                         ),
                    array(
                            'type' => 'digg',
                            'label' => $ism_list['digg'],//'DiggDigg',
                            'icon' => true,
                            'count' => false
                         ),
                    array(
                            'type' => 'stumbleupon',
                            'label' => $ism_list['stumbleupon'],//'Stumbleupon',
                            'icon' => true,
                            'count' => true
                         ),
                    array(
                            'type' => 'tumblr',
                            'label' => 'Tumblr',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'vk',
                            'label' => $ism_list['vk'],//'VKontakte',
                            'icon' => true,
                            'count' => true,
                         ),
                    array(
                            'type' => 'reddit',
                            'label' => $ism_list['reddit'],//'Reddit',
                            'icon' => true,
                            'count' => true,
                         ),
                    array(
                            'type' => 'delicious',
                            'label' => $ism_list['delicious'],//'Delicious',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'weibo',
                            'label' => $ism_list['weibo'],//'Weibo',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'xing',
                            'label' => $ism_list['xing'],//'Xing',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'print',
                            'label' => $ism_list['print'],//'PrintFriendly',
                            'icon' => true,
                            'count' => true,
                         ),					 
                    array(
                            'type' => 'email',
                            'label' => $ism_list['email'],//'email',
                            'icon' => true,
                            'count' => false,
                         ),
                  );
    if($_REQUEST['template']=='ism_template_9'){
    $items = array( array(
                            'type' => 'facebook',
                            'label' => $ism_list['facebook'],//'Facebook',
                            'icon' => true,
                            'count' => true,
                         ),
                    array(
                            'type' => 'twitter',
                            'label' => $ism_list['twitter'],//'Twitter',
                            'icon' => true,
                            'count' => true,
                         ),
                    array(
                            'type' => 'google',
                            'label' => $ism_list['google'],//'Google',
                            'icon' => true,
                            'count' => true
                         ),
                    array(
                            'type' => 'pinterest',
                            'label' => $ism_list['pinterest'],//'Pinterest',
                            'icon' => true,
                            'count' => true
                         ),
                    array(
                            'type' => 'linkedin',
                            'label' => $ism_list['linkedin'],//'Linkedin',
                            'icon' => true,
                            'count' => true
                         ),
                    array(
                            'type' => 'digg',
                            'label' => $ism_list['digg'],//'DiggDigg',
                            'icon' => true,
                            'count' => false
                         ),
                    array(
                            'type' => 'stumbleupon',
                            'label' => $ism_list['stumbleupon'],//'Stumbleupon',
                            'icon' => true,
                            'count' => true
                         ),
                    array(
                            'type' => 'tumblr',
                            'label' => $ism_list['tumblr'],//'Tumblr',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'vk',
                            'label' => $ism_list['vk'],//'VKontakte',
                            'icon' => true,
                            'count' => true,
                         ),
                    array(
                            'type' => 'reddit',
                            'label' => $ism_list['reddit'],//'Reddit',
                            'icon' => true,
                            'count' => true,
                         ),
                    array(
                            'type' => 'delicious',
                            'label' => $ism_list['delicious'],//'Delicious',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'weibo',
                            'label' => $ism_list['weibo'],//'Weibo',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'xing',
                            'label' => $ism_list['xing'],//'Xing',
                            'icon' => true,
                            'count' => false,
                         ),
                    array(
                            'type' => 'print',
                            'label' => $ism_list['print'],//'PrintFriendly',
                            'icon' => true,
                            'count' => true,
                         ),	
                    array(
                            'type' => 'email',
                            'label' => $ism_list['email'],//'email',
                            'icon' => true,
                            'count' => false,
                         ),
                  );
        $align = 'vertical';
    }
    else $align = 'horizontal';
    $str .= '<div class="ism_wrap '.$_REQUEST['template'].'" >';
    foreach($items as $arr){
        $str .= ism_preview_items_be( $arr, $align );
    }
    $str .= '</div>';
    echo $str;
    die();
}

add_action( 'add_meta_boxes', 'ism_custom_meta_boxes' );
function ism_custom_meta_boxes(){
	include_once ISM_DIR_PATH . 'admin/functions/admin_functions.php';
	add_meta_box('ism_disable',
				'Social Share & Locker Settings',
				'ism_return_meta_box',
				'post',
				'side',
				'high');
	add_meta_box('ism_disable',
				'Social Share & Locker Settings',
				'ism_return_meta_box',
				'page',
				'side',
				'high');
	//custom post type
	$cpt_arr = ism_return_all_cpt(array('bp_group', 'bp_activity', 'bp_members', 'product'));
	if($cpt_arr!==FALSE && count($cpt_arr)>0){
		foreach($cpt_arr as $value){
			add_meta_box(   'ism_disable',
						    'Social Share & Locker Settings',
							'ism_return_meta_box',//available in admin_functions.php
							$value,
							'side',
							'high');			
		}
	}
}

//save custom metabox values
add_action('save_post', 'ism_save_post_de', 99, 1);
function ism_save_post_de($post_id){
	$arr = array('ism_disable_wd', 'ism_disable_id', 'ism_disable_s_in', 'ism_disable_popup', 'ism_disable_genie');
	if ( ! function_exists( 'is_plugin_active' ) )
		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	if( is_plugin_active('indeed-share-bar/indeed-share-bar.php') ) $arr[] = 'ism_disable_isb';
	foreach($arr as $v){
		if(isset($_REQUEST[$v])){
			$disable = get_post_meta($post_id, $v, TRUE);
			if(isset($disable)) update_post_meta($post_id, $v, $_REQUEST[$v]);
			else add_post_meta($post_id, $v, $_REQUEST[$v], TRUE);
		}
	}
}

//send email popup
add_action( 'wp_ajax_ism_send_email_ajax_popup', 'ism_send_email_ajax_popup' );
add_action('wp_ajax_nopriv_ism_send_email_ajax_popup', 'ism_send_email_ajax_popup');
function ism_send_email_ajax_popup() {
    require ISM_DIR_PATH . "includes/send_email_popup.php";
}
add_action( 'wp_ajax_ism_sendEmail', 'ism_sendEmail' );
add_action('wp_ajax_nopriv_ism_sendEmail', 'ism_sendEmail');
function ism_sendEmail() {
	/*****************SEND EMAIL****************/
   if( isset($_REQUEST['capcha_key']) && $_REQUEST['capcha_key']!='' ){
        if(ism_capcha_a( $_REQUEST['capcha_key'] )!=$_REQUEST['capcha']){
            echo 2;
            die();
        }
   }
    $email_regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    $subject = $_REQUEST['subject'];
    $message = stripslashes( $_REQUEST['message'] );
    if( $_REQUEST['name']!='' && $_REQUEST['from']!='' ){
        if (!preg_match($email_regex, $_REQUEST['from'])){
            echo 0;
            die();
        }
        $headers = 'From: '.$_REQUEST['name'].' <'.$_REQUEST['from'].'>' . "\r\n";
    }
    else{
        echo 0;
        die();
    }
    if($_REQUEST['sentTo']!=''){
        $to = $_REQUEST['sentTo'];
        if(strpos($to, ',')!==false){
            //multiple adrr
            $email_arr = explode(',', $to);
            foreach($email_arr as $email){
                if (!preg_match($email_regex, $email)){
                    echo 0;
                    die();
                }
            }
        }else{
                if (!preg_match($email_regex, $to)){
                    echo 0;
                    die();
                }
        }
    }
    else{
        echo 0;
        die();
    }
    if(get_option('email_send_copy')!='') $to .= ',' . get_option('email_send_copy');

    $sent = wp_mail($to, $subject, $message, $headers ); //wp_mail($to, $subject, $message, $headers, $attachments )
    if($sent){
    	$data = get_option('ism_sm_internal_counts_share');
    	if($data!==FALSE){
    		$arr = json_decode($data, TRUE);
    		if(!isset($arr[$_REQUEST['the_url']]['email'])) $arr[$_REQUEST['the_url']]['email'] = 1;
    		else $arr[$_REQUEST['the_url']]['email'] = (int)$arr[$_REQUEST['the_url']]['email'] + 1;
    	}else $arr[$_REQUEST['the_url']]['email'] = 1;
    	$new_data = json_encode($arr);
    	if(get_option('ism_sm_internal_counts_share')!==FALSE){
    		update_option('ism_sm_internal_counts_share', $new_data);
    	}else{
    		add_option('ism_sm_internal_counts_share', $new_data);
    	}
        echo 1;
    }
    else echo 0;
   die();
}
//printfriendly counter
add_action( 'wp_ajax_ism_print_friendly', 'ism_print_friendly' );
add_action('wp_ajax_nopriv_ism_print_friendly', 'ism_print_friendly');
function ism_print_friendly() {
	$data = get_option('ism_sm_internal_counts_share');
	if($data!==FALSE){
		$arr = json_decode($data, TRUE);
		if(!isset($arr[$_REQUEST['the_url']]['print'])) $arr[$_REQUEST['the_url']]['print'] = 1;
		else $arr[$_REQUEST['the_url']]['print'] = (int)$arr[$_REQUEST['the_url']]['print'] + 1;
	}else $arr[$_REQUEST['the_url']]['print'] = 1;	
	$new_data = json_encode($arr);
	if(get_option('ism_sm_internal_counts_share')!==FALSE){
		update_option('ism_sm_internal_counts_share', $new_data);
	}else{
		add_option('ism_sm_internal_counts_share', $new_data);
	}
}

//pinterest popup
add_action( 'wp_ajax_ism_pinterest_popup', 'ism_pinterest_popup' );
add_action('wp_ajax_nopriv_ism_pinterest_popup', 'ism_pinterest_popup');
function ism_pinterest_popup() {
	echo ism_return_pinterest_popup();
	die();
}
//pinterest after action popup
add_action( 'wp_ajax_ism_pinterest_popup_after_action', 'ism_pinterest_popup_after_action' );
add_action('wp_ajax_nopriv_ism_pinterest_popup_after_action', 'ism_pinterest_popup_after_action');
function ism_pinterest_popup_after_action() {
	echo ism_return_pinterest_popup_after_action();
	die();
}

//DELETE SPECIAL COUNTS
add_action( 'wp_ajax_ism_delete_special_count', 'ism_delete_special_count' );
add_action('wp_ajax_nopriv_ism_delete_special_count', 'ism_delete_special_count');
function ism_delete_special_count(){
	if($_REQUEST['the_url']=='all'){
		$arr = get_option('ism_special_count_all');
		$arr[$_REQUEST['the_type']] = '';
		update_option('ism_special_count_all', $arr);
	}else{
		$arr = get_option('ism_special_count_'.$_REQUEST['the_type']);
		$arr[$_REQUEST['the_url']] = '';
		update_option('ism_special_count_'.$_REQUEST['the_type'], $arr);
	}echo 1;
	die();
}

/**************************************** MINIM START COUNTS ************************************/
//UPDATE
add_action( 'wp_ajax_ism_update_min_count', 'ism_update_min_count' );
add_action('wp_ajax_nopriv_ism_update_min_count', 'ism_update_min_count');
function ism_update_min_count(){
	if(isset($_REQUEST['sm']) && isset($_REQUEST['count'])){
		if(get_option('ism_min_count')===FALSE){
			//add this new option
			$arr[$_REQUEST['sm']] = $_REQUEST['count'];
			add_option('ism_min_count', $arr);
		}else{
			//update
			$arr = get_option('ism_min_count');
			$arr[$_REQUEST['sm']] = $_REQUEST['count'];
			update_option('ism_min_count', $arr);
		}
		echo 1;
	}else echo 0;
	die();
}
//RETURN MIN COUNT START
add_action( 'wp_ajax_ism_return_min_count_table', 'ism_return_min_count_table' );
add_action('wp_ajax_nopriv_ism_return_min_count_table', 'ism_return_min_count_table'); 
function ism_return_min_count_table(){
	$ism_display_statistics_c_for_nci = get_option('ism_display_statistics_c_for_nci');
	if($ism_display_statistics_c_for_nci==1){
		$ism_list = ism_return_general_labels_sm( 'long_keys', true );
	}else{
		$ism_list = ism_return_general_labels_sm( 'long_keys', true, 'count' );
	}
	
	@$arr = get_option('ism_min_count');
	if($arr!==FALSE && count($arr)>0){
		$str = '<tr style="background-color: #fff;">
												<td class="ism-top-table" style="font-weight:bold; text-align:left;">Social Network</td>
												<td class="ism-top-table" style="font-weight:bold; color: rgb(28, 134, 188);font-size: 12px;">Counts</td>
												<td class="ism-top-table" style="font-weight:bold; text-align:left;"></td>
											</tr>';
		foreach($arr as $k=>$v){
			if($v!=''){
				$str .= "<tr id='ism_count_min_sm-{$k}'>
							<td>{$ism_list[$k]}</td>
							<td>{$v}</td>
							<td>
							<i class='icon-trash' title='Delete' onClick='ism_deleteMinCount(\"{$k}\", \"#ism_count_min_sm-{$k}\");'></i>
							</td>
						</tr>";	
			}
		}
		echo $str;
	}else echo 0;
	die();
}
//DELETE MIN COUNT START
add_action( 'wp_ajax_ism_delete_min_count', 'ism_delete_min_count' );
add_action('wp_ajax_nopriv_ism_delete_min_count', 'ism_delete_min_count');
function ism_delete_min_count(){
	if(isset($_REQUEST['sm'])){
		$arr = get_option('ism_min_count');
		$arr[$_REQUEST['sm']] = '';
		update_option('ism_min_count', $arr);
		echo 1;
	}else echo 0;
	die();
}

/********************************************* PREVIEW LOCKER *********************************************/
add_action( 'wp_ajax_ism_preview_shortcode', 'ism_preview_shortcode' );
add_action('wp_ajax_nopriv_ism_preview_shortcode', 'ism_preview_shortcode');
function ism_preview_shortcode(){
	$attr = shortcode_parse_atts(stripslashes($_REQUEST['shortcode']));
	$return_str = "";
	include ISM_DIR_PATH . 'includes/shortcode_preview.php';
	echo $return_str;
	die();	
}


/******************************************** VISUAL COMPOSER ***************************************/
add_action( 'init', 'ism_check_vc' );
function ism_check_vc(){
    if(function_exists('vc_map')){
        require ISM_DIR_PATH . 'admin/functions/ism_vc_functions.php';
        require ISM_DIR_PATH . 'admin/ism_vc_map.php';

        ////////////////style & script for page
        add_action("admin_enqueue_scripts", 'ism_vc_admin_header');
        function ism_vc_admin_header(){
            wp_enqueue_style ( 'ism_font-awesome', ISM_DIR_URL . 'files/css/font-awesome.css' );
            wp_enqueue_style ( 'ism_back_end_vc', ISM_DIR_URL . 'admin/files/css/style-back_end.css' );
            wp_enqueue_style ( 'ism_front_end_vc', ISM_DIR_URL . 'files/css/style-front_end.css' );
            wp_enqueue_style ( 'ism_templates', ISM_DIR_URL . 'files/css/templates.css' );

            wp_enqueue_script( 'ism_js_functions_vc', ISM_DIR_URL . 'admin/files/js/functions.js', array(), null );
            //additional templates
            ism_enqueue_additional_templates();
        }
    }
}

if(!function_exists('vc_theme_before_vc_row')){
	$vc_locker = get_option('ism_enable_vc_locker');
	if($vc_locker!=0){
		function vc_theme_before_vc_row($atts, $content = null) {
			if(isset($atts['lk_sl']) && $atts['lk_sl']!=''){
				//short name for variables
				$arr = ism_return_vc_locker_args($atts);
				if(count($arr)){
					$str = ism_locker_shortcode( $arr, $content, true);
				}else{
					$str = $content;
				}
				return $str;
			}elseif(isset($atts['sm_list']) && $atts['sm_list']!='' && array_key_exists('sm_d_text', $atts) ){
				////OLD VERSION , FULL names for variables
				$arr_keys = array('sm_list', 'template', 'list_align', 'display_counts', 'display_full_name', 'sm_lock_bk', 'sm_lock_padding', 'sm_d_text', 'locker_template', 'sm_timeout_locker', 'enable_timeout_lk', 'not_registered_u', 'reset_locker', 'locker_reset_after', 'locker_reset_type', 'ism_overlock', 'disable_mobile', 'twitter_hide_mobile', 'twitter_unlock_onclick');
				foreach($arr_keys as $v){
					if(isset($atts[$v])) $arr[$v] = $atts[$v];
				}		
				if(isset($arr) && count($arr)>0){
					$str = ism_locker_shortcode( $arr, $content, true);
				}
				else $str = $content;
				return $str;
			}
			//echo '<pre>';
			//print_r($atts);die();
		}		
	}
}


/****************************************** SHARE COUNTS FROM DB ****************************************/
add_action( 'wp_ajax_ism_get_sm_db_share_counts_return_list', 'ism_get_sm_db_share_counts_return_list' );
add_action('wp_ajax_nopriv_ism_get_sm_db_share_counts_return_list', 'ism_get_sm_db_share_counts_return_list');
function ism_get_sm_db_share_counts_return_list(){
	$url = $_REQUEST['the_url'];
	$sm_list = $_REQUEST['sm_list'];
	$data = get_option('ism_sm_internal_counts_share');
	$chg = 0;
	
	if($data!==FALSE){
		/**************************** IF OPTION "ism_sm_internal_counts_share" EXISTS ************************/
		$arr = json_decode($data, TRUE);//if return an associative array from json
		if(isset($arr[$url]) && count($arr[$url])!=''){
			//IF URL KEY EXISTS
			foreach($sm_list as $sm){
				if( isset( $arr[$url][$sm] ) ){
					if( isset($arr[$url][$sm.'-flag']) && ($arr[$url][$sm.'-flag'] < 0 || $arr[$url][$sm.'-flag']>IMTST_FLAG_LIMIT) ){
						//update 
						$current = $arr[$url][$sm];
						$current_from_server = ism_get_share_counts_from_server($url, $sm);
							if($current!=$current_from_server){
								//update sm counts
								$arr[$url][$sm.'-flag'] = 0;
								$num = (int)ism_update_sm_db_share_counts($url, $sm);
							}else{
								if($arr[$url][$sm.'-flag']>IMTST_FLAG_LIMIT){
								    $arr[$url][$sm.'-flag'] = 0;
									$chg++;
								}
								$num = $current;								
							}		
							
							if( ($sm=='twitter' || $sm=='linkedin') && $arr[$url][$sm.'-flag']<0){								
								$new_arr[$sm.'-flag'] = $arr[$url][$sm.'-flag'];
							}
											
					}else{					
						$num = (int)$arr[$url][$sm];
					}
				
				}else{
					$num = ism_update_sm_db_share_counts($url, $sm);
				}
				//the count
				$new_arr[$sm] = $num;
			}
			 if ($chg > 0){
			 	$data2 = json_encode($arr);
			 	update_option('ism_sm_internal_counts_share', $data2);				
			 }
			 foreach($sm_list as $sm){
			 	ism_increment_flag($url, $sm);	
			 }
		//END OF URL KEY EXISTS
		}else{
			//CREATE NEW ARRAY INTO "ism_sm_internal_counts_share"
			foreach($sm_list as $sm){
				$arr[$url][$sm] = ism_get_share_counts_from_server($url, $sm);
				$arr[$url][$sm.'-flag'] = 0;
			}
			$data2 = json_encode($arr);
			update_option('ism_sm_internal_counts_share', $data2);
			$new_arr = $arr[$url];
		}
	}else{
		/**************************** FIRST TIME INITIALIZE the "ism_sm_internal_counts_share" OPTION ************************/
		foreach($sm_list as $sm){
			$new_arr[$sm] = ism_get_share_counts_from_server($url, $sm);
			$new_arr[$sm.'-flag'] = 0;
		}
		$new_arr2[$url] = $new_arr;
		$data2 = json_encode($new_arr2);
		add_option('ism_sm_internal_counts_share', $data2);
	}
	
	//MIN COUNTS AND INITIAL COUNTS
	foreach($new_arr as $key=>$value){
		$new_arr[$key] = $value + ism_test_special_counts( $key, $url );
		if(ism_return_min_count_sm($key)!==FALSE){
			if($new_arr[$key]<(int)ism_return_min_count_sm($key)) $new_arr[$key] = 'not_show';
		}
	}
	
	//RETURNING THE VALUES
	echo json_encode($new_arr);
	die();
}

function ism_update_sm_db_share_counts($url, $sm){
	$data = get_option('ism_sm_internal_counts_share');
	if($data!==FALSE){
		$arr = json_decode($data, TRUE);
	}
	$arr[$url][$sm] = ism_get_share_counts_from_server($url, $sm);
	$arr[$url][$sm.'-flag'] = 0;
	$data = json_encode($arr);
	if(get_option('ism_sm_internal_counts_share')===FALSE){
		//add option
		add_option('ism_sm_internal_counts_share', $data);
	}else{
		//update
		update_option('ism_sm_internal_counts_share', $data);
	}
	return $arr[$url][$sm];
}

function ism_increment_flag($url, $sm){
	$data = get_option('ism_sm_internal_counts_share');
	if($data!==FALSE){
		$arr = json_decode($data, TRUE);
		if(isset($arr[$url][$sm.'-flag'])){
			$arr[$url][$sm.'-flag'] = $arr[$url][$sm.'-flag'] + 1;
		}
		$data = json_encode($arr);
		update_option('ism_sm_internal_counts_share', $data);
	}	
}

function ism_get_share_counts_from_server($the_url, $sm){
	$num = 0;
	switch($sm){
		case 'facebook':
			$url = "http://graph.facebook.com/?id=".$the_url;
			$data = ism_get_data_from_url( $url );
			@$result = json_decode($data);
			if(isset($result->shares)) $num = (int)$result->shares;
			break;
		case 'twitter':
			$url = "http://cdn.api.twitter.com/1/urls/count.json?url=".$the_url."&callback=?";
			$data = ism_get_data_from_url( $url );
			@$result = json_decode($data);
			if(isset($result->count)) $num = (int)$result->count;
			break;
		case 'google':
			$url = "https://plusone.google.com/u/0/_/+1/fastbutton?url=".$the_url."&count=true";
			$data = ism_get_data_from_url( $url );
			if (preg_match("/window\.__SSR\s=\s\{c:\s([0-9]+)\.0/", $data, $matches)) $num = (int)$matches[1];
			break;
		case 'linkedin':
			$url = "http://www.linkedin.com/countserv/count/share?format=json&url=".$the_url."&callback=?";
			$data = ism_get_data_from_url( $url );
			if(strpos($data, 'IN.Tags.Share.handleCount(')!==FALSE){
				$data = str_replace('IN.Tags.Share.handleCount(', '', $data);
				$data = str_replace(');', '', $data);
			}
			@$result = json_decode($data);
			if(isset($result->count)) $num = (int)$result->count;
			break;
		case 'pinterest':
			$url = "http://api.pinterest.com/v1/urls/count.json?url=".$the_url;
			$data = ism_get_data_from_url( $url );
			@$data = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $data);
			@$result = json_decode($data);
			if (isset($result->count) && is_int($result->count)) $num = (int)$result->count;
			break;
		case 'stumbleupon':
			$url = "http://www.stumbleupon.com/services/1.01/badge.getinfo?url=".$the_url;
			$data = ism_get_data_from_url( $url );
			@$result = json_decode($data);
			if (isset($result->result->views)) $num = (int)$result->result->views;
			break;
		case 'vk':
			$url = 'http://vk.com/share.php?act=count&url='.$the_url;
			$data = ism_get_data_from_url( $url );
			if (preg_match( '/^VK\.Share\.count\(\d, (\d+)\);$/i', $data, $matches ))  $num = (int)$matches[1];
			break;
		case 'reddit':
			$url = 'http://www.reddit.com/api/info.json?url='.$the_url;
			@$data = ism_get_data_from_url( $url );
			@$result = json_decode($data);
			if (isset($result->data->children[0]->data->score)) $num = (int)$result->data->children[0]->data->score;
			break;
		case 'print':
			$data = get_option('ism_sm_internal_counts_share');
			if($data!==FALSE){
				$arr = json_decode($data, TRUE);
				if(!isset($arr[$the_url][$sm]) || $arr[$the_url][$sm]=='') $num = 0;
				else $num = $arr[$the_url][$sm];
			}else $num = 0;
			break;
		case 'email':
			$data = get_option('ism_sm_internal_counts_share');
			if($data!==FALSE){
				$arr = json_decode($data, TRUE);
				if(!isset($arr[$the_url][$sm]) || $arr[$the_url][$sm]=='') $num = 0;
				else $num = $arr[$the_url][$sm];
			}else $num = 0;
			break;
		case 'ok':
			$num = 0;
			$url = 'http://ok.ru/dk?st.cmd=extLike&uid=odklcnt0&ref='.$the_url;
			$data = ism_get_data_from_url( $url );
			if($data!==FALSE){
				preg_match('/^ODKL\.updateCount\(\'odklcnt0\',\'(\d+)\'\);$/i', $data, $arr );
				if(isset($arr[1]) && $arr[1]!=FALSE) $num = $arr[1];
			}
		break;
		case 'bufferapp':
			$num = 0;
			$url = 'https://api.bufferapp.com/1/links/shares.json?url='.$the_url;
			$data = ism_get_data_from_url( $url );
			if($data!==FALSE){
				@$result = json_decode($data);
				if (isset($result->shares) && $result->shares!='') $num = (int)$result->shares;
			}
		break;
	}
	return $num;
}


add_action( 'wp_ajax_ism_update_db_share_count_share_bttn_action', 'ism_update_db_share_count_share_bttn_action' );
add_action('wp_ajax_nopriv_ism_update_db_share_count_share_bttn_action', 'ism_update_db_share_count_share_bttn_action');
function ism_update_db_share_count_share_bttn_action(){
	$sm = $_REQUEST['sm'];
	$url = $_REQUEST['the_url'];
	$data = get_option('ism_sm_internal_counts_share');
	
	if($data!==FALSE){
		$arr = json_decode($data, TRUE);
	}
	if($sm!='email' && $sm!='print'){
		$arr[ $url ][ $sm.'-flag' ] = IMTST_FLAG_CRASH_LIMIT;	
	}
	$new_data = json_encode($arr);
	update_option('ism_sm_internal_counts_share', $new_data);
	die();
}

/******************** TWITTER META HEAD TAGS ****************************/
add_action('wp_head', 'ism_twitter_meta_tags');
function ism_twitter_meta_tags(){
	$enable = get_option('ism_twitter_share_img');
	if($enable==1){
		global $post;
		//FEATURE IMAGE
		if(!isset($post->ID)) return;
		@$feature_img = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		if(!$feature_img || $feature_img=='') $feature_img = get_option('feat_img');
		$str = '<meta name="twitter:card" content="photo" />
<meta name="twitter:image:src" id="twitter_meta_img" content="'.$feature_img.'">
<meta name="twitter:url" content="'.get_site_url().'" />
		';
		echo $str;
	}
}


#share count database with date
add_action('init', 'ism_create_share_table');
function ism_create_share_table(){
	#check if table WP_ISM_SHARE exists, if not create it
	global $wpdb;
	$table_name = $wpdb->prefix . "ism_share_counts";
	if ($wpdb->get_var( "show tables like '$table_name'" ) != $table_name){
		require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
		$sql = "CREATE TABLE " . $table_name . " (
		id int(9) NOT NULL AUTO_INCREMENT,
		sm varchar(50) DEFAULT NULL,
		url varchar(200) DEFAULT NULL,
		ism_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (`id`)
		);";
		dbDelta ( $sql );
	}
}

add_action( 'wp_ajax_ism_update_share_db_wd', 'ism_update_share_db_wd' );
add_action('wp_ajax_nopriv_ism_update_share_db_wd', 'ism_update_share_db_wd');
function ism_update_share_db_wd(){
	if(isset($_REQUEST['sm']) && isset($_REQUEST['the_url'])){
		global $wpdb;
		$wpdb->query("INSERT INTO ".$wpdb->prefix."ism_share_counts VALUES (NULL, '".$_REQUEST['sm']."', '".$_REQUEST['the_url']."', NULL);");
	}
	die();
}

#Clear statistics
add_action( 'wp_ajax_ism_delete_statistic_data', 'ism_delete_statistic_data' );
add_action('wp_ajax_nopriv_ism_delete_statistic_data', 'ism_delete_statistic_data');
function ism_delete_statistic_data(){
	if(isset($_REQUEST['older_than'])){
		switch($_REQUEST['older_than']){
			case 'day':
				$date = date('Y-m-d H:i:s', time()-(24 * 60 * 60));
			break;
			case 'week':
				$date = date('Y-m-d H:i:s', time()-(7 * 24 * 60 * 60));
			break;
			default:
				#month
				$date = date('Y-m-d H:i:s', time()-(30 * 24 * 60 * 60));
			break;			
		}
		global $wpdb;
		$q = $wpdb->query( "DELETE FROM {$wpdb->prefix}ism_share_counts WHERE ism_date<='{$date}';" );
		echo $date;
	}
	die();
}

//delete custom share content for url
add_action( 'wp_ajax_ism_remove_custom_share_for_url_ajax', 'ism_remove_custom_share_for_url_ajax' );
add_action('wp_ajax_nopriv_ism_remove_custom_share_for_url_ajax', 'ism_remove_custom_share_for_url_ajax');
function ism_remove_custom_share_for_url_ajax(){
	if(isset($_REQUEST['the_url']) && $_REQUEST['the_url']!=''){
		$data = get_option('ism_go_custom_share_c');
		unset($data[ $_REQUEST['the_url'] ]);
		update_option('ism_go_custom_share_c', $data);
		echo 1;
	}
	die();
}

add_action( 'wp_ajax_ism_check_tl_flag', 'ism_check_tl_flag' );
add_action('wp_ajax_nopriv_ism_check_tl_flag', 'ism_check_tl_flag');
function ism_check_tl_flag(){
	$data = get_option('ism_sm_internal_counts_share');
	$url = $_REQUEST['the_url'];
	$sm = $_REQUEST['sm'];
	$count = $_REQUEST['the_count'];
	
	if($data!==FALSE){
		$arr = json_decode($data, TRUE);
		if(isset($arr[$url]) && count($arr[$url])!=''){
			$current = $arr[$url][$sm];
			if($current!=$count){
				//update sm counts
				$arr[$url][$sm.'-flag'] = 0;
				$arr[$url][$sm] = $count;
				$data = json_encode($arr);				
				update_option('ism_sm_internal_counts_share', $data);
				
				$value = $count + ism_test_special_counts( $sm, $url );
				if(ism_return_min_count_sm($sm)!==FALSE){
					if($value<(int)ism_return_min_count_sm($sm)) $value = 'not_show';
				}
				echo $value;
				die();
			}			
		}
	}	
	$value = $count + ism_test_special_counts( $sm, $url );
	echo $value;
	die();
}

add_action( 'wp_ajax_ism_check_min_special_counts_from_js_tl', 'ism_check_min_special_counts_from_js_tl' );
add_action('wp_ajax_nopriv_ism_check_min_special_counts_from_js_tl', 'ism_check_min_special_counts_from_js_tl');
function ism_check_min_special_counts_from_js_tl(){
	$value = $_REQUEST['the_count'];
	$value = $value + ism_test_special_counts( $_REQUEST['the_type'], $_REQUEST['the_url'] );
	if(ism_return_min_count_sm($_REQUEST['the_type'])!==FALSE){
		if($value<(int)ism_return_min_count_sm($_REQUEST['the_type'])) $value = 'not_show';
	}
	echo $value;
	die();
}

add_action( 'wp_ajax_ism_load_statistics_counts_via_ajax', 'ism_load_statistics_counts_via_ajax' );
add_action('wp_ajax_nopriv_ism_load_statistics_counts_via_ajax', 'ism_load_statistics_counts_via_ajax');
function ism_load_statistics_counts_via_ajax(){
	foreach($_REQUEST['sm_list'] as $sm){
		$arr[$sm] = ism_return_statistic_count_for_sm($sm, $_REQUEST['the_url'] );
		$arr[$sm] = $arr[$sm] + ism_test_special_counts( $sm, $_REQUEST['the_url'] );
		if(ism_return_min_count_sm($sm)!==FALSE){
			if($arr[$sm]<(int)ism_return_min_count_sm($sm)){
				$arr[$sm] = 'not_show';
			}
		}
	}		
	//RETURNING THE VALUES
	echo json_encode($arr);
	die();
}

?>
