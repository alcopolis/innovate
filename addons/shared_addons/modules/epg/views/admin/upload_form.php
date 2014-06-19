<div class="one_full">
	<section class="title">
		<h4>Upload CSV</h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				echo form_open_multipart('admin/epg/upload/do_import');
			?>
			
			
			<div class="form_inputs" id="upload-form">
				<fieldset>
					<ul>
						<li>
							<div class="input-div">
								<label for="csvdata">Select CSV file</label>
								<div class="input"><?php echo form_upload('csvdata'); ?></div>
							</div>
							<div class="input-div">
								<div class="input"><?php echo form_submit('import', 'Import'); ?></div>
							</div>
						</li>
					</ul>
				</fieldset>
			</div>	
				
			<?php echo form_close() ?>
		</div>
	</section>
</div>