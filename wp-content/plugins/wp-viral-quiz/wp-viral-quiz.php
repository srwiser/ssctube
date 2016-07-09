<?php

/*
	Plugin Name: WP Viral Quiz (shared on wplocker.com)
	Plugin URI: https://www.institut-pandore.com/wp-viral-quiz/download
	Description: Create awesome and viral quizzes on your blog, as Buzzfeed does.
	Author: Institut Pandore
	Version: 1.75
	Author URI: https://www.institut-pandore.com
	Text Domain: wpvq
	Domain Path: wpvq
*/

define('WPVQ_VERSION', '1.75');

require_once 'includes/snippets.php';
require_once 'controller/WPVQInitController.php';
require_once 'controller/WPVQShortcode.php';
require_once 'includes/WPVQGame.php';
require_once 'includes/WPVQGamePersonality.php';
require_once 'includes/WPVQGameTrueFalse.php';
require_once 'includes/WPVQAppreciation.php';
require_once 'includes/WPVQAnswer.php';
require_once 'includes/WPVQQuestion.php';
require_once 'includes/WPVQPlayers.php';
require_once 'includes/plugin-updates/plugin-update-checker.php';

// Settings page creation
require_once 'wpvq-settings-page.php';

class WPViralQuiz {

	/**
	 * Init the plugin
	 */
	function __construct() 
	{
		// Pagination settings. Not a public setting.
		define('WPVQ_QUIZ_PER_PAGE', 25);

		// Default Settings
		// No i18n outside this function, defines need to be here.
		define('WPVQ_PROGRESSBAR_COLOR', "#2bc253");
		define('WPVQ_WAIT_TRIVIA_PAGE', 1000);
		define('WPVQ_TWITTER_HASHTAG', '#wpquiz');
		define('WPVQ_SCROLL_OFFSET', 0);
		define('WPVQ_SCROLL_SPEED', 750);

		define('WPVQ_SHARE_PERSO_LOCAL', __("I'm %%personality%%", 'wpvq'));
		define('WPVQ_SHARE_PERSO_SIMPLE', __("I'm %%personality%%, and you ?", 'wpvq'));
		define('WPVQ_SHARE_PERSO_FB_TITLE', __("I'm %%personality%%, and you ?", 'wpvq'));
		define('WPVQ_SHARE_PERSO_FB_DESC', "%%details%%");

		define('WPVQ_SHARE_TRIVIA_LOCAL', __("I got %%score%% of %%total%% right", 'wpvq'));
		define('WPVQ_SHARE_TRIVIA_SIMPLE', __("I got %%score%% of %%total%% right, and you ?", 'wpvq'));
		define('WPVQ_SHARE_TRIVIA_FB_TITLE', __("I got %%score%% of %%total%% right, and you ?", 'wpvq'));
		define('WPVQ_SHARE_TRIVIA_FB_DESC', "%%details%%");

		// Admin Notice for ADDONS PAGE
		// Created on WPVQInitController.php
		if (!get_option('wpvq_notice_addons_1') == 1) {
			add_action( 'admin_notices', 'wpvq_notice_addons_1' );
		}
		function wpvq_notice_addons_1() {
		    ?>
		    <div class="updated wpvq-wpvq_notice_addons_1">
		        <h3><?php _e("SOMETHING NEW is happening with WP Viral Quiz !", 'wpvq'); ?></h3>
		        <p>
		        	<?php _e("Discover the <strong>new \"Awesome Addons\" page</strong>, and add new features to your quizzes.", 'wpvq'); ?>
		        </p>
		        <p>
		        	<a href="<?php echo admin_url( 'admin.php?page=wp-viral-quiz-addons'); ?>">
		        		<button class="button button-primary"><?php _e("Cool, hide this message and show me !", 'wpvq'); ?></button>
		        	</a>
		        </p>
		    </div>
		    <?php
		}

		// Update mechanism
		$updateChecker = PucFactory::buildUpdateChecker(
			'http://wpvq.institut-pandore.com/update.php',
			__FILE__,
			'wp-viral-quiz',
			2);
		$updateChecker->addQueryArgFilter(array($this, 'addSecretKeyForUpdate'));

		// Admin Menu Page
		add_action( 'admin_menu', array($this, 'options_pages') );

		// Install + Uninstall
		register_activation_hook( __FILE__, array( $this, 'install' ) );	
		register_uninstall_hook( __FILE__, array( 'WPViralQuiz', 'uninstall' ) );

		// Custom script JS
		add_action( 'admin_enqueue_scripts', array($this, 'load_custom_wpviral_script'));

		// Create Shortcode
		add_shortcode( 'viralQuiz', array('WPVQShortcode', 'viralQuiz') );
		add_action( 'init', array('WPVQShortcode', 'register_scripts') );
		add_action( 'wp_footer', array('WPVQShortcode', 'print_scripts') );


			// — Ajax Shortcode
			add_action( 'wp_ajax_choose_truefalse', array('WPVQShortcode', 'chooseTrueFalse') );
	    	add_action( 'wp_ajax_nopriv_choose_truefalse', array('WPVQShortcode', 'chooseTrueFalse') );
	    	add_action( 'wp_ajax_get_truefalse_appreciation', array('WPVQShortcode', 'getTrueFalseAppreciation') );
	    	add_action( 'wp_ajax_nopriv_get_truefalse_appreciation', array('WPVQShortcode', 'getTrueFalseAppreciation') );
	    	add_action( 'wp_ajax_choose_personality', array('WPVQShortcode', 'choosePersonality') );
	    	add_action( 'wp_ajax_nopriv_choose_personality', array('WPVQShortcode', 'choosePersonality') );
	    	add_action( 'wp_ajax_submit_informations', array('WPVQShortcode', 'submitInformations') );
	    	add_action( 'wp_ajax_nopriv_submit_informations', array('WPVQShortcode', 'submitInformations') );

	    	// – Ajax get view
	    	add_action('wp_ajax_wpvq_append_multiplier', wpvq_get_view('WPVQAddQuestion.WPVQGamePersonality.answer.append.multiplier.php'));
	    	add_action('wp_ajax_wpvq_append_personality', wpvq_get_view('WPVQAddQuestion.WPVQGamePersonality.personality.append.php'));

	    // i18n support
    	add_action( 'plugins_loaded', array($this, 'wpvq_load_textdomain') );

    	// Image Size for Answer
    	add_action( 'after_setup_theme', array($this, 'wpvq_create_thumbnail') );

    	// Image Size for Answer
    	add_action( 'init', array($this, 'wpvq_update_sql') );

    	// Settings Page
		add_action( 'admin_init', 'wpvq_settings_init' );
	}

