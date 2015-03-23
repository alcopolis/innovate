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
				
				<h3 id="page-title"><a href="<?php echo base_url(); ?>faq">Frequently Asked Questions</a></h3>
								
				<div id="faq-side" class="left">
					<?php echo $cat_tree; ?>
				</div>
				
				<div id="item-list" class="left">
					<?php if($faqs != NULL){ ?>	
						<h1><?php echo $curr_group->category; ?></h1>					
						<?php foreach ($faqs as $id=>$faq){ ?>
							<div class="faq-item sub-group">
								<h3>&raquo; <?php echo $faq->category; ?></h3>
								<ul>
									<?php foreach ($faq->sub_faqs as $sub){ ?>
										<li><a href="<?php echo base_url(); ?>faq/view/<?php echo $sub->slug; ?>"><?php echo $sub->title; ?></a></li>
									<?php } ?>
								</ul>
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