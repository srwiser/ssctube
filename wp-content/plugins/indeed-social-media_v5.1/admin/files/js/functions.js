function make_inputh_string(divCheck, showValue, hidden_input_id){
    str = jQuery(hidden_input_id).val();
    if(str!='') show_arr = str.split(',');
    else show_arr = new Array();
    if(jQuery(divCheck).is(':checked')){
        show_arr.push(showValue);
    }else{
        var index = show_arr.indexOf(showValue);
        show_arr.splice(index, 1);
    }
    str = show_arr.join(',');
    jQuery(hidden_input_id).val(str);
}
function ism_shortcode_update(tab){
	
	if(jQuery('#template_1').val()!='0'){
		var the_template = jQuery('#template_1').val();
		var target_id = '#ism_preview_1';
	}else if(jQuery('#template_2').val()!='0'){
		var the_template = jQuery('#template_2').val();
		var target_id = '#ism_preview_2';
	}
	
	if(typeof the_template=='undefined' || the_template==''){
		the_template = 'ism_template_1';
	}
	
    // CREATE SHORTCODE
    if(tab=='shortcode_locker') var str = "[indeed-social-locker ";
    else var str = "[indeed-social-media ";
    str += "sm_list='"+jQuery('#sm_items').val()+"' ";
    str += "sm_template='"+the_template+"' ";
    str += "sm_list_align='"+jQuery('#list_align_type').val()+"' ";
    if(jQuery('#display_counts').is(':checked')) str += "sm_display_counts='true' ";
    else str += "sm_display_counts='false' ";
    if(jQuery('#display_full_name').is(':checked')) str += "sm_display_full_name='true' ";
    else str += "sm_display_full_name='false' ";
	
	if( jQuery('#no_cols').val() && jQuery('#no_cols').val() != 0 ){	
		str += "no_cols='"+jQuery('#no_cols').val()+"' ";
	}
	if( jQuery('#box_align').val() && jQuery('#box_align').val() != 'left' ){
		str += "box_align='"+jQuery('#box_align').val()+"' ";
	}
    if( tab=='shortcode'){
    	if(jQuery('#disable_mobile').is(':checked')) str += "sm_disable_mobile=1 ";
    	if(jQuery('#ivc_display_views').is(':checked') ){
    		str += 'ivc_display_views=1 ';
    		str += 'ivc_position=\''+jQuery('#ivc_position').val()+'\' ';
    		if(jQuery('#ivc_sublable_on').is(':checked') ) str += 'ivc_sublable_on=1 ';
    		str += 'ivc_theme=\''+jQuery('#ivc_theme').val()+'\' ';
    	}
    	
    	if(jQuery('#after_share_enable').is(':checked') ){
    		str += 'after_share_enable=1 ';
    		str += 'after_share_title=\''+jQuery('#after_share_title').val()+'\' ';
            after_content = jQuery('#after_share_content').val();
            after_content = after_content.replace(/</g, "&lt;").replace(/>/g, "&gt;");
    		str += 'after_share_content=\''+after_content+'\' ';
    	}
    }
    
    if( jQuery('#print_total_shares').is(':checked') ){
    	str += 'print_total_shares=1 ';
        if( jQuery('#tc_position').val() ){
        	str += 'tc_position=\''+jQuery('#tc_position').val()+'\' ';
        }  
        if( jQuery('#display_tc_label').is(':checked')){
        	str += 'display_tc_label=1 ';
        }
        if( jQuery('#display_tc_sublabel').is(':checked') ){
        	str += 'display_tc_sublabel=1 ';
        }    
        if( jQuery('#tc_theme').val() ){
        	str += 'tc_theme=\''+jQuery('#tc_theme').val()+'\' ';
        }  
    }   
    
    if(tab=='shortcode_locker'){
    	str += "locker_template="+jQuery('#locker_template').val()+" ";
    	if(jQuery('#locker_template').val()==1){
            str += "sm_lock_padding=" + jQuery('#locker_padding').val() + " ";
            str += "sm_lock_bk='" + jQuery('#locker_background').val() + "' ";    		
    	}
        locker_text = jQuery('#display_text').val();
        locker_text = locker_text.replace(/</g, "&lt;").replace(/>/g, "&gt;");
        str += "sm_d_text='" + locker_text + "' ";
        if(jQuery('#not_registered_u').val()==1) str += "not_registered_u=1 ";
        if(jQuery('#enable_timeout_lk').val()==1){
        	str += "enable_timeout_lk=1 ";
        	if(jQuery('#ism_timeout_locker').val()!='') str += "sm_timeout_locker="+jQuery('#ism_timeout_locker').val()+" ";
        }        
        if( jQuery('#reset_locker').val()==1 && jQuery('#locker_reset_after').val()!='' ){
        	str += "reset_locker=1 ";
        	str += "locker_reset_after="+jQuery('#locker_reset_after').val()+" ";
        	str += "locker_reset_type='"+jQuery('#locker_reset_type').val()+"' ";        	
        }      
        str += "ism_overlock='"+jQuery('#ism_overlock').val()+"' ";
        
        if( jQuery('#disable_mobile').is(':checked') ) str += 'disable_mobile=1 ';
        
        if(jQuery('#twitter_hide_mobile').is(':checked')) str += 'twitter_hide_mobile=1 ';
        if(jQuery('#twitter_unlock_onclick').is(':checked')) str += 'twitter_unlock_onclick=1 ';
        
        //end of locker
        str += "]&nbsp;&nbsp;&nbsp;";
        str += "[/indeed-social-locker]";
        //AJAX CALL
        ism_preview_locker(str);        
    }else str += "]";
    if(jQuery('#sm_items').val()!=''){
        jQuery('.the_shortcode').html(str);
        jQuery(".php_code").html('&lt;?php echo do_shortcode("'+str+'");?&gt;');
    }else{
        msg = "Please Select Some Social Media Buttons";
        jQuery('.the_shortcode').html(msg);
        jQuery(".php_code").html(msg);
    }
}
//PREVIEW LOCKER 
function ism_preview_locker(the_shortcode){
  jQuery.ajax({
      type : "post",
      url : window.ism_base_path+'/wp-admin/admin-ajax.php',
      data : {
          action: "ism_preview_shortcode",
          shortcode: the_shortcode,	
      },
	    success: function(data){
  		jQuery('#ISM_preview_shortcode').html(data); 
	    },
  });	
}

