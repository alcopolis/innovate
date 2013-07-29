// JavaScript Document

$(document).ready(function() {
	
	// ====================================== Main Menu Setting =======================================//
		
		$('ul#main-menu > li').mouseenter(function(){
			$(this).children('ul.dropdown').slideDown(400)
		})
		
		$('ul#main-menu > li').mouseleave(function(){
			$(this).children('ul.dropdown').slideUp(150)
		})
	
		
	// ====================================== Orbit Slider ======================================= //
		
		$('.orbit-slider').orbit({
			 animation: 'fade',  
			 animationSpeed: 800,   
			 timer: true, 			
			 advanceSpeed: 5000, 		
			 directionalNav: false, 		 
			 captions: true, 			 
			 captionAnimation: 'fade', 		 
			 captionAnimationSpeed: 800, 	 
			 bullets: true,			 
			 bulletThumbs: false,
			 fluid:true
		});
		
		
		
		
		// ==================================== EPG TABLE ==========================================//
		
		if($('#epg').length > 0){
			$('.channel').each(function(){
				var temp = $(this).html().truncate(10, false, 'right', '');
				$(this).html(temp);
			});
			
			$('.show div').each(function(){
				var temp = $(this).html().truncate(15, false, 'right', '...');
				$(this).html(temp);
			});
	
			
			var epgContW = $('#tdata').width();
			var epgContH = $('#tdata').height();
	
			var blockDataWidth = 240;
			var blockDataMargin = 3;
	
			var showContW = (blockDataWidth + blockDataMargin) * 26;
	
			$('#tdata').width(epgContW + 16);
			$('#tdata').height(epgContH + 16);
			$('#tdata .sh-row').width(showContW);
		}

//		fnScroll = function(){
//			console.log($('#theader').scrollLeft());
//			$('#theader').scrollLeft($('#tdata').scrollLeft());
//			$('#tcol').scrollTop($('#tdata').scrollTop());
//		}
		
});
