<?php
/*
Plugin Name: WordPress CountDown Pro - WebSites/Products Launch
Description: You can use it as Countdown for WebSites with Maintenance mode enabled, for Events and Products launch or as expiry date for Offers and Discounts
Version: 1.2.4
Author: Lambert Group
Author URI: http://www.lambertgroup.ro cu http://codecanyon.net/user/LambertGroup/portfolio?ref=LambertGroup
*/

ini_set('display_errors', 0);
//$wpdb->show_errors();
$circular_countdown_path = trailingslashit(dirname(__FILE__));  //empty

//all the messages
$circular_countdown_messages = array(
		'version' => '<div class="error">WordPress CountDown Pro - WebSites/Products Launch plugin requires WordPress 3.0 or newer. <a href="http://codex.wordpress.org/Upgrading_WordPress">Please update!</a></div>',
		'empty_img' => 'Image - required',
		'invalid_request' => 'Invalid Request!',
		'generate_for_this_player' => 'You can start customizing this CountDown.',
		'data_saved' => 'Data Saved!'
	);

	
global $wp_version;

if ( !version_compare($wp_version,"3.0",">=")) {
	die ($circular_countdown_messages['version']);
}




function circular_countdown_activate() {
	//db creation, create admin options etc.
	global $wpdb;
	
	$currentY=date("Y");
	$currentM=date("n");
	$currentD=date("j");
	$currentH=date("H");
	$currentMin=date("i");
	$currentS=date("s");	
	
	//$wpdb->show_errors();

	$circular_countdown_collate = ' COLLATE utf8_general_ci';
	
	$sql0 = "CREATE TABLE `" . $wpdb->prefix . "circular_countdown_countdowns` (
			`id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
			`name` VARCHAR( 255 ) NOT NULL ,
			PRIMARY KEY ( `id` )
			) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
	
	$sql1 = "CREATE TABLE `" . $wpdb->prefix . "circular_countdown_settings` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `beginDate_date` varchar(255) NOT NULL DEFAULT '".($currentY-1).','.$currentM.','.$currentD."',
  `beginDate_hours` smallint(5) unsigned NOT NULL DEFAULT '".$currentH."',
  `beginDate_minutes` smallint(5) unsigned NOT NULL DEFAULT '".$currentMin."',
  `beginDate_seconds` smallint(5) unsigned NOT NULL DEFAULT '".$currentS."',
  `endDate_date` varchar(255) NOT NULL DEFAULT '".($currentY+1).','.$currentM.','.$currentD."',
  `endDate_hours` smallint(5) unsigned NOT NULL DEFAULT '".$currentH."',
  `endDate_minutes` smallint(5) unsigned NOT NULL DEFAULT '".$currentMin."',
  `endDate_seconds` smallint(5) unsigned NOT NULL DEFAULT '".$currentS."',  
  `servertime` varchar(8) NOT NULL DEFAULT 'true',
  `responsive` varchar(8) NOT NULL DEFAULT 'true', 
  
  `enableMaintenanceMode` varchar(8) NOT NULL DEFAULT 'false', 
  `pageBg` text,
  `pageBgHexa` varchar(8) NOT NULL DEFAULT '',
  `pageBgAdditionalCss` varchar(255) NOT NULL DEFAULT '',
  
  `pluginFontFamily` varchar(255) NOT NULL DEFAULT '\'PT Serif\', serif',
  `pluginFontFamilyGoogleLink` varchar(255) NOT NULL DEFAULT 'https://fonts.googleapis.com/css?family=PT+Serif:400,700',
  `circleRadius` smallint(5) unsigned NOT NULL DEFAULT '85',
  
  `circleLineWidth` smallint(5) unsigned NOT NULL DEFAULT '20',
  `behindCircleLineWidthExpand` smallint(5) unsigned NOT NULL DEFAULT '6',
  `circleTopBottomPadding` smallint(5) unsigned NOT NULL DEFAULT '20',
  `circleLeftRightPadding` smallint(5) unsigned NOT NULL DEFAULT '30',
  `numberSize` smallint(5) unsigned NOT NULL DEFAULT '60',
  `numberAdditionalTopPadding` smallint(5) NOT NULL DEFAULT '2',
  `textSize` smallint(5) unsigned NOT NULL DEFAULT '24',
  `textMarginTop` smallint(5) NOT NULL DEFAULT '18',
  `textPadding` smallint(5) NOT NULL DEFAULT '15',
  `lineSeparatorImg` text,
  
  `logo` text,
  `logoLink` text,
  `logoTarget` varchar(8) NOT NULL DEFAULT '_blank',
  
  
  `allCirclesTopMargin` smallint(5) NOT NULL DEFAULT '0',
  `allCirclesBottomMargin` smallint(5) NOT NULL DEFAULT '80',
  
  `divBackgroundDaysHexa` varchar(8) NOT NULL DEFAULT '',
  `divBackgroundDaysImg` text,
  `borderTopColorDays` varchar(8) NOT NULL DEFAULT '',
  `borderRightColorDays` varchar(8) NOT NULL DEFAULT '',
  `borderBottomColorDays` varchar(8) NOT NULL DEFAULT '',
  `borderLeftColorDays` varchar(8) NOT NULL DEFAULT '',
  `circleColorDays` varchar(8) NOT NULL DEFAULT 'dd1e2f',
  `circleAlphaDays` smallint(5) unsigned NOT NULL DEFAULT '100',
  `behindCircleColorDays` varchar(8) NOT NULL DEFAULT '000000',
  `behindCircleAlphaDays` smallint(5) unsigned NOT NULL DEFAULT '30',
  `numberColorDays` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textColorDays` varchar(8) NOT NULL DEFAULT '6f6f6f',
  `textBackgroundDaysHexa` varchar(8) NOT NULL DEFAULT '',
  `textBackgroundDaysImg` text,
  `translateDays` varchar(255) DEFAULT 'DAYS',
  

  `divBackgroundHoursHexa` varchar(8) NOT NULL DEFAULT '',
  `divBackgroundHoursImg` text,
  `borderTopColorHours` varchar(8) NOT NULL DEFAULT '',
  `borderRightColorHours` varchar(8) NOT NULL DEFAULT '',
  `borderBottomColorHours` varchar(8) NOT NULL DEFAULT '',
  `borderLeftColorHours` varchar(8) NOT NULL DEFAULT '',
  `circleColorHours` varchar(8) NOT NULL DEFAULT 'ebb035',
  `circleAlphaHours` smallint(5) unsigned NOT NULL DEFAULT '100',
  `behindCircleColorHours` varchar(8) NOT NULL DEFAULT '000000',
  `behindCircleAlphaHours` smallint(5) unsigned NOT NULL DEFAULT '30',
  `numberColorHours` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textColorHours` varchar(8) NOT NULL DEFAULT '6f6f6f',
  `textBackgroundHoursHexa` varchar(8) NOT NULL DEFAULT '',
  `textBackgroundHoursImg` text,
  `translateHours` varchar(255) DEFAULT 'HOURS',
  

  `divBackgroundMinutesHexa` varchar(8) NOT NULL DEFAULT '',
  `divBackgroundMinutesImg` text,
  `borderTopColorMinutes` varchar(8) NOT NULL DEFAULT '',
  `borderRightColorMinutes` varchar(8) NOT NULL DEFAULT '',
  `borderBottomColorMinutes` varchar(8) NOT NULL DEFAULT '',
  `borderLeftColorMinutes` varchar(8) NOT NULL DEFAULT '',
  `circleColorMinutes` varchar(8) NOT NULL DEFAULT '06a2cb',
  `circleAlphaMinutes` smallint(5) unsigned NOT NULL DEFAULT '100',
  `behindCircleColorMinutes` varchar(8) NOT NULL DEFAULT '000000',
  `behindCircleAlphaMinutes` smallint(5) unsigned NOT NULL DEFAULT '30',
  `numberColorMinutes` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textColorMinutes` varchar(8) NOT NULL DEFAULT '6f6f6f',
  `textBackgroundMinutesHexa` varchar(8) NOT NULL DEFAULT '',
  `textBackgroundMinutesImg` text,
  `translateMinutes` varchar(255) DEFAULT 'MINUTES',
  
  
  

  `divBackgroundSecondsHexa` varchar(8) NOT NULL DEFAULT '',
  `divBackgroundSecondsImg` text,
  `borderTopColorSeconds` varchar(8) NOT NULL DEFAULT '',
  `borderRightColorSeconds` varchar(8) NOT NULL DEFAULT '',
  `borderBottomColorSeconds` varchar(8) NOT NULL DEFAULT '',
  `borderLeftColorSeconds` varchar(8) NOT NULL DEFAULT '',
  `circleColorSeconds` varchar(8) NOT NULL DEFAULT '218559',
  `circleAlphaSeconds` smallint(5) unsigned NOT NULL DEFAULT '100',
  `behindCircleColorSeconds` varchar(8) NOT NULL DEFAULT '000000',
  `behindCircleAlphaSeconds` smallint(5) unsigned NOT NULL DEFAULT '30',
  `numberColorSeconds` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `textColorSeconds` varchar(8) NOT NULL DEFAULT '6f6f6f',
  `textBackgroundSecondsHexa` varchar(8) NOT NULL DEFAULT '',
  `textBackgroundSecondsImg` text,
  `translateSeconds` varchar(255) DEFAULT 'SECONDS',
  
  
  `socialBgOFF` text,
  `socialBgON` text,
  
  `complete` text,
  `autoReset24h` varchar(8) NOT NULL DEFAULT 'false',
  
  `h2Text` text,  
  `h2Size` smallint(5) unsigned NOT NULL DEFAULT '36',
  `h2Color` varchar(8) NOT NULL DEFAULT 'FFFFFF',
  `h2Weight` varchar(255) NOT NULL DEFAULT 'bold',  
  `h2TopMargin` smallint(5) NOT NULL DEFAULT '60',
  
  `h3Text` text,  
  `h3Size` smallint(5) unsigned NOT NULL DEFAULT '24',
  `h3Color` varchar(8) NOT NULL DEFAULT '6f6f6f',
  `h3Weight` varchar(255) NOT NULL DEFAULT 'normal',  
  `h3TopMargin` smallint(5) NOT NULL DEFAULT '0',
  
  `h4Text` text,  
  `h4Size` smallint(5) unsigned NOT NULL DEFAULT '14',
  `h4Color` varchar(8) NOT NULL DEFAULT '6f6f6f',
  `h4Weight` varchar(255) NOT NULL DEFAULT 'normal',  
  `h4TopMargin` smallint(5) NOT NULL DEFAULT '15',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
	
	$sql2 = "CREATE TABLE `". $wpdb->prefix . "circular_countdown_playlist` (
	  `id` int(10) unsigned NOT NULL auto_increment,
	  `countdownid` int(10) unsigned NOT NULL,
	  `img` text,
	  `title` text,
	  `data-link` text,
	  `data-target` varchar(8),
	  `ord` int(10) unsigned NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
	

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	dbDelta($sql0.$circular_countdown_collate);
	dbDelta($sql1.$circular_countdown_collate);
	//echo $wpdb->last_query;
	dbDelta($sql2.$circular_countdown_collate);


	
	//initialize the countdowns table with the first countdown type
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."circular_countdown_countdowns;" );
	if (!$rows_count) {
		$wpdb->insert( 
			$wpdb->prefix . "circular_countdown_countdowns", 
			array( 
				'name' => 'First CountDown'
			), 
			array(
				'%s'			
			) 
		);	
	}	
	
	// initialize the settings
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."circular_countdown_settings;" );
	if (!$rows_count) {
		circular_countdown_insert_settings_record(1);
	}	
	
	
	// initialize the playlist/ social channels
	$rows_count = $wpdb->get_var( "SELECT COUNT(*) FROM ". $wpdb->prefix ."circular_countdown_settings;" );
	if (!$rows_count) {
		circular_countdown_insert_settings_record(1);
	}	
	//echo $wpdb->last_query;
	
}


