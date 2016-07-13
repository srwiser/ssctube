<script>
jQuery(document).ready(function() {
 
	// Uploading files
	
	jQuery('#upload_logo_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#logo').val(attachment.url);
			jQuery('#logo_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});
	
	jQuery('#upload_lineSeparatorImg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#lineSeparatorImg').val(attachment.url);
			jQuery('#lineSeparatorImg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});	


	jQuery('#upload_socialBgOFF_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#socialBgOFF').val(attachment.url);
			jQuery('#socialBgOFF_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


	jQuery('#upload_socialBgON_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#socialBgON').val(attachment.url);
			jQuery('#socialBgON_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


	jQuery('#upload_divBackgroundDaysImg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#divBackgroundDaysImg').val(attachment.url);
			jQuery('#divBackgroundDaysImg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});	


	jQuery('#upload_textBackgroundDaysImg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#textBackgroundDaysImg').val(attachment.url);
			jQuery('#textBackgroundDaysImg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});	


	jQuery('#upload_divBackgroundHoursImg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#divBackgroundHoursImg').val(attachment.url);
			jQuery('#divBackgroundHoursImg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


	jQuery('#upload_textBackgroundHoursImg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#textBackgroundHoursImg').val(attachment.url);
			jQuery('#textBackgroundHoursImg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


	jQuery('#upload_divBackgroundMinutesImg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#divBackgroundMinutesImg').val(attachment.url);
			jQuery('#divBackgroundMinutesImg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});	


	jQuery('#upload_textBackgroundMinutesImg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#textBackgroundMinutesImg').val(attachment.url);
			jQuery('#textBackgroundMinutesImg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


	jQuery('#upload_divBackgroundSecondsImg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#divBackgroundSecondsImg').val(attachment.url);
			jQuery('#divBackgroundSecondsImg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


	jQuery('#upload_textBackgroundSecondsImg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#textBackgroundSecondsImg').val(attachment.url);
			jQuery('#textBackgroundSecondsImg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


	jQuery('#upload_pageBg_button_circular_countdown').click(function(event) {
		var file_frame;
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}
		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false // Set to true to allow multiple files to be selected
		});
		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			//alert (attachment.url);
			jQuery('#pageBg').val(attachment.url);
			jQuery('#pageBg_img').attr('src',attachment.url);
		});
		// Finally, open the modal
		file_frame.open();
	});


 
});
</script>

  
<?php
	function isImg($the_str) {
		$res=false;
		$last4=strtolower(substr($the_str,-4));
		echo $last4;
		if ($last4=='.jpg' || $last4=='.png' || $last4=='.gif') {
			$res=true;
		}
		return $res;
	}	

?>  

<div class="wrap">
	<div id="lbg_logo">
			<h2>Countdown Settings for slider: <span style="color:#FF0000; font-weight:bold;"><?php echo strip_tags($_SESSION['xname'])?> - ID #<?php echo strip_tags($_SESSION['xid'])?></span></h2>
 	</div>
    
    <div style="text-align:center; padding:0px 0px 20px 0px;"><img src="<?php echo plugins_url('images/icons/magnifier.png', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="javascript: void(0);" onclick="showDialogPreview(<?php echo strip_tags($_SESSION['xid'])?>)">Preview Countdown</a></div>
    
  <form method="POST" enctype="multipart/form-data" id="form-settings-circular_countdown">
	<script>
	jQuery(function() {
		var icons = {
			header: "ui-icon-circle-arrow-e",
			headerSelected: "ui-icon-circle-arrow-s"
		};
		jQuery( "#accordion" ).accordion({
			icons: icons,
			autoHeight: false
		});
	});
	</script>

<div id="previewDialog"><iframe id="previewDialogIframe" src="" width="100%" height="600" style="border:0;"></iframe></div>

<div id="accordion">
  <h3><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;General Settings</a></h3>
  <div style="padding:30px;">
	  <table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="right" valign="top" class="row-title" width="15%">Countdown Name</td>
		    <td align="left" valign="top" width="85%"><input name="name" type="text" size="40" id="name" value="<?php echo strip_tags($_SESSION['xname']);?>"/></td>
	      </tr>
		  <tr>
            <td align="right" valign="top" class="row-title">Begin Date</td>
		    <td align="left" valign="top">
			<script>
              jQuery(function() {
                    jQuery( "#beginDate_date" ).datepicker({
                      changeMonth: true,
                      changeYear: true,
                      dateFormat: "yy,m,d",
                      /*onSelect: function(datetext){
                            jQuery('#beginDate_date').val(datetext);
                      }*/
                    });
            	});
            </script>            
            <input name="beginDate_date" type="text" size="30" id="beginDate_date" value="<?php echo strip_tags($_POST['beginDate_date']);?>"/>
	        YEAR,MONTH,DAY</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">
				<script>
                    jQuery(function() {
                        jQuery( "#beginDate_hours-slider-range-min" ).slider({
                            range: "min",
                            value: <?php echo strip_tags($_POST['beginDate_hours']);?>,
                            min: 0,
                            max: 24,
                            slide: function( event, ui ) {
                                jQuery( "#beginDate_hours" ).val(ui.value );
                            }
                        });
                        jQuery( "#beginDate_hours" ).val( jQuery( "#beginDate_hours-slider-range-min" ).slider( "value" ) );
                    });
                </script>
		        <div class="inlinefloatleft"><input name="beginDate_hours" type="text" size="5" id="beginDate_hours"/> HOURS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <div class="inlinefloatleft" style="padding-top:6px;"><div id="beginDate_hours-slider-range-min" style="width:200px;"></div></div>
				</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">
				<script>
                    jQuery(function() {
                        jQuery( "#beginDate_minutes-slider-range-min" ).slider({
                            range: "min",
                            value: <?php echo strip_tags($_POST['beginDate_minutes']);?>,
                            min: 0,
                            max: 60,
                            slide: function( event, ui ) {
                                jQuery( "#beginDate_minutes" ).val(ui.value );
                            }
                        });
                        jQuery( "#beginDate_minutes" ).val( jQuery( "#beginDate_minutes-slider-range-min" ).slider( "value" ) );
                    });
                </script>
		        <div class="inlinefloatleft"><input name="beginDate_minutes" type="text" size="5" id="beginDate_minutes"/> MINUTES &nbsp;&nbsp;&nbsp;&nbsp;</div>
                <div class="inlinefloatleft" style="padding-top:6px;"><div id="beginDate_minutes-slider-range-min" style="width:200px;"></div></div>
				</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">
				<script>
                    jQuery(function() {
                        jQuery( "#beginDate_seconds-slider-range-min" ).slider({
                            range: "min",
                            value: <?php echo strip_tags($_POST['beginDate_seconds']);?>,
                            min: 0,
                            max: 60,
                            slide: function( event, ui ) {
                                jQuery( "#beginDate_seconds" ).val(ui.value );
                            }
                        });
                        jQuery( "#beginDate_seconds" ).val( jQuery( "#beginDate_seconds-slider-range-min" ).slider( "value" ) );
                    });
                </script>
		        <div class="inlinefloatleft"><input name="beginDate_seconds" type="text" size="5" id="beginDate_seconds"/> SECONDS &nbsp;&nbsp;&nbsp;</div>
                <div class="inlinefloatleft" style="padding-top:6px;"><div id="beginDate_seconds-slider-range-min" style="width:200px;"></div></div>
				</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
	      </tr>
		  <tr>
            <td align="right" valign="top" class="row-title">End Date</td>
		    <td align="left" valign="top">
			<script>
              jQuery(function() {
                    jQuery( "#endDate_date" ).datepicker({
                      changeMonth: true,
                      changeYear: true,
                      dateFormat: "yy,m,d",
                      /*onSelect: function(datetext){
                            jQuery('#endDate_date').val(datetext);
                      }*/
                    });
            	});
            </script>            
            <input name="endDate_date" type="text" size="30" id="endDate_date" value="<?php echo strip_tags($_POST['endDate_date']);?>"/>
	        YEAR,MONTH,DAY</td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">
				<script>
                    jQuery(function() {
                        jQuery( "#endDate_hours-slider-range-min" ).slider({
                            range: "min",
                            value: <?php echo strip_tags($_POST['endDate_hours']);?>,
                            min: 0,
                            max: 24,
                            slide: function( event, ui ) {
                                jQuery( "#endDate_hours" ).val(ui.value );
                            }
                        });
                        jQuery( "#endDate_hours" ).val( jQuery( "#endDate_hours-slider-range-min" ).slider( "value" ) );
                    });
                </script>
		        <div class="inlinefloatleft"><input name="endDate_hours" type="text" size="5" id="endDate_hours"/> HOURS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                <div class="inlinefloatleft" style="padding-top:6px;"><div id="endDate_hours-slider-range-min" style="width:200px;"></div></div>
				</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">
				<script>
                    jQuery(function() {
                        jQuery( "#endDate_minutes-slider-range-min" ).slider({
                            range: "min",
                            value: <?php echo strip_tags($_POST['endDate_minutes']);?>,
                            min: 0,
                            max: 60,
                            slide: function( event, ui ) {
                                jQuery( "#endDate_minutes" ).val(ui.value );
                            }
                        });
                        jQuery( "#endDate_minutes" ).val( jQuery( "#endDate_minutes-slider-range-min" ).slider( "value" ) );
                    });
                </script>
		        <div class="inlinefloatleft"><input name="endDate_minutes" type="text" size="5" id="endDate_minutes"/> MINUTES &nbsp;&nbsp;&nbsp;&nbsp;</div>
                <div class="inlinefloatleft" style="padding-top:6px;"><div id="endDate_minutes-slider-range-min" style="width:200px;"></div></div>
				</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">
				<script>
                    jQuery(function() {
                        jQuery( "#endDate_seconds-slider-range-min" ).slider({
                            range: "min",
                            value: <?php echo strip_tags($_POST['endDate_seconds']);?>,
                            min: 0,
                            max: 60,
                            slide: function( event, ui ) {
                                jQuery( "#endDate_seconds" ).val(ui.value );
                            }
                        });
                        jQuery( "#endDate_seconds" ).val( jQuery( "#endDate_seconds-slider-range-min" ).slider( "value" ) );
                    });
                </script>
		        <div class="inlinefloatleft"><input name="endDate_seconds" type="text" size="5" id="endDate_seconds"/> SECONDS &nbsp;&nbsp;&nbsp;</div>
                <div class="inlinefloatleft" style="padding-top:6px;"><div id="endDate_seconds-slider-range-min" style="width:200px;"></div></div>
				</td>
	      </tr>
          <tr>
            <td align="right" valign="top" class="row-title">&nbsp;</td>
            <td align="left" valign="middle">&nbsp;</td>
          </tr>
          <tr>
		    <td align="right" valign="top" class="row-title">Use Server Time</td>
		    <td align="left" valign="middle"><select name="servertime" id="servertime">
              <option value="true" <?php echo (($_POST['servertime']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['servertime']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
        <tr>
		    <td align="right" valign="top" class="row-title">Responsive</td>
		    <td align="left" valign="middle"><select name="responsive" id="responsive">
              <option value="true" <?php echo (($_POST['responsive']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['responsive']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	    </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Plugin Font Family</td>
		    <td align="left" valign="middle"><input name="pluginFontFamily" type="text" id="pluginFontFamily" size="100" value="<?php echo stripslashes($row['pluginFontFamily']);?>" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Plugin Font Family Google Link</td>
		    <td align="left" valign="middle"><input name="pluginFontFamilyGoogleLink" type="text" id="pluginFontFamilyGoogleLink" size="100" value="<?php echo stripslashes($row['pluginFontFamilyGoogleLink']);?>" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Logo</td>
		    <td align="left" valign="middle"><input name="logo" type="text" id="logo" size="100" value="<?php echo stripslashes($row['logo']);?>" />
            <input name="upload_logo_button_circular_countdown" type="button" id="upload_logo_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['logo']?>" name="logo_img" id="logo_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Logo Link</td>
		    <td align="left" valign="middle"><input name="logoLink" type="text" size="100" id="logoLink" value="<?php echo strip_tags($_POST['logoLink']);?>"/></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Logo Target</td>
		    <td align="left" valign="middle"><select name="logoTarget" id="logoTarget">
		      <option value="_blank" <?php echo (($_POST['logoTarget']=='_blank')?'selected="selected"':'')?>>_blank</option>
		      <option value="_self" <?php echo (($_POST['logoTarget']=='_self')?'selected="selected"':'')?>>_self</option>
		      
	        </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Radius</td>
		    <td align="left" valign="middle"><input name="circleRadius" type="text" size="15" id="circleRadius" value="<?php echo strip_tags($_POST['circleRadius']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Line Width</td>
		    <td align="left" valign="middle"><input name="circleLineWidth" type="text" size="15" id="circleLineWidth" value="<?php echo strip_tags($_POST['circleLineWidth']);?>"/>
		      px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Behind Circle Line Width Expand</td>
		    <td align="left" valign="middle"><input name="behindCircleLineWidthExpand" type="text" size="15" id="behindCircleLineWidthExpand" value="<?php echo strip_tags($_POST['behindCircleLineWidthExpand']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Top Bottom Padding</td>
		    <td align="left" valign="middle"><input name="circleTopBottomPadding" type="text" size="15" id="circleTopBottomPadding" value="<?php echo strip_tags($_POST['circleTopBottomPadding']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Left Right Padding</td>
		    <td align="left" valign="middle"><input name="circleLeftRightPadding" type="text" size="15" id="circleLeftRightPadding" value="<?php echo strip_tags($_POST['circleLeftRightPadding']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Number Size</td>
		    <td align="left" valign="middle"><input name="numberSize" type="text" size="15" id="numberSize" value="<?php echo strip_tags($_POST['numberSize']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Number Additional Top Padding</td>
		    <td align="left" valign="middle"><input name="numberAdditionalTopPadding" type="text" size="15" id="numberAdditionalTopPadding" value="<?php echo strip_tags($_POST['numberAdditionalTopPadding']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Size</td>
		    <td align="left" valign="middle"><input name="textSize" type="text" size="15" id="textSize" value="<?php echo strip_tags($_POST['textSize']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Margin Top</td>
		    <td align="left" valign="middle"><input name="textMarginTop" type="text" size="15" id="textMarginTop" value="<?php echo strip_tags($_POST['textMarginTop']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Padding</td>
		    <td align="left" valign="middle"><input name="textPadding" type="text" size="15" id="textPadding" value="<?php echo strip_tags($_POST['textPadding']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Top Margin for All Circles </td>
		    <td align="left" valign="middle"><input name="allCirclesTopMargin" type="text" size="15" id="allCirclesTopMargin" value="<?php echo strip_tags($_POST['allCirclesTopMargin']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Bottom Margin for All Circles </td>
		    <td align="left" valign="middle"><input name="allCirclesBottomMargin" type="text" size="15" id="allCirclesBottomMargin" value="<?php echo strip_tags($_POST['allCirclesBottomMargin']);?>"/> px</td>
	      </tr>
          <tr>
		    <td align="right" valign="top" class="row-title">Social Bg OFF State</td>
		    <td align="left" valign="middle"><input name="socialBgOFF" type="text" id="socialBgOFF" size="100" value="<?php echo stripslashes($row['socialBgOFF']);?>" />
            <input name="upload_socialBgOFF_button_circular_countdown" type="button" id="upload_socialBgOFF_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['socialBgOFF']?>" name="socialBgOFF_img" id="socialBgOFF_img" /></td>
	      </tr>
			<tr>
		    <td align="right" valign="top" class="row-title">Social Bg ON State</td>
		    <td align="left" valign="middle"><input name="socialBgON" type="text" id="socialBgON" size="100" value="<?php echo stripslashes($row['socialBgON']);?>" />
            <input name="upload_socialBgON_button_circular_countdown" type="button" id="upload_socialBgON_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['socialBgON']?>" name="socialBgON_img" id="socialBgON_img" /></td>
	      </tr>          
		  <tr>
		    <td align="right" valign="top" class="row-title">Line Separator Img</td>
		    <td align="left" valign="middle"><input name="lineSeparatorImg" type="text" id="lineSeparatorImg" size="100" value="<?php echo stripslashes($row['lineSeparatorImg']);?>" />
            <input name="upload_lineSeparatorImg_button_circular_countdown" type="button" id="upload_lineSeparatorImg_button_circular_countdown" value="Change Image" />
              <br />
              Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['lineSeparatorImg']?>" name="lineSeparatorImg_img" id="lineSeparatorImg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">CallBack Function</td>
		    <td align="left" valign="middle"><textarea name="complete" cols="30" rows="5" id="complete"><?php echo strip_tags($_POST['complete']);?></textarea></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Auto Rese Every 24h</td>
		    <td align="left" valign="middle"><select name="autoReset24h" id="autoReset24h">
              <option value="true" <?php echo (($_POST['autoReset24h']=='true')?'selected="selected"':'')?>>true</option>
              <option value="false" <?php echo (($_POST['autoReset24h']=='false')?'selected="selected"':'')?>>false</option>
            </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Enable Maintenance Mode</td>
		    <td align="left" valign="middle"><select name="enableMaintenanceMode" id="enableMaintenanceMode">
		      <option value="true" <?php echo (($_POST['enableMaintenanceMode']=='true')?'selected="selected"':'')?>>true</option>
		      <option value="false" <?php echo (($_POST['enableMaintenanceMode']=='false')?'selected="selected"':'')?>>false</option>
	        </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><strong>NOTE:</strong> When you set it to true, all other Countdowns defined will have Maintenance Mode disabled. This is because only one Countdown can have Maintenance Mode enabled. You can define as many Countdown as you need, but only one can have Maintenance Mode enabled.</td>
	      </tr>
<tr>
		    <td align="right" valign="top" class="row-title">Page Body Background - Hexa<br />
(available only when you set Enable Maintenance Mode - true)</td>
		    <td align="left" valign="middle"><input name="pageBgHexa" type="text" size="25" id="pageBgHexa" value="<?php echo strip_tags($_POST['pageBgHexa']);?>" style="background-color:#<?php echo strip_tags($_POST['pageBgHexa']);?>" />
            <script>
jQuery('#pageBgHexa').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">OR</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Page Body Background - Img<br />
		      (available only when you set Enable Maintenance Mode - true)</td>
		    <td align="left" valign="middle"><input name="pageBg" type="text" id="pageBg" size="100" value="<?php echo stripslashes($row['pageBg']);?>" />
            <input name="upload_pageBg_button_circular_countdown" type="button" id="upload_pageBg_button_circular_countdown" value="Change Image" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['pageBg']?>" name="pageBg_img" id="pageBg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Page Body Background - Additional CSS</td>
		    <td align="left" valign="middle"><textarea name="pageBgAdditionalCss" cols="30" rows="5" id="pageBgAdditionalCss"><?php echo strip_tags($_POST['pageBgAdditionalCss']);?></textarea></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>        

        
      </table>
  </div>


  <h3><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Days Settings</a></h3>
  <div style="padding:30px;">
	  <table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="right" valign="top" class="row-title" width="20%">Translate Days</td>
		    <td align="left" valign="middle"><input name="translateDays" type="text" size="30" id="translateDays" value="<?php echo strip_tags($_POST['translateDays']);?>"/></td>
	      </tr>
		  <tr>
		    <td width="20%" align="right" valign="top" class="row-title">Div Background Days - Hexa</td>
		    <td align="left" valign="middle"><input name="divBackgroundDaysHexa" type="text" size="25" id="divBackgroundDaysHexa" value="<?php echo strip_tags($_POST['divBackgroundDaysHexa']);?>" style="background-color:#<?php echo strip_tags($_POST['divBackgroundDaysHexa']);?>" />
              <script>
jQuery('#divBackgroundDaysHexa').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">OR</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Div Background Days - Img</td>
		    <td align="left" valign="middle"><input name="divBackgroundDaysImg" type="text" id="divBackgroundDaysImg" size="100" value="<?php echo stripslashes($row['divBackgroundDaysImg']);?>" />
            <input name="upload_divBackgroundDaysImg_button_circular_countdown" type="button" id="upload_divBackgroundDaysImg_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['divBackgroundDaysImg']?>" name="divBackgroundDaysImg_img" id="divBackgroundDaysImg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Top Color Days</td>
		    <td align="left" valign="middle"><input name="borderTopColorDays" type="text" size="25" id="borderTopColorDays" value="<?php echo strip_tags($_POST['borderTopColorDays']);?>" style="background-color:#<?php echo strip_tags($_POST['borderTopColorDays']);?>" />
              <script>
jQuery('#borderTopColorDays').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Right Color Days</td>
		    <td align="left" valign="middle"><input name="borderRightColorDays" type="text" size="25" id="borderRightColorDays" value="<?php echo strip_tags($_POST['borderRightColorDays']);?>" style="background-color:#<?php echo strip_tags($_POST['borderRightColorDays']);?>" />
              <script>
jQuery('#borderRightColorDays').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Bottom Color Days</td>
		    <td align="left" valign="middle"><input name="borderBottomColorDays" type="text" size="25" id="borderBottomColorDays" value="<?php echo strip_tags($_POST['borderBottomColorDays']);?>" style="background-color:#<?php echo strip_tags($_POST['borderBottomColorDays']);?>" />
              <script>
jQuery('#borderBottomColorDays').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Left Color Days</td>
		    <td align="left" valign="middle"><input name="borderLeftColorDays" type="text" size="25" id="borderLeftColorDays" value="<?php echo strip_tags($_POST['borderLeftColorDays']);?>" style="background-color:#<?php echo strip_tags($_POST['borderLeftColorDays']);?>" />
              <script>
jQuery('#borderLeftColorDays').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Color Days</td>
		    <td align="left" valign="middle"><input name="circleColorDays" type="text" size="25" id="circleColorDays" value="<?php echo strip_tags($_POST['circleColorDays']);?>" style="background-color:#<?php echo strip_tags($_POST['circleColorDays']);?>" />
              <script>
jQuery('#circleColorDays').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Alpha Days</td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#circleAlphaDays-slider-range-min" ).slider({
			range: "min",
			value: <?php echo strip_tags($_POST['circleAlphaDays']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#circleAlphaDays" ).val(ui.value );
			}
		});
		jQuery( "#circleAlphaDays" ).val( jQuery( "#circleAlphaDays-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="circleAlphaDays-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="circleAlphaDays" type="text" size="10" id="circleAlphaDays" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Behind Circle Color Days</td>
		    <td align="left" valign="middle"><input name="behindCircleColorDays" type="text" size="25" id="behindCircleColorDays" value="<?php echo strip_tags($_POST['behindCircleColorDays']);?>" style="background-color:#<?php echo strip_tags($_POST['behindCircleColorDays']);?>" />
              <script>
jQuery('#behindCircleColorDays').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Behind Circle Alpha Days</td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#behindCircleAlphaDays-slider-range-min" ).slider({
			range: "min",
			value: <?php echo strip_tags($_POST['behindCircleAlphaDays']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#behindCircleAlphaDays" ).val(ui.value );
			}
		});
		jQuery( "#behindCircleAlphaDays" ).val( jQuery( "#behindCircleAlphaDays-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="behindCircleAlphaDays-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="behindCircleAlphaDays" type="text" size="10" id="behindCircleAlphaDays" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Number Color Days</td>
		    <td align="left" valign="middle"><input name="numberColorDays" type="text" size="25" id="numberColorDays" value="<?php echo strip_tags($_POST['numberColorDays']);?>" style="background-color:#<?php echo strip_tags($_POST['numberColorDays']);?>" />
              <script>
jQuery('#numberColorDays').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Color Days</td>
		    <td align="left" valign="middle"><input name="textColorDays" type="text" size="25" id="textColorDays" value="<?php echo strip_tags($_POST['textColorDays']);?>" style="background-color:#<?php echo strip_tags($_POST['textColorDays']);?>" />
              <script>
jQuery('#textColorDays').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Background Days - Hexa</td>
		    <td align="left" valign="middle"><input name="textBackgroundDaysHexa" type="text" size="25" id="textBackgroundDaysHexa" value="<?php echo strip_tags($_POST['textBackgroundDaysHexa']);?>" style="background-color:#<?php echo strip_tags($_POST['textBackgroundDaysHexa']);?>" />
              <script>
jQuery('#textBackgroundDaysHexa').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
          <tr>
                      <td align="right" valign="top" class="row-title">OR</td>
                      <td align="left" valign="middle">&nbsp;</td>
          </tr>
          <tr>
		    <td align="right" valign="top" class="row-title">Text Background Days - Img</td>
		    <td align="left" valign="middle"><input name="textBackgroundDaysImg" type="text" id="textBackgroundDaysImg" size="100" value="<?php echo stripslashes($row['textBackgroundDaysImg']);?>" />
            <input name="upload_textBackgroundDaysImg_button_circular_countdown" type="button" id="upload_textBackgroundDaysImg_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['textBackgroundDaysImg']?>" name="textBackgroundDaysImg_img" id="textBackgroundDaysImg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
	      </tr>
      </table>
  </div>  


  <h3><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hours Settings</a></h3>
  <div style="padding:30px;">
	  <table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="right" valign="top" class="row-title" width="20%">Translate Hours</td>
		    <td align="left" valign="middle"><input name="translateHours" type="text" size="30" id="translateHours" value="<?php echo strip_tags($_POST['translateHours']);?>"/></td>
	      </tr>
		  <tr>
		    <td width="20%" align="right" valign="top" class="row-title">Div Background Hours -Hexa</td>
		    <td align="left" valign="middle"><input name="divBackgroundHoursHexa" type="text" size="25" id="divBackgroundHoursHexa" value="<?php echo strip_tags($_POST['divBackgroundHoursHexa']);?>" style="background-color:#<?php echo strip_tags($_POST['divBackgroundHoursHexa']);?>" />
              <script>
jQuery('#divBackgroundHoursHexa').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">OR</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Div Background Hours - Img</td>
		    <td align="left" valign="middle"><input name="divBackgroundHoursImg" type="text" id="divBackgroundHoursImg" size="100" value="<?php echo stripslashes($row['divBackgroundHoursImg']);?>" />
            <input name="upload_divBackgroundHoursImg_button_circular_countdown" type="button" id="upload_divBackgroundHoursImg_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['divBackgroundHoursImg']?>" name="divBackgroundHoursImg_img" id="divBackgroundHoursImg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Top Color Hours</td>
		    <td align="left" valign="middle"><input name="borderTopColorHours" type="text" size="25" id="borderTopColorHours" value="<?php echo strip_tags($_POST['borderTopColorHours']);?>" style="background-color:#<?php echo strip_tags($_POST['borderTopColorHours']);?>" />
              <script>
jQuery('#borderTopColorHours').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Right Color Hours</td>
		    <td align="left" valign="middle"><input name="borderRightColorHours" type="text" size="25" id="borderRightColorHours" value="<?php echo strip_tags($_POST['borderRightColorHours']);?>" style="background-color:#<?php echo strip_tags($_POST['borderRightColorHours']);?>" />
              <script>
jQuery('#borderRightColorHours').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Bottom Color Hours</td>
		    <td align="left" valign="middle"><input name="borderBottomColorHours" type="text" size="25" id="borderBottomColorHours" value="<?php echo strip_tags($_POST['borderBottomColorHours']);?>" style="background-color:#<?php echo strip_tags($_POST['borderBottomColorHours']);?>" />
              <script>
jQuery('#borderBottomColorHours').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Left Color Hours</td>
		    <td align="left" valign="middle"><input name="borderLeftColorHours" type="text" size="25" id="borderLeftColorHours" value="<?php echo strip_tags($_POST['borderLeftColorHours']);?>" style="background-color:#<?php echo strip_tags($_POST['borderLeftColorHours']);?>" />
              <script>
jQuery('#borderLeftColorHours').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Color Hours</td>
		    <td align="left" valign="middle"><input name="circleColorHours" type="text" size="25" id="circleColorHours" value="<?php echo strip_tags($_POST['circleColorHours']);?>" style="background-color:#<?php echo strip_tags($_POST['circleColorHours']);?>" />
              <script>
jQuery('#circleColorHours').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Alpha Hours</td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#circleAlphaHours-slider-range-min" ).slider({
			range: "min",
			value: <?php echo strip_tags($_POST['circleAlphaHours']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#circleAlphaHours" ).val(ui.value );
			}
		});
		jQuery( "#circleAlphaHours" ).val( jQuery( "#circleAlphaHours-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="circleAlphaHours-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="circleAlphaHours" type="text" size="10" id="circleAlphaHours" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Behind Circle Color Hours</td>
		    <td align="left" valign="middle"><input name="behindCircleColorHours" type="text" size="25" id="behindCircleColorHours" value="<?php echo strip_tags($_POST['behindCircleColorHours']);?>" style="background-color:#<?php echo strip_tags($_POST['behindCircleColorHours']);?>" />
              <script>
jQuery('#behindCircleColorHours').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Behind Circle Alpha Hours</td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#behindCircleAlphaHours-slider-range-min" ).slider({
			range: "min",
			value: <?php echo strip_tags($_POST['behindCircleAlphaHours']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#behindCircleAlphaHours" ).val(ui.value );
			}
		});
		jQuery( "#behindCircleAlphaHours" ).val( jQuery( "#behindCircleAlphaHours-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="behindCircleAlphaHours-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="behindCircleAlphaHours" type="text" size="10" id="behindCircleAlphaHours" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Number Color Hours</td>
		    <td align="left" valign="middle"><input name="numberColorHours" type="text" size="25" id="numberColorHours" value="<?php echo strip_tags($_POST['numberColorHours']);?>" style="background-color:#<?php echo strip_tags($_POST['numberColorHours']);?>" />
              <script>
jQuery('#numberColorHours').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Color Hours</td>
		    <td align="left" valign="middle"><input name="textColorHours" type="text" size="25" id="textColorHours" value="<?php echo strip_tags($_POST['textColorHours']);?>" style="background-color:#<?php echo strip_tags($_POST['textColorHours']);?>" />
              <script>
jQuery('#textColorHours').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Background Hours - Hexa</td>
		    <td align="left" valign="middle"><input name="textBackgroundHoursHexa" type="text" size="25" id="textBackgroundHoursHexa" value="<?php echo strip_tags($_POST['textBackgroundHoursHexa']);?>" style="background-color:#<?php echo strip_tags($_POST['textBackgroundHoursHexa']);?>" />
              <script>
jQuery('#textBackgroundHoursHexa').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
          <tr>
                      <td align="right" valign="top" class="row-title">OR</td>
                      <td align="left" valign="middle">&nbsp;</td>
          </tr>
          <tr>
		    <td align="right" valign="top" class="row-title">Text Background Hours - Img</td>
		    <td align="left" valign="middle"><input name="textBackgroundHoursImg" type="text" id="textBackgroundHoursImg" size="100" value="<?php echo stripslashes($row['textBackgroundHoursImg']);?>" />
            <input name="upload_textBackgroundHoursImg_button_circular_countdown" type="button" id="upload_textBackgroundHoursImg_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['textBackgroundHoursImg']?>" name="textBackgroundHoursImg_img" id="textBackgroundHoursImg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
	      </tr>
      </table>
  </div>  
  
  <h3><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Minutes Settings</a></h3>
  <div style="padding:30px;">
	  <table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="right" valign="top" class="row-title" width="20%">Translate Minutes</td>
		    <td align="left" valign="middle"><input name="translateMinutes" type="text" size="30" id="translateMinutes" value="<?php echo strip_tags($_POST['translateMinutes']);?>"/></td>
	      </tr>
		  <tr>
		    <td width="20%" align="right" valign="top" class="row-title">Div Background Minutes -Hexa</td>
		    <td align="left" valign="middle"><input name="divBackgroundMinutesHexa" type="text" size="25" id="divBackgroundMinutesHexa" value="<?php echo strip_tags($_POST['divBackgroundMinutesHexa']);?>" style="background-color:#<?php echo strip_tags($_POST['divBackgroundMinutesHexa']);?>" />
              <script>
jQuery('#divBackgroundMinutesHexa').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">OR</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Div Background Minutes - Img</td>
		    <td align="left" valign="middle"><input name="divBackgroundMinutesImg" type="text" id="divBackgroundMinutesImg" size="100" value="<?php echo stripslashes($row['divBackgroundMinutesImg']);?>" />
            <input name="upload_divBackgroundMinutesImg_button_circular_countdown" type="button" id="upload_divBackgroundMinutesImg_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['divBackgroundMinutesImg']?>" name="divBackgroundMinutesImg_img" id="divBackgroundMinutesImg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Top Color Minutes</td>
		    <td align="left" valign="middle"><input name="borderTopColorMinutes" type="text" size="25" id="borderTopColorMinutes" value="<?php echo strip_tags($_POST['borderTopColorMinutes']);?>" style="background-color:#<?php echo strip_tags($_POST['borderTopColorMinutes']);?>" />
              <script>
jQuery('#borderTopColorMinutes').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Right Color Minutes</td>
		    <td align="left" valign="middle"><input name="borderRightColorMinutes" type="text" size="25" id="borderRightColorMinutes" value="<?php echo strip_tags($_POST['borderRightColorMinutes']);?>" style="background-color:#<?php echo strip_tags($_POST['borderRightColorMinutes']);?>" />
              <script>
jQuery('#borderRightColorMinutes').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Bottom Color Minutes</td>
		    <td align="left" valign="middle"><input name="borderBottomColorMinutes" type="text" size="25" id="borderBottomColorMinutes" value="<?php echo strip_tags($_POST['borderBottomColorMinutes']);?>" style="background-color:#<?php echo strip_tags($_POST['borderBottomColorMinutes']);?>" />
              <script>
jQuery('#borderBottomColorMinutes').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Left Color Minutes</td>
		    <td align="left" valign="middle"><input name="borderLeftColorMinutes" type="text" size="25" id="borderLeftColorMinutes" value="<?php echo strip_tags($_POST['borderLeftColorMinutes']);?>" style="background-color:#<?php echo strip_tags($_POST['borderLeftColorMinutes']);?>" />
              <script>
jQuery('#borderLeftColorMinutes').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Color Minutes</td>
		    <td align="left" valign="middle"><input name="circleColorMinutes" type="text" size="25" id="circleColorMinutes" value="<?php echo strip_tags($_POST['circleColorMinutes']);?>" style="background-color:#<?php echo strip_tags($_POST['circleColorMinutes']);?>" />
              <script>
jQuery('#circleColorMinutes').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Alpha Minutes</td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#circleAlphaMinutes-slider-range-min" ).slider({
			range: "min",
			value: <?php echo strip_tags($_POST['circleAlphaMinutes']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#circleAlphaMinutes" ).val(ui.value );
			}
		});
		jQuery( "#circleAlphaMinutes" ).val( jQuery( "#circleAlphaMinutes-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="circleAlphaMinutes-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="circleAlphaMinutes" type="text" size="10" id="circleAlphaMinutes" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Behind Circle Color Minutes</td>
		    <td align="left" valign="middle"><input name="behindCircleColorMinutes" type="text" size="25" id="behindCircleColorMinutes" value="<?php echo strip_tags($_POST['behindCircleColorMinutes']);?>" style="background-color:#<?php echo strip_tags($_POST['behindCircleColorMinutes']);?>" />
              <script>
jQuery('#behindCircleColorMinutes').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Behind Circle Alpha Minutes</td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#behindCircleAlphaMinutes-slider-range-min" ).slider({
			range: "min",
			value: <?php echo strip_tags($_POST['behindCircleAlphaMinutes']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#behindCircleAlphaMinutes" ).val(ui.value );
			}
		});
		jQuery( "#behindCircleAlphaMinutes" ).val( jQuery( "#behindCircleAlphaMinutes-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="behindCircleAlphaMinutes-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="behindCircleAlphaMinutes" type="text" size="10" id="behindCircleAlphaMinutes" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Number Color Minutes</td>
		    <td align="left" valign="middle"><input name="numberColorMinutes" type="text" size="25" id="numberColorMinutes" value="<?php echo strip_tags($_POST['numberColorMinutes']);?>" style="background-color:#<?php echo strip_tags($_POST['numberColorMinutes']);?>" />
              <script>
jQuery('#numberColorMinutes').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Color Minutes</td>
		    <td align="left" valign="middle"><input name="textColorMinutes" type="text" size="25" id="textColorMinutes" value="<?php echo strip_tags($_POST['textColorMinutes']);?>" style="background-color:#<?php echo strip_tags($_POST['textColorMinutes']);?>" />
              <script>
jQuery('#textColorMinutes').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Background Minutes - Hexa</td>
		    <td align="left" valign="middle"><input name="textBackgroundMinutesHexa" type="text" size="25" id="textBackgroundMinutesHexa" value="<?php echo strip_tags($_POST['textBackgroundMinutesHexa']);?>" style="background-color:#<?php echo strip_tags($_POST['textBackgroundMinutesHexa']);?>" />
              <script>
jQuery('#textBackgroundMinutesHexa').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
          <tr>
                      <td align="right" valign="top" class="row-title">OR</td>
                      <td align="left" valign="middle">&nbsp;</td>
          </tr>
          <tr>
		    <td align="right" valign="top" class="row-title">Text Background Minutes - Img</td>
		    <td align="left" valign="middle"><input name="textBackgroundMinutesImg" type="text" id="textBackgroundMinutesImg" size="100" value="<?php echo stripslashes($row['textBackgroundMinutesImg']);?>" />
            <input name="upload_textBackgroundMinutesImg_button_circular_countdown" type="button" id="upload_textBackgroundMinutesImg_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['textBackgroundMinutesImg']?>" name="textBackgroundMinutesImg_img" id="textBackgroundMinutesImg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
	      </tr>
      </table>
  </div>  
  
  <h3><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seconds Settings</a></h3>
  <div style="padding:30px;">
	  <table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td align="right" valign="top" class="row-title" width="20%">Translate Seconds</td>
		    <td align="left" valign="middle"><input name="translateSeconds" type="text" size="30" id="translateSeconds" value="<?php echo strip_tags($_POST['translateSeconds']);?>"/></td>
	      </tr>
		  <tr>
		    <td width="20%" align="right" valign="top" class="row-title">Div Background Seconds -Hexa</td>
		    <td align="left" valign="middle"><input name="divBackgroundSecondsHexa" type="text" size="25" id="divBackgroundSecondsHexa" value="<?php echo strip_tags($_POST['divBackgroundSecondsHexa']);?>" style="background-color:#<?php echo strip_tags($_POST['divBackgroundSecondsHexa']);?>" />
              <script>
jQuery('#divBackgroundSecondsHexa').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">OR</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Div Background Seconds - Img</td>
		    <td align="left" valign="middle"><input name="divBackgroundSecondsImg" type="text" id="divBackgroundSecondsImg" size="100" value="<?php echo stripslashes($row['divBackgroundSecondsImg']);?>" />
            <input name="upload_divBackgroundSecondsImg_button_circular_countdown" type="button" id="upload_divBackgroundSecondsImg_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['divBackgroundSecondsImg']?>" name="divBackgroundSecondsImg_img" id="divBackgroundSecondsImg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Top Color Seconds</td>
		    <td align="left" valign="middle"><input name="borderTopColorSeconds" type="text" size="25" id="borderTopColorSeconds" value="<?php echo strip_tags($_POST['borderTopColorSeconds']);?>" style="background-color:#<?php echo strip_tags($_POST['borderTopColorSeconds']);?>" />
              <script>
jQuery('#borderTopColorSeconds').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Right Color Seconds</td>
		    <td align="left" valign="middle"><input name="borderRightColorSeconds" type="text" size="25" id="borderRightColorSeconds" value="<?php echo strip_tags($_POST['borderRightColorSeconds']);?>" style="background-color:#<?php echo strip_tags($_POST['borderRightColorSeconds']);?>" />
              <script>
jQuery('#borderRightColorSeconds').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Bottom Color Seconds</td>
		    <td align="left" valign="middle"><input name="borderBottomColorSeconds" type="text" size="25" id="borderBottomColorSeconds" value="<?php echo strip_tags($_POST['borderBottomColorSeconds']);?>" style="background-color:#<?php echo strip_tags($_POST['borderBottomColorSeconds']);?>" />
              <script>
jQuery('#borderBottomColorSeconds').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Border Left Color Seconds</td>
		    <td align="left" valign="middle"><input name="borderLeftColorSeconds" type="text" size="25" id="borderLeftColorSeconds" value="<?php echo strip_tags($_POST['borderLeftColorSeconds']);?>" style="background-color:#<?php echo strip_tags($_POST['borderLeftColorSeconds']);?>" />
              <script>
jQuery('#borderLeftColorSeconds').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Color Seconds</td>
		    <td align="left" valign="middle"><input name="circleColorSeconds" type="text" size="25" id="circleColorSeconds" value="<?php echo strip_tags($_POST['circleColorSeconds']);?>" style="background-color:#<?php echo strip_tags($_POST['circleColorSeconds']);?>" />
              <script>
jQuery('#circleColorSeconds').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Circle Alpha Seconds</td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#circleAlphaSeconds-slider-range-min" ).slider({
			range: "min",
			value: <?php echo strip_tags($_POST['circleAlphaSeconds']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#circleAlphaSeconds" ).val(ui.value );
			}
		});
		jQuery( "#circleAlphaSeconds" ).val( jQuery( "#circleAlphaSeconds-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="circleAlphaSeconds-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="circleAlphaSeconds" type="text" size="10" id="circleAlphaSeconds" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Behind Circle Color Seconds</td>
		    <td align="left" valign="middle"><input name="behindCircleColorSeconds" type="text" size="25" id="behindCircleColorSeconds" value="<?php echo strip_tags($_POST['behindCircleColorSeconds']);?>" style="background-color:#<?php echo strip_tags($_POST['behindCircleColorSeconds']);?>" />
              <script>
jQuery('#behindCircleColorSeconds').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Behind Circle Alpha Seconds</td>
		    <td align="left" valign="middle"><script>
	jQuery(function() {
		jQuery( "#behindCircleAlphaSeconds-slider-range-min" ).slider({
			range: "min",
			value: <?php echo strip_tags($_POST['behindCircleAlphaSeconds']);?>,
			min: 0,
			max: 100,
			slide: function( event, ui ) {
				jQuery( "#behindCircleAlphaSeconds" ).val(ui.value );
			}
		});
		jQuery( "#behindCircleAlphaSeconds" ).val( jQuery( "#behindCircleAlphaSeconds-slider-range-min" ).slider( "value" ) );
	});
	        </script>
                <div id="behindCircleAlphaSeconds-slider-range-min" class="inlinefloatleft" style="width:200px;"></div>
		      <div class="inlinefloatleft" style="padding-left:20px;">%
		        <input name="behindCircleAlphaSeconds" type="text" size="10" id="behindCircleAlphaSeconds" style="border:0; color:#000000; font-weight:bold;"/>
	          </div></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Number Color Seconds</td>
		    <td align="left" valign="middle"><input name="numberColorSeconds" type="text" size="25" id="numberColorSeconds" value="<?php echo strip_tags($_POST['numberColorSeconds']);?>" style="background-color:#<?php echo strip_tags($_POST['numberColorSeconds']);?>" />
              <script>
jQuery('#numberColorSeconds').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Color Seconds</td>
		    <td align="left" valign="middle"><input name="textColorSeconds" type="text" size="25" id="textColorSeconds" value="<?php echo strip_tags($_POST['textColorSeconds']);?>" style="background-color:#<?php echo strip_tags($_POST['textColorSeconds']);?>" />
              <script>
jQuery('#textColorSeconds').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">Text Background Seconds - Hexa</td>
		    <td align="left" valign="middle"><input name="textBackgroundSecondsHexa" type="text" size="25" id="textBackgroundSecondsHexa" value="<?php echo strip_tags($_POST['textBackgroundSecondsHexa']);?>" style="background-color:#<?php echo strip_tags($_POST['textBackgroundSecondsHexa']);?>" />
              <script>
jQuery('#textBackgroundSecondsHexa').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
          <tr>
                      <td align="right" valign="top" class="row-title">OR</td>
                      <td align="left" valign="middle">&nbsp;</td>
          </tr>
          <tr>
		    <td align="right" valign="top" class="row-title">Text Background Seconds - Img</td>
		    <td align="left" valign="middle"><input name="textBackgroundSecondsImg" type="text" id="textBackgroundSecondsImg" size="100" value="<?php echo stripslashes($row['textBackgroundSecondsImg']);?>" />
            <input name="upload_textBackgroundSecondsImg_button_circular_countdown" type="button" id="upload_textBackgroundSecondsImg_button_circular_countdown" value="Change Image" />
              <br />
            Enter an URL or upload an image</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle"><img src="<?php echo $row['textBackgroundSecondsImg']?>" name="textBackgroundSecondsImg_img" id="textBackgroundSecondsImg_img" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
	      </tr>
      </table>
  </div>      


  


<h3><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;H tags Settings</a></h3>
  <div style="padding:30px;">
	  <table class="wp-list-table widefat fixed pages" cellspacing="0">
		  <tr>
		    <td width="20%" align="right" valign="top" class="row-title">H2 Content</td>
		    <td width="80%" align="left" valign="middle"><input name="h2Text" type="text" id="h2Text" size="100" value="<?php echo stripslashes($row['h2Text']);?>" /></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H2 Size</td>
		    <td align="left" valign="middle"><input name="h2Size" type="text" size="15" id="h2Size" value="<?php echo strip_tags($_POST['h2Size']);?>"/> px</td>
	      </tr> 
		  <tr>
		    <td align="right" valign="top" class="row-title">H2 Color</td>
		    <td align="left" valign="middle"><input name="h2Color" type="text" size="25" id="h2Color" value="<?php echo strip_tags($_POST['h2Color']);?>" style="background-color:#<?php echo strip_tags($_POST['h2Color']);?>" />
              <script>
jQuery('#h2Color').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H2 Weight</td>
		    <td align="left" valign="middle"><select name="h2Weight" id="h2Weight">
              <option value="normal" <?php echo (($_POST['h2Weight']=='normal')?'selected="selected"':'')?>>normal</option>
              <option value="bold" <?php echo (($_POST['h2Weight']=='bold')?'selected="selected"':'')?>>bold</option>
            </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H2 Top Margin</td>
		    <td align="left" valign="middle"><input name="h2TopMargin" type="text" size="15" id="h2TopMargin" value="<?php echo strip_tags($_POST['h2TopMargin']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H3 Content</td>
		    <td align="left" valign="middle"><input name="h3Text" type="text" id="h3Text" size="100" value="<?php echo stripslashes($row['h3Text']);?>" /></td>
	      </tr>          
		  <tr>
		    <td width="20%" align="right" valign="top" class="row-title">H3 Size</td>
		    <td width="80%" align="left" valign="middle"><input name="h3Size" type="text" size="15" id="h3Size" value="<?php echo strip_tags($_POST['h3Size']);?>"/> px</td>
	      </tr> 
		  <tr>
		    <td align="right" valign="top" class="row-title">H3 Color</td>
		    <td align="left" valign="middle"><input name="h3Color" type="text" size="25" id="h3Color" value="<?php echo strip_tags($_POST['h3Color']);?>" style="background-color:#<?php echo strip_tags($_POST['h3Color']);?>" />
              <script>
jQuery('#h3Color').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H3 Weight</td>
		    <td align="left" valign="middle"><select name="h3Weight" id="h3Weight">
              <option value="normal" <?php echo (($_POST['h3Weight']=='normal')?'selected="selected"':'')?>>normal</option>
              <option value="bold" <?php echo (($_POST['h3Weight']=='bold')?'selected="selected"':'')?>>bold</option>
            </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H3 Top Margin</td>
		    <td align="left" valign="middle"><input name="h3TopMargin" type="text" size="15" id="h3TopMargin" value="<?php echo strip_tags($_POST['h3TopMargin']);?>"/> px</td>
	      </tr>
          
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H4 Content</td>
		    <td align="left" valign="middle"><input name="h4Text" type="text" id="h4Text" size="100" value="<?php echo stripslashes($row['h4Text']);?>" /></td>
	      </tr>          
		  <tr>
		    <td width="20%" align="right" valign="top" class="row-title">H4 Size</td>
		    <td width="80%" align="left" valign="middle"><input name="h4Size" type="text" size="15" id="h4Size" value="<?php echo strip_tags($_POST['h4Size']);?>"/> px</td>
	      </tr> 
		  <tr>
		    <td align="right" valign="top" class="row-title">H4 Color</td>
		    <td align="left" valign="middle"><input name="h4Color" type="text" size="25" id="h4Color" value="<?php echo strip_tags($_POST['h4Color']);?>" style="background-color:#<?php echo strip_tags($_POST['h4Color']);?>" />
              <script>
jQuery('#h4Color').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		jQuery(el).val(hex);
		jQuery(el).css("background-color",'#'+hex);
		jQuery(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		jQuery(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	jQuery(this).ColorPickerSetColor(this.value);
});
              </script></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title"> H4 Weight</td>
		    <td align="left" valign="middle"><select name="h4Weight" id="h4Weight">
              <option value="normal" <?php echo (($_POST['h4Weight']=='normal')?'selected="selected"':'')?>>normal</option>
              <option value="bold" <?php echo (($_POST['h4Weight']=='bold')?'selected="selected"':'')?>>bold</option>
            </select></td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">H4 Top Margin</td>
		    <td align="left" valign="middle"><input name="h4TopMargin" type="text" size="15" id="h4TopMargin" value="<?php echo strip_tags($_POST['h4TopMargin']);?>"/> px</td>
	      </tr>
		  <tr>
		    <td align="right" valign="top" class="row-title">&nbsp;</td>
		    <td align="left" valign="middle">&nbsp;</td>
	      </tr>
      </table>
  </div>
  
  
  
</div>

<div style="text-align:center; padding:20px 0px 20px 0px;"><input name="Submit" type="submit" id="Submit" class="button-primary" value="Update Settings"></div>

</form>
</div>