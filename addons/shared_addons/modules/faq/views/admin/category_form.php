<section class="title">
	<h4><?php echo $page->title; ?></h4>
</section>

<section class="item">
	<div class="content">
		<?php 
			if($page->action == 'create'){
				echo form_open_multipart('admin/faq/groups/create/');
			}else{
				echo form_open_multipart('admin/faq/groups/edit/' . $cat->slug);
			}		
		?>
			
		<div class="form_inputs">
			<fieldset>
				<ul>
					<li>
						<label for="title">Title <span>*</span></label>
						<div class="input">
							<?php 
								echo form_input('category', set_value('category', $cat->category)) 
							?>
						</div>
					</li>
					
					<li>
						<label for="title">Group Parent <span>*</span></label>
						<div class="input">							
							<select name="parent_id">
								<option value="0">No Parent</option>
								<?php 
								
									$level = 0;
									$spacer = '- ';
									
									foreach ($cat_tree as $id=>$branch){
										
										$level = 0;
										
										if($branch->parent_id == 0){
											echo '<option value="' . $id . '">' . $branch->category . '</option>';
										}else{	
											$has_parent = true;
											$pid = NULL;
											
											while($has_parent == true){
												if($pid == NULL){
													$parent_id = $this->db->select('parent_id')->where('id', $branch->parent_id)->get('default_inn_faq_category')->row();
												}else{
													$parent_id = $this->db->select('parent_id')->where('id', $pid)->get('default_inn_faq_category')->row();
												}
																							
	 											if($parent_id->parent_id != 0){
	 												$level++;
	 												$pid = $parent_id->parent_id;
	 											}else{
	 												$has_parent = false;
	 											}
											}
											
											if($id == $parent_cat){
												echo '<option selected="selected" value="' . $id . '">&nbsp;&nbsp;' . str_repeat($spacer, $level) . $branch->category . '</option>';
											}else{
												echo '<option value="' . $id . '">&nbsp;&nbsp;' . str_repeat($spacer, $level) . $branch->category . '</option>';
											}
										}
									}
								?>
							</select>
						</div>
					</li>
				</ul>
			</fieldset>
		</div>	
		
		<div class="buttons align-right padding-top">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )) ?>
		</div>
		
		<?php echo form_close(); ?>
	</div>
</section>