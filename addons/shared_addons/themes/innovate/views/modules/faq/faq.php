<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
	
	<script>
        $(document).ready(function(){
			h = $('#item-list').innerHeight();
			if($('#faq-side').height() < h){
				$('#faq-side').height(h);
			}
        });
	</script>
</head>

<body id="top" class="faq">
	
		{{ integration:analytics }}
	
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>
				
		<div id="content" class="wrapper clearfix">
			<div id="body-wrapper" style="position: relative;" class="clearfix">
				<h3 style="margin-bottom:40px;">Frequently Asked Questions</h3>
				
				<ul id="faq-side" class="left">
					<h5>TOPICS</h5>
					<?php foreach ($cats as $cat){ ?>
						<li><a href="faq/group/<?php echo strtolower($cat->slug); ?>"><?php echo ucwords($cat->category); ?></a></li>				
					<?php } ?>
				</ul>
				
				<div id="item-list" class="left">
					
					<?php if($faqs != NULL){ ?>
						<?php foreach ($faqs as $faq){ ?>
							<div class="faq-item left">
								<div class="faq-subject">&raquo; <?php echo $faq->title; ?><span class="right" style="font-size:.65em; margin-top:5px;"><a href="faq/view/<?php echo $faq->slug; ?>" style="color:#0CE">Read more &raquo;</a></span></div>
								<div class="faq-content">
									<div class="faq-q"><?php echo $faq->question; ?></div>
									<div class="faq-a"><?php echo substr($faq->answer, 0, 100) . ' ...'; ?></div>
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