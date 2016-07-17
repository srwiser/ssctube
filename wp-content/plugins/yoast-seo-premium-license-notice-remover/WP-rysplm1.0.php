<?php
/**
 * Plugin Name: WP Remove Yoast Seo Premium License Notice
 * Description: This will remove the Yoast SEO Premium license notice from your WordPress Dashboard.
 * Author: Babak Mehri
 * Author URI: https://null24.net/
 * Version: 1.0.0
 * License: GPLv2 or later
 */

/**
 * no direct access to files
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; 

/**
 * here we make css injection into the WordPress admin head, Nothing too serios
 */

 // here we remove yoast premium seo message from dashboard
function remove_yoast_license_nag_from_admin_page() {
    echo
    '<style>
		div.error {
			display: none;
		}
	</style>';
}

add_action('admin_head', 'remove_yoast_license_nag_from_admin_page');