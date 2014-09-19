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
				{{ epg:metadata }}
				{{ epg:featured limit="3" category="Knowledge"}}
				{{ epg:featured limit="3" category="Knowledge"}}
				{{ epg:featured limit="3" category="Knowledge"}}
				{{ epg:featured limit="3" category="Knowledge"}}
			</div>
		</div>
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>