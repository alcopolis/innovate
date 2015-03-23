<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
</head>

<body id="top" class="faq-view">
	
		{{ integration:analytics }}
	
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>
				
		<div id="content" class="wrapper">
			<div id="body-wrapper" class="clearfix">

				<h3 id="page-title"><a href="<?php echo base_url(); ?>faq">FAQ's</a> &raquo; <span style="font-size:.85em;"><a href="<?php echo base_url(); ?>faq/category/<?php echo $curr_group->slug?>"><?php echo $curr_group->category?></a></span></h3>
				
				<div id="faq-side"  class="left">
					<ul class="topics">
						<?php foreach ($all_faqs as $faq){ ?>
							<li><a href="<?php echo base_url(); ?>faq/view/<?php echo $faq->slug; ?>"><?php echo ucwords($faq->title); ?></a></li>								
						<?php } ?>
					</ul>
				</div>
				
				<?php if($faqs != NULL){ ?>
					<div id="item-list" class="left">
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