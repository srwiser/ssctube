<?php 
function ism_return_special_effects(){
	//return array with special effects for website and content display
	$arr = array(
			'None' => array('none'=>'...'),
			'Sliders' => array(
					'ism_slideInDown'=>'slideInDown',
					'ism_slideInLeft'=>'slideInLeft',
					'ism_slideInRight'=>'slideInRight',
			),
			'Fading Entrances' => array(
					'ism_fadeIn'=>'fadeIn',
					'ism_fadeInDown'=>'fadeInDown',
					'ism_fadeInDownBig'=>'fadeInDownBig',
					'ism_fadeInLeft'=>'fadeInLeft',
					'ism_fadeInLeftBig'=>'fadeInLeftBig',
					'ism_fadeInRight'=>'fadeInRight',
					'ism_fadeInRightBig'=>'fadeInRightBig',
					'ism_fadeInUp'=>'fadeInUp',
					'ism_fadeInUpBig'=>'fadeInUpBig',
			),
			'Bouncing Entrances' => array(
					'ism_bounceIn'=>'bounceIn',
					'ism_bounceInDown'=>'bounceInDown',
					'ism_bounceInLeft'=>'bounceInLeft',
					'ism_bounceInRight'=>'bounceInRight',
					'ism_bounceInUp'=>'bounceInUp',
			),
			'Flippers' => array(
					'ism_flip'=>'flip',
					'ism_flipInX'=>'flipInX',
					'ism_flipInY'=>'flipInY',
			),
			'Rotating Entrances' => array(
					'ism_rotateIn'=>'rotateIn',
					'ism_rotateInDownLeft'=>'rotateInDownLeft',
					'ism_rotateInDownRight'=>'rotateInDownRight',
					'ism_rotateInUpLeft'=>'rotateInUpLeft',
					'ism_rotateInUpRight'=>'rotateInUpRight',
			),
			'Special Effects' => array(
					'ism_bounce' => 'bounce',
					'ism_flash'=>'flash',
					'ism_pulse'=>'pulse',
					'ism_rubberBand'=>'rubberBand',
					'ism_shake'=>'shake',
					'ism_swing'=>'swing',
					'ism_tada'=>'tada',
					'ism_wobble'=>'wobble',
					'ism_lightSpeedIn'=>'lightSpeedIn',
					'ism_rollIn'=>'rollIn',
			)
	);
	return $arr;
}


function ism_return_all_cpt( $excluded=array() ){
	//return all custom post type except the built in and the $excluded
	$args = array('public'=>true, '_builtin'=>false);
	$data = get_post_types($args);
	if(count($excluded)>0){
		foreach($excluded as $e){
			if(in_array($e, $data)) $data = ism_array_delete($data, $e);
		}
	}
	return $data;
}

function ism_array_delete($array, $element) {
	//delete element from array by value
	return array_diff($array, array($element) );
}


/******* html functions ********/
function ism_return_meta_box($post){
	//return html meta boxes for admin section
	?>
    <script>
        function check_and_h(target, hidden){
        	if (jQuery(target).is(":checked")) jQuery(hidden).val(1);
        	else jQuery(hidden).val(0);
        }
    </script>
	<table class="ism-it-table">
	<?php
	$arr = array( 'ism_disable_wd' => 'Disable Website Display', 
				  'ism_disable_id' => 'Disable Content Display', 
				  'ism_disable_s_in' => 'Disable Slide In',
				  'ism_disable_popup' => 'Disable PopUp',
			 	 );
	if( is_plugin_active('indeed-share-point/indeed-share-point.php') ) $arr['ism_disable_genie'] = 'Disable Share Point';
	if( is_plugin_active('indeed-share-bar/indeed-share-bar.php') ) $arr['ism_disable_isb'] = 'Disable Share Bar';
	foreach($arr as $k=>$v){
		$disable = esc_html(get_post_meta($post->ID, $k, true));
		$checked = '';	
        if($disable==1) $checked = 'checked';//'checked="checked|"'
		?>
		<tr>
            <td>
                <input type="checkbox"  <?php echo $checked;?> onClick="check_and_h(this, '#<?php echo $k;?>')" />
                <input type="hidden" value="<?php echo $disable;?>" id="<?php echo $k;?>" name="<?php echo $k;?>"/>
            </td>
            <td class="it-label"><?php echo $v;?></td>
        </tr>		
		<?php
	}
	?>
	</table>
	<div class="clear"></div>
	<?php
}


