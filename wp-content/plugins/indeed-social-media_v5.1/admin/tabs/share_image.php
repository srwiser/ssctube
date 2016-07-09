<div class="metabox-holder indeed">
	<div class="stuffbox">
					<div class="ism-top-message"><b>"Image Display"</b> - Social Share Icons available over any Image for a better Share interaction.</div>
				</div>
	<div class="stuffbox">
		<h3>
			<label style=" font-size:16px;">
				AddOn Status
			</label>
		</h3>
		<div class="inside">
			<div class="submit" style="float:left; width:80%;">
				This AddOn is not installed into your system. To use this section you need to install and activate the "Social Share on Images" AddOn.
			</div>
			<div class="submit" style="float:left; width:20%; text-align:center;">
			</div>
			<div class="clear"></div>
		</div>
	</div>	
	<div class="stuffbox">
		<h3>
			<label style="font-size:16px;">
				AddOn Details
			</label>
		</h3>
		<div class="inside">
		  	<div class="ism_not_item">
			<?php 
	if($_GET['tab'] == 'share_image'){
		$url = 'http://codecanyon.net/item/social-share-on-images-addon-wordpress/9719076';
		$html = file_get_contents($url);
		
		$get1 = explode( '<div class="item-preview">' , $html );
		$get2 = explode( '</div>' , $get1[1] );
		
		preg_match_all('/<img.*?>/', $get2[0], $out);
		if(isset($out) && count($out) > 0){
			foreach($out as $value){
				echo '<div class="top-preview">'.$value[0].'</div>';
			}
		}
		
		$get3 = explode( '<div class="user-html">' , $html );
		$get4 = explode( '</div>' , $get3[1] );
		
		preg_match_all('/<img.*?>/', $get4[0], $images);
		if(isset($images) && count($images) > 0){
			foreach($images as $img){
				foreach($img as $value){
					if (strpos($value,'preview') === false && strpos($value,'button') === false) 
					echo $value;
				}
			}
		}
	}
	?>
	
			</div>
			<div class="clear"></div>
		</div>
	</div>	
	
</div>
</div>