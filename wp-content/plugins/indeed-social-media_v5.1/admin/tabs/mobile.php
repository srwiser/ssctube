<?php
if(isset($_REQUEST['md_submit_bttn'])){
	ism_return_arr_update( 'md' );
}
//default settings
$meta_arr = ism_return_arr_val( 'md' );
?>
		<div class="metabox-holder indeed">
		    <form method="post" action="">
			    <div class="stuffbox">
					<div class="ism-top-message"><b>"Mobile Display"</b> can set a special show up of Social Share Icons on Mobile Devices. Special predefined Templates for mobile are available and the other general Displayes can be disabled. The verificaton is made based on "User Agent".</div>
				</div>
				<?php 
					//sm checkboxes
					ism_print_list_checkboxes($meta_arr, 'md', 'md_submit_bttn');
				?>

		        <div class="stuffbox">
		            <h3>
		                <label>Special Mobile Templates:</label>
		            </h3>
		            <div class="inside" style="vertical-align: top;">
		                <table class="form-table">
			                <tbody>
		                        <tr valign="top">
		                            <th scope="row">
		                                Select a Template:
		                            </th>
		                            <td>
		                                <select id="special_mobile_template" name="md_mobile_special_template" onChange="md_disabled_rest_templates();" class="ism_select_admin_section">
		                                    <?php
		                                    	$mobile_special_templates = array(	
		                                    										'ism_template_mob_1' => '(#1) The First Four Big Buttons',
		                                    										'ism_template_mob_2' => '(#2) The Bottom Slide Share',
		                                    										'ism_template_mob_3' => '(#3) Left Hiding',
		                                    									 );
		                                        foreach($mobile_special_templates as $key=>$value){
		                                            $select = ism_checkSelected($meta_arr['md_mobile_special_template'], $key, 'select');
		                                            ?>
		                                                <option value="<?php echo $key;?>" <?php echo $select;?>><?php echo $value;?></option>
		                                            <?php
		                                        }
		                                    ?>
		                                </select>
										
		                            </td>
		                        </tr>
								</tbody>
		                </table>
						<span class="ism-info">The Mobile Templates are Predefined Built and will restrict the other options from <strong>Mobile Display</strong> section! </span>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="md_submit_bttn" class="button button-primary button-large" />
		                </div>		                		            
		            </div>
		        </div>		    
        
        <?php
			//STANDARD TEMPLATES
        	ism_return_standard_templates_html( 'md_template', $meta_arr['md_template'], 'md_submit_bttn' );
        
        	//SPECIAL TEMPLATES
        	ism_return_special_templates_html( 'md_template', $meta_arr['md_template'], 'md_submit_bttn' );
        ?> 
				
		        <div class="stuffbox">
		            <h3>
		                <label>Display Options:</label>
		            </h3>
		            <div class="inside">
		               <table class="form-table" style="width: 450px;">
			                <tbody>
		                        <tr valign="top">
		                            <th scope="row">
		                                List Align:
										<span class="ism-info">Select how the the list should be displayed.</span>
		                            </th>
		                            <td>
		                                <?php
		                                    $checked = ism_checkSelected('vertical', $meta_arr['md_list_align'], 'radio');
		                                ?>
		                                <input type="radio" name="md_list_align" value="vertical" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Vertical</span>
		                                <?php
		                                    $checked = ism_checkSelected('horizontal', $meta_arr['md_list_align'], 'radio');
		                                ?>
		                                <input type="radio" name="md_list_align" value="horizontal" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Horizontal</span>
		                            </td>
		                        </tr>
		                        <tr>
		                        	<td colspan="2" style="margin:0px;padding:0px;">
		                        		<span class="ism-info">Vertical Align is not available for Predifined Position!</span>
		                        	</td>
		                        </tr>
		                	</tbody>
		                </table>
		                		            
		                <table class="form-table" style="margin-top: 30px;">
			                <tbody>
		                        <tr valign="top">
		                            <th scope="row">
		                                Display Counts
										<span class="ism-info">Number of shares on each network will be displayed.</span>
		                            </th>
		                            <td>
		                            	<label>
			                                <?php
			                                    $checked = ism_checkSelected('true', $meta_arr['md_display_counts'], 'checkbox');
			                                ?>
			                                <input type="checkbox" onClick="ism_check_and_h(this, '#display_counts');" class="ism-switch" <?php echo $checked;?> />
			                            	<div class="switch" style="display:inline-block;"></div>
										</label>	
		                                <input type="hidden" value="<?php echo $meta_arr['md_display_counts'];?>" name="md_display_counts" id="display_counts" />
		                            </td>
		                        </tr>
		                        <tr valign="top">
		                            <th scope="row">
		                                Display Full Name Of Social Network
		                            </th>
		                            <td>
		                            	<label>
			                                <?php
			                                    $checked = ism_checkSelected('true', $meta_arr['md_display_full_name'], 'checkbox');
			                                ?>
			                                <input type="checkbox" onClick="ism_check_and_h(this, '#md_display_full_name');" class="ism-switch" <?php echo $checked;?> />
			                            	<div class="switch" style="display:inline-block;"></div>
										</label>			                             
		                                <input type="hidden" value="<?php echo $meta_arr['md_display_full_name'];?>" name="md_display_full_name" id="md_display_full_name" />
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
						<span class="ism-info">For some <strong>Special Mobile Templates</strong> those options are not available! </span>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="md_submit_bttn" class="button button-primary button-large" />
		                </div>
		            </div>
		        </div>		
        				
		        <div class="stuffbox">
		            <h3>
		                <label>Position <span style="font-weight: 500; font-size: 15px;">(only for Standard Templates)</span>:</label>
		            </h3>
		            <div class="inside">
		                <table class="form-table">
			                <tbody>
		                        <tr valign="top">
		                            <th scope="row">
		                               Floating:
		                            </th>
		                            <td>
		                                <?php $checked = ism_checkSelected($meta_arr['md_floating'], 'yes', 'radio');?>
		                                <input type="radio" name="md_floating" value="yes" <?php echo $checked;?> /><span class="indeedcrlabel">Yes</span>
		                                <?php $checked = ism_checkSelected($meta_arr['md_floating'], 'no', 'radio');?>
		                                <input type="radio" name="md_floating" value="no" <?php echo $checked;?> /><span class="indeedcrlabel">No</span>
										<span class="ism-info" style="display:inline-block; font-style:italic;">The Social Icons will stay all the time on the screen despite the scroll position</span>
		                            </td>
		                        </tr>

		                        <tr valign="top">
		                            <th scope="row">
		                                Predifined Position
		                            </th>
		                            <td style="padding: 0px;">
		                               <table>
		                               	  <tr>
		                               	  	  <td>
		                               	  	    <label>
		                               	  	    	<?php $checked = ism_checkSelected($meta_arr['md_pred_position'], 1, 'checkbox');?>	
		                               	  	      	<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#md_pred_position');ism_c_opacity(this, '#predefined_position', '#custom_position', '#enable_custom_pos', '#md_custom_position');" id="enable_pred_pos" <?php echo $checked;?>/>                               	  	      
    	                						  	<div class="switch" style="display:inline-block;"></div>
    	                						</label>	
    	                						<input type="hidden" value="<?php echo $meta_arr['md_pred_position'];?>" name="md_pred_position" id="md_pred_position" />	                               	  	
		                               	  	  </td>
		                               	  </tr> 
					                        <?php 
					                        	$opacity = 1;
					                        	if(isset($meta_arr['md_custom_position']) && $meta_arr['md_custom_position']==1){
					                        		$opacity= 0.5;	
					                        	}
					                        ?>		                               	
		                               	  <tr id="predefined_position" style="opacity: <?php echo $opacity;?>">		                       		                            
					                            <td style="padding:0px;">
					                                <?php $checked = ism_checkSelected($meta_arr['md_predefined_position'], 'bottom', 'radio');?>
					                                <input type="radio" name="md_predefined_position" value="bottom" <?php echo $checked;?> /><span class="indeedcrlabel">Bottom Full Width</span>
					                                <?php $checked = ism_checkSelected($meta_arr['md_predefined_position'], 'top', 'radio');?>
					                                <input type="radio" name="md_predefined_position" value="top" <?php echo $checked;?> /><span class="indeedcrlabel">Top Full Width</span>
					                                <div style="margin-top: 10px;margin-bottom: 20px;">
					                                	<?php $checked = ism_checkSelected($meta_arr['md_behind_bk'], 1, 'checkbox');?>
					                                	<input type="checkbox" onClick="check_and_h(this, '#md_behind_bk');" <?php echo $checked;?> />
					                                	<input type="hidden" id="md_behind_bk" name="md_behind_bk" value="<?php echo $meta_arr['md_behind_bk'];?>" />					                              
					                                	With Transparent Background 
					                                </div>		                            
					                            </td>
					                     </tr>
					                  </table>
					                </td>
		                        </tr>
		                        <tr valign="top" >
		                            <th scope="row">
		                                Custom Position
										<span class="ism-info">Set the Box's icons position. Can be used positive or negative values.</span>
		                            </th>
		                            <td style="padding: 0px;">
		                               <table>
		                               	  <tr>
		                               	  	  <td colspan="2">
		                               	  	    <label>
		                               	  	    	<?php $checked = ism_checkSelected($meta_arr['md_custom_position'], 1, 'checkbox');?>	
		                               	  	      	<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#md_custom_position');ism_c_opacity(this, '#custom_position', '#predefined_position', '#enable_pred_pos', '#md_pred_position');" id="enable_custom_pos" <?php echo $checked;?>/>                               	  	      
    	                						  	<div class="switch" style="display:inline-block;"></div>
    	                						</label>	
    	                						<input type="hidden" value="<?php echo $meta_arr['md_custom_position'];?>" name="md_custom_position" id="md_custom_position" />	                               	  	
		                               	  	  </td>
		                               	  </tr> 
		                               </table>
				                        <?php 
				                        	$opacity = 1;
				                        	if(isset($meta_arr['md_pred_position']) && $meta_arr['md_pred_position']==1){
				                        		$opacity= 0.5;	
				                        	}
				                        ?>		                              
		                               <table id="custom_position" style="opacity: <?php echo $opacity;?>">	
		                                  <tr>
		                                          <?php $checked = ism_checkSelected($meta_arr['md_top_bottom'], 'top', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="md_top_bottom" value="top" <?php echo $checked;?>/><span class="indeedcrlabel">Top</span></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['md_top_bottom'], 'bottom', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="md_top_bottom" value="bottom" <?php echo $checked;?>/><span class="indeedcrlabel">Bottom</span></td>
		                                  </tr>
										  <tr style="height:40px; vertical-align:top;">    
											  <td class="indeed_td_np"><input type="number" value="<?php echo $meta_arr['md_top_bottom_value'];?>" name="md_top_bottom_value" class="indeed_number" style="margin-top:4px;"/></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['md_top_bottom_type'], '%', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="md_top_bottom_type" value="%" <?php echo $checked;?>  style="margin-left:20px;"/><span class="indeedcrlabel" style="margin-right:3px;">% | </span>
		                                          <?php $checked = ism_checkSelected($meta_arr['md_top_bottom_type'], 'px', 'radio');?>
		                                      <input type="radio" class="" name="md_top_bottom_type" value="px" <?php echo $checked;?>/><span class="indeedcrlabel">px</span></td>
		                                  </tr>
		                                  <tr>
		                                          <?php $checked = ism_checkSelected($meta_arr['md_left_right'], 'left', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="md_left_right" value="left" <?php echo $checked;?>/><span class="indeedcrlabel">Left</span></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['md_left_right'], 'right', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="md_left_right" value="right" <?php echo $checked;?>/><span class="indeedcrlabel">Right</span></td>
		                                  </tr>
										  <tr>
											  <td class="indeed_td_np"><input type="number" value="<?php echo $meta_arr['md_left_right_value'];?>" name="md_left_right_value" class="indeed_number" style="margin-top:4px;"/></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['md_left_right_type'], '%', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="md_left_right_type" value="%" <?php echo $checked;?>  style="margin-left:20px;"/><span class="indeedcrlabel" style="margin-right:3px;">% | </span>
		                                          <?php $checked = ism_checkSelected($meta_arr['md_left_right_type'], 'px', 'radio');?>
		                                      <input type="radio" class="" name="md_left_right_type" value="px" <?php echo $checked;?>/><span class="indeedcrlabel">px</span></td>
		                                  </tr>
		                               </table>
		                            </td>
		                        </tr>
		                    </tbody>
		                </table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="md_submit_bttn" class="button button-primary button-large" />
		                </div>
		            </div>
		        </div>
 
		        <div class="stuffbox">
		            <h3>
		                <label>Custom Show <span style="font-weight: 500; font-size: 15px;">(only for Standard Templates)</span>:</label>
		            </h3>
		            <div class="inside">
		                <table class="form-table">
			                <tbody>
		                        <tr valign="top">
		                            <th scope="row">
		                               Zoom:
		                            </th>
		                            <td>
		                            	<input type="number" value="<?php echo $meta_arr['md_zoom'];?>" name="md_zoom" min="0" max="1" step="0.01" style="width: 65px;" /> 
		                            </td>
		                        </tr>
		                        <tr valign="top">
		                            <th scope="row">
		                               Opacity:
		                            </th>
		                            <td>
		                            	<input type="number" value="<?php echo $meta_arr['md_opacity'];?>" name="md_opacity" min="0" max="1" step="0.01" style="width: 65px;" /> 
		                            </td>
		                        </tr>		                        
		                    </tbody>
		                </table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="md_submit_bttn" class="button button-primary button-large" />
		                </div>
		            </div>
		        </div> 

		        
	<?php
					//where to display
					$info = 'If none of them is not selected, the Social Icons will <strong>not show up</strong> using the "Mobile Display".';
					return_display_where_html( 'md', $meta_arr, 'md_submit_bttn', $info );

		       		//total counts metabox
		       		echo total_share_count_admin_box( 'md', $meta_arr );
		       		
		       		//visits
		       		ism_return_views_section( 'md', $meta_arr, 'md_submit_bttn' );
		       		
		       		//after show
		       		ism_after_share_html( 'md', $meta_arr, 'md_submit_bttn' );
		       ?>		        
		                	
			</form>
		</div>	
</div>		