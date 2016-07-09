<?php
        //templates
        include ISM_DIR_PATH . 'admin/functions/admin_functions.php';
        $ism_templates = array_merge(ism_return_standard_templates_arr(), ism_return_special_templates_arr() );//ism_return_templates();

        /////////////////////SHARE SHORTCODE
        vc_map( array(
        			   "name" => "Indeed Social Share",
        			   "base" => "indeed-social-media",
        			   "icon" => "ism_vc_logo",
                       "description" => "Indeed Social Share",
    			       "class" => "indeed-social-media",
    			       "category" => __('Content', "js_composer"),
        			   "params" => array(
                                        array(
                                                "type" => "ism_checkbox_icons",
                                                "label" => "Social Network List",
                                                "value" => 'fb,tw,goo,pt,li,dg,tbr,su,vk,rd,dl,wb,xg,pf,email',
                                                "param_name" => "sm_list",
												"heading" => "Social Networks",
                                                "admin_label" => TRUE,
                                                "ism_items" => ism_return_general_labels_sm(''),
                                            ),
                                        array(
                                                "type" => "ism_dropdown_picture",
                                                "label" => "Social Network List",
                                                "value" => '',
                                                "onchange" => 'ism_preview_templates_vc();',
                                                "onload_script" => 'ism_base_path="'.get_site_url().'";jQuery(document).ready(function(){ism_preview_templates_vc();});',
                                                "param_name" => "template",
                                                "ism_items" => $ism_templates,
                                                "ism_select_id" => "template",
                                                "aditional_info" => "Some of the templates are recommended for Vertical Align (like template 9) and others for Horizontal Align (like template 5). Check the Hover Effects!",
                                            ),
                                        array(
                                                      "type" => "ism_return_radio",
                                                      "param_name" => "list_align",
                                                      "ism_items" => array('vertical'=>"Vertical", 'horizontal'=>"Horizontal"),
                                                      "id_hidden" => "hidden_list_align_type",
                                                      "ism_label" => "List Align",
                                                      "value" => "horizontal",
                                                      "aditional_info" => "Select how the the list should be displayed.",
                                              ),
                                        array(
                                                "type" => "ism_return_checkbox",
                                        		"onClick_function" => "ism_check_and_h",
                                                "param_name" => "display_counts",
                                                "id_hidden" => "display_counts",
                                                "checkbox_id" => "checkbox_display_counts",
                                                "value" => 'false',
                                                "ism_label" => "Display Counts",
                                                "aditional_info" => "Number of shares on each network will be displayed.",
                                              ),
                                        array(
                                                "type" => "ism_return_checkbox",
                                                "param_name" => "display_full_name",
                                        		"onClick_function" => "ism_check_and_h",
                                                "id_hidden" => "display_full_name",
                                                "checkbox_id" => "checkbox_display_full_name",
                                                "value" => 'false',
                                                "ism_label" => "Display Full Name Of Social Network",
                                                "aditional_info" => "",
                                              ),
        			   					array(
        			   							'type' => 'ism_return_dropdown',  							
        			   							"ism_label" => "Number of Columns",
        			   							"value" => '0',
        			   							"onchange" => '',
        			   							"param_name" => "no_cols",
        			   							"ism_items" => array('0'=>'Default','1'=>'1 Columns', '2'=>'2 Columns', '3'=>'3 Columns', '4'=>'4 Columns', '5'=>'5 Columns', '6'=>'6 Columns'),
        			   							"ism_select_id" => "select-no_cols",        			   							
        			   						  ),
			        			   		array(
			        			   				'type' => 'ism_return_dropdown',
			        			   				"ism_label" => "Box Alignment",
			        			   				"value" => 'left',
			        			   				"onchange" => '',
			        			   				"param_name" => "box_align",
			        			   				"ism_items" => array('left'=>'Left','center'=>'Center', 'right'=>'Right'),
			        			   				"ism_select_id" => "select-box_align",
			        			   		),        			   		
			        			   		array(
			        			   				"type" => "ism_return_checkbox",
			        			   				"param_name" => "disable_mobile",
			        			   				"onClick_function" => "check_and_h",
			        			   				"id_hidden" => "disable_mobile",
			        			   				"checkbox_id" => "checkbox_disable_mobile",
			        			   				"value" => 0,
			        			   				"ism_label" => "Disable Mobile",
			        			   				"aditional_info" => "",
			        			   		),        			   		
			        			   		array(
			        			   				"type" => "ism_return_checkbox",
			        			   				"onClick_function" => "check_and_h",
			        			   				"param_name" => "print_total_shares",
			        			   				"id_hidden" => "print_total_shares",
			        			   				"checkbox_id" => "checkbox_print_total_shares",
			        			   				"value" => 0,
			        			   				"ism_label" => "Show",
			        			   				"aditional_info" => "",
			        			   				'title_before_field' => '<div style="margin-top: 10px;font-weight:bold;">Total Shares Count:</div>',
			        			   		),
			        			   		array(
			        			   				"type" => "ism_return_dropdown",
			        			   				"ism_label" => "Position",
			        			   				"value" => 'before',
			        			   				"onchange" => '',
			        			   				"param_name" => "tc_position",
			        			   				"ism_items" => array('before'=>'Before Social Network Icons','after'=>'After Social Network Icons'),
			        			   				"ism_select_id" => "tc_position",
			        			   		),
			        			   		array(
			        			   				"type" => "ism_return_checkbox",
			        			   				"onClick_function" => "check_and_h",
			        			   				"param_name" => "display_tc_label",
			        			   				"id_hidden" => "display_tc_label",
			        			   				"checkbox_id" => "checkbox_display_tc_label",
			        			   				"value" => 0,
			        			   				"ism_label" => "Show Label",
			        			   				"aditional_info" => "",
			        			   		),
			        			   		array(
			        			   				"type" => "ism_return_checkbox",
			        			   				"onClick_function" => "check_and_h",
			        			   				"param_name" => "display_tc_sublabel",
			        			   				"id_hidden" => "display_tc_sublabel",
			        			   				"checkbox_id" => "checkbox_display_tc_sublabel",
			        			   				"value" => 0,
			        			   				"ism_label" => "Show SubLabel",
			        			   				"aditional_info" => "",
			        			   		),    
			        			   		array(
			        			   				"type" => "ism_return_dropdown",
			        			   				"ism_label" => "Position",
			        			   				"value" => 'before',
			        			   				"onchange" => '',
			        			   				"param_name" => "tc_theme",
			        			   				"ism_items" => array('light'=>'Light','dark'=>'Dark'),
			        			   				"ism_select_id" => "tc_theme",
			        			   		),        			   		
                                    )
                       )
               );

        //////////////////////////LOCKER SHORTCODE
        $vc_locker = get_option('ism_enable_vc_locker');
	if (function_exists('vc_add_param') && $vc_locker ) {
		// Row Setting Parameters

		vc_add_param("vc_row", array(
													"type" => "seperator",
													"heading" => "Indeed Social Locker",
													"param_name" => "seperator_indeed_locker",
													"value"	=> "Indeed Social Locker",
													"group"	=> "Indeed Social Locker",
		));
		vc_add_param("vc_row", array(
                                                    "type" => "ism_checkbox_icons",
                                                    "label" => "Social Network List",
                                                    "value" => '',
                                                    "param_name" => "lk_sl",//sm_list
                                                    "ism_items" => ism_return_general_labels_sm('', false, 'locker'),
                                                    "ism_select_id" => "template",
													"group" => "Indeed Social Locker",
		));
		vc_add_param("vc_row", array(
                                                      "type" => "ism_dropdown_picture",
                                                      "label" => "Social Network List",
                                                      "value" => '',
                                                      "onchange" => 'ism_preview_templates_vc();',
                                                      "onload_script" => 'ism_base_path="'.get_site_url().'";jQuery(document).ready(function(){ism_preview_templates_vc();});',
                                                      "param_name" => "lk_t",//template
                                                      "ism_items" => $ism_templates,
                                                      "ism_select_id" => "template",
                                                      "aditional_info" => "Some of the templates are recommended for Vertical Align (like template 9) and others for Horizontal Align (like template 5). Check the Hover Effects!",
													  "group" => "Indeed Social Locker",
		));
		vc_add_param("vc_row", array(
                                                      "type" => "ism_return_radio",
                                                      "param_name" => "lk_la",//list_align
                                                      "ism_items" => array('vertical'=>"Vertical", 'horizontal'=>"Horizontal"),
                                                      "id_hidden" => "hidden_list_align_type",
                                                      "ism_label" => "List Align",
                                                      "value" => "horizontal",
                                                      "aditional_info" => "Select how the the list should be displayed.",
				                                      "group" => "Indeed Social Locker",		
		));
		vc_add_param("vc_row", array(
                                                      "type" => "ism_return_checkbox",
                                                      "param_name" => "lk_dc",//display_counts
                                                      "id_hidden" => "hidden_display_counts",
													  "onClick_function" => "ism_check_and_h",
                                                      "checkbox_id" => "checkbox_display_counts",
                                                      "value" => 'true',
                                                      "ism_label" => "Display Counts",
                                                      "aditional_info" => "Number of shares on each network will be displayed.",
													  "group" => "Indeed Social Locker",
		));
		vc_add_param("vc_row", array(
                                                      "type" => "ism_return_checkbox",
                                                      "param_name" => "lk_dfn",//display_full_name
                                                      "id_hidden" => "display_full_name",
													  "onClick_function" => "ism_check_and_h",
                                                      "checkbox_id" => "checkbox_display_full_name",
                                                      "value" => 'true',
                                                      "ism_label" => "Display Full Name Of Social Network",
                                                      "aditional_info" => "",
													  "group" => "Indeed Social Locker",
		));
		vc_add_param("vc_row", array(
													"type" => "ism_return_dropdown",
													"ism_label" => "Locker Theme",
													"value" => '2',
													"onchange" => '',
													"param_name" => "lk_lt",//locker_template
													"ism_items" => array(1=>'Default', 2=>'Basic', 3=>'Zipped', 4=>'Zone', 5=>'Majic Transparent', 6=>'Star', 7=>'Clouddy', 8=>'Darks'),
													"ism_select_id" => "locker_template",
													"group" => "Indeed Social Locker",
		));
		vc_add_param("vc_row", array(
													"type" => "ism_return_checkbox",
													"param_name" => "lk_etl",//enable_timeout_lk
													"id_hidden" => "lk_etl",
												    "onClick_function" => "check_and_h",
													"checkbox_id" => "checkbox_enable_timeout_lk",
													"value" => '0',
													"ism_label" => "Enable Delay Time",
													"aditional_info" => "",
													"group" => "Indeed Social Locker",
		));
		vc_add_param("vc_row", array(
													"type" => "ism_return_number",
													"param_name" => "lk_tl",//sm_timeout_locker
													"ism_input_id" => "sm_lock_timeout",
													"value" => "30",
													"ism_label" => "Delay Time:",
													"count_type" => "sec(s)",
													"aditional_info" => "",
													"group" => "Indeed Social Locker",			
		));
		vc_add_param("vc_row", array(
													"type" => "ism_return_checkbox",
													"param_name" => "lk_nru",//not_registered_u
													"id_hidden" => "not_registered_u",
													"onClick_function" => "check_and_h",
													"checkbox_id" => "checkbox_not_registered_u",
													"value" => '0',
													"ism_label" => "Disable Locker For Registered Users",
													"aditional_info" => "",
													"group" => "Indeed Social Locker",
		));		
		vc_add_param("vc_row", array(
													"type" => "ism_return_checkbox",
													"param_name" => "lk_rl",//reset_locker
													"id_hidden" => "lk_rl",
													"onClick_function" => "check_and_h",
													"checkbox_id" => "checkbox_reset_locker",
													"value" => '0',
													"ism_label" => "Enable Reset Locker",
													"aditional_info" => "",
													"group" => "Indeed Social Locker",	
		));			
		vc_add_param("vc_row", array(
													"type" => "ism_return_number",
													"param_name" => "lk_lra",//locker_reset_after
													"ism_input_id" => "lk_lra",
													"value" => "30",
													"ism_label" => "Reset Locker After:",
													"count_type" => "",
													"aditional_info" => "",
													"group" => "Indeed Social Locker",
		));	
		vc_add_param("vc_row", array(
													"type" => "ism_return_dropdown",
													"ism_label" => "Reset Locker After Type:",
													"value" => 'days',
													"onchange" => '',
													"param_name" => "lk_lrt",//locker_reset_type
													"ism_items" => array('minutes'=>'Minutes', 'hours'=>"Hours", "days"=>"Days"),
													"ism_select_id" => "locker_reset_type",
													"group" => "Indeed Social Locker",
		));	
		vc_add_param("vc_row", array(
													"type" => "ism_return_dropdown",
													"ism_label" => "Overlock:",
													"value" => '',
													"onchange" => '',
													"param_name" => "lk_io",//ism_overlock
													"ism_items" => array('default'=>"Default", "opacity"=>"Opacity"),
													"ism_select_id" => "ism_overlock",
													"group" => "Indeed Social Locker",	
		));		
		vc_add_param("vc_row", array(
                                                      "type" => "colorpicker",
                                                      "heading" => "Background-Color:",
                                                      "param_name" => "lk_lb",//sm_lock_bk
                                                      "description" => "",
                                                      "edit_field_class" => 'col-md-6',
													  "group" => "Indeed Social Locker",
		));
		vc_add_param("vc_row", array(
                                                      "type" => "ism_return_number",
                                                      "param_name" => "lk_lp",//sm_lock_padding
                                                      "ism_input_id" => "lk_lp",
                                                      "value" => "50",
                                                      "ism_label" => "Padding:",
                                                      "count_type" => "px",
                                                      "aditional_info" => "General Padding for the Locker Box can be set.",
													  "group" => "Indeed Social Locker",
		));
		
		vc_add_param('vc_row',	array(
														"type" => "ism_return_checkbox",
														"param_name" => "lk_dm",//disable_mobile
														"onClick_function" => "check_and_h",
														"id_hidden" => "lk_dm",
														"checkbox_id" => "checkbox_disable_mobile",
														"value" => 0,
														"ism_label" => "Disable Mobile",
														"aditional_info" => "",
														'group' => 'Indeed Social Locker',
		));
		vc_add_param('vc_row',	array(
														"type" => "ism_return_checkbox",
														"param_name" => "lk_thm",//twitter_hide_mobile
														"onClick_function" => "check_and_h",
														"id_hidden" => "lk_thm",
														"checkbox_id" => "checkbox_twitter_hide_mobile",
														"value" => 0,
														"ism_label" => "Hide Twitter On Mobile",
														"aditional_info" => "",
														'group' => 'Indeed Social Locker',
		));
		vc_add_param('vc_row',	array(
														"type" => "ism_return_checkbox",
														"param_name" => "lk_tuo",//twitter_unlock_onclick
														"onClick_function" => "check_and_h",
														"id_hidden" => "lk_tuo",
														"checkbox_id" => "checkbox_twitter_unlock_onclick",
														"value" => 0,
														"ism_label" => "Unlock Twitter On Click:",
														"aditional_info" => "This option it's available only for Mobile",
														'group' => 'Indeed Social Locker',		
		));		
		
		vc_add_param("vc_row", array(
                                                        "type" => "textarea_html",
                                                        "holder" => "div",
                                                        "heading" => "Locker Message",
                                                        "param_name" => "lk_dt",//sm_d_text
                                                        "value" => "&nbsp;",
														"group" => "Indeed Social Locker",		
		));
	
    }
?>