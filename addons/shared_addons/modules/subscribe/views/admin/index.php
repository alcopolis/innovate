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
				
				<div id="record-counter" style="margin:30px 0 10px 0; font-weight:bold; background:#EEE; padding:10px; border-radius:3px;"><?php echo count($subscribes)?> Subscribers</div>
				
				<table>
					<thead>
						<tr>
							<?php /* <th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th> */ ?>
							<th style="width:10%;">Name</th>
							<th style="width:12.5%;">Address</th>
							<th class="align-center" style="width:5%;">Phone</th>
							<th class="align-center" style="width:5%;">Mobile</th>
							<th class="align-center" style="width:12.5%;">Email</th>
							<th style="width:12.5%;">Package</th>
							<th class="align-center" style="width:10%;">Entry Date</th>
							<th class="align-center" style="width:10%;">Status</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="9">
								<div class="inner"><?php echo $pagination['links']; ?></div>
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
									
									if($subscribe->closing_flag == '2' || $subscribe->closing_flag == '3'){
										switch($subscribe->closing_flag){
											case '2': echo '<span style="color:rgba(0,180,0,.75);"><strong>Closed</strong></span>'; break;
											case '3': echo '<span style="color:rgba(255,0,0,.75);"><strong>Cancelled</strong></span>'; break;
										}
										
									}else{
										echo form_dropdown('', array(
												'0'	=> 'Open',
												'1'	=> 'On Progress',
												'2'	=> 'Close',
												'3'	=> 'Cancel',
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
// 	$('.status-dropdown').change(function(){
// 		var sid = $(this).attr('id');
		
// 		$.ajax({
// 			type: 'GET',
// 			url: 'admin/subscribe/change_status/?id=' + sid + '&val=' + $(this).val(),
// 			dataType: 'json',
// 			success: function(response) {
// 				if(response.lock){
// 					$parent = $('td#' + sid);

// 					switch(response.val){
// 						case '2': $parent.html('<span style="color:rgba(0,180,0,.75);"><strong>Closed</strong></span>'); break;
// 						case '3': $parent.html('<span style="color:rgba(255,0,0,.75);"><strong>Cancelled</strong></span>'); break;
// 					}
					
// 				}
// 			},
// 		});
// 	})
</script>

