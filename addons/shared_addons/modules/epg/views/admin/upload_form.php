<div class="one_full">
	<section class="title">
		<h4>Upload CSV</h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				echo form_open_multipart('admin/epg/upload/');
			?>
			
			
			<div class="form_inputs" id="upload-form">
				<fieldset>
					<ul>
						<li>
							<div class="input-div">
								<label for="csvdata">Upload CSV</label>
								<div class="input"><?php echo form_upload('csvdata'); ?></div>
							</div>
						</li>
					</ul>
				</fieldset>
			</div>
			<div class="buttons align-right padding-top">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )) ?>
			</div>		
				
			<?php echo form_close() ?>
		</div>
	</section>
</div>