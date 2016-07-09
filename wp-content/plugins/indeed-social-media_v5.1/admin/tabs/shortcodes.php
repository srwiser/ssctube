    <div class="metabox-holder indeed">
              <div class="shortcode_wrapp">
                      <div class="content_shortcode">
                          <div>
                              <span style="font-weight:bolder; color: #333; font-style:italic; font-size:11px;">ShortCode : </span>
                              <span class="the_shortcode"></span>
                          </div>
                          <div style="margin-top:10px;">
                              <span style="font-weight:bolder; color: #333; font-style:italic; font-size:11px;">PHP Code:</span>
                              <span class="php_code"></span>
                          </div>
                      </div>
              </div>
        <form method="post" action="">
        	<?php 
        		ism_print_list_checkboxes_shortcode($type);

        	?>
			
            <div class="stuffbox">
                <h3>
                    <label>Standard Templates:</label>
                </h3>
                <div class="inside" style="vertical-align: top;">
                    <table class="form-table">
	           	        <tbody>
                            <tr valign="top">
                                <th scope="row">
                                    Select a Template:
                                </th>
                                <td>
                                    <select id="template_1" onChange="ism_preview_templates_be('#ism_preview_1', '#ism_preview_2', '#template_2', '#template_1', '');ism_shortcode_update('<?php echo $type;?>');" class="ism_select_admin_section">
                                    	<option value="0">...</option>
                                    <?php
                                    	 $t_arr = ism_return_standard_templates_arr();
                                         foreach($t_arr as $key=>$value){
                                         	 $selected = '';
                                         	 if($key=='ism_template_1') $selected = 'selected="selected"';
                                             ?>
                                                <option value="<?php echo $key;?>" <?php echo $selected;?> ><?php echo $value;?></option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                                </td>
                            </tr>
							</tbody>
						</table>
						<script>
							jQuery(document).ready(function(){
								ism_preview_templates_be('#ism_preview_1', '#ism_preview_2', '#template_2', '#template_1', '');
								ism_shortcode_update('<?php echo $type;?>');
							});
						</script>
						<div style="display:inline-block;">
							<div id="ism_preview_1" style="display: inline-block;padding: 5px 0px;"></div>
							<span class="ism-info">Some of the templates are recommended for <strong>Vertical</strong> Align (like template 9) and others for <strong>Horizontal</strong> Align (like template 5). <strong>Check the Hover Effects!</strong></span>
						</div>

                </div>                
            </div>	

<?php 
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
                            	<select id="template_2" onChange="ism_preview_templates_be('#ism_preview_2', '#ism_preview_1', '#template_1', '#template_2', '');ism_shortcode_update('<?php echo $type;?>');" class="ism_select_admin_section">
                                	<option value="0">...</option>
                                    <?php
	                                    if(count($templates)>0){
	                                         foreach($templates as $key=>$value){
	                                             ?>
	                                                <option value="<?php echo $key;?>"><?php echo $value;?></option>
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

                </div>                
            </div>    			
			
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
                                    <input type="radio" value="vertical" onClick="jQuery('#list_align_type').val(this.value);ism_shortcode_update('<?php echo $type;?>');" name="list_type_algin" /><span class="indeedcrlabel">Vertical</span>
                                    <input type="radio" value="horizontal" checked="checked" onClick="jQuery('#list_align_type').val(this.value);ism_shortcode_update('<?php echo $type;?>');" name="list_type_algin" /><span class="indeedcrlabel">Horizontal</span>
                                    <input type="hidden" value="horizontal" id="list_align_type" />
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
                                    	<input type="checkbox"  class="ism-switch" id="display_counts" onClick="ism_shortcode_update('<?php echo $type;?>');"/>
										<div class="switch" style="display:inline-block;"></div>
									</label>                                    
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    Display Full Name Of Social Network
                                </th>
                                <td>
                                	<label>
                                    	<input type="checkbox" checked="checked" class="ism-switch" id="display_full_name" onClick="ism_shortcode_update('<?php echo $type;?>');"/>
										<div class="switch" style="display:inline-block;"></div>
									</label>                                      
                                </td>
                            </tr>
					<?php 
                	if($type=='shortcode'){
                		?>		
							<tr valign="top">
									<th scope="row">
									   Number of Columns
									</th>
									<td>
										<select id="no_cols" style="min-width:150px;" onClick="ism_shortcode_update('<?php echo $type;?>');">
										<?php 
											for($ic = 0; $ic < 7; $ic++){
												if($ic == 0) $label = 'Default';
												else $label = $ic.' Columns';
												
												?>
												<option value="<?php echo $ic;?>"><?php echo $label;?></option>
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
										<select id="box_align" style="min-width:150px;" onClick="ism_shortcode_update('<?php echo $type;?>');">
											<option value="left" >Left</option>
											<option value="center" >Center</option>
											<option value="right" >Right</option>	
										</select>
									</td>
								</tr>
					  <?php 
                	}         
				?>			
                        </tbody>
                    </table>
                </div>
            </div>
            

            
    <?php
        if($type=='shortcode'){
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
							<label>
		                      	<input type="checkbox" id="print_total_shares" onClick="ism_shortcode_update('shortcode');ism_preview_templates_be();" class="ism-switch" />
		                       	<div class="switch" style="display:inline-block;"></div>
		                    </label>   	            		            		
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
		            		<select id="tc_position" onChange="ism_shortcode_update('shortcode');ism_preview_templates_be();" >
		            			<option value="before">Before Social Network Icons</option>
		            			<option value="after">After Social Network Icons</option>
		            		</select>
		            	</td>
		            </tr>
		            <tr valign="top">
		            	<td>
		            		Show Label:
		            	</td>
		            	<td>
	                       	<label>
	                           	<input type="checkbox" id="display_tc_label" onClick="ism_shortcode_update('shortcode');ism_preview_templates_be();" class="ism-switch" />
	                           	<div class="switch" style="display:inline-block;"></div>
	                        </label>          			
		            	</td>
		            </tr>		            
		            <tr valign="top">
		            	<td>
		            		Show SubLabel:
		            	</td>
		            	<td>
	                       	<label>
	                           	<input type="checkbox" id="display_tc_sublabel" onClick="ism_shortcode_update('shortcode');ism_preview_templates_be();" class="ism-switch" />
	                           	<div class="switch" style="display:inline-block;"></div>
	                        </label>          			
		            	</td>
		            </tr>
		            <tr valign="top">
		            	<td>
		            		Color Theme:
		            	</td>
		            	<td>
		            		<select onChange="ism_shortcode_update('shortcode');ism_preview_templates_be();" id="tc_theme" >
		            			<option value="light">Light</option>
		            			<option value="dark" selected="selected">Dark</option>
		            		</select>	            			
		            	</td>
		         	</tr>	            	
		         </table>     	
            </div>        
        </div>            
      
      	<?php               	
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
		                        <input type="checkbox" onClick="ism_shortcode_update('shortcode');" class="ism-switch" id="ivc_display_views"/>
		                        <div class="switch" style="display:inline-block;"></div>
		                    </label>                       
                       </td>
					</tr>
 	               <tr valign="top">
    	               <th scope="row">
        	               Position:
                       </th>
                       <td>
							<select id="ivc_position" onChange="ism_shortcode_update('shortcode');">
								<option value="before">Before Social Network Icons</option>
								<option value="after">After Social Network Icons</option>
							</select>
                       </td>
				   </tr>
 	               <tr valign="top">
    	               <th scope="row">
        	               SubLabel:
                       </th>
                       <td>
	            			<label>
		                        <input type="checkbox" onClick="ism_shortcode_update('shortcode');" class="ism-switch" id="ivc_sublable_on" />
		                        <div class="switch" style="display:inline-block;"></div>
		                    </label> 							
                       </td>
					</tr>	
					<tr valign="top">
    	               <th scope="row">
        	               Theme:
                       </th>
                       <td>
							<select id="ivc_theme" onChange="ism_shortcode_update('shortcode');">
								<option value="light">Light</option>
								<option value="dark">Dark</option>
							</select>
                       </td>
				   </tr>										
				</table>
			</div>					
		</div>
 
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
		                    	<input type="checkbox" onClick="ism_shortcode_update('shortcode');" id="after_share_enable" class="ism-switch" />
		                        <div class="switch" style="display:inline-block;"></div>
		                    </label>
						</td>
                    </tr>
                    <tr valign="top">
                    	<th scope="row">Title:</th>
                    	<td>
                    		<input type="text" id="after_share_title" value="" onKeyup="ism_shortcode_update('shortcode');" />
                    	</td>
                    </tr>
                    <tr valign="top">
                    	<th scope="row">Content:</th>
                    	<td>
                    		<?php 
            					$options = array('textarea_name'=> 'after_share_content', 'textarea_rows' => 5 );
            					wp_editor('', 'after_share_content', $options);
            				?>            				
                    	</td>						
                    </tr>
                    <tr>
                    	<td>
                    		<div onClick="updateFromWPEditor('after_share_content');" id="ism_update_textarea_bttn" style="max-width: 70px;font-size: 12px;display: none;" class="button button-primary button-large">Update</div>
                    	</td>
                    	<td></td>
                    </tr>
                </table>     
                <script>
					jQuery('#after_share_content').keyup(function(){
						ism_shortcode_update('shortcode');
					});
                </script>       	
            </div>
        </div>
        
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
    	                			<input type="checkbox" class="ism-switch" id="disable_mobile" onClick="ism_shortcode_update('shortcode');"/>
    	                			<div class="switch" style="display:inline-block;"></div>
								</label>            
                            </td>
                        </tr>
                     </tbody>
                </table>         
            </div>
       </div>         	
        	<?php 
        }
    ?>
               
    <?php
        if($type=='shortcode_locker'){
        ?>
            <div class="stuffbox">
                <h3>
                    <label>Locker Display:</label>
                </h3>
                <div class="inside">
                    <table class="form-table" style="margin-bottom: 0px;">
    	                <tbody>
    	                	<tr>
    	                		<th>Theme:</th>
    	                		<td>
    	                		<?php 
    	                			$templates = array(1=>'Default', 2=>'Basic', 3=>'Zipped', 4=>'Zone', 5=>'Majic Transparent', 6=>'Star', 7=>'Clouddy', 8=>'Darks');
    	                		?>
    	                			<select id="locker_template" onChange="ism_shortcode_update('<?php echo $type;?>');ism_disable_style_table(this.value);" style="min-width:225px;">
										<?php 
											foreach($templates as $k=>$v){
												$selected = '';
												if($k==2)$selected= "selected='selected'";
												?>
													<option value="<?php echo $k;?>" <?php echo $selected;?>><?php echo $v;?></option>
												<?php 	
											}
										?>    	                			
    	                			</select>
    	                		</td>
    	                	</tr>
                        </tbody>
                    </table>
                    
                    <table class="form-table" style="margin-bottom: 0px;">
    	                <tbody>
    	                	<tr>
    	                		<th>Delay Time:</th>
    	                		<td>
    	                			<label><input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#enable_timeout_lk');ism_shortcode_update('<?php echo $type;?>');ism_enable_disable_c(this, '#ism_timeout_locker');" />
    	                			<div class="switch" style="display:inline-block;"></div></label>
    	                			<input type="hidden" value="0" id="enable_timeout_lk" />
									<input type="number" disabled="disabled" onChange="ism_shortcode_update('<?php echo $type;?>');" id="ism_timeout_locker" min="1" value="30" style="width: 60px;"/> sec(s)
    	                		</td>
    	                	</tr>
                        </tbody>
                    </table>
                    
                    <table class="form-table" style="margin-bottom: 0px;">
    	                <tbody>
    	                	<tr>
    	                		<th>Disable Locker For Registered Users</th>
    	                		<td>
    	                			<label><input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#not_registered_u');ism_shortcode_update('<?php echo $type;?>');" /><div class="switch" style="display:inline-block;"></div></label>
    	                			<input type="hidden" id="not_registered_u" value="0" />
    	                		</td>
    	                	</tr>
    	                </tbody>
    	            </table>
    	            
                    <table class="form-table" style="margin-bottom: 0px;">
    	                <tbody>
    	                	<tr>
    	                		<th>Reset Locker After: </th>
    	                		<td>
    	                			<label><input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#reset_locker');ism_shortcode_update('<?php echo $type;?>');ism_enable_disable_c(this, '#locker_reset_after');" /><div class="switch" style="display:inline-block;"></div></label>
    	                			<input type="hidden" id="reset_locker" value="0" />
    	                			<input type="number" min="1" disabled="disabled" value="30" id="locker_reset_after" onChange="check_and_h(this, '#not_registered_u');ism_shortcode_update('<?php echo $type;?>');" style="width: 60px; height:28px;"/>
    	                			<select id="locker_reset_type" onChange="onClick="check_and_h(this, '#not_registered_u');ism_shortcode_update('<?php echo $type;?>');">
    	                				<option value="minutes">Minutes</option>
    	                				<option value="hours">Hours</option>
    	                				<option value="days" selected="selected">Days</option>
    	                			</select>
    	                		</td>
    	                	</tr>
    	                </tbody>
    	            </table>
                        	   
                    <table class="form-table" style="margin-bottom: 0px;">
    	                <tbody>
    	                	<tr>
    	                		<th>Overlock: </th>
    	                		<td>
    	                			<select id="ism_overlock" onChange="ism_shortcode_update('<?php echo $type;?>');" style="min-width:225px;">
    	                				<option value="default">Default</option>
    	                				<option value="opacity">Opacity</option>
    	                			</select>
    	                		</td>
    	                	</tr>
    	                </tbody>
    	            </table>
                     <hr/>   	                	
                    <table class="form-table" style="margin-bottom: 0px;margin-top:10px; display:none;" id="ism_shortcode_style-table">
    	                <tbody>   	       
                            <tr>
                                <th scope="row" style="padding-bottom:5px !important;">
                                    Background-Color:
                                </th>
                                <td style="padding-bottom:5px !important;">
                                   <input type="text" id="locker_background" style="width: 75px;"/>
									<span class="ism-info" style="display:inline-block; font-style:italic; padding-left:10px;">Use the ColorPicker to set your Background color.</span>
                                    <script>
                                		jQuery('#locker_background').ColorPicker({
                                		    onChange: function (hsb, hex, rgb) {
                                			    jQuery('#locker_background').val('#' + hex);
                                                ism_shortcode_update('<?php echo $type;?>');
                                			}
                                		});
                                    </script>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" style="padding-top: 5px !important;padding-bottom:5px !important;">
                                    Padding:
									<span class="ism-info">General Padding for the Locker Box can be set.</span>
                                </th>
                                <td style="padding-top: 5px !important;padding-bottom:5px !important;">
                                    <input type="number" value="50" id="locker_padding" onClick="ism_shortcode_update('<?php echo $type;?>');" class="indeed_number"/> px
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="form-table" style="margin-bottom: 0px;min-width: 650px;">
    	                <tbody>
                            <tr>
                                <td>
                                    <?php
                                        $settings = array( 'textarea_rows' => 6 );
                                        $textarea_content = '<h2>This content is locked</h2><p>Share This Page To Unlock The Content!</p>';
                                        wp_editor( $textarea_content, 'display_text', $settings );
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div onClick="updateTextarea();" id="ism_update_textarea_bttn" style="max-width: 70px;font-size: 12px;display: none;" class="button button-primary button-large">Update</div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
					<span class="ism-info">This message will show up above the share buttons to unlock the content.</span>
					<br/>
                </div>
            </div>

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
		    	                			<input type="checkbox" class="ism-switch" id="disable_mobile" onClick="ism_shortcode_update('<?php echo $type;?>');" />
		    	                			<div class="switch" style="display:inline-block;"></div>
		    	                		</label>                     
		                            </td>
		                        </tr>
		                     </tbody>
		                </table>
		                <div style="margin-top: 30px;font-size: 16px; font-weight: 700;">Twitter Options</div>
		                <table class="form-table">
		                        <tr valign="top">
		                            <th scope="row">
		                              Hide On Mobile:
		                            </th>
		                            <td>
		    	                		<label>
		    	                			<input type="checkbox" class="ism-switch" id="twitter_hide_mobile" onClick="ism_shortcode_update('<?php echo $type;?>');" />
		    	                			<div class="switch" style="display:inline-block;"></div>
		    	                		</label>                     
		                            </td>
		                        </tr>
		                        <tr valign="top">
		                            <th scope="row">
		                              Unlock On Click:
		                            </th>
		                            <td>
		    	                		<label>
		    	                			<input type="checkbox" class="ism-switch" id="twitter_unlock_onclick" onClick="ism_shortcode_update('<?php echo $type;?>');" />
		    	                			<div class="switch" style="display:inline-block;"></div>
		    	                		</label>                     
		                            </td>
		                        </tr>
		                </table>		                		                          
		            </div>
		       </div>     
	               
            <div class="stuffbox">
                <h3>
                    <label>Preview:</label>
                </h3>
                <div class="inside">
                	<div id="ISM_preview_shortcode" style="padding: 20px 10px;"></div>
                </div>
            </div>
        <?php
        }
	    ?>
        </form>
    </div>
              <div class="shortcode_wrapp">
                      <div class="content_shortcode">
                          <div>
                              <span style="font-weight:bolder; color: #333; font-style:italic; font-size:11px;">ShortCode : </span>
                              <span class="the_shortcode"></span>
                          </div>
                          <div style="margin-top:10px;">
                              <span style="font-weight:bolder; color: #333; font-style:italic; font-size:11px;">PHP Code:</span>
                              <span class="php_code"></span>
                          </div>
                      </div>
              </div>
    <script>
        jQuery(document).ready(function(){
            ism_shortcode_update('<?php echo $type;?>');
        });
    </script>
</div>    