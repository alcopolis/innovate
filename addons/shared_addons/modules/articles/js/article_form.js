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

	
	$(':checkbox').change(function(e){
		if($(this).attr('value') == "0"){
			$(this).attr('value', 1);
		}else{
			$(this).attr('value', 0);
		} 
	})
	
	$('.overlay, #cboxClose').click(function(e){
		if(e.target != this) return;
		$('#category-add').addClass('hide');
	})
})


function addCategory(){
	$('#category-add').removeClass('hide');
	
	var boxLeft = ($(window).width() - $('.popupbox').width())/2;
	$('.popupbox').css({'left':boxLeft});
}

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
