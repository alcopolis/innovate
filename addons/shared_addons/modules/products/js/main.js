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
				showPopup($(this).attr('href'));
				break;
			case 'attch-link' :
				gotoURL($(this).attr('href'));
				break;
		}
	});
})

function openTab(id){
	$(id).css('display', 'block').removeClass('hide');
	$(id).css('display', 'block').addClass('active');	
}


// Attachment function
function showPopup(url){
	console.log(url);
}

function gotoURL(url){
	console.log(url);
}