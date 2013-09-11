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
			<?php /* if(!empty($prod)){ */ ?>	
				<div class="tabs">
					<ul class="tab-menu">
						<li><a href="#product-content-fields"><span>Content</span></a></li>
						<li><a href="#product-packages-fields"><span>Packages</span></a></li>
						<li><a href="#product-css-fields"><span>CSS</span></a></li>
						<li><a href="#product-js-fields"><span>Script</span></a></li>
					</ul>
					
					
					<!-- Product content tab -->
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
														), 'select') ?>
													</div>
												</td>
												<td style="width:20%;">
													<div for="product_is_featured"><?php echo form_checkbox('is_featured', $prod->is_featured, $prod->is_featured == 1 ? TRUE : FALSE); ?>&nbsp;&nbsp;<strong>Display in Homepage</strong></div>
												</td>
												<td style="width:20%;">
													<div for="product_poster">Product Poster Here</div>
												</td>
											</tr>
										</tbody>
									</table>
									
									
									<br/>
																		
									<label for="product_name">Name <span>*</span></label>
									<div class="input"><?php echo form_input('name', htmlspecialchars_decode($prod->name), 'maxlength="100"') ?></div>
									
									<br/>
									
									<label for="product_slug">Slug <span>*</span></label>
									<div class="input"><?php echo form_input('slug', $prod->slug, 'maxlength="100" class="width-20"') ?></div>
									
									<br/>
									
									<label for="product_tags">Tags - seperate words with ( , )</label>
									<div class="input"><?php echo form_input('tags', $prod->tags, 'maxlength="100" class="width-20"') ?></div>
									
									<br/>
									
									<label for="product_teaser">Teaser</label>
									<div class="input"><?php echo form_textarea(array('id' => 'teaser', 'value' => $prod->teaser, 'name' => 'teaser', 'rows' => 5)) ?></div>
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
			<?php /* } */ ?>	
			<div class="buttons">
				<?php 
						echo form_submit('submit', 'Save'); 
						echo '<a href="admin/products" class="button" style="padding:5px 10px 4px 10px;">Cancel</a>';
				?>
			</div>
			
			
			<?php echo form_close() ?>
		</div>
	</section>
</div>