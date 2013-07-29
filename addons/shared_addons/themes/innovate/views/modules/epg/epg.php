<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}

<script type="text/javascript">
	fnScroll = function(){
	  $('#theader').scrollLeft($('#tdata').scrollLeft());
	  $('#tcol').scrollTop($('#tdata').scrollTop());
	}

	$(document).ready(function(){

		var t;
				
		$('.epg .show').each(function(){
			$(this).click(function(e){
				clearTimeout(t);
				
				boxpos = $(this).position();

				$(this).append($('#detail-container'));

				$('#detail-container').css({'top':boxpos.top + 70 + 'px', 'left':boxpos.left + 'px'})
			
				title = $(this).attr('data-title');
				$('#detail-container p#title').html(title);
			
				
				if($(this).attr('data-id') != ''){
					synid = $(this).attr('data-id');
					$('#detail-container p#id').html(synid);
					$('#detail-container hr').show();
				}else{
					$('#detail-container hr').hide();
					$('#detail-container p#id').html('');
				}
				
				if($(this).attr('data-en') != ''){
					synen = $(this).attr('data-en');
					$('#detail-container p#en').html(synen);
					$('#detail-container hr').show();
				}else{
					$('#detail-container hr').hide();
					$('#detail-container p#en').html('');
				}


				$('#detail-container').css('display', 'block').animate(
					{opacity:1}
				)
				
			})

			$(this).mouseleave(function(){
				t = setTimeout(hide, 3000)
			})
		})

		function hide(){
			console.log('hide');
			clearTimeout(t);
			
			$('#detail-container').animate(
 				{opacity:0},400,function(){
 					$(this).css('display', 'none');
 				}
 			)
		}
	})
</script>

<style type="text/css">
	#epg {width:95%; margin:40px auto; font-size:12px;}
	#origin, #theader, #tcol, #tdata {float:left; margin:.5% 0;}
	
	#origin{width:10%; height:40px;}
	#theader{width:88%; height:40px; overflow:hidden;}
	#tcol{width:10%; height:558px; overflow: hidden;}
	#tdata{width:88%; height:558px; overflow: scroll; background:#111;}
	
	#theader #time-row {width:9000px; height:100%;}
	#theader #time-row .time{width:240px; float:left; border-radius:5px; outline:1px solid #FFF; background:#0CE; color:#FFF;}
	
	#origin, #tcol {margin-right:5px}
	
	#tcol #ch-col{width:100%;}
	#tcol #ch-col .channel{width:100%; text-align:center; color:#FFF; background:#333; margin-bottom:3px; padding:20px 0; border-radius:5px 0 0 5px; overflow:hidden}
	
	#tdata .sh-row{margin-bottom:3px;clear:both; width:9000px;} /* 24hrs x 240px */
	#tdata .sh-row .show{float:left; cursor:pointer; border-radius:5px; outline:1px solid #111; background:rgba(255,255,255,.85); white-space:nowrap;}
	#tdata .sh-row .show:hover{background:#39C; color:#FFF}
	#tdata .sh-row .show.active{background:#39F; color:#FFF}
	
	#detail-container{position:absolute; width:300px; background:#FFF; box-shadow:0 0 3px #333; border-radius:5px; opacity:0; display:block}
	#detail-container p#title{font-size:14px; font-weight:bold;color:#39C;}
	#detail-container p{margin:10px !important; padding:0; white-space:normal;color:#717174;}
</style>
	
</head>

<body id="top" class="epg">
	
		{{ integration:analytics }}
	
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>
				
		 <div id="content" class="wrapper clear">
		 	<div id="body-wrapper">
				<?php if($shows != NULL ){ ?>
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
										
										$first = TRUE;
													
										foreach($sh_data as $sh){
											$hms = explode(':', $sh->time);
	 										$time = $hms[0] + ($hms[1]/60) + ($hms[2]/3600);
											 
											if($first && $time > 0){
												$w = floor($time*240);
												echo '<div class="past-show" style="width:' . $w . 'px; height: 59px; background:#666; float:left; border-radius:0 5px 5px 0; outline:1px solid #111;">&nbsp;</div>';
												
												$hms = explode(':', $sh->duration);
												$dur = $hms[0] + ($hms[1]/60) + ($hms[2]/3600);
												$w = floor($dur*240);
												$title = substr($sh->title, 0, floor($w/3)) . '..';
												
												echo '<div class="'.$sh->cid.' show" style="width:' . $w . 'px"  data-title="'. $sh->title.'" data-id="'. $sh->syn_id.'" data-en="'.$sh->syn_en.'"><div style="margin:20px 10px">' . $title . '</div></div>';
												
												$first = FALSE;
											}else{
												$hms = explode(':', $sh->duration);
												$dur = $hms[0] + ($hms[1]/60) + ($hms[2]/3600);
												$w = floor($dur*240);
												$title = substr($sh->title, 0, floor($w/3)) . '..';
												
												echo '<div class="'.$sh->cid.' show" style="width:' . $w . 'px"  data-title="'. $sh->title.'" data-id="'. $sh->syn_id.'" data-en="'.$sh->syn_en.'"><div style="margin:20px 10px">' . $title . '</div></div>';
												
												$first = FALSE;
											}
											
										}
													
										echo '<br style="clear:both;" /></div>';
									}											
								}
							
							?>
					    </div>
											    
					    <br style="clear: both"/>
					    
					    
						<div id="detail-container">
							<p id="title"></p>
					    	<p id="id"></p>
					    	<hr>
					    	<p id="en"></p>
					    </div>
					</div>
				</div>
				
			<?php }else{ ?>
			
				ERROR
			
			<?php } ?>
		</div>
		

		<footer>
	    	{{ theme:partial name="footer" }}
	    </footer> 
</body>
</html>