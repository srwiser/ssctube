function isf_shortcode_update(){
	if(jQuery('#template_1').val()!='0') var the_template = jQuery('#template_1').val();
	else if(jQuery('#template_2').val()!='0') var the_template = jQuery('#template_2').val();
	else var the_template = jQuery('#template_3').val(); 
	
	if(typeof the_template=='undefined' || the_template==''){
		the_template = 'ism_template_sf_1';
		jQuery('#template_1').val('ism_template_sf_1');
	}
	
    // CREATE SHORTCODE
    var str = "[ism-social-followers ";
    str += "list='"+jQuery('#sm_items').val()+"' ";
    str += "template='"+the_template+"' ";
    str += "list_align='"+jQuery('#list_align_type').val()+"' ";
    if(jQuery('#display_counts').is(':checked')) str += "display_counts='true' ";
    else str += "display_counts='false' ";
    if(jQuery('#display_full_name').is(':checked')) str += "display_full_name='true' ";
    else str += "display_full_name='false' ";
    if( jQuery('#display_sublabel').is(':checked') ){
    	str += 'display_sublabel=1 ';
    }   
	
	if( jQuery('#no_cols').val() && jQuery('#no_cols').val() != 0 ){	
		str += "no_cols='"+jQuery('#no_cols').val()+"' ";
	}
	if( jQuery('#box_align').val() && jQuery('#box_align').val() != 'left' ){
		str += "box_align='"+jQuery('#box_align').val()+"' ";
	}
    if( jQuery('#disable_mobile').is(':checked') ){
    	str += "disable_mobile=1 ";
    }

    str += "]";
    if(jQuery('#sm_items').val()!=''){
        jQuery('.the_shortcode').html(str);
        jQuery(".php_code").html('&lt;?php echo do_shortcode("'+str+'");?&gt;');
    }else{
        msg = "Please Select Some Social Media Buttons";
        jQuery('.the_shortcode').html(msg);
        jQuery(".php_code").html(msg);
    }
    isf_preview_templates_be();
}

///preview templates
function isf_preview_templates_be(){
	the_sublabel = 0;
	if(jQuery('#template_1').val()!='0'){
		var the_template = jQuery('#template_1').val();
		var target_id = '#isf_preview_1';
	}else if(jQuery('#template_2').val()!='0'){
		var the_template = jQuery('#template_2').val();
		var target_id = '#isf_preview_2';
	}else{
		var the_template = jQuery('#template_3').val();
		var target_id = '#isf_preview_3';
	}
    
    jQuery('#isf_preview_1').fadeOut(100);
    jQuery('#isf_preview_2').fadeOut(100);
    jQuery('#isf_preview_3').fadeOut(100);
    
    if(typeof the_template=='undefined' || the_template=='') return;
    
	if(jQuery('#display_sublabel').is(':checked')) the_sublabel = 1;
	the_count = 'false';
    if(jQuery('#display_counts').is(':checked')) the_count = 'true';
    the_label = 'false';
    if(jQuery('#display_full_name').is(':checked')) the_label = 'true';
    
    jQuery.ajax({
         type : "post",
         url : window.ism_base_path+'/wp-admin/admin-ajax.php',
         data : {
                    action: "isf_admin_preview",
                    template: the_template,
                    align: jQuery('#list_align_type').val(),
                    label: the_label,
                    count: the_count,
                    sublabel: the_sublabel,
                    list: jQuery('#sm_items').val(),
                    
                },
         success: function(response){
                jQuery(target_id).html(response);
                jQuery(target_id).fadeIn(600);
         }
      });
}


function isf_disabled_rest_templates(current, current_view){
	arr_select = ['#template_1', '#template_2', '#template_3'];
	arr_preview = ['#isf_preview_1', '#isf_preview_2', '#isf_preview_3'];
	for(i=0;i<arr_select.length;i++){
		if(current==arr_select[i]){
			jQuery(arr_select[i]+" option[value='0']").remove();
		}else{
			if( jQuery(arr_select[i]+" option[value='0']").length == 0 ){ //add value 0 for disabled select
				jQuery(arr_select[i]).prepend('<option value="0">...</option>');
			}
			jQuery(arr_select[i]).val(0);
		}		
	}
	for(i=0;i<arr_preview.length;i++){
		if(arr_preview[i]!=current_view){
			jQuery(arr_preview[i]).fadeOut(100);
		}
	}
	isf_shortcode_update();
}