<div class="one_full">

<!--	<section class="title">

		<h4><?php echo lang('epg:channels'); ?></h4>

	</section> -->


	<section class="item">

		<div class="content">	          
			
	        <?php if(!empty($user_activity)){ ?>

	        	<div id="channel-list">

	        		<table>

	        			<thead>

	        				<!--<th width="30"><?php echo form_checkbox(array('username' => 'action_to_all', 'class' => 'check-all'));?></th>-->

							<th style="width:20%;">Username</th>

							<th class="align-center" style="width:5%;">Answers</th>
                            
                            <th class="align-center" style="width:5%;">Point</th>

	        			</thead>

	        			

	        			<tfoot>

							<tr>

								<!-- <td colspan="8">

									<div class="inner"><?php echo $pagination['links']; ?></div>

								</td> -->

							</tr>

						</tfoot>

						

	        			<tbody>

	        				<?php foreach($user_activity as $ac) { ?>

	        					<tr>

	        						<!--<td><?php echo form_checkbox('action_to[]', $ac->id); ?></td>-->

	        						<td><a href="admin/quiz/useractivity/info<?php echo $ac->id;?>"><?php echo $ac->username; ?></a></td>

	        						<td class="align-center"><?php echo $ac->answers; ?></td>
                                    
                                    <td class="align-center"><?php echo $ac->point; ?></td>

	        					</tr>

	        				<?php } ?>	

	        			</tbody>

	        		</table>

	        	</div>

	        <?php } ?>	

		</div>

	</section>

</div>