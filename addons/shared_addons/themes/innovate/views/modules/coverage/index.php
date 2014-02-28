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

				<h3 id="page-title">Coverage Area Innovate</h3>
				
				<div id="cov-filter" style="outline:1px solid #CCC; padding:10px; margin:10px; float:left; width:20%;">
					<?php echo form_dropdown('city', $cities, set_value('city')); ?>
				</div>
				
				<div id="cov-result" style="outline:1px solid #CCC; padding:10px; margin:10px; float:left; width:70%;">
					It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here
				</div>
				
				<div class="pagination">
					<ul></ul>
				</div>
		 	</div>
		</div>
		
		<footer>
	    	{{ theme:partial name="footer" }}
	    </footer> 
</body>
</html>