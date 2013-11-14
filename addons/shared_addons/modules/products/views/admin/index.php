<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page->section) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
			
			<!-- Render Product list  -->
			<?php if(!empty($prod)){ ?>	
				<div id="product-list">
					<table>
						<thead>
							<th width="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th>Name</th>
							<th>Slug</th>
							<th>Section</th>
							<th>Body</th>
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
							<?php foreach($prod as $row) { ?>
								<tr>
									<?php							
										echo '<td class="align-center">' . form_checkbox('action_to[]', $row->id) . '</td>';
										echo '<td><a href="admin/products/edit/' . $row->id . '">' . $row->name . '</a></td>';
										echo '<td>' . $row->slug . '</td>';
										echo '<td class="align-center" >' . $row->section . '</td>';
										echo '<td style="width:40%;">' . strip_tags(substr($row->overview, 0, 150)) . '</td>';
										echo '<td>' . $row->tags . '</td>';
										echo '<td><a href="admin/products/edit/' . $row->id . '">Edit</a> &nbsp; Delete</td>';
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