function circular_countdown_uninstall() {
	global $wpdb;
	mysql_query("DROP TABLE `" . $wpdb->prefix . "circular_countdown_settings`" );
	mysql_query("DROP TABLE `" . $wpdb->prefix . "circular_countdown_playlist`" );
	mysql_query("DROP TABLE `" . $wpdb->prefix . "circular_countdown_countdowns`" );
}

function circular_countdown_insert_settings_record($countdown_id) {
	global $wpdb;
	$wpdb->insert( 
			$wpdb->prefix . "circular_countdown_settings", 
			array( 
				'socialBgOFF' => plugins_url() . '/circular_countdown/circular_countdown/circular_countdown_images/social_icons/socialCircleOFF.png',
				'socialBgON' => plugins_url() . '/circular_countdown/circular_countdown/circular_countdown_images/social_icons/socialCircleON.png',
				'lineSeparatorImg' => plugins_url() . '/circular_countdown/circular_countdown/circular_countdown_images/line.png',
				'h2Text' => 'UNDER CONSTRUCTION!',
				'h3Text' => 'Let\'s meet in:',
				'h4Text' => 'Until then, enjoy our social channels'
			), 
			array( 
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			) 
		);
}


function circular_countdown_init_sessions() {
	global $wpdb;
	if (is_admin()) { 
		if (!session_id()) {
			session_start();
			
			//initialize the session
			if (!isset($_SESSION['xid'])) {
				$safe_sql="SELECT * FROM (".$wpdb->prefix ."circular_countdown_countdowns) LIMIT 0, 1";
				$row = $wpdb->get_row($safe_sql,ARRAY_A);
				//$row=circular_countdown_unstrip_array($row);		
				$_SESSION['xid'] = $row['id'];
				$_SESSION['xname'] = $row['name'];
			}		
		}
	}
}


function circular_countdown_load_styles() {
	global $wpdb;
	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) {
		$page = (isset($_GET['page'])) ? $_GET['page'] : '';
		if(preg_match('/circular_countdown/i', $page)) {
			
			/*wp_enqueue_style('circular_countdown_jquery-custom_css', plugins_url('css/custom-theme/jquery-ui-1.8.10.custom.css', __FILE__));*/
			wp_enqueue_style('lbg-jquery-ui-custom_css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/pepper-grinder/jquery-ui.min.css');
			wp_enqueue_style('circular_countdown_css', plugins_url('css/styles.css', __FILE__));
			wp_enqueue_style('circular_countdown_colorpicker_css', plugins_url('css/colorpicker/colorpicker.css', __FILE__));
			
			
			wp_enqueue_style('thickbox');
			
		}
	} else if (!is_admin()) { //loads css in front-end
		wp_enqueue_style('circular_countdown_site_css', plugins_url('circular_countdown/circularCountdown.css', __FILE__));
	}
}

