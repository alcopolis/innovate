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
						
						<div id="arts-body">
							<?php if($arts != NULL){ ?>
								<?php foreach($arts as $art){ ?>
									<article id="<?php echo $art['content']->art_slug?>" class="left">
										<?php if( $art['cover'] != NULL){ ?>
											<a href="articles/<?php echo $art['content']->art_slug; ?>"><img src="<?php echo $art['cover']['src']; ?>" title="<?php echo $art['content']->title; ?>" /></a>
										<?php } ?>
											
										<div class="art-property art-title"><h1><?php echo anchor('articles/' . $art['content']->art_slug, substr($art['content']->title,0,40).'..'); ?></h1></div>
		
										<div class="art-property art-teaser"><?php echo $art['content']->teaser; ?></div>
										
										<div class="art-property art-content"><?php //echo $art['content']->body; ?></div>
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