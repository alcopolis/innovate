<!DOCTYPE html>
<html>
<head>
	{{ theme:partial name="metadata" }}	
	{{ products:js value="<?php echo $product->attribute['product_slug']; ?>" }}
	{{ products:css value="<?php echo $product->attribute['product_slug']; ?>" }}
</head>
<body id="top" class="product product-<?php echo $product->attribute['product_slug']; ?>">

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
			<h1><?php echo $product->attribute['product_name']; ?></h1>
			
			<div id="product"><?php echo $product->attribute['product_body'] ?></p>
			
			<div id="product-tags"><?php $product->attribute['product_tags']; ?></div>
			
			<?php if($product->packages != NULL) { ?>
				<div id="package">		
					<table class="package-list">
						<thead class="list-header">
							<th>Package</th>
							<th>Price</th>
							<th>Description</th>
						</thead>
						
						<tfoot class="list-footer">
							<td colspan="3">Info tambahan</td>
						</tfoot>
						
						<tbody>
							<?php foreach($product->packages as $row) { ?>
								<tr>
									<?php
										echo '<td><a href="admin/products/packages/#' . $row['package_slug'] . '">' . $row['package_name'] . '</a></td>';
										echo '<td>' . $row['package_price'] . '</td>';
										echo '<td>' . $row['package_body'] . '</td>';
									?>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			<?php } ?>
		</div>
		<!-- End contentWrapper -->
		
		<!-- Begin Footer Content -->
		<div class="partial-wrapper">			
			{{ products:render slug="<?php echo $product->attribute['product_slug']; ?>" }}	
			{{ theme:partial name="footer" }}
		</div>
		<!-- End Footer Content -->
	</div>
	<!-- End pageWrapper -->

</body>
</html>