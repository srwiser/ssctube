<?php
if(isset($_REQUEST['popup_submit_bttn'])){
	ism_return_arr_update( 'popup' );
}
//default settings
$meta_arr = ism_return_arr_val( 'popup' );		
?>		
<div class="metabox-holder indeed">
	<form method="post" action="">
		<?php 
			//sm checkboxes
			ism_print_list_checkboxes($meta_arr, 'popup', 'popup_submit_bttn');

			//STANDARD TEMPLATES
        	ism_return_standard_templates_html( 'popup_template', $meta_arr['popup_template'], 'popup_submit_bttn' );
        
        	//SPECIAL TEMPLATES
        	ism_return_special_templates_html( 'popup_template', $meta_arr['popup_template'], 'popup_submit_bttn' );
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
		                                    $checked = ism_checkSelected('vertical', $meta_arr['popup_list_align'], 'radio');
		                                ?>
		                                <input type="radio" name="popup_list_align" value="vertical" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Vertical</span>
		                                <?php
		                                    $checked = ism_checkSelected('horizontal', $meta_arr['popup_list_align'], 'radio');
		                                ?>
		                                <input type="radio" name="popup_list_align" value="horizontal" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Horizontal</span>
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
		                                    $checked = ism_checkSelected('true', $meta_arr['popup_display_counts'], 'checkbox');
		                                ?>
		                                <label>
		                                	<input type="checkbox" class="ism-switch" onClick="ism_check_and_h(this, '#popup_display_counts');" <?php echo $checked;?> />
		                                	<div class="switch" style="display:inline-block;"></div>
		                                </label>
		                                <input type="hidden" value="<?php echo $meta_arr['popup_display_counts'];?>" name="popup_display_counts" id="popup_display_counts" />
		                            </td>
		                        </tr>
		                        <tr valign="top">
		                            <th scope="row">
		                                Display Full Name Of Social Network
		                            </th>
		                            <td>
		                                <?php
		                                    $checked = ism_checkSelected('true', $meta_arr['popup_display_full_name'], 'checkbox');
		                                ?>
		                                <label>
		                                	<input type="checkbox" onClick="ism_check_and_h(this, '#popup_display_full_name');" class="ism-switch" <?php echo $checked;?> />
		                                	<div class="switch" style="display:inline-block;"></div>
		                                </label>
		                                <input type="hidden" value="<?php echo $meta_arr['popup_display_full_name'];?>" name="popup_display_full_name" id="popup_display_full_name" />
		                            </td>
		                        </tr>
						<tr valign="top">
                            <th scope="row">
                               Number of Columns
                            </th>
                            <td>
                            	<select name="popup_no_cols" style="min-width:150px;">
								<?php 
									for($ic = 0; $ic < 7; $ic++){
										if($ic == 0) $label = 'Default';
										else $label = $ic.' Columns';
										$selected = '';
	                            		if($meta_arr['popup_no_cols']== $ic) $selected = 'selected="selected"';
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
                            	<select name="popup_box_align" style="min-width:150px;">
									<?php $selected = ism_checkSelected('left', $meta_arr[ 'popup_box_align' ], 'select'); ?>
	            					<option value="left" <?php echo $selected;?> >Left</option>
									<?php $selected = ism_checkSelected('center', $meta_arr[ 'popup_box_align' ], 'select'); ?>
	            					<option value="center" <?php echo $selected;?> >Center</option>
									<?php $selected = ism_checkSelected('right', $meta_arr[ 'popup_box_align' ], 'select'); ?>
	            					<option value="right" <?php echo $selected;?> >Right</option>	
								</select>
                            </td>
                        </tr>
		                    </tbody>
		                </table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="popup_submit_bttn" class="button button-primary button-large" />
		                </div>
		            </div>
		        </div>		
		        
		        
		        <?php 
					//where to display
					$info = 'If none of them is not selected, the Social Icons will <strong>not show up</strong> using the "PopUp Display".';
					return_display_where_html( 'popup', $meta_arr, 'popup_submit_bttn', $info );				
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
		                                Position
										<span class="ism-info">Set the Box's icons position. Can be used positive or negative values.</span>
		                            </th>
		                            <td>
		                               <table>
										  <tr style="height:40px; vertical-align:top;">  
											  <td class="indeed_td_np" colspan="2">Top: <input type="number" value="<?php echo $meta_arr['popup_top_bottom_value'];?>" name="popup_top_bottom_value" class="indeed_number" style="margin-top:4px;"/>
		                                          <?php $checked = ism_checkSelected($meta_arr['popup_top_bottom_type'], '%', 'radio');?>
		                                      <input type="radio" class="" name="popup_top_bottom_type" value="%" <?php echo $checked;?>  style="margin-left:20px;"/><span class="indeedcrlabel" style="margin-right:3px;">% | </span>
		                                          <?php $checked = ism_checkSelected($meta_arr['popup_top_bottom_type'], 'px', 'radio');?>
		                                      <input type="radio" class="" name="popup_top_bottom_type" value="px" <?php echo $checked;?>/><span class="indeedcrlabel">px</span>
		                                      </td>
		                                  </tr>
		                                  <tr>
		                                          <?php $checked = ism_checkSelected($meta_arr['popup_left_right'], 'left', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="popup_left_right" value="left" <?php echo $checked;?>/><span class="indeedcrlabel">Left</span></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['popup_left_right'], 'right', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="popup_left_right" value="right" <?php echo $checked;?>/><span class="indeedcrlabel">Right</span></td>
		                                  </tr>
										  <tr>
											  <td class="indeed_td_np"><input type="number" value="<?php echo $meta_arr['popup_left_right_value'];?>" name="popup_left_right_value" class="indeed_number" style="margin-top:4px;"/></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['popup_left_right_type'], '%', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="popup_left_right_type" value="%" <?php echo $checked;?>  style="margin-left:20px;"/><span class="indeedcrlabel" style="margin-right:3px;">% | </span>
		                                          <?php $checked = ism_checkSelected($meta_arr['popup_left_right_type'], 'px', 'radio');?>
		                                      <input type="radio" class="" name="popup_left_right_type" value="px" <?php echo $checked;?>/><span class="indeedcrlabel">px</span></td>
		                                  </tr>
		                               </table>
		                            </td>
		                        </tr>
								<tr valign="top">
		                            <th scope="row">
		                            </th>
		                            <td>
		                            </td>
		                        </tr>
		                        <tr valign="top">
		                            <th scope="row">
		                                Width
		                            </th>
		                            <td>
		                            	<input type="number" value="<?php echo $meta_arr['popup_width'];?>" name="popup_width" min="1" /> px
		                            </td>
		                        </tr>
		                        <tr valign="top">
		                            <th scope="row">
		                                Height
		                            </th>
		                            <td>
		                            	<input type="number" value="<?php echo $meta_arr['popup_height'];?>" name="popup_height" min="1" /> px
		                            </td>
		                        </tr>
								<tr valign="top">
		                            <th scope="row">
		                            </th>
		                            <td>
		                            </td>
		                        </tr>		                        
		                        <tr valign="top">
		                            <th scope="row">
		                                Padding
		                            </th>
		                            <td>
		                            	<input type="number" value="<?php echo $meta_arr['popup_padding'];?>" name="popup_padding" min="0" /> px
		                            </td>
		                        </tr>		                        
		                    </tbody>
		                </table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="popup_submit_bttn" class="button button-primary button-large" />
		                </div>
		            </div>
		        </div>	
		        
		        <div class="stuffbox">
		            <h3>
		                <label>Show Effect:</label>
		            </h3>
		            <div class="inside">
		                <table class="form-table">
			                <tbody>
		                        <tr valign="top">
		                            <td>
		                            	<select name="popup_show_effect" style="min-width:250px;">
		                            		<?php 
		                            			$slide_arr = array( 
		                            								'bounce' => 'Bounce',
		                            								'clip' => 'Clip',
		                            								'drop' => 'Drop',
		                            								'explode' => 'Explode',
		                            								'fadeIn' => 'Fade In',
		                            								'puff' => 'Puff',
		                            								'pulsate' => 'Pulsate',
		                            								'scale' => 'Scale',
		                            								'shake' => 'Shake',
		                            								'down'=>'Slide From Bottom', 
		                            								'up'=>'Slide From Top', 
		                            								'left'=>'Slide From Left', 
		                            								'right'=>'Slide From Right',
		                            								
		                            							  );
		                            			foreach($slide_arr as $k=>$v){
		                            				$selected = '';
		                            				if($k==$meta_arr['popup_show_effect']) $selected = 'selected="selected"';
		                            				?>
		                            					<option value="<?php echo $k;?>" <?php echo $selected;?> ><?php echo $v;?></option>
		                            				<?php 
		                            			}
		                            		?>
		                            	</select>
		                            </td>
		                        </tr>
		                     </tbody>
		                 </table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="popup_submit_bttn" class="button button-primary button-large" />
		                </div>
		            </div>
		        </div>	
		        
		        <div class="stuffbox">
		            <h3>
		                <label>How To Show Up:</label>
		            </h3>
		            <div class="inside">
		                <table class="form-table">
			                <tbody>
		                        <tr valign="top">
		                            <td>
									<label>When:</label>
		                            	<select name="popup_show_up"  style="min-width:250px;">
		                            		<?php 
		                            			$slide_arr = array( 'on_load'=>'On Load', 
																	'leave'=>'Try to Leave the page', 
		                            								'scroll_top'=>'Scroll Top', 
		                            								'scroll_middle'=>'Scroll Middle', 
		                            								'scroll_bottom'=>'Scroll Bottom' );
		                            			foreach($slide_arr as $k=>$v){
		                            				$selected = '';
		                            				if($k==$meta_arr['popup_show_up']) $selected = 'selected="selected"';
		                            				?>
		                            					<option value="<?php echo $k;?>" <?php echo $selected;?> ><?php echo $v;?></option>
		                            				<?php 
		                            			}
		                            		?>
		                            	</select>		                            
		                            </td>
		                        </tr>
								<tr valign="top">
		                        	<td>
									</td>
		                        </tr>
		                        <tr valign="top">
		                        	<td>
		                        		<?php 
		                        			$checked='';
		                        			if(isset($meta_arr['popup_show_once']) && $meta_arr['popup_show_once']==1) $checked='checked="checked"';
		                        		?>
		                        		<input type="checkbox" onClick="check_and_h(this, '#popup_show_once');" <?php echo $checked;?> />
		                        		<input type="hidden" value="<?php echo $meta_arr['popup_show_once']?>" name="popup_show_once" id="popup_show_once" />

		                        	Show PopUp Only One Time Per Page. (Available only for Scroll Event!)</td>
		                        </tr>
		                    </tbody>
		                </table>
		                

		                <div style="padding-top: 30px;">
						 <span style="width: 120px;display: block;float: left; font-weight:bold;"><label>Delay:</label></span>
		            		<input type="number" value="<?php echo $meta_arr['popup_delay'];?>" name="popup_delay" min="0" style="width: 60px;"/> <b>s</b>
		            	</div>
		                 <div class="clear"></div>      
		        
		            	<div style="padding-top: 10px;">
						 <span style="width: 120px;display: block;float: left; font-weight:bold;"><label>Autoclose after:</label></span>
		            		<input type="number" value="<?php echo $meta_arr['popup_slide_duration'];?>" name="popup_slide_duration" min="0" style="width: 60px;"/> <b>s</b>
		            	</div>
		                <div class="clear"></div>   
						
			            <div class="submit">
			            	<input type="submit" value="Save changes" name="popup_submit_bttn" class="button button-primary button-large" />
			            </div>			                
		            </div>		            
		        </div>	

		        <div class="stuffbox">
		            <h3>
		                <label>Custom CSS:</label>
		            </h3>
		            <div class="inside">
		            	<div style="padding-top: 10px;">
		            		<textarea name="popup_custom_css" style="width: 100%;height: 150px;"><?php echo $meta_arr['popup_custom_css'];?></textarea>
		            	</div>
		                
			            <div class="submit">
			            	<input type="submit" value="Save changes" name="popup_submit_bttn" class="button button-primary button-large" />
			            </div>			                
		            </div>		            
		        </div>		
		        		        		        
		        <div class="stuffbox">
		            <h3>
		                <label>Custom Content:</label>
		            </h3>
		            <div class="inside">
		                <table class="form-table" style="width: 100%;">
			                <tbody>
			                	<tr valign="top">
		                            <th scope="row">
		                               Title
		                            </th>
		                            <td>
		                            	<input type="text" name="popup_title" value="<?php echo $meta_arr['popup_title'];?>" />
									</td>
								</tr>		
		                        <tr valign="top">
		                            <th scope="row">
		                               Above Content
		                            </th>
		                            <td>
		                            	<?php 
		                            		$settings = array( 'textarea_name' => 'popup_above_content', 'textarea_rows' => 4 );
		                            		wp_editor( stripslashes($meta_arr['popup_above_content']), 'popup_above_content', $settings ); 
		                            	?> 
									</td>
								</tr>
		                        <tr valign="top">
		                            <th scope="row">
		                               Bellow Content
		                            </th>
		                            <td>
		                            	<?php 
		                            		$settings = array( 'textarea_name' => 'popup_bellow_content', 'textarea_rows' => 4 );
		                            		wp_editor( stripslashes($meta_arr['popup_bellow_content']), 'popup_bellow_content', $settings ); 
		                            	?> 		                            
									</td>
								</tr>								
							</tbody>
						</table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="popup_submit_bttn" class="button button-primary button-large" />
		                </div>						
					</div>
				</div>		  

				<?php 
					//total counts metabox
					echo total_share_count_admin_box( 'popup', $meta_arr );
					
					//visits
					ism_return_views_section( 'popup', $meta_arr, 'popup_submit_bttn' );
					
					//after show
					ism_after_share_html( 'popup', $meta_arr, 'popup_submit_bttn' );
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
		    	                				if(isset($meta_arr['popup_disable_mobile']) && $meta_arr['popup_disable_mobile']==1) $checked = 'checked="checked"';
		    	                			?>
		    	                			<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#popup_disable_mobile');" <?php echo $checked;?> />
		    	                		<div class="switch" style="display:inline-block;"></div>
		    	                		</label>
		    	                		<input type="hidden" value="<?php echo $meta_arr['popup_disable_mobile'];?>" name="popup_disable_mobile" id="popup_disable_mobile" />                     
		                            </td>
		                        </tr>
		                     </tbody>
		                </table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="popup_submit_bttn" class="button button-primary button-large" />
		                </div>            
		            </div>
		       </div>  	        				      		        	        		        		        			          		           	
	</form>
</div>
</div>