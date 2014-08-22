<fieldset>
	<ul>
		<li class="editor">
			<label for="title">Status</label>
			<div class="edit-content">
				<?php echo form_dropdown('status', array('0'=>'Draft', '1'=>'Published', '2'=>'Archived'), set_value('status', $art->status)); ?>
			</div>
		</li>
		
		<li class="editor">
			<label for="title">Title</label>
			<div class="edit-content">
				<?php
					if($page->action == 'edit'){
						echo form_input('title', set_value('title', $art->title), 'size="50" class="disable" style="color:#999;background:#EEE; cursor:not-allowed;" disabled="true"');
					}else{
						echo form_input('title', set_value('title', $art->title), 'size="50"');
					} 
				?>
			</div>
			
			<br/>
			
			<label for="title">Category</label>
			<div class="edit-content">
				<a class="add-form-item" href="javascript:void(0)" onClick="addCategory()">+ Add Category</a><br/>
				<?php echo form_dropdown('category', $cats, set_value('category', $art->category)); ?>
			</div>
			<label for="title">Keywords <span style="color:#333; font-weight:normal;">(seperate words with , )</span></span></label>
			<div class="edit-content">
				<?php echo form_input('keywords', set_value('keywords', $art->keywords), 'size="50"'); ?>
			</div>
		</li>
		
		<li class="editor">
			<label for="teaser">Teaser</label><br>
			<div class="edit-content">
				<?php echo form_textarea(array('id' => 'teaser', 'name' => 'teaser', 'value' => set_value('teaser', $art->teaser), 'rows' => 2, 'maxlength'=>'140')); ?>
			</div>
		</li>
		
		<li class="editor">
			<label for="body">Content</label>
			<div class="input small-side">
				<?php echo form_dropdown('editor_type', array(
					'html' => 'html',
					'markdown' => 'markdown',
					'wysiwyg-simple' => 'wysiwyg-simple',
					'wysiwyg-advanced' => 'wysiwyg-advanced',
				), 'wysiwyg-advanced') ?>
			</div>
			<div class="edit-content"><?php echo form_textarea(array('id' => 'body', 'value' => set_value('body', $art->body), 'name' => 'body', 'rows' => 30, 'class' => 'wysiwyg-advanced')); ?></div>
		</li>
	</ul>
</fieldset>