function total_share_count_admin_box( $type, $meta_arr ){
	?>
		<div class="stuffbox">
			<h3>
				<label>Total Shares Count:</label>
			</h3>
			<div class="inside">
			<table class="form-table">
					<tr valign="top">
						<td>
							Show:
						</td>
						<td>
							<?php
								$checked = ism_checkSelected(1, $meta_arr[ $type . '_print_total_shares' ], 'checkbox');
							?>
		                	<label>
		                      	<input type="checkbox" onClick="check_and_h(this, '#<?php echo $type . '_print_total_shares';?>');" class="ism-switch" <?php echo $checked;?> />
		                       	<div class="switch" style="display:inline-block;"></div>
		                    </label>
		                    <input type="hidden" value="<?php echo $meta_arr[ $type . '_print_total_shares' ];?>" name="<?php echo $type . '_print_total_shares';?>" id="<?php echo $type . '_print_total_shares';?>" />	   	            		            		
			            </td>
		            </tr>
		            <tr>
		            	<td colspan="2"><div style="height: 10px;"></div></td>
		            </tr>
	            	<tr valign="top">
	            		<td>
	            			Position:
	            		</td>
	            		<td>
	            			<select name="<?php echo $type . '_tc_position';?>">
	            					<?php $selected = ism_checkSelected('before', $meta_arr[ $type . '_tc_position' ], 'select'); ?>
	            				<option value="before" <?php echo $selected;?> >Before Social Network Icons</option>
	            					<?php $selected = ism_checkSelected('after', $meta_arr[ $type . '_tc_position' ], 'select'); ?>
	            				<option value="after" <?php echo $selected;?> >After Social Network Icons</option>
	            			</select>
	            		</td>
	            	</tr>
	            	<tr valign="top">
	            		<td>
	            			Show Label:
	            		</td>
	            		<td>
                        	<?php
                            	$checked = ism_checkSelected(1, $meta_arr[ $type.'_display_tc_label' ], 'checkbox');
                            ?>
                            <label>
                               	<input type="checkbox" onClick="check_and_h(this, '#<?php echo $type.'_display_tc_label';?>');" class="ism-switch" <?php echo $checked;?> />
                             	<div class="switch" style="display:inline-block;"></div>
                            </label>
                            <input type="hidden" value="<?php echo $meta_arr[ $type.'_display_tc_label' ];?>" name="<?php echo $type.'_display_tc_label';?>" id="<?php echo $type.'_display_tc_label';?>" />	            			
	            		</td>
	            	</tr>
	            	<tr valign="top">
	            		<td>
	            			Show SubLabel:
	            		</td>
	            		<td>
                        	<?php
                            	$checked = ism_checkSelected(1, $meta_arr[ $type.'_display_tc_sublabel' ], 'checkbox');
                            ?>
                            <label>
                               	<input type="checkbox" onClick="check_and_h(this, '#<?php echo $type.'_display_tc_sublabel';?>');" class="ism-switch" <?php echo $checked;?> />
                             	<div class="switch" style="display:inline-block;"></div>
                            </label>
                            <input type="hidden" value="<?php echo $meta_arr[ $type.'_display_tc_sublabel' ];?>" name="<?php echo $type.'_display_tc_sublabel';?>" id="<?php echo $type.'_display_tc_sublabel';?>" />	            			
	            		</td>
	            	</tr>
	            	<tr valign="top">
	            		<td>
	            			Color Theme:
	            		</td>
	            		<td>
	            			<select name="<?php echo $type . '_tc_theme';?>">
	            					<?php $selected = ism_checkSelected('light', $meta_arr[ $type . '_tc_theme' ], 'select'); ?>
	            				<option value="light" <?php echo $selected;?> >Light</option>
	            					<?php $selected = ism_checkSelected('dark', $meta_arr[ $type . '_tc_theme' ], 'select'); ?>
	            				<option value="dark" <?php echo $selected;?> >Dark</option>
	            			</select>	            			
	            		</td>
	            	</tr>	            	
	            </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="<?php echo $type;?>_submit_bttn" class="button button-primary button-large" />
                </div>            	
            </div>        
        </div>
	<?php 
}

