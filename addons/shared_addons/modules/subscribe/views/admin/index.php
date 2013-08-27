<div class="one_full">
	<section class="title">
		<h4><?php echo lang('subscribe:item_list'); ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
		
		<div id="filter">
			<?php $this->load->view('admin/partials/filter'); ?>
		</div>
		
		<?php /* echo form_open('admin/subscribe'); */ ?>
		
			<div id="promo-list">
			<?php if (!empty($subscribes)): ?>
				
				<div id="record-counter">Total <?php echo count($subscribes)?> Records</div>
				
				<table>
					<thead>
						<tr>
							<?php /* <th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th> */ ?>
							<th style="width:120px;">Name</th>
							<th>Address</th>
							<th class="align-center" style="width:120px;">Phone</th>
							<th class="align-center" style="width:120px;">Mobile</th>
							<th class="align-center" style="width:120px;">Email</th>
							<th>Package</th>
							<th class="align-center">Entry Date</th>
							<th class="align-center">Status</th>
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
							<?php /*<td><?php echo form_checkbox('action_to[]', $subscribe->id); ?></td> */ ?>
							<td><?php echo $subscribe->name; ?></td>
							<td><?php echo $subscribe->address; ?></td>
							<td class="align-center"><?php echo '(' . $subscribe->area_code . ') ' . $subscribe->phone; ?></td>
							<td class="align-center"><?php echo $subscribe->mobile; ?></td>
							<td class="align-center"><?php echo $subscribe->email; ?></td>
							<td><?php echo $subscribe->packages; ?></td>
							<td class="align-center">
								<?php
									$d = strtotime($subscribe->date);
									echo date('d-m-Y', $d); 
								?>
							</td>
							<td class="align-center" id="<?php echo $subscribe->id; ?>">
								<?php 			
								
									$attr = 'id="' . $subscribe->id . '" style="width:120px" class="status-dropdown"';
									
									if($subscribe->closing_flag == '2'){
										echo '<span style="color:#F00;"><strong>CLOSED</strong></span>';
									}else{
										echo form_dropdown('', array(
												'0'	=> 'Open',
												'1'	=> 'On Progress',
												'2'	=> 'Closed',
										), set_value('status', $subscribe->closing_flag), $attr);
									}									
								?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				
			<?php else: ?>
				<div class="no_data">No Records Found</div>
			<?php endif;?>
			
			<?php /* echo form_close(); */ ?>
			</div>
			
		</div>
	</section>
</div>

<script type="text/javascript">
	$('.status-dropdown').change(function(){
		var sid = $(this).attr('id');
		
		$.ajax({
			type: 'GET',
			url: 'admin/subscribe/change_status/?id=' + sid + '&val=' + $(this).val(),
			//processData: false,
		    //contentType: false,
			//data:formData,
			dataType: 'json',
			success: function(response) {
				//window.location = response.url;
				//console.log(response.lock);
				if(response.lock){
					$parent = $('td#' + sid);
					$parent.html('<span style="color:#F00;"><strong>CLOSED</strong></span>');
					//console.log($('td#' + sid).children('select').attr('id'));
				}
			},
		});
	})
</script>

