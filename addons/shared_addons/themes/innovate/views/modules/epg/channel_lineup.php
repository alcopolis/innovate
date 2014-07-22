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
			width:100%;
			position:relative; 
			margin:0 auto; 
			z-index:9000;
			padding-top:0;
			float:none;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){			var sideW = $('#side').width();			var listW = $('#ch-lineup').width() - sideW - 20;			$('#list').width(listW);						$( ".accordion" ).accordion();			
			$('.ch').click(function(){				var cID = $(this).attr('data-id');								if($(this).attr('data-logo') != ''){ $('img#logo').attr('src', $(this).attr('data-logo')) };
				if($(this).attr('data-cat') != ''){ $('#cat').html($(this).attr('data-cat')) };
				if($(this).attr('data-name')){ $('#name').html($(this).attr('data-name')) };
				if($(this).attr('data-num')){ $('#num').html($(this).attr('data-num')) };
				if($(this).attr('data-desc')){ $('#ch-desc').html($(this).attr('data-desc')) };				$.ajax({					type: 'GET',					url: 'epg/today_sched/',					data: cID,					processData: false,				    contentType: false,					dataType: 'json',					success: function(respond) {													},				});
			})
		});
	</script>
</head>

<body id="top" class="epg">
		{{ integration:analytics }}
		<header class="wrapper">			
			{{ theme:partial name="header" }}
		</header>
		<div id="content" class="wrapper clearfix">
		 	<div id="body-wrapper" style="position: relative;">
				<div id="ch-lineup" class="clearfix">					<h1>Channel Lineup</h1>					
					<div id="list" class="left">	
						{{ epg:ch_lineup category="<?php echo $category; ?>" }}
					</div>
					<div id="side" class="right">
						<div id="ch-detail" class="side-item clearfix">							<section>
								<img id="logo" src="{{theme:image_path}}themes/default-icon.jpg" style="width:100%; height:auto; background:#CCC; margin-bottom:10px;" />													</section>							 							<div>Today's Schedule</div>
						</div>
						<?php if(isset($ads)){ ?>
							<div class="ads side-item">
								Advertisement
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>