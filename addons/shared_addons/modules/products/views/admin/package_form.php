<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page_data->section) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				if($page_data->action == 'create'){
					echo form_open('admin/products/packages/' . $page_data->action);
				}else if($page_data->action == 'edit'){
					echo form_open('admin/products/packages/' . $page_data->action . '/' . $packages_data->id);
				} 
			?>
			
			<?php if(!empty($packages_data)){ ?>	
				
				<div class="tabs">
					<ul class="tab-menu">
						<li><a href="#package-content-fields"><span>Content</span></a></li>
<!-- 						<li><a href="#package-custom-fields"><span>Custom Fields</span></a></li> -->
					</ul>
					
					<div id="package-content-fields" class="form_inputs">
						<fieldset>
							<ul>
								<li>
									<label for="product_name">Product Parent</label>
									<div class="input">
										<?php 										
											if(empty($packages_data->prod_id) && $page_data->action == 'create'){
												echo form_dropdown('prod_id', $packages_data->prod_list, $this->input->post('prod_id'));
											}elseif(!empty($packages_data->prod_id) && $page_data->action == 'create'){
												echo form_dropdown('prod_id', $packages_data->prod_list, $packages_data->prod_id);
											}else{
												echo form_input('prod_id', set_value('prod_name', htmlspecialchars_decode($packages_data->prod_name)), 'disabled');
											} 
										?>
									</div>
									
									<br/>
																										
									<label for="package_name">Name <span>*</span></label>
									<div class="input"><?php echo form_input('name', set_value('name', $packages_data->name)) ?></div>
									
									<br/>
									
									<label for="package_slug">Slug <span>*</span></label>
									<div class="input"><?php echo form_input('slug', set_value('slug', $packages_data->slug)) ?></div>
									
									<br/>
									
									<label for="package_group">Group <span></span></label>
									<div class="input"><?php echo form_input('group_id', set_value('group_id', $packages_data->group_id)) ?></div>
									
									<br/>
									
									<label for="package_price">Price (Rupiah)</label>
									<div class="input"><?php echo form_input('price', set_value('price', $packages_data->price)) ?></div>
								</li>
						
								<li class="editor">
									<label for="body">Content <span>*</span></label><br>
									<div class="input small-side">
										<?php echo form_dropdown('editor_type', array(
											'html' => 'html',
											'markdown' => 'markdown',
											'wysiwyg-simple' => 'wysiwyg-simple',
											'wysiwyg-advanced' => 'wysiwyg-advanced',
										),$page_data->post_type) ?>
									</div>
									
									<br/>
									
									<div class="edit-content">
										<?php echo form_textarea(array('value' => set_value('body', $packages_data->body), 'id' => 'body', 'name' => 'body', 'rows' => 10, 'class' => $page_data->post_type)) ?>
									</div>
								</li>
								<li>								
									<div class="buttons align-right padding-top">
										<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )) ?>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
					
<!-- 					<div id="package-custom-fields" class="form_inputs"> -->
<!-- 						<fieldset> -->
<!-- 							<div class="util-bar"><a id="new-field" class="add button">Add New Field</a></div> -->
<!-- 							<div id="custom-field"> -->
								
<!-- 							</div> -->
<!-- 						</fieldset> -->
<!-- 					</div> -->
				</div>
				
			<?php } ?>
			<?php echo form_close(); ?>
		</div>
	</section>
</div>