	/**
	 * Param for update
	 */
	function addSecretKeyForUpdate($query) 
	{
		$options 	=  get_option( 'wpvq_settings' );
		$code 		=  (isset($options['wpvq_text_field_envato_code'])) ? $options['wpvq_text_field_envato_code']:'';
		
		// >= v1.3
		$query['secret'] 	= $code;
		$query['url'] 		= get_site_url();

		return $query;
	}

	/**
	 * Update the SQL schema if necessary
	 */
	function wpvq_update_sql()
	{
		// Create column "quizzes.forceToShare"
		global $wpdb;
		$row = $wpdb->get_row("
				SELECT * 
				FROM information_schema.COLUMNS 
				WHERE 
				    TABLE_SCHEMA = '".DB_NAME."' 
				AND TABLE_NAME = '".WPViralQuiz::getTableName('quizzes')."' 
				AND COLUMN_NAME = 'forceToShare' ", ARRAY_A);

		if (empty($row)) {
			$wpdb->query("ALTER TABLE ".WPViralQuiz::getTableName('quizzes')." ADD forceToShare VARCHAR(100) AFTER askInformations;");
		}

		// Create column "quizzes.randomQuestions" + "quizzes.randomAnswers" 
		global $wpdb;
		$row = $wpdb->get_row("
				SELECT * 
				FROM information_schema.COLUMNS 
				WHERE 
				    TABLE_SCHEMA = '".DB_NAME."' 
				AND TABLE_NAME = '".WPViralQuiz::getTableName('quizzes')."' 
				AND COLUMN_NAME = 'randomQuestions' ", ARRAY_A);

		if (empty($row)) {
			$wpdb->query("ALTER TABLE ".WPViralQuiz::getTableName('quizzes')." ADD randomQuestions INT(100) AFTER skin;");
			$wpdb->query("ALTER TABLE ".WPViralQuiz::getTableName('quizzes')." ADD isRandomAnswers smallint(6) AFTER randomQuestions;");
		}

		// Create column "players.meta"
		$row = $wpdb->get_row("
				SELECT * 
				FROM information_schema.COLUMNS 
				WHERE 
				    TABLE_SCHEMA = '".DB_NAME."' 
				AND TABLE_NAME = '".WPViralQuiz::getTableName('players')."' 
				AND COLUMN_NAME = 'meta' ", ARRAY_A);

		if (empty($row)) {
			$wpdb->query("ALTER TABLE ".WPViralQuiz::getTableName('players')." ADD meta TEXT NULL;");
		}

		// Delete column "players.quizName"
		$row = $wpdb->get_row("
				SELECT * 
				FROM information_schema.COLUMNS 
				WHERE 
				    TABLE_SCHEMA = '".DB_NAME."' 
				AND TABLE_NAME = '".WPViralQuiz::getTableName('players')."' 
				AND COLUMN_NAME = 'quizName' ", ARRAY_A);

		if (!empty($row)) {
			$wpdb->query("ALTER TABLE ".WPViralQuiz::getTableName('players')." DROP quizName;");

			// email + nickname can be null
			$wpdb->query("ALTER TABLE ".WPViralQuiz::getTableName('players')." CHANGE `email` `email` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
			$wpdb->query("ALTER TABLE ".WPViralQuiz::getTableName('players')." CHANGE `nickname` `nickname` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
		}

		// Weight can be NULL (table.answers)
		// + convert old weight schema to new schema (table.multipliers)
		$results = $wpdb->get_results("SHOW TABLES LIKE '".WPViralQuiz::getTableName('multipliers')."'");
		if($wpdb->num_rows == 0) 
		{
			$wpdb->query("ALTER TABLE ".WPViralQuiz::getTableName('players')." CHANGE `weight` `weight` smallint(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
			$wpdb->query("CREATE TABLE IF NOT EXISTS `".WPViralQuiz::getTableName('multipliers')."` (
			  `id` int(200) NOT NULL AUTO_INCREMENT,
			  `quizId` int(200) NOT NULL,
			  `questionId` int(200) NOT NULL,
			  `answerId` int(200) NOT NULL,
			  `appreciationId` int(200) NOT NULL,
			  `multiplier` int(200) NOT NULL,
			  PRIMARY KEY (`id`)
			) CHARSET=utf8 AUTO_INCREMENT=1");

			$results = $wpdb->get_results( "SELECT * FROM " . WPViralQuiz::getTableName('answers'));
			foreach ( $results as $answer ) 
			{
				$question = new WPVQQuestion();

				try {
					$question->load($answer->questionId);	
				} catch (Exception $e) {
					continue; // ignore error during update
				}

				// Update only for personality quiz
				try {
					$quizId = $question->getQuizId();
					if (WPVQGame::getTypeById($quizId) == 'WPVQGamePersonality') 
					{
						$dataSql = array(
							'quizId' 			=> $quizId,
							'questionId' 		=> $answer->questionId,
							'answerId' 			=> $answer->ID,
							'appreciationId' 	=> $answer->weight,
							'multiplier' 		=> 1,
						);

						$wpdb->insert( WPViralQuiz::getTableName('multipliers'), $dataSql, array('%d','%d','%d','%d','%d') );
					}
				} catch (Exception $e) {
					continue; // ignore error during update
				}
			}
		}

		// Create column "questions.pageAfter"
		$row = $wpdb->get_row("
				SELECT * 
				FROM information_schema.COLUMNS 
				WHERE 
				    TABLE_SCHEMA = '".DB_NAME."' 
				AND TABLE_NAME = '".WPViralQuiz::getTableName('questions')."' 
				AND COLUMN_NAME = 'pageAfter' ", ARRAY_A);

		if (empty($row)) {
			$wpdb->query("ALTER TABLE ".WPViralQuiz::getTableName('questions')." ADD `pageAfter` SMALLINT(2) NULL AFTER `content`");
		}
		
	}

	/**
	 * Create thumbnail for square answers
	 */
	function wpvq_create_thumbnail() {
		add_image_size( 'wpvq-square-answer', 300, 300, true);
	}

	/**
	 * Load plugin textdomain.
	 */
	function wpvq_load_textdomain() 
	{
		$domain = 'wpvq';
    	$locale = apply_filters('plugin_locale', get_locale(), $domain);

    	load_textdomain($domain, WP_LANG_DIR.'/wp-viral-quiz/'.$domain.'-'.$locale.'.mo');
    	load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}

	/**
	 * Create the menu in WP Backoffice
	 * + settings page
	 */
	function options_pages() {
		add_menu_page('WP Viral Quiz', 'WP Viral Quiz', 'edit_posts', 'wp-viral-quiz', array('WPVQInitController', 'init_page_admin'), 'dashicons-forms');
		add_submenu_page( 'wp-viral-quiz', __('Settings', 'wpvq'), __('Settings', 'wpvq'), 'manage_options', 'wp-viral-quiz-settings', 'wp_viral_quiz_options_page' );
		add_submenu_page( 'wp-viral-quiz', __('Players', 'wpvq'), __('Players', 'wpvq'), 'edit_posts', 'wp-viral-quiz-players', array('WPVQInitController', 'init_page_admin_players') );
		add_submenu_page( 'wp-viral-quiz', __('Awesome Addons', 'wpvq'), __('Awesome Addons', 'wpvq'), 'manage_options', 'wp-viral-quiz-addons', array('WPVQInitController', 'init_page_admin_addons') );
	}

	/**
	 * Enqueue script and CSS
	 */
	function load_custom_wpviral_script() 
	{
		// Settings page
		if (isset($_GET['page']) && ($_GET['page'] == 'wp-viral-quiz-settings' || $_GET['page'] == 'wp-viral-quiz-addons')) 
		{
			$options = get_option( 'wpvq_settings' );

			wp_enqueue_style('wp-color-picker');

			// behave.js (code editor)
			wp_register_script('wpvq_behave', plugin_dir_url(__FILE__) . 'js/behave.js', null, WPVQ_VERSION, true);
			wp_enqueue_script('wpvq_behave');

			// Custom css for admin and settings page
			wp_register_style( 'wpvq_custom_wp_settings_admin_css', plugin_dir_url(__FILE__).'css/settings-admin-style.css', false, WPVQ_VERSION );
	        wp_enqueue_style( 'wpvq_custom_wp_settings_admin_css' );

			// Global admin.js
			wp_register_script('wpvq_global_script_admin', plugin_dir_url(__FILE__) . 'js/global-admin.js', array('wp-color-picker', 'wpvq_behave'), WPVQ_VERSION, true);
			wp_enqueue_script('wpvq_global_script_admin');
			$data = array(
			    'wpvq_noNeedApi' 			=> (isset($options['wpvq_checkbox_facebook_no_api'])) ? true:false,
			    'wpvq_apiAlreadyLoaded' 	=> (isset($options['wpvq_checkbox_facebook_already_api'])) ? true:false,
			);
			wp_localize_script( 'wpvq_global_script_admin', 'php_vars', $data );
		}

		// Global files for backoffice
		if (isset($_GET['page']) && ($_GET['page'] == 'wp-viral-quiz' || $_GET['page'] == 'wp-viral-quiz-addons')) 
		{
			wp_register_style( 'wpvq_custom_wp_admin_css', plugin_dir_url(__FILE__).'css/admin-style.css', false, WPVQ_VERSION );
	        wp_enqueue_style( 'wpvq_custom_wp_admin_css' );

	        wp_register_script('ckeditor_script_textarea', plugin_dir_url(__FILE__).'js/ckeditor.js', false, WPVQ_VERSION );
	        wp_enqueue_script( 'ckeditor_script_textarea' );
		}

        // — When creating a quiz
        if (isset($_GET['page']) && $_GET['page'] == 'wp-viral-quiz' && isset($_GET['action']) &&  ($_GET['action'] == 'add' || $_GET['action'] == 'edit')) 
        {
	        wp_enqueue_script( 'create_quiz_js', plugin_dir_url(__FILE__) . 'js/create-quiz.js', array(), WPVQ_VERSION, true );
			
			$data = array(
			    'wpvq_i18n_needNameAlert'  				=>  __("You have to give a name to your quiz please !", 'wpvq'),
			    'wpvq_i18n_badScoreConditionAlert'  	=>  __("You have to set a score condition for each appreciations !", 'wpvq'),
			    'wpvq_plugin_dir'  						=>  plugin_dir_url(__FILE__),
			);
			wp_localize_script( 'create_quiz_js', 'php_vars', $data );

			// For using thickbox and media upload
	        wp_enqueue_media();
	        wp_enqueue_script('tiny_mce');
		}
	}

	/**
	 * Install the plugin DB.
	 */
	public static function install() {
		global $wpdb;

		$wpdb->query("CREATE TABLE IF NOT EXISTS `".WPViralQuiz::getTableName('answers')."` (
			`ID` int(200) NOT NULL AUTO_INCREMENT,
			`label` text NOT NULL,
			`pictureId` bigint(20) NOT NULL,
			`weight` smallint(30) NOT NULL,
			`content` text NOT NULL,
			`questionId` int(200) NOT NULL,
			PRIMARY KEY (`ID`)
			) CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$wpdb->query("CREATE TABLE IF NOT EXISTS `".WPViralQuiz::getTableName('appreciations')."` (
			`ID` int(11) NOT NULL AUTO_INCREMENT,
			`quizId` int(200) NOT NULL,
			`scoreCondition` int(200) NULL,
			`label` text NOT NULL,
			`content` text NOT NULL,
			PRIMARY KEY (`ID`)
			) CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$wpdb->query("CREATE TABLE IF NOT EXISTS `".WPViralQuiz::getTableName('questions')."` (
			`ID` int(200) NOT NULL AUTO_INCREMENT,
			`label` text NOT NULL,
			`quizId` int(200) NOT NULL,
			`position` int(200) NOT NULL,
			`pictureId` bigint(20) NOT NULL,
			`content` text NULL,
			`pageAfter` SMALLINT(2) NULL,
			PRIMARY KEY (`ID`)
			) CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$wpdb->query("CREATE TABLE IF NOT EXISTS `".WPViralQuiz::getTableName('players')."` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`quizId` int(11) NOT NULL,
			`email` varchar(200) NULL,
			`nickname` varchar(200) NULL,
			`result` TEXT NOT NULL,
			`date` INT NOT NULL,
			`meta` TEXT NULL,
			  PRIMARY KEY (`ID`)
			) CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$wpdb->query("CREATE TABLE IF NOT EXISTS `".WPViralQuiz::getTableName('quizzes')."` (
			`ID` int(200) NOT NULL AUTO_INCREMENT,
			`type` varchar(20) NOT NULL,
			`name` varchar(255) NOT NULL,
			`authorId` bigint(20) NOT NULL,
			`dateCreation` int(200) NOT NULL,
			`dateUpdate` int(200) NOT NULL,
			`showSharing` SMALLINT NOT NULL,
			`showCopyright` SMALLINT NOT NULL,
			`askInformations` VARCHAR(100) NULL,
			`forceToShare` VARCHAR(100) NULL,
			`skin` VARCHAR(50) NOT NULL,
			PRIMARY KEY (`ID`)
			) CHARSET=utf8 AUTO_INCREMENT=1 ;");

		$wpdb->query("CREATE TABLE IF NOT EXISTS `".WPViralQuiz::getTableName('multipliers')."` (
			  `id` int(200) NOT NULL AUTO_INCREMENT,
			  `quizId` int(200) NOT NULL,
			  `questionId` int(200) NOT NULL,
			  `answerId` int(200) NOT NULL,
			  `appreciationId` int(200) NOT NULL,
			  `multiplier` int(200) NOT NULL,
			  PRIMARY KEY (`id`)
			) CHARSET=utf8 AUTO_INCREMENT=1");
	}


	/**
	 * Return the table name $table
	 * @param string $table The table name
	 */
	public static function getTableName($table) {
		global $wpdb;
		return $wpdb->prefix . 'wpvq_' . $table . '';
	}


	/**
	 * Uninstall the plugin
	 * @return [type] [description]
	 */
	public static function uninstall() {
		// global $wpdb;
		// $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpvq_quizzes" );
		// $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpvq_answers" );
		// $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpvq_appreciations" );
		// $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpvq_questions" );
		// $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpvq_players" );
		// $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpvq_multipliers" );
	}
	

}

$wpvurialquiz = new WPViralQuiz();
