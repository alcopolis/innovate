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
			
<?php /*	
			//Cari semua grup yg dimiliki produk
			$groups = array();
			
			foreach($product->packages as $package){
				$temp = explode(' ', $package->package_group);
				$name = strtolower(implode('-', $temp));
				if(!in_array($name, $groups)){
					$groups[$name] = $package->package_group;
				}
			}
			
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
			
*/ ?>
			
			<div id="packages" style="width:80%; margin:0 auto;">
				
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