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
	        				<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th style="width:20%;">Name</th>
							<th class="align-center" style="width:5%;">Number</th>
							<th class="align-center" style="width:5%;">Status</th>
							<th class="align-center" style="width:20%;">Category</th>
							<th class="align-center" style="width:40%;">Description</th>
							<th class="align-center" style="width:10%;">Action</th>
	        			</thead>
	        			
	        			<tfoot>
							<tr>
								<td colspan="6">
									<div class="inner"><?php echo $pagination['links']; ?></div>
								</td>
							</tr>
						</tfoot>
						
	        			<tbody>
	        				<?php foreach($channels as $ch) { ?>
	        					<tr>
	        						<td><?php echo form_checkbox('action_to[]', $ch->id); ?></td>
	        						<td><a href="admin/epg/channels/edit/<?php echo $ch->id; ?>"><?php echo $ch->name; ?></a></td>
	        						<td class="align-center"><?php echo $ch->num; ?></td>
	        						<td class="align-center"><?php echo $ch->is_active == '0' ? 'Disabled' : 'Active'; ?></td>
	        						<td class="align-center"><?php echo $ch->cat; ?></td>
	        						<td><?php echo substr($ch->desc,0,150); ?></td>
	        						<td class="align-center"><a href="admin/epg/channels/edit/<?php echo $ch->id; ?>">Edit</a></td>
	        					</tr>
	        				<?php } ?>	
	        			</tbody>
	        		</table>
	        	</div>
	        <?php } ?>	
		</div>
	</section>
</div>