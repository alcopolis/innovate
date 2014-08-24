<fieldset>
	<ul>
		<li class="editor">
			<label for="attch">Attachment</label><br>
			<small>Recommended image size: [ 640x480px ] or [ 4:3 ratio ]</small>
			<div class="edit-content">
				<?php echo form_upload('attch','','id="attch"'); ?> <?php echo '<a onclick="process();" class="button" style="padding:5px 10px 4px 10px;">Upload</a>'; ?>
			</div>
			
			<div id="attch-files" style="background:#EEE;">
				belum berfungsi
			</div>
		</li>
	</ul>
</fieldset>