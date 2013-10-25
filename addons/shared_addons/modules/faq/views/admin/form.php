<section class="title">
	<h4><?php echo $page->title; ?></h4>
</section>

<section class="item">
	<div class="content">
		<?php 
			if($page->action == 'create'){
				echo form_open_multipart('admin/faq/create/' . $cat[$faqs->category]);
			}else{
				echo form_open_multipart('admin/faq/edit/' . $faqs->id);
			}
		?>
			
		<div class="tabs">
			<ul class="tab-menu">
				<li><a href="#faq-content-fields"><span>Content</span></a></li>
			</ul>
			
			<div class="form_inputs" id="faq-content-fields">
				<fieldset>
					<ul>
						<li>
							<label for="title">Title <span>*</span></label>
							<div class="input"><?php echo form_input('title', set_value('title', $faqs->title)) ?></div>
						
							<label for="cat">Category <span>*</span></label>
							<div class="input">
								<?php echo form_dropdown('category', $cat, $faqs->category) ?>
							</div>
						
							<li class="editor">
								
								<label for="question">Question <span>*</span></label>
								<div class="input"><?php echo form_input('question', set_value('question', $faqs->question)) ?></div>
								
								<br/>
							
								<label for="body">Answer <span>*</span></label><br>
								<div class="input small-side">
									<?php echo form_dropdown('editor_type', array(
										'html' => 'html',
										'markdown' => 'markdown',
										'wysiwyg-simple' => 'wysiwyg-simple',
										'wysiwyg-advanced' => 'wysiwyg-advanced',
									), $page->editor_type) ?>
								</div>
								
								<br/>
								
								<div class="answer">
									<?php echo form_textarea(array('id' => 'answer', 'value' => set_value('answer', $faqs->answer), 'name' => 'answer', 'rows' => 30, 'class' => $page->editor_type)) ?>
								</div>
							</li>
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