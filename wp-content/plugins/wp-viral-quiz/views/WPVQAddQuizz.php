<?php global $vqData; ?>

<div class="wrap">

	<form action="<?php echo esc_url(add_query_arg(array('noheader' => true))); ?>" method="POST">

		<div id="wpvq-fixed-shortcuts" <?php if ($vqData['type'] == 'WPVQGamePersonality'): ?>style="display:none;"<?php endif; ?>>
			<h3><?php _e("Shortcuts :", 'wpvq'); ?></h3>
			<ul>
				<li class="wpvq-shortcuts-minimize-all"><i class="fa fa-minus-square-o"></i> <?php _e("Minimize all the questions", 'wpvq'); ?></li>
				<li class="wpvq-shortcuts-expand-all"><i class="fa fa-plus-square-o"></i> <?php _e("Expand all the questions", 'wpvq'); ?></li>
				<li class="wpvq-shortcuts-scroll-to-settings"><i class="fa fa-cog"></i> <?php _e("Scroll to the settings section", 'wpvq'); ?></li>
			</ul>
			<hr />
			<p style="text-align:center;">
				<?php if ($vqData['type'] == 'WPVQGamePersonality'): ?>
					<button id="vq-backto-personality-button" class="button"><< <?php _e("Go back to personalities", 'wpvq'); ?> (<?php _e("step", 'wpvq'); ?> 1/2)</button>
				<?php endif; ?>
				<button id="wpvq-save-quiz-shortcut" type="submit" class="button button-primary"><?php _e("Save this quiz", 'wpvq'); ?></button>
			</p>
		</div>

		<div class="vq-medium">

			<h2>
				<?php _e('Build a new', 'wpvq'); ?> 
				<strong>
					<?php if (WPVQGame::getNiceTypeFromClass($vqData['type']) == 'TrueFalse'): ?>
						<?php _e("True/False Quiz", 'wpvq'); ?>
					<?php elseif (WPVQGame::getNiceTypeFromClass($vqData['type']) == 'Personality'): ?>
						<?php _e("Personality Quiz", 'wpvq'); ?>
					<?php endif; ?>
				</strong>
			</h2>
			<input type="text" name="quizName" class="vq-quiz-name" placeholder="<?php _e("Type your quiz name here", 'wpvq'); ?>" value="<?php echo $vqData['quizName']; ?>" />
			<hr />

			<?php if ($vqData['type'] == 'WPVQGamePersonality'): ?>

				<div id="step-personalities">
					<h3 class="dashicons-before dashicons-id-alt"> <?php _e("Step", 'wpvq'); ?> 1/2 — <?php _e("Create some personalities for your quiz", 'wpvq'); ?></h3>
					
					<p>
						<?php _e("If you put a picture in your personality descriptions", 'wpvq'); ?>, 
						<?php _e("it will be used in the Facebook share box.", 'wpvq'); ?>
						<br /><a href="https://www.institut-pandore.com/wp-viral-quiz/set-my-own-picture-into-facebook/" target="_blank"><?php _e("See what it means.", 'wpvq'); ?></a>
					</p>
					<p class="wpvq-protip-warning">
						<strong><?php _e("Good to know :", 'wpvq'); ?></strong> <br>
						<?php _e("If you rename an existing personality, it will reset points associated to this personality on the next page.", 'wpvq'); ?>
					</p>
					<div id="vq-list-personalities">
						<?php if ($vqData['quizId'] != NULL): ?>
							<?php echo $vqData['parsedViewAppreciations']; ?>
						<?php endif ?>
					</div>

					<div class="vq-add-personality">+ <?php _e("Add a new personality", 'wpvq'); ?></div>

					<p style="padding-top:20px;">
						<hr />
						<button id="vq-go-step-quiz" class="button button-primary"><?php _e("Let's go to build the quiz", 'wpvq'); ?> (<?php _e("step", 'wpvq'); ?> 2/2) >></button>
					</p>
				</div>

			<?php endif; ?>

			<div id="step-quiz">
				
				<?php if ($vqData['type'] == 'WPVQGamePersonality'): ?>
					<h3 class="dashicons-before dashicons-welcome-write-blog"> <?php _e("Step", 'wpvq'); ?> 2/2 — <?php _e("Add some questions & answers to your quiz", 'wpvq'); ?></h3>
				<?php else: ?>
					<h3 class="dashicons-before dashicons-welcome-write-blog"> <?php _e("Add some questions & answers to your quiz", 'wpvq'); ?></h3>
				<?php endif; ?>
				
			
				<p>
					<?php _e("You can add picture for each question and answer, it makes your quiz more fun and viral.", 'wpvq'); ?>
				</p>
				<p class="wpvq-protip">
					<strong><?php _e("Protip To Make The Perfect Quiz :", 'wpvq'); ?></strong> <br/>
					<?php _e("If you use pictures to illustrate the answers, each picture should be at least 300px * 300px.", 'wpvq'); ?>
				</p>
			
				<!-- Questions wrapper -->
				<div id="vq-questions">
					<?php if ($vqData['quizId'] != NULL): ?>
						<?php echo $vqData['parsedView']; ?>
					<?php endif ?>
				</div>

				<!-- Add question button -->
				<div class="vq-add-question">+ <?php _e("Add a new question", 'wpvq'); ?></div>

				<?php if ($vqData['type'] == 'WPVQGameTrueFalse'): ?>

					<div style="padding-top:20px;">
						<hr />
						<h3 class="dashicons-before dashicons-awards">&nbsp;<?php _e("Quiz results depending on the score (optional)", 'wpvq'); ?></h3>
						<p>
							<?php _e("Write something to people depending on their score.", 'wpvq'); ?> 
							<?php _e("If you put a picture in an appreciation", 'wpvq'); ?>, 
							<?php _e("it will be used in the Facebook share box.", 'wpvq'); ?>
							<a href="https://www.institut-pandore.com/wp-viral-quiz/set-my-own-picture-into-facebook/" target="_blank"><?php _e("See what it means.", 'wpvq'); ?></a>
						</p>

						<div class="wpvq-truefalse-appreciations-example wpvq-protip">
							<p>
								<strong><?php _e("An example", 'wpvq'); ?></strong>, <?php _e("for a quiz with 10 questions", 'wpvq'); ?> :
							</p>
							<ul>
								<li><span style="font-weight:600;"><?php _e("Less than 4 points", 'wpvq'); ?></span> (= 0, 1, 2, 3) : "<?php _e("you are bad. Just bad.", 'wpvq'); ?>"</li>
								<li><span style="font-weight:600;"><?php _e("Less than 8 points", 'wpvq'); ?></span> (= 4, 5, 6, 7) : "<?php _e("Hum okay, not bad!", 'wpvq'); ?>"</li>
								<li><span style="font-weight:600;"><?php _e("Less than 10 points", 'wpvq'); ?></span> (= 8, 9) : "<?php _e("Really nice, good game.", 'wpvq'); ?>"</li>
								<li><span style="font-weight:600;"><?php _e("Less than 11 points", 'wpvq'); ?></span> (= 10) : "<?php _e("Perfect! You are a real rockstar!", 'wpvq'); ?>"</li>
							</ul>
						</div>

						<div id="vq-list-appreciations">
							<?php if ($vqData['quizId'] != NULL): ?>
								<?php echo $vqData['parsedViewAppreciations']; ?>
							<?php endif ?>
						</div>
						<div class="vq-add-appreciation">+ <?php _e("Add a new appreciation", 'wpvq'); ?></div>
					</div>

				<?php endif; ?>

				<!-- Validation + hidden fields -->
				<div id="wpvq-global-settings-addquiz" style="padding-top:20px;">
					<hr />
					<h3 class="dashicons-before dashicons-admin-generic">&nbsp;<?php _e("Global options : configure the quiz", 'wpvq'); ?></h3>
					
					<div class="vq-bloc">
						<h4 class="wpvq-global-settings-addquiz"><?php _e("Display & Gameplay", 'wpvq'); ?></h4>
						<div class="vq-content">
							<table class="form-table">
								<tbody>
									<tr>
										<th scope="row">
											<?php _e("What skin do you want", 'wpvq'); ?> :
										</th>
										<td>
											<select name="skin" id="wpvq-skin">
												<option value="buzzfeed" <?php if($vqData['skin'] == 'buzzfeed'):?>selected<?php endif; ?>><?php _e("The BuzzFeed Skin", 'wpvq'); ?></option>
												<option value="flat" <?php if($vqData['skin'] == 'flat'):?>selected<?php endif; ?>><?php _e("A Modern Flat Skin", 'wpvq'); ?></option>
												<option value="custom" <?php if($vqData['skin'] == 'custom'):?>selected<?php endif; ?>><?php _e("Custom Skin (use wpvq-custom.css in your root theme dir.)", 'wpvq'); ?></option>
											</select>
										</td>
									</tr>

									<tr>
										<th scope="row">
											<?php _e("Display Random Questions ?", 'wpvq'); ?>
										</th>
										<td>
											<label for="wpvq-randomQuestionsCheckbox">
												<input type="checkbox" id="wpvq-randomQuestionsCheckbox" name="isRandomQuestions"  value="1" <?php if ($vqData['isRandomQuestions']): ?>checked="checked"<?php endif; ?> /> 
												<span id="wpvq-randomQuestionsFields"><?php _e("and show only", 'wpvq'); ?> <input type="text" id="wpvq-randomQuestions" name="randomQuestions" value="<?php echo ($vqData['randomQuestions'] != -1) ? $vqData['randomQuestions']:''; ?>" style="width:60px; text-align:center;" placeholder="XX" /> <?php _e('questions (put 999 for "all")', 'wpvq'); ?></span>
											</label>
										</td>
									</tr>

									<tr>
										<th scope="row">
											<?php _e("Random order for answers ?", 'wpvq'); ?>
										</th>
										<td>
											<label for="wpvq-isRandomAnswers">
												<input type="checkbox" id="wpvq-isRandomAnswers" name="isRandomAnswers" value="1" <?php if ($vqData['isRandomAnswers']): ?>checked="checked"<?php endif; ?> />
												<?php _e("Yes, shuffle the answers for each question", 'wpvq'); ?>
											</label>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="vq-bloc">
						<h4 class="wpvq-global-settings-addquiz"><?php _e("Virality & Marketing", 'wpvq'); ?></h4>
						<div class="vq-content">
							<table class="form-table">
								<tbody>
									<tr>
										<th scope="row">
											<?php _e("People have to share the quiz to see their results :", 'wpvq'); ?>
										</th>
										<td>
											<select id="vq-forceShare" name="forceToShare">
												<option value="" <?php if (empty($vqData['forceToShare'])): ?>selected<?php endif; ?>>Disabled</option>
												<option value="facebook" <?php if (in_array('facebook', $vqData['forceToShare'])): ?>selected<?php endif; ?>><?php _e("Yes, they have to share on Facebook", 'wpvq'); ?></option>
											</select>
										</td>
									</tr>

									<tr>
										<th scope="row">
											<?php _e("Share buttons", 'wpvq'); ?>
										</th>
										<td>
											<label for="wpvq-showSharing">
												<input type="checkbox" id="wpvq-showSharing" name="showSharing" value="1" <?php if ($vqData['showSharing'] == 1): ?>checked="checked"<?php endif; ?> />
												<?php _e("Display share buttons at the end of the quiz", 'wpvq'); ?> (Facebook, Twitter, Google+)
											</label>
										</td>
									</tr>

									<tr>
										<th scope="row">
											<?php _e("Capture e-mails", 'wpvq'); ?>
										</th>
										<td>
											<label for="wpvq-askInformations-email">
												<input type="checkbox" id="wpvq-askInformations-email" name="askInformations[]" value="email" <?php if (in_array('email', $vqData['askInformations'])): ?>checked="checked"<?php endif; ?> />
												<?php _e("People have to give their e-mail to see their results", 'wpvq'); ?>
											</label>
										</td>
									</tr>
									
									<tr>
										<th scope="row">
											<?php _e("Capture names", 'wpvq'); ?>
										</th>
										<td>
											<label for="wpvq-askInformations-nickname">
												<input type="checkbox" id="wpvq-askInformations-nickname" name="askInformations[]" value="nickname" <?php if (in_array('nickname', $vqData['askInformations'])): ?>checked="checked"<?php endif; ?> />
												<?php _e("People have to give their first name to see their results", 'wpvq'); ?>
											</label>
										</td>
									</tr>

									<tr>
										<th scope="row">
											<?php _e("Promote the plugin", 'wpvq'); ?>
										</th>
										<td>
											<label for="wpvq-showCopyright">
												<input type="checkbox" id="wpvq-showCopyright" name="showCopyright" value="1" <?php if ($vqData['showCopyright'] == 1): ?>checked="checked"<?php endif; ?> />
												Show a very small label to help us to promote our plugin (thanks <3)
											</label>
										</td>
									</tr>


								</tbody>
							</table>
						</div>
					</div>
				</div>
				<p>
					<?php if ($vqData['type'] == 'WPVQGamePersonality'): ?>
						<button id="vq-backto-personality-button" class="button"><< <?php _e("Go back to personalities", 'wpvq'); ?> (<?php _e("step", 'wpvq'); ?> 1/2)</button>
					<?php endif; ?>
					<button id="wpvq-save-quiz" type="submit" class="button button-primary"><?php _e("Save this quiz", 'wpvq'); ?></button>
				</p>
			</div>

			<input type="hidden" name="type" value="<?php echo $vqData['type']; ?>" />
			<input type="hidden" name="quizId" value="<?php echo $vqData['quizId']; ?>" />

			<!-- If we need to delete some existing stuff -->
			<input type="hidden" name="deleteAppreciations" value="" />
			<input type="hidden" name="deleteQuestions" value="" />
			<input type="hidden" name="deleteAnswers" value="" />
		</div>
	</form>