function ism_return_standard_templates_arr(){
	//default templates 1-10
	for($i=1;$i<11;$i++){
		$name = 'Default';
		switch($i){
			case 1: $name = 'Standard'; break;
			case 2: $name = 'Cosmopolitan'; break;
			case 3: $name = 'Margarita'; break;
			case 4: $name = 'Pisco Sour'; break;
			case 5: $name = 'Americano'; break;
			case 6: $name = 'Cuba Libre'; break;
			case 7: $name = 'Brandy Alexander'; break;
			case 8: $name = 'Vieux Carre'; break;
			case 9: $name = 'French 75'; break;
			case 10: $name = 'White Russian'; break;
		}
		$arr["ism_template_".$i] = '(#'.$i.') '.$name;
	}
	return $arr;
}

function ism_return_special_templates_arr(){
    $arr = array();
    $plugins_arr = array('indeed-social-media', 'indeed-share-mega-theme');//list of plugins where to search for template files
    foreach($plugins_arr as $name){
    	$plugin_dir = '';
    	if($name=='indeed-social-media'){
    		$plugin_dir = ISM_DIR_PATH;
    	}else{
    		$plugin_dir = str_replace('indeed-social-media', $name, ISM_DIR_PATH );
    	}
    	$plugin_dir .= 'templates/';
    	if(is_readable($plugin_dir)){
    		if ($handle = opendir( $plugin_dir )) {
    			while (false !== (@$entry = readdir($handle))) {
    				if(strpos($entry, '.')>1){
    					$ism_content_file = file_get_contents( $plugin_dir . $entry );
    					$templ_arr = explode('#INDEED_TEMPLATES#', $ism_content_file);
    					if(isset($templ_arr[1])){
    						$templ = (array)json_decode($templ_arr[1]);
    						$arr = array_merge($arr, $templ);
    					}
    				}
    			}
    		}
    	}
    }
    return $arr;    
}

function ism_return_standard_templates_html( $type, $value_to_check, $bttn ){
	//return html
	?>
	<div class="stuffbox">
    	<h3>
        	<label>Standard Templates:</label>
        </h3>
        <div class="inside" style="vertical-align: top;">

	    	<table class="form-table">
            	<tr valign="top">
                	<th scope="row">
                    	Select a Template:
                    </th>
                    <td>
                    	<select id="standard_template" name="<?php echo $type;?>" onChange="ism_preview_templates_be('#ism_preview_1', '#ism_preview_2', '#special_template', '#standard_template', '<?php echo $type;?>');" class="ism_select_admin_section">
                    		<option value="0">...</option>
                        	<?php
                        	foreach(ism_return_standard_templates_arr() as $key=>$value){
                        		$select = '';
                        		if($value_to_check==$key){
                        			$select = 'selected="selected"';
                        			$load_template = true;
                        		}
                                ?>
                                <option value="<?php echo $key;?>" <?php echo $select;?>><?php echo $value;?></option>
                                <?php
                            }
                            ?>
                        </select>
					</td>
                </tr>
			</table>
			<div style="display:inline-block;">
            	<div id="ism_preview_1" style="display: inline-block;padding: 5px 0px;"></div>
				<span class="ism-info">Some of the templates are recommended for <strong>Vertical</strong> Align (like template 9) and others for <strong>Horizontal</strong> Align (like template 5). <strong>Check the Hover Effects!</strong></span>
        	</div>
        	<div class="submit">
            	<input type="submit" value="Save changes" name="<?php echo $bttn;?>" class="button button-primary button-large" />
        	</div>
        </div>
    </div>
	<?php 
	if(isset($load_template) && $load_template==true){
		?>
				<script>
					jQuery(document).ready(function(){
						ism_preview_templates_be('#ism_preview_1', '#ism_preview_2', '#special_template', '#standard_template', '<?php echo $type;?>');
					});
				</script>
			<?php 	
		}	
}

