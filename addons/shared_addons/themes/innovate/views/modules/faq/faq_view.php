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

				<h3 id="page-title"><a href="faq">Frequently Asked Questions</a> &raquo; <span style="font-size:.75em;"><a href="faq/group/<?php echo $curr_group->slug?>"><?php echo $curr_group->category?></a></span></h3>
				
				<?php if($faqs != NULL){ ?>
					<div class="faq-item left" style="position: relative; width:auto;">
						<h1 class="faq-subject"><?php echo $faqs->title; ?></h1>
						<div class="faq-content">
							<div class="faq-q"><?php echo $faqs->question; ?></div>
							<div class="faq-a"><?php echo $faqs->answer; ?></div>
						</div>
						
						<div><?php // echo $paging; ?></div>
					</div>
		 		<?php } ?>
		 	</div>
		</div>
		

		<footer>
	    	{{ theme:partial name="footer" }}
	    </footer> 
</body>
</html>