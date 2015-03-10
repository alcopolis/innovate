<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
		<style type="text/css">
			body{background-image:url("{{ url:site }}files/large/<?php echo $quiz->theme; ?>");}
			#rules ol li, #rules ul li{font-size:12px;}
		</style>
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
			<div id="content-bg" style="position:absolute; width:100%; height:auto;"></div>
			<div id="body-wrapper" class="clearfix" style="padding:0px 0 40px 0;">
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
								<a href="<?php echo base_url('users'); ?>/logout" class="button" style="padding:3px 10px; background:#F30; color:#FFF; text-shadow:none;">Log out</a>
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
	{{ else }}
		{{ theme:partial name="site_down" }}
	{{ endif }}
</body>
</html>


