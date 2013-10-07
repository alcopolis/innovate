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
});
