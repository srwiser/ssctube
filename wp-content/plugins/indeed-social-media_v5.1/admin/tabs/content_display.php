<?php
if(isset($_REQUEST['id_submit_bttn'])){
	ism_return_arr_update( 'id' );
}
//default settings
$meta_arr = ism_return_arr_val( 'id' );
?>
<div class="metabox-holder indeed">
    <form method="post" action="">
	<div class="stuffbox">
		<div class="ism-top-message"><b>"Content Display"</b> will help you to show Social Share Icons inside the Content Pages in Predefined positions (on Top, on Bottom or Both) or  a Custom position and just for a certain type of Pages.</div>
	</div>
	<?php 
		//sm checkboxes
		ism_print_list_checkboxes($meta_arr, 'id', 'id_submit_bttn');
	?>

        
        <?php
			//STANDARD TEMPLATES
        	ism_return_standard_templates_html( 'id_template', $meta_arr['id_template'], 'id_submit_bttn' );
        
        	//SPECIAL TEMPLATES
        	ism_return_special_templates_html( 'id_template', $meta_arr['id_template'], 'id_submit_bttn' );
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
	                                    $checked = ism_checkSelected('vertical', $meta_arr['id_list_align'], 'radio');
	                                ?>
	                                <input type="radio" name="id_list_align" value="vertical" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Vertical</span>
	                                <?php
	                                    $checked = ism_checkSelected('horizontal', $meta_arr['id_list_align'], 'radio');
	                                ?>
	                                <input type="radio" name="id_list_align" value="horizontal" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Horizontal</span>
	                            </td>
	                        </tr>
	                	</tbody>
	                </table>
	
	               <table class="form-table" style="width: 450px;">
		                <tbody>             
	                        <tr valign="top">
	                            <th scope="row">
	                                Animation Show:
	                            </th>
	                            <td>
	                            	<select name="id_animation">
	                            	<?php 
		                              $a_arr = ism_return_special_effects();
		                            	foreach($a_arr as $k=>$v){
		                            		?>
		                            		<optgroup label="<?php echo $k;?>">
		                            			<?php 
		                            				foreach($v as $key=>$value){
		                            					$selected = '';
		                            					if($meta_arr['id_animation']==$key) $selected = 'selected="selected"';
		                            					?>
		                            						<option value="<?php echo $key;?>" <?php echo $selected;?> ><?php echo $value;?></option>
		                            					<?php 	
		                            				}
		                            			?>
		                            		</optgroup>
		                            		<?php 
		                            	}                          	
	                            	?>                              	                           	
	                            	</select>
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
	                                    $checked = ism_checkSelected('true', $meta_arr['id_display_counts'], 'checkbox');
	                                ?>
	                                <input type="checkbox" onClick="ism_check_and_h(this, '#display_counts');" class="ism-switch" <?php echo $checked;?> />
	                                <div class="switch" style="display:inline-block;"></div>
	                            </label>
                                <input type="hidden" value="<?php echo $meta_arr['id_display_counts'];?>" name="id_display_counts" id="display_counts" />
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                Display Full Name Of Social Network
                            </th>
                            <td>
                            	<label>
	                                <?php
	                                    $checked = ism_checkSelected('true', $meta_arr['id_display_full_name'], 'checkbox');
	                                ?>
	                                <input type="checkbox" onClick="ism_check_and_h(this, '#id_display_full_name');" class="ism-switch" <?php echo $checked;?> />
	                                <div class="switch" style="display:inline-block;"></div>
	                            </label>
                                <input type="hidden" value="<?php echo $meta_arr['id_display_full_name'];?>" name="id_display_full_name" id="id_display_full_name" />
                            </td>
                        </tr>
						<tr valign="top">
                            <th scope="row">
                               Number of Columns
                            </th>
                            <td>
                            	<select name="id_no_cols" style="min-width:150px;">
								<?php 
									for($ic = 0; $ic < 7; $ic++){
										if($ic == 0) $label = 'Default';
										else $label = $ic.' Columns';
										$selected = '';
	                            		if($meta_arr['id_no_cols']== $ic) $selected = 'selected="selected"';
										?>
	                            		<option value="<?php echo $ic;?>" <?php echo $selected;?> ><?php echo $label;?></option>
	                            	<?php 
									}
								?>
								</select>
                            </td>
                        </tr>
						<tr valign="top">
                            <th scope="row">
                               Box Alignment
                            </th>
                            <td>
                            	<select name="id_box_align" style="min-width:150px;">
									<?php $selected = ism_checkSelected('left', $meta_arr[ 'id_box_align' ], 'select'); ?>
	            					<option value="left" <?php echo $selected;?> >Left</option>
									<?php $selected = ism_checkSelected('center', $meta_arr[ 'id_box_align' ], 'select'); ?>
	            					<option value="center" <?php echo $selected;?> >Center</option>
									<?php $selected = ism_checkSelected('right', $meta_arr[ 'id_box_align' ], 'select'); ?>
	            					<option value="right" <?php echo $selected;?> >Right</option>	
								</select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="id_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
