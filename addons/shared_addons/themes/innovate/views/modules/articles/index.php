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
				<div id="art-content">
					<div id="body-wrapper" class="clearfix">
						<section id="arts-section">
							<?php 
								echo $page->section;
							?>
						</section>
						
						<div id="arts-body" class="left">
							<?php if($arts != NULL){ ?>
								<?php foreach($arts as $art){ ?>
									<article id="<?php echo $art['content']->art_slug?>" class="clearfix">
										<?php if( $art['cover'] != NULL){ ?>
											<img class="left" src="<?php echo $art['cover']['src']; ?>" title="" />
										<?php }else{ ?>
											<img class="left" src="" title="No Cover"/>
										<?php } ?>
										<div class="art-property art-title"><h1><?php echo anchor('articles/' . $art['content']->art_slug, $art['content']->title); ?></h1></div>
										<div class="art-property art-meta">
											<small>
												In <?php echo '<a href="articles/category/' . $art['content']->cat_slug . '">{{ articles:get_category slug="' . $art['content']->cat_slug . '" }}</a>'?> | 
												<?php echo date('\<\a\ \h\r\e\f\=\"\a\r\t\i\c\l\e\s\/\a\r\c\h\i\v\e\d\/F\"\>F\<\/\a\>, jS Y', $art['content']->created_on); ?>
											</small>
										</div>
										
										<div class="art-property art-teaser"><?php echo $art['content']->teaser; ?></div>
										
										<div class="art-property art-content"><?php //echo $art['content']->body; ?></div>
										
										<?php /*
										<div class="art-property art-meta">
											<p>
												<small>
												<?php
													if($art['content']->keywords != '' || $art['content']->keywords != NULL){
														$keys = explode(", ", $art['content']->keywords);
														foreach($keys as $k){
															echo '<a href="articles/tags/' . $k . '">' . $k . '</a> , ';	
														} 
													}
												?>
												</small>
											</p>
										</div>
										*/ ?>
									</article>
								<?php } ?>
							
								<?php echo $pagination['links']; ?>
							<?php }else{ ?>
								<p>Tidak ada artikel untuk kategori ini.</p>
							<?php } ?>
						</div>
						
						<div id="arts-side" class="right" style="">
<!-- 							<div id="events" class="side">Category</div> -->
<!-- 							<div id="archived" class="side">Archives</div> -->
<!--							<div class="advertisement side" style="height:120px;">Advertisement</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>