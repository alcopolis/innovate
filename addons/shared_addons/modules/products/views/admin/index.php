<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($data->section) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
		
			<!-- Render Product list  -->
			<?php if(!empty($data->query)){ ?>	
				<div id="product-list">
					<table>
						<thead>
							<th with="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th>Name</th>
							<th>Slug</th>
							<th>Section</th>
							<th>Description</th>
							<th>Features</th>
							<th>Tags</th>
							<th>Action</th>
						</thead>
						
						<tfoot>
							<tr>
								<td colspan="8">
									<div class="inner"><!-- For Pagination --></div>
								</td>
							</tr>
						</tfoot>
						
						<tbody>
							<?php foreach($data->query->result() as $row) { ?>
								<tr>
									<?php
										echo '<td class="align-center">' . form_checkbox('action_to[]', $row->product_id) . '</td>';
										echo '<td><a href="admin/products/edit/' . $row->product_slug . '">' . $row->product_name . '</a></td>';
										echo '<td>' . $row->product_slug . '</td>';
										echo '<td>' . $row->product_section . '</td>';
										echo '<td>' . $row->product_body . '</td>';
										echo '<td>View Features</td>';
										echo '<td>' . $row->product_tags . '</td>';
										echo '<td>Edit &nbsp; Delete</td>';
									?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			<?php }else{ ?>
				<div class="no_data">There are no products at the moment.</div>
			<?php } ?>	
		
		</div>
	</section>
</div>