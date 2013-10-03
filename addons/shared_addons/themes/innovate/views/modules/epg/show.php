<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}	
	
	<style type="text/css">
		#body-wrapper{
			background: #003a6d; /* Old browsers */
			background: -moz-linear-gradient(top,  #003a6d 0%, #436b99 23%, #ffffff 100%); /* FF3.6+ */
			background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#003a6d), color-stop(23%,#436b99), color-stop(100%,#ffffff)); /* Chrome,Safari4+ */
			background: -webkit-linear-gradient(top,  #003a6d 0%,#436b99 23%,#ffffff 100%); /* Chrome10+,Safari5.1+ */
			background: -o-linear-gradient(top,  #003a6d 0%,#436b99 23%,#ffffff 100%); /* Opera 11.10+ */
			background: -ms-linear-gradient(top,  #003a6d 0%,#436b99 23%,#ffffff 100%); /* IE10+ */
			background: linear-gradient(to bottom,  #003a6d 0%,#436b99 23%,#ffffff 100%); /* W3C */
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#003a6d', endColorstr='#ffffff',GradientType=0 ); /* IE6-9 */
			
			width:100%;
			height:auto;:
		}
		
		#background, #poster{
			background-image:url('addons/shared_addons/modules/epg/upload/shows/<?php echo $shows->poster; ?>');
		}
			
		#show{
			position: relative;
			z-index:0;
			margin:40px 5%;
		}w
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
				
		<div id="content" class="wrapper clear">
			<div id="body-wrapper">
				<div id="background"></div>
				<div id="show">
					<?php if($shows != NULL ){ ?>
						<div id="head">
							<h1><?php echo $shows->title; ?></h1>
						</div>
						<div id="body">
							<div id="side">
								<div id="epg" class="item"><a href="{{ url:site }}epg">TV Guide</a></div>
								<div class="item"><?php echo $shows->name; ?></div>
								<div class="item">Ch. <?php echo $shows->num; ?></div>
								<div class="item"><?php echo date('d M <br/>Y', strtotime($shows->date)); ?> </br> <?php echo date('H:m A', strtotime($shows->time)); ?></div>
							</div>
							
							<?php if($shows->poster != '' ){ ?>
								<div id="poster" class="clearfix">

								</div>
								
								<div id="details">
							<?php }else{ ?>
								<div id="details">
							<?php } ?>
									
									
									<div id="synopsis" class="detail">
										<?php echo $shows->syn_id; ?>
										<hr>
										<?php echo $shows->syn_en; ?>
									</div>
									
									<?php if(isset($similar)){ ?>
										<div id="all-schedules" class="detail">
											<h4>Later On</h4>
											<table id="all-schedules">
												<?php foreach ($similar as $s){ ?>
													<tr>
														<td style="width:70%"><?php echo date('l, d\<\s\u\p\>S\<\/\s\u\p\> M', strtotime($s->date)); ?></td>
														<td style="width:30%; text-align:center"><?php echo date('H:m a', strtotime($s->time)); ?></td>
													</tr>
												<?php } ?>
											</table>
										</div>
									<?php } ?>
																		
									
								</div>
							</div>			
					<?php } ?>
				</div>
				
				<br style="clear:both; display:hidden; width:0; height:0;" /> 
				
				
			</div>
		</div>
		
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>