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
			<?php ism_print_list_checkboxes_shortcode('follow');?>

            <div class="stuffbox">
                <h3>
                    <label>Follow Templates:</label>
                </h3>
                <div class="inside" style="vertical-align: top;">
                    <table class="form-table">
	           	        <tbody>
                            <tr valign="top">
                                <th scope="row">
                                    Select a Template:
                                </th>
                                <td>
                                    <select id="template_1" onChange="isf_disabled_rest_templates('#template_1', '#isf_preview_1');" class="ism_select_admin_section">
                                    	<option value="0">...</option>
                                    <?php
                                    	 $t_arr = isf_get_follow_templates();
                                         foreach($t_arr as $key=>$value){
                                         	$selected = '';
                                         	if($key=='ism_template_sf_1') $selected = 'selected="selected"';
                                             ?>
                                                <option value="<?php echo $key;?>" <?php echo $selected;?>><?php echo $value;?></option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                                </td>
                            </tr>
							</tbody>
						</table>
						<div style="display:inline-block;">
							<div id="isf_preview_1" style="display: inline-block;padding: 5px 0px;"></div>
							<span class="ism-info">Some of the templates are recommended for <strong>Vertical</strong> Align (like template 9) and others for <strong>Horizontal</strong> Align (like template 5). <strong>Check the Hover Effects!</strong></span>
						</div>

                </div>                
            </div>		
            
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
                                    <select id="template_2" onChange="isf_disabled_rest_templates('#template_2', '#isf_preview_2');" class="ism_select_admin_section">
                                    	<option value="0">...</option>
                                    <?php
                                    	 $t_arr = ism_return_standard_templates_arr();
                                         foreach($t_arr as $key=>$value){
                                             ?>
                                                <option value="<?php echo $key;?>"><?php echo $value;?></option>
                                            <?php
                                        }
                                    ?>
                                    </select>
                                </td>
                            </tr>
							</tbody>
						</table>
						<div style="display:inline-block;">
							<div id="isf_preview_2" style="display: inline-block;padding: 5px 0px;"></div>
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
                    <label>Special Templates:</label>
                </h3>
                <div class="inside" style="vertical-align: top;">
                    <table class="form-table">
                    	<tr valign="top">
                        	<th scope="row">
                            	Select a Template:
                            </th>
                            <td>
                            	<select id="template_3" onChange="isf_disabled_rest_templates('#template_3', '#isf_preview_3');" class="ism_select_admin_section">
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
						<div id="isf_preview_3" style="display: inline-block;padding: 5px 0px;"></div>
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
                                    <input type="radio" value="vertical" onClick="jQuery('#list_align_type').val(this.value);isf_shortcode_update();" name="list_type_algin" /><span class="indeedcrlabel">Vertical</span>
                                    <input type="radio" value="horizontal" checked="checked" onClick="jQuery('#list_align_type').val(this.value);isf_shortcode_update();" name="list_type_algin" /><span class="indeedcrlabel">Horizontal</span>
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
                                    	<input type="checkbox" checked="checked"  class="ism-switch" id="display_counts" onClick="isf_shortcode_update();"/>
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
                                    	<input type="checkbox" checked="checked" class="ism-switch" id="display_full_name" onClick="isf_shortcode_update();"/>
										<div class="switch" style="display:inline-block;"></div>
									</label>                                      
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                	Display SubLabel    
                                </th>
                                <td>
                                	<label>
                                    	<input type="checkbox"  checked="checked" class="ism-switch" id="display_sublabel" onClick="isf_shortcode_update();"/>
										<div class="switch" style="display:inline-block;"></div>
									</label>                                    
                                </td>
                            </tr>
							<tr valign="top">
									<th scope="row">
									   Number of Columns
									</th>
									<td>
										<select id="no_cols" style="min-width:150px;" onClick="isf_shortcode_update();">
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
										<select id="box_align" style="min-width:150px;" onClick="isf_shortcode_update();">
											<option value="left" >Left</option>
											<option value="center" >Center</option>
											<option value="right" >Right</option>	
										</select>
									</td>
							</tr>		
                        </tbody>
                    </table>
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
    	                			<input type="checkbox" class="ism-switch" id="disable_mobile" onClick="isf_shortcode_update();"/>
    	                			<div class="switch" style="display:inline-block;"></div>
								</label>            
                            </td>
                        </tr>
                     </tbody>
                </table>         
            </div>
       </div>         	
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
            isf_shortcode_update();
        });
    </script>
</div>