function check_and_h(from, target){
	if (jQuery(from).is(":checked")) jQuery(target).val(1);
	else jQuery(target).val(0);
}
function ism_check_and_h(from, where){
	if (jQuery(from).is(":checked")) jQuery(where).val('true');
	else jQuery(where).val('false');
}
///preview templates
function ism_preview_templates_be(preview_id, hide_preview, disabled_id, current_id, input_name){
    jQuery(current_id+" option[value='0']").remove();//remove value 0 from current select
    if( jQuery(disabled_id+" option[value='0']").length == 0 ){ //add value 0 for disabled select
    	jQuery(disabled_id).prepend('<option value="0">...</option>');	
    }   
	jQuery(disabled_id).val('0');
	jQuery(disabled_id).removeAttr('name');	
	jQuery(hide_preview).fadeOut();
	if( jQuery("#special_mobile_template option[value='0']").length == 0 ){ 
		jQuery('#special_mobile_template').prepend('<option value="0">...</option>');	
		jQuery('#special_mobile_template').val('0');
	}else if(jQuery('#special_mobile_template').val()!='0') jQuery('#special_mobile_template').val('0');
	
	jQuery(current_id).attr('name', input_name);
    jQuery(preview_id).fadeOut(100);
    var the_template = jQuery(current_id).val();
    if(the_template=='') return;
      jQuery.ajax({
         type : "post",
         url : window.ism_base_path+'/wp-admin/admin-ajax.php',
         data : {
                    action: "ism_admin_items_preview",
                    template: the_template,
                },
         success: function(response){
                jQuery(preview_id).html(response);
                jQuery(preview_id).fadeIn(600);
         }
      });
}

