<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
</head>
<body id="top" class="">
	{{ if alcopolis:site_status }}
	
		
	 	<div id="pageWrapper">
			{{ integration:analytics }}
						
			<div class="partial-wrapper">				
				{{ theme:partial name="header" }}
			</div>
													
			<div class="content-wrapper scroll">
				{{ theme:partial name="content_default" }}
			</div>
			
			<div class="partial-wrapper">
				{{ theme:partial name="footer" }}
			</div>
		</div>
	 	
	{{ else }}
		
		{{ theme:partial name="site_down" }}
		
	{{ endif }}
</body>
</html>