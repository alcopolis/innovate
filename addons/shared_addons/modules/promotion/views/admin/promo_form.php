<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page->title) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
			<?php 
				if($page->action == 'create'){
					echo form_open('admin/promotion/' . $page->action);
				}else if($page->action == 'edit'){
					echo form_open('admin/promotion/' . $page->action . '/' . $promos->id);
				} 
			?>
			
			<?php if(!empty($promos)){ ?>
				<div class="tabs">
					<ul class="tab-menu">
						<li><a href="#promo-content-fields"><span>Content</span></a></li>
						<li><a href="#category"><span>Category</span></a></li>
						<li><a href="#promo-css-fields"><span>CSS</span></a></li>
						<li><a href="#promo-js-fields"><span>Script</span></a></li>
					</ul>
					
					<div class="form_inputs" id="promo-content-fields">
						<fieldset>
							<ul>
								<li>
									<label for="name">Name <span>*</span></label>
									<div class="input"><?php echo form_input('name', htmlspecialchars_decode($promos->name), 'maxlength="100"') ?></div>
									
									<br/>
									
									<label for="slug">Slug <span>*</span></label>
									<div class="input"><?php echo form_input('slug', $promos->slug, 'maxlength="100" class="width-20"') ?></div>
									
									<br/>
									
									<label for="tags">Tags - seperate words with ( , )</label>
									<div class="input"><?php echo form_input('tags', $promos->tags, 'maxlength="100" class="width-20"') ?></div>
									
									<br/>
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
										<?php echo form_textarea(array('id' => 'body', 'value' => $promos->body, 'name' => 'body', 'rows' => 30, 'class' => $page->editor_type)) ?>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
					
					<div class="form_inputs" id="category">
						
					</div>
					
					<div class="form_inputs" id="promo-css-fields">
						
					</div>
					
					<div class="form_inputs" id="promo-js-fields">
						
					</div>
				</div>
			<?php } ?>	
		</div>
	</section>
</div>