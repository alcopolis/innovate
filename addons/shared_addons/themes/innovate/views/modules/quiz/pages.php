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
		body{font-family:Arial, Helvetica, sans-serif; font-size:12px;background:url("{{ url:site }}files/large/863b9952281f5085198f715a46756a6c.jpg") no-repeat left 80px; background-size:100% auto;}
		
		#body-theme{background:#333;}
			.clearfix:after{content: "."; display: block; height: 0; clear: both;  visibility: hidden;}
			
			input{
				border:1px solid #CCC;
				padding:5px 3px;
			}
			
			input[type="text"]{
				margin:5px 0;
				min-width:80%;		
			}
			
			input[type="submit"]{
				margin:5px 0;
				min-width:50%;
				background:#007DC3;	
				cursor:pointer;
				color:#FFF;
				border:none;
			}
			
			.container{
				width:960px;
				margin:0 auto 40px auto;	
				padding:0;
				overflow:hidden;	
				background:url("{{ url:site }}files/large/cd267d7a368f87124e9782ac8bdde9b1.jpg");
			}
			
			.container  #kuis-head{
				box-shadow:0 2px 10px rgba(0,0,0,.75);	
				padding:20px 0;
				position:relative;
				z-index:99;
			}
			
			.container #kuis-head h1{
				padding:0; margin:0;
				font-size:60px;
				color:rgba(255,255,255,.95);
				text-shadow:0 -1px 1px #999;	
			}
			
			.container section#quiz{
				background:rgba(255,255,255,.95);	
				width:90%;
				padding:2.5%; 
				margin:0 auto;
				box-shadow:0 2px 3px rgba(80,80,80,.85);
			}
			
			.container  #user-data{
				float:left;	
				margin:10px 0 0 0;
		                padding:0 20px 0 0;
				width:30%;
				text-align:left;
		                text-shadow:0 -1px 1px #FFF;
		                line-height:1.25em;
		                font-size:12px;
		                color:#666;
			}
			
			.container  #quiz-content{
				float:left;
				margin:0;
				padding:0 0 0 40px;	
		                border-left:1px solid #CCC;
			}
			
			.container  #quiz-content li{
				margin:0;
				padding:0;	
			}
			
		.container  li.data{padding-bottom:20px !important}
		.container  li.data p{padding-bottom:0}	
		.container  li.data ol{
				list-style:none;
				padding:0;	
			}
			
			#rules{
				/*background:rgba(51,51,51,.95);*/
				color:#FFF;
				width:90%;
				margin:10px auto 40px auto;
				padding: 10px 2.5%;
				text-shadow:0 1px 1px #333;
			}
		
			#rules ol{margin:0; padding:0;}
			#rules ol li{margin-left:20px;}
		}
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
				<div id="kuis-head">
					<h1 id="title">#SPEKTABOLA</h1>
				</div>
				
				<section class="clearfix" id="quiz">
					<div id="user-data">Lengkapi Nama dan Email Anda untuk menjawab kuis ini.<br />
					<br />
					{{ contact:form name=&quot;text|required&quot; email=&quot;text|required|valid_email&quot;&nbsp; to=&quot;boy.perkasa@innovate-indonesia.com&quot; button=&quot;Kirim Jawaban&quot; }} <label>Nama</label> {{ name }} <label>Email</label> {{ email }} {{ recaptcha }}{{ /contact:form }}</div>
					
					<ol id="quiz-content">
						<li class="data">
						<p>Sebutkan sebutan slogan untuk Manchester United FC ?</p>
					
						<ol>
							<li><input name="q1" type="radio" /> The Gunners</li>
							<li><input name="q1" type="radio" /> Glory Glory Manchester United</li>
							<li><input name="q1" type="radio" /> City Till We Die</li>
						</ol>
						</li>
						<li class="data">
						<p>Sebutkan nama Stadiun Manchester United FC ?</p>
					
						<ol>
							<li><input name="q2" type="radio" /> Old Trafford</li>
							<li><input name="q2" type="radio" /> Stamford Bridge</li>
							<li><input name="q2" type="radio" /> Emirates Stadium</li>
						</ol>
						</li>
						<li class="data">
						<p>Sebutkan ada di channel berapa BeIn Sport 3 di Innovate ?</p>
					
						<ol>
							<li><input name="q3" type="radio" /> 234</li>
							<li><input name="q3" type="radio" /> 235</li>
							<li><input name="q3" type="radio" /> 233</li>
						</ol>
						</li>
					</ol>
				</section>
				
				<section id="rules" class="clearfix">
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


