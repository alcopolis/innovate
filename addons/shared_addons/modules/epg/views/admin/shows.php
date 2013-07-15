<div class="one_full">
	<section class="title">
		<h4><?php echo lang('epg:shows'); ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
			<?php 
				//echo $this->load->view('admin/partials/show_filters') ;
			?>	
			
			<fieldset id="filters">
				<legend><?php echo lang('global:filters') ?></legend>
				
				<style type="text/css">
					.filter{float:left; margin:10px;}
				</style>
				
				<?php echo form_open('admin/epg/shows/'); ?>					
					<div class="filter">
						<label for="cid">Channel</label>
						<div class="input clearfix">
							<?php echo form_dropdown('cid', $ch); ?>
						</div>
					</div>
					
					<div class="filter">
						<label for="date">Date</label>
						<div class="input"><?php echo form_input('date', '', 'maxlength="20"'); ?></div>
					</div>
					
					<div class="filter">
						<label for="name">Title</label>
						<div class="input"><?php echo form_input('title', '', 'maxlength="200" style="width:500px"'); ?></div>
					</div>
					
					<div class="filter">
						<label for="submit">&nbsp;</label>
						<?php echo form_submit('submit', 'View'); ?>
					</div>
					
				<?php echo form_close(); ?>
			</fieldset>

			<?php if(!empty($ch_info)){ ?>
				<div id="channel-info">
					<h2><?php echo $ch_info->name; ?></h2>
					<p><?php echo $ch_info->desc; ?></p>
				</div>
			<?php } ?>
			
			<?php if(!empty($sh)){ ?>
	        	<div id="channel-list">
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
	        <?php } ?>        
		</div>
	</section>
</div>