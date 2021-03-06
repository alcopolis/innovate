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
		body{font-size:12px;background:url("{{ url:site }}files/large/<?php echo $quiz->theme; ?>") no-repeat center top; background-size:auto auto;}
		#rules ol li, #rules ul li{font-size:12px;}
	</style>
</head>

<body id="top" class="epg">
	{{ integration:analytics }}

	<header class="wrapper">
		{{ theme:partial name="header" }}
	</header>
	
	<div id="content" class="wrapper clearfix">
		<div id="content-bg" style="position:absolute; width:100%; height:auto;"></div>
		<div id="body-wrapper" class="clearfix" style="padding:160px 0 40px 0;">
			<div class="container">
				
				<p>{{ session:flash name="quiz_msg" }}</p>
				
				
				<section class="clearfix" id="quiz">
					<h1 id="title"><?php echo $quiz->name; ?></h1>
					
					{{if !user:logged_in }}
						<?php $this->session->set_userdata('redirect_to',current_url()); ?>
						<div id="user-data">
							<p>Silahkan login terlebih dahulu untuk mengikuti kuis ini. <?php echo $quiz->description; ?></p>
							{{ widgets:area slug="login" }}
						</div>
						<div id="popup" class="hide" >
							<a id="close-popup" href="#" onclick="closePopup()">x</a>
							<iframe src="register"></iframe>
						</div>
					{{ else }}
						<div id="user-data">
							<p><?php echo $quiz->description; ?></p>
							<a href="quiz/logout" class="button" style="padding:3px 10px; background:#F30; color:#FFF; text-shadow:none;">Log out</a>
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
				
				<section id="rules" class="clearfix" style="background:rgba(10,10,10,.9); border-radius: 0 0 5px 5px; padding:20px 15px; margin:15px auto 0 auto; color:#EFEFEF;">
					Syarat &amp; Ketentuan Kuis:
					 <?php echo $quiz->toc; ?>
				</section>
			</div>
		</div>
	</div>

	<footer>
		{{ theme:partial name="footer" }}
	</footer>
	
</body>
</html>


