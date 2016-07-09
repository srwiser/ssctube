<?php 
/*************************** BACK END *****************************/
function isf_update_metas(){
	if(isset($_REQUEST['isf_submit_bttn'])){
		//create, update
		$arr = array(
				'isf_urls',
				'isf_sublabels',
				'isf_initial_counts',
				//apis
				'isf_facebook_page_n',
				'isf_twitter_username',
				'isf_twitter_ck',
				'isf_twitter_cs',
				'isf_twitter_at',
				'isf_twitter_ats',
				'isf_google_page_id',
				'isf_google_api_key',
				'isf_pinterest_user',
				'isf_link_id',
				'isf_link_app_key',
				'isf_link_app_secret',
				'isf_vk_name',
				'isf_delicious_user',
				'isf_check_time',
		);
		foreach($arr as $k){
			$data = get_option($k);
			if($data!==FALSE){
				update_option($k, $_REQUEST[$k]);
			}else{
				add_option($k, $_REQUEST[$k]);
			}
		}
	}
}

function isf_return_sm_labels(){
	$arr = array(	'facebook' => 'Facebook',
					'twitter' => 'Twitter',
					'google' => 'Google+',
					'pinterest' => 'Pinterest',
					'linkedin' => 'Linkedin',
					'digg' => 'DiggDigg',
					'tumblr' => 'Tumblr',
					'stumbleupon' => 'Stumbleupon',
					'vk' => 'VKontakte',
					'reddit' => 'Reddit',
					'delicious' => 'Delicious',
					'weibo' => 'Weibo',
					'xing' => 'Xing',
			);
	$data = get_option('ism_general_sm_labels');
	foreach( $arr as $k=>$v ){
		if(!isset($data[$k]) || $data[$k]==''){
			$arr[$k] = $v;
		}
	}
	return $arr;
}

function isf_get_metas(){
	$arr = array(
					//apis
					'isf_facebook_page_n' => '',
					'isf_twitter_username' => '',
					'isf_twitter_ck' => '',
					'isf_twitter_cs' => '',
					'isf_twitter_at' => '',
					'isf_twitter_ats' => '',
					'isf_google_page_id' => '',
					'isf_google_api_key' => '',
					'isf_pinterest_user' => '',
					'isf_link_id' => '',
					'isf_link_app_key' => '',
					'isf_link_app_secret' => '',
					'isf_vk_name' => '',
					'isf_delicious_user' => '',
					'isf_check_time' => 12,
				);
	$sm_items = isf_return_sm_labels();
	foreach($sm_items as $k=>$v){
		/*
		 * 	'isf_urls' => '',
		 *	'isf_sublabels' => '',
		 *	'isf_initial_counts' => '',
		 */
		$arr['isf_urls'][$k] = '';
		$arr['isf_sublabels'][$k] = 'Followers';
		$arr['isf_initial_counts'] = '';
	}
	foreach($arr as $k=>$v){
		$data = get_option($k);
		if($data!==FALSE) $arr[$k] = $data;
	}
	return $arr;
	
}


/************************************* FRONT END ********************************************/

function ifm_args_for_sm_arr_ready($meta_arr, $attr, $ism_list, $t){
	//returns an array with sm_type, label, sublabel, display counts and url
	$t_arr = array( 'fb'=>'facebook', 
					'tw'=>'twitter', 
					'goo'=>'google', 
					'li'=>'linkedin', 
					'pt'=>'pinterest', 
					'dg'=>'digg',
					'su'=>'stumbleupon',
					'tbr'=>'tumblr',
					'vk'=>'vk',
					'rd'=>'reddit',
					'dl'=>'delicious',
					'wb'=>'weibo',
					'xg'=>'xing'
				);
	$type = $t_arr[$t];
	
	$args = array();
	$args['sm_type'] = $t;
	if($attr['display_full_name']=='true') $args['label'] = $ism_list[$type];
	if($attr['display_counts']=='true'  ){
		$args['display_counts'] = true;
		if(isset($attr['display_sublabel']) && $attr['display_sublabel']==1 && isset($meta_arr['isf_sublabels'][$type]) && $meta_arr['isf_sublabels'][$type]!=''){
			$args['sublabel'] = $meta_arr['isf_sublabels'][$type];
		}
	}
	if( isset($meta_arr['isf_urls'][$type]) ) $args['link'] = $meta_arr['isf_urls'][$type];
	else $args['link'] = '';
	$args['sm_class'] = $type;
	$args['template'] = $attr['template'];
	return $args;
}

