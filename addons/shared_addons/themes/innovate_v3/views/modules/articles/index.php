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

{{ if alcopolis:device == 'computer' }}	
<body id="top" class="articles">
{{ else }}
<body id="top" class="articles mobile">
{{ endif }}

		{{ integration:analytics }}
		
		{{ if alcopolis:site_status }}
			<header class="wrapper">			
				{{ theme:partial name="header" }}
			</header>
					
			<div id="content" class="wrapper">
				<div id="art-content">
					<section id="art-section">
						<?php 
							echo $page->section;
						?>
					</section>
					
					<div id="art-body" class="clearfix">
						<?php if($arts != NULL){ ?>
							<?php foreach($arts as $art){ ?>
								<article id="<?php echo $art['content']->art_slug?>">
									<?php if( $art['cover'] != NULL){ ?>
										<div class="cover-container"><a href="./<?php echo $art['content']->art_slug; ?>"><img src="<?php echo $art['cover']['src']; ?>" title="<?php echo $art['content']->title; ?>" /></a></div>
									<?php } ?>
										
									<div class="art-property art-title"><h1><?php echo anchor('articles/' . $art['content']->art_slug, substr($art['content']->title,0,40).'..'); ?></h1></div>
		
									<div class="art-property art-teaser"><?php echo $art['content']->teaser; ?></div>
									
									<div class="art-property art-content"><?php //echo $art['content']->body; ?></div>
								</article>
							<?php } ?>
					</div>	
							<?php echo $pagination['links']; ?>
						<?php }else{ ?>
							<p>Tidak ada artikel untuk kategori ini.</p>
						<?php } ?>
					</div>
				</div>	
			</div>
			
			<footer>			
				{{ theme:partial name="footer" }}
			</footer>
		{{ else }}
			{{ theme:partial name="site_down" }}
		{{ endif }}
</body>
</html>