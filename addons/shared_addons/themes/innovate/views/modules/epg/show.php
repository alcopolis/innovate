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
								<div class="item"><?php echo date('l \<\b\r\/\>d M', strtotime($shows->date)); ?> </br> <?php echo date('H:i A', strtotime($shows->time)); ?></div>
							</div>
							
							<?php if($shows->poster != '' ){ ?>
								<div id="poster">
									<?php if($shows->trailer != '' ){ ?>
										<iframe style="width:100%; height:100%;" src="//<?php echo $shows->trailer; ?>" frameborder="0" allowfullscreen></iframe>
									<?php } ?>
								</div>
								
								<div id="details">
							<?php }else{ ?>
								<div id="details">
								
								<script>
									$(document).ready(function() {
										$('#details').css('width','80%');
										$('.detail').css({'width':'30%', 'float':'left'});
									});
								</script>
							<?php } ?>
									
									<?php if($shows->syn_id != '' || $shows->syn_en != ''){ ?>
										<div id="show-info" class="detail">
											<div id="synopsis" class="epg-info" style="margin-bottom:20px;">
												<h4>Story</h4>
												<?php echo $shows->syn_id; ?>
												<hr>
												<?php echo $shows->syn_en; ?>
											</div>
											
											<?php if(count($similar) > 0){ ?>
												<div id="all-schedules" class="epg-info" >
													<h4>Later On</h4>
													<table id="all-schedules">
														<?php foreach ($similar as $s){ ?>
															<tr>
																<td style="width:70%"><?php echo date('l, M d\<\s\u\p\>S\<\/\s\u\p\>', strtotime($s->date)); ?></td>
																<td style="width:30%; text-align:center"><?php echo date('H:i a', strtotime($s->time)); ?></td>
															</tr>
														<?php } ?>
													</table>
												</div>
												
												<div style="clear: both"></div>
											<?php } ?>
										</div>
									<?php } ?>
									
									<div class="ads detail" style="height:200px; background:#FFF;">Advertisment</div>
								</div>
					
							</div>			
					<?php } ?>
				</div>
			</div>
		</div>
		
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>