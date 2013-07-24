<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
		{{ products:js value="<?php echo $product->product_slug; ?>" }}
		{{ products:css value="<?php echo $product->product_slug; ?>" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
	
</head>
<body id="top" class="product product-<?php echo $product->product_slug; ?>">

		{{ integration:analytics }}
		
		<header class="wrapper">				
			{{ theme:partial name="header" }}
		</div>
				
		<div id="content" class="wrapper clear">
			<div id="body-wrapper">
				<div id="product-tags" class="hide"><?php echo $product->product_tags; ?></div>					
				<div id="product-body"><?php echo $product->product_body; ?></div>	
				
				<div id="faq" style="clear:both;">
					<!-- <h1>FAQ Goes Here</h1> -->
				</div>
			</div>
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</div>
</body>
</html>