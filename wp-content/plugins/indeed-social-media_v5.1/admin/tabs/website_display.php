<?php
if(isset($_REQUEST['wd_submit_bttn'])){
	ism_return_arr_update( 'wd' );
}
//default settings
$meta_arr = ism_return_arr_val( 'wd' );
?>
<div class="metabox-holder indeed">

	<div id="social-set"></div>
    <form method="post" action="">
	<div class="stuffbox">
		<div class="ism-top-message"><b>"Website Display"</b> will help you to show Social Share Icons on the entire website with a Custom position, Floating or not and just for a certain type of Pages.</div>
	</div>
	<?php 
		//sm checkboxes
		ism_print_list_checkboxes($meta_arr, 'wd', 'wd_submit_bttn');
	?>
        
        <?php
			//STANDARD TEMPLATES
        	ism_return_standard_templates_html( 'wd_template', $meta_arr['wd_template'], 'wd_submit_bttn' );
        
        	//SPECIAL TEMPLATES
        	ism_return_special_templates_html( 'wd_template', $meta_arr['wd_template'], 'wd_submit_bttn' );
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
                                    $checked = ism_checkSelected('vertical', $meta_arr['wd_list_align'], 'radio');
                                ?>
                                <input type="radio" name="wd_list_align" value="vertical" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Vertical</span>
                                <?php
                                    $checked = ism_checkSelected('horizontal', $meta_arr['wd_list_align'], 'radio');
                                ?>
                                <input type="radio" name="wd_list_align" value="horizontal" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Horizontal</span>
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
                            	<select name="wd_animation">
                            	<?php 
                            		$a_arr = ism_return_special_effects();
	                            	foreach($a_arr as $k=>$v){
	                            		?>
	                            		<optgroup label="<?php echo $k;?>">
	                            			<?php 
	                            				foreach($v as $key=>$value){
	                            					$selected = '';
	                            					if($meta_arr['wd_animation']==$key) $selected = 'selected="selected"';
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
                                <?php
                                    $checked = ism_checkSelected('true', $meta_arr['wd_display_counts'], 'checkbox');
                                ?>
                                <label>
                                	<input type="checkbox" class="ism-switch" onClick="ism_check_and_h(this, '#display_counts');" <?php echo $checked;?> />
                                	<div class="switch" style="display:inline-block;"></div>
                                </label>
                                <input type="hidden" value="<?php echo $meta_arr['wd_display_counts'];?>" name="wd_display_counts" id="display_counts" />
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                Display Full Name Of Social Network
                            </th>
                            <td>
                                <?php
                                    $checked = ism_checkSelected('true', $meta_arr['wd_display_full_name'], 'checkbox');
                                ?>
                                <label>
                                	<input type="checkbox" onClick="ism_check_and_h(this, '#wd_display_full_name');" class="ism-switch" <?php echo $checked;?> />
                                	<div class="switch" style="display:inline-block;"></div>
                                </label>
                                <input type="hidden" value="<?php echo $meta_arr['wd_display_full_name'];?>" name="wd_display_full_name" id="wd_display_full_name" />
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="wd_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
	<?php
		$info = 'If none of them is not selected, the Social Icons will <strong>not show up</strong> using the "Website Display".';
		return_display_where_html( 'wd', $meta_arr, 'wd_submit_bttn', $info );
	?>
        <div class="stuffbox">
            <h3>
                <label>Position:</label>
            </h3>
            <div class="inside">
                <table class="form-table">
	                <tbody>
                        <tr valign="top">
                            <th scope="row">
                               Floating:
                            </th>
                            <td>
                                <?php $checked = ism_checkSelected($meta_arr['wd_floating'], 'yes', 'radio');?>
                                <input type="radio" name="wd_floating" value="yes" <?php echo $checked;?> /><span class="indeedcrlabel">Yes</span>
                                <?php $checked = ism_checkSelected($meta_arr['wd_floating'], 'no', 'radio');?>
                                <input type="radio" name="wd_floating" value="no" <?php echo $checked;?> /><span class="indeedcrlabel">No</span>
								<span class="ism-info" style="display:inline-block; font-style:italic;">The Social Icons will stay all the time on the screen despite the scroll position</span>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">
                                Position
								<span class="ism-info">Set the Box's icons position. Can be used positive or negative values.</span>
                            </th>
                            <td>
                               <table>
                                  <tr>
                                          <?php $checked = ism_checkSelected($meta_arr['wd_top_bottom'], 'top', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="wd_top_bottom" value="top" <?php echo $checked;?>/><span class="indeedcrlabel">Top</span></td>
                                          <?php $checked = ism_checkSelected($meta_arr['wd_top_bottom'], 'bottom', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="wd_top_bottom" value="bottom" <?php echo $checked;?>/><span class="indeedcrlabel">Bottom</span></td>
                                  </tr>
								  <tr style="height:40px; vertical-align:top;">    
									  <td class="indeed_td_np"><input type="number" value="<?php echo $meta_arr['wd_top_bottom_value'];?>" name="wd_top_bottom_value" class="indeed_number" style="margin-top:4px;"/></td>
                                          <?php $checked = ism_checkSelected($meta_arr['wd_top_bottom_type'], '%', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="wd_top_bottom_type" value="%" <?php echo $checked;?>  style="margin-left:20px;"/><span class="indeedcrlabel" style="margin-right:3px;">% | </span>
                                          <?php $checked = ism_checkSelected($meta_arr['wd_top_bottom_type'], 'px', 'radio');?>
                                      <input type="radio" class="" name="wd_top_bottom_type" value="px" <?php echo $checked;?>/><span class="indeedcrlabel">px</span></td>
                                  </tr>
                                  <tr>
                                          <?php $checked = ism_checkSelected($meta_arr['wd_left_right'], 'left', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="wd_left_right" value="left" <?php echo $checked;?>/><span class="indeedcrlabel">Left</span></td>
                                          <?php $checked = ism_checkSelected($meta_arr['wd_left_right'], 'right', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="wd_left_right" value="right" <?php echo $checked;?>/><span class="indeedcrlabel">Right</span></td>
                                  </tr>
								  <tr>
									  <td class="indeed_td_np"><input type="number" value="<?php echo $meta_arr['wd_left_right_value'];?>" name="wd_left_right_value" class="indeed_number" style="margin-top:4px;"/></td>
                                          <?php $checked = ism_checkSelected($meta_arr['wd_left_right_type'], '%', 'radio');?>
                                      <td class="indeed_td_np"><input type="radio" class="" name="wd_left_right_type" value="%" <?php echo $checked;?>  style="margin-left:20px;"/><span class="indeedcrlabel" style="margin-right:3px;">% | </span>
                                          <?php $checked = ism_checkSelected($meta_arr['wd_left_right_type'], 'px', 'radio');?>
                                      <input type="radio" class="" name="wd_left_right_type" value="px" <?php echo $checked;?>/><span class="indeedcrlabel">px</span></td>
                                  </tr>
                               </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="wd_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        
       <?php 
       		//total counts metabox
       		echo total_share_count_admin_box( 'wd', $meta_arr );

       		//visits
       		ism_return_views_section( 'wd', $meta_arr, 'wd_submit_bttn' );
       		
       		//after show 
       		ism_after_share_html( 'wd', $meta_arr, 'wd_submit_bttn' );
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
    	                				if(isset($meta_arr['wd_disable_mobile']) && $meta_arr['wd_disable_mobile']==1) $checked = 'checked="checked"';
    	                			?>
    	                			<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#wd_disable_mobile');" <?php echo $checked;?> />
    	                		<div class="switch" style="display:inline-block;"></div>
    	                		</label>
    	                		<input type="hidden" value="<?php echo $meta_arr['wd_disable_mobile'];?>" name="wd_disable_mobile" id="wd_disable_mobile" />                     
                            </td>
                        </tr>
                     </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="wd_submit_bttn" class="button button-primary button-large" />
                </div>            
            </div>
       </div>
    </form>
</div>
</div>