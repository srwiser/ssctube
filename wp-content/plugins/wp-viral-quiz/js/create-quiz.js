(function($) { 

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 	    		SINGLE QUIZ SETTINGS
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	
	 // Manage the checkbox+input for "Display Random Questions"
	 $(window).load(function(e) 
	 {
	 	var checkboxState = $('input#wpvq-randomQuestionsCheckbox').is(':checked');
	 	if (!checkboxState) {
	 		$('#wpvq-randomQuestionsFields').css('opacity', '.5');
	 		$('#wpvq-randomQuestions').attr("disabled", "disabled");
	 	}
	 });

	 $('input#wpvq-randomQuestionsCheckbox').click(function()
	 {
	 	var checkboxState = $('input#wpvq-randomQuestionsCheckbox').is(':checked');
	 	if (!checkboxState) {
	 		$('#wpvq-randomQuestionsFields').css('opacity', '.5');
	 		$('#wpvq-randomQuestions').attr("disabled", "disabled");
	 	} else {
	 		$('#wpvq-randomQuestionsFields').css('opacity', '1');
	 		$('#wpvq-randomQuestions').removeAttr("disabled");
	 	}
	 });

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 			UPDATE PERSONALITIES SELECTORS
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	
	// Delete old <select> if update/remove personalities
	// Add new select if update/add new personalities
	function updateAllSelectPersonalities()
	{
		// Linear array of personalities, useful.
		var personalitiesSimpleArray = [];
		[].forEach.call(vqPersonalities, function(elem, index, array) {
			personalitiesSimpleArray.push(elem['label']);
		});

		// For each block of answers
		$('div.wpvq-multipliers-answer').each(function() 
		{
			var $multipliersBlock = $(this);
			var questionIndex = $(this).attr('data-questionIndex');
			var answerIndex = $(this).attr('data-answerIndex');

			// Harmonise var names
			var $multipliersBlock = $(this);
			var page = wpvq_template_multiplier;

			// Delete unused personality selectors
			var personalitiesNotFound = personalitiesSimpleArray;
			$(this).find('select').each(function()
			{
				var selectLabel 	=  $(this).attr('data-personalityLabel');

				// Select with an old personality which has been removed!
				// (Select label doesn't exist in the personality list)
				if (personalitiesSimpleArray.indexOf(selectLabel) == -1) {
					$(this).closest('div.wpvq-multiplier-section-parent').remove();
				}
			});

			// Add new personality selectors
			[].forEach.call(vqPersonalities, function(elem, index, array) 
			{
				if ($multipliersBlock.find('select[data-personalityLabel="'+elem['label']+'"]').size() == 0) 
				{
					var rawhtml  	=  page;
					rawhtml 		=  rawhtml.replace(new RegExp('%%personalityLabel%%', 'g'), elem['label']);
					rawhtml 		=  rawhtml.replace(new RegExp('%%multiplierValue%%', 'g'), '0');
					rawhtml 		=  rawhtml.replace(new RegExp('£answerMultiplier£', 'g'), 'vqquestions['+ questionIndex +'][answers]['+ answerIndex +'][multiplier]['+ elem['label'] +']');
					$multipliersBlock.append(rawhtml);
				}
			});
		});
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 		  UPDATE ONLY 1 SELECTOR (add question)
	 * 		$selector = div which contains the <select>
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	function updateSelectList($selector)
	{
		$selector.html('');
		
		// Harmonise var names
		var page = wpvq_template_multiplier;
		var $multipliersBlock = $selector;

		[].forEach.call(vqPersonalities, function(elem, index, array) 
		{
			var rawhtml  	=  page;
			rawhtml 		=  rawhtml.replace(new RegExp('%%personalityLabel%%', 'g'), elem['label']);
			rawhtml 		=  rawhtml.replace(new RegExp('%%multiplierValue%%', 'g'), '0');
			$multipliersBlock.append(rawhtml);
		});
	}

	/**
	 * Minimize questions
	 */
	$('span.wpvq-window-options-minimize').on('click', function(e) {
		$(this).parent().nextAll('.wpvq-window-content').toggle();
		return false;
	});

	$('.wpvq-shortcuts-minimize-all').on('click', function(e) {
		$('.wpvq-window-content').hide();
	});

	$('.wpvq-shortcuts-expand-all').on('click', function(e) {
		$('.wpvq-window-content').show();
	});

	$('.wpvq-shortcuts-scroll-to-settings').on('click', function(e) {
		$('html, body').animate( { scrollTop: $('#wpvq-global-settings-addquiz').offset().top }, 750 );	
	});

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 			Can't save a quiz with noname
	 * 					  — OR —
	 * 	  a TrueFalseQuiz with an empty ScoreCondition
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	$('#wpvq-save-quiz, #wpvq-save-quiz-shortcut').click(function(e) 
	{
		// Name
		if ($('input.vq-quiz-name').val() == '') {
			alert(php_vars.wpvq_i18n_needNameAlert);
			$('input.vq-quiz-name').css('border', '1px solid red');
			e.preventDefault();
			$('html, body').animate( { scrollTop: $('#wpbody-content').offset().top }, 750 );	
		}

		// Score Condition
		var scoreConditionOK = true;
		$('input.vq-scoreCondition-label').each(function(){
			if ($(this).val() == '') {
				scoreConditionOK = false;
			}
		});
		if (!scoreConditionOK) {
			e.preventDefault();
			alert(php_vars.wpvq_i18n_badScoreConditionAlert);
		}
	});

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 			DELETE A PICTURE IN QUESTION
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	$('.wpvq-delete-picture-question').click(function(e) 
	{
		var questionIndex = $(this).attr('data-questionIndex');
		$('.vq-pictureUploaded[data-questionIndex='+questionIndex+'][data-answerIndex=0]').attr('src', php_vars.wpvq_plugin_dir + 'views/img/photo-placeholder.jpg'); // delete picture
		$('.pictureId[data-questionIndex='+questionIndex+'][data-answerIndex=0]').val(''); // empty field
		$('span.wpvq-delete-picture-question[data-questionIndex="'+questionIndex+'"][data-answerIndex=0]').hide();
	});

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 			DELETE A PICTURE IN ANSWER
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	$('.wpvq-delete-picture-answer').click(function(e) 
	{
		var questionIndex 	= $(this).attr('data-questionIndex');
		var answerIndex 	= $(this).attr('data-answerIndex');
		$('.vq-pictureUploaded[data-questionIndex='+questionIndex+'][data-answerIndex='+answerIndex+']').attr('src',''); // delete picture
		$('.vq-pictureUploaded[data-questionIndex='+questionIndex+'][data-answerIndex='+answerIndex+']').css('height','30px'); 
		$('.pictureId[data-questionIndex='+questionIndex+'][data-answerIndex='+answerIndex+']').val(''); // empty field
		$('span.wpvq-delete-picture-answer[data-questionIndex="'+questionIndex+'"][data-answerIndex="'+answerIndex+'"]').show();
		
	});

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 				CKEDITOR LOADER
	 *  	  ! ! ! TRIVIA QUIZ ONLY ! ! !
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	if (vqDataQuizType == 'WPVQGameTrueFalse') {

		// TrueFalse QUIZZ
		$('textarea[id^="vqquestions"]').each(function() {
			CKEDITOR.replace( $(this).attr('id'), {
				enterMode:wpvq_cke_enterMode 
			});
		});

		// TrueFalse QUIZZ
		$('textarea[id^="vqappreciations"]').each(function() {
			CKEDITOR.replace( $(this).attr('id'), {
				enterMode:wpvq_cke_enterMode 
			});
		});


	/**
	 * #################################################
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 		   !! PERSONALITY QUIZ ONLY !!
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * #################################################
	 */

	} else if (vqDataQuizType == 'WPVQGamePersonality') {

		// Personality QUIZZ
		$('textarea[id^="vqappreciations"]').each(function() {
			CKEDITOR.replace( $(this).attr('id'), {
				enterMode:wpvq_cke_enterMode
			});
		});

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 		 LOAD PERSONALITIES FOR PERSO. QUIZ
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */

		$('#step-quiz').hide();

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 			CREATE A NEW PERSONALITY
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
		

		$('.vq-add-personality').click(function(e) {
			e.preventDefault();
			var $page = $(wpvq_template_personality); // empty :(

			// #1, #2...  Number display
	  		$page.find('span.vq-appreciationNum').text(appreciationIndex);

			// Update fields names (for a nice $_POST in controller)
			$page.find('input[name=£appreciationLabel£]').attr('name', 'vqappreciations['+ appreciationIndex +'][label]');
			$page.find('textarea[name=£appreciationContent£]').attr('name', 'vqappreciations['+ appreciationIndex +'][content]');
			$page.find('input[name=£appreciationId£]').attr('name', 'vqappreciations['+ appreciationIndex +'][id]');

			// Append to DOM
			var rawhtml  	=  $page.html();
			rawhtml 		=  rawhtml.replace(new RegExp('%%[a-zA-Z]*%%', 'gi'), '');
			$("#vq-list-personalities").append(rawhtml);
			console.log(rawhtml);

			CKEDITOR.replace( 'vqappreciations['+ appreciationIndex +'][content]', {
				enterMode:wpvq_cke_enterMode
			});

			// Enable button
			appreciationIndex++;
		});

		/**
		 * * * * * * * * * * * * * * * * * * * * * * * * * * 
		 * 			DELETE A PERSONALITY IN DA LIST
		 * * * * * * * * * * * * * * * * * * * * * * * * * * 
		 */
		$(document).on('click', '.delete-personality-button', function(){
			var appreciationId = $(this).attr('data-appreciationId');
			addToDeleteInput(appreciationId, 'deleteAppreciations');
			$(this).closest('.vq-bloc').remove();
		});


		/**
		 * * * * * * * * * * * * * * * * * * * * * * * * * * 
		 * 			CLICK ON "BUILD QUIZ" (step 2/2)
		 * * * * * * * * * * * * * * * * * * * * * * * * * * 
		 */
		$('button#vq-go-step-quiz').click(function(e){
			e.preventDefault();

			// Fetch personality label
			vqPersonalities = [];
			$('input.vq-appreciation-label').each(function() 
			{
				// Replace double quotes by 2 single quotes (avoid html issue)
				var value = $(this).val().replace(/"/g, '\'\'');
				$(this).val(value);

				if (value != '') {
					vqPersonalities.push({ 'label': value });	
				}
			});
			
			$('#step-personalities').hide();
			$('#step-quiz').show();

			$('html, body').animate( { scrollTop: $('body').offset().top }, 750 );	
			$('#wpvq-fixed-shortcuts').show(); // show shortcuts

			updateAllSelectPersonalities(); // useful if back and go and back and go...
		});

		/**
		 * * * * * * * * * * * * * * * * * * * * * * * * * * 
		 * 		GO BACK TO PERSONALITY SCREEN (step 1)
		 * * * * * * * * * * * * * * * * * * * * * * * * * * 
		 */
		$('#vq-backto-personality-button').click(function(e){
			e.preventDefault();
			$('#wpvq-fixed-shortcuts').hide();
			$('#step-personalities').show();
			$('#step-quiz').hide();
		});

	}



	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 		WORDPRESS MEDIA UPLOADER WINDOW
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	
    var custom_uploader;
		var contentType;
		var questionNum;
		var answerNum;

    $(document).on('click', '.vq-upload_image_button' ,function(e) {

    	questionNum 	= $(this).attr('data-questionIndex');
    	answerNum 		= $(this).attr('data-answerIndex');
    	var $uploadButton = $(this);

    	// Content TYPE : question | answer
    	// dépend du data answerIndex (qui n'existe que sur les answer button upload)
    	if(typeof answerNum === 'undefined') {
    		contentType = 'question';
    	} else {
    		contentType = 'answer';
    	}
 
        e.preventDefault();
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            var id = attachment.id;
            var url = attachment.url;

            // Set image + Input hidden ID
            if (contentType == 'question') {
            	$('input[type=hidden][data-questionIndex="'+questionNum+'"][data-answerIndex="0"]').val(id);
				$('img[data-questionIndex="'+questionNum+'"][data-answerIndex="0"]').attr('src', url);
				$('span.wpvq-delete-picture-question[data-questionIndex="'+questionNum+'"]').show();
            } else if (contentType == 'answer') {
            	$('input[type=hidden][data-questionIndex="'+questionNum+'"][data-answerIndex="'+answerNum+'"]').val(id);
            	$('img[data-questionIndex="'+questionNum+'"][data-answerIndex="'+answerNum+'"]').attr('src', url);
            	$('img[data-questionIndex="'+questionNum+'"][data-answerIndex="'+answerNum+'"]').css('height', 'auto');
            	$('span.wpvq-delete-picture-answer[data-questionIndex="'+questionNum+'"][data-answerIndex="'+answerNum+'"]').show();
            }

        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 				ADD A NEW QUESTION
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	
	$('.vq-add-question').click(function()
	{
		var $page = $(wpvq_template_question);

		// #1, #2...  Number display
		$page.find('span.vq-questionNum').text(questionIndex);

		// Meta Question Index Data
		$page.find('[data-questionIndex]').attr('data-questionIndex', questionIndex);

		// Update fields names (for a nice $_POST in controller)
		$page.find('input[name=£pictureId£]').attr('name', 'vqquestions['+ questionIndex +'][pictureId]');
		$page.find('input[name=£questionLabel£]').attr('name', 'vqquestions['+ questionIndex +'][label]');
		$page.find('input[name=£questionId£]').attr('name', 'vqquestions['+ questionIndex +'][id]');
		$page.find('input[name=£questionContentCheckbox£]').attr('name', 'vqquestions['+ questionIndex +'][questionContentCheckbox]');
		$page.find('input[name=£pageAfterCheckbox£]').attr('name', 'vqquestions['+ questionIndex +'][pageAfter]');

		// Pré-remplir le champ.
		$page.find('input[name=£questionPosition£]').attr('name', 'vqquestions['+ questionIndex +'][position]');$
		$page.find('.questionContent').attr('value', questionIndex);

		$page.find('textarea[name=£questionContent£]').attr('name', 'vqquestions['+ questionIndex +'][content]');

		// Append to DOM
		var rawhtml = $page.html();
		rawhtml = rawhtml.replace(new RegExp('%%questionPictureUrl%%', 'gi'), php_vars.wpvq_plugin_dir + 'views/img/photo-placeholder.jpg');
		rawhtml = rawhtml.replace(new RegExp('%%[a-zA-Z]*%%', 'gi'), '');
		$("#vq-questions").append(rawhtml);

		if (vqDataQuizType == 'WPVQGameTrueFalse') {
			CKEDITOR.replace( 'vqquestions['+ questionIndex +'][content]', {
				enterMode:wpvq_cke_enterMode
			});
		}

		updateTotalNumberQuestions();

		// Append to DOM
		questionIndex++;
	});

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 				ADD A NEW ANSWER
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	$(document).on('click', '.vq-add-answer', function() 
	{
		questionNum = $(this).attr('data-questionIndex');
		var $page = $(wpvq_template_answer);

		// Answer index++ for this question
		if (typeof answersIndex[questionNum] === 'undefined') {
			answersIndex[questionNum] = 1;
		} else {
			answersIndex[questionNum]++;
		}

		// Meta Answer Index Data
		$page.find('[data-questionIndex]').attr('data-questionIndex', questionNum);
		$page.find('[data-answerIndex]').attr('data-answerIndex', answersIndex[questionNum]);

		// Update fields names (for a nice $_POST in controller)
		$page.find('input[name=£pictureId£]').attr('name', 'vqquestions['+ questionNum +'][answers][' + answersIndex[questionNum] + '][pictureId]');
		$page.find('input[name=£answerLabel£]').attr('name', 'vqquestions['+ questionNum +'][answers][' + answersIndex[questionNum] + '][label]');
		$page.find('input[name=£rightAnswer£]').attr('name', 'vqquestions['+ questionNum +'][answers][' + answersIndex[questionNum] + '][rightAnswer]');
		$page.find('input[name=£answerId£]').attr('name', 'vqquestions['+ questionNum +'][answers][' + answersIndex[questionNum] + '][id]');

		if (vqDataQuizType == 'WPVQGamePersonality') 
		{
			// Fill select and rename it
			var $selector = $page.find('div.wpvq-multipliers-answer');
			updateSelectList($selector);

			// Fill the data value + change name
			$selector.find('[data-questionIndex]').attr('data-questionIndex', questionNum);
			$selector.find('[data-answerIndex]').attr('data-answerIndex', answersIndex[questionNum]);
			$selector.find('select').each(function(){
				var personalityLabel = $(this).attr('data-personalityLabel');
				$(this).attr('name', 'vqquestions['+ questionNum +'][answers][' + answersIndex[questionNum] + '][multiplier]['+personalityLabel+']');
			});
		}

		// Append HTML
		var rawhtml = $page.html();
		rawhtml = rawhtml.replace(new RegExp('%%answerPictureUrl%%', 'gi'), '');
		rawhtml = rawhtml.replace(new RegExp('%%[a-zA-Z]*%%', 'gi'), '');
		$('.vq-answers[data-questionIndex="'+questionNum+'"]').append(rawhtml);
	});

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 	  SHOW THE "EXPLAIN QUESTION" TEXTAREA FIELD
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	$(document).on('click', 'input.vq-explain-checkbox', function(){

		var theQuestionIndex = $(this).attr('data-questionIndex');
		if ($(this).is(':checked'))  {
			$('.vq-bloc[data-questionIndex=' + theQuestionIndex + '] .hide-the-editor').show()
		} else  {
			$('.vq-bloc[data-questionIndex=' + theQuestionIndex + '] .hide-the-editor').hide();
		}

	});

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 			DELETE A QUESTION IN DA LIST
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	$(document).on('click', '.delete-question-button', function(){
		var questionId = $(this).attr('data-questionId');
		addToDeleteInput(questionId, 'deleteQuestions');
		$(this).closest('.vq-bloc').remove();
		updateTotalNumberQuestions();
	});


	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 			DELETE AN ANSWER IN DA LIST
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	$(document).on('click', '.delete-answer-button', function(){
		var answerId = $(this).attr('data-answerId');
		addToDeleteInput(answerId, 'deleteAnswers');
		$(this).closest('.vq-bloc').remove();
	});


	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 		GENERATE HIDDEN INPUT FIELD TO DELETE STUFF
	 * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 */
	function addToDeleteInput(id, inputName) {

		if (typeof id === 'undefined' || id == '') {
			return;
		}

		// Add to input
		var values 		=  $('input[name="' + inputName + '"]').val()
		var newValues 	=  values + id + ',';

		$('input[name="' + inputName + '"]').val(newValues);
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 		UPDATE QUESTIONS COUNTER ("[input] / Y")
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	function updateTotalNumberQuestions() {
		var total = $('.wpvq-uniq-question').length;
		$('.total-uniq-question').each(function(){
			$(this).text(total);
		})
	}

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 		CREATE A NEW APPRECIATION (TrueFalse)
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
		

	$('.vq-add-appreciation').click(function(e) 
	{
		e.preventDefault();
		var $page = $(wpvq_template_appreciation);

		// Update fields names (for a nice $_POST in controller)
		$page.find('input[name=£scoreCondition£]').attr('name', 'vqappreciations['+ appreciationIndex +'][scoreCondition]');
		$page.find('textarea[name=£appreciationContent£]').attr('name', 'vqappreciations['+ appreciationIndex +'][content]');
		$page.find('input[name=£appreciationId£]').attr('name', 'vqappreciations['+ appreciationIndex +'][id]');

		// Append to DOM
		var rawhtml  	=  $page.html();
		rawhtml 		=  rawhtml.replace(new RegExp('%%[a-zA-Z]*%%', 'gi'), '');
		$("#vq-list-appreciations").append(rawhtml);

		CKEDITOR.replace( 'vqappreciations['+ appreciationIndex +'][content]', {
				enterMode:wpvq_cke_enterMode
			});

		// Enable button
		appreciationIndex++;
	});

	/**
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 * 			DELETE A PERSONALITY IN DA LIST
	 * * * * * * * * * * * * * * * * * * * * * * * * * * 
	 */
	$(document).on('click', '.delete-appreciation-button', function() 
	{
		// For controller
		var appreciationId = $(this).attr('data-appreciationId');
		addToDeleteInput(appreciationId, 'deleteAppreciations');

		$(this).closest('.vq-bloc').remove();
	});

	

})(jQuery);