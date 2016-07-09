<?php
/*
Plugin Name: WordPress SEO News (shared on wplocker.com)
Version: 2.2.2
Plugin URI: https://yoast.com/wordpress/plugins/news-seo/#utm_source=wpadmin&utm_medium=plugin&utm_campaign=wpseonewsplugin
Description: Google News plugin for the WordPress SEO plugin
Author: Team Yoast
Author URI: http://yoast.com/
Text Domain: wpseo_news
License: GPL v3

WordPress SEO Plugin
Copyright (C) 2008-2014, Team Yoast

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


class WPSEO_News {

	const VERSION = '2.2.2';
	/**
	 * Get WPSEO News options
	 *
	 * @return array
	 */
	public static function get_options() {
		/**
		 * Filter: 'wpseo_news_options' - Allow modifying op WordPress SEO News filters
		 *
		 * @api array $wpseo_news_options The WordPress SEO News options
		 *
		 */
		return apply_filters( 'wpseo_news_options', wp_parse_args( get_option( 'wpseo_news', array() ), array( 'name' => '', 'default_genre' => array(), 'default_keywords' => '', 'ep_image_src' => '', 'version' => '0' ) ) );
	}

	/**
	 * Get plugin file
	 *
	 * @return string
	 */
	public static function get_file() {
		return __FILE__;
	}

	public function __construct() {

		// Check if module can work
		if ( false === $this->check_dependencies() ) {
			return false;
		}

		$this->set_autoloader();

		// Add plugin links
		add_filter( 'plugin_action_links', array( $this, 'plugin_links' ), 10, 2 );

		// Add subitem to menu
		add_filter( 'wpseo_submenu_pages', array( $this, 'add_submenu_pages' ) );

		// Add Redirect page as admin page
		add_filter( 'wpseo_admin_pages', array( $this, 'add_admin_pages' ) );

		// Register settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// Meta box
		$meta_box = new WPSEO_News_Meta_Box();
		add_filter( 'wpseo_save_metaboxes', array( $meta_box, 'save' ), 10, 1 );
		add_action( 'wpseo_tab_header', array( $meta_box, 'header' ) );
		add_action( 'wpseo_tab_content', array( $meta_box, 'content' ) );
		add_filter( 'add_extra_wpseo_meta_fields', array( $meta_box, 'add_meta_fields_to_wpseo_meta' ) );

		// Sitemap
		$sitemap = new WPSEO_News_Sitemap();
		add_action( 'init', array( $sitemap, 'init' ), 10 );
		add_filter( 'wpseo_sitemap_index', array( $sitemap, 'add_to_index' ) );

		// Rewrite Rules
		$rewrite_rules = new WPSEO_News_Editors_Pick_Request();
		$rewrite_rules->setup();

		// Head
		$head = new WPSEO_News_Head();
		add_action( 'wpseo_head', array( $head, 'add_head_tags' ) );

		if ( is_admin() ) {
			$this->init_admin();
		}

	}

	/**
	 * Setting up the autoloader
	 */
	private function set_autoloader() {

		// Setup autoloader
		require_once( dirname( __FILE__ ) . '/classes/class-autoloader.php' );
		$autoloader = new WPSEO_News_Autoloader();
		spl_autoload_register( array( $autoloader, 'load' ) );
	}

	/**
	 * Initialize the admin page
	 */
	private function init_admin() {
		// Edit Post JS
		global $pagenow;

		if ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) {
			add_action( 'admin_head', array( $this, 'edit_post_css' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_edit_post' ) );
		}

		// Upgrade Manager
		$upgrade_manager = new WPSEO_News_Upgrade_Manager();
		$upgrade_manager->check_update();

		// License Manager
		$license_manager = new Yoast_Plugin_License_Manager( new WPSEO_News_Product() );
		$license_manager->setup_hooks();
		add_action( 'wpseo_licenses_forms', array( $license_manager, 'show_license_form' ) );

	}

	/**
	 * Check the dependencies
	 */
	private function check_dependencies() {
		global $wp_version;

		if ( ! version_compare( $wp_version, '3.5', '>=' ) ) {
			add_action( 'all_admin_notices', array( $this, 'error_upgrade_wp' ) );
		} else {
			if ( defined( 'WPSEO_VERSION' ) ) {
				if ( version_compare( WPSEO_VERSION, '1.5', '>=' ) ) {
					return true;
				} else {
					add_action( 'all_admin_notices', array( $this, 'error_upgrade_wpseo' ) );
				}
			} else {
				add_action( 'all_admin_notices', array( $this, 'error_missing_wpseo' ) );
			}
		}

		return false;
	}

	/**
	 * Check whether we can include the minified version or not
	 *
	 * @param string $ext
	 *
	 * @return string
	 */
	private function file_ext( $ext ) {
		if ( ! defined( 'SCRIPT_DEBUG' ) || ! SCRIPT_DEBUG ) {
			$ext = '.min' . $ext;
		}
		return $ext;
	}

	/**
	 * Add plugin links
	 *
	 * @param $links
	 * @param $file
	 *
	 * @return mixed
	 */
	public function plugin_links( $links, $file ) {
		static $this_plugin;
		if ( empty( $this_plugin ) ) {
			$this_plugin = plugin_basename( __FILE__ );
		}
		if ( $file == $this_plugin ) {
			$settings_link = '<a href="' . admin_url( 'admin.php?page=wpseo_news' ) . '">' . __( 'Settings', 'wordpress-seo-news' ) . '</a>';
			array_unshift( $links, $settings_link );
		}

		return $links;
	}

	/**
	 * Register the premium settings
	 */
	public function register_settings() {
		register_setting( 'yoast_wpseo_news_options', 'wpseo_news', array( $this, 'sanitize_options' ) );
	}

	/**
	 * Sanitize options
	 *
	 * @param $options
	 *
	 * @return mixed
	 */
	public function sanitize_options( $options ) {
		$options['version'] = self::VERSION;
		return $options;
	}

	/**
	 * Add submenu item
	 *
	 * @param $submenu_pages
	 *
	 * @return array
	 */
	public function add_submenu_pages( $submenu_pages ) {

		$admin_page = new WPSEO_News_Admin_Page();

		$submenu_pages[] = array(
				'wpseo_dashboard',
				__( 'Yoast WordPress SEO:', 'wordpress-seo-news' ) . ' ' . __( 'News SEO', 'wordpress-seo-news' ),
				__( 'News SEO', 'wordpress-seo-news' ),
				'manage_options',
				'wpseo_news',
				array( $admin_page, 'display' ),
				array( array( $this, 'enqueue_admin_page' ) ),
		);

		return $submenu_pages;
	}

	/**
	 * Add admin page to admin_pages so the correct assets are loaded by WPSEO
	 *
	 * @param $admin_pages
	 *
	 * @return array
	 */
	public function add_admin_pages( $admin_pages ) {
		$admin_pages[] = 'wpseo_news';

		return $admin_pages;
	}

	/**
	 * Enqueue admin page JS
	 */
	public function enqueue_admin_page() {
		wp_enqueue_media(); // enqueue files needed for upload functionality
		wp_enqueue_script( 'wpseo-news-admin-page', plugins_url( 'assets/admin-page' . $this->file_ext( '.js' ), self::get_file() ), array( 'jquery', 'jquery-ui-core', 'jquery-ui-autocomplete' ), self::VERSION, true );
		wp_localize_script( 'wpseo-news-admin-page', 'wpseonews', WPSEO_News_Javascript_Strings::strings() );
	}

	/**
	 * Enqueue edit post JS
	 */
	public function enqueue_edit_post() {
		wp_enqueue_script( 'wpseo-news-edit-post', plugins_url( 'assets/post-edit' . $this->file_ext( '.js' ), self::get_file() ), array( 'jquery' ), self::VERSION, true );
	}

	/**
	 * Print the edit post CSS
	 */
	public function edit_post_css() {
		echo "<style type='text/css'>.wpseo-news-input-error{border:1px solid #ff0000 !important;}</style>" . PHP_EOL;
	}

	/**
	 * Throw an error if WordPress SEO is not installed.
	 *
	 * @since 2.0.0
	 */
	public function error_missing_wpseo() {
		echo '<div class="error"><p>' . sprintf( __( 'Please %sinstall &amp; activate WordPress SEO by Yoast%s and then enable its XML sitemap functionality to allow the WordPress SEO News module to work.', 'wordpress-seo-news' ), '<a href="' . esc_url( admin_url( 'plugin-install.php?tab=search&type=term&s=wordpress+seo&plugin-search-input=Search+Plugins' ) ) . '">', '</a>' ) . '</p></div>';
	}

	/**
	 * Throw an error if WordPress is out of date.
	 *
	 * @since 2.0.0
	 */
	public function error_upgrade_wp() {
		echo '<div class="error"><p>' . __( 'Please upgrade WordPress to the latest version to allow WordPress and the WordPress SEO News module to work properly.', 'wordpress-seo-news' ) . '</p></div>';
	}

	/**
	 * Throw an error if WordPress SEO is out of date.
	 *
	 * @since 2.0.0
	 */
	public function error_upgrade_wpseo() {
		echo '<div class="error"><p>' . __( 'Please upgrade the WordPress SEO plugin to the latest version to allow the WordPress SEO News module to work.', 'wordpress-seo-news' ) . '</p></div>';
	}

	// HELPERS

	/**
	 * Getting the post_types based on the included post_types option.
	 *
	 * The variable $post_types is static, because it won't change during pageload, but the method may be called multiple
	 * times. First time it will set the value, second time it will return this value.
	 *
	 * @return array
	 */
	public static function get_included_post_types() {
		static $post_types;

		if ( $post_types === null ) {
			$options = self::get_options();

			// Get supported post types
			$post_types = array();
			foreach ( get_post_types( array( 'public' => true ), 'objects' ) as $post_type ) {
				if ( isset( $options[ 'newssitemap_include_' . $post_type->name ] ) && ( 'on' == $options[ 'newssitemap_include_' . $post_type->name ] ) ) {
					$post_types[] = $post_type->name;
				}
			}

			// Support post if no post types are supported
			if ( empty( $post_types ) ) {
				$post_types[] = 'post';
			}
		}

		return $post_types;
	}

	/**
	 * Listing the genres
	 *
	 * @return array
	 */
	public static function list_genres() {
		return array(
			'none'          => __( 'None', 'wordpress-seo-news' ),
			'pressrelease'  => __( 'Press Release', 'wordpress-seo-news' ),
			'satire'        => __( 'Satire', 'wordpress-seo-news' ),
			'blog'          => __( 'Blog', 'wordpress-seo-news' ),
			'oped'          => __( 'Op-Ed', 'wordpress-seo-news' ),
			'opinion'       => __( 'Opinion', 'wordpress-seo-news' ),
			'usergenerated' => __( 'User Generated', 'wordpress-seo-news' ),
		);
	}

}

// Load text domain
add_action( 'init', 'wpseo_news_load_textdomain' );
function wpseo_news_load_textdomain() {
	load_plugin_textdomain( 'wordpress-seo-news', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * WPSEO News __main method
 */
function __wpseo_news_main() {
	new WPSEO_News();
}

// Load WPSEO News
add_action( 'after_setup_theme', '__wpseo_news_main' );
