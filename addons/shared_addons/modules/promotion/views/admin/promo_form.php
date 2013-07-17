<div class="one_full">
	<section class="title">
		<h4><?php echo strtoupper($page->title) ?></h4>
	</section>
	
	<section class="item">
		<div class="content">
			<?php 
				if($page->action == 'create'){
					echo form_open('admin/promotion/' . $page->action);
				}else if($page->action == 'edit'){
					echo form_open('admin/promotion/' . $page->action . '/' . $promos->id);
				} 
			?>
			
			<?php if(!empty($promos)){ ?>
				<div class="tabs">
					<ul class="tab-menu">
						<li><a href="#promo-content-fields"><span>Content</span></a></li>
						<li><a href="#category"><span>Category</span></a></li>
						<li><a href="#promo-css-fields"><span>CSS</span></a></li>
						<li><a href="#promo-js-fields"><span>Script</span></a></li>
					</ul>
					
					<div class="form_inputs" id="promo-content-fields">
						<fieldset>
							<ul>
								<li>
									<?php echo $promos->name; ?>
								</li>
							</ul>
						</fieldset>
					</div>
					
					<div class="form_inputs" id="category">
						
					</div>
					
					<div class="form_inputs" id="promo-css-fields">
						
					</div>
					
					<div class="form_inputs" id="promo-js-fields">
						
					</div>
				</div>
			<?php } ?>	
		</div>
	</section>
</div>