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
				
				<h3 id="page-title"><a href="faq">FAQ's</a></h3>
								
				<ul id="faq-side" class="topics left">
					<h5 style="margin-left:10px;"></h5>
					<?php echo $cat_tree; ?>
				</ul>
				
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