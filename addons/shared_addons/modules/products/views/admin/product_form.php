
<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page->title) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				if($page->action == 'create'){
					echo form_open('admin/products/' . $page->action);
				}else if($page->action == 'edit'){
					echo form_open('admin/products/' . $page->action . '/' . $prod->id);
				} 
			?>
			
			<!-- Render Product list  -->
			
			<div class="tabs">
				<ul class="tab-menu">
					<li><a href="#product-content-fields"><span>Content</span></a></li>
					<li><a href="#product-packages-fields"><span>Packages</span></a></li>
					<li><a href="#product-css-fields"><span>CSS</span></a></li>
					<li><a href="#product-js-fields"><span>Script</span></a></li>
				</ul>
				
				<div class="form_inputs" id="product-content-fields">
					<fieldset>
						<ul>
							<li>
								<table>
									<tbody>
										<tr>
											<td style="width:20%;">
												<label for="category">Category <span>*</span></label><br>
												<div class="input small-side">
													<?php echo form_dropdown('section', array(
														'select' => '',
														'retail' => 'Retail',
														'corporate' => 'Corporate'
													), set_value('section', $prod->section)) ?>
												</div>
											</td>
											<td style="width:20%;">
												<div for="product_is_featured"><?php echo form_checkbox('is_featured', $prod->is_featured, set_value('is_featured', $prod->is_featured)); ?>&nbsp;&nbsp;<strong>Display in Homepage</strong></div>
											</td>
											<td style="width:20%;">
												<div for="product_poster">Product Poster Here</div>
											</td>
										</tr>
									</tbody>
								</table>
								
								
								<br/>
																	
								<label for="product_name">Name <span>*</span></label>
								<div class="input"><?php echo form_input('name', set_value('name', htmlspecialchars_decode($prod->name)), 'maxlength="100"') ?></div>
								
								<br/>
								
								<label for="product_slug">Slug <span>*</span></label>
								<div class="input"><?php echo form_input('slug', set_value('slug', $prod->slug), 'maxlength="100" class="width-20"') ?></div>
								
								<br/>
								
								<label for="product_tags">Tags - seperate words with ( , )</label>
								<div class="input"><?php echo form_input('tags', set_value('tags', $prod->tags), 'maxlength="100" class="width-20"') ?></div>
								
								<br/>
								
								<label for="product_teaser">Teaser</label>
								<div class="input"><?php echo form_textarea(array('id' => 'teaser', 'value' => set_value('teaser', $prod->teaser), 'name' => 'teaser', 'rows' => 5)) ?></div>
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
				
				<!-- Product package tab -->
				<div class="form_inputs" id="product-packages-fields">
					<?php $this->load->view('admin/partials/package_list', $pack); ?> 
				</div>	
					
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