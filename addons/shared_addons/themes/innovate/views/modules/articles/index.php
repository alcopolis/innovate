<!DOCTYPE html>
<html>
<head>
	<meta content="news, article, innovate, broadband, multimedia,interactive" name="keywords">
	<meta content="Innovate News" name="description">
	
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}	
</head>

<body id="top" class="articles">

		{{ integration:analytics }}
		
		<header class="wrapper">			
			{{ theme:partial name="header" }}
		</header>
				
		<div id="content" class="wrapper clearfix">
			<div id="body-theme">
				<?php if($arts != NULL){ ?>
					<div id="art-content">
						<div id="body-wrapper" class="clearfix">
							<section id="arts-section">
								<?php echo $page->section; ?>
							</section>
							
							<div id="arts-body" class="left">
								<?php foreach($arts as $art){ ?>
									<article id="<?php echo $art->art_slug?>" class="clearfix">
										<img class="left"/>
										<div class="art-property art-title"><h1><?php echo anchor('articles/' . $art->art_slug, $art->title); ?></h1></div>
										<div class="art-property art-meta">
											<small>
												In <?php echo '<a href="articles/category/' . $art->cat_slug . '">{{ articles:get_category slug="' . $art->cat_slug . '" }}</a>'?> | 
												<?php echo date('\<\a\ \h\r\e\f\=\"\a\r\t\i\c\l\e\s\/\a\r\c\h\i\v\e\d\/F\"\>F\<\/\a\>, jS Y', $art->created_on); ?>
											</small>
										</div>
										
										<div class="art-property art-teaser"><?php echo $art->teaser; ?></div>
										
										<div class="art-property art-content"><?php //echo $art->body; ?></div>
										
										<div class="art-property art-meta">
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
									</article>
								<?php } ?>
								
								<?php echo $pagination['links']; ?>
							</div>
							
							<div id="arts-side" class="right" style="">
								<div id="events" class="side">Category</div>
								<div id="archived" class="side">Archives</div>
								<div class="advertisement side" style="height:120px;">Advertisement</div>
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