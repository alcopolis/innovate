<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page->title) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
			<?php 
				if($page->action == 'create'){
					echo form_open_multipart('admin/promotion/' . $page->action, 'id="promo-form"');
				}else if($page->action == 'edit'){
					echo form_open_multipart('admin/promotion/' . $page->action . '/' . $promos->id, 'id="promo-form"');
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
									<div style="float:left; width:50%;">
										<label for="name">Name <span>*</span></label>
										<div class="input"><?php echo form_input('name', htmlspecialchars_decode($promos->name), 'maxlength="100"') ?></div>
										
										<br/>
										
										<label for="cat">Category <span></span></label>
										<div class="input"><?php echo form_dropdown('cat', $cats, $promos->cat) ?></div>
										
										<br/>
										
										<label for="slug">Slug <span>*</span></label>
										<div class="input"><?php echo form_input('slug', $promos->slug, 'maxlength="100" class="width-20"') ?></div>
										
										<br/>
										
										<label for="tags">Tags - seperate words with ( , )</label>
										<div class="input"><?php echo form_input('tags', $promos->tags, 'maxlength="100" class="width-20"') ?></div>
									</div>
									
									<div class="clearfix">
										<label for="publish">Publish Date</label>
										<div class="input"><?php echo form_input('publish', set_value('publish', $promos->publish), 'class="datepicker" maxlength="20"'); ?></div>
										
										<br/>
										
										<label for="ended">End Date</label>
										<div class="input"><?php echo form_input('ended', set_value('publish', $promos->ended), 'class="datepicker" maxlength="20"'); ?></div>
										
										<br/>
										
										<label for="poster">Upload Poster</label>
										<div class="input">
											<?php echo form_upload('poster','','id="poster" style="margin:5px 0;"'); ?> &nbsp; <?php echo '<a onclick="process();" class="button" style="padding:5px 10px 4px 10px;">Upload</a>'; ?>
											<br/>
											<div id="msg-ajax"></div>
										</div>
										
										<div id="img-poster" style="width:100%;">
											<?php if($poster != NULL){ ?>
												<img style="width:300px;" src="<?php echo $poster['file'];?>" title="<?php echo $poster['name']; ?>" />
											<?php } ?>
										</div>
										
										<?php echo form_hidden('form_data', array('id'=>$promos->id, 'slug'=>$promos->slug , 'poster_id'=>$poster['id'])); ?>
									</div>
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
						<fieldset>
							add new category form
						</fieldset>
					</div>
					
					<div class="form_inputs" id="promo-css-fields">
						<fieldset>
							<ul>						
								<li class="editor">
									<label for="body">Custom CSS</label><br>
									<div class="edit-content">
										<?php echo form_textarea(array('id' => 'css', 'name' => 'css', 'value' => $promos->css, 'rows' => 30, 'class' => 'markdown')) ?>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
					
					<div class="form_inputs" id="promo-js-fields">
						<fieldset>
							<ul>						
								<li class="editor">
									<label for="body">Custom Javascript</label><br>
									<div class="edit-content">
										<?php echo form_textarea(array('id' => 'js', 'name' => 'js', 'value' => $promos->js, 'rows' => 30, 'class' => 'markdown')) ?>
									</div>
								</li>
							</ul>
						</fieldset>
					</div>
				</div>
			<?php } ?>
			<div class="buttons">
				<?php 
						echo form_submit('submit', 'Save'); 
						echo '<a href="admin/promotion" class="button" style="padding:5px 10px 4px 10px;">Cancel</a>';
				?>
			</div>	
		</div>
	</section>
</div>