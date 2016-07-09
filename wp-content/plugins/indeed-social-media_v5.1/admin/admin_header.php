
<script>
    ism_base_path = "<?php echo get_site_url();?>";
</script>

<div class="ism-wrap">
<!--top menu -->      
<div class="ism_admin_header">
  <div class="ism-main-side">
	<div class="ism_left_side">
		<img src="<?php echo ISM_DIR_URL;?>admin/files/images/dashboard-logo.jpg"/>
	</div>
	<div class="ism_right_side">
		<ul>
            <?php
                $menu_items = array('website_display'=>'Website Display', 
                					'inside_display'=>'Content Display', 
                					'mobile_display' => 'Mobile Display',
                					'shortcode'=>'Shortcode Display',
                					'slide_in' => 'Slide In Display',
									'popup' => 'PopUp Display',
                					);
				$menu_items['share_image'] = 'Image Display';					
                if( is_plugin_active('indeed-share-image/indeed-share-image.php') ){
                	$menu_items_active['share_image'] = 'ism-activate';	
                }else{
					$menu_items_active['share_image'] = 'ism-deactivate';
				}
				
                $menu_items['isb'] = 'Share Bar';
                if( is_plugin_active('indeed-share-bar/indeed-share-bar.php') ){
					$menu_items_active['isb'] = 'ism-activate';	
                }else{
					$menu_items_active['isb'] = 'ism-deactivate';
				}
				
							
				$menu_items['share_point'] = 'Share Point';
        		if( is_plugin_active('indeed-share-point/indeed-share-point.php') ){
					$menu_items_active['share_point'] = 'ism-activate';	
                }else{
					$menu_items_active['share_point'] = 'ism-deactivate';
				}
			    ?>
				<style>
						/*TO EXCLUDE THE UPDATE INFO*/
						.update-nag, .updated{
							display:none;
						}
					</style>
				<?php
				
				if(function_exists('isf_shortcode_tab')){
					//Social Follow
					$menu_items['follow'] = 'Follow Shortcode';
				}	
                $menu_items['shortcode_locker'] = 'Shortcode Locker';
                $menu_items['general_options'] = 'General Options';
                $menu_items['statistics'] = 'Statistics';
                $menu_items['help'] = 'Help';
                foreach($menu_items as $k=>$v){
                    $class = '';
					$addon = '';
                    if($k==$tab) $class .= 'selected';
					if($k=='share_image' || $k=='isb' || $k=='share_point') {
						$addon = 'ism-addon';
						
						if(isset($menu_items_active[$k])) $addon .= ' '.$menu_items_active[$k];
					}
                    ?>
						<li class="<?php echo $class;?>">
							<a href="<?php echo $url.'&tab='.$k;?>">
								<div class="ism_page_title <?php echo $addon; ?>">
								<i class="ism-fa-menu ism-icon-<?php echo $k;?>"></i>
								<?php echo $v;?>
								</div>
							</a>
						</li>
                    <?php 
                }
            ?>
		</ul>
	</div>
	<div class="clear"></div>
   </div>
	<?php if($tab == 'general_options'){ ?>
	<div class="ism_second_menu">
		<ul>
			<li><a href="#social-set"><i class="ism-fa-second-menu ism-icon-share-set"></i>Social Settings</a></li>
			<li><a href="#initial-counts"><i class="ism-fa-second-menu ism-icon-initial-counts"></i>Initial Counts</a></li>
			<li><a href="#min-counts"><i class="ism-fa-second-menu ism-icon-min-counts"></i>Minimum Counts</a></li>
			<li><a href="#custom-content"><i class="ism-fa-second-menu ism-icon-custom-content"></i>Custom Content</a></li>
			<li><a href="#email-share"><i class="ism-fa-second-menu ism-icon-email-set"></i>E-mail Share</a></li>
			<li><a href="#social-label"><i class="ism-fa-second-menu ism-icon-social-label"></i>Labels</a></li>
			<li><a href="#stats-set"><i class="ism-fa-second-menu ism-icon-stats-set"></i>Statistics</a></li>
			<li><a href="#url-set"><i class="ism-fa-second-menu ism-icon-url-set"></i>URL Settings</a></li>
			<li><a href="#check-counts"><i class="ism-fa-second-menu ism-icon-counts-set"></i>Check Counts</a></li>
			<li><a href="#follow-settings"><i class="ism-fa-second-menu ism-icon-follow-set"></i>Follow Settings</a></li>
			<li><a href="#after-share"><i class="ism-fa-second-menu ism-icon-after-share-set"></i>After Share</a></li>
			<?php if( function_exists('ispv_general_options') ){ ?>
				<li><a href="#page-views"><i class="ism-fa-second-menu ism-icon-page-views-set"></i>Page Views</a></li>
			<?php } ?>
		</ul>
	</div>
	<?php } ?>
</div>
        
<!-- /top menu-->