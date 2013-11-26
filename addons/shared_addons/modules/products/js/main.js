var packPrice = new Array();
var packCont = '';
var net;
var tv;

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
	$('#package').children('.pack-container:first').removeClass('hide');
	$('#package').children('.pack-container:first').addClass('active');
	
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
	$(':radio').click(function(){
		
		if($(this).attr('name') == 'internet-super-cepat'){
			net = $(this).val();
		}else if($(this).attr('name') == 'interactive-tv'){
			tv = $(this).val();
		}
		
		
		if(net != 0 || tv != 0){
			$('#pack-info').show();

			var title = '';
			var desc = '';
			var add = '';
			var price = '';
			
			$.ajax({
				type: 'GET',
				url: 'subscribe/pack_info/?net=' + net + '&tv=' + tv,
				dataType: 'json',
				success: 
					function(respond) {			

						price = (Number(respond.data.net.price) + Number(respond.data.tv.price)) * 0.9;
						console.log(price);
						if(respond.bundle){
							title = '<span class="bundle">Bundle &raquo;</span> ' + respond.data.net.name + ' & ' + respond.data.tv.name;
							desc = 'Paket bundle layanan ' + respond.data.net.name.toLowerCase() + ' ' + respond.data.net.body.toLowerCase() + ' + ' + respond.data.tv.body.toLowerCase();
							add = '<small style="color:#C00"><strong>Diskon 10% selama masa promosi.</strong></small>';
						}else{
							title = respond.data.name;
							desc = respond.data.body;
							add = '';
						}

						$('#pack-info #price').html('Rp ' + price);
						//$('#pack-info #pack-desc').html(desc);
						//$('#pack-info #additional-info').html(add);
					},
			});
		}else{
			$('#pack-info #pack-name').html('');
			$('#pack-info').hide();
		}
	});
	
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