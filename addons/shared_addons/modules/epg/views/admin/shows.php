<section class="title">
	<h4><?php echo lang('epg:shows'); ?></h4>
</section>

<section class="item">
	<div class="content">
		<?php echo $this->load->view('admin/partials/show_filters') ?>
		<?php echo $this->db->last_query();?>		
		<ul>
			<li>Import CSV</li>
			<li>Edit Record</li>
			<li>Set featured show</li>
			<li>Add poster</li>
		</ul>
        <?php 
			echo $table; 
		?>
        
	</div>
</section>