function ism_return_special_templates_html( $type, $value_to_check, $bttn ){
	$templates = ism_return_special_templates_arr();
	$extra_class = '';
	if(count($templates)==0) $extra_class = 'ism_not_available_feat';// css class
	?>
		<div class="stuffbox ism-addon-box">
		<div class="ism-ribbon <?php echo $extra_class;?>"></div>
	    	<h3>
	        	<label>AddOn Packs Templates:</label>
	        </h3>
	        <div class="inside" style="vertical-align: top;">
		    	<table class="form-table">
	            	<tr valign="top">
	                	<th scope="row">
	                    	Select a Template:
	                    </th>
	                    <td>
	                    	<select id="special_template" name="<?php echo $type;?>" onChange="ism_preview_templates_be('#ism_preview_2', '#ism_preview_1', '#standard_template', '#special_template', '<?php echo $type;?>');" class="ism_select_admin_section">
	                    		<option value="0">...</option>
	                        	<?php
	                        	if(count($templates)>0){	                        		
		                        	foreach($templates as $key=>$value){
		                        		$select = '';
		                        		if($value_to_check==$key){
		                        			$select = 'selected="selected"';
		                        			$load_template = true;	
		                        		}
		                                ?>
		                                <option value="<?php echo $key;?>" <?php echo $select;?>><?php echo $value;?></option>
		                                <?php
		                            }
	                        	}
	                            ?>
	                        </select>
						</td>
	                </tr>
				</table>
				<div style="display:inline-block;">
	            	<div id="ism_preview_2" style="display: inline-block;padding: 5px 0px;"></div>
					<?php 
						if(count($templates)!=0){ ?>
							<span class="ism-info">Some of the templates are recommended for <strong>Vertical</strong> Align (like template 9) and others for <strong>Horizontal</strong> Align (like template 5). <strong>Check the Hover Effects!</strong></span>
							<?php 
						}else{	?>
							<span class="ism-info">No Themes Pack(s) installed.</span>
	        			<?php }?>
	        	</div>
	        	<div class="submit">
	            	<input type="submit" value="Save changes" name="<?php echo $bttn;?>" class="button button-primary button-large" />
	        	</div>
	        </div>
	    </div>
	<?php 	
	if(isset($load_template) && $load_template==true){
		?>
			<script>
				jQuery(document).ready(function(){
					ism_preview_templates_be('#ism_preview_2', '#ism_preview_1', '#standard_template', '#special_template', '<?php echo $type;?>');
				});
			</script>
		<?php 	
	}
}

