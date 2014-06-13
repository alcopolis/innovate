<!DOCTYPE html>
<html>
<head>
	<meta content="<?php echo $product->tags; ?>" name="keywords">
	<meta content="Innovate Promo <?php echo $data->name; ?>" name="description">
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
</head>
<body id="top" class="promo">

		{{ integration:analytics }}
		
		<header class="wrapper">				
			{{ theme:partial name="header" }}
		</header>
				
		<div id="content" class="wrapper clear">
			<div id="body-theme">
				
				
				<div id="promo-content" class="clearfix">
					<div id="body-wrapper">
						
						<article>
							<div id="poster">
								<img src="<?php echo $poster->path; ?>" style="width:100%;"/>
							</div>
							<?php echo $data->body; ?>
						</article>
						
						<aside style="width:22%; float:left; border-left:1px solid #CCC; padding:0 1%; background:#EEE;">
							<h1>asdfasdfasdfasdfasdf</h1>
							<h1>asdfasdfasdfasdfasdf</h1>
							<h1>asdfasdfasdfasdfasdf</h1>
							<h1>asdfasdfasdfasdfasdf</h1>
							<h1>asdfasdfasdfasdfasdf</h1>
						</aside>
						
					</div>
				</div>				
			</div>
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>