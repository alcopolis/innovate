<section class="title">
	<h4><?php echo $page->title; ?></h4>
</section>

<section class="item">
	<div class="content">
		<?php 
			if($page->action == 'create'){
				echo form_open_multipart('admin/faq/groups/create/');
			}else{
				echo form_open_multipart('admin/faq/groups/edit/' . $cat->category);
			}			
		?>
			
		<div class="form_inputs">
			<fieldset>
				<ul>
					<li>
						<label for="title">Title <span>*</span></label>
						<div class="input"><?php echo form_input('category', set_value('category', $cat->category)) ?></div>
					</li>
					
					<li>
						<label for="title">Group Parent <span>*</span></label>
						<div class="input">
							<?php // echo form_dropdown('cat_tree', $cat_tree); ?>
							
							<select name="cat_tree">
							<?php 
								
								$level = 0;
								$spacer = '--';
								
								foreach ($cat_tree as $id=>$branch){
									if($branch['parent'] == NULL){
										echo '<option value="' . $id . '">' . $branch['cat'] . '</option>';
									}else{
										echo '<option value="' . $id . '">' . str_repeat($spacer, $branch['level']) . '&nbsp;' . $branch['cat'] . '</option>';
									}
								}
							?>
							</select>
							
<!-- 							<select name="cat_tree"> -->
<!-- 								<option value="top-level">Top Level</option> -->
<!-- 								<option value="other">Other</option> -->
<!-- 								<optgroup label="payment"> -->
<!-- 									<option value="cara-bayar">Cara Bayar</option> -->
<!-- 									<option value="mandiri-power-bills">Mandiri Power Bills</option> -->
<!-- 									<option value="transfer-atm">Transfer ATM</option> -->
<!-- 									<optgroup label="Billing"> -->
<!-- 										<option value="apcc">APCC</option> -->
<!-- 									</optgroup> -->
<!-- 								</optgroup> -->
<!-- 							</select> -->
						</div>
					</li>
				</ul>
			</fieldset>
		</div>	
		
		<div class="buttons align-right padding-top">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save_exit', 'cancel') )) ?>
		</div>
		
		<?php echo form_close(); ?>
	</div>
</section>