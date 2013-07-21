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
	
	$('#featured').orbit({
			 animation: 'fade',                  // fade, horizontal-slide, vertical-slide, horizontal-push
			 animationSpeed: 800,                // how fast animtions are
			 timer: true, 			 // true or false to have the timer
			 advanceSpeed: 10000, 		 // if timer is enabled, time between transitions
			 directionalNav: true, 		 // manual advancing directional navs
			 captions: true, 			 // do you want captions?
			 captionAnimation: 'fade', 		 // fade, slideOpen, none
			 captionAnimationSpeed: 800, 	 // if so how quickly should they animate in
			 bullets: true,			 // true or false to activate the bullet navigation
			 bulletThumbs: false,		 // thumbnails for the bullets
		});
	
});