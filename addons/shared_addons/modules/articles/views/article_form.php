
<div class="one_full">
	<section class="title clearfix">
		<h4 class="left"><?php echo $page->action == 'create' ? strtoupper($page->title) : strtoupper($page->title) . ' | ' . $art->title; ?></h4>
		<div id="modified" class="right hide" style="margin-right:30px; color:#999">
				<?php 
					if($page->action == 'edit'){
						echo '<strong>';
						echo date('d M Y | H:i', $art->modified_on);
						echo '</strong> <em>(Last Modified)</em>';
					}
				?>
		</div>
	</section>
	
	<section class="item">
		<div class="content">			
			<?php 
				if($page->action == 'create'){
					echo form_open('admin/articles/' . $page->action, 'id="article-form"');
				}else if($page->action == 'edit'){
					echo form_open('admin/articles/' . $page->action . '/' . $art->id, 'id="article-form"');
				} 
			?>
			
			<!-- Render Product list  -->
			
			<div id="page-data" style="margin-bottom:20px;">
				<div id="created-on">
					<?php if($page->action == 'edit'){ ?>
						Created on : <?php echo date('d M Y', $art->created_on); ?>
					<?php } ?>
				</div>
			</div>
			
			<div class="tabs">
				<ul class="tab-menu">
					<li><a href="#article-content-fields"><span>Content</span></a></li>
					<?php if($page->action == 'edit'){ ?>
 						<li><a href="#article-attachment"><span>Attachment</span></a></li>
					<?php } ?>					
					<li><a href="#article-css-fields"><span>CSS</span></a></li>
					<li><a href="#article-js-fields"><span>Script</span></a></li>
				</ul>
				
				<!-- Content tab -->
				<div class="form_inputs" id="article-content-fields">
					<?php $this->load->view('partials/content_form', $art); ?>	
				</div>
				
				<!-- Attachment tab -->
				<?php if($page->action == 'edit'){ ?>
					<div class="form_inputs" id="article-attachment">
						<?php $this->load->view('partials/attachment_form', $art); ?>	
					</div>
				<?php } ?>
					
				
				
				<!-- CSS tab -->
				<div class="form_inputs" id="article-css-fields">
					<fieldset>
						<ul>						
							<li class="editor">
								<label for="body">Custom CSS</label><br>
								<div class="edit-content">
									<?php echo form_textarea(array('id' => 'css', 'name' => 'css', 'value' => set_value('css', $art->css), 'rows' => 30, 'class' => 'markdown')); ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>
				
				
				<!-- JS tab -->
				<div class="form_inputs" id="article-js-fields">
					<fieldset>
						<ul>						
							<li class="editor">
								<label for="body">Custom Javascript</label><br>
								<div class="edit-content">
									<?php echo form_textarea(array('id' => 'js', 'name' => 'js', 'value' => set_value('js', $art->js), 'rows' => 30, 'class' => 'markdown')) ?>
								</div>
							</li>
						</ul>
					</fieldset>
				</div>
			</div>
											
			<div class="buttons align-right padding-top">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )) ?>
			</div>
			<?php echo form_close() ?>			
		</div>
	</section>
</div>

<div id="category-add" class="popup hide" style="position:fixed; top:0; left:0; background:rgba(0,0,0,.9);z-index:10000; width:100%; height:100%">
	<?php echo form_open('admin/articles/category/add', 'id="category-form"'); ?>
		<div class="">
			<h4>Add New Category</h4>
			<?php echo form_input('category'); ?>
		</div>
	
	<?php echo form_close(); ?>
</div>