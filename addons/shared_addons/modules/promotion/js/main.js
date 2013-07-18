function process(){
	//console.log('asdfasdfas');
	
	$('#msg-ajax').css('display','none');
	
	var formData = new FormData($('#promo-form')[0]);
	
	$.ajax({
		type: 'POST',
		url: 'admin/promotion/do_upload',
		processData: false,
	    contentType: false,
		data:formData,
		dataType: 'json',
		success: function(respond) {
			var msg = respond.message;
			
			if(respond.status){
				msg = respond.message;
				$('#msg-ajax').html(msg).fadeIn(600);
				$('input#poster').attr('value', '')
			}
			
			
		},
	});
}