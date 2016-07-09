<?php 
	/*
	 * Shortcode attributes are stored in $attr variable
	 * General options are stored in $meta_arr
	 * 
	 */

$rand = rand(1,5000);
$attr['parent_before_wrap_id'] = 'ism_b_parent_'.$rand;
$attr['indeed_wrap_id'] = 'indeed_sm_wrap_' . $rand;
$attr['type'] = 'ism-follow';
	
$arr = ifm_return_sm_arr_ready($meta_arr, $attr);

///////HTML
$arr['html_arr'] = ism_reorder_sm_list( $arr['html_arr'] );
$html = isf_return_item($arr['html_arr'], $attr['list_align']);
$html = isf_html_wraps($html, $attr);
//////CSS
$css = isf_get_css($attr);
//////JS
isf_define_js_basepath();
$js .= isf_load_counts($arr['ismitems_arr'], $attr['indeed_wrap_id']);
$js = isf_js_tags($js);

$final_str = $css . $js . $html;

