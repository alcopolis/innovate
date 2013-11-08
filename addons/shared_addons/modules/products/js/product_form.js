$(function () {
			
	// editor switcher
	$('select[name^=editor_type]').live('change', function () {
		
		var chunk = $(this).closest('li.editor');
		var textarea = $('textarea', chunk);

		// Destroy existing WYSIWYG instance
		if (textarea.hasClass('wysiwyg-simple') || textarea.hasClass('wysiwyg-advanced')) {
			textarea.removeClass('wysiwyg-simple');
			textarea.removeClass('wysiwyg-advanced');

			var instance = CKEDITOR.instances[textarea.attr('id')];
			instance && instance.destroy();
		}
		// Set up the new instance
		textarea.addClass(this.value);
		pyro.init_ckeditor();
	});

	$('#new-field').click(function(e){
		e.preventDefault();
		$('#custom-field').append('<p><input type="text" name="" value="Field Name" /> &nbsp; <input type="text" name="" value="Field Value" /></p>');
	});
	
	$(':checkbox').change(function(e){
		if($(this).attr('value') == "0"){
			$(this).attr('value', 1);
		}else{
			$(this).attr('value', 0);
		} 
	})	
})



	function process(){
		$('#msg-ajax').css('display','none');
		var del = confirm('Upload Poster?');
		
		
		if(del){
			var formData = new FormData($('#product-form')[0]);
			
			$.ajax({
				type: 'POST',
				url: 'admin/products/do_upload',
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