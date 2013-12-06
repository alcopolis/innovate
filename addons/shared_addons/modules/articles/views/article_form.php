
<div class="one_full">
	<section class="title clearfix">
		<h4 class="left"><?php echo strtoupper($page->title) . ' | ' . $art->name; ?></h4>
		<div id="modified" class="right" style="margin-right:30px; color:#999"><strong><?php echo date('d M Y | h:i', $art->modified_on) ?></strong> <em>(Last Modified)</em></div>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				if($page->action == 'create'){
					echo form_open('admin/products/' . $page->action, 'id="product-form"');
				}else if($page->action == 'edit'){
					echo form_open('admin/products/' . $page->action . '/' . $art->id, 'id="product-form"');
				} 
			?>
			
			<!-- Render Product list  -->
			
			<div id="page-data" style="margin-bottom:20px;">
				<div id="created-on">Created on : <?php echo date('d M Y', $art->created_on) ?></div>
			</div>
			
			<div class="tabs">
				<ul class="tab-menu">
					<li><a href="#article-content-fields"><span>Content</span></a></li>
					<?php if($page->action == 'edit'){ ?>
<!-- 						<li><a href="#product-attachment"><span>Attachment</span></a></li> -->
<!-- 						<li><a href="#product-packages-group"><span>Packages Group</span></a></li> -->
<!-- 						<li><a href="#product-packages-fields"><span>Packages</span></a></li> -->
					<?php } ?>					
					<li><a href="#article-css-fields"><span>CSS</span></a></li>
					<li><a href="#article-js-fields"><span>Script</span></a></li>
				</ul>
				
				<div class="form_inputs" id="article-content-fields">
					<?php echo form_hidden('form_data', array('id'=>$art->id, 'slug'=>$art->slug , 'poster_id'=>$poster['id'])); ?>
					
					<fieldset>
						<ul>
							<li>
								<table>
									<tbody>
										<tr>
											<td style="width:20%;">
												<label for="parent">Parent Product</label><br>
												<div class="input small-side">
													<?php echo form_dropdown('parent_id', $parent, set_value('parent_id', $art->parent_id)) ?>
												</div>
											</td>
											<td style="width:20%;">
												<div for="product_is_featured"><?php echo form_checkbox('is_featured', $art->is_featured, set_value('is_featured', $art->is_featured)); ?>&nbsp;&nbsp;<strong>Display in Homepage</strong></div>
											</td>
										</tr>
									</tbody>
								</table>
								
								
								<br/>
																	
								<label for="product_name">Name <span>*</span></label>
								<div class="input"><?php echo form_input('name', set_value('name', htmlspecialchars_decode($art->name)), 'maxlength="100"') ?></div>
								
								<br/>
								
								<?php if($page->action == 'edit'){ ?>
									<label for="product_slug">Slug</label>
									<div class="input"><?php echo form_input('slug', set_value('slug', $art->slug), 'disabled="disabled" maxlength="100" class="width-20"') ?></div>
									<br/>
								<?php } ?>
								
								<label for="product_tags">Tags - seperate words with comma ( , )</label>
								<div class="input"><?php echo form_input('tags', set_value('tags', $art->tags), 'maxlength="100" class="width-20"') ?></div>								
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
								<div class="edit-content"><?php echo form_textarea(array('id' => 'overview', 'value' => set_value('overview', $art->overview), 'name' => 'overview', 'rows' => 5)) ?></div>
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
									<?php echo form_textarea(array('id' => 'body', 'value' => set_value('body', $art->body), 'name' => 'body', 'rows' => 30, 'class' => $page->editor_type)) ?>
								</div>
							</li>
							
							<li class="editor">
								<label for="terms">Terms &amp; Condition</label><br>
								<div class="input small-side">
									<?php echo form_dropdown('editor_type', array(
										'html' => 'html',
										'wysiwyg-simple' => 'wysiwyg-simple',
										'wysiwyg-advanced' => 'wysiwyg-advanced',
									), 'wysiwyg-simple') ?>
								</div>
								<div class="edit-content">
									<?php echo form_textarea(array('id' => 'terms', 'value' => set_value('terms', $art->terms), 'name' => 'terms', 'rows' => 10, 'class' => 'wysiwyg-simple')) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>
				
				
				<?php if($page->action == 'edit'){ ?>
					<!-- Product Bundle Setting -->
					<div class="form_inputs" id="product-bundle">
						<?php $this->load->view('admin/partials/bundle', $bundle); ?>
					</div>
					
					<!-- Product Attachment Files -->
					<div class="form_inputs" id="product-attachment">
						<?php $this->load->view('admin/partials/attachment', array($poster, $attachment)); ?>
					</div>
					
					<!-- Package Group tab -->
					<div class="form_inputs" id="product-packages-group">
						<?php $this->load->view('admin/partials/package_group', $pack_group); ?>
					</div>
					
					<!-- Product package tab -->
					
					<div class="form_inputs" id="product-packages-fields">
						<?php $this->load->view('admin/partials/package_list', $pack); ?> 
					</div>
				<?php } ?>	
					
				<!-- Product CSS tab -->
				<div class="form_inputs" id="article-css-fields">
					<fieldset>
						<ul>						
							<li class="editor">
								<label for="body">Custom CSS</label><br>
								<div class="edit-content">
									<?php echo form_textarea(array('id' => 'css', 'name' => 'css', 'value' => set_value('css', $art->css), 'rows' => 30, 'class' => 'markdown')) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>
				
				
				<!-- Product JS tab -->
				<div class="form_inputs" id="article-js-fields">
					<fieldset>
						<ul>						
							<li class="editor">
								<label for="body">Custom Javascript</label><br>
								<div class="edit-content">
									<?php echo form_textarea(array('id' => 'js', 'name' => 'js', 'value' => set_value('js', $art->js), 'rows' => 30, 'class' => 'markdown')) ?>
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