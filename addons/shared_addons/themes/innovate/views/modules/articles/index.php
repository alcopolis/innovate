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
	
	<style>
		.article{margin:0 0 20px 0; background:#EEE;}
		.art{margin:0 10px 10px 10px;}
		
	</style>
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
							<div id="arts-list" class="left" style="width:70%;">
								<?php foreach($arts as $art){ ?>
									<div class="article <?php echo $art->slug?>">
										<div class="art art-title"><h1><?php echo anchor('articles/index/' . $art->slug, $art->title); ?></h1></div>
										<div class="art art-meta">
											<small>
												In <?php echo '<a href="articles/category/' . $art->category . '">' . ucfirst($art->category) . '</a>'?> Category | 
												On <?php echo date('\<\a\ \h\r\e\f\=\"\a\r\t\i\c\l\e\s\/\a\r\c\h\i\v\e\d\/F\"\>F\<\/\a\>, jS Y', $art->created_on); ?>
											</small>
										</div>
										
										<div class="art art-teaser"><?php echo $art->teaser; ?></div>
										
										<div class="art art-content"><?php //echo $art->body; ?></div>
										
										<div class="art art-meta">
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
								<?php } ?>
								
								<div id="arts-pagination"><?php echo $pagination['links']; ?></div>
							</div>
							
							<div id="arts-side" class="right" style="width:25%; height:360px; background:#666;">
							
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