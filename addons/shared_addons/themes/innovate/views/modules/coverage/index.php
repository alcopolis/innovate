<?php //var_dump($covs); ?>

<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
</head>

<body id="top" class="coverage">
	
		{{ integration:analytics }}
	
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>
				
		<div id="content" class="wrapper">
			<div id="body-wrapper" class="clearfix">
								
				<div id="cov-filter">
					<h1 id="page-title">Wilayah Layanan Innovate</h1>
					<div class="cov-filter">
						<label for="city">Pilih Kota / Area Anda</label>
						<div><?php echo form_dropdown('city', $cities, set_value('city')); ?></div>
					</div>
				</div>
				
				<div id="cov-content">					
					<div id="cov-result">
						<p>Lorem</p>
					</div>
			 		
					<div class="pagination">
						<ul></ul>
					</div>
				</div>
		 	</div>
		</div>
		
		<footer>
	    	{{ theme:partial name="footer" }}
	    </footer> 
</body>
</html>