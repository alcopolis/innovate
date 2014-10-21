$(function(){
	itemH = $('#item-list').innerHeight();
	sideH = $('#quiz-side').innerHeight();
	
	if(sideH < itemH){
		$('#quiz-side').height(itemH);
	}else{
		$('#item-list').height(sideH);
	}
	
	$('#quiz-side li.has-children').mouseover(function(){
		$(this).children('ul.dropdown').show().addClass('opened');
	});
	
	$('#quiz-side li.has-children').mouseout(function(){
		$(this).children('ul.dropdown').hide();
	});
})