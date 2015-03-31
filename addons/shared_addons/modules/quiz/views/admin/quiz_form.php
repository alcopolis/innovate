<?php //var_dump($quest); ?>

<div class="one_full">
	<section class="item">
		<div class="content">	          
		
	        <div class="tabs">
				<ul class="tab-menu">
					<li><a href="#quiz-info"><span>Info</span></a></li>
					<li><a href="#quiz-qa"><span>Quiz</span></a></li>
					<?php if($page->action == 'edit'){ ?>
						<li><a href="#quiz-user"><span>User</span></a></li>
					<?php } ?>	
					<li><a href="#quiz-css"><span>CSS</span></a></li>
				</ul>

				<div class="form_inputs" id="quiz-info">
					<fieldset>
						<ul>
							<li>
								<label for="name">Name</label><br>
								<div class="input">
									<?php echo form_input('name', set_value('name', htmlspecialchars_decode($quiz->name))) ?>
								</div>
							</li>
							<li>
								<label for="start_date">Start</label><br>
								<div class="input">
									<?php echo form_input('start_date', set_value('start_date', $quiz->start_date), 'class="datepicker" maxlength="20"'); ?>
								</div>
							
								<label for="end_date">End</label><br>
								<div class="input">
									<?php echo form_input('end_date', set_value('end_date', $quiz->end_date), 'class="datepicker" maxlength="20"'); ?>
								</div>
							</li>
							<li>
								<label for="theme">Poster</label><br>
								<div class="input">
									<?php echo form_upload('theme','','id="theme" style="margin:5px 0;"'); ?> &nbsp; <?php echo '<a onclick="process();" class="button" style="padding:5px 10px 4px 10px;">Upload</a>'; ?>	
								</div>
								
								<div id="img-poster" style="width:100%; margin-top:10px;">
									<?php if($quiz->theme != NULL){ ?>
										<img style="width:480px; height:auto; border:1px solid #CCC; padding:5px;" src="uploads/default/files/<?php echo $quiz->theme?>"/>
									<?php } ?>
								</div>
							</li>
							<li>
								<label for="description">Description</label><br>
								<div class="input">
									<?php echo form_textarea(array('id' => 'description', 'name' => 'description', 'value' => $quiz->description, 'rows' => 10)) ?>
								</div>
							</li>
							<li>
								<label for="toc">Terms Condition</label><br>
								<div class="input">
									<?php echo form_textarea(array('id' => 'toc', 'name' => 'toc', 'value' => $quiz->toc, 'rows' => 10)) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>

				<div class="form_inputs" id="quiz-qa">
					<script type="text/javascript">
						
					</script>
					
					<fieldset>
						<a href="#">Add Questions</a>
						<ol>
							<?php 
								$counter = 1; 
								foreach($quest as $q){ 
							?>
								<li>
									<?php 
										$qa = json_decode($q->question_admin);
										//echo $qa->question;
										$radio_name = 'q-'.$counter;
										
										echo form_input($radio_name . '-q', htmlspecialchars_decode($qa->question), 'class="editable" style="width:90%;"');
										
										
										echo '<ul  id="' . $radio_name . '" class="choices">';
										foreach($qa->choices as $k=>$val){	
											echo '<li>';
											$data = array(
														'name'=>$radio_name, 
														'id'=>$radio_name, 
														'value'=>$k, 
														'checked'=> $k==$q->answer_admin? TRUE:FALSE
													);
											echo form_radio($data);
											echo  $val;
											echo '</li>';	
										}
										echo '</ul>';
									?>	
									
									<span class="crud-tools"><a href="quiz/edit_q">Edit</a><a href="quiz/delete_q">Delete</a></span>
								</li>
							<?php 
									$counter++;
								} 
							?>
						</ol>
					</fieldset>
				</div>
				
				<?php if($page->action == 'edit'){ ?>
					<!-- User Tab -->
					<div class="form_inputs" id="quiz-user">
						<?php if(!empty($user)){ ?>

							<div id="channel-list">
								<table>
									<thead>
										<th class="align-center" style="width:20%;">Username</th>
										<th class="align-center" style="width:5%;">Email</th>
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
										<?php foreach($user as $us) { ?>
											<tr>
												<td class="align-center"><?php echo $us->username; ?></a></td>
												<td class="align-center"><?php echo $us->email; ?></td>
												<td class="align-center"><?php echo $us->point; ?></td>
											</tr>
										<?php } ?>	
									</tbody>
								</table>
							</div>
						<?php } ?>	
					</div>
				<?php } ?>	

				
				<!-- CSS tab -->
				<div class="form_inputs" id="quiz-css">
					<fieldset>
						<ul>						
							<li class="editor">
								<label for="body">Custom CSS</label><br>
								<div class="edit-content">
									<?php echo form_textarea(array('id' => 'css', 'name' => 'css', 'value' => set_value('css', $quiz->css), 'rows' => 30, 'class' => 'markdown')) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>
			</div>
			
			<div class="buttons align-right padding-top">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )) ?>
			</div>
			
			<?php echo form_close(); ?>
		</div>
	</section>
</div>