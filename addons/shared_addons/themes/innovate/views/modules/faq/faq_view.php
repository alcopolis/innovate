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
			<div id="body-wrapper" style="position: relative; width:60%;" class="clearfix">
				<h4>Frequently Asked Questions</h4><br/>
				<ul class="left" style="position: relative; width:20%;height:600px;">
					<?php foreach ($cats as $cat){ ?>
						<li><a href="faq/group/<?php echo $cat->slug; ?>"><?php echo ucwords($cat->category); ?></a></li>				
					<?php } ?>
				</ul>
				
				<?php if($faqs != NULL){ ?>
					<div class="faq-item left" style="position: relative; width:60%;">
						<div class="faq-subject"><?php echo $faqs->title; ?></div>
						<div class="faq-content">
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