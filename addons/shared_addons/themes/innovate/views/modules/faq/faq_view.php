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

				<h3 id="page-title"><a href="faq">FAQ's</a> &raquo; <span style="font-size:.75em;"><a href="faq/group/<?php echo $curr_group->slug?>">Topics</a></span></h3>
				
				<ul id="faq-side" class="faq left">
					<h5 style="margin-left:10px;"><?php echo $curr_group->category?></h5>
					<?php foreach ($all_faqs as $faq){ ?>
						<li><a href="faq/view/<?php echo $faq->slug; ?>"><?php echo ucwords($faq->title); ?></a></li>								
					<?php } ?>
				</ul>
				
				<?php if($faqs != NULL){ ?>
					<div id="item-list" class="left" style="border-left:3px solid #EEE;">
						<div class="faq-item" style="border-left:none;">
							<h1 class="faq-subject"><?php echo $faqs->title; ?></h1>
							<div class="faq-content">
								<div class="faq-q"><?php echo $faqs->question; ?></div>
								<div class="faq-a"><?php echo $faqs->answer; ?></div>
							</div>
						</div>
					</div>
		 		<?php } ?>
		 	</div>
		</div>
		

		<footer>
	    	{{ theme:partial name="footer" }}
	    </footer> 
</body>
</html>