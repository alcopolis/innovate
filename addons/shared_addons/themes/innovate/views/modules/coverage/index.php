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
					<label for="city">Kota</label>
					<div><?php echo form_dropdown('city', $cities, set_value('city')); ?></div>
				</div>
				
				<div id="cov-content">
					<h1 id="page-title">Coverage Area Innovate</h1>
					<div id="cov-result">
						<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here</p>
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