function circular_countdown_load_scripts() {
	global $is_IE;
	$page = (isset($_GET['page'])) ? $_GET['page'] : '';
	if(preg_match('/circular_countdown/i', $page)) {
		//loads scripts in admin
		//if (is_admin()) {
			//wp_deregister_script('jquery');
			/*wp_register_script('lbg-admin-jquery', plugins_url('js/jquery-1.5.1.js', __FILE__));
			wp_enqueue_script('lbg-admin-jquery');*/
			/*wp_deregister_script('jquery-ui-core');
			wp_deregister_script('jquery-ui-widget');
			wp_deregister_script('jquery-ui-circular_countdown');
			wp_deregister_script('jquery-ui-accordion');
			wp_deregister_script('jquery-ui-autocomplete');
			wp_deregister_script('jquery-ui-slider');
			wp_deregister_script('jquery-ui-tabs');
			wp_deregister_script('jquery-ui-sortable');
			wp_deregister_script('jquery-ui-draggable');
			wp_deregister_script('jquery-ui-droppable');
			wp_deregister_script('jquery-ui-selectable');
			wp_deregister_script('jquery-ui-position');
			wp_deregister_script('jquery-ui-datepicker');
			wp_deregister_script('jquery-ui-resizable');
			wp_deregister_script('jquery-ui-dialog');
			wp_deregister_script('jquery-ui-button');	*/			
			
			wp_enqueue_script('jquery');
			
			//wp_register_script('lbg-admin-jquery-ui-min', plugins_url('js/jquery-ui-1.8.10.custom.min.js', __FILE__));
			//wp_register_script('lbg-admin-jquery-ui-min', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js');
			/*wp_register_script('lbg-admin-jquery-ui-min', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
			wp_enqueue_script('lbg-admin-jquery-ui-min');*/
			
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-autocomplete');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-button');/***************************/
			
			wp_enqueue_script('jquery-form');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('jquery-masonry');
			wp_enqueue_script('jquery-ui-progressbar');
			wp_enqueue_script('jquery-ui-tooltip');
			
			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-effects-blind');
			wp_enqueue_script('jquery-effects-bounce');
			wp_enqueue_script('jquery-effects-clip');
			wp_enqueue_script('jquery-effects-drop');
			wp_enqueue_script('jquery-effects-explode');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('jquery-effects-fold');
			wp_enqueue_script('jquery-effects-highlight');
			wp_enqueue_script('jquery-effects-pulsate');
			wp_enqueue_script('jquery-effects-scale');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('jquery-effects-slide');			
			wp_enqueue_script('jquery-effects-transfer');			
			
			wp_register_script('my-colorpicker', plugins_url('js/colorpicker/colorpicker.js', __FILE__));
			wp_enqueue_script('my-colorpicker');	

			wp_register_script('lbg-admin-toggle', plugins_url('js/myToggle.js', __FILE__));
			wp_enqueue_script('lbg-admin-toggle');
			

			/*wp_enqueue_script('media-upload');*/   //old
			wp_enqueue_script('media-upload'); // before w.p 3.5
			wp_enqueue_media();// from w.p 3.5			
			wp_enqueue_script('thickbox');		
			
			/*wp_register_script('lbg-touch', plugins_url('classic/js/jquery.ui.touch-punch.min.js', __FILE__));
			wp_enqueue_script('lbg-touch');		
			
			wp_register_script('lbg-circular_countdown', plugins_url('classic\js\parallax_classic.js', __FILE__));
			wp_enqueue_script('lbg-circular_countdown');	*/		
			
		
		//}
		
		//wp_enqueue_script('jquery');
		//wp_enqueue_script('jquery-ui-core');
		//wp_enqueue_script('jquery-ui-sortable');
		//wp_enqueue_script('thickbox');
		//wp_enqueue_script('media-upload');
		//wp_enqueue_script('farbtastic');
	} else if (!is_admin()) { //loads scripts in front-end
			/*wp_deregister_script('jquery-ui-core');
			wp_deregister_script('jquery-ui-widget');
			wp_deregister_script('jquery-ui-circular_countdown');
			wp_deregister_script('jquery-ui-accordion');
			wp_deregister_script('jquery-ui-autocomplete');
			wp_deregister_script('jquery-ui-slider');
			wp_deregister_script('jquery-ui-tabs');
			wp_deregister_script('jquery-ui-sortable');
			wp_deregister_script('jquery-ui-draggable');
			wp_deregister_script('jquery-ui-droppable');
			wp_deregister_script('jquery-ui-selectable');
			wp_deregister_script('jquery-ui-position');
			wp_deregister_script('jquery-ui-datepicker');
			wp_deregister_script('jquery-ui-resizable');
			wp_deregister_script('jquery-ui-dialog');
			wp_deregister_script('jquery-ui-button');
			wp_deregister_script('jquery-effects-core');*/	
	
		wp_enqueue_script('jquery');
	
		//wp_enqueue_script('jquery-ui-core');
		
		//wp_register_script('lbg-jquery-ui-min', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js');
		/*wp_register_script('lbg-jquery-ui-min', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js');
		wp_enqueue_script('lbg-jquery-ui-min');*/
		
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-accordion');
			wp_enqueue_script('jquery-ui-autocomplete');
			wp_enqueue_script('jquery-ui-slider');
			wp_enqueue_script('jquery-ui-tabs');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-droppable');
			wp_enqueue_script('jquery-ui-selectable');
			wp_enqueue_script('jquery-ui-position');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('jquery-ui-resizable');
			wp_enqueue_script('jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-button');/***************************/
			
			wp_enqueue_script('jquery-form');
			wp_enqueue_script('jquery-color');
			wp_enqueue_script('jquery-masonry');
			wp_enqueue_script('jquery-ui-progressbar');
			wp_enqueue_script('jquery-ui-tooltip');
			
			wp_enqueue_script('jquery-effects-core');
			wp_enqueue_script('jquery-effects-blind');
			wp_enqueue_script('jquery-effects-bounce');
			wp_enqueue_script('jquery-effects-clip');
			wp_enqueue_script('jquery-effects-drop');
			wp_enqueue_script('jquery-effects-explode');
			wp_enqueue_script('jquery-effects-fade');
			wp_enqueue_script('jquery-effects-fold');
			wp_enqueue_script('jquery-effects-highlight');
			wp_enqueue_script('jquery-effects-pulsate');
			wp_enqueue_script('jquery-effects-scale');
			wp_enqueue_script('jquery-effects-shake');
			wp_enqueue_script('jquery-effects-slide');			
			wp_enqueue_script('jquery-effects-transfer');		
	
		
		wp_register_script('lbg-logocountdown', plugins_url('circular_countdown\js\circularCountdown.js', __FILE__));
		wp_enqueue_script('lbg-logocountdown');		

		

	}
	
	
	

}



// adds the menu pages
function circular_countdown_plugin_menu() {
	add_menu_page('COUNTDOWN-PRO Admin Interface', 'COUNTDOWN PRO', 'edit_posts', 'circular_countdown', 'circular_countdown_overview_page',
	plugins_url('images/plg_icon.png', __FILE__));
	add_submenu_page( 'circular_countdown', 'COUNTDOWN-PRO Overview', 'Overview', 'edit_posts', 'circular_countdown', 'circular_countdown_overview_page');
	add_submenu_page( 'circular_countdown', 'COUNTDOWN-PRO Manage CountDowns', 'Manage CountDowns', 'edit_posts', 'circular_countdown_Manage_CountDowns', 'circular_countdown_manage_countdowns_page');
	add_submenu_page( 'circular_countdown', 'COUNTDOWN-PRO Manage CountDowns Add New', 'Add New', 'edit_posts', 'circular_countdown_Add_New', 'circular_countdown_manage_countdowns_add_new_page');
	add_submenu_page( 'circular_countdown_Manage_CountDowns', 'COUNTDOWN-PRO CountDown Settings', 'CountDown Settings', 'edit_posts', 'circular_countdown_Settings', 'circular_countdown_settings_page');
	add_submenu_page( 'circular_countdown_Manage_CountDowns', 'COUNTDOWN-PRO CountDown Playlist', 'Playlist', 'edit_posts', 'circular_countdown_Playlist', 'circular_countdown_playlist_page');
	add_submenu_page( 'circular_countdown', 'COUNTDOWN-PRO Help', 'Help', 'edit_posts', 'circular_countdown_Help', 'circular_countdown_help_page');
}


//HTML content for overview page
function circular_countdown_overview_page()
{
	include_once($circular_countdown_path . 'tpl/overview.php');
}

