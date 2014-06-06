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



function process_attch(obj){
	var formData = new FormData($('#product-form')[0]);
	
	$inp_elm = $(obj).parent('.input');
	
	$.ajax({
		type: 'POST',
		url: 'admin/products/do_upload/' + $inp_elm.children('input').attr('id'),
		processData: false,
	    contentType: false,
		data:formData,
		dataType: 'json',
		success: function(respond) {
			
			var URL = respond.file;
			
			
			if(respond.type == 'poster'){
				msg = '<span style="color:red;">' + respond.message + '</span>';
				
				$('input#poster').val('');
				
				if($('#img-poster img').length > 0){
					$('#img-poster img').css('display','none').attr('src', URL).fadeIn(600);
				}else{
					$('#img-poster').html('<img style="width:300px;" src="' + URL + '" />').css('display','none').fadeIn(600);
				}
			}else{
				if(respond.status){
					msg = '<span style="color:green;">Attachment added</span>';
					
					$('div#no-data').remove();
					
					if($('table#attch-list').length > 0){
						$('table#attch-list tbody').append(respond.list);
					}else{
						var tableElm = '<table id="attch-list"><thead><th>Name</th><th>Size</th><th>MIME Type</th><th></th></thead><tbody></tbody></table>';
	
						$('#attch-files').append(tableElm);
						$('table#attch-list tbody').append(respond.list);
					}
					
					$('input#attch, input#attchname').val('');
				}else{
					msg = '<span style="color:red;">' + respond.message + '</span>';
				}
			}
			
			$inp_elm.children('.msg-ajax').html(msg).fadeIn(600);
		},
	});
}


function delete_attch(obj){
	var formData = new FormData($('#product-form')[0]);
	var del = confirm('This action will delete selected file from server.\n\nAre you sure?');
	
	if(del){
		$.ajax({
			type: 'POST',
			url: 'admin/products/delete_attch/' + $(obj).attr('data-key'),
			processData: false,
		    contentType: false,
			data:formData,
			dataType: 'json',
			success: function(respond) {
				
				if(respond.status){
					var parent = $(obj).parent().parent();
					$(parent).remove();
					
					$items = $('table#attch-list tbody tr').length;
					if($items == 0){
						$('table#attch-list').remove();
						$('#attch-files').append('<div id="no-data">No Attachment</div>');
					}
				}else{
					console.log('something wrong');
				}
			},
		});
	}else{
		return false;
	}
}




// ================================ Package Group Function ====================================== //

function update_group(id){
	var formData = new FormData($('#product-form')[0]);
//	var name = $('[name="' + slug + '"]').val();
//	var body = $('[name="' + slug + '-body"]').val();
//
//	console.log(body);
	
	$.ajax({
		type: 'POST',
		url: 'admin/products/update_pack_group/' + id,
		processData: false,
	    contentType: false,
		data:formData,
		dataType: 'json',
		success: function(respond) {			
			if(respond.status){
				$('ul#group-'+id).find('div.msg').html('Your changes has been saved.').animate({
													opacity: 1,
													}, 2000, function() {
														$(this).animate({
															opacity:0,
															},800, function(){
														});
												});
			}else{
				
			}
			
		},
	});
}
