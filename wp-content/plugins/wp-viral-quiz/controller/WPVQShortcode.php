<?php 

class WPVQShortcode {

	public static $isShortcodeLoaded = false;
	public static $quiz = null;

	/** 
	 * Shortcode display Quiz in front 
	 *
	 * @var 
	 * (int) id : quiz's id
	 *
	 * (int) columns : number of columns
	 *  
	*/
	public static function viralQuiz($param) 
	{
		global $wpdata;

		// Bad ID
		if (!is_numeric($param['id'])) {
			return;
		}

		// Show quiz only when on page
		if (!is_page() && !is_single()) {
			return;
		}

		// Load quizz
		$id 	=  intval($param['id']);
		try {
			$type 	=  WPVQGameTrueFalse::getTypeById($id);
			$quiz 	=  new $type();
			$q 		=  $quiz->load($id, true);	
		} catch (Exception $e) {
			echo "ERROR : Quiz #{$param['id']} doesn't exist.";
			die();
		}

		// Useful to load JS script
		self::$isShortcodeLoaded 	=  true;
		self::$quiz 				=  $q;

		$wpdata['quiz'] = $q;
		$wpdata['type'] = $type;

		if(isset($param['columns']) && is_numeric($param['columns'])) {
			$wpdata['columns'] = $param['columns'];
		} else {
			$wpdata['columns'] = 3;
		}

		$shortCode = ob_start();
		include dirname(__FILE__) . '/../views/WPVQShortcode.php';
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	/**
	 * Quiz main scripts
	 */
	public static function register_scripts() 
	{
		wp_register_script( 'wpvq-front', plugin_dir_url(__FILE__) . '../js/wpvq-front.js', array('jquery'), '1.0', true );
		wp_register_script( 'wpvq-facebook-api', plugin_dir_url(__FILE__) . '../js/wpvq-facebook-api.js', array('jquery'), '1.0', true );
	}

	/**
	 * Print script into the footer (if needed)
	 * @return [type] [description]
	 */
	public static function print_scripts()
	{
		if (self::$isShortcodeLoaded) 
		{
			// Frontend (UX)
			wp_localize_script( 'wpvq-front', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
			wp_localize_script( 'wpvq-front', 'wpvq_imgdir', plugin_dir_url(__FILE__) . '../views/img/' );
			wp_enqueue_script( 'wpvq-front', plugin_dir_url(__FILE__) . '../js/wpvq-front.js', array('jquery'), '1.0', true );

			// Facebook SDK (advanced share option)
			$wpvq_options 				=  get_option( 'wpvq_settings' );
			$wpvq_API_already_loaded 	=  (isset($wpvq_options['wpvq_checkbox_facebook_already_api'])) ? 'true':'false';
			$wpvq_facebookAppID 		=  (isset($wpvq_options['wpvq_text_field_facebook_appid'])) ? $wpvq_options['wpvq_text_field_facebook_appid']:'' ;
			$wpvq_facebookLink 			=  get_permalink();
			$wpvq_forceFacebookShare 	=  (in_array('facebook', self::$quiz->getForceToShare())) ? 'true':'false';

			wp_localize_script( 'wpvq-facebook-api', 'wpvq_API_already_loaded', $wpvq_API_already_loaded );
			wp_localize_script( 'wpvq-facebook-api', 'wpvq_facebookAppID', $wpvq_facebookAppID );
			wp_localize_script( 'wpvq-facebook-api', 'wpvq_facebookLink', $wpvq_facebookLink );
			wp_localize_script( 'wpvq-facebook-api', 'wpvq_forceFacebookShare', $wpvq_forceFacebookShare);
			wp_enqueue_script( 'wpvq-facebook-api', plugin_dir_url(__FILE__) . '../js/wpvq-facebook-api.js', array('jquery'), '1.0', true );
		}
	}

	/**
	 * Triggered when player answers a Trivia Question
	 */
	public static function chooseTrueFalse() 
	{
		if (!is_numeric($_POST['answerId'])) {
			die();
		}

		// Debug mode : generate virtual lag
		// sleep(2);

		// Fetch player answer / question
		$answerId 	=  intval($_POST['answerId']);
		$answer 	=  new WPVQAnswer();
		$answer 	=  $answer->load($answerId);
		$question 	=  new WPVQQuestion();
		$question 	=  $question->load($answer->getQuestionId());

		// True Answer result
		$answerTrueId = 0;

		// If false answer
		if($answer->getWeight() == 0)  {
			foreach($question->getAnswers() as $an) {
				if($an->getWeight() == 1) {
					$answerTrueId = $an->getId();
					break;
				}
			}
		} 
		// If right answer
		else  {
			$answerTrueId = $answerId;
		}

		// Both cases : fetch explaination
		$explaination = $question->getContent();

		// JSON Return Array
		print json_encode(array(
			'explaination' => do_shortcode(stripslashes($explaination)), // can be ''
			'answerTrueId' => $answerTrueId, // numeric
		)); die();
	}

	/**
	 * Trigger when player finishes a Trivia Quiz
	 * @return [type] [description]
	 */
	public static function getTrueFalseAppreciation()
	{
		if (!is_numeric($_POST['score']) || !is_numeric($_POST['quizId'])) {
			die();
		}

		// Debug mode : generate virtual lag
		// sleep(2);

		$score 			=  intval($_POST['score']);
		$quizId 		=  intval($_POST['quizId']);

		$appreciation 	=  WPVQAppreciation::getAppreciationByScore($quizId, $score);
		if ($appreciation == NULL) {
			return 0; // no appreciation set
		}

		$result 		=  array(
			'scoreCondition' 		=> $appreciation->getScoreCondition(),
			'appreciationContent'	=> do_shortcode(stripslashes($appreciation->getContent())),
		);

		print json_encode($result); die();
	}

	/**
	 * Triggered when player finishes a Personality Quiz
	 * @return [type] [description]
	 */
	public static function choosePersonality() 
	{
		if (!is_numeric($_POST['weight'])) {
			die();
		}

		// Debug mode : generate virtual lag
		// sleep(2);
		
		// Fetch player answer / question
		$weight 		=  intval($_POST['weight']);
		$appreciation 	=  new WPVQAppreciation();
		$appreciation	=  $appreciation->load($weight);

		// JSON Return Array
		print json_encode(array(
			'label' 	=> $appreciation->getLabel(), // string
			'content' 	=> do_shortcode(stripslashes($appreciation->getContent())), // can be '' or HTML
		)); die();
	}


	/**
	 * Triggered when player submit information (mail, nickname, ...)
	 * @return [type] [description]
	 */
	public static function submitInformations()
	{
		if (!isset($_POST['data'])) {
			return;
		}

		// Parse jquery data
		$post = array();
		parse_str($_POST['data'], $post);

		$nickname 	= sanitize_text_field( (isset($post['wpvq_askNickname'])) ? $post['wpvq_askNickname']:'');
		$email 		= sanitize_email( (isset($post['wpvq_askEmail'])) ? $post['wpvq_askEmail']:'');
		$result 	= sanitize_text_field( (isset($post['wpvq_ask_result'])) ? $post['wpvq_ask_result']:'');
		$quizId 	= intval($post['wpvq_quizId']);

		$type 	=  WPVQGameTrueFalse::getTypeById($quizId);
		$quiz 	=  new $type();
		$quiz 	=  $quiz->load($quizId);

		$players = new WPVQPlayers();
		$players = $players->load($quizId, false);

		$playerData = array(
			'nickname' 	=> $nickname,
			'email'		=> $email,
			'quizName'	=> $quiz->getName(),
			'result'	=> $result, );
		$playerId = $players->addPlayers($playerData);

		do_action('wpvq_add_player', $playerId, $playerData, $quizId, $post);
	}
}