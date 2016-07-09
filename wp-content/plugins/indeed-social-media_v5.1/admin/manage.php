<?php
$url = get_admin_url() . 'admin.php?page=ism_manage';
if(isset($_REQUEST['tab'])) $tab = $_REQUEST['tab'];
else $tab = 'general_options';	

//admin functions
include_once ISM_DIR_PATH . 'admin/functions/admin_functions.php';

//header
include_once ISM_DIR_PATH . 'admin/admin_header.php';

    switch($tab){
        case "website_display":
		include_once ISM_DIR_PATH . 'admin/tabs/website_display.php'; 
    break;
    case "inside_display":
		include_once ISM_DIR_PATH . 'admin/tabs/content_display.php';
    break;
    case "shortcode":
        $type = $tab;
        include_once ISM_DIR_PATH . 'admin/tabs/shortcodes.php';
    break;
    case "shortcode_locker":
        $type = $tab;
        include_once ISM_DIR_PATH . 'admin/tabs/shortcodes.php';
    break;

    case "general_options":
		include_once ISM_DIR_PATH . 'admin/tabs/general_options.php';
    break;
    
    case 'mobile_display':
		include_once ISM_DIR_PATH . 'admin/tabs/mobile.php';
    break;
    
    case 'share_image':
			if(isset($menu_items_active[$tab]) && $menu_items_active[$tab] == 'ism-activate')
				isi_admin_page();//function availabel in indeed share image add-on 
			else
				include_once ISM_DIR_PATH . 'admin/tabs/share_image.php';
    break;
    	    
	case 'help':
		include_once ISM_DIR_PATH . 'admin/tabs/help.php';
	break;
	
	case 'slide_in':
		include_once ISM_DIR_PATH . 'admin/tabs/slide_in.php'; 
	break;
	
	case 'statistics':
		include_once ISM_DIR_PATH . 'admin/functions/statistics-functions.php';
		include_once ISM_DIR_PATH . 'admin/tabs/statistics.php';	
	break;
	
	case 'popup':
		include_once ISM_DIR_PATH . 'admin/tabs/popup.php';
	break;
	
	case 'follow':
		if(function_exists('isf_shortcode_tab')){
			isf_shortcode_tab();
		}
	break;
	
	case 'isb':
		if(isset($menu_items_active[$tab]) && $menu_items_active[$tab] == 'ism-activate')
				isb_admin_options();//function availabel in indeed Share Bar add-on 
			else
				include_once ISM_DIR_PATH . 'admin/tabs/isb.php';
	break;
	
	case 'share_point':
		if(function_exists('ism_share_icon_tab')){
			ism_share_icon_tab();
		}else{
			include_once ISM_DIR_PATH . 'admin/tabs/genie.php';
		}	
	break;
}
?>