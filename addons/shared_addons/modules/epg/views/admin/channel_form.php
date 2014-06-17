<div class="one_full">
	<div id="notif"><?php echo $notif; ?></div>
	<section class="title">
		<h4><?php echo strtoupper($page->title) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				if($page->action == 'create'){
					echo form_open_multipart('admin/epg/channels/' . $page->action);
				}else if($page->action == 'edit'){
					echo form_open_multipart('admin/epg/channels/' . $page->action . '/' . $ch->id);
				} 
			?>
			
			<!-- Render Product list  -->
			<?php if(!empty($ch)){ ?>	
				
					<div class="form_inputs" id="channel-content-fields">
						<fieldset>
							<ul>
								<li>
									<div id="ch-logo" style="width:240px; height: 240px; float:left; margin-right:20px;">
										<img src="<?php echo $ch->logo; ?>" />
									</div>
									
									<table>
										<tr>
											<td><label for="name">Channel Name <span>*</span></label></td>
											<td><label for="num">Channel Number <span>*</span></label></td>
										</tr>								
										
										<tr>
											<td>
												<div class="input">
													<?php echo form_input('name', !empty($ch->name) ? $ch->name : '', 'maxlength="100"') ?>
												</div>
											</td>
											<td>
												<div class="input">
													<?php echo form_input('num', !empty($ch->num) ? $ch->num : '', 'maxlength="3" style="min-width:10px !important; width:30px; text-align:right;"') ?>
												</div>
											</td>
										</tr>
									</table>
									
									<br/>
									
									<div class="input">
										<?php echo form_checkbox('is_active', $ch->is_active, $ch->is_active == 1 ? TRUE : FALSE, 'style="min-width:0 !important"'); ?>&nbsp;&nbsp;<strong>Is Active</strong>
										<input type='hidden' value='<?php echo $ch->is_active; ?>' name="is_active">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<?php echo form_checkbox('hd', $ch->hd, $ch->hd == 1 ? TRUE : FALSE, 'style="min-width:0 !important"'); ?>&nbsp;&nbsp;<strong>HD</strong>
										<input type='hidden' value='<?php echo $ch->hd; ?>' name="hd">
									</div>
																	
									<br/>
																										
									<label for="cat">Category</label>
									<div class="input">
										<?php echo form_dropdown('cat', $ch->categories, !empty($ch->cat) ? $ch->cat : '0' ); ?>
									</div>
									
									<br/>
									
									<label for="logo">Upload Logo</label>
									<div class="input clearfix">
										<?php echo form_upload('logo'); ?>
									</div>
								</li>
								
								<li class="editor">
									<label for="desc">Description <span>*</span></label><br>
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
										<?php echo form_textarea(array('id' => 'desc', 'value' => !empty($ch->desc) ? $ch->desc : '', 'name' => 'desc', 'rows' => 5, 'class' => $page->editor_type)) ?>
									</div>
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