<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
</head>

<body id="top" class="faq">
	
		{{ integration:analytics }}
	
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>
				
		<div id="content" class="wrapper">
			<div id="body-wrapper" class="clearfix">

				<h3 id="page-title">Frequently Asked Questions</h3>
				
				<div id="faq-side"  class="left">
					<?php echo $cat_tree; ?>
					
					<div id="hotline" class="util-item last" style="width:100%; text-align:center; position:absolute; bottom:10px;">
						<a href="{{ url:site }}contact"><img src="{{ theme:image_path }}cs.png" style="width:80px;"/></a>
						<p style="margin:0 0 -10px 0;">
							<strong>Customer Care</strong><br/>
							<span style="font-size:1.2em; font-weight:bold; color:#39C; line-height:1.5em">[ 021 ] 5055 6182</span>
						</p>
					</div>
				</div>
				
				<div id="item-list" class="left">
					<p>Temukan jawaban dari pertanyaan-pertanyaan Anda yang sering juga ditanyakan oleh pelanggan lainnya.
					Hubungi Customer Care Innovate bila pertanyaan Anda belum terjawab oleh FAQ ini.</p>
					
					<h4 style="color:#333; text-shadow:0 -1px 1px #999; font-size:2em; margin-top:30px;">Popular FAQs</h4>
					<?php if($faqs != NULL){ ?>
						<?php foreach ($faqs as $faq){ ?>
							<div class="faq-item">
								<div class="faq-subject"><a href="<?php echo base_url(); ?>faq/view/<?php echo $faq->slug; ?>"><?php echo $faq->title; ?></a></div>
								<div class="faq-content">
									<div class="faq-q"><?php echo $faq->question; ?></div>
									<div class="faq-a"><?php echo substr(strip_tags ($faq->answer), 0, 200) . '... <a href="' . base_url() . 'faq/view/' . $faq->slug . '">read &raquo</a>'; ?></div>
								</div>
							</div>
						<?php } ?>
			 		<?php } ?>
		 		</div>
		 	</div>
		</div>
		

		<footer>
	    	{{ theme:partial name="footer" }}
	    </footer> 
</body>
</html>