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
			<div id="product-tags" class="hide"><?php echo $product->data->product_tags; ?></div>					
			<div id="product-body"><?php echo $product->data->product_body; ?></div>	
			
<?php /*	<div id="packages" style="width:75%; margin:0 auto;">
				<?php $groups = array(); ?>
				<?php if($product->packages != NULL) { ?>
					<ul>
					<?php foreach($product->packages as $package){ ?>
						<li><div>
							<h4><?php echo $package->package_group . ' ' . $package->package_name; ?></h4>
							<p><?php echo $package->package_price; ?></p>
						</div></li>
					<?php } ?>
					</ul>			
					
					
					<?php 
						foreach($product->packages as $key=>$package){
							if(!in_array($package->package_group, $groups)){
									$groups[$key] = $package->package_group;
							}
						}
						
						foreach($groups as $group){
							echo '<h1>' . $group . '</h1>'; ?>
							{{ products:package group="<?php echo $group; ?>" }}
					<?php } 
						
						//var_dump($groups);
					?>
					
				<?php } ?>
			</div>
*/ ?>
			<?php 
				
				//Cari semua grup yg dimiliki produk
				$groups = array();
				
				foreach($product->packages as $package){
					$temp = explode(' ', $package->package_group);
					$name = strtolower(implode('-', $temp));
					if(!in_array($name, $groups)){
						$groups[$name] = $package->package_group;
					}
				}
			
			?>
			<div id="packages" style="width:80%; margin:0 auto;">
				<div class="tabs">
					<ul class="tab-menu">
						<?php foreach($groups as $key=>$value): ?>
							<li><a href="#<?php echo $key; ?>"><?php echo $value; ?></a></li>
						<?php endforeach; ?>
					</ul>
					
					<?php foreach($groups as $key=>$value): ?>
					<div class="tab-content" id="<?php echo $key ?>" style="clear:both;">
						<div class="info pack">
                    		<p>Paket <?php echo $value; ?> memberikan kemudahan untuk memilih kombinasi saluran favorit Anda. Daftar sekarang untuk menikmati layanan hiburan, berita dan olah raga dengan paket yang sangat fleksibel.</p>
                    	</div>
                    	
                    	<div class="info price">
                    		{{ products:price group="<?php echo $value; ?>" }}
                    	</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
			
			<div id="faq" style="clear:both;">
				<h1>FAQ Goes Here</h1>
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