//HTML content for Manage Banners
function circular_countdown_manage_countdowns_page()
{
	global $wpdb;
	global $circular_countdown_messages;
	
	//delete countdown
	if (isset($_GET['id'])) {
		

		

		//delete from wp_circular_countdown_countdowns
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."circular_countdown_countdowns WHERE id = %d",$_GET['id']));
		
		//delete from wp_circular_countdown_settings
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."circular_countdown_settings WHERE id = %d",$_GET['id']));
		
	
		//delete from wp_circular_countdown_playlist
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."circular_countdown_playlist WHERE countdownid = %d",$_GET['id']));
		
		//initialize the session
		$safe_sql="SELECT * FROM (".$wpdb->prefix ."circular_countdown_countdowns) ORDER BY id";
		$row = $wpdb->get_row($safe_sql,ARRAY_A);
		$row=circular_countdown_unstrip_array($row);
		if ($row['id']) {
			$_SESSION['xid']=$row['id'];
			$_SESSION['xname']=$row['name'];
		}		
	}
	
	
	if ($_GET['duplicate_id']!='') {	
			//countdowns
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."circular_countdown_countdowns ( `name` ) SELECT `name` FROM (".$wpdb->prefix ."circular_countdown_countdowns) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);			
			$countdownid=$wpdb->insert_id;
			

			
			
			//settings
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."circular_countdown_settings (`beginDate_date`, `beginDate_hours`, `beginDate_minutes`, `beginDate_seconds`, `endDate_date`, `endDate_hours`, `endDate_minutes`, `endDate_seconds`, `servertime`, `responsive`, `enableMaintenanceMode`, `pageBg`, `pageBgHexa`, `pluginFontFamily`, `pluginFontFamilyGoogleLink`, `circleRadius`, `circleLineWidth`, `behindCircleLineWidthExpand`, `circleTopBottomPadding`, `circleLeftRightPadding`, `numberSize`, `numberAdditionalTopPadding`, `textSize`, `textMarginTop`, `textPadding`, `lineSeparatorImg`, `logo`, `logoLink`, `logoTarget`, `allCirclesTopMargin`, `allCirclesBottomMargin`, `divBackgroundDaysHexa`, `divBackgroundDaysImg`, `borderTopColorDays`, `borderRightColorDays`, `borderBottomColorDays`, `borderLeftColorDays`, `circleColorDays`, `circleAlphaDays`, `behindCircleColorDays`, `behindCircleAlphaDays`, `numberColorDays`, `textColorDays`, `textBackgroundDaysHexa`, `textBackgroundDaysImg`, `translateDays`, `divBackgroundHoursHexa`, `divBackgroundHoursImg`, `borderTopColorHours`, `borderRightColorHours`, `borderBottomColorHours`, `borderLeftColorHours`, `circleColorHours`, `circleAlphaHours`, `behindCircleColorHours`, `behindCircleAlphaHours`, `numberColorHours`, `textColorHours`, `textBackgroundHoursHexa`, `textBackgroundHoursImg`, `translateHours`, `divBackgroundMinutesHexa`, `divBackgroundMinutesImg`, `borderTopColorMinutes`, `borderRightColorMinutes`, `borderBottomColorMinutes`, `borderLeftColorMinutes`, `circleColorMinutes`, `circleAlphaMinutes`, `behindCircleColorMinutes`, `behindCircleAlphaMinutes`, `numberColorMinutes`, `textColorMinutes`, `textBackgroundMinutesHexa`, `textBackgroundMinutesImg`, `translateMinutes`, `divBackgroundSecondsHexa`, `divBackgroundSecondsImg`, `borderTopColorSeconds`, `borderRightColorSeconds`, `borderBottomColorSeconds`, `borderLeftColorSeconds`, `circleColorSeconds`, `circleAlphaSeconds`, `behindCircleColorSeconds`, `behindCircleAlphaSeconds`, `numberColorSeconds`, `textColorSeconds`, `textBackgroundSecondsHexa`, `textBackgroundSecondsImg`, `translateSeconds`, `socialBgOFF`, `socialBgON`, `complete`, `autoReset24h`,`h2Text`, `h2Size`, `h2Color`, `h2Weight`, `h2TopMargin`, `h3Text`, `h3Size`, `h3Color`, `h3Weight`, `h3TopMargin`, `h4Text`, `h4Size`, `h4Color`, `h4Weight`, `h4TopMargin`  ) SELECT `beginDate_date`, `beginDate_hours`, `beginDate_minutes`, `beginDate_seconds`, `endDate_date`, `endDate_hours`, `endDate_minutes`, `endDate_seconds`, `servertime`, `responsive`, `enableMaintenanceMode`, `pageBg`, `pageBgHexa`, `pluginFontFamily`, `pluginFontFamilyGoogleLink`, `circleRadius`, `circleLineWidth`, `behindCircleLineWidthExpand`, `circleTopBottomPadding`, `circleLeftRightPadding`, `numberSize`, `numberAdditionalTopPadding`, `textSize`, `textMarginTop`, `textPadding`, `lineSeparatorImg`, `logo`, `logoLink`, `logoTarget`, `allCirclesTopMargin`, `allCirclesBottomMargin`, `divBackgroundDaysHexa`, `divBackgroundDaysImg`, `borderTopColorDays`, `borderRightColorDays`, `borderBottomColorDays`, `borderLeftColorDays`, `circleColorDays`, `circleAlphaDays`, `behindCircleColorDays`, `behindCircleAlphaDays`, `numberColorDays`, `textColorDays`, `textBackgroundDaysHexa`, `textBackgroundDaysImg`, `translateDays`, `divBackgroundHoursHexa`, `divBackgroundHoursImg`, `borderTopColorHours`, `borderRightColorHours`, `borderBottomColorHours`, `borderLeftColorHours`, `circleColorHours`, `circleAlphaHours`, `behindCircleColorHours`, `behindCircleAlphaHours`, `numberColorHours`, `textColorHours`, `textBackgroundHoursHexa`, `textBackgroundHoursImg`, `translateHours`, `divBackgroundMinutesHexa`, `divBackgroundMinutesImg`, `borderTopColorMinutes`, `borderRightColorMinutes`, `borderBottomColorMinutes`, `borderLeftColorMinutes`, `circleColorMinutes`, `circleAlphaMinutes`, `behindCircleColorMinutes`, `behindCircleAlphaMinutes`, `numberColorMinutes`, `textColorMinutes`, `textBackgroundMinutesHexa`, `textBackgroundMinutesImg`, `translateMinutes`, `divBackgroundSecondsHexa`, `divBackgroundSecondsImg`, `borderTopColorSeconds`, `borderRightColorSeconds`, `borderBottomColorSeconds`, `borderLeftColorSeconds`, `circleColorSeconds`, `circleAlphaSeconds`, `behindCircleColorSeconds`, `behindCircleAlphaSeconds`, `numberColorSeconds`, `textColorSeconds`, `textBackgroundSecondsHexa`, `textBackgroundSecondsImg`, `translateSeconds`, `socialBgOFF`, `socialBgON`, `complete`, `autoReset24h`, `h2Text`, `h2Size`, `h2Color`, `h2Weight`, `h2TopMargin`, `h3Text`, `h3Size`, `h3Color`, `h3Weight`, `h3TopMargin`, `h4Text`, `h4Size`, `h4Color`, `h4Weight`, `h4TopMargin`  FROM (".$wpdb->prefix ."circular_countdown_settings) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);
			
			//playlist
			$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."circular_countdown_playlist) WHERE countdownid = %d",$_GET['duplicate_id'] );
			$result = $wpdb->get_results($safe_sql,ARRAY_A);
			foreach ( $result as $row_playlist ) {
				$row_playlist=circular_countdown_unstrip_array($row_playlist);
				
				$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."circular_countdown_playlist ( `countdownid` ,`img` ,`title` ,`data-link` ,`data-target` ,`ord` ) SELECT ".$countdownid." ,`img` ,`title` ,`data-link` ,`data-target` ,`ord` FROM (".$wpdb->prefix ."circular_countdown_playlist) WHERE id = %d",$row_playlist['id'] );
				$wpdb->query($safe_sql);	
				$photoid=$wpdb->insert_id;			
				//echo $wpdb->last_query;

			}
			

			
			//maintenance mode
			$safe_sql=$wpdb->prepare( "SELECT enableMaintenanceMode FROM (".$wpdb->prefix ."circular_countdown_settings) WHERE id = %d",$_GET['duplicate_id'] );
			$row = $wpdb->get_row($safe_sql,ARRAY_A);
			$row=circular_countdown_unstrip_array($row);
			if ($row['enableMaintenanceMode']=='true') {
				$wpdb->update( 
					$wpdb->prefix .'circular_countdown_settings', 
					array( 'enableMaintenanceMode' => 'false' ),
					array( 'id' => $_GET['duplicate_id'] ),
					array( '%s' ),
					array( '%d' ) 
				);
				//$wpdb->query( $wpdb->prepare(" UPDATE ".$wpdb->prefix ."circular_countdown_settings SET enableMaintenanceMode='false' WHERE 1 = 1") );
			}

	}	
	
	$safe_sql="SELECT * FROM (".$wpdb->prefix ."circular_countdown_countdowns) ORDER BY id";
	$result = $wpdb->get_results($safe_sql,ARRAY_A);	
	include_once($circular_countdown_path . 'tpl/countdowns.php');

}


//HTML content for Manage Banners - Add New
function circular_countdown_manage_countdowns_add_new_page()
{
	global $wpdb;
	global $circular_countdown_messages;
	
	if($_POST['Submit'] == 'Add New') {
		$errors_arr=array();
		if (empty($_POST['name']))
			$errors_arr[]=$circular_countdown_messages['empty_name'];

		if (count($errors_arr)) { 
				include_once($circular_countdown_path . 'tpl/add_countdown.php'); ?>
				<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
		  	<?php } else { // no errors
					$wpdb->insert( 
						$wpdb->prefix . "circular_countdown_countdowns", 
						array( 
							'name' => $_POST['name']
						), 
						array( 
							'%s'			
						) 
					);	
					//insert default CountDown Settings for this new CountDown
					circular_countdown_insert_settings_record($wpdb->insert_id);
					?>
						<div class="wrap">
							<div id="lbg_logo">
								<h2>Manage CountDowns - Add New CountDown</h2>
				 			</div>
							<div id="message" class="updated"><p><?php echo $circular_countdown_messages['data_saved'];?></p><p><?php echo $circular_countdown_messages['generate_for_this_countdown'];?></p></div>
							<div>
								<p>&raquo; <a href="?page=circular_countdown_Add_New">Add New (CountDown)</a></p>
								<p>&raquo; <a href="?page=circular_countdown_Manage_CountDowns">Back to Manage CountDowns</a></p>
							</div>
						</div>	
		  	<?php }			
	} else {
		include_once($circular_countdown_path . 'tpl/add_countdown.php');
	}

}


