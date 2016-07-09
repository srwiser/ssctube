<?php
function ism_checkbox_icons_settings_field($settings, $value){
	$str = '';
	$str .= '<div style="display:inline-block;vertical-align: top;margin-top: 20px;">';
	$i = 1;
	foreach($settings['ism_items'] as $k=>$v){
		if($i%15==0){
			$str .= '</div>';
			$str .= '<div style="display:inline-block;vertical-align: top;margin-top: 20px;">';
		}
		$i++;
		$checked = '';
		if(strpos($value, $k)!==FALSE) $checked = 'checked="checked"';
		$icon = $k;
		if($icon=='go1') $icon = 'goo';
		$str .= '<div style="min-width: 230px;">
					<div style="display:inline-block;width: 70%;line-height: 1.3;padding: 7px 5px;font-weight: bold;vertical-align: top; color: #222;font-size: 14px;">
						<img src="'.ISM_DIR_URL.'admin/files/images/icons/'.$icon.'.png" class="indeed_icons_admin" />
						'.$v['label'].'
					</div>
					<div style="display:inline-block;line-height: 1.3;padding: 7px 5px;">
						<input type="checkbox" value="'.$v.'" id="" onClick="make_inputh_string(this, \''.$k.'\', \'#sm_items\');" class="" '.$checked.' />
                    </div>
                </div>';
    }//end foreach
    $str .= '</div>';
    $str .= '<input type="hidden" value="'.$value.'" name="'.$settings['param_name'].'" id="sm_items" class="wpb_vc_param_value  '.$settings['param_name'].' '.$settings['type'].'_field" />';
    return $str;
}
add_shortcode_param('ism_checkbox_icons', 'ism_checkbox_icons_settings_field');

function ism_dropdown_picture_settings_field( $settings, $value ){
    $str = '';
    $str .= '<select id="'.$settings['ism_select_id'].'" name="'.$settings['param_name'].'" class="wpb_vc_param_value  '.$settings['param_name'].' '.$settings['type'].'_field" onChange="'.$settings['onchange'].'" >';
    foreach($settings['ism_items'] as $k=>$v){
        $selected = '';
        if($value==$k) $selected = 'selected="selected"';
        $str .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
    }
    $str .= "</select>";
    $str .= "<div id='ism_preview' style='display: inline-block;padding: 5px 0px;'></div>";
    $str .= '<div class="ism-info">'.$settings['aditional_info'].'</div>';
    $str .= '<script>'.$settings['onload_script'].'</script>';
    return $str;
}
add_shortcode_param('ism_dropdown_picture', 'ism_dropdown_picture_settings_field');

function ism_return_radio_settings_field( $settings, $value ){
    $str = '';
    $str .= '<div style="margin-bottom:10px; font-weight:bold;">' . $settings['ism_label'] . '</div>';
    foreach($settings['ism_items'] as $k=>$v){
        $selected = '';
        if( $value==$k ) $selected = 'checked="checked"';
        $str .= '<div style="margin:5px;"><input type="radio" value="'.$k.'" '.$selected.' onClick="jQuery(\'#'.$settings['id_hidden'].'\').val(this.value);" name="'.$settings['param_name'].'" style="width: initial;">  '.$v.'</div>';
	}
    $str .= '<input type="hidden" value="'.$value.'" name="'.$settings['param_name'].'" class="wpb_vc_param_value  '.$settings['param_name'].' '.$settings['type'].'_field" id="'.$settings['id_hidden'].'" />';
    $str .= '<div class="ism-info">'.$settings['aditional_info'].'</div>';

    return $str;
}
add_shortcode_param('ism_return_radio', 'ism_return_radio_settings_field');

function ism_return_checkbox_settings_field( $settings, $value ){
    $str = '';
    $checked = '';
    if(isset($settings['title_before_field']) && $settings['title_before_field']!='') $str .= $settings['title_before_field'];
    if($value=='true' || $value==1) $checked = 'checked="checked"';
    $str .= '<span style="font-weight:bold; padding-right:10px;">' .$settings['ism_label']. '</span>';
    $str .= '<input type="checkbox" name="'.$settings['param_name'].'" onClick="'.$settings['onClick_function'].'(this, \'#'.$settings['id_hidden'].'\');" '.$checked.' id="'.$settings['checkbox_id'].'"/>';
    $str .= '<input type="hidden" value="'.$value.'" name="'.$settings['param_name'].'" id="'.$settings['id_hidden'].'" class="wpb_vc_param_value  '.$settings['param_name'].' '.$settings['type'].'_field" />';
    $str .= '<div class="ism-info">'.$settings['aditional_info'].'</div>';

    return $str;
}
add_shortcode_param('ism_return_checkbox', 'ism_return_checkbox_settings_field');

function ism_return_number_settings_field( $settings, $value ){
    $str = '';
    $str .= '<span style="font-weight:bold; padding-right:10px;">' .$settings['ism_label']. '</span>';
    $str .= '<input type="number"  value="'.$value.'" name="'.$settings['param_name'].'" min="0" id="'.$settings['ism_input_id'].'" class="wpb_vc_param_value  '.$settings['param_name'].' '.$settings['type'].'_field" /> '.$settings['count_type'];
    $str .= '<div class="ism-info">'.$settings['aditional_info'].'</div>';
    return $str;
}
add_shortcode_param('ism_return_number', 'ism_return_number_settings_field');


function ism_return_dropdown_settings_field( $settings, $value ){
	$str = '';
	if(isset($settings['ism_label'])) $str .= "<b>".$settings['ism_label']."</b>";
	$str .= '<select id="'.$settings['ism_select_id'].'" name="'.$settings['param_name'].'" class="wpb_vc_param_value  '.$settings['param_name'].' '.$settings['type'].'_field" onChange="'.$settings['onchange'].'" >';
	foreach($settings['ism_items'] as $k=>$v){
		$selected = '';
		if($value==$k) $selected = 'selected="selected"';
		$str .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
	}
	$str .= "</select>";
	return $str;
}
add_shortcode_param('ism_return_dropdown', 'ism_return_dropdown_settings_field');

?>