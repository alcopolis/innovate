<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}	
</head>

<body id="top" class="epg">

		{{ integration:analytics }}
		
		<header class="wrapper">			
			{{ theme:partial name="header" }}
		</div>
				
		<div id="content" class="wrapper clear">
			<div id="body-wrapper">
			
				<div id="show" style="background:#F00;">
					<?php if($shows != NULL ){ ?>
						<div id="show-head" style="width:100%;">
							<h1><?php echo $shows->title; ?></h1>
						</div>
						
						<div id="show-body" style="width:100%;">
							<div id="side" style="40px; background:#444; float:left; text-align:center;">
								<p><?php echo $shows->name; ?></p>
								<p><?php echo $shows->num; ?></p>
								<p><?php echo $shows->date; ?> </br> <?php echo $shows->time; ?></p>
								<p><a href="#">TV Guide</a></p>
							</div>
							
							<?php if($shows->poster != NULL ){ ?>
								<div id="poster" style="width:50%; float:left; height:225px; background:#EEE; margin:10px">
									{{epg:poster filename="<?php echo $shows->poster; ?>" size="small" }}
								</div>
							<?php } ?>
							
							<div id="details" style="width:30%; float:left; ">	
								<p><?php echo $shows->syn_id; ?></p>
								<hr/>
								<p><?php echo $shows->syn_en; ?></p>
							</div>
							
							<div class="clear"></div>
						</div>			
					<?php } ?>
				</div>
				
				
				
				<div id="related">
					<h4>More From This Channel</h4>
					{{ epg:related id="<?php echo $shows->id; ?>" channel="<?php echo $shows->cid; ?>" }}
					<br style="clear:both;" />
				</div>
			</div>
		</div>
		
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>