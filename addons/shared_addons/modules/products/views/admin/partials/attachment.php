<fieldset>
	<ul>
		<li>
			<label for="poster">Upload Poster</label>
			<br/>
			<div id="img-poster" style="width:100%; margin:10px 0;">
				<?php if($poster != NULL){ ?>
					<img style="width:300px;" src="<?php echo Files::$path . $poster['filename'];?>" title="<?php echo $poster['name']; ?>" />
				<?php } ?>
			</div>
			<br/>
			<div class="input" style="border:1px solid #EEE; border-radius:5px;">
				<div class="msg-ajax"></div>
				<?php echo form_upload('poster','','id="poster" style="margin:10px 5px 10px 10px;"'); ?> &nbsp; 
				<a onclick="process_attch(this);" class="button" style="padding:5px 10px 4px 10px;">Upload</a>
			</div>
		</li>
		
		<li>	
			<label for="attachment">Add Attachment</label>
			<div class="input" style="border:1px solid #EEE; border-radius:5px; margin-top:20px;">
				<div class="msg-ajax"></div>
				<?php echo form_upload('attch','','id="attch" style="margin:10px 5px 10px 10px;"'); ?> &nbsp; 
				<?php echo form_input('attchname', '', 'id="attchname" placeholder="File Rename" style="margin:10px 10px 10px 5px;"'); ?> &nbsp;
				
				<div class="input small-side clearfix" style="margin:10px;">
					<label for="attchdisptype">Display</label><br>
					<?php echo form_dropdown('attchdisptype', array(
						'attach' => 'Attach on Page',
						'link' => 'URL Link',
						'popup' => 'Pop-up Window',
					), 'attach') ?>
				</div>
				<a onclick="process_attch(this);" class="button" style="margin:10px; padding:5px 10px 4px 10px;">Upload</a>
			</div>
			
			<div id="attch-files" style="margin:20px 0;">
				<?php if(count($attachment) > 0){ ?>
					<table id="attch-list">
						<thead>
							<th>Name</th>
							<th>Size</th>
							<th>Type</th>
							<th>Display</th>
							<th></th>
						</thead>
						<tbody>
						<?php foreach($attachment as $key=>$attch ){ ?>
							<tr>
								<td><?php echo $attch['data']->name; ?></td>
								<td><?php
										$size = intval($attch['data']->filesize);
										if($size > 1024){ 
											echo round($size/1024) . ' MB';
										}else{
											echo $size . ' KB';
										}
									?>
								</td>
								<td><?php echo $attch['data']->mimetype; ?></td>
								<td><?php echo $attch['display']; ?></td>
								<td><a data-key="<?php echo $key; ?>" onclick="delete_attch(this);" class="button" style="padding:5px 10px 4px 10px;">Delete</a></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				<?php }else{ ?>
					<div id="no-data">No Attachment</div>
				<?php } ?>	
			</div>
		</li>
	</ul>
</fieldset>