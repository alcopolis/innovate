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
	
	<style type="text/css">
		<?php echo $data->css; ?>
	</style>
</head>
<body id="top" class="promo">
		{{ integration:analytics }}
		
		{{ if alcopolis:site_status }}
			<header class="wrapper">				
				{{ theme:partial name="header" }}
			</header>
					
			<div id="content" class="wrapper clear">
				<div id="body-theme">
					
					
					<div id="promo-content" class="clearfix">
						<div id="body-wrapper">
							<div id="poster">
								<img src="<?php echo $poster->path; ?>" style="width:100%;"/>
							</div>
							
							<article>
								<?php echo $data->body; ?>
							</article>
						</div>
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