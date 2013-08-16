<fieldset id="filters">
	<legend>Filters</legend>
	
	<style type="text/css">
		.filter{float:left; margin:10px;}
	</style>
	
	<?php echo form_open('admin/subscribe'); ?>
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
											),'', 'style="width:140px"');
					 ?> 
				</div>
			</div>
			<div class="filter"><label>&nbsp</label><div class="input"><?php echo form_input('search_term','', 'style="width:300px;"'); ?></div></div>
			
			<div class="filter">
				<label>Status</label>
				<div class="input">
					<?php 
						echo form_dropdown('status', array(
												'no_entry' => 'Select',
												'0'	=> 'Open',
												'1'	=> 'Close',
											),'', 'style="width:120px"');
					 ?>
				</div>
			</div>
			
			<div class="filter">
				<label>Sort By</label>
				<div class="input">
					<?php echo form_dropdown('sort', array(
												'no_entry' 	=> 'Select',
												'name'		=>'Name',
												'phone'	=> 'Phone',
												'date' 		=> 'Entry Date',
											),'no_entry');
					?>
				</div>
			</div>
			<div class="filter">
				<label for="submit">&nbsp;</label>
				<?php echo form_submit('submit', 'View'); ?>
			</div>
		</div>
	<?php echo form_close(); ?>
	
	<a href="admin/subscribe/savecsv">Download</a>
</fieldset>