//HTML content for countdownsettings
function circular_countdown_settings_page()
{
	global $wpdb;
	global $circular_countdown_messages;
	
	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}

	//$wpdb->show_errors();
	/*if (check_admin_referer('circular_countdown_settings_update')) {
		echo "update";		
	}*/
	
	if($_POST['Submit'] == 'Update Settings') {
		
		//maintenance mode
		if ($_POST['enableMaintenanceMode']=='true') {
			$wpdb->query("UPDATE ".$wpdb->prefix ."circular_countdown_settings SET enableMaintenanceMode='false' WHERE 1 = 1");
		}
		
		$_GET['xmlf']='';
		$except_arr=array('Submit','name','page_scroll_to_id_instances');

			$wpdb->update( 
				$wpdb->prefix .'circular_countdown_countdowns', 
				array( 
				'name' => $_POST['name']
				), 
				array( 'id' => $_SESSION['xid'] )
			);	
			$_SESSION['xname']=stripslashes($_POST['name']);
						
			
			foreach ($_POST as $key=>$val){
				if (in_array($key,$except_arr)) {
					unset($_POST[$key]);
				}
			}
		
			$wpdb->update( 
				$wpdb->prefix .'circular_countdown_settings', 
				$_POST, 
				array( 'id' => $_SESSION['xid'] )
			);
			//echo $wpdb->last_query;
			?>
			<div id="message" class="updated"><p><?php echo $circular_countdown_messages['data_saved'];?></p></div>
	<?php 
		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
	}
	

	
	//echo "WP_PLUGIN_URL: ".WP_PLUGIN_URL;
	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."circular_countdown_settings) WHERE id = %d",$_SESSION['xid'] );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=circular_countdown_unstrip_array($row);
	$_POST = $row; 
	//$_POST['existingWatermarkPath']=$_POST['watermarkPath'];
	$_POST=circular_countdown_unstrip_array($_POST);

	include_once($circular_countdown_path . 'tpl/settings_form.php');

}

function circular_countdown_playlist_page()
{
	global $wpdb;
	global $circular_countdown_messages;
	//$wpdb->show_errors();
	
	if (isset($_GET['id']) && isset($_GET['name'])) {
		$_SESSION['xid']=$_GET['id'];
		$_SESSION['xname']=$_GET['name'];
	}	

	
	if ($_GET['xmlf']=='add_playlist_record') {
		if($_POST['Submit'] == 'Add Record') {
			$errors_arr=array();
			/*if (empty($_POST['img']))
				 $errors_arr[]=$circular_countdown_messages['empty_img'];*/

				 	
		if (count($errors_arr)) {
			include_once($circular_countdown_path . 'tpl/add_playlist_record.php'); ?>
			<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	  	<?php } else { // no upload errors
				$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."circular_countdown_playlist WHERE countdownid = %d",$_SESSION['xid'] ) );

				$wpdb->insert( 
					$wpdb->prefix . "circular_countdown_playlist", 
					array( 
						'countdownid' => $_POST['countdownid'],
						'img' => $_POST['img'],
						'title' => $_POST['title'],
						'data-link' => $_POST['data-link'],
						'data-target' => $_POST['data-target'],
						'ord' => $max_ord
					), 
					array( 
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%d'			
					) 
				);	
				
	  			if (isset($_POST['setitfirst'])) {
					$sql_arr=array();
					$ord_start=$max_ord;
					$ord_stop=1;
					$elem_id=$wpdb->insert_id;
					$ord_direction='+1';

					$sql_arr[]="UPDATE ".$wpdb->prefix."circular_countdown_playlist SET ord=ord+1  WHERE countdownid = ".$_SESSION['xid']." and ord>=".$ord_stop." and ord<".$ord_start;
					$sql_arr[]="UPDATE ".$wpdb->prefix."circular_countdown_playlist SET ord=".$ord_stop." WHERE id=".$elem_id;		
					
					//echo "elem_id: ".$elem_id."----ord_start: ".$ord_start."----ord_stop: ".$ord_stop;
					foreach ($sql_arr as $sql)
						$wpdb->query($sql);				
				}				
				?>
					<div class="wrap">
						<div id="lbg_logo">
							<h2>Social Channels for CountDown: <span style="color:#FF0000; font-weight:bold;"><?php echo strip_tags($_SESSION['xname'])?> - ID #<?php echo strip_tags($_SESSION['xid'])?></span> - Add New</h2>
			 			</div>
						<div id="message" class="updated"><p><?php echo $circular_countdown_messages['data_saved'];?></p></div>
						<div>
							<p>&raquo; <a href="?page=circular_countdown_Playlist&xmlf=add_playlist_record">Add New</a></p>
							<p>&raquo; <a href="?page=circular_countdown_Playlist">Back to Social Channels List</a></p>
						</div>
					</div>	
	  	<?php 
				writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
			}
		} else {
			include_once($circular_countdown_path . 'tpl/add_playlist_record.php');	
		}
		
	} else {
		if ($_GET['duplicate_id']!='') {			
			$max_ord = 1+$wpdb->get_var( $wpdb->prepare( "SELECT max(ord) FROM ". $wpdb->prefix ."circular_countdown_playlist WHERE countdownid = %d",$_SESSION['xid'] ) );
			$safe_sql=$wpdb->prepare( "INSERT INTO ".$wpdb->prefix ."circular_countdown_playlist ( `countdownid` ,`img` ,`title` , `data-link` ,`data-target` ,`ord` ) SELECT `countdownid` ,`img` ,`title` ,`data-link` ,`data-target` ,".$max_ord." FROM (".$wpdb->prefix ."circular_countdown_playlist) WHERE id = %d",$_GET['duplicate_id'] );
			$wpdb->query($safe_sql);			
			$lastID=$wpdb->insert_id;
			//echo $wpdb->last_query;
			
			//header("Location: http://localhost/!wordpress/work/wp-admin/admin.php?page=circular_countdown_Playlist&amp;id=".$_SESSION['xid']."&amp;name=".$_SESSION['xname']);
			//exit();
			writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
			echo "<script>location.href='?page=circular_countdown_Playlist&id=".$_SESSION['xid']."&name=".$_SESSION['xname']."'</script>";			
		}
		
		$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."circular_countdown_playlist) WHERE countdownid = %d ORDER BY ord",$_SESSION['xid'] );
		$result = $wpdb->get_results($safe_sql,ARRAY_A);
		
		/*$safe_sql=$wpdb->prepare( "SELECT width,height FROM (".$wpdb->prefix ."circular_countdown_settings) WHERE id = %d",$_SESSION['xid'] );
		$row_settings = $wpdb->get_row($safe_sql);		*/
		
		//$_POST=circular_countdown_unstrip_array($_POST);		
		include_once($circular_countdown_path . 'tpl/playlist.php');
	}
}





function circular_countdown_help_page()
{
	//include_once(plugins_url('tpl/help.php', __FILE__));
	include_once($circular_countdown_path . 'tpl/help.php');
}

