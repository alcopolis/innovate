function process(){
	$('#msg-ajax').css('display','none');
	var del = confirm('Upload Poster?');
	
	
	if(del){
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
					var msg = respond.message;
					var imgURL = respond.file;
					
					$('#msg-ajax').html(msg).fadeIn(600);
					$('input#poster').attr('value', '')
					
					if($('#img-poster img').length > 0){
						$('#img-poster img').css('display','none').attr('src', imgURL).fadeIn(600);
					}else{
						$('#img-poster').html('<img style="width:300px;" src="' + imgURL + '" />').css('display','none').fadeIn(600);
					}
				}else if(respond.deleted){
					$('#img-poster img').remove();
				}
			},
		});
	}else{
		return false;
	}
}