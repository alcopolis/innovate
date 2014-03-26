// JavaScript Document

$(document).ready(function() {
	
	// ====================================== Main Menu Setting =======================================//
		
		$('ul#main-menu > li').mouseenter(function(){
			$(this).children('ul.dropdown').slideDown(400)
		})
		
		$('ul#main-menu > li').mouseleave(function(){
			$(this).children('ul.dropdown').slideUp(150)
		})
		
		
		$(document).scroll(function(){
			console.log($(this).scrollTop());
			if($(this).scrollTop() > 60){
				$('header').css('box-shadow', '0 1px 10px #999');	
			}else{
				$('header').css('box-shadow', 'none');	
			}
		})
		
	// ====================================== Orbit Slider ======================================= //
		
		$('.orbit-slider').orbit({
			 animation: 'fade',  
			 animationSpeed: 800,   
			 timer: true, 			
			 advanceSpeed: 8000, 		
			 directionalNav: false, 		 
			 captions: true, 			 
			 captionAnimation: 'fade', 		 
			 captionAnimationSpeed: 800, 	 
			 bullets: true,			 
			 bulletThumbs: true,
			 fluid:true
		});
		
		centerOrbitNav();
});


$(window).resize(function(){
	centerOrbitNav();
})


function centerOrbitNav(){
	//Centering orbit bullets position
	winW = $(window).width();
	bulW = $('.orbit-bullets').width();
	
	var bulLeft = (winW - bulW)/2 + 'px';
	$('.orbit-bullets').css({'left': bulLeft, 'margin':'0'});
	//console.log(bulLeft);
}
