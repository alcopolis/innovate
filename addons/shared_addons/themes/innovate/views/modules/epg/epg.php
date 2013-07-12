<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}

<script type="text/javascript">
	$(document).ready(function(e) {

		$('.channel').each(function(){
			var temp = $(this).html().truncate(10, false, 'right', '');
			$(this).html(temp);
		})
		
		$('.show div').each(function(){
			var temp = $(this).html().truncate(15, false, 'right', '...');
			$(this).html(temp);
		})

		
		var epgContW = $('#tdata').width();
		var epgContH = $('#tdata').height();

		var blockDataWidth = 240;
		var blockDataMargin = 3;

		var showContW = (blockDataWidth + blockDataMargin) * 26;

		$('#tdata').width(epgContW + 16);
		$('#tdata').height(epgContH + 16);
		$('#tdata .sh-row').width(showContW);

		console.log(showContW);
    });

	fnScroll = function(){
	  $('#theader').scrollLeft($('#tdata').scrollLeft());
	  $('#tcol').scrollTop($('#tdata').scrollTop());
	}
	
</script>

<style type="text/css">
	#epg {width:95%; margin:40px auto; font-size:12px;}
	#origin, #theader, #tcol, #tdata {float:left; margin:.5% 0;}
	
	#origin{width:10%; height:40px;}
	#theader{width:88%; height:40px; overflow:hidden;}
	#tcol{width:10%; height:558px; overflow: hidden;}
	#tdata{width:88%; height:558px; overflow: scroll; background:#111;}
	
	#theader #time-row {width:9000px; height:100%;}
	#theader #time-row .time{width:240px; float:left; margin-right:3px; background:#0CE; color:#FFF;}
	
	#origin, #tcol {margin-right:5px}
	
	#tcol #ch-col{width:100%;}
	#tcol #ch-col .channel{width:100%; text-align:center; color:#FFF; background:#333; margin-bottom:3px; padding:20px 0; border-radius:5px 0 0 5px; overflow:hidden}
	
	#tdata .sh-row{margin-bottom:3px;clear:both; width:9000px;} /* 24hrs x 240px */
	#tdata .sh-row .show{float:left; margin-right:3px; background:rgba(255,255,255,.85); white-space:nowrap;}
</style>
	
</head>

<body id="top" class="epg">

	<!-- Begin pageWrapper -->
	<div id="pageWrapper">
		{{ integration:analytics }}
		
		<!-- Begin Header Content -->
		<div class="partial-wrapper">				
			{{ theme:partial name="header" }}
		</div>
		<!-- End Header Content -->
				
		<!-- Begin contentWrapper -->
		<div class="content-wrapper">
			<?php if($shows != NULL ){ ?>
				<h2>TV GUIDE</h2>
				<div id="epg">
					<div id="origin"></div>
    
				    <div id="theader">
				    	<div id="time-row">
				    		<?php
								for($i=0; $i<25; $i++){
									if($i < 10){
										echo '<div class="time"><div style="margin:10px">0' . $i . ':00</div></div>';	
									}else if($i == 24){
										echo '<div class="time last"><div style="margin:10px">00:00</div></div>';	
									}else{
										echo '<div class="time"><div style="margin:10px">' . $i . ':00</div></div>';
									}
								}
							?>
				    	</div>			        
				    </div>
				    
				    <div id="tcol">
				    	<div id="ch-col">
				    		<?php 
								foreach($shows as $today_show){
									if(count($today_show->sh) > 0 ){
										echo '<div class="channel">' . $today_show->ch->name . '</div>';
									}
								}
							?>
				    	</div>
				    </div>
				    
				    <div id="tdata" onscroll="fnScroll()">
				    	<?php 		
											
							foreach($shows as $today_show){
											
								$sh_data = $today_show->sh;
						
								if(count($sh_data) > 0){
									echo '<div class="sh-row">';
												
									foreach($sh_data as $sh){
										//set block width
										$hms = explode(':', $sh->duration);
										$dur = $hms[0] + ($hms[1]/60) + ($hms[2]/3600);
													
										$title = '';
										$w = floor($dur*240);
													
										if($w < 80){
											$title = substr($sh->title, 0, floor($w/3)) . '..';
										}else{
											$title = $sh->title;
										}
													
										echo '<div id="' . $sh->cid . '" class="show" style="width:' . $w . 'px"><div style="margin:20px 10px">' . $title . '</div></div>';
									}
												
									echo '<br style="clear:both;" /></div>';
								}											
							}
						
						?>
				    </div>
				    
				    <br style="clear: both"/>
				</div>
				
			<?php }else{ ?>
			
				ERROR
			
			<?php } ?>
		</div>
		
		
		<!-- End contentWrapper -->
		
		<!-- Begin Footer Content -->
		<div class="partial-wrapper">			
			{{ theme:partial name="footer" }}
		</div>
		<!-- End Footer Content -->
	</div>
	<!-- End pageWrapper -->

</body>
</html>