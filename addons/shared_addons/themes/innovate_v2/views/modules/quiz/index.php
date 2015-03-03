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

{{ if alcopolis:device == 'computer' }}
<body id="top" class="quiz">
{{ else }}
<body id="top" class="quiz mobile">
{{ endif }}

	{{ integration:analytics }}

	<header class="wrapper">
		{{ theme:partial name="header" }}
	</header>
	
	<div id="content" class="wrapper clearfix">
		<div id="content-bg" style="position:absolute; width:100%; height:auto; background:#EFEFEF;"></div>
		<div id="body-wrapper" class="clearfix">
			<h1>Hot Quiz</h1>	
			<?php if(count($quiz) > 0){ ?>
				<?php foreach($quiz as $q){ ?>
					<div id="quiz-<?php echo $q->slug; ?>" class="item clearfix" style="position:relative; width:30%; background:url({{ url:site }}files/large/<?php echo $q->theme; ?>) no-repeat left top; background-size:100% auto; margin:10px 1.5%;float:left;">
						<a href="quiz/pages/<?php echo $q->slug; ?>" class="button play-quiz left" style="position:relative; top:140px; padding:5px 10px; background:rgba(255,255,255,.95);color:#333; box-shadow:0 2px 3px #999; border:none; font-weight:bold;"><?php echo $q->name; ?></a>
					</div>
				<?php } ?>
			<?php }else{ ?>
				<p>Nantikan kuis Innovate yang berikutnya.</p>
			<?php } ?>
		</div>
	</div>
	
	<footer>
		{{ theme:partial name="footer" }}
	</footer>
</body>
</html>