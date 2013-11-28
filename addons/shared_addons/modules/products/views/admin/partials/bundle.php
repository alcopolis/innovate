<fieldset>
	<ul>
		<li>
			<div><?php echo form_checkbox('bundle_status', $bundle->status, set_value('bundle_status', $bundle->status)); ?> <label for="bundle_status">Add Bundle Tab</label></div>
			
			<div class="input small-side clearfix" style="margin-top:10px;">
				<label for="bundle_type">Type</label><br>
				<?php echo form_dropdown('bundle_type', array(
					'default' => 'Default',
					'custom' => 'Custom',
				), $bundle->type) ?>
			</div>
		</li>
		<li class="editor">
			<div class="input small-side">
				<?php echo form_dropdown('editor_type', array(
					'html' => 'html',
					'wysiwyg-simple' => 'wysiwyg-simple',
					'wysiwyg-advanced' => 'wysiwyg-advanced',
				), 'wysiwyg-simple') ?>
			</div>
			<div class="edit-content">
				<?php echo form_textarea(array('id' => 'bundle_body', 'value' => set_value('bundle_body', $bundle->body), 'name' => 'bundle_body', 'rows' => 10, 'class' => 'wysiwyg-simple')) ?>
			</div>
		</li>
	</ul>
</fieldset>