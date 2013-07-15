<fieldset id="filters">
	<legend><?php echo lang('global:filters') ?></legend>

	<h2>SEARCH &amp; FILTER</h2>
	
	<?php echo form_open(); ?>
	
		<label for="cat">Category</label>
		<div class="input clearfix">
			<?php echo form_dropdown('cat', $cat->categories, set_value($cat->categories) ); ?>
		</div>
		
		<label for="cid">Channel</label>
		<div class="input clearfix">
			<?php echo form_dropdown('cid', $ch->ch, set_value($ch->ch)); ?>
		</div>
		
		<label for="date">Date</label>
		<div class="input"><?php echo form_input('date', '', 'maxlength="20"'); ?></div>
		
		<label for="name">Title</label>
		<div class="input"><?php echo form_input('title', '', 'maxlength="200"'); ?></div>
		
	<?php echo form_close(); ?>
</fieldset>