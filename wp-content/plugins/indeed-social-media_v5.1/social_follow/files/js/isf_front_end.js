function isf_load_counts(i, wrapp_id, items, i_print){
	//check every time for counts
    if(typeof items[i]=='undefined') return;
    
   
    jQuery.ajax({
       type : "post",
       url : window.isf_base_path+'/wp-admin/admin-ajax.php',
       data : {
              action: "isf_return_offline_counts",
              sm_types: items
              },
       success: function(response){
	           offline_counts = jQuery.parseJSON(response);
	           isf_load_counts_rec(0, wrapp_id, items, offline_counts, i_print);
	      }
     });
}
function isf_load_counts_rec(i, wrapp_id, items, offline_counts, i_print){
	//check every time for counts
    if(typeof items[i]=='undefined') return;  
    
    var sm_time = '';
    var sm_count = '';
    if(typeof offline_counts[items[i]+'_time']!='undefined') sm_time = offline_counts[items[i]+'_time'];
    if(typeof offline_counts[items[i]+'_count']!='undefined') sm_count = offline_counts[items[i]+'_count'];
   
    jQuery.ajax({
       type : "post",
       url : window.isf_base_path+'/wp-admin/admin-ajax.php',
       data : {
              action: "isf_return_counts",
              sm_type: items[i],
              off_count: offline_counts[items[i]],
              the_time: sm_time,
              db_count: sm_count,
              },
       success: function(response){
	           num = i+1;
	           isf_load_counts_rec(num, wrapp_id, items, offline_counts, i_print);
	           num = response;
	           if(num=='') return;
	           if(isNaN(num)) num = 0; //if num is not a number
	           setNumDiv(0, parseInt(num), wrapp_id+' .'+items[i]+'_share_count-isf', i_print);   
         }
     });
}
if(typeof setNumDiv=='undefined'){
	function setNumDiv(current, max, div, i_print){
	    if(current>max) return;
	    if(i_print==0) return;
	    cnt = current;
	    if(cnt>999){
	    	if(cnt>999999){
	    		cnt = cnt/1000000;
	            type_num = 'M';
	        }else{
	        	cnt = cnt/1000;
	            type_num = 'k';
	        }
	        if(cnt<=99 && cnt%1>0.09){
	        	entire_num = cnt.toString();
	            arr = entire_num.split('.');
	            d = parseInt(arr[1][0]);
	            if(arr[1][1]>=5) d = d + 1;
	            	cnt = arr[0] +'.'+ d;
	            }else cnt = parseInt(cnt);
	            	cnt += type_num;
	            }
	  
	    jQuery(div).html(cnt);
	    setTimeout(function(){
	        step = 1;
	        if(max-current>1000) step = 500;
	        if(max-current<1001) step = 300;
	        if(max-current<501) step = 100;
	        if(max-current<101) step = 10;
	        if(max-current<11) step = 1;

	        current=current+step;
	        setNumDiv(current, max, div);
	    },1);
	}
}
