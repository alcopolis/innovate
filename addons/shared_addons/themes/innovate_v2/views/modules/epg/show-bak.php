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
		</header>
				
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
									
									<?php if(isset($similar)){ ?>
										<h4>Show Schedules</h4>
										<table id="all-schedules">
											<?php foreach ($similar as $s){ ?>
												<tr class="{{odd_even}}">
													<td class=""><?php echo date('d\<\s\u\p\>S\<\/\s\u\p\> M', strtotime($s->date)); ?></td>
													<td class="align-center"><?php echo date('l', strtotime($s->date)); ?></td>
													<td class="align-center"><?php echo date('H:m', strtotime($s->time)); ?></td>
												</tr>
											<?php } ?>
										</table>
									<?php } ?>
									
									<div>
										social share, rating, related by tags/category
									</div>
								</div>
							
						</div>			
					<?php } ?>
				</div>
				
				<?php /* 
				<div id="related" class="clearfix">
					<h4>More From <?php echo $shows->name; ?></h4>
					{{ epg:related id="<?php echo $shows->id; ?>" channel="<?php echo $shows->cid; ?>" }}
				</div>
				*/ ?>
				
			</div>
		</div>
		
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>