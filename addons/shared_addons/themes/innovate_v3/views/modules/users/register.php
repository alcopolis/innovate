<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
	
	<style type="text/css">
		body, input{font-family:"Titillium Web",Helvetica Neue,Helvetica,Tahoma,sans-serif;}
		input{border:1px solid #CCC; background:none; margin:5px auto 5px 20px; padding:5px;}
		input[type="submit"]{background:#007DC3; cursor:pointer; color:#FFF;}
		
		#body-wrapper{width:75%; margin:0 auto; padding: 40px 0 80px;}
		.page-title{margin:20px 0 0 0; color:#007DC3; text-align:center; }
		#quiz-register{margin:10px .5%; text-align:center;}
	</style>
</head>




{{ if alcopolis:device == 'computer' }}
	<body id="top">
{{ else }}
	<body id="top" class="mobile">
{{ endif }}

	{{ integration:analytics }}
	
	{{ if alcopolis:site_status }}
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>
	 	
	 	 <div id="content" class="wrapper">
	 	 	<div id="body-theme" class="clearfix">
		 	 	<div id="body-wrapper">
				
					<h2 class="page-title" id="page_title">Quiz Register</h2>

					<?php /* 
					<p>
						<span id="active_step"><?php echo lang('user:register_step1') ?></span> -&gt;
						<span><?php echo lang('user:register_step2') ?></span>
					</p>
					*/ ?>

					<?php if ( ! empty($error_string)):?>
					<!-- Woops... -->
					<div class="error-box">
						<?php echo $error_string;?>
					</div>
					<?php endif;?>

					<?php echo form_open('register', array('id' => 'quiz-register', 'redirect_to'=>$this->session->userdata('redirect_to'))) ?>	
						<div style="margin:20px 0;">
							<input type="text" maxlength="50" placeholder="First Name" id="first_name" value="" name="first_name">
							<input type="text" maxlength="50" placeholder="Last Name" id="last_name" value="" name="last_name">
						</div>
						
						<?php if ( ! Settings::get('auto_username')): ?>
							<input type="text" name="username" placeholder="Username" maxlength="100" value="<?php echo $_user->username ?>" />
						<?php endif ?>
						
						<div>
							<input type="text" name="email" placeholder="Email"  maxlength="100" value="<?php echo $_user->email ?>" />
							<?php echo form_input('d0ntf1llth1s1n', ' ', 'class="default-form" style="display:none"') ?>
						</div>
						
						<div>
							<input type="password" name="password" maxlength="100" placeholder="Password" />
						</div>
						
						<?php echo form_submit('btnSubmit', lang('user:register_btn'), 'class="button"') ?>
					<?php echo form_close() ?>
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