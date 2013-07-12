<fieldset id="filters">
	<legend><?php echo lang('global:filters') ?></legend>

	<h2>SEARCH &amp; FILTER</h2>
	
	<?php echo form_open('epg/admin/shows'); ?>
		
		<label for="name">Search Title</label>
		<div class="input"><?php echo form_input('title', '', 'maxlength="200"'); ?></div>
		
	<?php echo form_close(); ?>
	
<!-- 	<ul> -->
<!-- 		<li>Filter by channel</li> -->
<!-- 		<li>Filter by category</li> -->
<!-- 		<li>Filter by date</li> -->
<!-- 		<li>Search by title</li> -->
<!-- 	</ul> -->
</fieldset>