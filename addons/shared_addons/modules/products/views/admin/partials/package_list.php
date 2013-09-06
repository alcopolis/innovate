<fieldset>
<?php if(!empty($prod->packages)){ ?>	
	<div id="package-list">		
		<table>
			<thead>
				<th with="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
				<th>Package</th>
				<th>Price</th>
				<th>Description</th>
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
				<?php foreach($prod->packages as $row) { ?>
					<tr>
						<?php
							echo '<td class="align-center">' . form_checkbox('action_to[]', $row->package_id) . '</td>';
							echo '<td><a href="admin/products/packages/edit/' . $row->package_id . '">' . $row->package_name . '</a></td>';
							echo '<td>' . number_format($row->package_price, 0, ',', '.') . '</td>';
							echo '<td>' . $row->package_body . '</td>';
							echo '<td>Edit &nbsp; Delete</td>';
						?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
<?php }else{ ?>
	<div class="no_data">
		There are no packages at the moment.<br>
		<a href="admin/products/packages/create" class="add btn blue">Add New</a>
	</div>
<?php } ?>
</fieldset>	