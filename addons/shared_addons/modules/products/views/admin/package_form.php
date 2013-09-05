<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($data->page_title); ?></h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				if($data->form_action == 'create'){
					echo form_open('admin/product/packages/' . $data->form_action);
				}else if($data->form_action == 'edit'){
					echo form_open('admin/product/packages/' . $data->form_action . '/' . $data->product->attribute['product_slug']);
				} 
			?>
			
			<?php if(!empty($post)){ ?>	
				
				<div class="tabs">
					<ul class="tab-menu">
						<li><a href="#package-content-fields"><span>Content</span></a></li>
						<li><a href="#package-custom-fields"><span>Custom Fields</span></a></li>
					</ul>
					
					<div id="package-content-fields" class="form_inputs">
						<fieldset>
							<ul>
								<li>
																										
									<label for="package_name">Name <span>*</span></label>
									<div class="input"><?php echo form_input('package_name') ?></div>
									
									<br/>
									
									<label for="package_slug">Slug <span>*</span></label>
									<div class="input"><?php echo form_input('product_slug') ?></div>
									
									<br/>
									
									<label for="package_group">Group <span></span></label>
									<div class="input"><?php echo form_input('product_slug') ?></div>
									
									<br/>
									
									<label for="package_price">Price</label>
									<div class="input"><?php echo form_input('package_price') ?></div>
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
									
									<br/>
									
									<div class="edit-content">
										<?php echo form_textarea(array('id' => 'package_body', 'name' => 'package_body', 'rows' => 30, 'class' => $post->type)) ?>
									</div>
								</li>
								<li>
									<div class="buttons align-right padding-top">							
										<button class="btn blue" value="save" name="btnAction" type="submit"><span>Save</span></button>
										<button class="btn blue" value="save_exit" name="btnAction" type="submit"><span>Save &amp; Exit</span></button>					
										<a class="btn gray cancel" href="http://localhost/innovate/admin/pages">Cancel</a>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
					
					<div id="package-custom-fields" class="form_inputs">
						<fieldset>
							<div class="util-bar"><a id="new-field" class="add button">Add New Field</a></div>
							<div id="custom-field">
								
							</div>
						</fieldset>
					</div>
				</div>
				
			<?php } ?>
			<?php echo form_close(); ?>
		</div>
	</section>
</div>