<?php 

	// Default configuration
	require_once dirname(__FILE__) . '/../wpvq-settings-page.php';

	global $wpdata;
	$quiz = $wpdata['quiz'];

	// Quiz General Settings
	$wpvq_options 				=  get_option( 'wpvq_settings' );
	$wpvq_facebookAppID 		=  (isset($wpvq_options['wpvq_text_field_facebook_appid'])) ? $wpvq_options['wpvq_text_field_facebook_appid']:'' ;
	$wpvq_dont_use_FBAPI 		=  (isset($wpvq_options['wpvq_checkbox_facebook_no_api'])) ? true:false;
	$wpvq_API_already_loaded 	=  (isset($wpvq_options['wpvq_checkbox_facebook_already_api'])) ? true:false;

	// General Settings
	$wpvq_autoscroll 		   	=  (isset($wpvq_options['wpvq_checkbox_autoscroll_next'])) ? 'true':'false';
	$wpvq_scrollSpeed 		   	=  (isset($wpvq_options['wpvq_input_scroll_speed'])) ? $wpvq_options['wpvq_input_scroll_speed']:WPVQ_SCROLL_SPEED;
	
	// Multipages quiz (deprecated option since v1.60)
	if (isset($wpvq_options['wpvq_select_show_progressbar'])) {
		$wpvq_display_progressbar = $wpvq_options['wpvq_select_show_progressbar'];
	} else {
		$wpvq_display_progressbar = isset($options['wpvq_checkbox_show_progressbar']) ? 'below':'hide';
	}

	$wpvq_content_progressbar  	=  (isset($wpvq_options['wpvq_select_content_progressbar'])) ? $wpvq_options['wpvq_select_content_progressbar']:'percentage';
	$wpvq_progressbar_color    	=  (isset($wpvq_options['wpvq_input_progressbar_color'])) ? $wpvq_options['wpvq_input_progressbar_color']:WPVQ_PROGRESSBAR_COLOR;
	$wpvq_wait_trivia_page	 	=  (isset($wpvq_options['wpvq_input_wait_trivia_page'])) ? $wpvq_options['wpvq_input_wait_trivia_page']:WPVQ_WAIT_TRIVIA_PAGE;
	$wpvq_refresh_page	 		=  (isset($wpvq_options['wpvq_checkbox_refresh_page'])) ? true:false;

	// Ads settings
	$wpvq_textarea_ads_top 		=  (isset($wpvq_options['wpvq_textarea_ads_top'])) ? $wpvq_options['wpvq_textarea_ads_top']:'';
	$wpvq_textarea_ads_bottom 	=  (isset($wpvq_options['wpvq_textarea_ads_bottom'])) ? $wpvq_options['wpvq_textarea_ads_bottom']:'';
	$wpvq_textarea_no_ads 		=  explode(',', (isset($wpvq_options['wpvq_textarea_no_ads'])) ? $wpvq_options['wpvq_textarea_no_ads']:'');
	$wpvq_display_ads 			=  !(in_array($q->getId(), $wpvq_textarea_no_ads));

	// If auto-refresh on new page
	// Fetch answers if browser change URL parameter (wpvqas [i.e. answerStatus] base64 serialized)
	// wpvqas['wpvqas'] = array of value — wpvqas['wpvqn'] = current browser page (int)
	$wpvq_browser_page 		= 0;
	$wpvq_count_questions   = 'false';
	$wpvq_answersStatus 	= '[]'; // empty js array
	$wpvq_refresh_url 		= esc_url('//' . htmlspecialchars($_SERVER['HTTP_HOST']) . add_query_arg(array('wpvqas'=>'%%wpvqas%%')));
	if ($wpvq_refresh_page && isset($_GET['wpvqas']))
	{
		$wpvq_getAnswersStatus = array();
		parse_str(urldecode(base64_decode($_GET['wpvqas'])), $wpvq_getAnswersStatus);

		$wpvq_browser_page 		=  intval($wpvq_getAnswersStatus['wpvqn']);
		$wpvq_count_questions 	=  intval($wpvq_getAnswersStatus['wpvqcq']);

		// Can be empty on TrueFalse, if we don't transmit true answers
		if (isset($wpvq_getAnswersStatus['wpvqas'])) {
			$wpvq_answersStatus = json_encode($wpvq_getAnswersStatus['wpvqas']);
		}
	}

	// Social Share Box 
	// —— PERSO
	$wpvq_share_perso_local 	=  (isset($wpvq_options['wpvq_text_field_share_local_PERSO']) && !empty($wpvq_options['wpvq_text_field_share_local_PERSO'])) ? $wpvq_options['wpvq_text_field_share_local_PERSO'] : WPVQ_SHARE_PERSO_LOCAL;
	$wpvq_share_perso_simple 	=  (isset($wpvq_options['wpvq_text_field_share_simple_PERSO']) && !empty($wpvq_options['wpvq_text_field_share_simple_PERSO'])) ? $wpvq_options['wpvq_text_field_share_simple_PERSO'] : WPVQ_SHARE_PERSO_SIMPLE;
	$wpvq_share_perso_fb_title 	=  (isset($wpvq_options['wpvq_text_field_share_facebook_title_PERSO']) && !empty($wpvq_options['wpvq_text_field_share_facebook_title_PERSO'])) ? $wpvq_options['wpvq_text_field_share_facebook_title_PERSO'] : WPVQ_SHARE_PERSO_FB_TITLE;
	$wpvq_share_perso_fb_desc 	=  (isset($wpvq_options['wpvq_text_field_share_facebook_desc_PERSO']) && !empty($wpvq_options['wpvq_text_field_share_facebook_desc_PERSO'])) ? $wpvq_options['wpvq_text_field_share_facebook_desc_PERSO'] : WPVQ_SHARE_PERSO_FB_DESC;
	// —— TRIVIA
	$wpvq_share_trivia_local 	=  (isset($wpvq_options['wpvq_text_field_share_local_TRIVIA']) && !empty($wpvq_options['wpvq_text_field_share_local_TRIVIA'])) ? $wpvq_options['wpvq_text_field_share_local_TRIVIA'] : WPVQ_SHARE_TRIVIA_LOCAL;
	$wpvq_share_trivia_simple 	=  (isset($wpvq_options['wpvq_text_field_share_simple_TRIVIA']) && !empty($wpvq_options['wpvq_text_field_share_simple_TRIVIA'])) ? $wpvq_options['wpvq_text_field_share_simple_TRIVIA'] : WPVQ_SHARE_TRIVIA_SIMPLE;
	$wpvq_share_trivia_fb_title =  (isset($wpvq_options['wpvq_text_field_share_facebook_title_TRIVIA']) && !empty($wpvq_options['wpvq_text_field_share_facebook_title_TRIVIA'])) ? $wpvq_options['wpvq_text_field_share_facebook_title_TRIVIA'] : WPVQ_SHARE_TRIVIA_FB_TITLE;
	$wpvq_share_trivia_fb_desc 	=  (isset($wpvq_options['wpvq_text_field_share_facebook_desc_TRIVIA']) && !empty($wpvq_options['wpvq_text_field_share_facebook_desc_TRIVIA'])) ? $wpvq_options['wpvq_text_field_share_facebook_desc_TRIVIA'] : WPVQ_SHARE_TRIVIA_FB_DESC;

	// Under the hood
	$wpvq_noresize_gif  	   	=  (isset($wpvq_options['wpvq_checkbox_noresize_gif']));
	$wpvq_textarea_custom_css	=  (isset($wpvq_options['wpvq_textarea_custom_css'])) ? $wpvq_options['wpvq_textarea_custom_css']:'';
	$wpvq_scroll_top_offset		=  (isset($wpvq_options['wpvq_input_scroll_top_offset'])) ? $wpvq_options['wpvq_input_scroll_top_offset']:0;

	// Social Options
	$wpvq_twitter_hashtag 	=  str_replace('#', '', (isset($wpvq_options['wpvq_text_field_twitterhashtag'])) ? $wpvq_options['wpvq_text_field_twitterhashtag'] : WPVQ_TWITTER_HASHTAG );
	$wpvq_networks 			=  array_filter(explode('|', isset($wpvq_options['wpvq_checkbox_enable_networking']) ? $wpvq_options['wpvq_checkbox_enable_networking']:'facebook|twitter|googleplus'));
	$wpvq_networks_display 	=  array(
		'twitter'		=> in_array('twitter', $wpvq_networks),
		'facebook'		=> in_array('facebook', $wpvq_networks),
		'googleplus'	=> in_array('googleplus', $wpvq_networks),
		'vk'			=> in_array('vk', $wpvq_networks),
	);

	// Quiz Social Settings
	$wpvq_show_sharing 	=  ($quiz->getShowSharing() && !empty($wpvq_networks));
	$wpvq_force_share 	=  $quiz->getForceToShare();

