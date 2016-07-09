<?php
if(isset($_REQUEST['g_submit_bttn'])){
	ism_return_arr_update( 'g_o' );
    ism_update_special_counts();
    ism_add_new_custom_share_url();
}
//default settings
$meta_arr = ism_return_arr_val( 'g_o' );

?>
<div class="metabox-holder indeed">
    <form method="post" action="">
	<div class="stuffbox">
		<div class="ism-top-message">Multiple <b>"General Settings"</b> starting from Social Network authentifications or special settings to Initial Counts, Minimum no. of Counts or Custom Names for Social Buttons.</div>
	</div>
        <div class="stuffbox">
            <h3>
                <label>Twitter Advanced Settings:</label>
            </h3>
            <div class="inside">
            
                <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>
                        <tr valign="top">
                            <td>
                                <strong>Username To Be Mentioned: @</strong> <input type="text" value="<?php echo $meta_arr['twitter_name'];?>" name="twitter_name" />
                            </td>
                        </tr>
                    </tbody>
                </table>
				<span class="ism-info">Set a twitter username that can be mentioned into shared tweets. Can be any username, but especially yours.</span>
				
                <table class="form-table" style="margin-bottom: 0px;margin-top: 25px;">
        	        <tbody>
                        <tr valign="top">
                            <td>
                                <strong>Enable Share Feature Image: </strong>                        
    	                			<label>
    	                				<?php 
    	                					$checked = '';
    	                					if(isset($meta_arr['ism_twitter_share_img']) && $meta_arr['ism_twitter_share_img']==1) $checked = 'checked="checked"';
    	                				?>
    	                				<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#ism_twitter_share_img');" <?php echo $checked;?> />
    	                			<div class="switch" style="display:inline-block;"></div></label>
    	                			<input type="hidden" value="<?php echo $meta_arr['ism_twitter_share_img'];?>" name="ism_twitter_share_img" id="ism_twitter_share_img" />     
    	                	</td>
                        </tr>
                    </tbody>
                </table>
                <span class="ism-info">
                	<strong>Experimental:</strong> In further to Share the "Featured Image" on Twitter, the website needs to be validated after the option was activated: <a href="https://cards-dev.twitter.com/validator" target="_blank">https://cards-dev.twitter.com/validator</a>
                </span>	
                         			
                			
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        
        <div class="stuffbox">
            <h3>
                <label>Shortlink (Available only for Twiter):</label>
            </h3>
            <div class="inside">                
                <table class="form-table" style="margin-top: 20px;">
        	        <tbody>      
                        <tr valign="top">
                            <td>
                                <strong>Enable: </strong>                        
    	                			<label>
    	                				<?php 
    	                					$checked = '';
    	                					if(isset($meta_arr['ism_twitter_shortlink']) && $meta_arr['ism_twitter_shortlink']==1) $checked = 'checked="checked"';
    	                				?>
    	                				<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#ism_twitter_shortlink');" <?php echo $checked;?> />
    	                			<div class="switch" style="display:inline-block;"></div></label>
    	                			<input type="hidden" value="<?php echo $meta_arr['ism_twitter_shortlink'];?>" name="ism_twitter_shortlink" id="ism_twitter_shortlink" />     
                <span class="ism-info">
                	<strong>If is activated, the Twitther's counts may not be accurate.</strong>
                </span>	    	                			
    	                	</td>
                        </tr>                          	        
                        <tr valign="top">
                            <td>
                                <strong>Bitly Username: </strong> <input type="text" value="<?php echo $meta_arr['bitly_user'];?>" name="bitly_user" style="width:270px" />
                            </td>
                        </tr>
                        <tr valign="top">
                            <td>
                                <strong>Bitly API Key: </strong> <input type="text" value="<?php echo $meta_arr['bitly_api'];?>" name="bitly_api"  style="width:290px"/>
                            </td>
                        </tr>                        
                    </tbody>
                </table>  
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>                        

        <div class="stuffbox">
            <h3>
                <label>Facebook Advanced Settings:</label>
            </h3>
            <div class="inside">
                <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>
                        <tr valign="top">
                            <td><label><h4 style="margin:0px; display:inline-block;">FaceBook App ID:</h4></label>
                                <input type="text" value="<?php echo $meta_arr['facebook_id'];?>" name="facebook_id" id="facebook_id"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
				<br/><br/>
				<span class="ism-info">For a proper share and tracking the share counts on FaceBook you need to set a Facebook App ID.</span>
                <span class="ism-info"></span>
				<span class="ism-info" style="padding-top:15px; font-weight:bold;">Be sure that the FaceBook App is set properly (follow the Documentation guidelines)! If you receive an error into the FaceBook Share Popup: "An error occurred. Please try again later." means the Facebook App is not set properly or is not able to connect with your Website.</span>
				<div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>Flattr Settings:</label>
            </h3>
            <div class="inside">
                <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>
                        <tr valign="top">
                            <td><label><h4 style="margin:0px; display:inline-block;">Flattr User ID(Name):</h4></label>
                                <input type="text" value="<?php echo $meta_arr['ism_flattr_uid'];?>" name="ism_flattr_uid" id="ism_flattr_uid"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
				<br/><br/>
				<span class="ism-info"></span>
                <span class="ism-info"></span>
				<div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>        
        
        <div class="stuffbox">
            <h3>
                <label>Default Feature Image:</label>
            </h3>
            <div class="inside">
                <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>
                        <tr valign="top">
                            <td>
                                <input type="text" value="<?php echo $meta_arr['feat_img'];?>" name="feat_img" id="feat_img" onClick="open_media_up(this);" class="indeed_large_input_text"/> <i class="icon-trash" onclick="jQuery('#feat_img').val('');" title="Remove Default Feature Image Value"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
				<span class="ism-info">A image it will be used when a post without an featured image is shared. The option is available only on some Social NetWorks (like Facebook, Pinterest).</span>
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
			
			<div id="email-share"></div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>E-Mail Share Options:</label>
            </h3>
            <div class="inside">
                <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>
                        <tr valign="top">
                            <td>
                                <span style="width:130px; font-weight:bold; display: inline-block;">Box Title: </span><input type="text" value="<?php echo $meta_arr['email_box_title'];?>" name="email_box_title" style="min-width: 300px;"/>
                            </td>
                        </tr>
						<tr valign="top">
                            <td>
                                <span style="width:130px; font-weight:bold; display: inline-block;">Subject: </span><input name="email_subject" style="min-width: 300px;" value="<?php echo stripslashes($meta_arr['email_subject']);?>"/>
							</td>
                        </tr>
						<tr valign="top">
                            <td>
                                <span style="width:130px; font-weight:bold; display: inline-block; vertical-align:top;">Message: </span><textarea name="email_message" style="min-width: 300px; min-height:150px;"><?php echo stripslashes( $meta_arr['email_message'] );?></textarea>
								<span class="ism-info">#LINK# is the Link that it will be shared.</span>
							</td>
                        </tr>
						<tr valign="top">
                            <td>
                                <?php
                                    $checked = '';
                                    if($meta_arr['email_capcha']==1) $checked = 'checked="checked"';
                                ?>
                                <span style="width:130px; font-weight:bold; display: inline-block;">Activate Capcha: </span><input type="checkbox" onClick="check_and_h(this, '#capcha_hidden');" <?php echo $checked;?> />
								<input type="hidden" name="email_capcha" value="<?php echo $meta_arr['email_capcha'];?>" id="capcha_hidden" />
							</td>
                        </tr>
						<tr valign="top">
                            <td>
                                <span style="width:130px; font-weight:bold; display: inline-block;">Alternative Email:</span><input type="text" value="<?php echo $meta_arr['email_send_copy'];?>" name="email_send_copy" style="min-width: 300px;" />
							</td>
                        </tr>
						<tr valign="top">
                            <td>
                                <span style="width:130px; font-weight:bold; display: inline-block;">Success Message: </span><input type="text" value="<?php echo $meta_arr['email_success_message'];?>" name="email_success_message" style="min-width: 300px;" />
							</td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
			
			<div id="stats-set"></div>
        </div>
        
		<div class="stuffbox">
            <h3>
                <label>Statistics</label>
            </h3>
            <div class="inside">
                 <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>
  							<tr valign="middle">
			                    <td>
									Enable:
			                    </td>
    	                		<td>
    	                			<label>
    	                				<?php 
    	                					$checked = '';
    	                					if(isset($meta_arr['ism_enable_statistics']) && $meta_arr['ism_enable_statistics']==1) $checked = 'checked="checked"';
    	                				?>
    	                				<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#ism_enable_statistics');" <?php echo $checked;?> />
    	                			<div class="switch" style="display:inline-block;"></div></label>
    	                			<input type="hidden" value="<?php echo $meta_arr['ism_enable_statistics'];?>" name="ism_enable_statistics" id="ism_enable_statistics" />
    	                		</td>
    	                	</tr>
  							<tr valign="middle">
			                    <td>
									Clear Data Older Than:
			                    </td>
    	                		<td>
    	                			<select id="clear_statistic">
    	                				<option value="day">One Day</option>
    	                				<option value="week">One Week</option>
    	                				<option value="month">One Month</option>
    	                			</select>
    	                		</td>
    	                		<td>
    	                			<input type="button" onClick="ism_clear_statistic_data();" value="Clear Data" class="button button-primary button-large" />
    	                			<span class="spinner" id="ism_near_bttn_clear_statistic" style="display: block;visibility: hidden;"></span>
    	                		</td>
    	                	</tr>    	                	
    	             </tbody>
    	         </table>
				 <span class="ism-info">
				<strong>Statistics</strong> may influence your website performance. Active the feature only if is necessary. Also, a periodically DataBase cleanup may be desirable.
				</span>      
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>     	                 
            </div>
			<div id="initial-counts"></div>
       </div>
	   
	   <div class="stuffbox">
            <h3>
                <label>Offline Counts</label>
            </h3>
            <div class="inside">
	                <table class="form-table" style="margin-bottom: 0px;">
		  				<tr valign="middle">
		  					<td>
		  						Show
		  					</td>	
    	                	<td>
    	                		<label>
    	                			<?php 
    	                				$checked = '';
    	                				if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']==1) $checked = 'checked="checked"';
    	                			?>
    	                		<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#ism_display_statistics_c_for_nci');" <?php echo $checked;?> />
    	                		<div class="switch" style="display:inline-block;"></div></label>
    	                		<input type="hidden" value="<?php echo $meta_arr['ism_display_statistics_c_for_nci'];?>" name="ism_display_statistics_c_for_nci" id="ism_display_statistics_c_for_nci" />
    	                	</td>		  					
		  				</tr>
	  				</table>            	
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>              	
            </div>
       </div>       
	       
		        <div class="stuffbox">
			        	    <h3>
                				<label>Initial Counts:</label>
            				</h3>
	            		<div class="inside" style="margin: 10px 0px;">
						<span class="ism-info" style="color:#000; fon-size:12px; font-weight:bold;"><br /> For better credebility you can start your counts from a bigger number than 0 or few shares.<br /><br /></span>
			                <table class="" style="margin-bottom: 0px;">
			        	        <tbody>
			                        <tr valign="middle">
			                            <td>
											Social Media Type:
			                            </td>
			                            <td>
											<select name="sm_type">
											<?php 
												if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']==1){
													$sm_items = ism_return_general_labels_sm( 'long_keys', true );
												}else{
													$sm_items = ism_return_general_labels_sm( 'long_keys', true, 'count' );
												}
												
												foreach($sm_items as $k=>$v){
													?>
														<option value="<?php echo $k;?>"><?php echo $v;?></option>
													<?php 	
												}
											?>											
											</select>			                            
			                            </td>
			                            <td>
			                            	URL: <input type="text" value="" name="the_url" style="width: 400px;"/>
			                            </td>
			                            <td>
			                            	Counts: <input type="number" value="" name="the_counts" style="width: 60px;" />
			                            </td>
			                            <td>
			                           	    <div class="submit" style="padding: 0px 10px;">
	                    						<input type="submit" value="Save" name="g_submit_bttn" class="button button-primary button-large" />
	                						</div>
			                            </td>
			                         </tr>
			                         <tr>
			                         	<td colspan="5">
			                         		<span class="ism-info">Type 'all' in URL Section if You want to set for all URLs!</span>
			                         	</td>
			                         </tr>
			                    </tbody>
			                </table>
			        	    <h4>
                				<label>List Of Initial Counts:</label>
            				</h4>
		            		
		            					<table>
		            						<tr>
		            							<td>
		            							<table class="special_counts_table" cellspacing="0">
												<tr style="background-color: #fff;">
													<td class="ism-top-table" style="font-weight:bold; text-align:left;">Social Network</td>
													<td class="ism-top-table" style="font-weight:bold;">Page URL</td>
													<td class="ism-top-table" style="font-weight:bold;">Counts</td>
													<td class="ism-top-table" style="font-weight:bold; text-align:left;"></td>
												</tr>
		            					<?php 
		            						$i=0;
		            						$all_sc = ism_return_special_counts('all');
		            						
				                         		foreach($sm_items as $k=>$v){
				                         			$arr = ism_return_special_counts($k);
				                         			if($arr && count($arr)>0){
					                         			foreach($arr as $key=>$value){	
					                         				if(isset($value) && $value!=''){
					                         					?>
					                         						<tr id="special_count_<?php echo $i;?>">
					                         							<td><?php echo $v;?></td> 
					                         							<td>
					                         								<a href="<?php echo $key;?>" target="_blank">
					                         									<?php echo $key;?>
					                         								</a>					                         							
					                         							</td>
					                         							<td><?php echo $value;?></td>
					                         							<td><i class="icon-trash" title="Delete" onClick="ism_deleteSpecialCount('<?php echo $key;?>', '<?php echo $k;?>', '#special_count_<?php echo $i;?>');"></i></td>					                         				
					                         						</tr>
					                         					<?php 
					                         					$i++;
					                         				}
					                         			}
				                         			}
				                         			if(isset($all_sc[$k]) && $all_sc[$k]!=''){
				                         				?>
				                         					<tr id="special_count_all_<?php echo $i;?>">
				                         						<td><?php echo $v;?></td> 
				                         						<td>All URLs</td> 
				                         						<td><?php echo $all_sc[$k];?></td>
				                         						<td><i class="icon-trash" title="Delete" onClick="ism_deleteSpecialCount('all', '<?php echo $k;?>', '#special_count_all_<?php echo $i;?>');"></i></td>				                         				
				                         					</tr>
				                         				<?php 
				                         				$i++;	
				                         			}
				                         		}
				                        ?>
		            							</table>
		            							</td>
		            						</tr>
		            					</table>
			</div>
			
			<div id="min-counts"></div>
		</div>
        
        <div class="stuffbox">
            <h3>
                <label>Showing Counts After:</label>
            </h3>
            <div class="inside">
			<span class="ism-info" style="color:#000; fon-size:12px; font-weight:bold;""><br /> A minimum number of Shares may be required to show the counts for each Social Network.<br /><br /></span>
                <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>
  							<tr valign="middle">
			                            <td>
											Social Media Type:
			                            </td>
			                            <td>
											<select id="sm_type_min_count">
											<?php 
											if(isset($meta_arr['ism_display_statistics_c_for_nci']) && $meta_arr['ism_display_statistics_c_for_nci']==1){
												$sm_items = ism_return_general_labels_sm( 'long_keys', true );
											}else{
												$sm_items = ism_return_general_labels_sm( 'long_keys', true, 'count' );
											}
												
												foreach($sm_items as $k=>$v){
													?>
														<option value="<?php echo $k;?>"><?php echo $v;?></option>
													<?php 	
												}
											?>											
											</select>			                            
			                            </td>
			                            <td>
			                            	Counts: <input type="number" id="sm_min_count_value" style="width: 60px;" min="1"/>
			                            </td>
			                            <td>
			                           	    <div class="submit" style="padding: 0px 10px;">
	                    						<input type="button" value="Save" class="button button-primary button-large" onClick="ism_update_minim_counts();"/>
	                    						<span class="spinner" id="ism_near_bttn_loading" style="display: block;visibility: hidden;"></span>
	                						</div>
			                            </td>
			                    </tr>
                    </tbody>
                </table>
                <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>                			                    
			                    <tr>
			                    	<td rowspan="4">
			                    		<table id="ism_minim_counts_table">
			                    		<?php
				                    		@$arr = get_option('ism_min_count');
				                    		if($arr!==FALSE && count($arr)>0){?>
											<tr style="background-color: #fff;">
												<td class="ism-top-table" style="font-weight:bold; text-align:left;">Social Network</td>
												<td class="ism-top-table" style="font-weight:bold; color: rgb(28, 134, 188);font-size: 12px;">Counts</td>
												<td class="ism-top-table" style="font-weight:bold; text-align:left;"></td>
											</tr>
											<?php
				                    			$str = '';
				                    			foreach($arr as $k=>$v){
				                    				if($v!=''){
				                    					echo "<tr id='ism_count_min_sm-{$k}'>
				                    					<td>{$ism_list[$k]}</td>
				                    					<td>{$v}</td>
				                    					<td>
				                    					<i class='icon-trash' title='Delete' onClick='ism_deleteMinCount(\"{$k}\", \"#ism_count_min_sm-{$k}\");'></i>
				                    					</td>
				                    					</tr>";
				                    				}
				                    			}
				                    		}			                    		
			                    		?>
			                    		</table>
			                    	</td>
			                    </tr>
                    </tbody>
                </table>
            </div>
			<div id="check-counts"></div>
        </div>  
        <div class="stuffbox">
            <h3>
                <label>Check Counts Every Time:</label>
            </h3>
            <div class="inside">
                <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>
  							<tr valign="middle">
			                            <td>
											Enable:
			                            </td>
    	                		<td>
    	                			<label>
    	                				<?php 
    	                					$checked = '';
    	                					if(isset($meta_arr['ism_check_counts_everytime']) && $meta_arr['ism_check_counts_everytime']==1) $checked = 'checked="checked"';
    	                				?>
    	                				<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#ism_check_counts_everytime');" <?php echo $checked;?> />
    	                			<div class="switch" style="display:inline-block;"></div></label>
    	                			<input type="hidden" value="<?php echo $meta_arr['ism_check_counts_everytime'];?>" name="ism_check_counts_everytime" id="ism_check_counts_everytime" />
    	                		</td>
    	                	</tr>
    	             </tbody>
    	         </table>
				 <span class="ism-info">Activating the option, the Plugin will check the counts for each URL directly from Social Network every time. Thats is more accurate but is server consuming and the API limits may be reached.</span>
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>    	                    	
            </div>
			
			<div id="url-set"></div>
        </div> 
       <div class="stuffbox">
            <h3>
                <label>URL Settings:</label>
            </h3>
            <div class="inside">
                <table class="form-table" style="margin-bottom: 0px;">
        	        <tbody>
                        <tr valign="top">
                            <td>
                                <strong>URL Type: </strong>
                                <div style="margin-top:15px;">
                                    <div>
                                        <?php
                                            $checked = '';
                                            if($meta_arr['ism_url_type']=='url') $checked = 'checked="checked"';
                                        ?>
                                        <input type="radio" name="ism_url_type" value="url" <?php echo $checked;?> /> Current URL
										<span class="ism-info">Use this option to avoid different Shares Counts on the same page (especially when you use a "One Page" theme).</span>
                                    </div>
                                    <div style="margin-top:10px;">
                                        <?php
                                            $checked = '';
                                            if($meta_arr['ism_url_type']=='permalink') $checked = 'checked="checked"';
                                        ?>
                                        <input type="radio" name="ism_url_type" value="permalink" <?php echo $checked;?> /> Permalink
										<span class="ism-info">Use this option when you wanna display multiple posts with sharing icons inside on the same page (like some Home pages).</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
			
			<div id="social-label"></div>
        </div>
       
        <div class="stuffbox">
            <h3>
                <label>Social Media Labels</label>
            </h3>
            <div class="inside">
                <table class="form-table custom-labels" style="margin-bottom: 0px;">
        	        <tbody>
        	        	<tr>
        	        		<td></td>
        	        		<td>Labels</td>
        	        		<td>Order</td>
        	        	</tr>
        	        	<?php 
        	        		$ism_list = ism_return_general_labels_sm( 'long_keys' );
							$ik = 0;
							$i = 1;
        	        		foreach($ism_list as $k=>$v){
        	        			?>
		  							<tr valign="middle">
					                    <td>
					                    	<div>
					                    		<i class="fa-ism fa-<?php echo $k;?>-ism"></i>
					                    	</div>
					                    </td>
					                    <td>
					                    	<input type="text" name="ism_general_sm_labels[<?php echo $k;?>]" value="<?php echo $v;?>"/>
					                    </td>
					                    <td>
					                    	<input type="number" name="ism_order[<?php echo $k;?>]" value="<?php if(isset($meta_arr['ism_order'][$k]) )echo $meta_arr['ism_order'][$k];else echo $i;?>" style="width: 60px;" min="1" />
					                    </td>
					                </tr>        	    
        	        			<?php
								$ik++;
								
								if($ik >= count($ism_list)/2 && $i<count($ism_list) ){
									$ik = 0;
									?>
									</tbody>
			    				   </table>
								   <table class="form-table  custom-labels" style="margin-bottom: 0px;">
        	        			   		<tbody>
					        	        	<tr>
					        	        		<td></td>
					        	        		<td>Labels</td>
					        	        		<td>Order</td>
					        	        	</tr>        	        			   	
        	        			   	<?php 
								}
								$i++;
        	        		}
        	        	?>
			       </tbody>
			    </table>
			    <div class="ism-info">
			    	Set the Order of Social Media Items based on number position ( 1 it's the first ).
			    </div>
			    <div style="margin-top:25px;width:100%;">
        	  		<div>
        	  			<span style="width:13%;display:inline-block;font-weight:bold;">"Totals" Label</span> 
        	  			<input type="text" name="ism_tc_label" value="<?php echo $meta_arr['ism_tc_label'];?>"/>
        	  		</div>
					<div>
						<span style="width:13%;display:inline-block;font-weight:bold;">"Totals" SubLabel</span>
						<input type="text" name="ism_tc_sublabel" value="<?php echo $meta_arr['ism_tc_sublabel'];?>"/>
					</div>			    
			    </div>		    		
			    
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>    	            
            </div>
			<div id="custom-content"></div>
        </div>   
        <div class="stuffbox">
            <h3>
                <label>Custom Share Content</label>
            </h3>
            <div class="inside">
			<span class="ism-info" style="color:#000; fon-size:13px; font-weight:bold;"><br />A custom content shared, other than is shows up on the page is not permitted by the Social Networks rules. Still, in some cases, this options is necessary. Some Social Networks doesn't accept custom content or request additional authentication, like FaceBook App ID.<br /><br /></span>
            	<table class="" style="margin-bottom: 0px;">
            		<tr>
            			<td colspan="2"><b>Add New Custom Content</b></td>
            		</tr>
            		<tr>
            			<td>
            				URL:
            			</td>
            			<td>
            				<input type="text" name='go_custom_share_url' style='width: 560px;' />
            				<span class="ism-info">Type 'all' in URL Section if You want to set for all URLs!</span>
						</td>
            		</tr>
            		<tr>
            			<td>
            				Shared URL:
            			</td>
            			<td>
            				<input type="text" name='go_custom_share_shared_url' style='width: 560px;' />
            			</td>
            		</tr>            		
            		<tr>
            			<td>
            				Title:
            			</td>
            			<td>
            				<input type="text" name='go_custom_share_title' style='width: 560px;' />
            			</td>
            		</tr> 
            		<tr>
            			<td>
            				Message:
            			</td>
            			<td>
            				<?php 
            					$options = array('textarea_name'=>'go_custom_share_message', 'textarea_rows' => 5 );
            					wp_editor('', 'custom_share_message', $options);
            				?>
            			</td>
            		</tr>  
            		<tr>
            			<td>
            				Feature Image:
            			</td>
            			<td>
            				<input type="text" id='go_custom_share_feat_image' name='go_custom_share_feat_image' style='width: 560px;' onClick="open_media_up(this);" /> 
            				<i class="icon-trash" onclick="jQuery('#go_custom_share_feat_image').val('');" title="Remove"></i>
            			</td>
            		</tr>            		          		           		
            	</table>
                <div class="submit">
                    <input type="submit" value="Save" name="g_submit_bttn" class="button button-primary button-large" />
                </div>  
                <div>
                	<?php 
                		$data = get_option('ism_go_custom_share_c');
                		if($data!==FALSE && count($data)>0){
                			?>	
                			<table class="ism_custom_share_table ism-gen-table" id="ism_cst_the_table">
                				<tr class="ism_first_tr">
                					<td class="ism-top-table">URL</td>
                					<td class="ism-top-table">Shared URL</td>
                					<td class="ism-top-table">Title</td>
                					<td class="ism-top-table">Message</td>
                					<td class="ism-top-table">Feature Image</td>
                					<td class="ism-top-table">Action</td>
                				</tr>
                			<?php 
                			$i = 0;
                			foreach($data as $k=>$v){
								?>
									<tr id='custom_share_tr_<?php echo $i;?>'>
										<td><?php echo $k;?></td>
										<td><?php echo $v['shared_url'];?></td>
										<td><?php echo $v['title'];?></td>
										<td><?php echo ims_format_source_text(stripslashes($v['message']));?></td>
										<td><?php echo $v['feat_image'];?></td>
										<td><i class="icon-trash" onclick="delete_custom_content_for_url('<?php echo $k;?>', <?php echo $i;?>);" title="Remove"></i></td>
									</tr>
								<?php 
								$i++;
                			}
                			?>
                			</table>
                			<?php 
                		}
                	?>
                </div>             	
            </div>
			<div id="follow-settings"></div>
       </div>  
       
        
        <div class="stuffbox">
            <h3>
                <label>Enable Locker On Visual Composer:</label>
            </h3>
            <div class="inside">
            	<div style="margin: 15px 0px;">
    	        	<label>
    	            	<?php 
    	            		$checked = '';
    	            		if(isset($meta_arr['ism_enable_vc_locker']) && $meta_arr['ism_enable_vc_locker']==1) $checked = 'checked="checked"';
    	            	?>
    	            	<input type="checkbox" class="ism-switch" onClick="check_and_h(this, '#ism_enable_vc_locker');" <?php echo $checked;?> />
    	                <div class="switch" style="display:inline-block;"></div>
    	            </label>
    	            <input type="hidden" value="<?php echo $meta_arr['ism_enable_vc_locker'];?>" name="ism_enable_vc_locker" id="ism_enable_vc_locker" />   
    	        </div>  
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>    	                		
        	</div>
        </div>
               
        <div class="stuffbox">
            <h3>
                <label>Custom CSS:</label>
            </h3>
            <div class="inside">
            	<textarea style="width: 100%;height: 150px; margin-top: 25px;" name="ism_general_custom_css"><?php echo $meta_arr['ism_general_custom_css'];?></textarea>
                <div class="submit">
                    <input type="submit" value="Save changes" name="g_submit_bttn" class="button button-primary button-large" />
                </div>                
            </div>
        </div>        
                                   
    </form>  
    
    <?php 
    
    	//INDEED VIEWs COUNT
	    if( function_exists('ispv_general_options') ){
	    	ispv_general_options();
	    }
    
    
    	//social follow 
    	if(function_exists('isf_general_options')){
    		isf_general_options();
    	}   

    	//after share settings
    	ism_after_share_go_settings();
    ?>
    
</div>
</div>