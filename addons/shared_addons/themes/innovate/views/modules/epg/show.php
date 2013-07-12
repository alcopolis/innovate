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

	<!-- Begin pageWrapper -->
	<div id="pageWrapper">
		{{ integration:analytics }}
		
		<!-- Begin Header Content -->
		<div class="partial-wrapper">				
			{{ theme:partial name="header" }}
		</div>
		<!-- End Header Content -->
				
		<!-- Begin contentWrapper -->
		<div class="content-wrapper">
			<?php if($shows != NULL ){ ?>
				<h1><?php echo $shows->title; ?></h1>
				<p><?php echo $shows->syn_id; ?></p>
				<p><?php echo $shows->syn_en; ?></p>			
			<?php } ?>
			
			<div id="related">
				<h4>More From This Channel</h4>
				{{ epg:related id="<?php echo $shows->id; ?>" channel="<?php echo $shows->cid; ?>" }}
				<br style="clear:both;" />
			</div>
		</div>
		<!-- End contentWrapper -->
		
		<!-- Begin Footer Content -->
		<div class="partial-wrapper">			
			{{ theme:partial name="footer" }}
		</div>
		<!-- End Footer Content -->
	</div>
	<!-- End pageWrapper -->

</body>
</html>