?>

<!-- Load CSS Skin Theme -->
<!-- Weird, but HTML5 compliant! o:-) -->
<style> @import url(<?php echo plugins_url( '../css/', __FILE__ ) . 'front-style.css'; ?>); </style>
<?php if ($quiz->getSkin() != 'custom'): ?>
	<style> @import url(<?php echo plugins_url( '../css/skins/', __FILE__ ) . $quiz->getSkin() . '.css'; ?>); </style>
<?php else: ?>
	<style> @import url(<?php echo dirname(get_stylesheet_uri()) . '/wpvq-custom.css'; ?>); </style>
<?php endif; ?>

<!-- Custom style -->
<style>
	<?php echo $wpvq_textarea_custom_css; ?>
</style>

<!-- Prepare sharing options -->
<?php if ($wpvq_show_sharing || $wpvq_force_share): ?>

	<?php
		// Manage social message	
		if ( $quiz->getNiceType() == 'TrueFalse' )
		{
			$twitterText 			=  parse_share_tags_settings($wpvq_share_trivia_simple, $quiz);
			$facebookTitle 			=  parse_share_tags_settings($wpvq_share_trivia_fb_title, $quiz);
			$facebookDescription 	=  parse_share_tags_settings($wpvq_share_trivia_fb_desc, $quiz);
			$localCaption 			=  parse_share_tags_settings($wpvq_share_trivia_local, $quiz);
		}
		elseif( $quiz->getNiceType() ==  'Personality' )
		{
			$twitterText 			=  parse_share_tags_settings($wpvq_share_perso_simple, $quiz);
			$facebookTitle 			=  parse_share_tags_settings($wpvq_share_perso_fb_title, $quiz);
			$facebookDescription 	=  parse_share_tags_settings($wpvq_share_perso_fb_desc, $quiz);
			$localCaption 			=  parse_share_tags_settings($wpvq_share_perso_local, $quiz);
		}

		// Final _server-side_ variables
		$facebookLink 			=  get_permalink();
		$facebookDescription 	=  wpvq_delete_quotes($facebookDescription);
		$facebookTitle 			=  wpvq_delete_quotes($facebookTitle);
		$twitterText 			=  wpvq_delete_quotes(str_replace(' ', '+', stripslashes($twitterText)));
		$localCaption 			=  wpvq_delete_quotes($localCaption);
	?>

	<?php if ($wpvq_networks_display['vk']): ?>
		<script type="text/javascript" src="http://vk.com/js/api/share.js?9"; charset="windows-1251"></script>
	<?php endif; ?>

	<!-- Facebook Share API -->
	<?php if (!$wpvq_API_already_loaded): ?>
		<div id="fb-root"></div>
	<?php endif; ?>
	
	<script type="text/javascript">

		<?php if (!$wpvq_API_already_loaded): ?>
			(function(d){
				 var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
				 if (d.getElementById(id)) {return;}
				 js = d.createElement('script'); js.id = id; js.async = true;
				 js.src = "//connect.facebook.net/en_US/all.js";
				 ref.parentNode.insertBefore(js, ref);
			}(document))
		<?php endif; ?>

	</script>