function ism_return_views_section( $type, $meta_arr, $bttn ){
	$class = 'ism_not_available_feat';
	if( is_plugin_active('indeed-share-page-views/indeed-share-page-views.php') ){
		$class = '';
	}
	?>
		<div class="stuffbox ism-addon-box">
			<div class="ism-ribbon <?php echo $class;?>"></div>
            <h3>
                <label>AddOn Page Views:</label>
            </h3>
            <div class="inside">
                <table class="form-table">
 	               <tr valign="top">
    	               <th scope="row">
        	               Show:
                       </th>
                       <td>
	            			<label>
		                    	<?php
		                    		$checked = '';	
		                        	if(isset($meta_arr[$type.'_ivc_display_views']) && $meta_arr[$type.'_ivc_display_views']==1) $checked = 'checked="checked"';
		                        ?>
		                        <input type="checkbox" onClick="check_and_h(this, '#ivc_display_views');" class="ism-switch" <?php echo $checked;?> />
		                        <div class="switch" style="display:inline-block;"></div>
		                    </label>
	                        <input type="hidden" value="<?php echo $meta_arr[$type.'_ivc_display_views'];?>" name="<?php echo $type;?>_ivc_display_views" id="ivc_display_views" />                          
                       </td>
					</tr>
 	               <tr valign="top">
    	               <th scope="row">
        	               Position:
                       </th>
                       <td>
							<select name="<?php echo $type;?>_ivc_position">
								<option value="before" <?php if(isset($meta_arr[$type.'_ivc_position']) && $meta_arr[$type.'_ivc_position']=='before') echo 'selected="selected"';?> >Before Social Network Icons</option>
								<option value="after" <?php if(isset($meta_arr[$type.'_ivc_position']) && $meta_arr[$type.'_ivc_position']=='after') echo 'selected="selected"';?> >After Social Network Icons</option>
							</select>
                       </td>
				   </tr>
 	               <tr valign="top">
    	               <th scope="row">
        	               SubLabel:
                       </th>
                       <td>
	            			<label>
		                    	<?php
		                    		$checked = '';	
		                        	if(isset($meta_arr[$type.'_ivc_sublable_on']) && $meta_arr[$type.'_ivc_sublable_on']==1) $checked = 'checked="checked"';
		                        ?>
		                        <input type="checkbox" onClick="check_and_h(this, '#ivc_sublable_on');" class="ism-switch" <?php echo $checked;?> />
		                        <div class="switch" style="display:inline-block;"></div>
		                    </label>
	                        <input type="hidden" value="<?php echo $meta_arr[$type.'_ivc_sublable_on'];?>" name="<?php echo $type;?>_ivc_sublable_on" id="ivc_sublable_on" />    							
                       </td>
					</tr>	
					<tr valign="top">
    	               <th scope="row">
        	               Theme:
                       </th>
                       <td>
							<select name="<?php echo $type;?>_ivc_theme" >
								<option value="light" <?php if(isset($meta_arr[$type.'_ivc_theme']) && $meta_arr[$type.'_ivc_theme']=='light') echo 'selected="selected"';?> >Light</option>
								<option value="dark" <?php if(isset($meta_arr[$type.'_ivc_theme']) && $meta_arr[$type.'_ivc_theme']=='dark') echo 'selected="selected"';?> >Dark</option>
							</select>
                       </td>
				   </tr>										
				</table>
				<div class="submit">
	            	<input type="submit" value="Save changes" name="<?php echo $bttn;?>" class="button button-primary button-large" />
	        	</div>
			</div>					
		</div>
	<?php 
}

function ism_after_share_html( $type, $meta_arr, $bttn ){
	?>
		<div class="stuffbox">
			<h3>
                <label>After Share PopUp</label>
            </h3>
            <div class="inside">
            	<table class="">
 	            	<tr valign="top">
    	            	<th scope="row">
        	            	Show:
                        </th>
                        <td>
	            			<label>
		                    	<?php
		                    		$checked = '';	
		                        	if(isset($meta_arr[$type.'_after_share_enable']) && $meta_arr[$type.'_after_share_enable']==1) $checked = 'checked="checked"';
		                        ?>
		                        <input type="checkbox" onClick="check_and_h(this, '#after_share_enable');" class="ism-switch" <?php echo $checked;?> />
		                        <div class="switch" style="display:inline-block;"></div>
		                    </label>
	                        <input type="hidden" value="<?php echo $meta_arr[$type.'_after_share_enable'];?>" name="<?php echo $type;?>_after_share_enable" id="after_share_enable" />                         
                        </td>
                    </tr>
                    <tr valign="top">
                    	<th scope="row">Title:</th>
                    	<td>
                    		<input type="text" name="<?php echo $type.'_after_share_title';?>" value="<?php echo $meta_arr[$type.'_after_share_title'];?>" />
                    	</td>
                    </tr>
                    <tr valign="top">
                    	<th scope="row">Content:</th>
                    	<td>
                    		<?php 
            					$options = array('textarea_name'=> $type.'_after_share_content', 'textarea_rows' => 5 );
            					wp_editor(stripslashes($meta_arr[$type.'_after_share_content']), 'after_share_content', $options);
            				?>
                    	</td>
                    </tr>
                </table>
				<div class="submit">
	            	<input type="submit" value="Save changes" name="<?php echo $bttn;?>" class="button button-primary button-large" />
	        	</div>            	
            </div>
        </div>
	<?php 
}