function circular_countdown_generate_preview_code($countdownID) {
	global $wpdb;
	
	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."circular_countdown_settings) WHERE id = %d",$countdownID );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=circular_countdown_unstrip_array($row);
	//echo $wpdb->last_query;

		
	$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."circular_countdown_playlist) WHERE countdownid = %d ORDER BY ord",$countdownID );
	$result = $wpdb->get_results($safe_sql,ARRAY_A);
	$playlist_str='';
	foreach ( $result as $row_playlist ) {

		$row_playlist=circular_countdown_unstrip_array($row_playlist);

		$img_over='';
		if ($row_playlist['img']!='') {
			if (strpos($row_playlist['img'], 'wp-content',9)===false)
				list($width, $height, $type, $attr) = getimagesize($row_playlist['img']);
			else
				list($width, $height, $type, $attr) = getimagesize( ABSPATH.substr($row_playlist['img'],strpos($row_playlist['img'], 'wp-content',9)) );
			$img_over='<img src="'.$row_playlist['img'].'" width="'.$width.'" height="'.$height.'" alt="'.$row_playlist['title'].'"  title="'.$row_playlist['title'].'" />';
			//$img_over='<img src="'.$row_playlist['img'].'" width="'.$width.'" height="'.$height.'" style="width:'.$width.'px; height:'.$height.'px;" alt="'.$row_playlist['title'].'"  title="'.$row_playlist['title'].'" />';		
		}
	

		$playlist_str.='<li><a href="'.$row_playlist['data-link'].'" target="'.$row_playlist['data-target'].'">'.$img_over.'</a></li>';

	}
	
	$currentY=date("Y");
	$currentM=date("n");
	$currentD=date("j");
	$currentH=date("H");
	$currentMin=date("i");
	$currentS=date("s");
	
	$servertime='';
	if ($row["servertime"]=='true') {
		$servertime=$currentY.','.$currentM.','.$currentD.','.$currentH.','.$currentMin.','.$currentS;
	}
	
	$the_logo='';
	if ($row["logo"]!='') {
		$the_logo='<div class="logoDiv">'.(($row["logoLink"]!='')?'<a href="'.$row["logoLink"].'" target="'.$row["logoTarget"].'">':'').'<img src="'.$row["logo"].'" alt="logo" border="0" />'.(($row["logoLink"]!='')?'</a>':'').'</div>';
	}
	
	$the_h2='';
	if ($row["h2Text"]!='') {
		$the_h2='<h2>'.$row["h2Text"].'</h2>';
	}
	
	$the_h3='';
	if ($row["h3Text"]!='') {
		$the_h3='<h3>'.$row["h3Text"].'</h3>';
	}
	
	$the_h4='';
	if ($row["h4Text"]!='') {
		$the_h4='<h4>'.$row["h4Text"].'</h4>';
	}
	
	$the_social='';
	if ($playlist_str!='') {
		$the_social='<div class="socialIconsDiv">'
            .$the_h4.
			'<ul class="socialIcons">'.$playlist_str.'</ul>
		 </div>';
	}
	

	$str_to_return='<link href="'.$row["pluginFontFamilyGoogleLink"].'" rel="stylesheet" type="text/css">
	<script>
		jQuery(function() {
			jQuery("#circularCountdown_'.$row["id"].'").circularCountdown({
				beginDate:"'.$row["beginDate_date"].','.$row["beginDate_hours"].','.$row["beginDate_minutes"].','.$row["beginDate_seconds"].'",
				launchingDate:"'.$row["endDate_date"].','.$row["endDate_hours"].','.$row["endDate_minutes"].','.$row["endDate_seconds"].'",
				nowDate:"'.$servertime.'",
				responsive:'.$row["responsive"].',
				pluginFontFamily:"'.$row["pluginFontFamily"].'",
				circleRadius:'.$row["circleRadius"].',
				circleLineWidth:'.$row["circleLineWidth"].',
				behindCircleLineWidthExpand:'.$row["behindCircleLineWidthExpand"].',
				circleTopBottomPadding:'.$row["circleTopBottomPadding"].',				
				circleLeftRightPadding:'.$row["circleLeftRightPadding"].',
				numberSize:'.$row["numberSize"].',
				numberAdditionalTopPadding:'.$row["numberAdditionalTopPadding"].',
				textSize:'.$row["textSize"].',
				textMarginTop:'.$row["textMarginTop"].',
				textPadding:'.$row["textPadding"].',
				lineSeparatorImg:"'.$row["lineSeparatorImg"].'",
				allCirclesTopMargin:'.$row["allCirclesTopMargin"].',
				allCirclesBottomMargin:'.$row["allCirclesBottomMargin"].',
				socialBgOFF:"'.$row["socialBgOFF"].'",
				socialBgON:"'.$row["socialBgON"].'",
				complete:'.(($row["complete"]!='')?$row["complete"]:'""').',
				autoReset24h:'.$row["autoReset24h"].',
				
				
				divBackgroundDays:"'.(($row["divBackgroundDaysImg"])?$row["divBackgroundDaysImg"]:'#'.$row["divBackgroundDaysHexa"]).'",
				borderTopColorDays:"#'.$row["borderTopColorDays"].'",
				borderRightColorDays:"#'.$row["borderRightColorDays"].'",
				borderBottomColorDays:"#'.$row["borderBottomColorDays"].'",
				borderLeftColorDays:"#'.$row["borderLeftColorDays"].'",
				circleColorDays:"#'.$row["circleColorDays"].'",
				circleAlphaDays:'.$row["circleAlphaDays"].',
				behindCircleColorDays:"#'.$row["behindCircleColorDays"].'",
				behindCircleAlphaDays:'.$row["behindCircleAlphaDays"].',
				numberColorDays:"#'.$row["numberColorDays"].'",
				textColorDays:"#'.$row["textColorDays"].'",
				textColorBackgroundDays:"'.(($row["textBackgroundDaysImg"])?$row["textBackgroundDaysImg"]:'#'.$row["textBackgroundDaysHexa"]).'",
				
				divBackgroundHours:"'.(($row["divBackgroundHoursImg"])?$row["divBackgroundHoursImg"]:'#'.$row["divBackgroundHoursHexa"]).'",
				borderTopColorHours:"#'.$row["borderTopColorHours"].'",
				borderRightColorHours:"#'.$row["borderRightColorHours"].'",
				borderBottomColorHours:"#'.$row["borderBottomColorHours"].'",
				borderLeftColorHours:"#'.$row["borderLeftColorHours"].'",
				circleColorHours:"#'.$row["circleColorHours"].'",
				circleAlphaHours:'.$row["circleAlphaHours"].',
				behindCircleColorHours:"#'.$row["behindCircleColorHours"].'",
				behindCircleAlphaHours:'.$row["behindCircleAlphaHours"].',
				numberColorHours:"#'.$row["numberColorHours"].'",
				textColorHours:"#'.$row["textColorHours"].'",
				textColorBackgroundHours:"'.(($row["textBackgroundHoursImg"])?$row["textBackgroundHoursImg"]:'#'.$row["textBackgroundHoursHexa"]).'",
				
				divBackgroundMinutes:"'.(($row["divBackgroundMinutesImg"])?$row["divBackgroundMinutesImg"]:'#'.$row["divBackgroundMinutesHexa"]).'",
				borderTopColorMinutes:"#'.$row["borderTopColorMinutes"].'",
				borderRightColorMinutes:"#'.$row["borderRightColorMinutes"].'",
				borderBottomColorMinutes:"#'.$row["borderBottomColorMinutes"].'",
				borderLeftColorMinutes:"#'.$row["borderLeftColorMinutes"].'",
				circleColorMinutes:"#'.$row["circleColorMinutes"].'",
				circleAlphaMinutes:'.$row["circleAlphaMinutes"].',
				behindCircleColorMinutes:"#'.$row["behindCircleColorMinutes"].'",
				behindCircleAlphaMinutes:'.$row["behindCircleAlphaMinutes"].',
				numberColorMinutes:"#'.$row["numberColorMinutes"].'",
				textColorMinutes:"#'.$row["textColorMinutes"].'",
				textColorBackgroundMinutes:"'.(($row["textBackgroundMinutesImg"])?$row["textBackgroundMinutesImg"]:'#'.$row["textBackgroundMinutesHexa"]).'",
				
				divBackgroundSeconds:"'.(($row["divBackgroundSecondsImg"])?$row["divBackgroundSecondsImg"]:'#'.$row["divBackgroundSecondsHexa"]).'",
				borderTopColorSeconds:"#'.$row["borderTopColorSeconds"].'",
				borderRightColorSeconds:"#'.$row["borderRightColorSeconds"].'",
				borderBottomColorSeconds:"#'.$row["borderBottomColorSeconds"].'",
				borderLeftColorSeconds:"#'.$row["borderLeftColorSeconds"].'",
				circleColorSeconds:"#'.$row["circleColorSeconds"].'",
				circleAlphaSeconds:'.$row["circleAlphaSeconds"].',
				behindCircleColorSeconds:"#'.$row["behindCircleColorSeconds"].'",
				behindCircleAlphaSeconds:'.$row["behindCircleAlphaSeconds"].',
				numberColorSeconds:"#'.$row["numberColorSeconds"].'",
				textColorSeconds:"#'.$row["textColorSeconds"].'",
				textColorBackgroundSeconds:"'.(($row["textBackgroundSecondsImg"])?$row["textBackgroundSecondsImg"]:'#'.$row["textBackgroundSecondsHexa"]).'",								
				
				h2Size:'.$row["h2Size"].',
				h2Color:"#'.$row["h2Color"].'",
				h2Weight:"'.$row["h2Weight"].'",
				h2TopMargin:'.$row["h2TopMargin"].',

				h3Size:'.$row["h3Size"].',
				h3Color:"#'.$row["h3Color"].'",
				h3Weight:"'.$row["h3Weight"].'",
				h3TopMargin:'.$row["h3TopMargin"].',
				
				h4Size:'.$row["h4Size"].',
				h4Color:"#'.$row["h4Color"].'",
				h4Weight:"'.$row["h4Weight"].'",
				h4TopMargin:'.$row["h4TopMargin"].'								

			});	
		});
	</script>	
    <div id="circularCountdown_'.$row["id"].'">'.$the_logo.$the_h2.$the_h3.
                '<div class="theCircles group">
                    <div class="daysDiv">	
                        <canvas class="canvasDays"></canvas>
                        <div class="innerNumber">0</div>
                        <div class="innerText">'.$row["translateDays"].'</div>
                    </div>
                    <div class="hoursDiv">	
                        <canvas class="canvasHours"></canvas>
                        <div class="innerNumber">0</div>
                        <div class="innerText">'.$row["translateHours"].'</div>
                    </div>
                    <div class="minutesDiv">	
                        <canvas class="canvasMinutes"></canvas>
                        <div class="innerNumber">0</div>
                        <div class="innerText">'.$row["translateMinutes"].'</div>
                    </div>
                    <div class="secondsDiv">	
                        <canvas class="canvasSeconds"></canvas>
                        <div class="innerNumber">0</div>
                        <div class="innerText">'.$row["translateSeconds"].'</div>
                    </div>
                </div>'
		 .$the_social.'	
	</div>';
	return str_replace("\r\n", '', $str_to_return);
}


