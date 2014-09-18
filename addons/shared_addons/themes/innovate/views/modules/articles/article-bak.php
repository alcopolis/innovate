<!DOCTYPE html>
<html>
<head>
	<meta content="<?php echo $art->keywords; ?>" name="keywords">
	<meta content="<?php echo $art->teaser; ?>" name="description">
	
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}	
	
	<style>
		.article{margin:0 0 20px 0; background:#EEE;}
		.art{margin:0 10px 10px 10px;}
		
		<?php echo $art->css; ?>
	</style>
</head>

<body id="top" class="article">

		{{ integration:analytics }}
		
		<header class="wrapper">			
			{{ theme:partial name="header" }}
		</header>
				
		<div id="content" class="wrapper">
			<div id="body-theme">
				<?php if($art != NULL){ ?>
					<div id="art-content">
						<div id="body-wrapper" class="clearfix">
							<section id="arts-section">
								<?php echo $page->section; ?>
							</section>
							
							<div id="arts-body">
								<article id="<?php echo $art->art_slug?>" class="full">
									<div class="art-property art-title"><h1><?php echo $art->title; ?></h1></div>
									<div class="art-property art-meta">
										<small>
											In <?php echo '<a href="articles/category/' . $art->cat_slug . '">{{ articles:get_category slug="' . $art->cat_slug . '" }}</a>'?> | 
											<?php echo date('\<\a\ \h\r\e\f\=\"\a\r\t\i\c\l\e\s\/\a\r\c\h\i\v\e\d\/F\"\>F\<\/\a\>, jS Y', $art->created_on); ?>
										</small>
									</div>									
									
									<div class="art-property art-content clearfix"><?php echo $art->body; ?></div>
									
									<div id="tags" class="art-property art-meta">
										<p>
											<small>
											<?php
												if($art->keywords != '' || $art->keywords != NULL){
													$keys = explode(", ", $art->keywords);
													foreach($keys as $k){
														echo '<a href="articles/tags/' . $k . '">' . $k . '</a> , ';	
													} 
												}
											?>
											</small>
										</p>
									</div>
								</div>
								
								<div id="arts-pagination"><?php //echo $pagination['links']; ?></div>
							</article>
							
							<div id="arts-side" class="right">
<!-- 							<div id="related" class="side">
									<h6>Related</h6>
									{{ articles:get_related category="<?php echo $art->cat_slug; ?>" }}
								</div> -->
<!-- 								<div id="archived" class="side">Archives</div> -->
<!-- 								<div class="advertisement side" style="height:120px;">Advertisement</div> -->
<!--  								<div id="events" class="side">Events</div>  -->
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>