function ism_get_templates_from($file){
	$arr = array();
	$templates_dir = ISM_DIR_PATH . 'templates/' ;
	if(is_readable($templates_dir)){
		$ism_content_file = file_get_contents( $templates_dir . '/'.$file );
		$templ_arr = explode('#INDEED_TEMPLATES#', $ism_content_file);
		if(isset($templ_arr[1])){
			$arr = (array)json_decode($templ_arr[1]);
		}
	}
	return $arr;
}


function return_display_where_html( $type, $meta_arr, $bttn, $info ){
	if($meta_arr[$type.'_display_where']!='') $arr = explode(',', $meta_arr[$type.'_display_where']);
	if(!isset($arr) || $arr=='' || count($arr)==0) $arr=array();
	?>
	<div class="stuffbox">
            <h3>
                <label>Where To Display:</label>
            </h3>
            <div class="inside">
			<span class="ism-info" style="padding-top:20px;"><?php echo $info;?></span>
             <?php
                $ism_post_types = ism_return_post_types();
            ?>
                <table class="ism_cpt_table_checkboxes">
                        <?php
                        	$i = 0;
                            foreach($ism_post_types as $k=>$v){
                            	
                                if($i>0 && $i%5==0){
                                	?>
                                	</table>
                                	<table class="ism_cpt_table_checkboxes">
                                	<?php 	
                                }
                            	?>
                                <tr>
                                    <th>
                                        <?php echo ucfirst($v);?>
                                    </th>
                                    <td>
                                        <?php 
                            		    	$checked = '';
                            		        if(in_array($k, $arr)) $checked='checked="checked"';
                            		    ?>
                                        <input type="checkbox" id="" class="" <?php echo $checked;?> onClick="make_inputh_string(this, '<?php echo $k;?>', '#display_where');"/>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }

                            
                            ///// Custom Post Type Taxonomies
               				$tax = get_taxonomies(array('_builtin'=>false));
               				if($tax!=FALSE && count($tax)>0 ){        					
               					foreach($tax as $v){
               						$cpt_terms_arr[] = $v;
               					}
               				}

                            if(isset($cpt_terms_arr) && count($cpt_terms_arr)>0){
                            	foreach($cpt_terms_arr as $v){
                            		if($i>0 && $i%5==0){
                            			?>
                            	       		</table>
                            	            <table class="ism_cpt_table_checkboxes">
                            	        <?php 	
                            	        	}
                            	        ?>
                                        		<tr>
                                                	<th>
                                                      	<?php echo ucfirst($v).'<span class="ism-info-inline"> (CPT Category)</span>';?>
                                                    </th>
                                                    <td>
                                                      	<?php 
                                                       		$checked = '';
                                                      		if(in_array('cptterm_' . $v, $arr)) $checked='checked="checked"';?>
                                                            <input type="checkbox" <?php echo $checked;?> onClick="make_inputh_string(this, '<?php echo 'cptterm_' . $v;?>', '#display_where');"/>
                                                    </td>
                                                </tr>
                                       <?php
                                       $i++;
                               	}
                            }
                            
                            ///// CUSTOM POST TYPE WITHOUT bp and product
                            $cpt_arr = ism_return_all_cpt(array('bp_group', 'bp_activity', 'bp_members', 'product'));
                            if($cpt_arr!==FALSE && count($cpt_arr)>0){
                            	foreach($cpt_arr as $value){
	                                if($i>0 && $i%5==0){
	                                	?>
	                                	</table>
	                                	<table class="ism_cpt_table_checkboxes">
	                                	<?php 	
	                                }
	                            	?>
                            			<tr>
                            		    	<th>
                            		        	<?php echo ucfirst($value).'<span class="ism-info-inline"> (Custom Post Type)</span>';?>
                            		        </th>
                            		        <td>
                            		        	<?php 
                            		        		$checked = '';
                            		        		if(in_array('cpt_' . $value, $arr)) $checked='checked="checked"';?>
                            		            <input type="checkbox" <?php echo $checked;?> onClick="make_inputh_string(this, '<?php echo 'cpt_' . $value;?>', '#display_where');"/>
                            		        </td>
                            		    </tr>
                            		<?php
                            		$i++;
                            	}
                            }
                        ?>
                </table>
                    <input type="hidden" value="<?php echo $meta_arr[ $type . '_display_where' ];?>" name="<?php echo $type;?>_display_where" id="display_where" />
                <div class="submit">
                    <input type="submit" value="Save changes" name="<?php echo $bttn;?>" class="button button-primary button-large" />
                </div>
            </div>
        </div>	
	<?php 
}


