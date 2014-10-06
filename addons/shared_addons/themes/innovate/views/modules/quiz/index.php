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
		<div id="body-wrapper" class="clearfix" style="padding-top:140px;">
			<h1>Innovate Quiz</h1>				
			<?php foreach($quiz as $q){ ?>
				<div id="quiz-<?php echo $q->slug; ?>" class="item clearfix" style="position:relative; width:30%; background:url({{ url:site }}files/large/<?php echo $q->theme; ?>) no-repeat left top; background-size:100% auto; margin:10px 1.5%;float:left;">
					<a href="quiz/pages/<?php echo $q->slug; ?>" class="button play-quiz left" style="position:relative; top:20px; padding:5px 10px; background:rgba(255,255,255,.95);color:#333; box-shadow:0 2px 3px #999; border:none;"><?php echo $q->name; ?></a>
				</div>
			<?php } ?>
		</div>
	</div>
	
	<footer>
		{{ theme:partial name="footer" }}
	</footer>
</body>
</html>