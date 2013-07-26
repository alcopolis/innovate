<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}	
	
	<style type="text/css">
		#show{background:#FFF;  margin-bottom:40px}
		#show #head{width:100%;}
		
		#show #body{width:100%;}
		#show #body #side{width:80px; float:left; text-align:center; margin:0 10px; color:#FFF; font-size:.75em}
		#show #body #side .item{width:100%; margin:2px 0 ;padding: 10px 0; background:#333; border-radius:5px;}
		
		#show #body #side #epg{background:#39C;}
		#show #body #side #epg a{color:#111;}
		#show #body #side #epg:hover{background:#399; cursor:pointer}
		#show #body #side #epg:hover a{color:#FFF;}
		
		#show #body #poster{float:left; margin:0 10px; width:50%;}
		#show #body #details{width:30%; float:left; margin:0 10px}
		#show #body #details:after{}
		
		#related{}
		.related-show{width:19%; background:#EFEFEF; margin:0 .5%; float:left; text-align:center;}
	</style>
</head>

<body id="top" class="epg">

		{{ integration:analytics }}
		
		<header class="wrapper">			
			{{ theme:partial name="header" }}
		</div>
				
		<div id="content" class="wrapper clear">
			<div id="body-wrapper">
			
				<div id="show">
					<?php if($shows != NULL ){ ?>
						<div id="head">
							<h1><?php echo $shows->title; ?></h1>
						</div>
						
						<div id="body" class="clearfix">
							<div id="side">
								<div class="item"><?php echo $shows->name; ?></div>
								<div class="item">Ch. <?php echo $shows->num; ?></div>
								<div class="item"><?php echo date('d M <br/>Y', strtotime($shows->date)); ?> </br> <?php echo $shows->time; ?></div>
								<div id="epg" class="item"><a href="{{ url:site }}epg">TV Guide</a></div>
							</div>
							
							<?php if($shows->poster != '' ){ ?>
								<div id="poster">
									{{ epg:poster filename="<?php echo $shows->poster; ?>" }}
								</div>
								
								<div id="details">
							<?php }else{ ?>
								<div id="details">
							<?php } ?>
									<p><?php echo $shows->syn_id; ?></p>
									<hr/>
									<p><?php echo $shows->syn_en; ?></p>
								</div>
							
						</div>			
					<?php } ?>
				</div>
				
				<div id="related" class="clearfix">
					<h4>More From <?php echo $shows->name; ?></h4>
					{{ epg:related id="<?php echo $shows->id; ?>" channel="<?php echo $shows->cid; ?>" }}
				</div>
			</div>
		</div>
		
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>