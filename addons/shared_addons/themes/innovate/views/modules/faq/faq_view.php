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
            //$("#tdata").mCustomScrollbar();
        });
	</script>
</head>

<body id="top" class="faq">
	
		{{ integration:analytics }}
	
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>
				
		<div id="content" class="wrapper clearfix">
			<div id="body-wrapper" style="position: relative;" class="faq-view clearfix">

				<h3 style="margin-bottom:40px;">Frequently Asked Questions</h3>
				
				<ul id="faq-side"  class="left">
					<h5>TOPICS</h5>
					<?php foreach ($cats as $cat){ ?>
						<li><a href="faq/group/<?php echo $cat->slug; ?>"><?php echo ucwords($cat->category); ?></a></li>				
					<?php } ?>
				</ul>
				
				<?php if($faqs != NULL){ ?>
					<div class="faq-item left" style="position: relative; width:50%;">
						<h1 class="faq-view-subject"><?php echo $faqs->title; ?></h1>
						<div class="faq-view-content">
							<div class="faq-q"><?php echo $faqs->question; ?></div>
							<div class="faq-a"><?php echo $faqs->answer; ?></div>
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