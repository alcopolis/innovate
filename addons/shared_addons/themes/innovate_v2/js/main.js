// JavaScript Document

$(document).ready(function() {
	
	$('html').addClass('csstransforms3d');
	
	// ====================================== Main Menu Setting =======================================//
		
		$('ul#main-menu.default > li').mouseenter(function(){
			$(this).children('ul.dropdown').slideDown(400)
		});
		
		$('ul#main-menu.default > li').mouseleave(function(){
			$(this).children('ul.dropdown').slideUp(150)
		});
		
		
		$('ul#main-menu.default li.no-click > a').click(function(e){
			e.preventDefault();
		});
		
		
		
		$('ul#main-menu.mobile').height($( window ).height() - 40);
		
		
		$(document).scroll(function(){
			if($(this).scrollTop() > 60){
				$('header').css('box-shadow', '0 1px 10px #999');
			}else{
				$('header').css('box-shadow', 'none');	
			}
		});
		
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
		
		
		
		// ====================================== Popup ======================================= //
	
		if($('body').hasClass('home')){
			$('#popup').removeClass('hide');	
		}
	
		$('a.pop-close').live('click', function(e){
			e.preventDefault();
			$('#popup').addClass('hide');	
		})
		
		
		
		
		// ====================================== Newsticker ======================================= //
	    
		$(function(){
	    	$("ul#ticker").liScroll({travelocity: 0.1});
        }); 
		
		
		
		// ====================================== Thumbnail Flip ======================================= //
		
		$(function () {
			
			w = $('.thumb').width();
			$('.thumb').height(w);
			
			if ($('html').hasClass('csstransforms3d')) {	
				$('.thumb').removeClass('scroll').addClass('flip');		
				$('.thumb.flip').hover(
					function () {
						$(this).find('.thumb-wrapper').addClass('flipIt');
					},
					function () {
						$(this).find('.thumb-wrapper').removeClass('flipIt');			
					}
				);
			} else {
				$('.thumb').hover(
					function () {
						$(this).find('.thumb-detail').stop().animate({bottom:0}, 500, 'easeOutCubic');
					},
					function () {
						$(this).find('.thumb-detail').stop().animate({bottom: ($(this).height() * -1) }, 500, 'easeOutCubic');			
					}
				);
			}
		});
		
});


$(window).resize(function(){
	centerOrbitNav();
	
	w = $('.thumb').width();
	$('.thumb').height(w);
})


function centerOrbitNav(){
	//Centering orbit bullets position
	winW = $(window).width();
	bulW = $('.orbit-bullets').width();
	
	var bulLeft = (winW - bulW)/2 + 'px';
	$('.orbit-bullets').css({'left': bulLeft, 'margin':'0'});
	//console.log(bulLeft);
}
