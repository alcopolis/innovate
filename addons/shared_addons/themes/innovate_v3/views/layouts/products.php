<!DOCTYPE html>
<html>
<head>
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
	<body id="product" class="top" data-name="<?php echo $product->slug; ?>">
{{ else }}
	<body id="product" class="top mobile" data-name="<?php echo $product->slug; ?>">
{{ endif }}
	
	{{ integration:analytics }}
	
	{{ if alcopolis:site_status }}
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>
	 	
	 	 <div id="content" class="wrapper">
	 	 	<div id="body-theme" class="clearfix">
		 	 	{{ if alcopolis:device == 'computer' }}
					<div id="overview">
						<div id="ov-content"><?php echo $product->overview; ?></div>	
					</div>
				{{ endif }}
				
				<?php if($product->body != ''){ ?>
			 	 	<div id="body-wrapper">
						{{ template:body }}
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
	 	
	{{ else }}
		
		{{ theme:partial name="site_down" }}
		
	{{ endif }}
</body>
</html>