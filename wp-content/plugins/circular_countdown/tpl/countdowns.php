<div class="wrap">
	<div id="lbg_logo">
			<h2>Manage CountDowns</h2>
 	</div>
    <div><p>From this section you can add multiple countdowns.</p>
    </div>

<div id="previewDialog"><iframe id="previewDialogIframe" src="" width="100%" height="600" style="border:0;"></iframe></div>

<div style="text-align:center; padding:0px 0px 20px 0px;"><img src="<?php echo plugins_url('images/icons/add_icon.gif', dirname(__FILE__))?>" alt="add" align="absmiddle" /> <a href="?page=circular_countdown_Add_New">Add new (CountDown)</a></div>
    
<table width="100%" class="widefat">

			<thead>
				<tr>
					<th scope="col" width="5%">ID</th>
					<th scope="col" width="26%">Name</th>
					<th scope="col" width="26%">Shorcode</th>
					<th scope="col" width="36%">Actions</th>
					<th scope="col" width="7%">Preview</th>
				</tr>
			</thead>
            
<tbody>
<?php foreach ( $result as $row ) 
	{
		$row=circular_countdown_unstrip_array($row); ?>
							<tr class="alternate author-self status-publish" valign="top">
					<td><?php echo $row['id']?></td>
					<td><?php echo $row['name']?></td>
					<td>[circular_countdown settings_id='<?php echo $row['id']?>']</td>				
					<td>
						<a href="?page=circular_countdown_Settings&amp;id=<?php echo $row['id']?>&amp;name=<?php echo $row['name']?>">CountDown Settings</a> &nbsp;&nbsp;|&nbsp;&nbsp; 
						<a href="?page=circular_countdown_Playlist&amp;id=<?php echo $row['id']?>&amp;name=<?php echo $row['name']?>">Social Channels</a> &nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; <a href="?page=circular_countdown_Manage_CountDowns&id=<?php echo $row['id']?>" onclick="return confirm('Are you sure?')" style="color:#F00;">Delete</a> &nbsp;&nbsp;|&nbsp;&nbsp; <a href="?page=circular_countdown_Manage_CountDowns&amp;duplicate_id=<?php echo $row['id']?>">Duplicate</a></td>
					<td align="center"><a href="javascript: void(0);" onclick="showDialogPreview(<?php echo $row['id']?>)"><img src="<?php echo plugins_url('images/icons/magnifier.png', dirname(__FILE__))?>" alt="preview" border="0" align="absmiddle" /></a></td>
	            </tr>
<?php } ?>                
						</tbody>
		</table>                





</div>				