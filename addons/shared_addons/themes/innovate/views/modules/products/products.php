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
				<div id="prod-content">
					<div id="body-wrapper">
						<div id="prod-info" class="clearfix">
							<?php echo $product->body; ?>
						</div>
						<div id="package">
							<ul id="pack-nav" class="clearfix">
								<?php foreach($packages as $pack){ ?>
									<li><a href="#<?php echo $pack['data']->slug; ?>"><?php echo $pack['data']->name; ?></a></li>
								<?php } ?>
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
												<section style="margin:10px; text-align: center;"><?php echo $p->body; ?></section>
												<h6 class="pack-price"><?php echo 'Rp ' . number_format($p->price); ?></h6>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
						</div>	
					</div>
				</div>
			</div>
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>