function ifm_return_sm_arr_ready($meta_arr, $attr){
	//labels
	$ism_list = ism_return_general_labels_sm();
	$html = '';
	$ismitems_arr = '';
	$html_arr = '';
	$types = explode(',', $attr['list']);	
	/************************* SOCIAL MEDIA ITEMS *************************/
	foreach($types as $type){
		if(isset($args)) unset($args);
		$args = ifm_args_for_sm_arr_ready($meta_arr, $attr, $ism_list, $type);
		$ismitems_arr[] = $args['sm_class'];
		$html_arr[$args['sm_class']] = $args;
	}
	$arr['html_arr'] = $html_arr;
	$arr['ismitems_arr'] = $ismitems_arr;
	return $arr;
}

function isf_return_item( $html_arr, $list_align ){
	$str = '';
	if($html_arr==FALSE || count($html_arr)==0) return '';
	foreach($html_arr as $arr){
		$str .= '<a href="'.$arr['link'].'" class="ism_link" ';
		if($arr['link']!='') $str .= ' target="_blank" ';
		$str .= '>';
		$str .= '<div class="ism_item_wrapper ism-align-'.$list_align.'">';
		$str .= '<div class="ism_item ism_box_'.$arr['sm_class'].'">';
		$str .= '<i class="fa-ism fa-'.$arr['sm_class'].'-ism"></i>';
		if(isset($arr['label']) && $arr['label']!= '' ) $str .= '<span class="ism_share_label">'.$arr['label'].'</span>';
		if(strpos($arr['template'],'sf')){
			if(isset($arr['display_counts']) ) $str .= '<span class="ism_share_counts '.$arr['sm_class'].'_share_count-isf" >0</span>';
			if(isset($arr['sublabel']) && $arr['sublabel']!='') $str .= '<span class="isf_sublabel_fe">'.$arr['sublabel'].'</span>';
		}else{
			if(isset($arr['sublabel']) && $arr['sublabel']!='') $str .= '<span class="isf_sublabel_fe">'.$arr['sublabel'].'</span>';
			if(isset($arr['display_counts']) ) $str .= '<span class="ism_share_counts '.$arr['sm_class'].'_share_count-isf" >0</span>';
		}
		$str .= '<div class="clear"></div>';
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</a>';
	}
	return $str;
}

function isf_get_css($attr){
	$css = '';
	$aditional_css = '';
	$css .= '
	#'.$attr['indeed_wrap_id'].'{
	';
	//position
	$css .= "}";
	$css .= '#'.$attr['indeed_wrap_id'].' .ism_item{';
	if($attr['list_align']=='vertical'){
		////VERTICAL ALIGN
		if((isset($attr['position']) && $attr['position']=='custom') ){
			$margin_arr = array(
					'ism_template_0' => '0px 0px;',
					'ism_template_1' => '0px 0px;',
					'ism_template_2' => '4px 0px;',
					'ism_template_3' => '4px 0px;',
					'ism_template_4' => '7px 0px;',
					'ism_template_5' => '',
					'ism_template_6' => '7px 0px;',
					'ism_template_7' => '4px 0px;',
					'ism_template_8' => '0px 0px;',
					'ism_template_9' => '',
					'ism_template_10' => '3px 0px;',
			);
			if(isset($margin_arr[$attr['template']]) && $margin_arr[$attr['template']]!='') $css .= 'margin: ' . $margin_arr[$attr['template']] . ' !important;';
		}
	}else{
		////HORIZONTAL ALIGN
		if((isset($attr['position']) && $attr['position']=='custom') ){
			$margin_arr = array(
					'ism_template_0' => '0px 4px;',
					'ism_template_1' => '0px 4px;',
					'ism_template_2' => '0px 4px;',
					'ism_template_3' => '0px 4px;',
					'ism_template_4' => '0px 7px;',
					'ism_template_5' => '',
					'ism_template_6' => '0px 7px;',
					'ism_template_7' => '0px 4px;',
					'ism_template_8' => '0px 4px;',
					'ism_template_9' => '',
					'ism_template_10' => '0px 3px;',
			);
			if(isset($margin_arr[$attr['template']]) && $margin_arr[$attr['template']]!='') $css .= 'margin: ' . $margin_arr[$attr['template']] . ' !important;';
		}
	}
	//CUSTOM TOP TEMPLATE 5
	if(isset($attr['top_bottom']) && $attr['top_bottom']=='top' && $attr['template']=='ism_template_5'){
		$css .= '
		-webkit-box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
		-moz-box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
		box-shadow: inset 0px 6px 0px 0px rgba(0,0,0,0.2);
		';
		$aditional_css = '#'.$attr['indeed_wrap_id'].' .ism_item:hover{
		top:initial !important;
		bottom: -1px !important;
	}';
	}
	//CUSTOM RIGHT FOR TEMPLATE 9
	if(isset($attr['left_right']) && $attr['left_right']=='right' && $attr['template']=='ism_template_9'){
		$css .= '
					-webkit-box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
					-moz-box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
					box-shadow: inset -8px 0px 5px 0px rgba(0,0,0,0.2);
					border-top-left-radius:5px;
					border-bottom-left-radius:5px;
					margin-right:-5px;
				';
		$aditional_css = '#'.$attr['indeed_wrap_id'].' .ism_item:hover{
							left: initial !important;
							right: 5px !important;
						}';
	}
	$css .= '}'; //end of .ism_item style
	$css .= '#'.$attr['indeed_wrap_id'].' .ism_item_wrapper{
				display: ';
	if($attr['list_align']=='vertical'){
		$css .= 'block;';
	}else{
		////HORIZONTAL ALIGN
		$css .= 'inline-block;';
	}
	$css .= '}';
	
	if(isset($attr['no_cols']) && $attr['no_cols'] > 0){
		$cols = 100/$attr['no_cols'];
		
		$css .= '#'.$attr['indeed_wrap_id'].'{
					display:block;
		}';
		$css .= '#'.$attr['indeed_wrap_id'].' .ism_item_wrapper{';
		$css .= 'width:'.$cols.'%;';
		$css .= '}';
	}
	
	if(isset($attr['box_align']) && $attr['box_align'] != 'left' && $attr['list_align']!='vertical'){
		$css .= '#'.$attr['indeed_wrap_id'].' {
					display:block;
					text-align:'.$attr['box_align'].'
				}';
	}
	return '<style>'.$css . $aditional_css.'</style>';	
}

