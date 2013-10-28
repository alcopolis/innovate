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
						<li><a href="faq/group/<?php echo $cat->category; ?>"><?php echo ucwords($cat->category); ?></a></li>				
					<?php } ?>
				</ul>
				
				<?php if($faqs != NULL){ ?>
					<?php foreach ($faqs as $faq){ ?>
						<div class="faq-item left" style="position: relative; width:60%;">
							<div class="faq-subject"><?php echo $faq->title; ?><span class="right" style="font-size:.65em; margin-top:5px;"><a href="">Read more &raquo;</a></span></div>
							<div class="faq-content">
								<div class="faq-q"><?php echo $faq->question; ?></div>
								<div class="faq-a"><?php echo $faq->answer; ?></div>
							</div>
						</div>
					<?php } ?>
		 		<?php } ?>
		 	</div>
		</div>
		

		<footer>
	    	{{ theme:partial name="footer" }}
	    </footer> 
</body>
</html>