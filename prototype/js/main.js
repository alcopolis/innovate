// JavaScript Document
$(document).ready(function(e) {
	
	//Nav Menu
	$('nav#menu ul li.has-children').mouseenter(function(e){
		var baseH = $(this).children('div.dropdown').height();
		
		$(this).children('div.dropdown').css('height', 'auto');
		var targetH = $(this).children('div.dropdown').innerHeight();
		
		$(this).children('div.dropdown').css('height', baseH);
		
		$(this).children('div.dropdown').css('display', 'block').slideDown('fast').animate(
			{opacity:1, height:targetH}, 400
		);
	});
	
	$('nav#menu ul li.has-children').mouseleave(function(e){
		$(this).children('div.dropdown').animate(
			{height:40, opacity:0}, 
			200, 
			function(){
				$(this).css('display','none');					
			}
		);
	});
	
	
	
	// Masonry
/*	$('.items').masonry({
	  	columnWidth: 200,
	  	itemSelector: '.featured-item'
	});*/
	
	$('.orbit-slider').orbit({
			 animation: 'fade',  
			 animationSpeed: 800,   
			 timer: true, 			
			 advanceSpeed: 10000, 		
			 directionalNav: true, 		 
			 captions: true, 			 
			 captionAnimation: 'fade', 		 
			 captionAnimationSpeed: 800, 	 
			 bullets: true,			 
			 bulletThumbs: false,
			 fluid:true
		});
	
});