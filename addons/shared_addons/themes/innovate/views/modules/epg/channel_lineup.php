<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}	
	
	<style type="text/css">		
		body.epg #content{margin-top:80px; min-height:390px;}
		
		body.epg #body-wrapper{
			width:90%;
			position:relative; 
			margin:0 auto; 
			z-index:9000;
			padding-top:0;
			float:none;
		}

		
		#background, #poster{
			background-image:url('addons/shared_addons/modules/epg/upload/shows/<?php echo $shows->poster; ?>');
		}
			
		#show{
			position: relative;
			z-index:0;
			margin:40px 5%;
		}
			
	</style>
	
	<script>
		$(document).ready(function() {
			var posterW = $('#poster').width();
			$('#poster').height(Math.round(posterW*0.75));
			
			var contentH = $('#body-wrapper').innerHeight();
			$('#background').height(contentH);
		});
	</script>
</head>

<body id="top" class="epg">

		{{ integration:analytics }}
		
		<header class="wrapper">			
			{{ theme:partial name="header" }}
		</header>
				
		<div id="content" class="wrapper clearfix">
			<div id="body-wrapper">
				<div class="clearfix">
					<h4>National FTA</h4>
					{{ epg:ch_lineup category="National FTA" }}
				</div>
				
				<div class="clearfix">
					<h4>International FTA</h4>
					{{ epg:ch_lineup category="International FTA" }}
				</div>
				
				<div class="clearfix">
					<h4>Movies</h4>
					{{ epg:ch_lineup category="Movies" }}
				</div>
				
				<div class="clearfix">
					<h4>Knowledge</h4>
					{{ epg:ch_lineup category="Knowledge" }}
				</div>
				
				<div class="clearfix">
					<h4>Entertainment</h4>
					{{ epg:ch_lineup category="Entertainment" }}
				</div>
				
				<div class="clearfix">
					<h4>Life Style</h4>
					{{ epg:ch_lineup category="Life Style" }}
				</div>
				
				<div class="clearfix">
					<h4>Sports</h4>
					{{ epg:ch_lineup category="Sports" }}
				</div>
				
				<div class="clearfix">
					<h4>News</h4>
					{{ epg:ch_lineup category="News" }}
				</div>
				
				<div class="clearfix">
					<h4>Kids</h4>
					{{ epg:ch_lineup category="Kids And Toddler" }}
				</div>
			</div>
		</div>
		
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>