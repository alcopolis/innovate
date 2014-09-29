<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

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
	
	<div id="content" class="wrapper clearfix">
		<div id="content-bg" style="position:absolute; width:100%; height:auto; background:#EFEFEF;"></div>
		<div id="body-wrapper" class="clearfix">
			<?php for($i=1; $i<=5; $i++) { ?>
				<div id="quiz-<?php echo $i; ?>" class="item clearfix" style="position:relative; width:360px; height:180px; background:#DDD; margin:10px;float:left;">
					<p class="title left" style="position:relative; top:130px; padding:5px 10px 5px 10px; margin-right:5px; background:rgba(255,255,255,.95); color:#333; box-shadow:0 2px 3px #999;">#Quiz <?php echo $i; ?></p>
					<a href="quiz/quiz-<?php echo $i; ?>" class="button play-quiz left" style="position:relative; top:130px; padding:5px 10px; background:rgba(255,255,255,.95);color:#333; box-shadow:0 2px 3px #999; border:none;">Play</a>
				</div>
			<?php } ?>
		</div>
	</div>
	
	<footer>
		{{ theme:partial name="footer" }}
	</footer>
</body>
</html>