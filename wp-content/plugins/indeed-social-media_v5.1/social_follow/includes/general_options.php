<?php 
	isf_update_metas();//update metas
	$meta_arr = isf_get_metas();//get metas
?>
<form action="" method="post"> 

        <div class="stuffbox">
            <h3>
                <label>Social Follow Settings:</label>
            </h3>
            <div class="inside">
                <table style="margin-bottom: 0px;">
                					<tr>
                						<td></td>
                						<td><b>URL</b></td>
                						<td><b>Sublabel</b></td>
                						<td><b>Offline Counts</b></td>
                					</tr>
						<?php 
							$sm_items = isf_return_sm_labels();
							foreach($sm_items as $k=>$v){
								?>
									<tr>
										<td>
											<i class="fa-ism fa-<?php echo $k;?>-ism"></i>
										</td>
										<td>
											<input type="text" value="<?php if(isset($meta_arr['isf_urls'][$k])) echo $meta_arr['isf_urls'][$k];?>" name="isf_urls[<?php echo $k;?>]" style="width:600px;"/>
										</td> 
										<td>
											<input type="text" value="<?php if(isset($meta_arr['isf_sublabels'][$k])) echo $meta_arr['isf_sublabels'][$k];?>" name="isf_sublabels[<?php echo $k;?>]" style="width:150px;"/>
										</td>
										<td>
											<input type="number" value="<?php if(isset($meta_arr['isf_initial_counts'][$k]) ) echo $meta_arr['isf_initial_counts'][$k];?>" name="isf_initial_counts[<?php echo $k;?>]" min="0" style="width:70px;"/>
										</td>
									</tr>
								<?php 								
							}
						?>
                </table>
				<div class="submit">
                    <input type="submit" value="Save changes" name="isf_submit_bttn" class="button button-primary button-large" />
                </div>
             </div>
		</div>
				<div class="stuffbox">
		            <h3>
		                <label>Social Follow APIs</label>
		            </h3>
		            <div class="inside">
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Facebook</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Page URL:</span> <input type="text" value="<?php echo $meta_arr['isf_facebook_page_n'];?>" name="isf_facebook_page_n" />
		            		</div>
		            	</div>
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Twitter</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">UserName:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_username'];?>" name="isf_twitter_username" />
		            		</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Consumer key:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_ck'];?>" name="isf_twitter_ck" />
		            		</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Consumer secret:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_cs'];?>" name="isf_twitter_cs" />
		            		</div>
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Access token:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_at'];?>" name="isf_twitter_at" />
		            		</div>   
		            		<div class="isf_row_dashboard">
		            			<span class="isf_inside_row_label">Access token secret:</span> <input type="text" value="<?php echo $meta_arr['isf_twitter_ats'];?>" name="isf_twitter_ats" />
		            		</div> 
		            		<div>
		            			<span class="ism-info">
		            				You can get consumer key, consumer secret, acces token and access token secret after you register on <br/> Twitter Application Management:
		    	         			<a href="https://apps.twitter.com/app/new" target="_blank">https://apps.twitter.com/app/new</a>
		            			</span>
		            		</div>              		         		
		            	</div>   
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Google+</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">Page ID/Name</span> <input type="text" value="<?php echo $meta_arr['isf_google_page_id'];?>" name="isf_google_page_id" />
		            			</div>
		            			<div class="isf_row_dashboard">            			
		            				<span class="isf_inside_row_label">API key</span> <input type="text" value="<?php echo $meta_arr['isf_google_api_key'];?>" name="isf_google_api_key" />
		            			</div>
		            	</div> 
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">LinkedIn</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">Company Name: </span> <input type="text" value="<?php echo $meta_arr['isf_link_id'];?>" name="isf_link_id" />
		            			</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">APP Key: </span> <input type="text" value="<?php echo $meta_arr['isf_link_app_key'];?>" name="isf_link_app_key" />
		            			</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">APP Secret: </span> <input type="text" value="<?php echo $meta_arr['isf_link_app_secret'];?>" name="isf_link_app_secret" />
		            			</div>
		            	</div>      		            	
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Pinterest</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">UserName: </span> <input type="text" value="<?php echo $meta_arr['isf_pinterest_user'];?>" name="isf_pinterest_user" />
		            			</div>
		            	</div>          	
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">VKontakte</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">ID/Name: </span> <input type="text" value="<?php echo $meta_arr['isf_vk_name'];?>" name="isf_vk_name" />
		            			</div>
		            	</div>        
		            	<div class="isf_row_wrapp">
		            		<div class="isf_mini_label_dashboard">Delicious</div>
		            			<div class="isf_row_dashboard">
		            				<span class="isf_inside_row_label">UserName: </span> <input type="text" value="<?php echo $meta_arr['isf_delicious_user'];?>" name="isf_delicious_user" />
		            			</div>
		            	</div> 
		            	 
		            	<div style="margin-top: 40px;">
		            		<div style="display:inline-block;">Check On Every <input type="number" value="<?php echo $meta_arr['isf_check_time'];?>" name="isf_check_time" style="width: 60px;" min="1"/> Hours</div>
		            	</div>            	      	             	        	
				<div class="submit">
                    <input type="submit" value="Save changes" name="isf_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
      </div>
</form>