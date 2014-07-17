(function ($) {
	$(function () {
		// editor switcher
		$('select[name^=editor_type]').live('change', function () {
			var chunk = $(this).closest('li.editor');			var textarea = $('textarea', chunk);
			// Destroy existing WYSIWYG instance			if (textarea.hasClass('wysiwyg-simple') || textarea.hasClass('wysiwyg-advanced')) {				textarea.removeClass('wysiwyg-simple');				textarea.removeClass('wysiwyg-advanced');
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
				$(this).siblings(':hidden').attr('value', 1);
			}else{
				$(this).attr('value', 0);
				$(this).siblings(':hidden').attr('value', 0);
			} 
		})						$(':file').change(function(e){			//console.log($(this).attr('value'));			process();		})
	})
})(jQuery);// Upload logo functionfunction process(){	//$('#msg-ajax').css('display','none');		var conf = confirm('Update logo file?');			if(conf){		var formData = new FormData($('#channel-form')[0]);				$.ajax({			type: 'POST',			url: 'admin/epg/channels/add_logo/' + $('#channel-content-fields').attr('data-id'),			processData: false,		    contentType: false,			data:formData,			dataType: 'json',			success: function(respond) {//								if(respond.status){//					var msg = respond.message;//					var imgURL = respond.file;//					//					$('#msg-ajax').html(msg).fadeIn(600);//					$('input#poster').attr('value', '')//					//					if($('#img-poster img').length > 0){//						$('#img-poster img').css('display','none').attr('src', imgURL).fadeIn(600);//					}else{//						$('#img-poster').html('<img style="width:300px;" src="' + imgURL + '" />').css('display','none').fadeIn(600);//					}										//console.log(respond.logo);					$('#ch-logo').css('background', 'url(' + respond.logo + ') no-repeat');				}else if(respond.deleted){//					$('#img-poster img').remove();				}			},		});	}else{		return false;	}}