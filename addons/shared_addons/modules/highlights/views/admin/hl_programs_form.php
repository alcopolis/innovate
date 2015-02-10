<?php //var_dump($hl); die(); ?>

<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page->title) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				if($page->action == 'create'){
					echo form_open('admin/highlights/programs/' . $page->action);
				}else if($page->action == 'edit'){
					echo form_open('admin/highlights/programs/edit/' . $hl->id);
				} 
			?>
			
			
			<?php if(!empty($hl)){ ?>	
				
					<div class="form_inputs" id="highlights-content-fields">
						<fieldset>
							<ul>
								<li class="clearfix">	
									<label for="title">Poster <span>*</span></label>
									<div class="input">
										<?php echo form_upload('poster','','id="poster" style="margin:5px 0;"'); ?> &nbsp; <?php echo '<a onclick="process();" class="button" style="padding:5px 10px 4px 10px;">Upload</a>'; ?>
										<br/>
										<div id="msg-ajax"></div>
										<img src="" style="width:350px; height:350px; float:left; margin:10px 20px 10px 0;"/>	
									</div>														
									
									<label for="title">Title <span>*</span></label>									
									<div class="input"><?php echo form_input('title', !empty($hl->title) ? $hl->title : '', 'maxlength="100"') ?></div>	
									<br/>
									
									<label for="channel">Channel <span>*</span></label>
									<div class="input small-side">
										<?php echo form_dropdown('channel', $channels, $hl->ch_id) ?>
									</div>
									
									<br/>
									
									<label for="start_date">Publish Date <span>*</span></label>
									<div class="input"><?php echo form_input('start_date', set_value('start_date', $hl->start_date), 'class="datepicker" maxlength="20"'); ?></div>
									
									<br/>
									
									<label for="end_date">End Date <span>*</span></label>
									<div class="input"><?php echo form_input('end_date', set_value('end_date', $hl->end_date), 'class="datepicker" maxlength="20"'); ?></div>
								</li>
								
								<li class="editor">
									<label for="desc">Sinopsis <span>*</span></label><br>
									<div class="input small-side">
										<?php echo form_dropdown('editor_type', array(
											'html' => 'html',
											'markdown' => 'markdown',
											'wysiwyg-simple' => 'wysiwyg-simple',
											'wysiwyg-advanced' => 'wysiwyg-advanced',
										), $page->editor_type) ?>
									</div>
									
									<br/>
									
									<div class="edit-content">
										<?php echo form_textarea(array('id' => 'desc', 'value' => !empty($hl->sinopsis) ? $hl->sinopsis : '', 'name' => 'sinopsis', 'rows' => 5, 'class' => $page->editor_type)) ?>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
			<?php } ?>	
			<div class="buttons">
				<?php 
						echo form_submit('submit', 'Save'); 
						echo '<a href="admin/epg/channels" class="button" style="padding:5px 10px 4px 10px;">Cancel</a>';
				?>
			</div>
			
			
			<?php echo form_close() ?>
		</div>
	</section>
</div>