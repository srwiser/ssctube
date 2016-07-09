<?php
    //post title, description, url and feature image
	global $post;
	$attr['url'] = ism_return_current_url(); //url or permalink
	$custom_data = ism_check_custom_share_data($attr['url']);
	if($custom_data!==FALSE){
		//title
		$attr['post_title'] = $custom_data['title'];
		if($attr['post_title']==FALSE || $attr['post_title']=='') $attr['post_title'] = ism_return_post_title();//standard title
		//description
		$attr['description'] = ism_format_like_post_description( stripslashes($custom_data['message']) );
		if($attr['description']==FALSE || $attr['description']=='') $attr['description'] = ism_return_post_description();//standard description
		//feature image
		$attr['feat_img'] = $custom_data['feat_image'];
		if( ($attr['feat_img']==FALSE || $attr['feat_img']=='') || (isset($meta_arr['ISI_image']) && $meta_arr['ISI_image']==TRUE) ) $attr['feat_img'] = ism_return_feat_image($meta_arr); //feature image
		//url
		if(isset($custom_data['shared_url']) && $custom_data['shared_url']!='') $attr['url'] = $custom_data['shared_url'];
	}else{
		$attr['post_title'] = ism_return_post_title(); // the title
		$attr['description'] = ism_return_post_description(); // post description
		$attr['feat_img'] = ism_return_feat_image($meta_arr); //feature image		
	}
	
	//////DIV ID's
    $rand = rand(1,5000);
    $attr['indeed_wrap_id'] = 'indeed_sm_wrap_' . $rand;
    $attr['before_wrap_id'] = 'indeed_before_wrapD_' . $rand;
    if(!isset($attr['locker_div_id'])) $attr['locker_div_id'] = 0;
    else $attr['locker_div_id'] = '#' . $attr['locker_div_id'];
    if(!isset($attr['content_id'])) $attr['content_id'] = 0;
    else $attr['content_id'] = '#' . $attr['content_id'];
    if(isset($meta_arr['after_share_id']) && $meta_arr['after_share_id']!='' ) $attr['after_share_id'] = $meta_arr['after_share_id'];
    else $attr['after_share_id'] = 'ism_after_share_' . rand(0, 1000);

    /***************************** CSS ***************************/
    //MOBILE
	$css = ism_print_mobile_style( $meta_arr, $attr );
	//MAIN CSS
	$css .= ism_print_standard_style( $attr, $meta_arr );
	$css = '<style>' . $css . '</style>';

    $arr = ism_return_sm_arr_ready($meta_arr, $attr);
    if(isset($html)) $html = '';
    $html = $arr['html'];
    if(isset($ismitems_arr)) unset($ismitems_arr);
    $ismitems_arr = $arr['ismitems_arr'];
    if(isset($html_arr)) unset($html_arr);
    $html_arr = $arr['html_arr'];

    //REORDER SOCIAL MEDIA LIST && get string for each social item
    if(isset($meta_arr['mobile_special_template']) && $meta_arr['mobile_special_template']!='0'){ 
    	//MOBILE SPECIAL HTML
    	$html_arr = ism_reorder_sm_list($html_arr);
    	$sm_num_count = count($html_arr);
    	$html .= ism_special_mobile_template($html_arr, @$sm_num_count, $meta_arr['mobile_special_template'], $attr['url'], $attr['indeed_wrap_id'], $meta_arr);
    }else{
		//DEFAULT HTML
		$html_arr = ism_reorder_sm_list($html_arr);
   		foreach($html_arr as $val){
   			$html .= ism_return_item($val, $attr['url'], $meta_arr['list_align']);
   		}
    }  
	
	//TOTAL SHARE COUNT
	if(isset($meta_arr['print_total_shares']) && $meta_arr['print_total_shares']==1 ){
		$js .= print_total_shares_js($attr['indeed_wrap_id']);
		if(isset($meta_arr['mobile_special_template']) && $meta_arr['mobile_special_template']!=''){ 			
		}else{
			$html = print_total_shares_html($meta_arr, $html);
		}
	}
	
	//PAGE VIEWS
	if(function_exists('ispv_print_total_views')){
		if(isset($meta_arr['ivc_display_views']) && $meta_arr['ivc_display_views']==1){
			$ipsv_count = ispv_return_views_number($attr['url']);
			if($ipsv_count !== FALSE){
				if(!isset($meta_arr['mobile_special_template']) || $meta_arr['mobile_special_template']==''){//no mobile
					$html = ispv_print_total_views($meta_arr, $html, $ipsv_count);
				}
				$js .= ispv_print_views_js($attr['indeed_wrap_id'], $ipsv_count);
			}
		}	
	}
	
	
	/************************** FINAL HTML **************************/
	$html = ism_print_default_div_parents($attr, $meta_arr, $html);
       
	//Print Outside
    $temp_arr = ism_print_outside_js_function($meta_arr, $attr, $html, $js);
    $js = $temp_arr['js'];
    $html = $temp_arr['html'];
    
    //AFTER SHARE
    if(!isset($meta_arr['ISI_image']) || $meta_arr['ISI_image']==FALSE)
    $html .= ismAfterShareHtml($meta_arr, $attr);
	
    #DISPLAY COUNTS
    if( ((isset($meta_arr['print_total_shares']) && $meta_arr['print_total_shares']==1) || $meta_arr['display_counts']=='true') && isset($ismitems_arr) ) $js .= ism_display_counts_js($ismitems_arr, $attr['url'], $attr['indeed_wrap_id'], $meta_arr['display_counts'], $arr['fc_arr']);
        
    #STATISTICS
    $statistics = get_option('ism_enable_statistics');
    if(isset($statistics) && $statistics==1) $js .= 'var ism_enable_statistics=1;';

	if(!defined('ISM_BASE_PATH_JS')){
		wp_localize_script( 'ism_front_end_f', 'ism_base_path', get_site_url() );// base url for ajax calls
		define('ISM_BASE_PATH_JS', 1);//include variable just one time
	}
    if(isset($js) && $js!='') $js = "<script>" . $js . "</script>";
    wp_enqueue_script('ism_front_end_f');
    if(isset($meta_arr['after_share_enable']) && $meta_arr['after_share_enable']==1){
    	wp_enqueue_script('ism_after_actions');
    }