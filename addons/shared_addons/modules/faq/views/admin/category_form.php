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
				</ul>
			</fieldset>
		</div>	
		
		<div class="buttons align-right padding-top">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save_exit', 'cancel') )) ?>
		</div>
		
		<?php echo form_close(); ?>
	</div>
</section>