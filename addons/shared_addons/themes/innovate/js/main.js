// JavaScript Document

var W;
var H;

$(document).ready(function() {
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
	
	$('.contentWrapper.scroll').css({'height':scrollH + 'px', 'width':'100%'});
	
	setScroller($('.contentWrapper.scroll'), scrollH);
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
			onScrollStart:function(){ $('.contentWrapper.scroll').css({'border-top':'1px solid #EEE', 'border-bottom':'1px solid #EEE'})},
			onScroll:function(){ $('.contentWrapper.scroll').css('border', 'none') },
		}
	});
	
	$('#mCSB_1').css('width', '100%');
	$('.mCSB_container div').css('height', h + 'px');
}