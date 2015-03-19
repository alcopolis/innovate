// JavaScript Document

$(document).ready(function() {
	
	$('html').addClass('csstransforms3d');
	
	// ====================================== Main Menu Setting =======================================//
	
		var menu = $('ul#main-menu.default > li');
		var win = $( window ).width();
		
		$.each(menu, function(){
			var pos = $(this).offset();
			var w = $(this).innerWidth();
			var subW = $(this).children('ul.dropdown').innerWidth();
			var subOffset = 0;
			
			if((pos.left + subW) > win){
				subOffset = subW - w;
				$(this).children('ul.dropdown').css('left', -subOffset);
			}
			
			console.log(pos.left, w, subOffset);
		});
		
		$('ul#main-menu.default > li').mouseenter(function(){
			$(this).children('ul.dropdown').slideDown(400)
		});
		
		$('ul#main-menu.default > li').mouseleave(function(){
			$(this).children('ul.dropdown').slideUp(150)
		});
		
		
		$('ul#main-menu.default li.no-click > a').click(function(e){
			e.preventDefault();
		});
		
		
		
		
		
		$(document).scroll(function(){
			if($(this).scrollTop() > 60){
				$('header').css('box-shadow', '0 1px 10px #999');
			}else{
				$('header').css('box-shadow', 'none');	
			}
		});
		
		
		
		
		//Mobile nav function
		$('ul#main-menu.mobile').height($( window ).height() - 40);
		
		if($('body.mobile').length > 0){
			$('ul#main-menu.mobile li').removeClass('current');
		}
		
		$('body #btn-menu a').live('click', function(e){
			e.stopImmediatePropagation();
			e.preventDefault();
			$('#navigation').slideToggle(0);
			
			if($('#btn-menu').hasClass('open')){
				$('#btn-menu').removeClass('open')
			}else{
				$('#btn-menu').addClass('open')
			}
		});
		
		
		
		$('ul#main-menu.mobile li.has_children > a').live('click', function(e){
			e.preventDefault();
			var current = $(this);
			
			current.children('ul.dropdown').slideToggle();
			
			if(current.hasClass('current')){
				current.removeClass('current');
			}else{
				current.addClass('current');
			}
		});
		
		$('ul#main-menu.mobile li.has_children').live('click', function(){
			var current = $(this);
		
			current.children('ul.dropdown').slideToggle();
			
			if(current.hasClass('current')){
				current.removeClass('current');
			}else{
				current.addClass('current');
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
	
	$('ul#main-menu.mobile').height($( window ).height() - 40);
})


function centerOrbitNav(){
	//Centering orbit bullets position
	winW = $(window).width();
	bulW = $('.orbit-bullets').width();
	
	var bulLeft = (winW - bulW)/2 + 'px';
	$('.orbit-bullets').css({'left': bulLeft, 'margin':'0'});
	//console.log(bulLeft);
}
