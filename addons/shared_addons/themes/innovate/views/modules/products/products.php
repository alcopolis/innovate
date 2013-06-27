<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
		{{ products:js value="<?php echo $product->attribute->product_slug; ?>" }}
		{{ products:css value="<?php echo $product->attribute->product_slug; ?>" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
	
</head>
<body id="top" class="product product-<?php echo $product->attribute->product_slug; ?>">

	<!-- Begin pageWrapper -->
	<div id="pageWrapper">
		{{ integration:analytics }}
		
		<!-- Begin Header Content -->
		<div class="partial-wrapper">				
			{{ theme:partial name="header" }}
		</div>
		<!-- End Header Content -->

		<!-- Begin contentWrapper -->
		<div class="content-wrapper">		
			<h1><?php echo $product->attribute->product_name; ?></h1>
			
			<div id="product"><?php echo $product->attribute->product_body; ?></p>
			
			<div id="product-tags"><?php $product->attribute->product_tags; ?></div>
			
			
			{{ products:chunk  field="field_value" table="fields" where="`field_name` = 'Saluran Premium'" }}
				{{ field }}
			{{ /products:chunk }}
			
			
		</div>
		<!-- End contentWrapper -->
		
		<!-- Begin Footer Content -->
		<div class="partial-wrapper">			
			{{ theme:partial name="footer" }}
		</div>
		<!-- End Footer Content -->
	</div>
	<!-- End pageWrapper -->

</body>
</html>