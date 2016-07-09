<?php require_once dirname(__FILE__) . '/../../../../wp-load.php'; // for i18n ?>

<div>
	<div class="vq-bloc vq-bloc-answer-content">
		<input type="hidden" name="£answerId£" value="%%answerId%%" />
		<h3>
			<?php _e('Answer :', 'wpvq'); ?>
			<input type="text" class="vq-answer-label" name="£answerLabel£" placeholder="The ...." value="%%answerLabel%%" /><br />
			<label for="vq-select-personality">
				<?php _e("How many points this answer gives to each personality ?", 'wpvq'); ?>
			</label>
			
			<!-- Multiplers for each answer -->
			<div class="wpvq-multipliers-answer" data-questionIndex="" data-answerIndex="">
				%%multipliers%%
			</div>
			
			<hr class="wpvq-clear-invisible" />
			
		</h3>
		
		<div class="vq-content" style="text-align: center;">
			<div class="vq-image-bloc">
				<div class="vq-image-bloc-button">
					<label for="upload_image">
					    <input class="vq-upload_image_button button" type="button" value="<?php _e('Add an image to illustrate this answer', 'wpvq'); ?>" data-questionIndex="" data-answerIndex="" />
					</label>
				</div>
				<span class="wpvq-delete-picture-answer" data-questionIndex="" data-answerIndex="" style="%%showDeletePictureLabel%%"><?php _e("Delete this picture", 'wpvq'); ?></span>
				<div class="vq-image-bloc-picture">
					<img src="%%answerPictureUrl%%" alt="" class="vq-pictureUploaded" data-questionIndex="" data-answerIndex="" />
				</div>
				<input type="hidden" name="£pictureId£" class="pictureId" value="%%answerPictureId%%" data-questionIndex="" data-answerIndex="" />
			</div>
		</div>

		<hr  style="margin-bottom:0px;" />
		<div class="vq-actions">
			<span class="vq-delete-label delete-answer-button" data-answerId="%%answerId%%" onClick="return confirm('<?php _e("Do you really want to delete it ?", 'wpvq'); ?>');"><?php _e("Delete this answer", 'wpvq'); ?></span>
		</div>
	</div>
</div>