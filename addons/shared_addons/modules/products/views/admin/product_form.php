<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($data->page_title) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
			<?php echo form_open_multipart(); ?>
			
			<!-- Render Product list  -->
			<?php if(!empty($post)){ ?>	
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
									<label for="category">Category <span>*</span></label><br>
									<div class="input small-side">
										<?php echo form_dropdown('category', array(
											'select' => '',
											'retail' => 'Retail',
											'corporate' => 'Corporate'
										),'select') ?>
									</div>
									
									<br/>
									
									<label for="product_name">Name <span>*</span></label>
									<div class="input"><?php echo form_input('product_name', htmlspecialchars_decode($post->product_name), 'maxlength="100"') ?></div>
									
									<br/>
									
									<label for="product_slug">Slug <span>*</span></label>
									<div class="input"><?php echo form_input('product_slug', $post->product_slug, 'maxlength="100" class="width-20"') ?></div>
								</li>
						
								<li class="editor">
									<label for="body">Content <span>*</span></label><br>
									<div class="input small-side">
										<?php echo form_dropdown('type', array(
											'html' => 'html',
											'markdown' => 'markdown',
											'wysiwyg-simple' => 'wysiwyg-simple',
											'wysiwyg-advanced' => 'wysiwyg-advanced',
										), $post->type) ?>
									</div>
					
									<div class="edit-content">
										<?php echo form_textarea(array('id' => 'product_body', 'name' => 'product_body', 'rows' => 30, 'class' => $post->type)) ?>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
					
					<div class="form_inputs" id="product-packages-fields">
						<fieldset>
							<ul>
								<li>
									<label for="package_name">Package Name <span>*</span></label>
									<div class="input"><?php echo form_input('package_name', htmlspecialchars_decode($post->package_name), 'maxlength="100"') ?></div>
								</li>
					
								<li>
									<label for="package_slug">Slug <span>*</span></label>
									<div class="input"><?php echo form_input('package_slug', $post->package_slug, 'maxlength="100" class="width-20"') ?></div>
								</li>
						
								<li class="editor">
									<label for="body">Content <span>*</span></label><br>
									<div class="input small-side">
										<?php echo form_dropdown('type', array(
											'html' => 'html',
											'markdown' => 'markdown',
											'wysiwyg-simple' => 'wysiwyg-simple',
											'wysiwyg-advanced' => 'wysiwyg-advanced',
										), $post->type) ?>
									</div>
					
									<div class="edit-content">
										<?php echo form_textarea(array('id' => 'packages_body', 'name' => 'packages_body', 'rows' => 30, 'class' => $post->type)) ?>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
					
					<div class="form_inputs" id="product-css-fields">
						<fieldset>
							<ul>						
								<li class="editor">
									<label for="body">Custom CSS</label><br>
									<div class="edit-content">
										<?php echo form_textarea(array('id' => 'product_css', 'name' => 'product_css', 'rows' => 30, 'class' => 'markdown')) ?>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
					
					<div class="form_inputs" id="product-js-fields">
						<fieldset>
							<ul>						
								<li class="editor">
									<label for="body">Custom Javascript</label><br>
									<div class="edit-content">
										<?php echo form_textarea(array('id' => 'product_js', 'name' => 'product_js', 'rows' => 30, 'class' => 'markdown')) ?>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
				</div>
			<?php } ?>	
			<div class="buttons">
				<?php echo form_submit('submit', 'Save'); ?>
			</div>
			
			
			<?php echo form_close() ?>
		</div>
	</section>
</div>