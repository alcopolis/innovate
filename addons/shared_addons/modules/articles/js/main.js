function process(){
	$('#msg-ajax').css('display','none');
	var del = confirm('Upload Poster?');

	if(del){
		var formData = new FormData($('#article-form')[0]);
		
		$.ajax({
			type: 'POST',
			url: 'admin/articles/do_upload',
			processData: false,
		    contentType: false,
			data:formData,
			dataType: 'json',
			success: function(respond) {
				var msg = respond.message;
				
				if(respond.status){
					var msg = respond.message;
					var imgURL = respond.file;
					
					
				}else if(respond.deleted){
					
				}
			},
		});
	}else{
		return false;
	}
}