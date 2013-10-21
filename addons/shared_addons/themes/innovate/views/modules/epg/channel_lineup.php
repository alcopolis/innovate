<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}	
	
	<style type="text/css">		
		body.epg #content{margin-top:80px; min-height:390px;}
		
		body.epg #body-wrapper{
			width:100%;
			position:relative; 
			margin:0 auto; 
			z-index:9000;
			padding-top:0;
			float:none;
		}
		
		#ch-lineup {
		    font-family: "Arial",Helvetica,Tahoma,sans-serif;
		    font-size: 12px;
		    margin: 0 auto;
		    width: 960px;
		}
		
		.ch{
			width:72px; height:72px;
			border:2px solid #FFF;			
			font-size:1em;
			text-align:center;
			margin:5px;
			float:left;
			border-radius:5px;
			color:rgba(32,120,200,.85);
			background:rgba(255,255,255,.85);
			cursor:pointer;
		}
		
		.ch:hover, .ch.selected{
			border:2px solid rgba(32,120,200,.85);
		}
		
	</style>
</head>

<body id="top" class="epg">

		{{ integration:analytics }}
		
		<header class="wrapper">			
			{{ theme:partial name="header" }}
		</header>
				
		<div id="content" class="wrapper clearfix">
		 	<div id="content-bg" style="position:absolute; width:100%; height:auto; background-image:url({{theme:image_path}}epg-bg.jpg); background-repeat: no-repeat; background-size:1920px auto; background-position:center 40px; opacity:0.15; z-index:0;"></div>
		 	<div id="body-wrapper" style="position: relative;">
				<div id="tools">
					<div id="page-title" class="tool"><h4>Channel Lineup</h4></div>
					
					<div id="filter" class="tool">
						<fieldset id="filters">
							
							<style type="text/css">
								.filter{float:left; margin:10px;}
								.filter label{color:#FFF;}
							</style>
							
							<?php echo form_open('epg/channel_lineup'); ?>													
								<div class="filter">
									<label for="cat_id">Channel Category</label>
									<div class="input"><?php echo form_dropdown('cat_id', $cat, set_value('cat_id')); ?></div>
								</div>
								
								<div class="filter">
									<label for="submit">&nbsp;</label>
									<div class="input"><?php echo form_submit('submit', 'View'); ?></div>
								</div>
							<?php echo form_close(); ?>
						</fieldset>
					</div>
					
					<div id="social" class="tool">
						<div id="addthis">
							<!-- AddThis Button BEGIN -->
							<a class="addthis_button" href="http://www.addthis.com/bookmark.php?v=300&amp;pubid=ra-524d3df91ec4307c"><img src="http://s7.addthis.com/static/btn/v2/lg-share-en.gif" width="125" height="16" alt="Bookmark and Share" style="border:0"/></a>
							<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
							<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-524d3df91ec4307c"></script>
							<!-- AddThis Button END -->
						</div>
					</div>
				</div>
					
				<div id="ch-lineup" class="clearfix">
					<div id="list" class="left" style="width:60%;">	
						<div class="clearfix">
							<h4>National FTA</h4>
							{{ epg:ch_lineup category="National FTA" }}
						</div>
						
						<div class="clearfix">
							<h4>International FTA</h4>
							{{ epg:ch_lineup category="International FTA" }}
						</div>
						
<!-- 						<div class="clearfix"> -->
<!-- 							<h4>Movies</h4> -->
<!-- 							{{ epg:ch_lineup category="Movies" }} -->
<!-- 						</div> -->
						
<!-- 						<div class="clearfix"> -->
<!-- 							<h4>Knowledge</h4> -->
<!-- 							{{ epg:ch_lineup category="Knowledge" }} -->
<!-- 						</div> -->
						
<!-- 						<div class="clearfix"> -->
<!-- 							<h4>Entertainment</h4> -->
<!-- 							{{ epg:ch_lineup category="Entertainment" }} -->
<!-- 						</div> -->
						
<!-- 						<div class="clearfix"> -->
<!-- 							<h4>Life Style</h4> -->
<!-- 							{{ epg:ch_lineup category="Life Style" }} -->
<!-- 						</div> -->
						
<!-- 						<div class="clearfix"> -->
<!-- 							<h4>Sports</h4> -->
<!-- 							{{ epg:ch_lineup category="Sports" }} -->
<!-- 						</div> -->
						
<!-- 						<div class="clearfix"> -->
<!-- 							<h4>News</h4> -->
<!-- 							{{ epg:ch_lineup category="News" }} -->
<!-- 						</div> -->
						
<!-- 						<div class="clearfix"> -->
<!-- 							<h4>Kids</h4> -->
<!-- 							{{ epg:ch_lineup category="Kids And Toddler" }} -->
<!-- 						</div> -->
					</div>
					
					<div id="side" class="left" style="width:40%; height:300px; background:#FFF;">
						asdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfasdfas
					</div>
				</div>
			</div>
		</div>
		
		<footer>			
			{{ theme:partial name="footer" }}
		</footer>
</body>
</html>