<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="<?php echo $product->tags; ?>" name="keywords">
	<meta content="Innovate Product <?php echo $product->name; ?>" name="description">
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
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

{{ if alcopolis:device == 'computer' }}
<body id="top" class="product product-<?php echo $product->slug; ?>">
{{ else }}
<body id="top" class="mobile product product-<?php echo $product->slug; ?>">
{{ endif }}
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
					<div id="prod-content" class="clearfix">
						<div id="body-wrapper">
							<?php if($product->body != NULL){ ?>
								<?php if($packages != NULL){ ?>
										<div id="prod-info" class="clearfix">
								<?php }else{ ?>
										<div style="color:#0B5EBA; text-shadow:none; padding:40px 0;" class="package clearfix">
								<?php } ?>
											<?php echo $product->body; ?>
										</div>
							<?php } ?>
							
							
							<?php if($packages != NULL){ ?>
									<div class="package">
										<ul id="pack-nav" class="clearfix">
											<?php foreach($packages as $pack){ ?>
												<li><a href="#<?php echo $pack['data']->slug; ?>"><?php echo $pack['data']->name; ?></a></li>
											<?php } ?>
											
											<?php if($bundle->status == '1'){ ?>
												<li class="bundle-nav"><a href="#bundle">Bundle</a></li>
											<?php } ?>	
										</ul>
										
										<?php foreach($packages as $pack){ ?>
											<div id="<?php echo $pack['data']->slug; ?>" class="pack-container clearfix">
												{{ if alcopolis:device == 'computer' }}
													<div class="data left">
												{{ else }}
													<div class="data">
												{{ endif }}
														<?php echo $pack['data']->body; ?>
													</div>
												
												{{ if alcopolis:device == 'computer' }}
													<div class="packs right clearfix">
												{{ else }}
													<div class="packs clearfix">
												{{ endif }}
														<?php foreach($pack['pack'] as $p){ ?>
															<div id="<?php echo $p->slug; ?>" class="pack-item left">
																<h5 class="pack-name"><?php echo $p->name; ?></h5>
																<section style="margin:10px; text-align: center; "><?php echo $p->body; ?></section>
																<h6 class="pack-price"><?php echo 'Rp ' . $p->price; ?></h6>
															</div>
														<?php } ?>
													</div>
											</div>
										<?php } ?>
										
										<?php if($bundle->status == '1'){ ?>
											<div id="bundle" class="pack-container clearfix">
												<?php if($bundle->type == 'default'){ ?>
														<p style="margin:0 40px; color:#717174;">Pilih layanan yang anda inginkan untuk melihat harga paket bundle</p>
														<div id="container" class="bundle-default clearfix">
															{{ products:widget }}
														</div>
												<?php }else{ ?>
													<!-- Custom bundle package -->
													<div id="container" class="bundle-custom">
														<?php echo $bundle->body; ?>
													</div>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
									
									<div id="toc" class="clearfix">
										<?php if($product->terms != NULL){ ?>
											<div id="terms" class="left">
												<h6>Syarat &amp; Ketentuan</h6>
												<?php echo $product->terms; ?>	
											</div>
										<?php } ?>
										
										<div id="cs-support" class="right">
											<img alt="Customer care" src="{{theme:image_path}}cs.png" style="width:64px;"/>
											<p style="margin:10px 0; padding:0;">Untuk Informasi Lebih Lanjut<br/>
											Hubungi Customer Care Kami</p>
											<h3 style="padding:0;">[021] 5055 6182</h3>
										</div>
									</div>
							<?php }else{ ?>
								<div id="toc" class="clearfix">
									<?php if($product->terms != NULL){ ?>
										<div id="terms" class="left">
											<h6>Syarat &amp; Ketentuan</h6>
											<?php echo $product->terms; ?>	
										</div>
									<?php } ?>
									
									{{ if alcopolis:device == 'computer' }}
										<div id="cs-support" class="right">
									{{ else }}
										<div id="cs-support">
									{{ endif }}
										<img alt="Customer care" src="{{theme:image_path}}cs.png" style="width:64px;"/>
										<p style="margin:10px 0; padding:0;">Untuk Informasi Lebih Lanjut<br/>
										Hubungi Customer Care Kami</p>
										<h3 style="padding:0;">[021] 5055 6182</h3>
									</div>
								</div>
							<?php } ?>	
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
		
		<div id="popup" class="hide">
			<div id="popup-wrapper">
				<div id="popup-container">
					<a class="close-btn" title="Close"></a>
				</div>
			</div>
		</div>
</body>
</html>