function isf_html_wraps($html, $attr){
	return '<div class="" id="'.$attr['parent_before_wrap_id'].'">'
				. '<div class="ism_wrap '.$attr['template'].' ism-follow-temp '.$attr['type'].'" id="'.$attr['indeed_wrap_id'].'">'
					. $html
				. '</div>'
			.'</div>';
}

function isf_load_counts($list, $div_id){
	if($list==FALSE || count($list)==0)return;
	$js = '';
	$js .= 'jQuery(document).ready(function(){';//start
	$list_str = implode(',', $list);
	$js .= 'items_str = "'.$list_str.'";
			items_arr = items_str.split(",");';
	$js .= 'isf_load_counts(0, "#'.$div_id.'", items_arr, 1);';
	$js .= '});';//end
	return $js;
}

function isf_js_tags($str){
	return '<script>'.$str.'</script>';
}

function isf_define_js_basepath(){
	if(!defined('ISF_BASE_PATH_JS')){
		wp_enqueue_script('isf_front_end');
		wp_localize_script( 'isf_front_end', 'isf_base_path', get_site_url() );// base url for ajax calls
		define('ISF_BASE_PATH_JS', 1);//include variable just one time
	}
}


/************************* SM COUNTS ************************/
function isf_call_get_counts($sm){
	switch($sm){
		case 'facebook':
			return isf_get_facebook_counts();
		break;
		case 'twitter':
			return isf_get_twitter_counts();
		break;
		case 'google':
			return isf_get_gplusone_counts();
		break;
		case 'vk':
			return isf_get_vk_counts();
		break;
		case 'linkedin':
			return isf_get_linkedin_counts();
		break;
		case 'delicious':
			return isf_get_delicious_counts();
		break;
		case 'pinterest':
			return isf_get_pinterest_counts();
		break;
		default:
			return FALSE;
		break;
	}
}
function isf_get_twitter_counts(){	
	$t_oat = get_option('isf_twitter_at');
	$t_oats = get_option('isf_twitter_ats');
	$t_ck = get_option('isf_twitter_ck');
	$t_cs = get_option('isf_twitter_cs');
	if($t_oat==FALSE || $t_oats==FALSE || $t_ck==FALSE || $t_cs==FALSE) return FALSE;
	
	require_once ISF_PATH.'api/twitter/TwitterAPIExchange.php';
	
	$settings = array(			
						'oauth_access_token' => $t_oat,
						'oauth_access_token_secret' => $t_oats,
						'consumer_key' => $t_ck,
						'consumer_secret' => $t_cs,
					  );
	$ta_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
	$getfield = '?screen_name=' . get_option('isf_twitter_username');
	$requestMethod = 'GET';
	$twitter = new TwitterAPIExchange($settings);
	$follow_count=$twitter->setGetfield($getfield)->buildOauth($ta_url, $requestMethod)->performRequest();
	$data = json_decode($follow_count, true);
	if(isset($data) && $data!=''){
		if(isset($data[0]['user']['followers_count']) && $data[0]['user']['followers_count']!='' ) return $data[0]['user']['followers_count'];
	}
	return FALSE;
}

