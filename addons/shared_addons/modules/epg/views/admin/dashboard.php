<div class="one_full">
	<section class="title">
		<h4><?php echo lang('epg:dashboard'); ?></h4>
	</section>

<section class="item">
	<div class="content">
		<div class="tabs">
			<ul class="tab-menu">
				<li><a href="#featured-active"><span>Featured Active</span></a></li>
				<li><a href="#popular"><span>Most Popular</span></a></li>
			</ul>
			
			<div id="featured-active">
				<fieldset>
					<?php foreach($featured as $feat){ ?>
						<div class="active-featured" style="float:left; width:18%; height:18%; background:rgba(200,200,200,.5); margin:1%;">
							<h4><a href="admin/epg/shows/edit/<?php echo $feat->showid ?>"><?php echo $feat->title; ?></a></h4>
							<p><?php echo $feat->chname?></p>
						</div>
					<?php } ?>
					
					<div class="paginate" style="clear:both;">
						<?php echo $pagination['links'];?>
					</div>
				</fieldset>
			</div>
			
			<div id="popular">
				<fieldset>
					<div>Popular show by viewer rating</div>
				</fieldset>
			</div>
		</div>		
	</div>
</section>