function ism_after_share_go_settings(){
	ism_after_share_go_settings_um();
	$meta = ism_after_share_go_s_get_metas();
	?>
	<form action="" method="post"> 
		<div id="after-share"></div>
        <div class="stuffbox">
            <h3>
                <label>After Share Popup Settings:</label>
            </h3>
            <div class="inside">
            	<table class="ism_cpt_table_checkboxes">
                	<tr>
                    	<th valign="top">
                        	Max Width:
                        </th>
                        <td>
                        	<input type="number" min="1" value="<?php echo $meta['ism_after_share_m_width'];?>" name="ism_after_share_m_width" style="width: 60px;"/> px
                        </td>
                    </tr> 
                    <tr>
                    	<th valign="top">
                        	Min Height:
                        </th>
                        <td>
                        	<input type="number" min="1" value="<?php echo $meta['ism_after_share_m_height'];?>" name="ism_after_share_m_height" style="width: 60px;" /> px
                        </td>
                    </tr>  
                    <tr>
                    	<th valign="top">
                        	Custom CSS:
                        </th>
                        <td>
                        	<textarea name="ism_after_share_m_custom_css" style="width: 400px;height: 100px;"><?php echo $meta['ism_after_share_m_custom_css'];?></textarea>
                        </td>
                    </tr>                                	
            	</table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="after_share_save_bttn" class="button button-primary button-large" />
                </div>            	
            </div>
       	</div>
       	
    </form>   	
	<?php 
}
function ism_after_share_go_settings_um(){
	if(isset($_REQUEST['after_share_save_bttn'])){
		//updates after share general options settings
		$arr = ism_after_share_go_s_get_metas();
		foreach($arr as $k=>$v){
			if(isset($_REQUEST[$k])){
				$data = get_option($k);
				if($data!==FALSE){
					update_option($k, $_REQUEST[$k]);
				}else{
					add_option($k, $_REUQEST[$k]);
				}
			}
		}		
	}
}

