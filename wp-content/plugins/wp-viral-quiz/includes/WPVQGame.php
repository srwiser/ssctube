<?php 

abstract class WPVQGame {

	/**
	 * ----------------------------
	 * 		  ATTRIBUTS
	 * ----------------------------
	 */

	/**
	 * ID
	 * @var int
	 */
	protected $id;

	/**
	 * Quiz Name
	 * @var string
	 */
	protected $name;

	/**
	 * WP Author Id
	 * @var int
	 */
	protected $authorId;

	/**
	 * Quiz creation date
	 * @var int (timestamp UNIX)
	 */
	protected $dateCreation;

	/**
	 * Quiz creation date
	 * @var int (timestamp UNIX)
	 */
	protected $dateUpdate;

	/**
	 * Questions object array
	 * @var Questions
	 */
	protected $questions;

	/**
	 * Appreciations based on score
	 * @var array of ::WPVQAppreciation
	 *
	 * For Personality Quiz :
	 * [
	 * 		0  => ( Object ), // if 0 is heaviest
	 * 		1  => ( Object ), // elseif 1 is heaviest
	 * 		2  => ( Object ), // elseif 2 is heaviest
	 * ]
	 *
	 * OR
	 *
	 * For TrueFalse Quiz :
	 * [
	 * 		10  => ( Object ), // if 10 or minus
	 * 		20  => ( Object ), // elseif 20 or minus
	 * 		30  => ( Object ), // elseif 30 or minus
	 * ]
	 */
	protected $appreciations;

	/** 
	 * Game score 
	 *
	 * For Personality Quiz (key = weighted values) :
	 * @var array [0 => X, 1 => Y, 2 => Z, ...]
	 *
	 * For TrueFalse Quiz :
	 * @var int 
	*/
	protected $score;


	/**
	 * Type of the quiz
	 * @var string
	 */
	protected $type;


	/**
	 * Show social share buttons / copyright
	 * @var bool
	 */
	protected $showSharing;
	protected $showCopyright;

	/**
	 * Informations labels to ask to people at the end
	 * @var array : empty, array('mail'), array('nickname'), array('mail', 'nickname')
	 */
	protected $askInformations;

	/**
	 * Force people to share to see their results ?
	 * @var array : empty, array('facebook'), array('facebook', 'twitter'), ...
	 */
	protected $forceToShare;

	/**
	 * CSS skin to use for this quiz
	 * @var [type]
	 */
	protected $skin;

	/**
	 * Random questions when playing ?
	 * -1  		=  disabled
	 * int 		=  show X questions
	 * 0 		=  ALL
	 * @var int
	 */
	protected $randomQuestions;

	/**
	 * Random answers when playing ?
	 * @var bool
	 */
	protected $isRandomAnswers;