jQuery(document).on('keyup', '#display_text', function() {
    ism_shortcode_update('shortcode_locker');
});
jQuery(document).on('blur', '#display_text', function() {
    ism_shortcode_update('shortcode_locker');
});
function updateTextarea(){
    content = jQuery( "#display_text_ifr" ).contents().find( '#tinymce' ).html();
    jQuery('#display_text').val(content);
    ism_shortcode_update('shortcode_locker');
}
function updateFromWPEditor(id){
    content = jQuery( '#'+id+'_ifr' ).contents().find( '#tinymce' ).html();
    jQuery('#'+id).val(content);
    ism_shortcode_update('shortcode');
}
jQuery(document).on('click', '#after_share_content-html', function() {
    jQuery('#ism_update_textarea_bttn').css('display', 'none');
});
jQuery(document).on('click', '#after_share_content-tmce', function() {
    jQuery('#ism_update_textarea_bttn').css('display', 'block');
});
jQuery(window).bind('load', function(){
    display = jQuery('#after_share_content').css('display');
    if(display=='none') jQuery('#ism_update_textarea_bttn').css('display', 'block');
});
jQuery(document).on('click', '#display_text-html', function() {
    jQuery('#ism_update_textarea_bttn').css('display', 'none');
});
jQuery(document).on('click', '#display_text-tmce', function() {
    jQuery('#ism_update_textarea_bttn').css('display', 'block');
});
jQuery(window).bind('load', function(){
    display = jQuery('#display_text').css('display');
    if(display=='none') jQuery('#ism_update_textarea_bttn').css('display', 'block');
});

function ism_deleteSpecialCount(url, type, div){
    jQuery.ajax({
        type : "post",
        url : window.ism_base_path+'/wp-admin/admin-ajax.php',
        data : {
            action: "ism_delete_special_count",
            the_url: url,
            the_type: type
        },
	    success: function(data){
    			jQuery(div).fadeOut(600); 
	    },
    });
}

function ism_disable_style_table(value){
	if(value==1){
		jQuery('#ism_shortcode_style-table').fadeIn();
		return;
	}else{
		jQuery('#ism_shortcode_style-table').fadeOut();
	}
	
}

//////////////////////MIN COUNTS
function ism_update_minim_counts(){
	jQuery('#ism_near_bttn_loading').css('visibility', 'visible');
    jQuery.ajax({
        type : "post",
        url : window.ism_base_path+'/wp-admin/admin-ajax.php',
        data : {
            action: "ism_update_min_count",
            sm: jQuery('#sm_type_min_count').val(),
            count: jQuery('#sm_min_count_value').val()
        },
	    success: function(data){
	    	if(parseInt(data)==1){
	    		ism_update_html_min_counts();
	    	}
	    	jQuery('#ism_near_bttn_loading').css('visibility', 'hidden');
	    },
    });	
}
function ism_update_html_min_counts(){
    jQuery.ajax({
        type : "post",
        url : window.ism_base_path+'/wp-admin/admin-ajax.php',
        data : {
            action: "ism_return_min_count_table",
        },
        success: function(data){
        	if(data!=0){
        		jQuery('#ism_minim_counts_table').html(data);
        	}
        },
    });	
}
function ism_deleteMinCount(value, id){
    jQuery.ajax({
        type : "post",
        url : window.ism_base_path+'/wp-admin/admin-ajax.php',
        data : {
            action: "ism_delete_min_count",
            sm: value,
        },
        success: function(data){
	    	if(parseInt(data)!=0){
	    		jQuery(id).fadeOut();
	    	}
        },
    });		
}

function ism_enable_disable_c(check, target){
	if (jQuery(check).is(":checked")) jQuery(target).removeAttr('disabled');
	else jQuery(target).attr('disabled', 'disabled'); 
}

