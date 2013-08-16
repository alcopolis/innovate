<div class="one_full">
	<section class="title">
		<h4><?php echo lang('subscribe:item_list'); ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
		
		<div id="filter">
			<?php $this->load->view('admin/partials/filter'); ?>
		</div>
		
		<?php echo form_open('admin/subscribe');?>
		
			<div id="promo-list">
			<?php if (!empty($subscribes)): ?>
				
				<div id="record-counter">Total <?php echo count($subscribes)?> Records</div>
				
				<table>
					<thead>
						<tr>
							<th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th>Name</th>
							<th>Address</th>
							<th>Phone</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>Package</th>
							<th>Entry Date</th>
							<th>Status</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="9">
								<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
							</td>
						</tr>
					</tfoot>
					<tbody>
						<?php foreach( $subscribes as $subscribe ): ?>
						<tr>
							<td><?php echo form_checkbox('action_to[]', $subscribe->id); ?></td>
							<td><?php echo $subscribe->name; ?></td>
							<td><?php echo $subscribe->address; ?></td>
							<td><?php echo '(' . $subscribe->area_code . ') ' . $subscribe->phone; ?></td>
							<td><?php echo $subscribe->mobile; ?></td>
							<td><?php echo $subscribe->email; ?></td>
							<td><?php echo $subscribe->packages; ?></td>
							<td><?php echo $subscribe->date; ?></td>
							<td><?php echo $subscribe->closing_flag == 1 ? 'Closing' : 'Open' ; ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				
				<div class="table_action_buttons">
					<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))); ?>
				</div>
				
			<?php else: ?>
				<div class="no_data">No Records Found</div>
			<?php endif;?>
			
			<?php echo form_close(); ?>
			</div>
			
		</div>
	</section>
</div>

