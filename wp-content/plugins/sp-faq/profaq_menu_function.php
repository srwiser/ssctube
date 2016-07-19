<?php
// Action to add menu
add_action('admin_menu', 'faq_submenu_page');

function faq_submenu_page() {
	add_submenu_page( 'edit.php?post_type=sp_faq', 'Pro FAQ Designs', 'Pro FAQ Designs', 'manage_options', 'profaq-submenu-page', 'register_faq_page_callback' );
}

function register_faq_page_callback() {

	$wp_faqp_feed_tabs = array(
								'design-feed' 	=> __('Plugin Designs', 'sp-faq'),
								'plugins-feed' 	=> __('Our Plugins', 'sp-faq')
							);

	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'design-feed';
	?>
	
	<div class="wrap wp-faq-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wp_faqp_feed_tabs as $tab_key => $tab_val) {

				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array('post_type' => SP_FAQ_POST_TYPE, 'page' => 'profaq-submenu-page', 'tab' => $tab_key), admin_url('edit.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_val; ?></a>

			<?php } ?>
		</h2>

		<div class="wp-faq-tab-cnt-wrp">
		<?php 
			if( isset($_GET['tab']) && $_GET['tab'] == 'plugins-feed' ) {
				echo wp_faq_get_design( 'plugins-feed' );
			} else {
				echo wp_faq_get_design();
			}
		?>
		</div><!-- end .wp-faq-tab-cnt-wrp -->

	</div><!-- end .wp-faq-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package WP FAQ
 * @since 3.2.4
 */
function wp_faq_get_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'design-feed';
	
	$cache = get_transient( 'wp_faq_' . $active_tab );
	
	if ( false === $cache ) {
		
		// Feed URL
		if( $feed_type == 'plugins-feed' ) {
			$url = 'http://wponlinesupport.com/plugin-data-api/plugins-data.php';
		} else {
			$url = 'http://wponlinesupport.com/plugin-data-api/wp-faq/wp-faq.php';
		}
		
		$feed = wp_remote_get( esc_url_raw( $url ), array( 'timeout' => 120, 'sslverify' => false ) );
		
		if ( ! is_wp_error( $feed ) ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( 'wp_faq_' . $active_tab, $cache, 172800 );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'wp-blog-and-widgets' ) . '</div>';
		}
	}
	return $cache;
}