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
	
	<?php 
		$bg_image = Files::get_file($poster['id']);
	?>
	
	<style>
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
						<div id="package" style="color:black; text-shadow:none;">
							<ul>
								<?php foreach($packages as $pack){ ?>
									<li><?php echo $pack['data']->name; ?></li>
								<?php } ?>
							</ul>
							
							<?php foreach($packages as $pack){ ?>
								<div id="<?php echo $pack['data']->slug; ?>" class="clearfix">
									<div class="data left" style="margin:20px; width:25%; font-size:.85em; color:#999"><?php echo $pack['data']->body; ?></div>
									<div class="packs right" style="margin:20px; width:65%;">
										<?php foreach($pack['pack'] as $p){ ?>
											<p><?php echo $p->name; ?></p>
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