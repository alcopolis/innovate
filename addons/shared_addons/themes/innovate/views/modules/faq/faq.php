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
				
				<h3 id="page-title"><a href="faq">Frequently Asked Questions</a></h3>
								
				<div id="faq-side"  class="left">
					<?php echo $cat_tree; ?>
					
					<div id="hotline" class="util-item last" style="width:100%; text-align:center; position:absolute; bottom:10px;">
						<a href="{{ url:site }}contact"><img src="{{ theme:image_path }}cs.png" style="width:80px;"/></a>
						<p style="margin:0 0 -10px 0;">
							<strong>Customer Care</strong><br/>
							<span style="font-size:1.2em; font-weight:bold; color:#39C; line-height:1.5em">[ 021 ] 3199 8600</span>
						</p>
					</div>
				</div>
				
				<div id="item-list" class="left">
					<h1><?php echo $curr_group->category; ?></h1>
					<?php if($faqs != NULL){ ?>
						<?php foreach ($faqs as $faq){ ?>
							<div class="faq-item">
								<div class="faq-subject"><a href="faq/view/<?php echo $faq->slug; ?>"><?php echo $faq->title; ?></a></div>
								<div class="faq-content">
									<div class="faq-q"><?php echo $faq->question; ?></div>
									<div class="faq-a">
										<?php echo substr(strip_tags ($faq->answer), 0, 200) . '...'; ?><br/><br/>
										<span class="more"><a href="faq/view/<?php echo $faq->slug;?>">Baca Selengkapnya &raquo;</a></span>
									</div>
								</div>
							</div>
						<?php } ?>
			 		<?php } ?>
		 		</div>
		 		
		 		<div style="clear:both"></div>
		 	</div>
		</div>
		

		<footer>
	    	{{ theme:partial name="footer" }}
	    </footer> 
</body>
</html>