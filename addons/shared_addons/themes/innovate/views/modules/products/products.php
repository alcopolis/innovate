<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
		{{ products:js value="<?php echo $product->data->product_slug; ?>" }}
		{{ products:css value="<?php echo $product->data->product_slug; ?>" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
	
</head>
<body id="top" class="product product-<?php echo $product->data->product_slug; ?>">

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
			<div id="product"><?php echo $product->data->product_body; ?></p>
			
			<div id="product-tags"><?php $product->data->product_tags; ?></div>
			
			<div id="packages" style="width:75%; margin:0 auto;">
				<?php if($product->packages != NULL) { ?>
					<ul>
					<?php foreach($product->packages as $package){ ?>
						<li><div>
							<h4><?php echo $package->package_group . ' ' . $package->package_name; ?></h4>
							<p><?php echo $package->package_price; ?></p>
						</div></li>
					<?php } ?>
					</ul>
				<?php } ?>
			</div>
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