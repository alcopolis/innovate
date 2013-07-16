<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page->title) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				if($page->action == 'create'){
					echo form_open('admin/epg/shows/' . $page->action);
				}else if($page->action == 'edit'){
					echo form_open('admin/epg/shows/' . $page->action . '/' . $sh->id);
				} 
			?>
			
			<!-- Render Product list  -->
			<?php if(!empty($sh)){ ?>	
				
					<div class="form_inputs" id="channel-content-fields">
						<fieldset>
							<ul>
								<li>
									<h1 id="sh-title"><?php echo $sh->title; ?></h1>
									<p>
										<span id="sh-date">Date &nbsp: <?php echo $sh->date; ?></span><br/>
										<span id="sh-time">Time &nbsp: <?php echo $sh->time; ?></span><br/>
										<span id="sh-duration">Dur &nbsp: <?php echo $sh->duration; ?></span>
									</p>
									
									<br/>
									
									<div for="is_featured"><?php echo form_checkbox('is_featured', $sh->is_featured, $sh->is_featured == 1 ? TRUE : FALSE); ?>&nbsp;&nbsp;<strong>Set Feature</strong></div>
								</li>
								
								<li>
									<label for="syn_id">Sinopsis Indonesia</label>
									<div class="input"><?php echo form_textarea(array('id' => 'syn_id', 'value' => $sh->syn_id, 'name' => 'syn_id', 'rows' => 5)) ?></div>
									
									<br/>
									
									<label for="syn_en">Synopsis English</label>
									<div class="input"><?php echo form_textarea(array('id' => 'syn_en', 'value' => $sh->syn_en, 'name' => 'syn_en', 'rows' => 5)) ?></div>
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