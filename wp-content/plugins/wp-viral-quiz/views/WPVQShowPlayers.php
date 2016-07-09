<?php global $vqData; ?>
<?php $url_show_players = esc_url( remove_query_arg(array('action', 'noheader')) ); ?>

<div class="wrap">
	<h2>
		WP Viral Quiz - 
		<strong><?php _e("Players Database", 'wpvq'); ?></strong>
	</h2>

	<?php if (isset($_GET['referer']) && $_GET['referer'] == 'remove'): ?>
		<div id="message" class="updated below-h2">
			<p> <?php _e("Player has been removed.",'wpvq'); ?></p>
		</div>
	<?php endif ?>

	<?php if (isset($_GET['referer']) && $_GET['referer'] == 'removeAll'): ?>
		<div id="message" class="updated below-h2">
			<p> <?php _e("All players for this quiz have been removed.",'wpvq'); ?></p>
		</div>
	<?php endif ?>

	<hr />
	<form action="" method="GET">
	<input type="hidden" name="page" value="wp-viral-quiz-players" />
		<label for="">
			<?php _e("Choose a quiz :", 'wpvq'); ?>
			<select name="wpvq_quizId" id="">
				<?php foreach ($vqData['quizzes'] as $index => $quiz): ?>
					<option value="<?php echo $quiz->getId(); ?>" <?php if($vqData['quizId'] == $quiz->getId()): ?>selected<?php endif; ?>><?php echo stripslashes($quiz->getName()); ?></option>
				<?php endforeach; ?>
			</select>
			<button type="submit" class="button"><?php _e("View stats and players", 'wpvq'); ?></button>
		</label>
	</form>

	<?php if ($vqData['showTable']): ?>
		
		<?php if ($vqData['players']->countPlayers() > 0): ?>
			<p style="margin:20px 0;">
				<strong><?php _e("Total", 'wpvq'); ?> :</strong> <?php echo $vqData['players']->countPlayers(); ?> <?php _e("players", 'wpvq'); ?> | 
				<a href="<?php echo $vqData['exportUrl']; ?>" target="_blank"><?php _e("Export the table to a CSV file", 'wpvq'); ?></a> | 

				<?php $remove_all_link = esc_url(remove_query_arg(array('id', 'referer'), add_query_arg(array('noheader' => 1, 'element'=>'players','action'=>'remove', 'playerId' => 'all')))); ?>
				<a href="<?php echo $remove_all_link; ?>"><?php _e("Delete all players for this quiz", 'wpvq'); ?></a>
			</p>
		<?php else: ?>
			<p></p>
		<?php endif; ?>

		<!-- HTML Pagination (blank if 1 page only) -->
		<?php $htmlPagination = ''; ?>
		<?php if ($players->getPagesCount() > 1): ?>
			<?php ob_start(); ?>
			<p style="margin-bottom:2px;font-size:.9em;margin-top:0px;margin-left:1px;">
				<strong><?php _e("Pages", 'wpvq'); ?> :</strong>
				<?php for ($i = 1; $i <= $players->getPagesCount(); $i++): ?>
					<a href="admin.php?page=wp-viral-quiz-players&wpvq_quizId=<?php echo $quizId; ?>&wpvq_page=<?php echo $i ?>">
					<?php if ($vqData['page'] == $i): ?><strong><?php endif ?>
						<?php echo $i; ?><?php if ($vqData['page'] == $i): ?></strong><?php endif ?></a>
					<?php if ($i != $players->getPagesCount()) echo " -"; // between each page number ?>
				<?php endfor; ?>
			</p>
			<?php $htmlPagination = ob_get_contents(); ob_end_clean(); ?>
		<?php endif; ?>

		<?php echo $htmlPagination; ?>

		<table id="vq-quizzes-list" class="wp-list-table widefat fixed posts">
			<thead>
				<tr>
					<th class="manage-column column-author"><?php _e("People",'wpvq'); ?></th>
					<th class="manage-column column-date"><?php _e("Result",'wpvq'); ?></th>				
					<th class="manage-column column-date"><?php _e("Date",'wpvq'); ?></th>		
					<th class="manage-column column-date"><?php _e("Meta",'wpvq'); ?></th>		
				</tr>
			</thead>
				<?php $i=0; foreach ($vqData['players']->getPlayers() as $index => $player): 

					if ($i%2 != 0) {
						$alternate = '';
					} else {
						$alternate = 'alternate';
					}
				?>
					<tr class="<?php echo $alternate; ?>">
						<td class="post-title page-title column-title">
							<strong>
								<?php $remove_player_link = esc_url(remove_query_arg(array('id', 'referer'), add_query_arg(array('noheader' => 1, 'element'=>'players','action'=>'remove', 'playerId' => $player['id'])))); ?>
								<a href="<?php echo $remove_player_link; ?>"><span class="dashicons dashicons-no-alt"></span></a>
								<?php echo ($player['nickname'] != '') ? htmlspecialchars($player['nickname']):__("Anonymous", 'wpvq'); ?>
							</strong>
							<span style="font-size:.8em;"><?php echo ($player['email'] != '') ? htmlspecialchars($player['email']):''; ?></span>
						</td>
						<td><?php echo htmlspecialchars($player['result']); ?></td>
						<td><?php printf( __("%s ago", 'wpvq'), human_time_diff($player['date']) ); ?></td>
						<td>
							<?php foreach ($player['meta'] as $key => $value) : ?>
								<strong><?php echo $key ?></strong> : <?php echo $value; ?>
								<hr />
							<?php endforeach; ?>

							<?php if (empty($player['meta'])): ?>
								/
							<?php endif ?>
						</td>
					</tr>
				<?php if ($i == 100) break; ?>
				<?php $i++; endforeach; ?>
			<?php if ($vqData['players']->countPlayers() == 0): ?>
				<tr class="no-items">
					<td class="colspanchange">
						<?php _e("No one has played this quiz yet!", 'wpvq'); ?><br />
					</td>
				</tr>
			<?php endif; ?>
		</table>

		<?php echo $htmlPagination; ?>
		<hr />

		<p style="font-style:italic;">
			<strong><?php _e("Informations about anonymous players :", 'wpvq'); ?></strong><br />
			<?php _e("If your quiz asks for first name/email at the end, \"anonymous players\" are people which don't fill the form and leave the page.", 'wpvq'); ?>
		</p>

	<?php endif; ?>

</div>

