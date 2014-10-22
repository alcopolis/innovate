<div class="one_full">

	<section class="item">

		<div class="content">	          
		
	        <div class="tabs">
				<ul class="tab-menu">
					<li><a href="#quiz-content"><span>Content</span></a></li>
					<?php if($page->action == 'edit'){ ?>
						<li><a href="#quiz-user"><span>User</span></a></li>
					<?php } ?>	
					<li><a href="#quiz-css"><span>CSS</span></a></li>
					<li><a href="#quiz-js"><span>Script</span></a></li>
				</ul>

				<div class="form_inputs" id="quiz-content">
					<?php //echo form_hidden('form_data', array('id'=>$prod->id, 'slug'=>$prod->slug , 'poster_id'=>$poster['id'])); ?>

				</div>


				<?php if($page->action == 'edit'){ ?>
					<!-- User Tab -->
					<div class="form_inputs" id="quiz-user">
						
					</div>
				<?php } ?>	

				
				<!-- CSS tab -->
				<div class="form_inputs" id="quiz-css">
					<fieldset>
						<ul>						
							<li class="editor">
								<label for="body">Custom CSS</label><br>
								<div class="edit-content">
									<?php //echo form_textarea(array('id' => 'css', 'name' => 'css', 'value' => set_value('css', $prod->css), 'rows' => 30, 'class' => 'markdown')) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>

			
				<!-- JS tab -->
				<div class="form_inputs" id="quiz-js">
					<fieldset>
						<ul>						
							<li class="editor">
								<label for="body">Custom Javascript</label><br>
								<div class="edit-content">
									<?php //echo form_textarea(array('id' => 'js', 'name' => 'js', 'value' => set_value('js', $prod->js), 'rows' => 30, 'class' => 'markdown')) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>
			</div>
		</div>
	</section>

</div>