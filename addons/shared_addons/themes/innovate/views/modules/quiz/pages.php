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
		body{font-size:12px;background:url("{{ url:site }}files/large/<?php echo $quiz->theme; ?>") no-repeat left top; background-size:auto auto;}
	</style>
</head>

<body id="top" class="epg">
	{{ integration:analytics }}

	<header class="wrapper">
		{{ theme:partial name="header" }}
	</header>
	
	<div id="content" class="wrapper clearfix">
		<div id="content-bg" style="position:absolute; width:100%; height:auto;"></div>
		<div id="body-wrapper" class="clearfix">
			<div class="container">
				
				
				<section class="clearfix" id="quiz">
					<h1 id="title"><?php echo $quiz->name; ?></h1>
					
					{{if !user:logged_in }}
						<div id="user-data">
							<p>Silahkan login terlebih dahulu untuk mengikuti kuis ini</p>
							{{ widgets:area slug="login" }}
						</div>
						<div id="popup" class="hide" >
							<a id="close-popup" href="#" onclick="closePopup()">x</a>
							<iframe src="register"></iframe>
						</div>
					{{ endif }}
					
					{{if user:logged_in}}
						<?php echo form_open('quiz/check/' . $quiz->slug); ?>
						<ol id="quiz-content">
					{{ else }}
						<ol id="quiz-content" class="login-required">
					{{ endif }}

					
					<?php echo form_open('quiz/check/' . $quiz->slug); ?>
					<ol id="quiz-content">
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
						
						<input type="hidden" name="total" value="<?php echo  count($question); ?>"/>
					</ol>
					
					<input type="submit" value="Kirim Jawaban" name="submit">
					<?php echo form_close(); ?>
				</section>
				
				<section id="rules" class="clearfix">
					Syarat &amp; Ketentuan Kuis:
					<ol>
						<li>Kuis terbuka untuk umum</li>
						<li>Pelanggan wajib mengisi semua data diri dan informasi yang dibutuhkan pada kolom yang tertera</li>
						<li>Pemenang akan diumumkan melalui akun resmi twitter Innovate, @InnovateInd, paling lambat 7 hari setelah periode kuis berakhir</li>
						<li>Peserta dapat mengikuti kuis lebih dari 1 kali, tetapi hanya dapat terpilih 1 kali sebagai pemenang</li>
						<li>Keputusan juri tidak dapat diganggu gugat</li>
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