<?php endif ?>
<!-- / Prepare sharing options -->
	
<!--  Created w/ WP Viral Quiz - https://www.institut-pandore.com/wp-viral-quiz/download -->
<div id="wpvq-quiz-<?php echo $quiz->getId(); ?>" class="wpvq <?php echo $quiz->getNiceType(); ?> columns-<?php echo $wpdata['columns']; ?>">

	<?php if ($wpvq_display_ads): ?>
		<div class="wpvq-a-d-s wpvq-top-a-d-s">
			<?php echo $wpvq_textarea_ads_top; ?>
		</div>
	<?php endif; ?>

	<?php if ($quiz->getPageCounter() > 1 && ($wpvq_display_progressbar == 'above' || $wpvq_display_progressbar == 'both')): ?>
		<!-- Progress bar -->
		<div class="wpvq-page-progress wpvq_bar_container wpvq_bar_container_top">
		    <div class="wpvq-progress">
				<span class="wpvq-progress-value" style="background-color:<?php echo $wpvq_progressbar_color; ?>"></span>
			</div>
		</div>
	<?php endif ?>

	<!-- Preload checkbox pictures (checked + loader) -->
	<div id="preload-checkbox-checked"></div>
	<div id="preload-checkbox-loader"></div>
	<div id="preload-checkbox-big-loader"></div>

	<div id="wpvq-page-0" class="wpvq-single-page" <?php if ($wpvq_refresh_page && $wpvq_browser_page == 0): ?>style="display:block;"<?php else: ?>style="display:none;"<?php endif; ?>>
		<?php 
			foreach($quiz->getQuestions() as $q):

				$disposition 	=  $q->squareOrLine();
				$label 			=  stripslashes($q->getLabel());
				
				// Pagination
				$isTherePage 	=  $q->isTherePageAfter();
				$currentPage 	=  (!isset($currentPage)) ? 0 : $currentPage;

				$max_width 		=  get_option( 'thumbnail_size_w' );
				$max_height 	=  get_option( 'thumbnail_size_h' );
		?>

			<div class="wpvq-question wpvq-<?php echo $disposition; ?>" data-pageAfter="<?php echo ($isTherePage) ? 'true':'false'; ?>">
				<div class="wpvq-question-label"><?php echo $label; ?></div>
				
				<?php 
					if($q->getPictureId() > 0):
						$image  	=  wp_get_attachment_image_src($q->getPictureId(), 'full');
						$imageInfo 	=  wp_get_attachment($q->getPictureId());
						$wpvq_width = ($image[1] == 0) ? 'auto':$image[1].'px';
				?>
					<div style="position:relative;width:<?php echo $wpvq_width; ?>;max-width:100%; margin:0 auto;">
						<img src="<?php echo wp_get_attachment_url($q->getPictureId()); ?>" alt="<?php echo $label; ?>" class="wpvq-question-img" />
						<?php if ($imageInfo['description'] != ''): ?>
							<span class="wpvq-img-legal-label"><?php echo $imageInfo['description']; ?></span>
						<?php endif ?>
					</div>
				<?php endif; ?>
			
				<?php 
					foreach ($q->getAnswers() as $an):
				?>
					<div class="wpvq-answer" data-wpvq-answer="<?php echo $an->getId(); ?>">

						<!-- Weight+multiplier ID -->
						<?php if ($quiz->getNiceType() == 'Personality'): ?>
							<?php foreach ($an->getMultipliers() as $appreciationId => $multiplier): ?>
								<input class="wpvq-appreciation" type="hidden" value="<?php echo $multiplier; ?>" data-appreciationId="<?php echo $appreciationId; ?>" />
							<?php endforeach; ?>
						<?php endif; ?>

						<?php 
							if($an->getPictureId() > 0):
								$imageInfo  = wp_get_attachment($an->getPictureId());
								$image 		= wp_get_attachment_image_src($an->getPictureId(), 'wpvq-square-answer');
								$imageUrl 	= $image[0];
								$wpvq_width = ($image[1] == 0) ? 'auto':$image[1].'px';

								// Don't resize gif if user doesn't want
								$fileInfo = pathinfo($imageUrl);
								if ($fileInfo['extension'] == 'gif' && $wpvq_noresize_gif) {
									$image = wp_get_attachment_image_src($an->getPictureId(), 'full');
									$imageUrl = $image[0];
								}
						?>

								<!--  Display a tiny label from the DESCRIPTION field -->
								<div style="position:relative;width:<?php echo $wpvq_width; ?>;max-width:100%; margin:0 auto;">
									<img src="<?php echo $imageUrl; ?>" alt="<?php echo $an->getLabel(); ?>" class="wpvq-answer-img" />
									<?php if ($imageInfo['description'] != ''): ?>
										<span class="wpvq-img-legal-label"><?php echo $imageInfo['description']; ?></span>
									<?php endif; ?>
								</div>

						<?php endif; ?>

						<input type="radio" class="vq-css-checkbox" data-wpvq-answer="<?php echo $an->getId(); ?>" />
						<label class="vq-css-label">
							<?php if ($an->getLabel() == ''): ?>
								<span style="visibility:hidden;">&nbsp;</span>
							<?php else: ?>
								<?php echo stripslashes($an->getLabel()); ?>
							<?php endif; ?>
						</label>
					</div>
				<?php
					endforeach;
				?>

				<div class="wpvq-clear"></div>

				<div class="wpvq-explaination">
					<div class="wpvq-true"><?php _e('Correct!', 'wpvq') ?></div>
					<div class="wpvq-false"><?php _e('Wrong!', 'wpvq') ?></div>
					<p class="wpvq-explaination-content"></p>
				</div>

			</div>

			<?php if ($isTherePage): $currentPage++; ?>
					<div class="wpvq-next-page" style="display:none;">
						<button class="wpvq-next-page-button" style="background:<?php echo $wpvq_progressbar_color; ?>;"><?php _e("Continue >>", 'wpvq'); ?></button>
					</div>
				</div> <!-- close previous page -->

				<div id="wpvq-page-<?php echo $currentPage; ?>" class="wpvq-single-page">
			<?php endif ?>
		<?php endforeach; ?>
	</div> <!-- Final page close -->

	<!-- Force to share -->
	<div id="wpvq-forceToShare-before-results">

			<p class="wpvq-forceToShare-please"><?php echo apply_filters('wpvq_shareToShow_label', __("Share the quiz to show your results !", 'wpvq')); ?></p>

			<a href="javascript:PopupFeed('<?php echo get_permalink(); ?>')" class="wpvq-facebook-noscript">
				<div class="wpvq-social-facebook wpvq-social-button">
				    <i class="wpvq-social-icon"><i class="fa fa-facebook"></i></i>
					<div class="wpvq-social-slide">
					    <p>Facebook</p>
					</div>
			  	</div>
			</a>
			
			<a href="#" class="wpvq-facebook-share-button wpvq-facebook-yesscript" style="display:none;">
				<div class="wpvq-social-facebook wpvq-social-button">
				    <i class="wpvq-social-icon"><i class="fa fa-facebook"></i></i>
					<div class="wpvq-social-slide">
					    <p>Facebook</p>
					</div>
			  	</div>
			</a>

			<hr class="wpvq-clear-invisible" />
	</div>

	<!-- Force to give some informations -->
	<div id="wpvq-ask-before-results">
		<form id="wpvq-form-informations" action="" method="post">

			<p class="wpvq-who-are-you">
				<?php echo apply_filters('wpvq_who_are_you_label', __("Just tell us who you are to view your results !", 'wpvq')); ?>
			</p>

			<?php if ($quiz->askNickname()): ?>
				<div class="wpvq-input-block" id="wpvq-askNickname">
					<label><?php echo apply_filters('wpvq_nickname_label', __("Your first name :", 'wpvq')); ?></label>
					<input type="text" name="wpvq_askNickname" />
				</div>
			<?php endif; ?>


			<?php if ($quiz->askEmail()): ?>
				<div class="wpvq-input-block" id="wpvq-askEmail">
					<label><?php echo apply_filters('wpvq_email_label', __("Your e-mail address :", 'wpvq')); ?></label>
					<input type="text" name="wpvq_askEmail" />
				</div>
			<?php endif; ?>

			<?php do_action('wpvq_add_fields', $quiz->getId()); ?>

			<input type="hidden" id="wpvq_ask_result" name="wpvq_ask_result" value="<?php echo $quiz->getId(); ?>" />
			<input type="hidden" name="wpvq_quizId" value="<?php echo $quiz->getId(); ?>" />

			<p class="wpvq-submit-button-ask">
				<button type="submit" id="wpvq-submit-informations"><?php echo apply_filters('wpvq_show_my_results_label', __("Show my results >>", 'wpvq')); ?></button>
			</p>
		</form>
	</div>

	<!-- Show results -->
	<div id="wpvq-general-results">

		<div id="wpvq-big-loader">
			<img src="<?php echo plugins_url( 'img/big-loader.gif', __FILE__ ); ?>" alt="" />
		</div>

		<?php if ($quiz->getNiceType() == 'TrueFalse'): ?>
			<div id="wpvq-final-score">
				<span class="wpvq-quiz-title"><?php echo stripslashes($quiz->getName()); ?></span>
				<span class="wpvq-local-caption wpvq-headline"><?php echo $wpvq_share_trivia_local; ?></span>
				<div class="wpvq-appreciation-content"></div>
		<?php elseif ($quiz->getNiceType() == 'Personality'): ?>
			<div id="wpvq-final-personality">
				<span class="wpvq-quiz-title"><?php echo stripslashes($quiz->getName()); ?></span>
				<span class="wpvq-local-caption wpvq-you-are"><?php echo $wpvq_share_perso_local; ?></span>
				<div class="wpvq-personality-content"></div>
		<?php endif; ?>

			<?php if ($wpvq_show_sharing): ?>
				<div id="wpvq-share-buttons">

					<p class="wp-share-results">
						<?php echo apply_filters('wpvq_share_results_label', __('Share your results', 'wpvq')); ?> : 
					</p>

					<hr class="wpvq-clear-invisible" />

					<?php if ($wpvq_networks_display['facebook']): ?>

						<a href="javascript:PopupFeed('<?php echo get_permalink(); ?>')" class="wpvq-facebook-noscript">
							<div class="wpvq-social-facebook wpvq-social-button">
							    <i class="wpvq-social-icon"><i class="fa fa-facebook"></i></i>
								<div class="wpvq-social-slide">
								    <p>Facebook</p>
								</div>
						  	</div>
						</a>

						<a href="#" class="wpvq-facebook-share-button wpvq-facebook-yesscript" style="display:none;">
							<div class="wpvq-social-facebook wpvq-social-button">
							    <i class="wpvq-social-icon"><i class="fa fa-facebook"></i></i>
								<div class="wpvq-social-slide">
								    <p>Facebook</p>
								</div>
						  	</div>
						</a>

					<?php endif; ?>
					 
					<!-- Twitter -->
					<?php if ($wpvq_networks_display['twitter']): ?>
						<a href="http://twitter.com/share?url=<?php echo get_permalink(); ?>&text=<?php echo $twitterText; ?>&hashtags=<?php echo $wpvq_twitter_hashtag; ?>" target="_blank" class="wpvq-js-loop wpvq-twitter-share-popup">
							<div class="wpvq-social-twitter wpvq-social-button">
							    <i class="wpvq-social-icon"><i class="fa fa-twitter"></i></i>
								<div class="wpvq-social-slide">
								    <p>Twitter</p>
								</div>
						  	</div>
						</a>
					<?php endif ?>
					 
					<!-- Google+ -->
					<?php if ($wpvq_networks_display['googleplus']): ?>
						<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank" class="wpvq-js-loop wpvq-gplus-share-popup">
							<div class="wpvq-social-google wpvq-social-button">
							    <i class="wpvq-social-icon"><i class="fa fa-google-plus"></i></i>
								<div class="wpvq-social-slide">
								    <p>Google+</p>
								</div>
						  	</div>
						</a>
					<?php endif; ?>

					<!-- VK Share Javascript Code -->
					<?php if ($wpvq_networks_display['vk']): ?>
						<div class="wpvq-vk-share-content wpvq-js-loop">

						</div>
					<?php endif; ?>

					<hr class="wpvq-clear-invisible" />

				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ($quiz->getPageCounter() > 1 && ($wpvq_display_progressbar == 'below' || $wpvq_display_progressbar == 'both')): ?>
		<!-- Progress bar -->
		<div class="wpvq-page-progress wpvq_bar_container wpvq_bar_container_bottom">
		    <div class="wpvq-progress">
				<span class="wpvq-progress-value" style="background-color:<?php echo $wpvq_progressbar_color; ?>"></span>
			</div>
		</div>
	<?php endif ?>

	<?php if ($wpvq_display_ads): ?>
		<div class="wpvq-a-d-s wpvq-bottom-a-d-s">
			<?php echo $wpvq_textarea_ads_bottom; ?>
		</div>
	<?php endif; ?>
	
