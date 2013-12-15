<div class="one_full">
	<div style="margin:0 0 20px 0; text-align:right;"><a class="btn blue" href="admin/articles/create">Add Article</a></div>
	
	<section class="title">
		<h4>Articles</h4>
	</section>
		
	<section class="item">
		<div class="content">
	        <?php if(!empty($articles)){ ?>
	        	<div id="article-list">
	        		<table>
	        			<thead>
	        				<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th style="width:25%;">Title</th>
							<th style="width:45%;">Teaser</th>
							<th class="align-center" style="width:10%;">Category</th>
							<th class="align-center" style="width:10%;">Status</th>
							<th class="align-center" style="width:10%;">Action</th>
	        			</thead>
	        			
	        			<tfoot>
							<tr>
								<td colspan="6">
									<div class="inner"><?php echo $pagination['links']; ?></div>
								</td>
							</tr>
						</tfoot>
						
	        			<tbody>
	        				<?php foreach($articles as $a) { ?>
	        					<tr>
	        						<td><?php echo form_checkbox('action_to[]', $a->id); ?></td>
	        						<td><a href="admin/articles/edit/<?php echo $a->id; ?>"><?php echo $a->title; ?></a></td>
	        						<td><?php echo $a->teaser; ?></td>
	        						<td class="align-center"><?php echo $a->category; ?></td>
	        						<td class="align-center"><?php echo $a->status; ?></td>
	        						<td class="align-center"><a href="admin/articles/edit/<?php echo $a->id; ?>">Edit</a></td>
	        					</tr>
	        				<?php } ?>	
	        			</tbody>
	        		</table>
	        	</div>
	        <?php } ?>	
		</div>
	</section>
</div>