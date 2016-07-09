<?php
if(isset($_REQUEST['s_in_submit_bttn'])){
	ism_return_arr_update( 's_in' );
}
//default settings
$meta_arr = ism_return_arr_val( 's_in' );		
?>
		<div class="metabox-holder indeed">
			<form method="post" action="">
			<div class="stuffbox">
				<div class="ism-top-message"><b>"Slide-In Display"</b> will help you to show Social Share Icons on the entire website into a Slide Box that will show up based on a predefined Action (on Load, Scroll Position) and on a Custom Position. The "Slide Box" may show up for a certain type of Pages.</div>
			</div>
		<?php 
			//sm checkboxes
			ism_print_list_checkboxes($meta_arr, 's_in', 's_in_submit_bttn');
			//STANDARD TEMPLATES
        	ism_return_standard_templates_html( 's_in_template', $meta_arr['s_in_template'], 's_in_submit_bttn' );
        
        	//SPECIAL TEMPLATES
        	ism_return_special_templates_html( 's_in_template', $meta_arr['s_in_template'], 's_in_submit_bttn' );
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
		                                    $checked = ism_checkSelected('vertical', $meta_arr['s_in_list_align'], 'radio');
		                                ?>
		                                <input type="radio" name="s_in_list_align" value="vertical" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Vertical</span>
		                                <?php
		                                    $checked = ism_checkSelected('horizontal', $meta_arr['s_in_list_align'], 'radio');
		                                ?>
		                                <input type="radio" name="s_in_list_align" value="horizontal" <?php echo $checked;?> class="" /><span class="indeedcrlabel">Horizontal</span>
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
		                                    $checked = ism_checkSelected('true', $meta_arr['s_in_display_counts'], 'checkbox');
		                                ?>
		                                <label>
		                                	<input type="checkbox" class="ism-switch" onClick="ism_check_and_h(this, '#s_in_display_counts');" <?php echo $checked;?> />
		                                	<div class="switch" style="display:inline-block;"></div>
		                                </label>
		                                <input type="hidden" value="<?php echo $meta_arr['s_in_display_counts'];?>" name="s_in_display_counts" id="s_in_display_counts" />
		                            </td>
		                        </tr>
		                        <tr valign="top">
		                            <th scope="row">
		                                Display Full Name Of Social Network
		                            </th>
		                            <td>
		                                <?php
		                                    $checked = ism_checkSelected('true', $meta_arr['s_in_display_full_name'], 'checkbox');
		                                ?>
		                                <label>
		                                	<input type="checkbox" onClick="ism_check_and_h(this, '#s_in_display_full_name');" class="ism-switch" <?php echo $checked;?> />
		                                	<div class="switch" style="display:inline-block;"></div>
		                                </label>
		                                <input type="hidden" value="<?php echo $meta_arr['s_in_display_full_name'];?>" name="s_in_display_full_name" id="s_in_display_full_name" />
		                            </td>
		                        </tr>
								<tr valign="top">
									<th scope="row">
									   Number of Columns
									</th>
									<td>
										<select name="s_in_no_cols" style="min-width:150px;">
										<?php 
											for($ic = 0; $ic < 7; $ic++){
												if($ic == 0) $label = 'Default';
												else $label = $ic.' Columns';
												$selected = '';
												if($meta_arr['s_in_no_cols']== $ic) $selected = 'selected="selected"';
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
										<select name="s_in_box_align" style="min-width:150px;">
											<?php $selected = ism_checkSelected('left', $meta_arr[ 's_in_box_align' ], 'select'); ?>
											<option value="left" <?php echo $selected;?> >Left</option>
											<?php $selected = ism_checkSelected('center', $meta_arr[ 's_in_box_align' ], 'select'); ?>
											<option value="center" <?php echo $selected;?> >Center</option>
											<?php $selected = ism_checkSelected('right', $meta_arr[ 's_in_box_align' ], 'select'); ?>
											<option value="right" <?php echo $selected;?> >Right</option>	
										</select>
									</td>
								</tr>
		                    </tbody>
		                </table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="s_in_submit_bttn" class="button button-primary button-large" />
		                </div>
		            </div>
		        </div>				
	           	
	           	
				<?php 
					//where to display
					$info = 'If none of them is not selected, the Social Icons will <strong>not show up</strong> using the "Slide In Display".';
					return_display_where_html( 's_in', $meta_arr, 's_in_submit_bttn', $info );				
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
		                                  <tr>
		                                          <?php $checked = ism_checkSelected($meta_arr['s_in_top_bottom'], 'top', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="s_in_top_bottom" value="top" <?php echo $checked;?>/><span class="indeedcrlabel">Top</span></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['s_in_top_bottom'], 'bottom', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="s_in_top_bottom" value="bottom" <?php echo $checked;?>/><span class="indeedcrlabel">Bottom</span></td>
		                                  </tr>
										  <tr style="height:40px; vertical-align:top;">    
											  <td class="indeed_td_np"><input type="number" value="<?php echo $meta_arr['s_in_top_bottom_value'];?>" name="s_in_top_bottom_value" class="indeed_number" style="margin-top:4px;"/></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['s_in_top_bottom_type'], '%', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="s_in_top_bottom_type" value="%" <?php echo $checked;?>  style="margin-left:20px;"/><span class="indeedcrlabel" style="margin-right:3px;">% | </span>
		                                          <?php $checked = ism_checkSelected($meta_arr['s_in_top_bottom_type'], 'px', 'radio');?>
		                                      <input type="radio" class="" name="s_in_top_bottom_type" value="px" <?php echo $checked;?>/><span class="indeedcrlabel">px</span></td>
		                                  </tr>
		                                  <tr>
		                                          <?php $checked = ism_checkSelected($meta_arr['s_in_left_right'], 'left', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="s_in_left_right" value="left" <?php echo $checked;?>/><span class="indeedcrlabel">Left</span></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['s_in_left_right'], 'right', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="s_in_left_right" value="right" <?php echo $checked;?>/><span class="indeedcrlabel">Right</span></td>
		                                  </tr>
										  <tr>
											  <td class="indeed_td_np"><input type="number" value="<?php echo $meta_arr['s_in_left_right_value'];?>" name="s_in_left_right_value" class="indeed_number" style="margin-top:4px;"/></td>
		                                          <?php $checked = ism_checkSelected($meta_arr['s_in_left_right_type'], '%', 'radio');?>
		                                      <td class="indeed_td_np"><input type="radio" class="" name="s_in_left_right_type" value="%" <?php echo $checked;?>  style="margin-left:20px;"/><span class="indeedcrlabel" style="margin-right:3px;">% | </span>
		                                          <?php $checked = ism_checkSelected($meta_arr['s_in_left_right_type'], 'px', 'radio');?>
		                                      <input type="radio" class="" name="s_in_left_right_type" value="px" <?php echo $checked;?>/><span class="indeedcrlabel">px</span></td>
		                                  </tr>
		                               </table>
		                            </td>
		                        </tr>
		                        <tr valign="top">
		                            <th scope="row">
		                                Width
		                            </th>
		                            <td>
		                            	<input type="number" value="<?php echo $meta_arr['s_in_width'];?>" name="s_in_width" min="1" /> px
		                            </td>
		                        </tr>
		                        <tr valign="top">
		                            <th scope="row">
		                                Padding
		                            </th>
		                            <td>
		                            	<input type="number" value="<?php echo $meta_arr['s_in_padding'];?>" name="s_in_padding" min="0" /> px
		                            </td>
		                        </tr>		                        
		                    </tbody>
		                </table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="s_in_submit_bttn" class="button button-primary button-large" />
		                </div>
		            </div>
		        </div>	
		        
		        <div class="stuffbox">
		            <h3>
		                <label>How To Slide:</label>
		            </h3>
		            <div class="inside">
		                <table class="form-table">
			                <tbody>
		                        <tr valign="top">
		                            <td>
		                            	<select name="s_in_slide_type" style="min-width:250px;">
		                            		<?php 
		                            			$slide_arr = array( 'down'=>'Slide From Bottom', 
		                            								'up'=>'Slide From Top', 
		                            								'left'=>'Slide From Left', 
		                            								'right'=>'Slide From Right' );
		                            			foreach($slide_arr as $k=>$v){
		                            				$selected = '';
		                            				if($k==$meta_arr['s_in_slide_type']) $selected = 'selected="selected"';
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
		                    <input type="submit" value="Save changes" name="s_in_submit_bttn" class="button button-primary button-large" />
		                </div>
		            </div>
		        </div>		
		        
		        <div class="stuffbox">
		            <h3>
		                <label>How to Show Up:</label>
		            </h3>
		            <div class="inside">
		                <table class="form-table">
			                <tbody>
		                        <tr valign="top">
		                            <td>
									 <label>When:</label>
		                            	<select name="s_in_show_up"  style="min-width:250px;">
		                            		<?php 
		                            			$slide_arr = array( 'on_load'=>'On Load', 
		                            								'scroll_top'=>'Scroll Top', 
		                            								'scroll_middle'=>'Scroll Middle', 
		                            								'scroll_bottom'=>'Scroll Bottom' );
		                            			foreach($slide_arr as $k=>$v){
		                            				$selected = '';
		                            				if($k==$meta_arr['s_in_show_up']) $selected = 'selected="selected"';
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
		                        			if(isset($meta_arr['s_in_show_once']) && $meta_arr['s_in_show_once']==1) $checked='checked="checked"';
		                        		?>
		                        		<input type="checkbox" onClick="check_and_h(this, '#s_in_show_once');" <?php echo $checked;?> />
		                        		<input type="hidden" value="<?php echo $meta_arr['s_in_show_once']?>" name="s_in_show_once" id="s_in_show_once" />

		                        	Show Slide Only One Time Per Page. (Available only for Scroll Event!)</td>
		                        </tr>
		                    </tbody>
		                </table>			
		        
		            	<div style="padding-top: 30px;">
						 <span style="width: 120px;display: block;float: left; font-weight:bold;"><label>Delay:</label></span>
		            		<input type="number" value="<?php echo $meta_arr['s_in_delay'];?>" name="s_in_delay" min="0" style="width: 60px;"/> <b>s</b>
		            	</div>
		                <div class="clear"></div>      
		        
		            	<div style="padding-top: 10px;">
						 <span style="width: 120px;display: block;float: left; font-weight:bold;"><label>Autoclose after:</label></span>
		            		<input type="number" value="<?php echo $meta_arr['s_in_slide_duration'];?>" name="s_in_slide_duration" min="0" style="width: 60px;"/> <b>s</b>
		            	</div>
		                <div class="clear"></div>
		                
			            <div class="submit">
			            	<input type="submit" value="Save changes" name="s_in_submit_bttn" class="button button-primary button-large" />
			            </div>			                
		            </div>		            
		        </div>					

		        <div class="stuffbox">
		            <h3>
		                <label>Custom CSS:</label>
		            </h3>
		            <div class="inside">
		            	<div style="padding-top: 10px;">
		            		<textarea name="s_in_custom_css" style="width: 100%;height: 150px;"><?php echo $meta_arr['s_in_custom_css'];?></textarea>
		            	</div>
		                
			            <div class="submit">
			            	<input type="submit" value="Save changes" name="s_in_submit_bttn" class="button button-primary button-large" />
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
		                            	<input type="text" name="s_in_title" value="<?php echo $meta_arr['s_in_title'];?>" />
									</td>
								</tr>			                
		                        <tr valign="top">
		                            <th scope="row">
		                               Above Content
		                            </th>
		                            <td>
		                            	<?php 
		                            		$settings = array( 'textarea_name' => 's_in_above_content', 'textarea_rows' => 4 );
		                            		wp_editor( stripslashes($meta_arr['s_in_above_content']), 's_in_above_content_id', $settings ); 
		                            	?> 
									</td>
								</tr>
		                        <tr valign="top">
		                            <th scope="row">
		                               Bellow Content
		                            </th>
		                            <td>
		                            	<?php 
		                            		$settings = array( 'textarea_name' => 's_in_bellow_content', 'textarea_rows' => 4 );
		                            		wp_editor( stripslashes($meta_arr['s_in_bellow_content']), 's_in_bellow_content_id', $settings ); 
		                            	?> 		                            
									</td>
								</tr>								
							</tbody>
						</table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="s_in_submit_bttn" class="button button-primary button-large" />
		                </div>						
					</div>
				</div>		    
				                        		        
				<?php 
					//total counts metabox
					echo total_share_count_admin_box( 's_in', $meta_arr );
					
					//visits
					ism_return_views_section( 's_in', $meta_arr, 's_in_submit_bttn' );
					
					//after show
					ism_after_share_html( 's_in', $meta_arr, 's_in_submit_bttn' );
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
		    	                				if(isset($meta_arr['s_in_disable_mobile']) && $meta_arr['s_in_disable_mobile']==1) $checked = 'checked="checked"';
		    	                			?>
		    	                			<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#s_in_disable_mobile');" <?php echo $checked;?> />
		    	                		<div class="switch" style="display:inline-block;"></div>
		    	                		</label>
		    	                		<input type="hidden" value="<?php echo $meta_arr['s_in_disable_mobile'];?>" name="s_in_disable_mobile" id="s_in_disable_mobile" />                     
		                            </td>
		                        </tr>
		                     </tbody>
		                </table>
		                <div class="submit">
		                    <input type="submit" value="Save changes" name="s_in_submit_bttn" class="button button-primary button-large" />
		                </div>            
		            </div>
		       </div>		                        	                  	
			</form>
		</div>	
	</div>