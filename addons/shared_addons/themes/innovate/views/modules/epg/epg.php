<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
	
	<style type="text/css">
		#epg{margin:0 auto;}
		#epg tr, #epg tr td, #epg div{margin:0; padding:0;}
		#firstTd{width:140px;}
		
		#epg #divHeader{width:1200px; overflow:hidden;}
		#epg #divHeader table{width:5760px; margin:0; padding:0;}
		.tableHeader{width:240px; height:40px; background:#333; color:#FFF; padding:0 5px !important;}
		
		
		#epg #tableDiv{width:1200px; overflow:auto;}
		#epg #tableDiv table{width:5760px; margin:0; padding:0;}
		
		td.channel{width:140px; height:40px; background:#111; color:#FFF; font-size:12px; padding:5px !important;}
		td.show{height:40px; max-height:40px; background:#333; color:#FFF; font-size:12px; padding:5px !important;}
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
			
				<table id="epg">
					<tr>
						<td id="firstTd"></td>
						<td>
      						<div id="divHeader">
      							<table>
      								<tr>
      									<?php 
      										for($i=0; $i<24; $i++){ 
												if($i<10){
													echo '<td class="tableHeader">0' . $i . ':00</td>';
												}else{
													echo '<td class="tableHeader">' . $i . ':00</td>';
												}
      										}
      									?>
      								</tr>	
      							</table>
      						</div>
      					</td>
					</tr>
					
					<tr>
						<td valign="top">
							<div id="firstcol">
						        	<?php 
						        		foreach($shows as $today_show){
											if(count($today_show->sh) > 0 ){
        										echo '<table><tr><td class="channel" style="text-align:center" valign="middle">' . $today_show->ch->name . '</td></tr></table>';
        									}
        								}
      								?>
					    	</div>
						</td>
						
						<td valign="top">
      						<div id="tableDiv" >
      								<?php 		
											
											foreach($shows as $today_show){
												
												$sh_data = $today_show->sh;
												
												
												
												if(count($sh_data) > 0){
													echo '<table><tr>';
													
													foreach($sh_data as $sh){
														//set block width
														$hms = explode(':', $sh->duration);
														$dur = $hms[0] + ($hms[1]/60) + ($hms[2]/3600);
														
														$title = '';
														$w = floor($dur*240);
														
														if($w < 80){
															$title = substr($sh->title, 0, floor($w/3)) . '...';
														}else{
															$title = $sh->title;
														}
														
														echo '<td valign="middle" class="show" style="width:' . $w . 'px">' . $title . '</td>';
													}
													
													echo '</tr></table>';
												}												
											}

      								?>
      						</div>
      					</td>
					</tr>
				</table>
				
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