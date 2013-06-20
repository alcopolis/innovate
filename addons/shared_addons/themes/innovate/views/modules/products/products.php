<!DOCTYPE html>
<html>
<head>
	{{ theme:partial name="metadata" }}
</head>
<body id="top" class="page-product <?php echo $data->slug; ?>">

	<!-- Begin pageWrapper -->
	<div id="pageWrapper">
		{{ integration:analytics }}
		
		<!-- Begin Header Content -->
		<div class="partialWrapper">				
				{{ theme:partial name="header" }}
			</div>
		<!-- End Header Content -->

		<!-- Begin contentWrapper -->
		<div class="contentWrapper">
			<h1><?php echo $data->name; ?></h1>
			<p><?php echo $data->desc; ?></p>
			<p><?php echo $data->section. ' : ' . $data->tags; ?></p>
		</div>
		<!-- End contentWrapper -->
		
		<!-- Begin Footer Content -->
		<div class="partialWrapper">				
			{{ theme:partial name="footer" }}
		</div>
		<!-- End Footer Content -->
	</div>
	<!-- End pageWrapper -->

</body>
</html>