function isf_get_facebook_counts(){
	$fb_page = get_option('isf_facebook_page_n');
	if($fb_page==FALSE ) return FALSE;
	$url = 'http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls=' . $fb_page;
	$data = ism_get_data_from_url($url);
	if(isset($data) && $data!='') {
		$arr = json_decode($data, true);
		if(isset($arr[0]['like_count']) && $arr[0]['like_count']!=='') return $arr[0]['like_count'];
	}
	return FALSE;	
}

function isf_get_vk_counts(){
	$vk_id = get_option('isf_vk_name');
	if($vk_id==FALSE ) return FALSE;
	$url = 'http://api.vk.com/method/groups.getById?gid='.$vk_id.'&fields=members_count';
	$data = ism_get_data_from_url($url);
	if(isset($data) && $data!='') {
		$arr = json_decode($data, true);
		if(isset($arr['response'][0]['members_count']) && $arr['response'][0]['members_count']!='') return $arr['response'][0]['members_count'];	
	}
	return FALSE;
}

function isf_get_delicious_counts(){
	$d_name = get_option('isf_delicious_user');
	if($d_name==FALSE) return FALSE;
	$url = 'http://feeds.delicious.com/v2/json/userinfo/'.$d_name;
	$data = ism_get_data_from_url($url);
	if(isset($data) && $data!='') {
		$arr = json_decode($data, true);
		if(isset($arr[2]['n']) && $arr[2]['n']!='') return $arr[2]['n'];
	}
	return FALSE;
}
function isf_get_pinterest_counts(){
	$p_name = get_option('isf_pinterest_user');
	if($p_name==FALSE) return FALSE;
	$url = 'http://api.pinterest.com/v3/pidgets/users/'.$p_name.'/pins/';
	$data = ism_get_data_from_url($url);
	if(isset($data) && $data!=''){
		$arr = json_decode($data, true);
		if(isset($arr['data']['pins'][0]['pinner']['follower_count']) && $arr['data']['pins'][0]['pinner']['follower_count']!='') return $arr['data']['pins'][0]['pinner']['follower_count'];		
	}
	return FALSE;
}

function isf_get_gplusone_counts(){
	$g_id = get_option('isf_google_page_id');
	if($g_id==FALSE) return FALSE;
	$g_key = get_option('isf_google_api_key');
	if($g_key==FALSE) return FALSE;
	$url = 'https://www.googleapis.com/plus/v1/people/'.$g_id.'?key='.$g_key;	
	$data = ism_get_data_from_url($url);
	if(isset($data) && $data!=''){
		$arr = json_decode($data, true);
		if(isset($arr['plusOneCount']) && $arr['plusOneCount']!='') return $arr['plusOneCount'];
	}
	return FALSE;
}

function isf_get_linkedin_counts(){
	$c_id = get_option('isf_link_id');
	if($c_id==FALSE) return FALSE;
	$app_key = get_option('isf_link_app_key');
	if($app_key==FALSE) return FALSE;
	$app_s = get_option('isf_link_app_secret');
	if($app_s==FALSE) return FALSE;
	
	require_once ISF_PATH . 'api/linkedin/linkedin.php';
	require_once ISF_PATH . 'api/linkedin/OAuth.php';

	$options = array ('appKey' => $app_key, 'appSecret' => $app_s, 'callbackUrl' => '' );
	$api = new LinkedIn ( $options );
	$response = $api->company ( trim ( 'universal-name=' . $c_id . ':(num-followers)' ) );
	if($response ['success'] ==! false){
		return (int)trim(strip_tags($response['linkedin']));
	}
	return FALSE;
}

function isf_update_db_counts($sm, $count){
	if($sm=='' || $count=='') return;
	$the_time = time();
	$data = get_option('isf_follow_counts');
	if($data===FALSE){
		//create new option
		$arr[$sm]['count'] = $count;
		$arr[$sm]['the_time'] = $the_time;
		$new_data = json_encode($arr);
		add_option('isf_follow_counts', $new_data);	
	}else{
		//update
		$arr = json_decode($data, true);
		$arr[$sm]['count'] = $count;
		$arr[$sm]['the_time'] = $the_time;
		$new_data = json_encode($arr);
		update_option('isf_follow_counts', $new_data);		
	}	
}

function isf_get_db_counts(){
	$data = get_option('isf_follow_counts');
	if($data===FALSE) return FALSE;
	$arr = json_decode($data, true);
	return $arr;	
}

function isf_get_follow_templates(){
	$arr = array();
	$templates_dir = ISF_PATH . 'files/css/' ;
	if(is_readable($templates_dir)){
		$ism_content_file = file_get_contents( $templates_dir . '/pack_social_follow.css' );
		$templ_arr = explode('#INDEED_TEMPLATES#', $ism_content_file);
		if(isset($templ_arr[1])){
			$arr = (array)json_decode($templ_arr[1]);
		}
	}
	return $arr;
}