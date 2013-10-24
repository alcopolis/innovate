<fieldset id="filters">
	<legend>Filter</legend>
	
	<style type="text/css">
		.filter{float:left; margin:10px;}
	</style>
	
	<?php echo form_open('admin/subscribe', 'id="filter-form"'); ?>
		<div id="search">
			
			<div class="filter">
				<label>Search By</label>
				<div class="input">
					<?php 
						echo form_dropdown('search_key', array(
												'no_entry' 	=> 'Select',
												'name'		=>'Name',
												'area_code' => 'Phone Area',
												'date' 		=> 'Entry Date',
											), set_value('search_key', $filter->search_key), 'style="width:140px"');
					 ?> 
				</div>
			</div>
			<div class="filter"><label>&nbsp</label><div class="input"><?php echo form_input('search_term', set_value('search_term', $filter->search_term), 'class="" style="width:300px;"'); ?></div></div>
			
			<div class="filter">
				<label>Status</label>
				<div class="input">
					<?php 
						echo form_dropdown('status', array(
												'no_entry' => 'Select',
												'0'	=> 'Open',
												'1'	=> 'On Progress',
												'2'	=> 'Closed',
												'3'	=> 'Cancelled',
											), set_value('status', $filter->status), 'style="width:120px"');
					 ?>
				</div>
			</div>
			
			<div class="filter">
				<label>Sort By</label>
				<div class="input">
					<?php echo form_dropdown('sort', array(
												'no_entry' 	=> 'Select',
												'name'		=>'Name',
												'phone'		=> 'Phone',
												'date' 		=> 'Entry Date',
											), set_value('sort', $filter->sort));
					?>
				</div>
			</div>
			
			<div class="filter">
				<label for="submit">&nbsp;</label>
				<?php echo form_submit('submit', 'View'); ?>
			</div>
				
			<div id="download-data" style="background:#CCC; margin:36px 0 0 0;" class="filter">
				<a onclick="doSave()" class="button" style="padding:5px 10px 4px 10px;">Download</a>
			</div>
		</div>
	<?php echo form_close(); ?>
</fieldset>