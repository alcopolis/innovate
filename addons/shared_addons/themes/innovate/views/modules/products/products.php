<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
		{{ products:js value="<?php echo $product->slug; ?>" }}
		{{ products:css value="<?php echo $product->slug; ?>" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
	
	<?php 
		$bg_image = Files::get_file($poster['id']);
	?>
	
	<style>
		#overview{background-image:url(<?php echo $bg_image['data']->path ; ?>);}
	</style>
</head>
<body id="top" class="product product-<?php echo $product->slug; ?>">

		{{ integration:analytics }}
		
		<header class="wrapper">				
			{{ theme:partial name="header" }}
		</header>
				
		<div id="content" class="wrapper clear">
			<div id="body-theme">
				<div id="overview">
					<div id="ov-content"><?php echo $product->overview; ?></div>	
				</div>
				<div id="prod-content">
					<div id="body-wrapper" class="clearfix">
						<?php echo $product->body; ?>	
					</div>
				</div>
			</div>
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>