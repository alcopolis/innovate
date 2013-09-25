<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page->title) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				echo form_open_multipart('admin/epg/shows/edit/' . $sh->id);
			?>
			
			<!-- Render Product list  -->
			<?php if(!empty($sh)){ ?>	
				
					<div class="form_inputs" id="show-form">
						<fieldset>
							<ul>
								<li>
									<h1 id="sh-title"><?php echo $sh->title; ?></h1>
									
									<?php if($sh->poster != ''){ ?>
										<img style="float:left;" class="poster small" src="<?php echo $this->module_details['path'] . '/upload/shows/square/' . $sh->poster; ?>" title="<?php echo $sh->title; ?>" alt="<?php echo $sh->title; ?>" />
									<?php } ?>
									
									<div style="float:left; margin:10px;">
										<p id="sh-date">Date &nbsp: <?php echo $sh->date; ?></p>
										<p id="sh-time">Time &nbsp: <?php echo $sh->time; ?></p>
										<p id="sh-duration">Dur &nbsp: <?php echo $sh->duration; ?></p>
										
										<div for="is_featured" >
											<input type='hidden' value='<?php echo $sh->is_featured; ?>' name="is_featured">
											<?php echo form_checkbox('is_featured', $sh->is_featured, $sh->is_featured == 1 ? TRUE : FALSE); ?>&nbsp;&nbsp;<strong>Set Feature</strong>
										</div>
									</div>
									
									<div class="clearfix"></div>
								</li>
								
								<li>
									<label for="syn_id">Sinopsis Indonesia</label>
									<div class="input"><?php echo form_textarea(array('id' => 'syn_id', 'value' => $sh->syn_id, 'name' => 'syn_id', 'rows' => 5)) ?></div>
									
									<br/>
									
									<label for="syn_en">Synopsis English</label>
									<div class="input"><?php echo form_textarea(array('id' => 'syn_en', 'value' => $sh->syn_en, 'name' => 'syn_en', 'rows' => 5)) ?></div>
								</li>
								
								<li>
									<label for="poster">Upload Poster</label>
									<div class="input"><?php echo form_upload('poster'); ?></div>
								</li>
							</ul>
						</fieldset>
					</div>
			<?php } ?>	
			<div class="buttons">
				<?php 
						echo form_submit('submit', 'Save'); 
						echo '<a href="admin/epg/shows/" class="button" style="padding:5px 10px 4px 10px;">Cancel</a>';
				?>
			</div>
			
			
			<?php echo form_close() ?>
		</div>
	</section>
</div>