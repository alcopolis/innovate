<div class="one_full">
	<section class="title">
		<h4><?php echo lang('epg:channels'); ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
			<?php echo $this->load->view('admin/partials/channel_filters') ?>
			
			<ul>
				<li>Add channel</li>
				<li>Edit channel</li>
				<li>Add channel logo</li>
			</ul>
	          <?php
	          	//echo $table;
	          ?>
	          
	        <?php if(!empty($channels)){ ?>
	        	<div id="channel-list">
	        		<table>
	        			<thead>
	        				<th width="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th>Ch Name</th>
							<th>Ch Number</th>
							<th>Action</th>
	        			</thead>
	        			
	        			<tfoot>
							<tr>
								<td colspan="4">
									<div class="inner"><?php echo $pagination['links']; ?></div>
								</td>
							</tr>
						</tfoot>
						
	        			<tbody>
	        				<?php foreach($channels as $ch) { ?>
	        					<tr>
	        						<td><?php echo form_checkbox('action_to[]', $ch->id); ?></td>
	        						<td><?php echo $ch->name; ?></td>
	        						<td><?php echo $ch->num; ?></td>
	        						<td>Edit</td>
	        					</tr>
	        				<?php } ?>	
	        			</tbody>
	        		</table>
	        	</div>
	        <?php } ?>	
		</div>
	</section>
</div>