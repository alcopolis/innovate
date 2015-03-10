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

	{{ if alcopolis:site_status }}
		<header class="wrapper">
			{{ theme:partial name="header" }}
		</header>
		
		<div id="content" class="wrapper clearfix">
			<div id="body-wrapper" class="clearfix">
				<section id="section-title">Hot Quiz</section>
					
				<?php if(count($quiz) > 0){ ?>
					<?php foreach($quiz as $q){ ?>
						<div id="quiz-<?php echo $q->slug; ?>" class="item clearfix">
							<a class="poster prop" href="quiz/pages/<?php echo $q->slug; ?>"><img src="{{ url:site }}files/large/<?php echo $q->theme;?>"/></a>
							<a class="title prop" href="quiz/pages/<?php echo $q->slug; ?>" class="button play-quiz left"><?php echo $q->name; ?></a>
							<p class="desc prop"><?php echo $q->description; ?></p>
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
	{{ else }}
		{{ theme:partial name="site_down" }}
	{{ endif }}
</body>
</html>