function ism_print_list_checkboxes($meta_arr, $type, $button){
	?>
        <div class="stuffbox">
            <h3>
                <label>Social Network List:</label>
            </h3>
            <div class="inside">
                <div style="display:inline-block;vertical-align: top;margin-top: 20px;">
                      <?php
                          $sm_items = ism_return_general_labels_sm( 'short_keys', true, '' );
                          $i = 0;
                          foreach($sm_items as $k=>$v){
                          		if($i%8==0){
                          		?>
                          	        </div>
                          	        <div style="display:inline-block;vertical-align: top;margin-top: 20px;">
                          	    <?php
                          	    }
                          	    $i++;
                              $checked = ism_check_select_str($meta_arr[ $type.'_list' ], $k);
                              ?>
                                <div style="min-width: 250px;">
                                	<div style="display:inline-block;width: 70%;line-height: 1.3;padding: 7px 5px;font-weight: bold;vertical-align: top; color: #222;font-size: 14px;">
									    <img src="<?php echo ISM_DIR_URL;?>admin/files/images/icons/<?php echo $k;?>.png" class="indeed_icons_admin" />
                                        <?php echo $v;?>
                                   </div>
                                   <div style="display:inline-block;line-height: 1.3;padding: 7px 5px;">
                                        <input type="checkbox" value="<?php echo $v;?>" id="" onClick="make_inputh_string(this, '<?php echo $k;?>', '#sm_items');" class="" <?php echo $checked;?>/>
                                   </div>
                                </div>
                              <?php
                          }
                      ?>
                      <input type="hidden" value="<?php echo $meta_arr[ $type.'_list' ];?>" name="<?php echo $type;?>_list" id="sm_items"/>
                </div>
                <div class="submit">
                    <input type="submit" value="Save changes" name="<?php echo $button;?>" class="button button-primary button-large" />
                </div>
            </div>
        </div>	
	<?php 
}

function ism_print_list_checkboxes_shortcode($type=''){
	?>
            <div class="stuffbox">
                <h3>
                    <label>Social NetWork List:</label>
                </h3>
                <div class="inside">
					<div style="display:inline-block;vertical-align: top;margin-top: 20px;">
                            <?php
                                if($type=='follow'){
                                	$selected_sm='fb,tw,goo,pt,li,dg,tbr,su,vk,rd,dl,wb,xg';
                                	$sm_items = isf_return_labels_for_checkboxes();
                                }elseif($type=='shortcode_locker'){
                                	$selected_sm='fb,tw,li';
                                	$sm_items = ism_return_general_labels_sm('short_keys', false, 'locker');//ism_return_general_labels_sm( $type='long_keys', $exculde_plusone = true, $only_count = false )
                                }else{
                                	$selected_sm='fb,tw,goo,pt,li,dg,tbr,su,vk,rd,dl,wb,xg';
                                	$sm_items = ism_return_general_labels_sm( 'short_keys', true, '' );
                                }                                             
                                
                            $i = 0;
                            foreach($sm_items as $k=>$v){
                            	if($i%8==0){
                            		?>
                            	   	</div>
                            	    <div style="display:inline-block;vertical-align: top;margin-top: 20px;">
                            	    <?php
                            	}
                            	$i++;
                            ?>
                                <div style="min-width: 250px;">
                                	<div style="display:inline-block;width: 70%;line-height: 1.3;padding: 7px 5px;font-weight: bold;vertical-align: top; color: #222;font-size: 14px;">
                                    	<?php 
                                    		$icon = $k;
                                    		if($icon=='go1') $icon = 'goo';
                                    	?>
                                        <img src="<?php echo ISM_DIR_URL;?>admin/files/images/icons/<?php echo $icon;?>.png" class="indeed_icons_admin" />
                                        <?php echo $v;?>
                                    </div>
                                	<div style="display:inline-block;line-height: 1.3;padding: 7px 5px;">
                                        <?php
                                            $checked = '';
                                            if(strpos($selected_sm, $k)!==false) $checked = 'checked="checked"';

                                            $onclick = "make_inputh_string(this, '".$k."', '#sm_items');";
                               				if($type=='follow'){
                                				$onclick .= "isf_shortcode_update();";
                                			}else{
                                				$onclick .= "ism_shortcode_update('".$type."');";
                                			}
										?>
                                        <input type="checkbox" value="<?php echo $v;?>" <?php echo $checked;?> onClick="<?php echo $onclick;?>"/>
									</div>
								</div>
							<?php
                                }
                            ?>
                    </div>
                    <input type="hidden" value="<?php echo $selected_sm;?>" id="sm_items"/>
                </div>
			</div>	
	<?php 
}

