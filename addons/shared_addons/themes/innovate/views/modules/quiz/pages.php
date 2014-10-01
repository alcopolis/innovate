<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
	
	<style type="text/css">
		body{font-size:12px;background:url("{{ url:site }}files/large/<?php echo $quiz->theme; ?>") no-repeat left top; background-size:100% auto;}
	</style>
</head>

<body id="top" class="epg">
	{{ integration:analytics }}

	<header class="wrapper">
		{{ theme:partial name="header" }}
	</header>
	
	<div id="content" class="wrapper clearfix">
		<div id="content-bg" style="position:absolute; width:100%; height:auto; background:#EFEFEF;"></div>
		<div id="body-wrapper" class="clearfix">
			<div class="container">
				
				<?php //var_dump($this->session->all_userdata()) ?>
				<p>{{ session:flash name="quiz_msg" }}</p>
				
				
				<section class="clearfix" id="quiz">
					<h1 id="title"><?php echo $quiz->name; ?></h1>
					
					
					{{if !user:logged_in}}
						<div id="user-data">
							{{ widgets:area slug="login" }}
						</div>
					{{ endif }}
					
					{{if user:logged_in}}
						<?php echo form_open('quiz/check/' . $quiz->slug); ?>
						<ol id="quiz-content">
					{{ else }}
						<ol id="quiz-content" class="login-required">
					{{ endif }}
					
						<?php 
							$i=0;
						?>
					
						<?php foreach($question as $quest){ ?>
							<?php $soal = json_decode($quest->question_admin); $i++; ?>
							<li class="data">
								<p><?php echo $soal->question; ?></p>
								
								<ol>
									<?php foreach($soal->choices as $key=>$c){ ?>
										<li><input value="<?php echo $key; ?>" name="q-<?php echo $i; ?>" type="radio" /> <?php echo $c; ?></li>
									<?php } ?>
								</ol>
							</li>
						<?php } ?>
						
						<input type="hidden" name="total" value="<?php echo count((array)$question); ?>"/>
						
						{{if user:logged_in}}
							<input type="submit" value="Kirim Jawaban" name="submit">
						{{ endif }}
					</ol>
					
					{{if user:logged_in}}
						<?php echo form_close(); ?>
					{{ endif }}
				</section>
				
				<section id="rules" class="clearfix hide">
					Syarat &amp; Ketentuan Kuis:
					<ol>
						<li>Lorem ipsum</li>
						<li>Lorem ipsum</li>
						<li>Lorem ipsum</li>
					</ol>
				</section>
			</div>
		</div>
	</div>

	<footer>
		{{ theme:partial name="footer" }}
	</footer>
</body>
</html>


