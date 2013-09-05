<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page_data->section) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
		
			<!-- Render Package list  -->
			<?php if(!empty($packages_data)){ ?>
				<div id="filter">ITEM FILTER</div>	
	
				<div id="product-list">
					<table>
						<thead>
							<th with="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th>Name</th>
							<th class="align-center">Slug</th>
							<th class="align-center">Parent Product</th>
							<th class="align-center" style="width:8%;">Price</th>
							<th class="align-center">Category</th>
							<th class="align-center">Group</th>
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
							<?php foreach($packages_data as $row) { ?>
								<tr>
									<?php
										echo '<td class="align-center">' . form_checkbox('action_to[]', $row->id) . '</td>';
										echo '<td><a href="admin/products/packages/edit/' . $row->id . '">' . $row->name . '</a></td>';
										echo '<td class="align-center">' . $row->slug . '</td>';
										echo '<td class="align-center">' . $row->prod_id . '</td>';
										echo '<td class="align-center">' . number_format(intval($row->price)) . '</td>';
										echo '<td class="align-center">' . $row->cat . '</td>';
										echo '<td class="align-center">' . $row->group . '</td>';
										echo '<td class="align-center"><a class="btn blue" href="admin/products/packages/edit/' . $row->id . '">Edit</a> &nbsp; Delete</td>';
									?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			<?php }else{ ?>
				<div class="no_data">There are no packages at the moment.</div>
			<?php } ?>	
			
		</div>
	</section>
</div>