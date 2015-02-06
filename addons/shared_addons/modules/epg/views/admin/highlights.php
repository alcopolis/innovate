<div class="one_full">
	<section class="title">
		<h4>Program Highlights</h4>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php if(!empty($highlights)){ ?>
	        	<div id="channel-list">
	        		<table>
	        			<thead>
	        				<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th style="width:35%;">Title</th>
							<th class="align-center" style="width:5%;">Channel</th>
							<th class="align-center" style="width:40%;">Sinopsis</th>
							<th class="align-center" style="width:5%;">Start</th>							<th class="align-center" style="width:5%;">End</th>
							<th class="align-center" style="width:10%;">Action</th>
	        			</thead>
	        			<tfoot>
							<tr>
								<td colspan="7">
									<div class="inner"><?php //echo $pagination['links']; ?></div>
								</td>
							</tr>
						</tfoot>						
	        			<tbody>
	        				<?php foreach($highlights as $hl) { ?>
	        					<tr>
	        						<td><?php echo form_checkbox('action_to[]', $hl->id); ?></td>
	        						<td><a href="admin/epg/highlights/edit/<?php echo $hl->id; ?>"><?php echo $hl->title; ?></a></td>
	        						<td class="align-center"><?php echo $hl->name; ?></td>
	        						<td><?php echo $hl->sinopsis; ?></td>
	        						<td class="align-center"><?php echo $hl->start_date; ?></td>
	        						<td class="align-center"><?php echo $hl->end_date; ?></td>
	        						<td class="align-center"><a href="admin/epg/highlights/edit/<?php echo $hl->id; ?>">Edit</a></td>
	        					</tr>
	        				<?php } ?>	
	        			</tbody>
	        		</table>
	        	</div>
	        <?php } ?>	
		</div>
	</section>
</div>