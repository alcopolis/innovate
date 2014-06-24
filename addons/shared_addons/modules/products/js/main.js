var packPrice = new Array();
var packCont = '';
var net;
var tv;
var themeurl = 'addons/shared_addons/themes/innovate/';

$(function(){
	//Set Packages Container Height
	$container = $('.pack-item');
	var highest = 0;
	
	$container.each(function(){
		if($(this).children('section').height() > highest){
			highest = $(this).children('section').height();
		}
	})

	$container.each(function(){
		$(this).children('section').height(highest);
	})
	
	
	
	//Set tab data
	$('.pack-container').addClass('hide');
	$('#pack-nav li:first').addClass('current');
	$('.package').children('.pack-container:first').removeClass('hide');
	$('.package').children('.pack-container:first').addClass('active');
	
	//Tab click
	$('#pack-nav li').click(function(e){
		e.preventDefault();
		
		$('#pack-nav li.current').removeClass('current');
		$('.pack-container.active').css('display', 'none').removeClass('active');
		$('.pack-container.active').css('display', 'none').addClass('hide')
		
		var link = $(this).children('a').attr('href');
		$(this).addClass('current');
		openTab(link);	
	})
	
	
	//Attachment click
	$('#attachment a').click(function(e){
		e.preventDefault();
		
		switch ($(this).attr('class')){
			case 'attch-popup' :
				showPopup($(this).attr('href'), $(this).attr('data-mimetype'));
				break;
			case 'attch-link' :
				gotoURL($(this).attr('href'));
				break;
		}
	});
	
	
	//Pop-up close button
	$('.close-btn').click(function(){
		$('#popup').addClass('hide')
	});
	
	$('#popup').click(function(e){
		if (e.target !== this) return;
		
		$(this).addClass('hide')
		
		if($('#popup-container *').length > 0){
			$('#popup-container').flash().remove();
			$('#popup-container').html('');
		}
	});
	
	
	//Bundle widget
	var subscribe_btn_url = $('#pack-info #subscribe a').attr('href');
	
	$(':radio').click(function(){
		
		if($(this).attr('name') == 'internet-super-cepat'){
			net = $(this).val();		
		}else if($(this).attr('name') == 'interactive-tv'){
			tv = $(this).val();
		}
		
		if(net != null && tv != null){
			$('#pack-info').show();

			var title = '';
			var price = '';
			
			$.ajax({
				type: 'GET',
				url: 'subscribe/pack_info/?net=' + net + '&tv=' + tv,
				dataType: 'json',
				success: 
					function(respond) {	
						var priceFormatted = '';
					
						price = (Number(respond.data.net.price) + Number(respond.data.tv.price)) * 0.9;
						accountingjs = themeurl + 'js/accounting.min.js'
						
						$.getScript(accountingjs, function() {
							if(respond.bundle){
								title = 'Internet ' + respond.data.net.name + ' & TV Starter ' + respond.data.tv.name;
							}else{
								title = respond.data.name;
							}
							
							$('#pack-info #title').html(title);
							$('#pack-info #price').html(accounting.formatMoney(price, "Rp ", 0, ".", ","));	
							
							url = subscribe_btn_url + '?net=' + net + '&tv=' + tv;
							$('#pack-info #subscribe a').attr('href', url);
						});
					},
			});
		}else{
			$('#pack-info #pack-name').html('');
			$('#pack-info').hide();
		}
	});
	
	
	
	//View Ch List by Packages
	$('a.view-list-ch').click(function(e){
		var pack = $(this).attr('data-ch-list');
		console.log(pack);
	});

	
//	$('#subscribe a').click(function(e){
//		e.preventDefault;
//		url = $(this).attr('href');
//		
//	})
})



//Bundle widget
function countBundle(pack){
	packCont = $(pack).parent().parent().attr('id');
	packPrice[packCont] = Number($(pack).val());
	radio = $(pack).parent().parent().children('div');
	
//	radio.each(function(){
//		$(this).children('input[type="radio"]').attr('checked',false);
//	})
//	
//	$(pack).attr('checked', true);
	
//	$(packPrice).each(function(){
//		//totalPrice = totalPrice + packPrice[packCont];
//		console.log(packPrice);
//	})
	
//	console.log(packPrice['packs-1']);
	
//	for(var i=0; i<=packPrice.length; i++){
//		key = 'packs-' + String(i);
//		console.log(i);
//		//console.log(packPrice[key]);
//	}
	
	
	//console.log(price);
}



function openTab(id){
	$(id).css('display', 'block').removeClass('hide');
	$(id).css('display', 'block').addClass('active');	
}


// Attachment function
function showPopup(url, mime){
	$('#popup').removeClass('hide');
	
	if(mime == 'x-shockwave-flash'){
		$('#popup-container').append('<p style="text-align:center">You browser does not support flash.</p>')
		$('#popup-container').flash(
			{	
				swf: url,
				width: 940,
				height: 480,
			});
	}else if(mime == 'mp4' || mime == 'ogg' || mime == 'webm'){
		 // create player
		$('#popup-container').append('<video id="player" src="' + url + '" width="940" height="480" controls="controls" preload="none"></video>');
		
		
		$('#player').mediaelementplayer({
	        // add desired features in order
	        features: ['playpause','current','progress','duration', 'fullscreen', 'volume', 'backlight'],
	        // the time in milliseconds between re-drawing the light
	        //backlightTimeout: 100
	    });
	}
}


function gotoURL(url){
	console.log(url);
}


function getList(){
	
}