</div>


<script type="text/javascript">

	// Quiz Type
	var vqDataQuizType = '<?php echo $vqData['type']; ?>';

	// Template var
	var wpvq_template_question		= <?php echo json_encode($vqData['template']['question']); ?>;
	var wpvq_template_answer		= <?php echo json_encode($vqData['template']['answer']); ?>;
	var wpvq_template_multiplier	= <?php echo json_encode($vqData['template']['multiplier']); ?>;
	var wpvq_template_appreciation	= <?php echo json_encode($vqData['template']['appreciation']); ?>;
	var wpvq_template_personality	= <?php echo json_encode($vqData['template']['personality']); ?>;

	// CKE Editor : add <p> (1) or not (2) ?
	var wpvq_cke_enterMode = <?php echo apply_filters('wpvq_cke_enterMode', 1); ?>;

	// General JS var
	<?php if($vqData['quizId'] == NULL): ?>
		var questionIndex 		=  1;
		var answersIndex 		=  [];
		var appreciationIndex 	=  1;
	<?php else: ?>
		var questionIndex 		=  <?php echo $vqData['JS_questionIndex']; ?>;
		var answersIndex 		=  <?php echo $vqData['JS_answersIndex']; ?>;
		var appreciationIndex 	=  <?php echo $vqData['JS_appreciationIndex']; ?>;
	<?php endif; ?>

	// Personality Quiz
	<?php if ($vqData['type'] == 'WPVQGamePersonality'): ?>
		<?php if($vqData['quizId'] == NULL): ?>
			var vqPersonalities 		=  [];
			var selectedAppreciations 	=  false;
		<?php else: ?>
			var vqPersonalities 		=  <?php echo $vqData['JS_vqPersonalities']; ?>;
			var selectedAppreciations 	=  <?php echo $vqData['JS_selectedAppreciations']; ?>;
		<?php endif; ?>
	<?php endif; ?>

	// TrueFalse Quiz
	<?php if ($vqData['type'] == 'WPVQGameTrueFalse'): ?>
		<?php if($vqData['quizId'] == NULL): ?>
			var vqAppreciations 		=  [];
		<?php else: ?>
			var vqAppreciations 		=  '';
		<?php endif; ?>
	<?php endif; ?>


</script>