</div>

<?php if ($quiz->getShowCopyright() == 1): ?>
	<p class="wpvq-small-copyright">
		<?php _e("This quiz has been created with", 'wpvq'); ?> <a href="http://paton.media/wordpress-viral-quiz/presentation" target="_blank">WordPress Viral Quiz &hearts;</a>.
	</p>
<?php endif; ?>

<!-- JS Global Vars -->
<script type="text/javascript">
	// JS debug. Use $_GET['wpvq_js_debug'] to enable it.
	var wpvq_js_debug = <?php echo (isset($_GET['wpvq_js_debug'])) ? 'true':'false' ?>;

	var quizName 					= "<?php echo wpvq_delete_quotes($quiz->getName()); ?>";
	var quizId 						= <?php echo $quiz->getId(); ?>;
	var totalCountQuestions 		= <?php echo $quiz->countQuestions(); ?>;
	var askEmail 					= <?php echo ($quiz->askEmail()) ? 'true':'false'; ?>;
	var askNickname 				= <?php echo ($quiz->askNickname()) ? 'true':'false'; ?>;
	var forceToShare 				= <?php echo (in_array('facebook', $quiz->getForceToShare())) ? 'true':'false'; ?>;
	var wpvq_type 					= "<?php echo $wpdata['type']; ?>";

	var wpvq_refresh_page 			= <?php echo ($wpvq_refresh_page) ? 'true':'false'; ?>;
	var wpvq_browser_page 			= <?php echo $wpvq_browser_page; ?>;
	var wpvq_answersStatus 			= <?php echo $wpvq_answersStatus; ?>;
	var wpvq_countQuestions 		= <?php echo $wpvq_count_questions ?>;
	
	var wpvq_scroll_top_offset 		= <?php echo $wpvq_scroll_top_offset; ?>;
	var wpvq_scroll_speed 			= <?php echo $wpvq_scrollSpeed; ?>;

	var wpvq_autoscroll_next_var 	= <?php echo $wpvq_autoscroll; ?>;
	var wpvq_progressbar_content	= '<?php echo $wpvq_content_progressbar; ?>';
	var wpvq_wait_trivia_page 		= <?php echo $wpvq_wait_trivia_page; ?>;

	var i18n_wpvq_needEmailAlert 	= "<?php _e('You have to give your e-mail to see your results.', 'wpvq'); ?>";
	var i18n_wpvq_needNicknameAlert = "<?php _e('You have to give your nickname to see your results.', 'wpvq'); ?>";

	var wpvq_local_caption 			= '<?php echo (isset($localCaption)) ? $localCaption:''; ?>';
	var wpvq_refresh_url 			= '<?php echo $wpvq_refresh_url; ?>';
	var wpvq_share_url 				= '<?php echo get_permalink(); ?>';
	var wpvq_facebook_caption 		= '<?php echo (isset($facebookTitle)) ? $facebookTitle:''; ?>';
	var wpvq_facebook_description 	= '<?php echo (isset($facebookDescription)) ? $facebookDescription:''; ?>';
	var wpvq_facebook_picture 		= null;
</script>