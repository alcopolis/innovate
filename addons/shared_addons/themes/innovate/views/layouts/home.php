<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
</head>
<body id="top" class="home">
	
	{{ integration:analytics }}
	
	{{ if alcopolis:site_status }}
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>
	 	
	 	 <div id="content" class="wrapper clear">
			
	 	 	<div id="body-theme">
				{{ theme:partial name="home" }}
			</div>
	 	 </div>
	 	 
	 	 <footer>
	    	{{ theme:partial name="footer" }}
	     </footer>  
	 	
	{{ else }}
		
		{{ theme:partial name="site_down" }}
		
	{{ endif }}
</body>
</html>