$(function(){
	itemH = $('#item-list').innerHeight();
	sideH = $('#faq-side').innerHeight();
	
	if(sideH < itemH){
		$('#faq-side').height(itemH);
	}else{
		$('#item-list').height(sideH);
	}
	
	$('#faq-side li.has-children').mouseover(function(){
		$(this).children('ul.dropdown').show().addClass('opened');
	});
	
	$('#faq-side li.has-children').mouseout(function(){
		$(this).children('ul.dropdown').hide();
	});
})