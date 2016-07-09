<?php	

	/**
	 * **************************************************
	 * **************************************************
	 * 
	 * 					SETTINGS PAGE
	 * 					
	 * **************************************************
	 * **************************************************
	 */

	function wpvq_settings_init() { 

		register_setting( 'wpvqSettings', 'wpvq_settings', 'wpvq_settings_validate');

		/**
		 * ------------------------------------
		 * 			REGISTER SETTINGS
		 * ------------------------------------
		 */

		/**
		 * General Settings Section
		 */
		add_settings_section(
			'wpvq_wpvqSettings_general_section', 
			'<a name="general"></a><span class="dashicons dashicons-admin-settings"></span> ' . __( 'General Options', 'wpvq' ), 
			'wpvq_settings_general_section_callback', 
			'wpvqSettings'
		);

		add_settings_field( 
			'wpvq_checkbox_autoscroll_next', 
			__("Auto-scroll on game", 'wpvq'),
			'wpvq_checkbox_autoscroll_next_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_general_section' 
		);

		add_settings_field( 
			'wpvq_input_scroll_speed', 
			__("Scroll speed<br>(in milliseconds)", 'wpvq'),
			'wpvq_input_scroll_speed_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_general_section' 
		);

		add_settings_field( 
			'wpvq_input_reaload_page', 
			__("Refresh browser on page changes", 'wpvq'),
			'wpvq_checkbox_refresh_page', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_general_section' 
		);

		/**
		 * Multi-pages settings
		 */
		add_settings_section(
			'wpvq_wpvqSettings_multipages_section', 
			'<a name="multipages"></a><span class="dashicons dashicons-book-alt"></span> ' . __( 'Multipages Quiz Settings', 'wpvq' ), 
			'wpvq_settings_multipages_section_callback', 
			'wpvqSettings'
		);

		add_settings_field( 
			'wpvq_select_show_progressbar', 
			__("Display progressbar", 'wpvq'),
			'wpvq_select_show_progressbar_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_multipages_section' 
		);

		add_settings_field( 
			'wpvq_select_content_progressbar', 
			__("Text in the progressbar", 'wpvq'),
			'wpvq_select_content_progressbar_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_multipages_section' 
		);

		add_settings_field( 
			'wpvq_input_progressbar_color', 
			__("Progressbar color", 'wpvq'),
			'wpvq_input_progressbar_color_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_multipages_section' 
		);

		add_settings_field( 
			'wpvq_input_wait_trivia_page', 
			__("Time before changing page", 'wpvq')."<br/>".__("(in milliseconds)", 'wpvq'),
			'wpvq_input_wait_trivia_page_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_multipages_section' 
		);

		/**
		 * Ads Network
		 */
		add_settings_section(
			'wpvq_wpvqSettings_ads_section',
			'<a name="ads"></a><span class="dashicons dashicons-welcome-widgets-menus"></span> ' . __( 'Ads Settings', 'wpvq' ), 
			'wpvq_wpvqSettings_ads_section_callback', 
			'wpvqSettings'
		);

		add_settings_field( 
			'wpvq_textarea_ads_top', 
			__("Top Ads Code", 'wpvq'),
			'wpvq_textarea_ads_top_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_ads_section' 
		);

		add_settings_field( 
			'wpvq_textarea_ads_bottom', 
			__("Bottom Ads Code", 'wpvq'),
			'wpvq_textarea_ads_bottom_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_ads_section' 
		);

		add_settings_field( 
			'wpvq_textarea_no_ads', 
			__("No ads for these quizzes :", 'wpvq'),
			'wpvq_textarea_no_ads_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_ads_section' 
		);

		/**
		 * Facebook API Section
		 */
		add_settings_section(
			'wpvq_wpvqSettings_section', 
			'<a name="facebook"></a><div style="height:25px;"></div><span class="dashicons dashicons-facebook"></span> ' . __( 'Enable Facebook Share Button', 'wpvq' ), 
			'wpvq_settings_section_callback', 
			'wpvqSettings'
		);

		add_settings_field( 
			'wpvq_text_field_facebook_appid', 
			__('Your Facebook APP ID', 'wpvq'),
			'wpvq_text_field_facebook_appid_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_section' 
		);

		add_settings_field( 
			'wpvq_checkbox_facebook_no_api', 
			__("Don't use Facebook API", 'wpvq'),
			'wpvq_checkbox_facebook_no_api_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_section' 
		);

		add_settings_field( 
			'wpvq_checkbox_facebook_already_api', 
			__("Facebook SDK already included", 'wpvq'),
			'wpvq_checkbox_facebook_already_api_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_section' 
		);

		/**
		 * Social Networking Section
		 */
		add_settings_section(
			'wpvq_wpvqSettings_networking_section_update', 
			'<a name="social"></a><div style="height:25px;"></div><span class="dashicons dashicons-share"></span> ' . __( 'Social Networking Options', 'wpvq' ), 
			'wpvq_settings_networking_section_callback', 
			'wpvqSettings'
		);

		add_settings_field( 
			'wpvq_checkbox_enable_networking', 
			__('Display button for :', 'wpvq'),
			'wpvq_checkbox_enable_networking_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_section_update' 
		);

		add_settings_field( 
			'wpvq_text_field_twitterhashtag', 
			__('Which Twitter hashtag do you want to use:', 'wpvq'),
			'wpvq_text_field_twitterhashtag_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_section_update' 
		);

		/**
		 * Share box settings PERSONALITY
		 */
		add_settings_section(
			'wpvq_wpvqSettings_networking_sharebox_settings_PERSO', 
			'<a name="sharebox"></a><div id="wpvqsharebox" style="height:25px;"></div><span class="dashicons dashicons-format-status"></span> ' . __( 'Social Media Sharebox Settings ', 'wpvq' ) .' '. __('<span class="vq-badge vq-badge-primary">For Personality Quiz</span>', 'wpvq'), 
			'wpvq_settings_sharebox_section_PERSO_callback', 
			'wpvqSettings'
		);

		add_settings_field( 
			'wpvq_text_field_share_local_PERSO', 
			__('Text on your page<br />(below the quiz) :', 'wpvq'),
			'wpvq_text_field_share_local_PERSO_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_sharebox_settings_PERSO' 
		);

		add_settings_field( 
			'wpvq_text_field_share_simple_PERSO', 
			__('Content for Twitter :', 'wpvq'),
			'wpvq_text_field_share_simple_PERSO_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_sharebox_settings_PERSO' 
		);

		add_settings_field( 
			'wpvq_text_field_share_facebook_title_PERSO', 
			__('Content for Facebook Title :', 'wpvq'),
			'wpvq_text_field_share_facebook_title_PERSO_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_sharebox_settings_PERSO' 
		);

		add_settings_field( 
			'wpvq_text_field_share_facebook_desc_PERSO', 
			__('Content for Facebook Description :', 'wpvq'),
			'wpvq_text_field_share_facebook_desc_PERSO_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_sharebox_settings_PERSO' 
		);

		/**
		 * Share box settings TRIVIA
		 */
		add_settings_section(
			'wpvq_wpvqSettings_networking_sharebox_settings_TRIVIA', 
			'<div style="height:25px;"></div><span class="dashicons dashicons-format-status"></span> ' . __( 'Social Media Sharebox Settings ', 'wpvq' ) .' '. __('<span class="vq-badge vq-badge-primary">For TrueFalse Quiz</span>', 'wpvq'), 
			'wpvq_settings_sharebox_section_TRIVIA_callback', 
			'wpvqSettings'
		);


		add_settings_field( 
			'wpvq_text_field_share_local_TRIVIA', 
			__('Text on your page<br />(below the quiz) :', 'wpvq'),
			'wpvq_text_field_share_local_TRIVIA_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_sharebox_settings_TRIVIA' 
		);

		add_settings_field( 
			'wpvq_text_field_share_simple_TRIVIA', 
			__('Content for Twitter :', 'wpvq'),
			'wpvq_text_field_share_simple_TRIVIA_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_sharebox_settings_TRIVIA' 
		);

		add_settings_field( 
			'wpvq_text_field_share_facebook_title_TRIVIA', 
			__('Content for Facebook Title :', 'wpvq'),
			'wpvq_text_field_share_facebook_title_TRIVIA_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_sharebox_settings_TRIVIA' 
		);

		add_settings_field( 
			'wpvq_text_field_share_facebook_desc_TRIVIA', 
			__('Content for Facebook Description :', 'wpvq'),
			'wpvq_text_field_share_facebook_desc_TRIVIA_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_networking_sharebox_settings_TRIVIA' 
		);

		/**
		 * Auto-update Section
		 */
		add_settings_section(
			'wpvq_wpvqSettings_section_update', 
			'<a name="update"></a><div style="height:25px;"></div><span class="dashicons dashicons-update"></span> ' . __( 'Enable Auto Update', 'wpvq' ), 
			'wpvq_settings_update_section_callback', 
			'wpvqSettings'
		);

		add_settings_field( 
			'wpvq_text_field_facebook_appid', 
			__('Your Envato Purchase Code :', 'wpvq'),
			'wpvq_text_field_envato_code_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_section_update' 
		);

		/**
		 * Under the hood
		 */
		add_settings_section(
			'wpvq_wpvqSettings_section_underthehood', 
			'<a name="hood"></a><div style="height:25px;"></div><span class="dashicons dashicons-hammer"></span> ' . __( 'Under the Hood', 'wpvq' ), 
			'wpvq_settings_underthehood_callback', 
			'wpvqSettings'
		);

		add_settings_field( 
			'wpvq_checkbox_noresize_gif', 
			__("Don't resize GIF picture", 'wpvq'),
			'wpvq_checkbox_noresize_gif_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_section_underthehood' 
		);

		add_settings_field( 
			'wpvq_input_scroll_top_offset', 
			__("Auto Scroll Offset", 'wpvq'),
			'wpvq_input_scroll_top_offset_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_section_underthehood' 
		);

		add_settings_field( 
			'wpvq_textarea_custom_css', 
			__("Custom CSS code", 'wpvq'),
			'wpvq_textarea_custom_css_render', 
			'wpvqSettings', 
			'wpvq_wpvqSettings_section_underthehood' 
		);

	}

	/**
	 * ------------------------------------
	 * 			RENDER FUNCTIONS
	 * ------------------------------------
	 */
	
	// Section Title Callback
	function wpvq_settings_general_section_callback() { 
		echo "<a href=\"https://www.institut-pandore.com/wp-viral-quiz/support/\" target=\"_blank\">";
		_e( 'Feel free to contact us', 'wpvq');
		echo '</a> ';
		_e("if you need help about this settings page.", 'wpvq');
	}


	// Auto-scroll next checkbox
	function wpvq_checkbox_autoscroll_next_render() { 
		$options = get_option( 'wpvq_settings' );
		?>
			<label for="wpvq_checkbox_autoscroll_next">
				<input type="checkbox" id="wpvq_checkbox_autoscroll_next" name='wpvq_settings[wpvq_checkbox_autoscroll_next]' <?php if(isset($options['wpvq_checkbox_autoscroll_next']) && $options['wpvq_checkbox_autoscroll_next'] == 1): ?>checked="checked"<?php endif; ?> value="1" />
				<?php _e("Auto-scroll to the next question each time someone click an answer.", 'wpvq'); ?>
			</label>
		<?php
	}

	// Scroll Speed Input
	function wpvq_input_scroll_speed_render() { 
		$options = get_option( 'wpvq_settings' );
		$speed = (isset($options['wpvq_input_scroll_speed']) && !empty($options['wpvq_input_scroll_speed'])) ? $options['wpvq_input_scroll_speed']:WPVQ_SCROLL_SPEED;
		?>
			<label for="wpvq_input_scroll_speed">
				<input type="text" name="wpvq_settings[wpvq_input_scroll_speed]" id="wpvq_input_scroll_speed" value="<?php echo $speed; ?>" style="width:80px; text-align:center;" />
				Default is 750, and it's pretty nice.
			</label>
		<?php
	}

	// Refresh page
	function wpvq_checkbox_refresh_page() { 
		$options = get_option( 'wpvq_settings' );
		?>
			<label for="wpvq_checkbox_refresh_page">
				<input type="checkbox" id="wpvq_checkbox_refresh_page" name='wpvq_settings[wpvq_checkbox_refresh_page]' <?php if(isset($options['wpvq_checkbox_refresh_page']) && $options['wpvq_checkbox_refresh_page'] == 1): ?>checked="checked"<?php endif; ?> value="1" />
				<?php _e("Refresh browser when changing quiz page (cool for pageviews++)", 'wpvq'); ?>
			</label>
		<?php
	}

	// --------------------------------------------------
	
	// Section Multi Pages
	function wpvq_settings_multipages_section_callback() { 
		_e( "Configure your multipages quizzes easily. To understand how to create a multipages quiz,", 'wpvq');
		echo ' <a href="https://www.institut-pandore.com/wp-viral-quiz/faq/#3" target="_blank">';
		_e("read the #3 on the FAQ.", 'wpvq');
		echo "</a>";
	}

	// Display progress bar
	function wpvq_select_show_progressbar_render() 
	{ 
		$options = get_option( 'wpvq_settings' );

		// Deprecated option (only on v1.60)
		if(!isset($options['wpvq_select_show_progressbar'])) {
			$show = 'below';
		} else {
			$show = (isset($options['wpvq_select_show_progressbar'])) ? $options['wpvq_select_show_progressbar']:'hide';
		}

		?>
			<label for="wpvq_select_show_progressbar">
				<select id="wpvq_select_show_progressbar" name='wpvq_settings[wpvq_select_show_progressbar]'>
					<option <?php if($show == 'hide'): ?>selected<?php endif; ?> value="hide"><?php _e("Hide progressbar", 'wpvq'); ?></option>
					<option <?php if($show == 'above'): ?>selected<?php endif; ?> value="above"><?php _e("Display above the quiz", 'wpvq'); ?></option>
					<option <?php if($show == 'below'): ?>selected<?php endif; ?> value="below"><?php _e("Display below the quiz", 'wpvq'); ?></option>
					<option <?php if($show == 'both'): ?>selected<?php endif; ?> value="both"><?php _e("Display above and below", 'wpvq'); ?></option>
				</select>
			</label>
		<?php
	}

	// Progress bar content
	function wpvq_select_content_progressbar_render() { 
		$options = get_option( 'wpvq_settings' );
		$content = (isset($options['wpvq_select_content_progressbar'])) ? $options['wpvq_select_content_progressbar']:'percentage';
		?>
			<label for="wpvq_select_content_progressbar">
				<select name="wpvq_settings[wpvq_select_content_progressbar]" id="wpvq_select_content_progressbar">
					<option value="none" <?php echo ($content=='none') ? 'selected':''; ?>><?php _e("Leave blank", 'wpvq'); ?></option>
					<option value="percentage" <?php echo ($content=='percentage') ? 'selected':''; ?>><?php _e("Show progress percentage (ex: 70%)", 'wpvq'); ?></option>
					<option value="page" <?php echo ($content=='page') ? 'selected':''; ?>><?php _e("Show progress page per page (ex: page 7/10)", 'wpvq'); ?></option>
				</select>
			</label>
		<?php
	}

	// Progress bar color picker
	function wpvq_input_progressbar_color_render() { 
		$options = get_option( 'wpvq_settings' );
		$color = (isset($options['wpvq_input_progressbar_color'])) ? $options['wpvq_input_progressbar_color']:WPVQ_PROGRESSBAR_COLOR;
		?>
			<label for="wpvq_input_progressbar_color">
				<input type="text" name="wpvq_settings[wpvq_input_progressbar_color]" id="wpvq_input_progressbar_color" value="<?php echo $color; ?>" />
			</label>
		<?php
	}

	// Progress bar color picker
	function wpvq_input_wait_trivia_page_render() { 
		$options = get_option( 'wpvq_settings' );
		$wait = (isset($options['wpvq_input_wait_trivia_page']) && is_numeric($options['wpvq_input_wait_trivia_page'])) ? $options['wpvq_input_wait_trivia_page']:WPVQ_WAIT_TRIVIA_PAGE;
		?>
			<label for="wpvq_input_wait_trivia_page">
				<input name="wpvq_settings[wpvq_input_wait_trivia_page]" id="wpvq_input_wait_trivia_page" type="number" value="<?php echo $wait; ?>" style="width:80px; text-align:center;" />
				<?php _e("With no pause, people won't see if they are right or wrong <strong>(TriviaQuiz only)</strong>.", 'wpvq'); ?>
			</label>
		<?php
	}


	// --------------------------------------------------
	
	// Section Ads Pages
	function wpvq_wpvqSettings_ads_section_callback() { 
		_e( "You can <strong>put some ads above and below each of your quizzes</strong>. Just copy and paste the HTML code of your ads in the field below.", 'wpvq');
		echo "<br />";
		_e("If you don't want to display ads for some quizzes, put their ID in the \"no ads\" field (comma separated).", 'wpvq');
	}

	// Display progress bar
	function wpvq_textarea_ads_top_render() 
	{ 
		$options = get_option( 'wpvq_settings' );
		$code = (isset($options['wpvq_textarea_ads_top'])) ? $options['wpvq_textarea_ads_top']:'';

		?>
			<textarea name="wpvq_settings[wpvq_textarea_ads_top]" id="wpvq_settings[wpvq_textarea_ads_top]" cols="30" rows="5"><?php echo $code; ?></textarea>
		<?php
	}

	// Progress bar content
	function wpvq_textarea_ads_bottom_render() {
		$options = get_option( 'wpvq_settings' );
		$code = (isset($options['wpvq_textarea_ads_bottom'])) ? $options['wpvq_textarea_ads_bottom']:'';

		?>
			<textarea name="wpvq_settings[wpvq_textarea_ads_bottom]" id="wpvq_settings[wpvq_textarea_ads_bottom]" cols="30" rows="5"><?php echo $code; ?></textarea>
		<?php
	}

	// Progress bar content
	function wpvq_textarea_no_ads_render() {
		$options = get_option( 'wpvq_settings' );
		$ignoreList = (isset($options['wpvq_textarea_no_ads'])) ? $options['wpvq_textarea_no_ads']:'';

		?>
			<input type="text" name="wpvq_settings[wpvq_textarea_no_ads]" id="wpvq_settings[wpvq_textarea_no_ads]" value="<?php echo $ignoreList; ?>" placeholder="Ex : 12,18,94" />
		<?php
	}

	// -------------------------------------------

	// Section Facebook Configure
	function wpvq_settings_section_callback() { 
		_e( "To enable the Facebook share button, you have to create a Facebook App with your Facebook account. Don't panic, <strong>it's VERY easy</strong>.", 'wpvq');
		echo '<br /><a href="https://www.institut-pandore.com/wp-viral-quiz/how-to-create-a-facebook-app/" target="_blank">'; 
		_e('Click here to understand how to create a Facebook App.', 'wpvq' );
		echo '</a>';
	}
	
	// Input Facebook App ID
	function wpvq_text_field_facebook_appid_render() { 
		$options = get_option( 'wpvq_settings' );
		?>
			<input type='text' id="wpvq_text_field_facebook_appid" name='wpvq_settings[wpvq_text_field_facebook_appid]' value='<?php echo (isset($options['wpvq_text_field_facebook_appid'])) ? $options['wpvq_text_field_facebook_appid']:''; ?>' <?php if(isset($options['wpvq_checkbox_facebook_no_api']) && $options['wpvq_checkbox_facebook_no_api'] == 1 || isset($options['wpvq_checkbox_facebook_already_api']) && $options['wpvq_checkbox_facebook_already_api'] == 1): ?>disabled<?php endif; ?>>
		<?php
	}

	// Checkbox No API
	function wpvq_checkbox_facebook_no_api_render() { 
		$options = get_option( 'wpvq_settings' );
		?>
			<label for="wpvq_checkbox_facebook_no_api">
				<input type="checkbox" id="wpvq_checkbox_facebook_no_api" name='wpvq_settings[wpvq_checkbox_facebook_no_api]' <?php if(isset($options['wpvq_checkbox_facebook_no_api']) && $options['wpvq_checkbox_facebook_no_api'] == 1): ?>checked="checked"<?php endif; ?> value="1" />
				<?php _e("We do not recommend it, check this box if you know what you are doing.", 'wpvq'); ?>
			</label>
		<?php
	}

	// Checkbox API Already loaded
	function wpvq_checkbox_facebook_already_api_render() { 
		$options = get_option( 'wpvq_settings' );
		?>
			<label for="wpvq_checkbox_facebook_already_api">
				<input type="checkbox" id="wpvq_checkbox_facebook_already_api" name='wpvq_settings[wpvq_checkbox_facebook_already_api]' <?php if(isset($options['wpvq_checkbox_facebook_already_api']) && $options['wpvq_checkbox_facebook_already_api'] == 1): ?>checked="checked"<?php endif; ?> value="1" />
				<?php _e("Check if FB SDK is already included on your site. Ignore it if you don't understand.", 'wpvq'); ?>
			</label>
		<?php
	}

	// -------------------------------------------

	// Networking Callback (Enable network, ....)
	function wpvq_settings_networking_section_callback() { 
		_e( "What share buttons do you want to display below the quiz results?", 'wpvq');
		echo "<br/>";
		_e("If you don't want to display share buttons under a particular quiz, you can disable them when you create your quiz.", 'wpvq');
	}

	// Enable/disable share buttons
	function wpvq_checkbox_enable_networking_render() {
		$options 		=  get_option( 'wpvq_settings' );
		$networksRaw 	=  isset($options['wpvq_checkbox_enable_networking']) ? $options['wpvq_checkbox_enable_networking']:'facebook|twitter|googleplus';
		$networks 		=  explode('|', $networksRaw);
		?>
			<label style="margin-right:10px;"><input type="checkbox" name="wpvq_settings[wpvq_checkbox_enable_networking][]" value="facebook" <?php echo (in_array('facebook', $networks)) ? 'checked':''; ?> /> Facebook</label>
			<label style="margin-right:10px;"><input type="checkbox" name="wpvq_settings[wpvq_checkbox_enable_networking][]" value="twitter" <?php echo (in_array('twitter', $networks)) ? 'checked':''; ?> /> Twitter</label>
			<label style="margin-right:10px;"><input type="checkbox" name="wpvq_settings[wpvq_checkbox_enable_networking][]" value="googleplus" <?php echo (in_array('googleplus', $networks)) ? 'checked':''; ?> /> Google+</label>
			<label style="margin-right:10px;"><input type="checkbox" name="wpvq_settings[wpvq_checkbox_enable_networking][]" value="vk" <?php echo (in_array('vk', $networks)) ? 'checked':''; ?> /> VK</label>
		<?php
	}

	// Twitter Hashtag
	function wpvq_text_field_twitterhashtag_render() {
		$options 		=  get_option( 'wpvq_settings' );
		$twitterHashtag =  (isset($options['wpvq_text_field_twitterhashtag'])) ? $options['wpvq_text_field_twitterhashtag']:WPVQ_TWITTER_HASHTAG;
		?>
			<input type="text" value="<?php echo $twitterHashtag; ?>" name="wpvq_settings[wpvq_text_field_twitterhashtag]" />
		<?php
	}

	// -------------------------------------------

	// Sharebox callback (what to display on share message) (PERSO)
	function wpvq_settings_sharebox_section_PERSO_callback() { 
		echo '<a href="'.plugins_url( 'views/img/share-content-big.jpg', __FILE__ ).'" target="_blank"><img src="'.plugins_url( 'views/img/share-content-small.jpg', __FILE__ ).'" class="wpvq-clicktozoom" /></a><br />';
		_e( "Configure share box content for Facebook and Twitter, when people share your quizzes. ", 'wpvq');
		echo "<br />";
		_e("Unfortunately, <strong>Google+ does not let us customize the text</strong> when sharing.", 'wpvq');
		echo "<ul class=\"wpvq-tags-list\">";
			echo "<li><strong>%%personality%%</strong> : ".__('will be replaced by the final result', 'wpvq')."</li>";
			echo "<li><strong>%%details%%</strong> : ".__('will be replaced by the personality description', 'wpvq')."</li>";
			echo "<li><strong>%%total%%</strong> : ".__('will be replaced by the number of questions', 'wpvq')."</li>";
			echo "<li><strong>%%quizname%%</strong> : ".__('will be replaced by the name of your quiz', 'wpvq')."</li>";
			// echo "<li><strong>%%quizlink%%</strong> : ".__('will be replaced by the url of the quiz', 'wpvq')."</li>";
		echo "</ul>";
	}

	// ————- Local display
	function wpvq_text_field_share_local_PERSO_render() {
		$options 		 =  get_option( 'wpvq_settings' );
		$localSharebox  =  (isset($options['wpvq_text_field_share_local_PERSO']) && !empty($options['wpvq_text_field_share_local_PERSO'])) ? $options['wpvq_text_field_share_local_PERSO']:WPVQ_SHARE_PERSO_LOCAL;
		?>
			<input type="text" value="<?php echo $localSharebox; ?>" name="wpvq_settings[wpvq_text_field_share_local_PERSO]" style="width:600px;" />
		<?php
	}

	// ————- Twitter and simple others
	function wpvq_text_field_share_simple_PERSO_render() {
		$options 		 =  get_option( 'wpvq_settings' );
		$simpleSharebox  =  (isset($options['wpvq_text_field_share_simple_PERSO']) && !empty($options['wpvq_text_field_share_simple_PERSO'])) ? $options['wpvq_text_field_share_simple_PERSO']:WPVQ_SHARE_PERSO_SIMPLE;
		?>
			<input type="text" value="<?php echo $simpleSharebox; ?>" name="wpvq_settings[wpvq_text_field_share_simple_PERSO]" style="width:600px;" />
		<?php
	}

	// ————- Facebook Title
	function wpvq_text_field_share_facebook_title_PERSO_render() {
		$options 		=  get_option( 'wpvq_settings' );
		$fbTitle 		=  (isset($options['wpvq_text_field_share_facebook_title_PERSO']) && !empty($options['wpvq_text_field_share_facebook_title_PERSO'])) ? $options['wpvq_text_field_share_facebook_title_PERSO']:WPVQ_SHARE_PERSO_FB_TITLE;
		?>
			<input type="text" value="<?php echo $fbTitle; ?>" name="wpvq_settings[wpvq_text_field_share_facebook_title_PERSO]" style="width:600px;" />
		<?php
	}

	// ————- Facebook Description
	function wpvq_text_field_share_facebook_desc_PERSO_render() {
		$options 		=  get_option( 'wpvq_settings' );
		$fbTitle 		=  (isset($options['wpvq_text_field_share_facebook_desc_PERSO']) && !empty($options['wpvq_text_field_share_facebook_desc_PERSO'])) ? $options['wpvq_text_field_share_facebook_desc_PERSO']:WPVQ_SHARE_PERSO_FB_DESC;
		?>
			<input type="text" value="<?php echo $fbTitle; ?>" name="wpvq_settings[wpvq_text_field_share_facebook_desc_PERSO]" style="width:600px;" />
		<?php
	}

	// Sharebox callback (TRIVIA)
	function wpvq_settings_sharebox_section_TRIVIA_callback() { 
		_e( "Same as the previous section, but for trivia quiz only.", 'wpvq');
		echo "<ul class=\"wpvq-tags-list\">";
			echo "<li><strong>%%score%%</strong> : ".__('will be replaced by the final score', 'wpvq')."</li>";
			echo "<li><strong>%%details%%</strong> : ".__('will be replaced by the appreciation', 'wpvq')."</li>";
			echo "<li><strong>%%total%%</strong> : ".__('will be replaced by the number of questions', 'wpvq')."</li>";
			echo "<li><strong>%%quizname%%</strong> : ".__('will be replaced by the name of your quiz', 'wpvq')."</li>";
			// echo "<li><strong>%%quizlink%%</strong> : ".__('will be replaced by the url of the quiz', 'wpvq')."</li>";
		echo "</ul>";
	}

	// Local display
	function wpvq_text_field_share_local_TRIVIA_render() {
		$options 		 =  get_option( 'wpvq_settings' );
		$localSharebox  =  (isset($options['wpvq_text_field_share_local_TRIVIA']) && !empty($options['wpvq_text_field_share_local_TRIVIA'])) ? $options['wpvq_text_field_share_local_TRIVIA']:WPVQ_SHARE_TRIVIA_LOCAL;
		?>
			<input type="text" value="<?php echo $localSharebox; ?>" name="wpvq_settings[wpvq_text_field_share_local_TRIVIA]" style="width:600px;" />
		<?php
	}

	// Twitter and G+ text
	function wpvq_text_field_share_simple_TRIVIA_render() {
		$options 		 =  get_option( 'wpvq_settings' );
		$simpleSharebox  =  (isset($options['wpvq_text_field_share_simple_TRIVIA']) && !empty($options['wpvq_text_field_share_simple_TRIVIA'])) ? $options['wpvq_text_field_share_simple_TRIVIA']:WPVQ_SHARE_TRIVIA_SIMPLE;
		?>
			<input type="text" value="<?php echo $simpleSharebox; ?>" name="wpvq_settings[wpvq_text_field_share_simple_TRIVIA]" style="width:600px;" />
		<?php
	}

	// Facebook Title
	function wpvq_text_field_share_facebook_title_TRIVIA_render() {
		$options 		=  get_option( 'wpvq_settings' );
		$fbTitle 		=  (isset($options['wpvq_text_field_share_facebook_title_TRIVIA']) && !empty($options['wpvq_text_field_share_facebook_title_TRIVIA'])) ? $options['wpvq_text_field_share_facebook_title_TRIVIA']:WPVQ_SHARE_TRIVIA_FB_TITLE;
		?>
			<input type="text" value="<?php echo $fbTitle; ?>" name="wpvq_settings[wpvq_text_field_share_facebook_title_TRIVIA]" style="width:600px;" />
		<?php
	}

	// Facebook Description
	function wpvq_text_field_share_facebook_desc_TRIVIA_render() {
		$options 		=  get_option( 'wpvq_settings' );
		$fbTitle 		=  (isset($options['wpvq_text_field_share_facebook_desc_TRIVIA']) && !empty($options['wpvq_text_field_share_facebook_desc_TRIVIA'])) ? $options['wpvq_text_field_share_facebook_desc_TRIVIA']:WPVQ_SHARE_TRIVIA_FB_DESC;
		?>
			<input type="text" value="<?php echo $fbTitle; ?>" name="wpvq_settings[wpvq_text_field_share_facebook_desc_TRIVIA]" style="width:600px;" />
		<?php
	}

	// -------------------------------------------

	// Section Title Callback (Update)
	function wpvq_settings_update_section_callback() { 
		_e( "To enable auto-update (very recommended), you have to put your Envato Purchase Code here.", 'wpvq');
		echo '<br /><a href="https://www.institut-pandore.com/wp-viral-quiz/how-to-get-my-envato-purchase-code/" target="_blank">'; 
		_e('Click here to understand how to get your purchase code.', 'wpvq' );
		echo '</a>';
	}

	// Input Call Back (Envato App Purchase)
	function wpvq_text_field_envato_code_render() { 
		$options = get_option( 'wpvq_settings' );
		?>
			<input type='text' id="wpvq_text_field_envato_code" name='wpvq_settings[wpvq_text_field_envato_code]' value='<?php echo (isset($options['wpvq_text_field_envato_code'])) ? $options['wpvq_text_field_envato_code']:''; ?>' placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx" style="width:300px;">
		<?php
	}

	// -------------------------------------------
	
	// Section Under The Hood
	function wpvq_settings_underthehood_callback() { 
		_e( "Complex or very specific settings. Ignore them if you don't need them.", 'wpvq');
	}

	// Gif resize disable
	function wpvq_checkbox_noresize_gif_render() {
		$options = get_option( 'wpvq_settings' );
		?>
			<label for="wpvq_checkbox_noresize_gif">
				<input type="checkbox" id="wpvq_checkbox_noresize_gif" name='wpvq_settings[wpvq_checkbox_noresize_gif]' <?php if(isset($options['wpvq_checkbox_noresize_gif'])): ?>checked="checked"<?php endif; ?> value="1" />
				<?php _e("Do not resize gif automatically on your quizzes (resize destroyes the animation)", 'wpvq'); ?>
			</label>
		<?php
	}

	// Scroll top offset
	function wpvq_input_scroll_top_offset_render() {
		$options = get_option( 'wpvq_settings' );
		$scrollTop = (isset($options['wpvq_input_scroll_top_offset']) && is_numeric($options['wpvq_input_scroll_top_offset'])) ? $options['wpvq_input_scroll_top_offset'] : WPVQ_SCROLL_OFFSET ; 
		?>
			<label for="wpvq_input_scroll_top_offset">
				<input type="number" id="wpvq_input_scroll_top_offset" name='wpvq_settings[wpvq_input_scroll_top_offset]' value='<?php echo $scrollTop; ?>' style="width:70px;text-align:center;"> px
			</label>
		<?php
	}

	// Custom CSS editor
	function wpvq_textarea_custom_css_render() {
		$options 	=  get_option( 'wpvq_settings' );
		$css 		=  (isset($options['wpvq_textarea_custom_css'])) ? $options['wpvq_textarea_custom_css']:'';
		?>
			<style>
				textarea#wpvq_textarea_custom_css { 
					font-family: monospace; 
					background:#272822;
				    color:white;
				}
				textarea#wpvq_textarea_custom_css:focus { 
				 	outline: none !important;
				    box-shadow:none;
				}
			</style>
			<label for="wpvq_textarea_custom_css">
				<textarea name="wpvq_settings[wpvq_textarea_custom_css]" id="wpvq_textarea_custom_css" cols="60" rows="12"><?php echo $css; ?></textarea>
			</label>
		<?php
	}

	// -------------------------------------------	

	function wp_viral_quiz_options_page() { 
		?>

		<div class="wrap">

			<div id="wpvq-fixed-settings-menu">
				<h3><?php _e("Sections Menu :", 'wpvq'); ?></h3>
				<ul>
					<li><a href="#" class="wpvq-menu-anchor" data-anchor="general"><?php _e("General Options", 'wpvq'); ?></a></li>
					<li><a href="#" class="wpvq-menu-anchor" data-anchor="multipages"><?php _e("Multipages Quiz Settings", 'wpvq'); ?></a></li>
					<li><a href="#" class="wpvq-menu-anchor" data-anchor="ads"><?php _e("Ads Settings", 'wpvq'); ?></a></li>
					<li><a href="#" class="wpvq-menu-anchor" data-anchor="facebook"><?php _e("Facebook Share Button", 'wpvq'); ?></a></li>
					<li><a href="#" class="wpvq-menu-anchor" data-anchor="social"><?php _e("Social Networking Options", 'wpvq'); ?></a></li>
					<li><a href="#" class="wpvq-menu-anchor" data-anchor="sharebox"><?php _e("Social Media Sharebox Settings", 'wpvq'); ?></a></li>
					<li><a href="#" class="wpvq-menu-anchor" data-anchor="update"><?php _e("Enable Auto Update", 'wpvq'); ?></a></li>
					<li><a href="#" class="wpvq-menu-anchor" data-anchor="hood"><?php _e("Under the Hood", 'wpvq'); ?></a></li>
				</ul>
			</div>

			<div class="vq-medium">
				<form action='options.php' method='post'>
					<h2>WP Viral Quiz – <strong><?php _e("Settings", 'wpvq'); ?></strong></h2>
					<hr />

						<?php if( isset($_GET['settings-updated']) ) { ?>
						    <div id="message" class="updated" style="margin-left:0px;">
						        <p><strong><?php _e("Settings updated.", 'wpvq'); ?></strong></p>
						    </div>
						<?php } ?>
						
					
					<?php
						settings_fields( 'wpvqSettings' );
						do_settings_sections( 'wpvqSettings' );
						submit_button();
					?>
				</form>
			</div>
		</div>
		<?php
	}

	/**
	 * Validation callback function
	 * @param  array $input $_POST
	 * @return array        $_POST after computing
	 */
	function wpvq_settings_validate($input)
	{
		$input['wpvq_checkbox_enable_networking'] = (!isset($input['wpvq_checkbox_enable_networking'])) ? array():$input['wpvq_checkbox_enable_networking'];
		$input['wpvq_checkbox_enable_networking'] = implode('|', $input['wpvq_checkbox_enable_networking']);

		$input['wpvq_textarea_no_ads'] = trim(str_replace(' ', '', $input['wpvq_textarea_no_ads']));

		if (!is_numeric($input['wpvq_input_scroll_speed']) || $input['wpvq_input_scroll_speed'] == 0 || $input['wpvq_input_scroll_speed'] > 2500) {
			$input['wpvq_input_scroll_speed'] = 750;
		}

		// Progress bar hexa code (default if failure)
		if (!preg_match('/^#[0-9a-f]{3,6}$/i', $input['wpvq_input_progressbar_color'])) {
			$input['wpvq_input_progressbar_color'] = '#2bc253';
		}

		// Progress bar content (default if failure)
		if (!in_array($input['wpvq_select_content_progressbar'], array('none', 'percentage', 'page'))) {
			$input['wpvq_select_content_progressbar'] = 'percentage';
		}

		return $input;
	}