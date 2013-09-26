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
									<h1 id="sh-title"><?php echo $sh->title; ?><br/><span id="ch"><?php echo $ch->name . ' | ' . $ch->num; ?></span></h1>
									
									<?php if($sh->poster != ''){ ?>
										<img style="float:left;" class="poster small" src="<?php echo $this->module_details['path'] . '/upload/shows/square/' . $sh->poster; ?>" title="<?php echo $sh->title; ?>" alt="<?php echo $sh->title; ?>" />
									<?php } ?>
									
									<div style="float:left; margin:10px;">
										
										<div class="input-div">
											<input type='hidden' value='<?php echo $sh->is_featured; ?>' name="is_featured">
											<?php echo form_checkbox('is_featured', $sh->is_featured, $sh->is_featured == 1 ? TRUE : FALSE); ?>&nbsp;&nbsp;<strong>Set Feature</strong>
										</div>
										
										<?php if(isset($similar) && count($similar) > 0){ ?>
											<div class="input-div">
												<label>Show Schedules</label>
												<table id="schedule">
													<thead>
														<th></th>
														<th class="align-center">Date</th>
														<th class="align-center">Time</th>
														<th class="align-center">Duration</th>
													</thead>
													
													<tbody>
														<?php
															$is_first = TRUE;
															foreach ($similar as $same){ 
																if($is_first){
														?>
																	<tr style="color:green; font-weight: bold;">
																		<td>Next on &raquo;</td>
																		<td class="align-center"><?php echo $same->date; ?></td>
																		<td class="align-center"><?php echo $same->time; ?></td>
																		<td class="align-center"><?php echo $same->duration; ?></td>
																	</tr>
														<?php 
																	$is_first = FALSE;	
																}else{ 
														?>
															<tr style="color:#999; font-weight: bold;">
																<td>Later on &raquo;</td>
																<td class="align-center"><?php echo $same->date; ?></td>
																<td class="align-center"><?php echo $same->time; ?></td>
																<td class="align-center"><?php echo $same->duration; ?></td>
															</tr>
														<?php }} ?>
													</tbody>
												</table>
											</div>
										<?php } ?>
										
										<div class="input-div">
											<label for="poster">Upload Poster</label>
											<div class="input"><?php echo form_upload('poster'); ?></div>
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
							</ul>
						</fieldset>
					</div>
			<?php } ?>	
					<div class="buttons align-right padding-top">
						<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )) ?>
					</div>			
			<?php echo form_close() ?>
		</div>
	</section>
</div>