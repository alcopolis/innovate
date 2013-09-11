<fieldset>
<?php if(!empty($pack)){ ?>	
	<div id="package-list">		
		<div style="margin-bottom:20px;"><a href="admin/products/packages/create/<?php echo $prod->id; ?>" class="add btn blue">Add New</a></div>
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
				<?php foreach($pack as $row) { ?>
					<tr>
						<?php
							echo '<td class="align-center">' . form_checkbox('action_to[]', $row->id) . '</td>';
							echo '<td><a href="admin/products/packages/edit/' . $row->id . '">' . $row->name . '</a></td>';
							echo '<td>' . number_format($row->price, 0, ',', '.') . '</td>';
							echo '<td>' . $row->body . '</td>';
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
		<a href="admin/products/packages/create/<?php echo $prod->id; ?>" class="add btn blue">Add New</a>
	</div>
<?php } ?>
</fieldset>	