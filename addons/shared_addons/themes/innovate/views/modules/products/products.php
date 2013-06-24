<!DOCTYPE html>
<html>
<head>
	{{ theme:partial name="metadata" }}	
	{{ products:js value="<?php echo $product->attribute['product_slug']; ?>" }}
	{{ products:css value="<?php echo $product->attribute['product_slug']; ?>" }}
</head>
<body id="top" class="page-product <?php echo $product->attribute['product_slug']; ?>">

	<!-- Begin pageWrapper -->
	<div id="pageWrapper">
		{{ integration:analytics }}
		
		<!-- Begin Header Content -->
		<div class="partialWrapper">				
				{{ theme:partial name="header" }}
			</div>
		<!-- End Header Content -->

		<!-- Begin contentWrapper -->
		<div class="contentWrapper">
			<?php
				
			?>
		
			<h1><?php echo $product->attribute['product_name']; ?></h1>
			<p><?php echo $product->attribute['product_name'] ?></p>
			<p><?php echo $product->attribute['product_body'] . ' <br/> ' . $product->attribute['product_tags']; ?></p>
			
			<?php if($product->packages != NULL) { ?>
				<div id="package-list">		
					<table>
						<thead>
							<th>Package</th>
							<th>Price</th>
							<th>Description</th>
						</thead>
						
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
		<div class="partialWrapper">				
			{{ theme:partial name="footer" }}
		</div>
		<!-- End Footer Content -->
	</div>
	<!-- End pageWrapper -->

</body>
</html>