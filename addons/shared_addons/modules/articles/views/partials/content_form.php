<fieldset>
	<ul>
		<li class="editor">
			<label for="title">Title</label><br>
			<div class="edit-content">
				<?php
					if($page->action == 'edit'){
						echo form_input('title', set_value('title', $art->title), 'size="50" class="disable" style="color:#999;background:#EEE; cursor:not-allowed;" disabled="true"');
					}else{
						echo form_input('title', set_value('title', $art->title), 'size="50"');
					} 
				?>
			</div>
		</li>
		
		<li class="editor">
			<label for="title">Category</label><br><br>
			<div class="edit-content">
				<a class="add-form-item" href="javascript:void(0)" onClick="addCategory(this)">+ Add Category</a><br/><br/>
				<div id="new-cat-div" class="edit-content hide"><?php echo form_input('new_category', '', 'size="50"') . '<input id="new-cat-btn" type="button" value="Add New" />'; ?></div>
				<?php echo form_dropdown('category', $cats, set_value('category', $art->category)); ?>
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