	/**
	 * ----------------------------
	 * 		    GETTERS
	 * ----------------------------
	 */
	
	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
	}

	public function getAuthorId() {
		return $this->authorId;
	}

	public function getNiceType() {
		return self::getNiceTypeFromClass($this->type);
	}

	static public function getNiceTypeFromClass($className) {
		return str_replace('WPVQGame', '', $className);
	}

	public function getType() {
		return $this->type;
	}

	public function getShowSharing() {
		return $this->showSharing;
	}

	public function getShowCopyright() {
		return $this->showCopyright;
	}

	public function getAskInformations() {
		return $this->askInformations;
	}

	public function getForceToShare() {
		return $this->forceToShare;
	}

	public function getPageCounter() {
		$count = 1;
		foreach($this->questions as $question)
		{
			if ($question->isTherePageAfter()) {
				$count++;
			}
		}	

		return $count;
	}

	public function isRandomQuestions() {
		return ($this->randomQuestions > 0 && $this->randomQuestions != NULL);
	}

	public function getRandomQuestions() {
		// NULL = 0
		return ($this->randomQuestions == NULL) ? 0 : $this->randomQuestions;
	}

	public function isRandomAnswers() {
		return ($this->isRandomAnswers == 1 && $this->isRandomAnswers != NULL);
	}

	/**
	 * Info about informations to ask
	 * @return bool
	 */
	public function askEmail() { return (in_array('email', $this->askInformations)); }
	public function askNickname() { return (in_array('nickname', $this->askInformations)); }
	public function askSomething() { return !empty($this->askInformations); }


	/**
	 * Get the WP user for $this->authorId
	 * @return Object WP_User
	 */
	public function getUser() {
		return get_user_by('id', $this->authorId);
	}

	public function getDateCreation() {
		return $this->dateCreation;
	}

	public function getQuestions() {
		return $this->questions;
	}

	public function getAppreciations() {
		return $this->appreciations;
	}

	public function getScore() {
		return $this->score;
	}

	public function getSkin() {
		return $this->skin;
	}

	/**
	 * Return questions counter
	 * @return int
	 */
	public function countQuestions()
	{
		return count($this->questions);
	}

	/**
	 * Return appreciations counter
	 * @return int
	 */
	public function countAppreciations()
	{
		return count($this->appreciations);
	}

	/**
	 * Return answers counter by question
	 * @return array (0 => 12, 1 => 8) 
	 *                   means :
	 *               (question 0 : 12 answers, question 1 : 8 answers)
	 */
	public function countAnswers($startAtOne=false)
	{
		$indexAnswers = array();
		foreach ($this->questions as $key => $question) {
			if($startAtOne) { $key++; }
			$count = count($question->getAnswers());
			$indexAnswers[$key] = $count;
		}

		return $indexAnswers;
	}

	/**
	 * Return the human time diff since creation date
	 * @return string eg. "3 days ago..."
	 */
	public function getNiceDateCreation() {
		return human_time_diff( $this->dateCreation );
	}

	/**
	 * Return the human time diff since update date
	 * @return string eg. "3 days ago..."
	 */
	public function getNiceDateUpdate() {
		return human_time_diff( $this->dateUpdate );
	}


	/**
	 * ----------------------------
	 * 	  ABSTRACT 	METHODS
	 * ----------------------------
	 */
	
	abstract protected function getCurrentAppreciation();


	function __construct() {

		$this->id 				=  0;
		$this->name 			=  '';
		$this->authorId 		=  0;
		$this->dateCreation 	=  0;
		$this->dateUpdate 		=  0;
		$this->questions 		=  array();
		$this->appreciations 	=  array();
		$this->score 			=  0;
		$this->type 			=  '';
		$this->showSharing 		=  1;
		$this->showCopyright 	=  1;
		$this->askInformations  =  array();
		$this->forceToShare  	=  array();
		$this->skin 			=  'buzzfeed';
		$this->randomQuestions 	=  -1;
		$this->isRandomAnswers 	=  0;

	}

	/**
	 * Add a new quizz
	 * @param array $param
	 * [
	 * 		name (string),
	 * ]
	 */
	public function add($param, $quizId = NULL) 
	{
		global $wpdb;

		if (!isset($param['name']) || !isset($param['showSharing']) || !isset($param['showCopyright']) || !isset($param['skin']) || !isset($param['askInformations']) || !isset($param['forceToShare']) || !isset($param['randomQuestions']) || !isset($param['isRandomAnswers']) || !is_array($param)) {
			throw new Exception("Bad parameter(s) during quiz creation.", 1);
		}

		$this->name 	 		=  $param['name'];
		$this->type 	 		=  get_class($this);
		$this->authorId  		=  get_current_user_id();
		
		$this->showSharing  	=  $param['showSharing'];
		$this->showCopyright  	=  $param['showCopyright'];

		$this->askInformations  =  $param['askInformations'];
		$this->forceToShare  	=  $param['forceToShare'];
		
		$this->skin  			=  $param['skin'];

		$this->randomQuestions 	=  $param['randomQuestions'];
		$this->isRandomAnswers 	=  $param['isRandomAnswers'];

		// Add new quizz
		if ($quizId == NULL || $quizId == "" || $quizId == 0)
		{
			$this->dateCreation  	=  time();
			$this->dateUpdate 		=  time();

			$dataSql = array(
				'type' 			=>  $this->type,
				'name' 			=>  $this->name,
				'authorId' 		=>  $this->authorId,
				'dateCreation' 	=>  $this->dateCreation,
				'dateUpdate' 	=>  $this->dateUpdate,
				'showSharing' 	=>  $this->showSharing,
				'showCopyright' =>  $this->showCopyright,
				'askInformations' 	=>  htmlspecialchars(implode(',', $this->askInformations)),
				'forceToShare' 		=>  htmlspecialchars(implode(',', $this->forceToShare)),
				'skin'				=>  $this->skin,
				'randomQuestions'	=>  $this->randomQuestions,
				'isRandomAnswers'	=>  $this->isRandomAnswers,
			);

			$typeSql = array(
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%d',
				'%d',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
			);

			$wpdb->insert( WPViralQuiz::getTableName('quizzes'), $dataSql, $typeSql );
			$this->id = $wpdb->insert_id;
		}
		// Update
		else
		{
			$this->dateUpdate 		=  time();

			$dataSql = array(
				'name' 			=>  $this->name,
				'dateUpdate' 	=>  $this->dateUpdate,
				'showSharing' 	=>  $this->showSharing,
				'showCopyright' =>  $this->showCopyright,
				'askInformations' 	=>  htmlspecialchars(implode(',', $this->askInformations)),
				'forceToShare' 		=>  htmlspecialchars(implode(',', $this->forceToShare)),
				'skin'				=>  $this->skin,
				'randomQuestions'	=>  $this->randomQuestions,
				'isRandomAnswers'	=>  $this->isRandomAnswers,
			);

			$typeSql = array(
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',
				'%s',
				'%s',
				'%d',
				'%d',
			);

			$wpdb->update( WPViralQuiz::getTableName('quizzes'), $dataSql, array('ID' => $quizId), $typeSql, array('%d') );
			$this->id = $quizId;
		}

		return $this;
	}

	/**
	 * Add a question
	 * @param array $param
	 * [
	 * 		label (string),
	 * 		position (int),
	 * 		pictureId (int),
	 * 		content (string),
	 * ]
	 */
	public function addQuestion($param, $questionId = NULL) {

		global $wpdb;

		if (!isset($param['label']) || !isset($param['position']) || !isset($param['pictureId']) || !isset($param['content']) || !is_array($param)) {
			throw new Exception("Bad parameter(s) when adding question.", 1);
		}

		// Add new question
		if ($questionId == NULL || $questionId == "" || $questionId == 0) 
		{
			$dataSql = array(
				'label' 			=>  $param['label'],
				'quizId' 			=>  $this->id,
				'position' 			=>  $param['position'],
				'pictureId' 		=>  $param['pictureId'],
				'content' 			=>  $param['content'],
				'pageAfter' 		=>  $param['pageAfter'],
			);

			$typeSql = array(
				'%s',
				'%d',
				'%d',
				'%s',
				'%s',
				'%d',
			);

			$wpdb->insert( WPViralQuiz::getTableName('questions'), $dataSql, $typeSql );
			$questionId = $wpdb->insert_id;
		}
		// Update question
		else 
		{
			$dataSql = array(
				'label' 			=>  $param['label'],
				'position' 			=>  $param['position'],
				'pictureId' 		=>  $param['pictureId'],
				'content' 			=>  $param['content'],
				'pageAfter' 		=>  $param['pageAfter'],
			);

			$typeSql = array(
				'%s',
				'%d',
				'%s',
				'%s',
				'%d',
			);

			$wpdb->update( WPViralQuiz::getTableName('questions'), $dataSql, array('ID' => $questionId), $typeSql, array('%d'));
		}

		

		// Update questions list
		$this->questions = $this->fetchQuestions();

		$question = new WPVQQuestion();
		$question->load($questionId);
		return $question;
	}

	/**
	 * Add appreciation to the quizz
	 * @param array $param
	 * [
	 * 		label (string),
	 * 		content (int),
	 * 		scoreCondition (int),
	 * ]
	 */
	public function addAppreciation($param, $appreciationId = NULL)
	{
		global $wpdb;

		if (!isset($param['label']) || !isset($param['scoreCondition']) || !isset($param['content']) || !is_array($param)) {
			throw new Exception("Bad parameter(s) when adding appreciation.", 1);
		}

		// Add new appreciation
		if ($appreciationId == NULL || $appreciationId == '' || $appreciationId == 0)
		{
			$dataSql = array(
				'quizId' 			=>  $this->id,
				'label' 			=>  $param['label'],
				'content' 			=>  $param['content'],
				'scoreCondition' 	=>  $param['scoreCondition'],
			);

			$typeSql = array(
				'%d',
				'%s',
				'%s',
				'%d',
			);

			$wpdb->insert( WPViralQuiz::getTableName('appreciations'), $dataSql, $typeSql );
			$appreciationId = $wpdb->insert_id;
		}
		// Update appreciation
		else
		{
			$dataSql = array(
				'label' 			=>  $param['label'],
				'content' 			=>  $param['content'],
				'scoreCondition' 	=>  $param['scoreCondition'],
			);

			$typeSql = array(
				'%s',
				'%s',
				'%d',
			);

			$wpdb->update( WPViralQuiz::getTableName('appreciations'), $dataSql, array('ID' => $appreciationId), $typeSql, array('%d') );
		}
		

		// Update appreciations list
		$this->appreciations = $this->fetchAppreciations();

		$appr = new WPVQAppreciation();
		return $appr->load($appreciationId);
	}
	


	/**
	 * Load an existing game
	 * @param  int $id Game ID
	 * @return $this
	 */
	public function load($id, $gameplayContext=false) {

		global $wpdb;

		if (!is_numeric($id)) {
			throw new Exception("Need numeric ID on Game load.");
		}

		$row = $wpdb->get_row('SELECT * FROM ' . WPViralQuiz::getTableName('quizzes') . ' WHERE ID = ' . $id);
		if (empty($row)) {
			throw new Exception("Quizz $id doesn't exist.");
		}

		$this->id 				= $row->ID;
		$this->type 			= $row->type;
		$this->name 			= $row->name;
		$this->authorId 		= $row->authorId;
		$this->dateCreation 	= $row->dateCreation;
		$this->dateUpdate 		= $row->dateUpdate;

		$this->randomQuestions  =  $row->randomQuestions;
		$this->isRandomAnswers  =  $row->isRandomAnswers;

		$this->appreciations 	= $this->fetchAppreciations();
		$this->questions 		= $this->fetchQuestions($gameplayContext, $this->isRandomAnswers);
		
		$this->showSharing  	=  $row->showSharing;
		$this->showCopyright  	=  $row->showCopyright;
		
		$this->askInformations  =  explode(',', $row->askInformations);
		$this->forceToShare  	=  explode(',', $row->forceToShare);

		$this->skin 			=  $row->skin;

		return $this;
	}

	/**
	 * Returns array of appreciations for this game
	 * @return array of ::Appreciation
	 */
	private function fetchAppreciations() {
		global $wpdb;

		// Fetch from DB
		$row = $wpdb->get_results($wpdb->prepare('SELECT id FROM ' . WPViralQuiz::getTableName('appreciations') . ' WHERE quizId = %d', $this->id));

		// No appreciations
		if (empty($row)) {
			return array();
		}

		$appreciations = array();
		foreach($row as $appreciation) 
		{
			$app = new WPVQAppreciation();
			$app->load($appreciation->id);

			$appreciations[] = $app;
		}

		return $appreciations;
	}
	
	/**
	 * Returns array of Questions
	 * @return array of ::Questions
	 */
	private function fetchQuestions($gameplayContext=false, $randomAnswers=false)
	{
		global $wpdb;

		// Fetch from DB
		$row = $wpdb->get_results($wpdb->prepare('SELECT id FROM ' . WPViralQuiz::getTableName('questions') . ' WHERE quizId = %d ORDER BY position ASC', $this->id));

		// No questions
		if (empty($row)) {
			return array();
		}

		$questions = array();
		foreach($row as $question) 
		{
			$que = new WPVQQuestion();
			$que->load($question->id, $gameplayContext, $randomAnswers);

			$questions[] = $que;
		}

		// Random questions
		if ($this->isRandomQuestions() && $gameplayContext) 
		{
			shuffle($questions);
			$questions = array_slice($questions, 0, $this->randomQuestions);
		}

		return $questions;
	}

	/**
	 * List all quizz for a user
	 * @param $authorId ID of user
	 * @return array de WPVQGame[TrueFalse|Personnality]
	 */
	public static function listAll($authorId=0, $page=0) {

		global $wpdb;

		$limitBegin = $page * WPVQ_QUIZ_PER_PAGE;

		// Fetch from DB
		$authorId = intval($authorId);
		if ($authorId == 0) {
			$sql_where_author = '';
		} else {
			$sql_where_author = "WHERE authorId = $authorId";
		}

		$row = $wpdb->get_results('SELECT ID, type FROM ' . WPViralQuiz::getTableName('quizzes') . ' '. $sql_where_author .' ORDER BY id DESC LIMIT '.$limitBegin.','.WPVQ_QUIZ_PER_PAGE);

		// No quizz
		if (empty($row)) {
			return array();
		}

		$quizzes = array();
		foreach($row as $quiz) 
		{	
			$type 	=  $quiz->type;
			$qu 	=  new $type();
			$qu->load($quiz->ID);

			$quizzes[] = $qu;
		}

		return $quizzes;

	}

	/**
	 * List quizzes pagination
	 * @return [type] [description]
	 */
	public static function getPagesCount($authorId=0) 
	{
		global $wpdb;

		// Fetch from DB
		$authorId = intval($authorId);
		if ($authorId == 0) {
			$sql_where_author = '';
		} else {
			$sql_where_author = "WHERE authorId = $authorId";
		}

		// Count quizzes
		$quizzesCount = $wpdb->get_var('SELECT COUNT(ID) FROM ' . WPViralQuiz::getTableName('quizzes') . ' '. $sql_where_author );
		$pagesCount = round($quizzesCount / WPVQ_QUIZ_PER_PAGE);

		return $pagesCount;
	}

	/**
	 * Delete quizz 
	 * @return boolean [true|false]
	 */
	public function delete() {

		global $wpdb;

		// Delete questions + answers
		foreach ($this->questions as $questions) {
			$questions->delete();
		}

		// Delete appreciations
		foreach ($this->appreciations as $appreciation) {
			$appreciation->delete();
		}

		// Delete players
		$wpdb->delete( WPViralQuiz::getTableName('players'), array( 'quizId' => $this->id) );		

		// Delete quiz
		return $wpdb->delete( WPViralQuiz::getTableName('quizzes'), array( 'ID' => $this->id) ) ;
	}

	/**
	 * Duplicate a quiz
	 * @return new quiz object
	 */
	public function duplicate()
	{
		global $wpdb;

		$wpdb->query('CREATE TEMPORARY TABLE wpvq_tmptable_1 SELECT * FROM '.WPViralQuiz::getTableName('quizzes').' WHERE id = '.$this->id.';');
		$wpdb->query('UPDATE wpvq_tmptable_1 SET id = NULL, dateCreation = '.time().', dateUpdate = '.time().', name = CONCAT(name, " (bis)")');
		$wpdb->query('INSERT INTO '.WPViralQuiz::getTableName('quizzes').' SELECT * FROM wpvq_tmptable_1;');
		$wpdb->query('DROP TEMPORARY TABLE IF EXISTS wpvq_tmptable_1;');
		$newQuizId = $wpdb->insert_id;

		foreach ($this->questions as $questions) {
			$questions->duplicate($newQuizId);
		}

		foreach ($this->appreciations as $appreciation) {
			$appreciation->duplicate($newQuizId);
		}

		$wpdb->query('UPDATE '.WPViralQuiz::getTableName('multipliers').' SET quizId = '.$newQuizId.' WHERE quizId = -1');

		return true;
	}


	/** 	
	 * Get type quizz by id
	 * @return string [WPVQGameTrueFalse|WPVQGamePersonnality]
	 */

	public static function getTypeById($id) {

		global $wpdb;

		if (!is_numeric($id)) {
			throw new Exception("Need numeric ID on Game load.");
		}

		$row = $wpdb->get_row('SELECT type FROM ' . WPViralQuiz::getTableName('quizzes') . ' WHERE ID = ' . $id);
		if (empty($row)) {
			throw new Exception("Quizz $id doesn't exist.");
		}

		return $row->type;
	}

	/**
	 * Return the <add question view> parsed
	 * @return [type] [description]
	 */
	public function getParsedViewQuestions() {
		$name = 'WPVQAddQuestion.' . $this->type . '.append.php';
		return $this->parseAddQuestion($name);
	}
	
	private function parseAddQuestion($templateName)
	{
		$finalTemplate 	= '';
		$blankHtmlTemplate = wpvq_get_view($templateName);
		$blankHtmlTemplate = preg_replace('#<div>\n*(.*)\n*<\/div>#m', '$1', $blankHtmlTemplate);

		$i = 1;
		foreach ($this->questions as $index => $question)
		{
			// Parsing elements
			$questionTemplate = $blankHtmlTemplate;
			$elements = array(
				'%%questionLabel%%' 		=> htmlentities(stripslashes($question->getLabel()), ENT_COMPAT, 'UTF-8'),
				'%%questionIndex%%' 		=> $i,
				'%%questionPictureUrl%%'	=> ($question->getPictureId() == NULL || $question->getPictureId() == 0) ? plugin_dir_url(__FILE__).'../views/img/photo-placeholder.jpg' : wp_get_attachment_url($question->getPictureId()),
				'%%questionPictureId%%' 	=> $question->getPictureId(),
				'%%questionId%%' 			=> $question->getId(),
				'%%questionContent%%' 		=> stripslashes($question->getContent()),
				'%%questionPosition%%'		=> $question->getPosition(),
				'%%explainChecked%%' 		=> ($question->getContent() != '') ? 'checked':'',
				'%%pageAfterChecked%%' 		=> ($question->isTherePageAfter()) ? 'checked':'',
				'%%styleEditor%%' 			=> ($question->getContent() != '') ? 'display:block;':'display:none;',
				'%%showDeletePictureLabel%%' => ($question->getPictureId() == NULL || $question->getPictureId() == 0) ? 'display:none;':'display:block;',
				'%%totalUniqQuestions%%' 	=> $this->countQuestions(),
				'£questionContentCheckbox£' => "vqquestions[$i][questionContentCheckbox]",
				'£questionLabel£' 			=> "vqquestions[$i][label]",
				'£questionPosition£' 		=> "vqquestions[$i][position]",
				'£pictureId£' 				=> "vqquestions[$i][pictureId]",
				'£questionId£' 				=> "vqquestions[$i][id]",
				'£questionContent£' 		=> "vqquestions[$i][content]",
				'£pageAfterCheckbox£' 		=> "vqquestions[$i][pageAfter]",
				'data-questionIndex=""'		=> 'data-questionIndex="'.$i.'"',
			);

			foreach ($elements as $tag => $value) {
				$questionTemplate = str_replace($tag, $value, $questionTemplate);
			}

			// Parse answer view
			$questionTemplate = str_replace('%%answers%%', $question->getParsedView($this->type, $i), $questionTemplate);

			$finalTemplate .= "\n $questionTemplate";
			$i++;
		}

		return $finalTemplate;	
	}

	/**
	 * Return the <add question view> parsed
	 * @return [type] [description]
	 */
	public function getParsedViewAppreciations() 
	{
		if ($this->type == 'WPVQGamePersonality') {
			$name = 'WPVQAddQuestion.WPVQGamePersonality.personality.append.php';
		} elseif ($this->type == 'WPVQGameTrueFalse') {
			$name = 'WPVQAddQuestion.WPVQGameTrueFalse.appreciation.append.php';
		}
		return $this->parseAddAppreciation($name);
	}
	
	private function parseAddAppreciation($templateName)
	{
		$finalTemplate 	   = '';
		$blankHtmlTemplate = wpvq_get_view($templateName);
		$blankHtmlTemplate = preg_replace('#<div>\n*(.*)\n*<\/div>#m', '$1', $blankHtmlTemplate);

		$i = 1;
		foreach ($this->appreciations as $index => $appreciation)
		{
			// Parsing elements
			$appreciationTemplate = $blankHtmlTemplate;
			$elements = array(
				'%%scoreCondition%%' 			=> $appreciation->getScoreCondition(),
				'%%appreciationLabel%%' 		=> htmlentities($appreciation->getLabel(), ENT_COMPAT, 'UTF-8'),
				'%%appreciationIndex%%' 		=> $i,
				'%%appreciationId%%' 			=> $appreciation->getId(),
				'%%appreciationContent%%' 		=> stripslashes($appreciation->getContent()),

				'£scoreCondition£' 				=> "vqappreciations[$i][scoreCondition]",
				'£appreciationLabel£' 			=> "vqappreciations[$i][label]",
				'£appreciationId£' 				=> "vqappreciations[$i][id]",
				'£appreciationContent£' 		=> "vqappreciations[$i][content]",
			);

			foreach ($elements as $tag => $value) {
				$appreciationTemplate = str_replace($tag, $value, $appreciationTemplate);
			}

			$finalTemplate .= "\n $appreciationTemplate";
			$i++;
		}

		return $finalTemplate;	
	}
}

