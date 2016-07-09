<?php
    if(isset($ismitems_arr)) unset($ismitems_arr);
	$attr['url'] = ism_return_current_url(); //url or permalink
	$custom_data = ism_check_custom_share_data($attr['url']);
	if($custom_data!==FALSE){
		//title
		$attr['post_title'] = $custom_data['title'];
		if($attr['post_title']==FALSE || $attr['post_title']=='') $attr['post_title'] = ism_return_post_title();
		//description
		$attr['description'] = ism_format_like_post_description( stripslashes($custom_data['message']) );
		if($attr['description']==FALSE || $attr['description']=='') $attr['description'] = ism_return_post_description();
		//feature image
		$attr['feat_img'] = $custom_data['feat_image'];
		if($attr['feat_img']==FALSE || $attr['feat_img']=='') $attr['feat_img'] = ism_return_feat_image($meta_arr);
		//url
		if(isset($custom_data['shared_url']) && $custom_data['shared_url']!='') $$attr['url'] = $custom_data['shared_url'];
	}else{
		$attr['post_title'] = ism_return_post_title(); // the title
		$attr['description'] = ism_return_post_description(); // post description
		$attr['feat_img'] = ism_return_feat_image($meta_arr); //feature image		
	}

    $rand = rand(1,5000);
    $attr['parent_before_wrap_id'] = 'ism_b_parent_'.$rand;
    $attr['indeed_wrap_id'] = 'indeed_sm_wrap_' . $rand;
    $attr['before_wrap_id'] = 'indeed_before_wrapD_' . $rand;
    $attr['after_share_id'] = 'ism_after_share_' . rand(0, 1000);
    	
	////used in ism_return_sm_arr_ready function
    $attr['locker_div_id'] = 0;
    $attr['content_id'] = 0;
	///
	
    $html_arr = array();//html_arr will contain all social media html items

    $arr = ism_return_sm_arr_ready($meta_arr, $attr);
    $html .= $arr['html'];
	$ismitems_arr = $arr['ismitems_arr'];
	$html_arr = $arr['html_arr'];

	//reorder
	$html_arr = ism_reorder_sm_list($html_arr);
   	foreach($html_arr as $val){
   		$html .= ism_return_item($val, $attr['url'], $meta_arr['list_align']);
	}

	//TOTAL SHARE COUNT
	if(isset($meta_arr['print_total_shares']) && $meta_arr['print_total_shares']==1){
		$js .= print_total_shares_js($attr['indeed_wrap_id']);
		$html = print_total_shares_html($meta_arr, $html);
	}
	//PAGE VIEWS
	if(function_exists('ispv_print_total_views')){
		if(isset($meta_arr['ivc_display_views']) && $meta_arr['ivc_display_views']==1){
			$ipsv_count = ispv_return_views_number($attr['url'] );
			if($ipsv_count !== FALSE){
				$html = ispv_print_total_views($meta_arr, $html, $ipsv_count);
				$js .= ispv_print_views_js($attr['indeed_wrap_id'], $ipsv_count);
			}
		}
	}
		
	
	/********************* HTML **************************/
    
		$html =  '<div class="ism_popup_wrapper" style="display: none;">'
				  .'<div class="ism_popup_box" id="'.$attr['parent_before_wrap_id'].'">'
				    . '<div class="ism_top_side">' . $meta_arr['title'] . '</div>'
					. '<div class="ism_close_popup" onClick="ism_close_popup(\'#'.$attr['parent_before_wrap_id'].'\');"></div>'
					. '<div class="ism-popup-content" >'
					. '<div class="ism_popup_above_content">'.ims_format_source_text(stripslashes($meta_arr['above_content'])).'</div>'
					. '<div class="ism_wrap '.$meta_arr['template'].' '.$meta_arr['type'].'" id="'.$attr['indeed_wrap_id'].'">' 
						. $html 
					. '</div>'
					. '<div class="ism_popup_below_content">'.ims_format_source_text(stripslashes($meta_arr['bellow_content'])).'</div>'
					. '</div>'
				  . '</div>'
				. '</div>';
		$html .= ismAfterShareHtml($meta_arr, $attr);    
	
    /****************** CSS ******************/
    $css .= ism_style_for_popup($attr, $meta_arr);
    $css .= '
			'.$meta_arr['custom_css'];
	$css = "<style>" . $css . "</style>";

	
    /************************JS****************/	
    #DISPLAY COUNTS
    if( ((isset($meta_arr['print_total_shares']) && $meta_arr['print_total_shares']==1) || $meta_arr['display_counts']=='true') && isset($ismitems_arr) ){
		$js .= ism_display_counts_js($ismitems_arr, $attr['url'], $attr['indeed_wrap_id'], $meta_arr['display_counts'], $arr['fc_arr']);
	}	
	
	
    #STATISTICS
    $statistics = get_option('ism_enable_statistics');
    if(isset($statistics) && $statistics==1) 
	   $js .= 'var ism_enable_statistics=1;';

	
    if(!defined('ISM_BASE_PATH_JS')){
    	wp_localize_script( 'ism_front_end_f', 'ism_base_path', get_site_url() );// base url for ajax calls
    	define('ISM_BASE_PATH_JS', 1);//include variable just one time
    }
    wp_enqueue_script('jquery-ui-effects');//load jquery ui for slide effect
    wp_enqueue_script('ism_front_end_f');//js front end function 
        $js .= ism_show_up_popup($attr['parent_before_wrap_id'], $meta_arr);
    
	$js = "<script>" . $js . "</script>";   