function circular_countdown_shortcode($atts, $content=null) {
	global $wpdb;
	
	shortcode_atts( array('settings_id'=>''), $atts);
	if ($atts['settings_id']=='')
		$atts['settings_id']=1;

	return circular_countdown_generate_preview_code($atts['settings_id']);	

}

function circular_countdown_plugin_redirect()
{
	global $wpdb;
	if(!is_admin()){	
		if(!is_user_logged_in()) {
			//echo circular_countdown_generate_preview_code($_POST['theCountDownID']);
			$safe_sql="SELECT id,enableMaintenanceMode,servertime FROM (".$wpdb->prefix ."circular_countdown_settings)";
			$result = $wpdb->get_results($safe_sql,ARRAY_A);
			foreach ( $result as $row ) {
				if ($row['enableMaintenanceMode']=='true') {			
					//wp_redirect( home_url( '/signup/' ) );
					if ($row['servertime']=="true") {
						writePreviewAndMaintenanceFile($row['id'],'tpl/maintenance_mode.html');
					}
					include(plugin_dir_path(__FILE__).'tpl/maintenance_mode.html');	
					exit();
				}
			}
		}
	}
}


register_activation_hook(__FILE__,"circular_countdown_activate"); //activate plugin and create the database
register_uninstall_hook(__FILE__, 'circular_countdown_uninstall'); // on unistall delete all databases 
add_action('init', 'circular_countdown_init_sessions');	// initialize sessions
add_action('init', 'circular_countdown_load_styles');	// loads required styles
add_action('init', 'circular_countdown_load_scripts');			// loads required scripts  
add_action('admin_menu', 'circular_countdown_plugin_menu'); // create menus
add_shortcode('circular_countdown', 'circular_countdown_shortcode');				// COUNTDOWN-PRO shortcode 
add_action( 'template_redirect', 'circular_countdown_plugin_redirect');









/** OTHER FUNCTIONS **/

//stripslashes for an entire array
function circular_countdown_unstrip_array($array){
	if (is_array($array)) {	
		foreach($array as &$val){
			if(is_array($val)){
				$val = unstrip_array($val);
			} else {
				$val = stripslashes($val);
				
			}
		}
	}
	return $array;
}







/* ajax update playlist record */

add_action('admin_head', 'circular_countdown_update_playlist_record_javascript');

function circular_countdown_update_playlist_record_javascript() {
	global $wpdb;
	//Set Your Nonce
	$circular_countdown_update_playlist_record_ajax_nonce = wp_create_nonce("circular_countdown_update_playlist_record-special-string");
	$circular_countdown_preview_record_ajax_nonce = wp_create_nonce("circular_countdown_preview_record-special-string");
	

	if(strpos($_SERVER['PHP_SELF'], 'wp-admin') !== false) {
		$page = (isset($_GET['page'])) ? $_GET['page'] : '';
		if(preg_match('/circular_countdown/i', $page)) {
?>




<script type="text/javascript" >

//delete the entire record
function circular_countdown_delete_entire_record (delete_id) {
	if (confirm('Are you sure?')) {
		jQuery("#circular_countdown_sortable").sortable('disable');
		jQuery("#"+delete_id).css("display","none");
		//jQuery("#circular_countdown_sortable").sortable('refresh');
		jQuery("#circular_countdown_updating_witness").css("display","block");
		var data = "action=circular_countdown_update_playlist_record&security=<?php echo $circular_countdown_update_playlist_record_ajax_nonce; ?>&updateType=circular_countdown_delete_entire_record&delete_id="+delete_id;
		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			jQuery("#circular_countdown_sortable").sortable('enable');
			jQuery("#circular_countdown_updating_witness").css("display","none");
			//alert('Got this from the server: ' + response);
		});		
	}
}











function circular_countdown_process_val(val,cssprop) {
	retVal=parseInt(val.substring(0, val.length-2));
	if (cssprop=="top")
		retVal=retVal-148;
	return retVal;
}






function showDialogPreview(theCountDownID) {  //load content and open dialog
	var data ="action=circular_countdown_preview_record&security=<?php echo $circular_countdown_preview_record_ajax_nonce; ?>&theCountDownID="+theCountDownID;

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(response) {
		//jQuery("#previewDialog").html(response);
		jQuery('#previewDialogIframe').attr('src','<?php echo plugins_url("tpl/preview.html?d=".time(), __FILE__)?>');
		jQuery("#previewDialog").dialog("open");
	});
}	



