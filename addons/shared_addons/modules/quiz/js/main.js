$(document).ready(function(){	
	h = $('#body-wrapper .item').width() * 0.75;
	$('#body-wrapper .item').height(h);
	
	$('a#close-popup').click(function(e){
		e.preventDefault();
		$('#popup').addClass('hide');
	});
	
	$('a#open-popup').click(function(e){
		e.preventDefault();
		$('#popup').removeClass('hide');
	})
});

function openPopup(e){
	e.preventDefault();
	$('#popup').removeClass('hide');
}