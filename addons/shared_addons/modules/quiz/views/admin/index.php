<div class="one_full">

<!--	<section class="title">

		<h4><?php echo strtoupper($page->section) ?></h4>

	</section> -->

	<section class="item">

		<div class="content">

			

			<!-- Render Product list  -->

			<?php if(!empty($quiz)){ ?>	

				<div id="product-list">

					<table>

						<thead>

							<th width="30" class="align-center"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>

							<th>Name</th>

							<th>Slug</th>

							<th>Start Date</th>

							<th>End Date</th>

							<th>Description</th>
							
							<th>Theme</th>

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

							<?php foreach($quiz as $row) { ?>

								<tr>

									<?php							

										echo '<td class="align-center">' . form_checkbox('action_to[]', $row->id) . '</td>';

										echo '<td><a href="admin/quiz/edit/' . $row->id . '">' . $row->name . '</a></td>';

										echo '<td>' . $row->slug . '</td>';

										echo '<td class="align-center" >' . $row->start_date . '</td>';
										
										echo '<td class="align-center" >' . $row->end_date . '</td>';
										
										echo '<td>' . $row->description . '</td>';
										
										echo '<td>' .$row->theme . '</td>';

										echo '<td><a href="admin/quiz/edit/' . $row->id . '">Edit</a> &nbsp; Delete</td>';

									?>

								</tr>

							<?php } ?>

						</tbody>

					</table>

				</div>

			<?php }else{ ?>

				<div class="no_data">There are no quiz at the moment.</div>

			<?php } ?>	

		

		</div>

	</section>

</div>