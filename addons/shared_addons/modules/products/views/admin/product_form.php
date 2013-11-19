
<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page->title) . ' | ' . $prod->name; ?></h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				if($page->action == 'create'){
					echo form_open('admin/products/' . $page->action, 'id="product-form"');
				}else if($page->action == 'edit'){
					echo form_open('admin/products/' . $page->action . '/' . $prod->id, 'id="product-form"');
				} 
			?>
			
			<!-- Render Product list  -->
			
			<div class="tabs">
				<ul class="tab-menu">
					<li><a href="#product-content-fields"><span>Content</span></a></li>
					<?php if($page->action == 'edit'){ ?>
						<li><a href="#product-attachment"><span>Attachment</span></a></li>
						<li><a href="#product-packages-fields"><span>Packages</span></a></li>
					<?php } ?>					
					<li><a href="#product-css-fields"><span>CSS</span></a></li>
					<li><a href="#product-js-fields"><span>Script</span></a></li>
				</ul>
				
				<div class="form_inputs" id="product-content-fields">
					<?php echo form_hidden('form_data', array('id'=>$prod->id, 'slug'=>$prod->slug , 'poster_id'=>$poster['id'])); ?>
					
					<fieldset>
						<ul>
							<li>
								<table>
									<tbody>
										<tr>
											<td style="width:20%;">
												<label for="parent">Parent Product</label><br>
												<div class="input small-side">
													<?php echo form_dropdown('parent_id', $parent, set_value('parent_id', $prod->parent_id)) ?>
												</div>
											</td>
											<td style="width:20%;">
												<div for="product_is_featured"><?php echo form_checkbox('is_featured', $prod->is_featured, set_value('is_featured', $prod->is_featured)); ?>&nbsp;&nbsp;<strong>Display in Homepage</strong></div>
											</td>
										</tr>
									</tbody>
								</table>
								
								
								<br/>
																	
								<label for="product_name">Name <span>*</span></label>
								<div class="input"><?php echo form_input('name', set_value('name', htmlspecialchars_decode($prod->name)), 'maxlength="100"') ?></div>
								
								<br/>
								
								<?php if($page->action == 'edit'){ ?>
									<label for="product_slug">Slug</label>
									<div class="input"><?php echo form_input('slug', set_value('slug', $prod->slug), 'disabled="disabled" maxlength="100" class="width-20"') ?></div>
									<br/>
								<?php } ?>
								
								<label for="product_tags">Tags - seperate words with comma ( , )</label>
								<div class="input"><?php echo form_input('tags', set_value('tags', $prod->tags), 'maxlength="100" class="width-20"') ?></div>								
							</li>
							
							<li class="editor">
								<label for="product_overview">Overview</label>
								<div class="input small-side">
									<?php echo form_dropdown('editor_type', array(
										'html' => 'html',
										'markdown' => 'markdown',
										'wysiwyg-simple' => 'wysiwyg-simple',
										'wysiwyg-advanced' => 'wysiwyg-advanced',
									), 'html') ?>
								</div>
								<div class="edit-content"><?php echo form_textarea(array('id' => 'overview', 'value' => set_value('overview', $prod->overview), 'name' => 'overview', 'rows' => 5)) ?></div>
							</li>
					
							<li class="editor">
								<label for="body">Content <span>*</span></label><br>
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
									<?php echo form_textarea(array('id' => 'body', 'value' => set_value('body', $prod->body), 'name' => 'body', 'rows' => 30, 'class' => $page->editor_type)) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>
				
				
				<?php if($page->action == 'edit'){ ?>
					<div class="form_inputs" id="product-attachment">
						<fieldset>
							<ul>
								<li>
									<label for="poster">Upload Poster</label>
									<br/>
									<div id="img-poster" style="width:100%;">
										<?php if($poster != NULL){ ?>
											<img style="width:300px;" src="<?php echo Files::$path . $poster['filename'];?>" title="<?php echo $poster['name']; ?>" />
										<?php } ?>
									</div>
									<br/>
									<div class="input" style="border:1px solid #EEE; border-radius:5px; margin-top:20px;">
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
										
										<div class="input small-side" style="margin:20px 10px 10px 10px;">
											<label for="attchdisptype">Attachment Display</label><br>
											<?php echo form_dropdown('attchdisptype', array(
												'attach' => 'Attach on Page',
												'link' => 'URL Link',
												'popup' => 'Pop-up Window',
											), 'attach') ?>
										</div>
										<br/>
										<a onclick="process_attch(this);" class="button" style="padding:5px 10px 4px 10px;">Upload</a>
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
					</div>
					
					<!-- Product package tab -->
					
					<div class="form_inputs" id="product-packages-fields">
						<?php $this->load->view('admin/partials/package_list', $pack); ?> 
					</div>
				<?php } ?>	
					
				<!-- Product CSS tab -->
				<div class="form_inputs" id="product-css-fields">
					<fieldset>
						<ul>						
							<li class="editor">
								<label for="body">Custom CSS</label><br>
								<div class="edit-content">
									<?php echo form_textarea(array('id' => 'css', 'name' => 'css', 'value' => set_value('css', $prod->css), 'rows' => 30, 'class' => 'markdown')) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>
				
				
				<!-- Product JS tab -->
				<div class="form_inputs" id="product-js-fields">
					<fieldset>
						<ul>						
							<li class="editor">
								<label for="body">Custom Javascript</label><br>
								<div class="edit-content">
									<?php echo form_textarea(array('id' => 'js', 'name' => 'js', 'value' => set_value('js', $prod->js), 'rows' => 30, 'class' => 'markdown')) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>
			</div>
											
			<div class="buttons align-right padding-top">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )) ?>
			</div>
			<?php echo form_close() ?>
		</div>
	</section>
</div>