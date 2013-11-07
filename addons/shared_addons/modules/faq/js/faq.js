$(function(){
	itemH = $('#item-list').innerHeight();
	sideH = $('#faq-side').innerHeight();
	
	if(sideH < itemH){
		$('#faq-side').height(itemH);
	}else{
		$('#item-list').height(sideH);
	}
})