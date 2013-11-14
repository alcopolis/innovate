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
	
</head>
<body id="top" class="product product-<?php echo $product->slug; ?>">

		{{ integration:analytics }}
		
		<header class="wrapper">				
			{{ theme:partial name="header" }}
		</header>
				
		<div id="content" class="wrapper clear">
			<div id="body-theme">
				<div id="body-wrapper" class="clearfix">
					<div id="product-tags" class="hide"><?php echo $product->tags; ?></div>					
					<div id="product-body"><?php echo $product->body; ?></div>	
					
					<div id="faq" style="clear:both;">
						<!-- <h1>FAQ Goes Here</h1> -->
						{{faq:get group="product" subject="<?php echo $product->tags; ?>" display="full"}}
					</div>
				</div>
			</div>
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>