jQuery(document).ready(function($) {
	/*PREVIEW DIALOG BOX*/
	jQuery( "#previewDialog" ).dialog({
	  minWidth:1200,
	  minHeight:500,
	  title:"CountDown Preview",
	  modal: true,
	  autoOpen:false,
	  hide: "fade",
	  resizable: false,
	  open: function() {
		//jQuery( this ).html();
	  },
	  close: function() {
		//jQuery("#previewDialog").html('');
		jQuery('#previewDialogIframe').attr('src','');
	  }
	});		
	
	/* THE PLAYLIST */
	if (jQuery('#circular_countdown_sortable').length) {
		jQuery( '#circular_countdown_sortable' ).sortable({
			placeholder: "ui-state-highlight",
			start: function(event, ui) {
	            ord_start = ui.item.prevAll().length + 1;
	        },
			update: function(event, ui) {
	        	jQuery("#circular_countdown_sortable").sortable('disable');
	        	jQuery("#circular_countdown_updating_witness").css("display","block");
				var ord_stop=ui.item.prevAll().length + 1;
				var elem_id=ui.item.attr("id");
				//alert (ui.item.attr("id"));
				//alert (ord_start+' --- '+ord_stop);
				var data = "action=circular_countdown_update_playlist_record&security=<?php echo $circular_countdown_update_playlist_record_ajax_nonce; ?>&updateType=change_ord&ord_start="+ord_start+"&ord_stop="+ord_stop+"&elem_id="+elem_id;
				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post(ajaxurl, data, function(response) {
					jQuery("#circular_countdown_sortable").sortable('enable');
					jQuery("#circular_countdown_updating_witness").css("display","none");
					//alert('Got this from the server: ' + response);
				});			
			}
		});
	}


	
	<?php 
		$rows_count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(*) FROM ". $wpdb->prefix . "circular_countdown_playlist WHERE countdownid = %d ORDER BY ord",$_SESSION['xid'] ) );
//$safe_sql=$wpdb->prepare( "SELECT * FROM (".$wpdb->prefix ."circular_countdown_playlist) WHERE countdownid = %d ORDER BY ord",$_SESSION['xid'] );	
		for ($i=1;$i<=$rows_count;$i++) {
	?>
				jQuery('#upload_img_button_circular_countdown_<?php echo $i?>').click(function(event) {
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
							document.forms["form-playlist-circular_countdown-"+<?php echo $i?>].img.value=attachment.url;
							jQuery('#img_'+<?php echo $i?>).attr('src',attachment.url);
						});
						// Finally, open the modal
						file_frame.open();
				});


	

	jQuery("#form-playlist-circular_countdown-<?php echo $i?>").submit(function(event) {

		/* stop form from submitting normally */
		event.preventDefault(); 
		
		//show loading image
		jQuery('#ajax-message-<?php echo $i?>').html('<img src="<?php echo plugins_url('circular_countdown/images/ajax-loader.gif', dirname(__FILE__))?>" />');
		var data ="action=circular_countdown_update_playlist_record&security=<?php echo $circular_countdown_update_playlist_record_ajax_nonce; ?>&"+jQuery("#form-playlist-circular_countdown-<?php echo $i?>").serialize();

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		jQuery.post(ajaxurl, data, function(response) {
			//alert('Got this from the server: ' + response);
			//alert(jQuery("#form-playlist-circular_countdown-<?php echo $i?>").serialize());
			var new_img = '';
			if (document.forms["form-playlist-circular_countdown-<?php echo $i?>"].img.value!='')
				new_img=document.forms["form-playlist-circular_countdown-<?php echo $i?>"].img.value;
			jQuery('#top_image_'+document.forms["form-playlist-circular_countdown-<?php echo $i?>"].id.value).attr('src',new_img);
			jQuery('#ajax-message-<?php echo $i?>').html(response);
		});
	});
	<?php } ?>
	
});
</script>
<?php
		}
	}
}

//circular_countdown_update_playlist_record is the action=circular_countdown_update_playlist_record

add_action('wp_ajax_circular_countdown_update_playlist_record', 'circular_countdown_update_playlist_record_callback');

function circular_countdown_update_playlist_record_callback() {
	
	check_ajax_referer( 'circular_countdown_update_playlist_record-special-string', 'security' ); //security=<?php echo $circular_countdown_update_playlist_record_ajax_nonce; 
	global $wpdb;
	global $circular_countdown_messages;
	$errors_arr=array();
	//$wpdb->show_errors();
	
	//delete entire record
	if ($_POST['updateType']=='circular_countdown_delete_entire_record') {
		$delete_id=$_POST['delete_id'];
		$safe_sql=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."circular_countdown_playlist WHERE id = %d",$delete_id);
		$row = $wpdb->get_row($safe_sql, ARRAY_A);
		$row=circular_countdown_unstrip_array($row);

		//delete the entire record
		$wpdb->query($wpdb->prepare("DELETE FROM ".$wpdb->prefix."circular_countdown_playlist WHERE id = %d",$delete_id));
		//update the order for the rest ord=ord-1 for > ord
		$wpdb->query($wpdb->prepare("UPDATE ".$wpdb->prefix."circular_countdown_playlist SET ord=ord-1 WHERE countdownid = %d and  ord>".$row['ord'],$_SESSION['xid']));
		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
	}

	//update elements order
	if ($_POST['updateType']=='change_ord') {
		$sql_arr=array();
		$ord_start=$_POST['ord_start'];
		$ord_stop=$_POST['ord_stop'];
		$elem_id=(int)$_POST['elem_id'];
		$ord_direction='+1';
		if ($ord_start<$ord_stop) 
			$sql_arr[]="UPDATE ".$wpdb->prefix."circular_countdown_playlist SET ord=ord-1  WHERE countdownid = ".$_SESSION['xid']." and ord>".$ord_start." and ord<=".$ord_stop;
		else
			$sql_arr[]="UPDATE ".$wpdb->prefix."circular_countdown_playlist SET ord=ord+1  WHERE countdownid = ".$_SESSION['xid']." and ord>=".$ord_stop." and ord<".$ord_start;
		$sql_arr[]="UPDATE ".$wpdb->prefix."circular_countdown_playlist SET ord=".$ord_stop." WHERE id=".$elem_id;		
		
		//echo "elem_id: ".$elem_id."----ord_start: ".$ord_start."----ord_stop: ".$ord_stop;
		foreach ($sql_arr as $sql) {
			$wpdb->query($sql);
		}
			
		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');	
	}

	
	
	
	//submit update
	/*if (empty($_POST['img']))
		$errors_arr[]=$circular_countdown_messages['empty_img'];*/
	
	$theid=isset($_POST['id'])?$_POST['id']:0;
	if($theid>0 && !count($errors_arr)) {
		/*$except_arr=array('Submit'.$theid,'id','ord','action','security','updateType','uniqueUploadifyID');
		foreach ($_POST as $key=>$val){
			if (in_array($key,$except_arr)) {
				unset($_POST[$key]);
			}
		}*/
		//update playlist
		$wpdb->update( 
			$wpdb->prefix .'circular_countdown_playlist',
				array( 
				'img' => $_POST['img'],
				'title' => $_POST['title'],
				'data-link' => $_POST['data-link'],
				'data-target' => $_POST['data-target']
				), 
			array( 'id' => $theid )
		);
		
		
		writePreviewAndMaintenanceFile($_SESSION['xid'],'tpl/maintenance_mode.html');
		?>
			<div id="message" class="updated"><p><?php echo $circular_countdown_messages['data_saved'];?></p></div>
	<?php 
	} else if (!isset($_POST['updateType'])) {
		$errors_arr[]=$circular_countdown_messages['invalid_request'];
	}
    //echo $theid;
    
	if (count($errors_arr)) { ?>
		<div id="error" class="error"><p><?php echo implode("<br>", $errors_arr);?></p></div>
	<?php }

	die(); // this is required to return a proper result
}








function writePreviewAndMaintenanceFile($theCountDownID,$theFileName) {
	global $wpdb;
	//echo circular_countdown_generate_preview_code($_POST['theCountDownID']);
	$safe_sql=$wpdb->prepare( "SELECT enableMaintenanceMode,pageBg,pageBgHexa,pageBgAdditionalCss FROM (".$wpdb->prefix ."circular_countdown_settings) WHERE id = %d",$theCountDownID );
	$row = $wpdb->get_row($safe_sql,ARRAY_A);
	$row=circular_countdown_unstrip_array($row);
	$bgColor='#CCCCCC';
	if ($row['enableMaintenanceMode']=='true') {
		if ($row['pageBgHexa'])
			$bgColor='#'.$row['pageBgHexa'];		
		if ($row['pageBg'])
			$bgColor='url('.$row['pageBg'].')';
	}
		
	$aux_val='<html>
					<head>
			<link href="'.plugins_url('circular_countdown/circularCountdown.css', __FILE__).'" rel="stylesheet" type="text/css">
			
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
			<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
			<script src="'.plugins_url('circular_countdown/js/circularCountdown.js', __FILE__).'" type="text/javascript"></script>
					</head>
					<body style="padding:0px;margin:0px;background:'.$bgColor.' '.$row['pageBgAdditionalCss'].';">';
						
	$aux_val.=circular_countdown_generate_preview_code($theCountDownID);
	$aux_val.="</body>
				</html>";
	$filename=plugin_dir_path(__FILE__) . $theFileName;
	if ($theFileName=='tpl/preview.html') {
		$fp = fopen($filename, 'w+');
		$fwrite = fwrite($fp, $aux_val);
	} else {
		if ($row['enableMaintenanceMode']=='true') {
			$fp = fopen($filename, 'w+');
			$fwrite = fwrite($fp, $aux_val);
		}		
	}
	

	
	//echo $fwrite;
	
}






add_action('wp_ajax_circular_countdown_preview_record', 'circular_countdown_preview_record_callback');

function circular_countdown_preview_record_callback() {
	check_ajax_referer( 'circular_countdown_preview_record-special-string', 'security' );

	writePreviewAndMaintenanceFile($_POST['theCountDownID'],'tpl/preview.html');

	die(); // this is required to return a proper result
}



?>
