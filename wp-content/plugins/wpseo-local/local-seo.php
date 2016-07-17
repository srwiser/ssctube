<?php
/**
 * @package WPSEO_Local\Main
 */

/**
 * Plugin Name: Yoast SEO: Local
 * Version: 3.3.1
 * Plugin URI: https://yoast.com/wordpress/local-seo/
 * Description: This Local SEO module adds all the needed functionality to get your site ready for Local Search Optimization
 * Author: Team Yoast and Arjan Snaterse
 * Author URI: https://yoast.com
 *
 * Copyright 2012-2016 Joost de Valk & Arjan Snaterse
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

/**
 * All functionality for fetching location data and creating an KML file with it.
 *
 * @package    Yoast SEO
 * @subpackage Yoast SEO Local
 */

define( 'WPSEO_LOCAL_VERSION', '3.3.1' );

if ( ! defined( 'WPSEO_LOCAL_PATH' ) ) {
	define( 'WPSEO_LOCAL_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'WPSEO_LOCAL_FILE' ) ) {
	define( 'WPSEO_LOCAL_FILE', __FILE__ );
}

if ( file_exists( WPSEO_LOCAL_PATH . '/vendor/autoload_52.php' ) ) {
	require WPSEO_LOCAL_PATH . '/vendor/autoload_52.php';
}

/**
 * Deactivate our sibling plugin: "Yoast SEO: Local for WooCommerce", because they may not be active simultaneously
 *
 * @since 3.3.1
 */
function yoast_wpseo_local_dectivate_sibling_plugins() {

	if ( defined( 'WPSEO_LOCAL_WOOCOMMERCE_FILE' ) ) {
		deactivate_plugins( WPSEO_LOCAL_WOOCOMMERCE_FILE );
	}

}
register_activation_hook( __FILE__, 'yoast_wpseo_local_dectivate_sibling_plugins' );


// Load text domain.
load_plugin_textdomain( 'yoast-local-seo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

// Actions moved from includes/ajax-functions.php and includes/wpseo-local-functions.php
// so those files can be autoloaded (as they will contain just functions then).
add_action( 'wp_ajax_wpseo_copy_location', 'wpseo_copy_location_callback' );
add_action( 'wp_ajax_nopriv_wpseo_copy_location', 'wpseo_copy_location_callback' );
add_action( 'wp_footer', 'wpseo_enqueue_geocoder' );
add_action( 'admin_footer', 'wpseo_enqueue_geocoder' );

/**
 * Initialize the Local SEO module on plugins loaded, so WP SEO should have set its constants and loaded its main classes.
 *
 * @since 0.2
 */
function wpseo_local_seo_init() {
	global $wpseo_local_core;

	if ( defined( 'WPSEO_VERSION' ) ) {

		if ( version_compare( WPSEO_VERSION, '1.4.99', '>=' ) ) {
			$wpseo_local_core = new WPSEO_Local_Core();

			new WPSEO_Local_Admin();
			new WPSEO_Local_Metaboxes();
			new WPSEO_Local_Frontend();
			new WPSEO_Local_Storelocator();
			new WPSEO_Local_Taxonomy();
		}
		else {
			add_action( 'all_admin_notices', 'yoast_wpseo_local_upgrade_error' );
		}
	}
	else {
		add_action( 'all_admin_notices', 'wpseo_local_missing_error' );
	}
}

add_action( 'init', 'wpseo_local_seo_init' );

/**
 * Register all widgets used for Local SEO plugin
 *
 * @since 3.1
 */
function wpseo_local_seo_init_widgets() {
	$widgets = array(
		'WPSEO_Show_Address',
		'WPSEO_Show_Map',
		'WPSEO_Show_OpeningHours',
	);

	if ( wpseo_has_multiple_locations() ) {
		$widgets[] = 'WPSEO_Storelocator_Form';
	}

	foreach ( $widgets as $widget ) {
		register_widget( $widget );
	}
}

add_action( 'widgets_init', 'wpseo_local_seo_init_widgets' );


/**
 * Throw an error if Yoast SEO is not installed.
 *
 * @since 0.2
 */
function wpseo_local_missing_error() {

	$message = sprintf(
		/* translators: %1$s resolves to the link to search the plugin directory for Yoast SEO, %2$s resolves to the closing tag for this link */
		__( 'Please %1$sinstall &amp; activate Yoast SEO%2$s and then go to the Local SEO section to enable the Local SEO.', 'yoast-local-seo' ),
		'<a href="' . admin_url( 'plugin-install.php?tab=search&type=term&s=yoast+seo&plugin-search-input=Search+Plugins' ) . '">',
		'</a>'
	);

	echo '<div class="error"><p>' . $message . '</p></div>';
}

/**
 * Throw an error if Yoast SEO is out of date.
 *
 * @since 1.5.4
 */
function yoast_wpseo_local_upgrade_error() {
	/* translators: %1$s resolves to Yoast SEO, %2$s resolves to Local SEO */
	echo '<div class="error"><p>' . sprintf( __( 'Please upgrade the %1$s plugin to the latest version to allow the %2$s module to work.', 'yoast-local-seo' ), 'Yoast SEO', 'Local SEO' ) . '</p></div>';
}

/**
 * Instantiate the plugin license manager for the current plugin and activate it's license.
 */
function yoast_wpseo_local_activate_license() {

	if ( ! class_exists( 'Yoast_Plugin_License_Manager' ) ) {
		return;
	}

	$license_manager = new Yoast_Plugin_License_Manager( new Yoast_Product_WPSEO_Local() );
	$license_manager->activate_license();
}
/*
 * When the plugin is deactivated and activated again, the license have to be activated. This is mostly the case
 * during a update of the plugin. To solve this, we hook into the activation process by calling a method that will
 * activate the license.
 */
register_activation_hook( WPSEO_LOCAL_FILE, 'yoast_wpseo_local_activate_license' );

/**
 * Set defaults settings for Local SEO.
 */
function yoast_wpseo_local_set_defaults() {
	$defaults = array(
		'sl_num_results' => 10,
	);

	$options = get_option( 'wpseo_local' );

	foreach($defaults as $option => $value) {
		if( empty( $options[$option] ) ) {
			$options[$option] = $value;
		}
	}

	update_option( 'wpseo_local', $options );
}

register_activation_hook( WPSEO_LOCAL_FILE, 'yoast_wpseo_local_set_defaults' );
