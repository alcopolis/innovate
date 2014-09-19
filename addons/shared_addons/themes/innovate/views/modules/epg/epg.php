<!DOCTYPE html>
<html>
<head>
	{{ if alcopolis:site_status }}
		{{ theme:partial name="metadata" }}
	{{ else }}
		{{ theme:partial name="maintenance" }}
	{{ endif }}
</head>
<body id="top" class="epg">
		{{ integration:analytics }}
	 	<header class="wrapper">
	 		{{ theme:partial name="header" }}
	 	</header>

		 <div id="content" class="wrapper clearfix">
		 	<div id="content-bg" style="position:absolute; width:100%; height:auto; background:#EFEFEF;"></div>
		 	<div id="body-wrapper" style="position: relative;">
				<?php if($shows != NULL ){ ?>
					<div id="tools">
						<div id="filter" class="tool">
							<fieldset id="filters">
								<?php echo form_open('epg/'); ?>					
									<div class="filter">
										<label for="date">Tanggal</label>
										<div class="input"><?php echo form_input('date', set_value('date', date('Y-m-d')), 'class="datepicker" maxlength="20"'); ?></div>
									</div>
									<div class="filter">
										<label for="cat_id">Kategori</label>
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
								<!-- AddThis Button END -->
							</div>
						</div>
					</div>
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
											echo '<div class="channel" title="' . $today_show->ch->name . '">' . $today_show->ch->name . '</div>';
										}
									}
								?>
					    	</div>
					    </div>
					    <div id="tdata" onscroll="fnScroll()">
					    	<?php 		
								if(count(get_object_vars($shows)) > 0){				
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
													echo '<div class="past-show" style="width:' . $w . 'px; height: 59px; background:#666; float:left; border-radius:0 5px 5px 0; outline:1px solid #333;">&nbsp;</div>';
													$hms = explode(':', $sh->duration);
													$dur = $hms[0] + ($hms[1]/60) + ($hms[2]/3600);
													$w = floor($dur*240);
													$title = substr($sh->title, 0, floor($w/3)) . '..';
													echo '<div class="'.$sh->cid.' show" style="width:' . $w . 'px"  data-title="'. $sh->title.'" data-id="'. $sh->syn_id.'" data-en="'.$sh->syn_en.'" data-url="epg/show/' . $sh->id . '" data-time="' . date('H:i' , strtotime($sh->time)) . '"><div style="margin:20px 10px">' . $title . '</div></div>';
													$first = FALSE;
												}else{
													$hms = explode(':', $sh->duration);
													$dur = $hms[0] + ($hms[1]/60) + ($hms[2]/3600);
													$w = floor($dur*240);
													$title = substr($sh->title, 0, floor($w/3)) . '..';
													echo '<div class="'.$sh->cid.' show" style="width:' . $w . 'px"  data-title="'. $sh->title.'" data-id="'. $sh->syn_id.'" data-en="'.$sh->syn_en.'" data-url="epg/show/' . $sh->id . '" data-time="' . date('H:i' , strtotime($sh->time)) . '"><div style="margin:20px 10px">' . $title . '</div></div>';
													$first = FALSE;
												}
											}
											echo '<br style="clear:both;" /></div>';
										}											
									}
								}else{
									echo 'Mohon maaf, saat ini jadwal acara belum tersedia.';
								}
							?>
					    </div>
					    <br class="clear"/>
						<div id="detail-container">
							<p id="title"></p>
					    	<p id="id"></p>
					    	<hr>
					    	<p id="en"></p>
					    </div>
					</div>
				</div>
				
			<?php }else{ ?>
					<!-- ERROR -->
			<?php } ?>
		</div>
		<footer>
	    	{{ theme:partial name="footer" }}
	    </footer> 
</body>
</html>