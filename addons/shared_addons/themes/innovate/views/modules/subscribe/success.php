<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
</head>
<body id="top" class="subscribe">
		
		<header class="wrapper">				
			{{ theme:partial name="header" }}
		</header>
				
		<div id="content" class="wrapper clear">
			<div id="body-wrapper" class="clearfix" style="margin:0 auto; width:50%; background:rgba(255,255,255,.9); padding:20px; box-shadow:0 0 20px rgba(0,0,0,.1);	border-radius:5px;">
				<h1>Pendaftaran Berhasil</h1>
				<p>Terima kasih. Data pendaftaran berlangganan Anda sudah masuk ke database kami. Tim CS kami akan segera menghubungi Anda untuk proses selanjutnya.</p>
				<p><a href="{{url:site}}">&laquo; Back to Home</a></p>	
			</div>	
		</div>
		
		<footer>	
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>