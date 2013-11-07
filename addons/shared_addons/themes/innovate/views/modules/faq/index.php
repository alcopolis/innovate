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

				<h3 id="page-title">FAQ's</h3>
				
				<ul id="faq-side" class="topics left">
					<h5 style="margin-left:10px;">FAQ Topics</h5>
					<?php foreach ($cats as $cat){ ?>
						<li><a href="faq/group/<?php echo $cat->slug; ?>"><?php echo ucwords($cat->category); ?></a></li>
					<?php } ?>
				</ul>
				
				<div id="item-list" class="left">
					<p>Temukan jawaban dari pertanyaan-pertanyaan Anda yang sering juga ditanyakan oleh pelanggan lainnya.
					Hubungi Customer Care Innovate bila pertanyaan Anda belum terjawab oleh FAQ ini.</p>
					
					<h4 style="color:#333; text-shadow:0 -1px 1px #999; font-size:2em; margin-top:30px;">Popular FAQs</h4>
					<?php if($faqs != NULL){ ?>
						<?php foreach ($faqs as $faq){ ?>
							<div class="faq-item">
								<div class="faq-subject"><a href="faq/view/<?php echo $faq->slug; ?>"><?php echo $faq->title; ?></a></div>
								<div class="faq-content">
									<div class="faq-q"><?php echo $faq->question; ?></div>
									<div class="faq-a"><?php echo substr(strip_tags ($faq->answer), 0, 200) . '... <a href="faq/view/' . $faq->slug . '">read &raquo</a>'; ?></div>
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