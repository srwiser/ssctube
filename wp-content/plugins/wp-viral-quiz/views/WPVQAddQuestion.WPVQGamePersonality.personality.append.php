<div>
	<div class="vq-bloc">
		<input type="hidden" name="£appreciationId£" value="%%appreciationId%%" />
		<h3><?php _e('Personality', 'wpvq'); ?> #<span class="vq-appreciationNum">%%appreciationIndex%%</span> : <input type="text" name="£appreciationLabel£" class="vq-appreciation-label" placeholder="<?php _e('Personality name', 'wpvq'); ?>" value="%%appreciationLabel%%"/></h3>
		<div class="vq-content">
		<label for="">
			<strong><?php _e("Personality description :", 'wpvq'); ?></strong><br />
			<textarea name="£appreciationContent£" id="£appreciationContent£" rows="10" style="width:100%;">%%appreciationContent%%</textarea>
		</label>
		</div>
		
		<hr  style="margin-bottom:0px;" />
		<div class="vq-actions">
			<span class="vq-delete-label delete-personality-button" data-appreciationId="%%appreciationId%%" onClick="return confirm('<?php _e('Do you really want to delete it ?', 'wpvq'); ?>');"><?php _e("Delete this personality", 'wpvq'); ?></span>
		</div>
	</div>
</div>