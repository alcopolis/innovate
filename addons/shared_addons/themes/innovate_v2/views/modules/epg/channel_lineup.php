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
		$(document).ready(function(){
			$('.ch').click(function(){
				$('#ch-detail').removeClass('hide');
				$('#cat').html($(this).attr('data-cat'));
				$('#name').html($(this).attr('data-name'));
				$('#num').html($(this).attr('data-num'));
				$('#ch-desc').html($(this).attr('data-desc'));
				//$('#sch-link a').attr('href', 'epg/' + $(this).attr('data-link'));
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
				<div id="tools">
					<div id="page-title" class="tool"><h4>Channel Lineup</h4></div>
					
					<div id="filter" class="tool">
						<fieldset id="filters">
							
							<style type="text/css">
								.filter{float:left; margin:10px;}
								.filter label{color:#FFF;}
							</style>
							
							<?php echo form_open('epg/channel_lineup'); ?>													
								<div class="filter">
									<label for="cat_id">Channel Category</label>
									<div class="input"><?php echo form_dropdown('cat_id', $cat, set_value('cat_id')); ?></div>
								</div>
								
								<div class="filter">
									<label for="submit">&nbsp;</label>
									<div class="input"><?php echo form_submit('submit', 'View'); ?></div>
								</div>
							<?php echo form_close(); ?>
						</fieldset>
					</div>
				</div>
					
				<div id="ch-lineup" class="clearfix">
					<div id="list" class="left">	
						{{ epg:ch_lineup category="<?php echo $category; ?>" }}
					</div>
					<div id="side" class="left">
						<div id="ch-detail" class="side-item hide clearfix">
							<img id="logo" src="{{theme:image_path}}themes/default-icon.jpg" style="float:left; width:96px; height:96px; background:#CCC; margin-right:10px;" />
							<h6 id="name"></h6>
							<div>Ch: <span id="num"></span></div>
							<div id="cat">Category: <?php echo $category; ?></div>
<!-- 						<div id="sch-link"><a href="epg/">Today's Schedule</a></div> -->
							<div style="clear:left;"></div>
							<div id="ch-desc" style="margin-top:10px;"></div>
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