function ism_c_opacity(check_id, div, a_parent, a_check, h_id){
	if(jQuery(check_id).is(':checked')){
		jQuery(div).css('opacity', '1');
		jQuery(a_parent).css('opacity', '0.5');
		jQuery(a_check).prop('checked', false);
		jQuery(h_id).val(0);
	}else{
		jQuery(div).css('opacity', '0.5');
	}
	
}

function ism_change_dropdown(d, v){
	//d is id and v is the new value
	jQuery(d).val(v);
}

function ism_clear_statistic_data(){
	jQuery('#ism_near_bttn_clear_statistic').css('visibility', 'visible');
	var o = jQuery('#clear_statistic').val();//clear data older than
    jQuery.ajax({
        type : "post",
        url : window.ism_base_path+'/wp-admin/admin-ajax.php',
        data : {
            action: "ism_delete_statistic_data",
            older_than: o,
        },
        success: function(data){
	    	if(parseInt(data)!=0){
	    		jQuery('#ism_near_bttn_clear_statistic').css('visibility', 'hidden');
	    	}
        },
    });		
}

function delete_custom_content_for_url(url, num){
    jQuery.ajax({
        type : "post",
        data : {
                    action: "ism_remove_custom_share_for_url_ajax",
                    the_url: url,
                },
        url : window.ism_base_path+'/wp-admin/admin-ajax.php',
        success: function (d) {
        	if(d==1){
        		if(num==0){
        			//remove the table
        			jQuery('#ism_cst_the_table').fadeOut();
        		}
        		else{
        			//remove the tr
        			jQuery('#custom_share_tr_'+num).fadeOut(); 
        		}
        		
        	}
        }
    });	
}

function md_disabled_rest_templates(){
    if( jQuery("#standard_template option[value='0']").length == 0 ){ //add value 0 for disabled select
    	jQuery('#standard_template').prepend('<option value="0">...</option>');	
    }
    if( jQuery("#special_template option[value='0']").length == 0 ){ //add value 0 for disabled select
    	jQuery('#special_template').prepend('<option value="0">...</option>');	
    }    
	jQuery('#standard_template').val('0');
	jQuery('#special_template').val('0');
	jQuery('#ism_preview_1').fadeOut(100);
	jQuery('#ism_preview_2').fadeOut(100);
	jQuery("#special_mobile_template option[value='0']").remove();
}

///preview templates
function ism_preview_templates_vc(){
    jQuery('#ism_preview').fadeOut(100);
      jQuery.ajax({
         type : "post",
         url : window.ism_base_path+'/wp-admin/admin-ajax.php',
         data : {
                    action: "ism_admin_items_preview",
                    template: jQuery('#template').val(),
                },
         success: function(response){
                jQuery('#ism_preview').html(response);
                jQuery('#ism_preview').fadeIn(600);
         }
      });
}


///preview templates
function ism_preview_templates_be(preview_id, hide_preview, disabled_id, current_id, input_name){
    jQuery(current_id+" option[value='0']").remove();//remove value 0 from current select
    if( jQuery(disabled_id+" option[value='0']").length == 0 ){ //add value 0 for disabled select
    	jQuery(disabled_id).prepend('<option value="0">...</option>');	
    }   
	jQuery(disabled_id).val('0');
	jQuery(disabled_id).removeAttr('name');	
	jQuery(hide_preview).fadeOut();
	if( jQuery("#special_mobile_template option[value='0']").length == 0 ){ 
		jQuery('#special_mobile_template').prepend('<option value="0">...</option>');	
		jQuery('#special_mobile_template').val('0');
	}else if(jQuery('#special_mobile_template').val()!='0') jQuery('#special_mobile_template').val('0');
	
	jQuery(current_id).attr('name', input_name);
    jQuery(preview_id).fadeOut(100);
    var the_template = jQuery(current_id).val();
    if(the_template=='') return;
      jQuery.ajax({
         type : "post",
         url : window.ism_base_path+'/wp-admin/admin-ajax.php',
         data : {
                    action: "ism_admin_items_preview",
                    template: the_template,
                },
         success: function(response){
                jQuery(preview_id).html(response);
                jQuery(preview_id).fadeIn(600);
         }
      });
}