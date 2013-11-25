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
	
	<style>
		<?php 
			$bg_image = Files::get_file($poster['id']);
		?>
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
				
				<?php if($product->body != NULL){ ?>
					<div id="prod-content">
						<div id="body-wrapper">
							<div id="prod-info" class="clearfix">
								<?php echo $product->body; ?>
							</div>
							
							<?php if($packages != NULL){ ?>
								<div id="package">
									<ul id="pack-nav" class="clearfix">
										<?php foreach($packages as $pack){ ?>
											<li><a href="#<?php echo $pack['data']->slug; ?>"><?php echo $pack['data']->name; ?></a></li>
										<?php } ?>
										
										<li class="bundle-nav"><a href="#bundle">Bundle</a></li>
									</ul>
									
									<?php foreach($packages as $pack){ ?>
										<div id="<?php echo $pack['data']->slug; ?>" class="pack-container clearfix">
											<div class="data left">
												<?php echo $pack['data']->body; ?>
											</div>
											<div class="packs right clearfix">
												<?php foreach($pack['pack'] as $p){ ?>
													<div class="pack-item left">
														<h5 class="pack-name"><?php echo $p->name; ?></h5>
														<section style="margin:10px; text-align: center; "><?php echo $p->body; ?></section>
														<h6 class="pack-price"><?php echo 'Rp ' . number_format($p->price); ?></h6>
													</div>
												<?php } ?>
											</div>
										</div>
									<?php } ?>
									
									<div id="bundle" class="pack-container">
										<p style="margin:0 40px; color:#717174;">Pilih layanan yang anda inginkan untuk melihat harga paket bundle</p>
										<div id="widget-container" class="clearfix">
											{{ products:widget }}
										</div>
									</div>
								</div>
							<?php } ?>	
							
							<div id="toc" class="clearfix">
								<div id="cs-support" class="left">
									<img alt="Customer care" src="{{theme:image_path}}cs.png" style="width:64px;"/>
									<p style="margin:10px 0; padding:0;">Untuk Informasi Lebih Lanjut<br/>
									Hubungi Customer Care Kami</p>
									<h3 style="padding:0;">[021] 3199 8600</h3>
								</div>
								
								<?php if($product->terms != NULL){ ?>
									<div id="terms" class="left">
										<h6>Syarat &amp; Ketentuan</h6>
										<?php echo $product->terms; ?>	
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
		
		<div id="popup" class="hide" style="position:fixed; width:100%; height:100%; background:rgba(0,0,0,.90); top:80px;" >
			<div id="popup-wrapper" style="position:relative; top:80px; width:960px; margin:0 auto;">
				<a class="close-btn" style="cursor:pointer; color:red;">Close</a>
				<div id="popup-container" style="background:#FFF; padding:10px; box-shadow:0 0 30px #000;">
					
				</div>
			</div>
		</div>
</body>
</html>