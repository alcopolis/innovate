// JavaScript Document

var W;
var H;

$(document).ready(function() {
	
	$('ul#main-menu li').mouseover(function(){
		$(this).children('ul.dropdown').show();
	//	$(this).css('background', '#000');
	});
	
	$('ul#main-menu li').mouseout(function(){
		$(this).children('ul.dropdown').hide();
		//$(this).css('background', 'none');
	});
	
	//$('#cam_wrapper').camera();
	
	$feat = $('.featured');
	console.log($feat);
	$('.featured').each(function(){
		if($(this).html() == ''){
			$(this).remove();
		}
	})
		
	setLayout();
});

$(window).resize(function() {
	setLayout();
});

function setLayout(){
	W = $(window).width();
	H = $(window).height();
	
	var scrollH ;
		
	if(W > 1366){
		scrollH = Math.round(H * 0.7);
		$('#pageWrapper').css('width','75%');
	}else if(W <= 1366){
		scrollH = 500;
		$('#pageWrapper').css('width','1024px');
	}
	
	$('.content-wrapper.scroll').css({'height':scrollH + 'px', 'width':'100%'});
	
	setScroller($('.content-wrapper.scroll'), scrollH);
}

function setScroller(elm, h){
	var $element = elm;
		
	/* destroy */	
	if($($element).hasClass('mCustomScrollbar')){
		$($element).mCustomScrollbar("destroy");
	}
	
	$($element).mCustomScrollbar({
		autoHideScrollbar:true,
		theme: 'dark',
		verticalScroll:true,
		scrollInertia: h*2,
		mouseWheelPixels: h,
		snapAmount:h,
        snapOffset: 1,
	  	scrollButtons:{
			enable:true,
			scrollType:"continuous",
            scrollAmount:h
		},
		callbacks:{
			onScrollStart:function(){ $('.content-wrapper.scroll').css({/*'border-top':'1px solid #EEE', 'border-bottom':'1px solid #EEE'*/})},
			onScroll:function(){ $('.content-wrapper.scroll').css('border', 'none') },
		}
	});
	
	$('#mCSB_1').css('width', '100%');
	$('.mCSB_container div.scroll-content').css('height', h + 'px');

	
}