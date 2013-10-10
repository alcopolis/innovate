<div class="one_full">
	<section class="title">
		<h4><?php echo lang('epg:shows'); ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
			<?php 
				echo $this->load->view('admin/partials/show_filters') ;
			?>
			
			
			<div id="head-info">
			<?php 
				if($page->view == 'featured'){
					echo '<h2>Active Featured Show</h2>';
				}elseif($page->view == 'filter'){
					if(!empty($ch_info)){
						echo '<h2>' . $ch_info->name . '</h2>';
						echo '<p>' . $ch_info->desc . '</p>';
					}
				}
			?>	
			</div>
			
			
			
			<div id="show-list">
	        	<table>
	        		<?php if($page->view == 'featured'){ ?>	
	        			<thead>
	        				<?php /*<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>*/ ?>
							<th>Title</th>
							<th class="align-center">Date</th>
							<th class="align-center">Time</th>
							<th class="align-center">Duration</th>
							<th class="align-center">Channel</th>
							<th class="align-center">Category</th>
							<th class="align-center" style="width:10%;">Action</th>
	        			</thead>
	        			
	        			<tfoot>
							<tr>
								<td colspan="7">
									<div class="inner"></div>
								</td>
							</tr>
						</tfoot>
						
	        			<tbody>
	        				<?php foreach($sh as $s) { ?>
	        					<tr>
	        						<?php /*<td><?php echo form_checkbox('action_to[]', $s->id); ?></td>*/ ?>
	        						<td><a href="admin/epg/shows/edit/<?php echo $s->id; ?>"><?php echo $s->title; ?></a></td>
	        						<td class="align-center"><?php echo $s->date; ?></td>
	        						<td class="align-center"><?php echo $s->time; ?></td>
	        						<td class="align-center"><?php echo $s->duration; ?></td>
	        						<td class="align-center"><?php echo $s->name; ?></td>
	        						<td class="align-center"><?php echo $sh_cat[$s->cat_id]; ?></td>
	        						<td class="align-center"><a href="admin/epg/shows/edit/<?php echo $s->id; ?>">Edit</a></td>
	        					</tr>
	        				<?php } ?>	
	        			</tbody>
	        		<?php }elseif($page->view == 'filter'){ ?>	
	        			<thead>
	        				<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th>Title</th>
							<th class="align-center">Date</th>
							<th class="align-center">Time</th>
							<th class="align-center">Duration</th>
							<th class="align-center">Featured</th>
							<th class="align-center" style="width:10%;">Action</th>
	        			</thead>
	        			
	        			<tfoot>
							<tr>
								<td colspan="7">
									<div class="inner"><?php if(isset($pagination)){ echo $pagination['links']; } ?></div>
								</td>
							</tr>
						</tfoot>
						
	        			<tbody>
	        				<?php foreach($sh as $s) { ?>
	        					<tr>
	        						<td><?php echo form_checkbox('action_to[]', $s->id); ?></td>
	        						<td><a href="admin/epg/shows/edit/<?php echo $s->id; ?>"><?php echo $s->title; ?></a></td>
	        						<td class="align-center"><?php echo $s->date; ?></td>
	        						<td class="align-center"><?php echo $s->time; ?></td>
	        						<td class="align-center"><?php echo $s->duration; ?></td>
	        						<td class="align-center"><?php echo $s->is_featured == '1' ? 'Yes' : 'No'; ?></td>
	        						<td class="align-center"><a href="admin/epg/shows/edit/<?php echo $s->id; ?>">Edit</a></td>
	        					</tr>
	        				<?php } ?>	
	        			</tbody>
	        		<?php } ?>	
	        	</table>
	        </div>
			
			
			
			
			
			
			
			
			
			
			
			
			
			<?php /* if(!empty($sh)){ ?>
	        	<div id="show-list">
	        		<table>
	        			<thead>
	        				<th width="30"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th>Title</th>
							<th>Date</th>
							<th>Time</th>
							<th>Duration</th>
							<th>Feature</th>
							<th class="align-center" style="width:10%;">Action</th>
	        			</thead>
	        			
	        			<tfoot>
							<tr>
								<td colspan="7">
									<div class="inner"><?php if(isset($pagination)){ echo $pagination['links']; } ?></div>
								</td>
							</tr>
						</tfoot>
						
	        			<tbody>
	        				<?php foreach($sh as $s) { ?>
	        					<tr>
	        						<td><?php echo form_checkbox('action_to[]', $s->id); ?></td>
	        						<td><a href="admin/epg/shows/edit/<?php echo $s->id; ?>"><?php echo $s->title; ?></a></td>
	        						<td><?php echo $s->date; ?></td>
	        						<td><?php echo $s->time; ?></td>
	        						<td><?php echo $s->duration; ?></td>
	        						<td><?php echo $s->is_featured; ?></td>
	        						<td class="align-center"><a href="admin/epg/shows/edit/<?php echo $s->id; ?>">Edit</a></td>
	        					</tr>
	        				<?php } ?>	
	        			</tbody>
	        		</table>
	        	</div>
	        <?php } */ ?>        
		</div>
	</section>
</div>