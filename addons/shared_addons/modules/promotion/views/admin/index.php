<div class="one_full">
	<section class="title">
		<h4>Promotion</h4>
	</section>
	
	<section class="item">
		<div class="content">
			<!-- Render Promo list  -->
			<div id="promo-list">
			<?php if(!empty($promos)){ ?>	
				<table>
					<thead>
						<th width="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
						<th>Name</th>
						<th class="align-center">Slug</th>
						<th class="align-center">Category</th>
						<th class="align-center">Status</th>
						<th class="align-center">Action</th>
					</thead>
					
					<tfoot>
						<tr>
							<td colspan="8">
								<div class="inner"><!-- For Pagination --></div>
							</td>
						</tr>
					</tfoot>
					
					<tbody>
						<?php foreach($promos as $promo) { ?>
							<tr>
								<?php							
									echo '<td class="align-center">' . form_checkbox('action_to[]', $promo->id) . '</td>';
									echo '<td style="width:20%;"><a href="admin/promotion/edit/' . $promo->id . '">' . $promo->name . '</a></td>';
									echo '<td class="align-center">' . $promo->slug . '</td>';
									echo '<td class="align-center">' . $promo->cat . '</td>';
									echo '<td class="align-center">' . $promo->status . '</td>';
									echo '<td class="align-center"><a href="admin/promotion/edit/' . $promo->id . '">Edit</a></td>';
								?>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			<?php } ?>
			</div>
		</div>
	</section>
</div>