<?php
	$info = 'If none of them is not selected, the Social Icons will <strong>not show up</strong> using the "Content Display".';
	return_display_where_html( 'id', $meta_arr, 'id_submit_bttn', $info );
?>
        <div class="stuffbox">
            <h3>
                <label>Position:</label>
            </h3>
            <div class="inside">
                <table class="form-table">
	                <tbody>
                        <tr valign="top">
                            <td>
                                <?php
                                    $checked = ism_checkSelected('before', $meta_arr['id_position'], 'radio');
                                ?>
                                <input type="radio" name="id_position" value="before" <?php echo $checked;?> class="" onClick="jQuery('#custom_id_position').css('display', 'none');"/><span class="indeedcrlabel" style="font-weight:bold; color: #6cc072;">Before Content</span>
                             </td>
						</tr>
						<tr valign="top">
                            <td>   
								<?php
                                    $checked = ism_checkSelected('after', $meta_arr['id_position'], 'radio');
                                ?>
                                <input type="radio" name="id_position" value="after" <?php echo $checked;?> class="" onClick="jQuery('#custom_id_position').css('display', 'none');" /><span class="indeedcrlabel" style="font-weight:bold; color: #6cc072;">After Content</span>
                              </td>
						</tr>
						<tr valign="top">
                            <td>   
								<?php
                                    $checked = ism_checkSelected('both', $meta_arr['id_position'], 'radio');
                                ?>
                                <input type="radio" name="id_position" value="both" <?php echo $checked;?> class="" onClick="jQuery('#custom_id_position').css('display', 'none');" /><span class="indeedcrlabel" style="font-weight:bold; color: #6cc072;">Both ( Before & After Content)</span>
                              </td>
						</tr>
						<tr valign="top">
                            <td>   
								<?php
                                    $checked = ism_checkSelected('custom', $meta_arr['id_position'], 'radio');
                                ?>
                                <input type="radio" name="id_position" value="custom" <?php echo $checked;?> class="" onClick="jQuery('#custom_id_position').css('display', 'block');" /><span class="indeedcrlabel" style="font-weight:bold; color: #369;">Custom</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
                        <?php
                            $display = 'none';
                            if($meta_arr['id_position']=='custom') $display = 'block';
                        ?>
                <table class="form-table" style="display: <?php echo $display;?>; margin-left:50px;" id="custom_id_position">
	                <tbody>
                        <tr valign="top">
                                          <?php $checked = ism_checkSelected($meta_arr['id_top_bottom'], 'top', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="id_top_bottom" value="top" <?php echo $checked;?>/><span class="indeedcrlabel">Top</span></td>
                                          <?php $checked = ism_checkSelected($meta_arr['id_top_bottom'], 'bottom', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="id_top_bottom" value="bottom" <?php echo $checked;?>/><span class="indeedcrlabel">Bottom</span></td>
                                      <td class="indeed_td_np"><input type="number" value="<?php echo $meta_arr['id_top_bottom_value'];?>" name="id_top_bottom_value" class="indeed_number"/> px</td>
                        </tr>
                        <tr valign="top">
                                          <?php $checked = ism_checkSelected($meta_arr['id_left_right'], 'left', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="id_left_right" value="left" <?php echo $checked;?>/><span class="indeedcrlabel">Left</span></td>
                                          <?php $checked = ism_checkSelected($meta_arr['id_left_right'], 'right', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="id_left_right" value="right" <?php echo $checked;?>/><span class="indeedcrlabel">Right</span></td>
                                      <td class="indeed_td_np"><input type="number" value="<?php echo $meta_arr['id_left_right_value'];?>" name="id_left_right_value" class="indeed_number"/> px</td>
                        </tr>
	                </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="id_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        
       <?php 
       		//total counts metabox
       		echo total_share_count_admin_box( 'id', $meta_arr );
       		
       		//visits
       		ism_return_views_section( 'id', $meta_arr, 'id_submit_bttn' );
       		
       		//after show
       		ism_after_share_html( 'id', $meta_arr, 'id_submit_bttn' );
       ?>

        <div class="stuffbox">
            <h3>
                <label>Mobile:</label>
            </h3>
            <div class="inside">
                <table class="form-table">
	                <tbody>
                        <tr valign="top">
                            <th scope="row">
                               Disable On Mobile:
                            </th>
                            <td>
    	                		<label>
    	                			<?php 
    	                				$checked = '';
    	                				if(isset($meta_arr['id_disable_mobile']) && $meta_arr['id_disable_mobile']==1) $checked = 'checked="checked"';
    	                			?>
    	                			<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#id_disable_mobile');" <?php echo $checked;?> />
    	                		<div class="switch" style="display:inline-block;"></div>
    	                		</label>
    	                		<input type="hidden" value="<?php echo $meta_arr['id_disable_mobile'];?>" name="id_disable_mobile" id="id_disable_mobile" />                     
                            </td>
                        </tr>
                     </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="id_submit_bttn" class="button button-primary button-large" />
                </div>            
            </div>
       </div>    
    </form>
</div>
</div>