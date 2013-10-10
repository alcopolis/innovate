<fieldset id="filters">
	<legend>Filters</legend>
	
	<style type="text/css">
		.filter{float:left; margin:10px;}
	</style>
	
	<?php echo form_open('admin/epg/shows/'); ?>					
		<div class="filter">
			<label for="cid">Channel</label>
			<div class="input clearfix">
				<?php echo form_dropdown('cid', $ch, set_value('cid')); ?>
			</div>
		</div>
		
		<div class="filter">
			<label for="date">Date</label>
			<div class="input"><?php echo form_input('date', set_value('date'), 'class="datepicker" maxlength="20"'); ?></div>
		</div>
		
		<div class="filter">
			<label for="name">Title</label>
			<div class="input"><?php echo form_input('title', '', 'maxlength="200" style="width:500px"'); ?></div>
		</div>
		
		<div class="filter">
			<label for="submit">&nbsp;</label>
			<?php echo form_submit('submit', 'View'); ?>
		</div>
		
	<?php echo form_close(); ?>
</fieldset>