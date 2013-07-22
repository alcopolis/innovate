// JavaScript Document

$(document).ready(function() {
	
	// ====================================== Main Menu Setting =======================================//
		
		var dropdown = $('.has_children > .dropdown');
		dropdown.each(function(){
			$(this).removeClass('dropdown').wrap('<div class="dropdown-wrapper" />');
		});
		
		
		//Nav Menu
		$('nav#menu > ul li.has_children').mouseenter(function(e){
			var baseH = $(this).children('div.dropdown-wrapper-wrapper').height();
			
			$(this).children('div.dropdown-wrapper').css('height', 'auto');
			var targetH = $(this).children('div.dropdown-wrapper').innerHeight();
			
			$(this).children('div.dropdown-wrapper').css('height', baseH);
			
			$(this).children('div.dropdown-wrapper').css('display', 'block').slideDown('fast').animate(
				{opacity:1, height:targetH}, 400
			);
		});
		
		$('nav#menu > ul li.has_children').mouseleave(function(e){
			$(this).children('div.dropdown-wrapper').animate(
				{height:40, opacity:0}, 
				200, 
				function(){
					$(this).css('display','none');					
				}
			);
		});
	
		
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
		
});
