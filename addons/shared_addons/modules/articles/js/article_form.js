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
})


function addCategory(obj){
	$('#new-cat-div').removeClass('hide');
	//$('#new-cat-div input[type="button"]').click(function(){processCat($('#new-cat-div input[name="new_category"]').val())});
	
	var selectID = '#' + $(obj).siblings('select').attr('id');	
	;
	$('#new-cat-div input[type="button"]').click(function(){
											word = $('#new-cat-div input[name="new_category"]').val();
											processCat(word, selectID)
										});
}

function processCat(word, container){
	
	selectOri = $(container);
	//selectPyro = $(container + '_chzn');
	selectPyro = $('.chzn-container .chzn-drop .chzn-results');

	
	
	$.ajax({
		type: 'GET',
		url: 'admin/articles/add_category/',
		processData: false,
	    contentType: false,
		data:'word=' + word,
		dataType: 'json',
		success: function(respond) {
					console.log($(selectOri).length);
					$(selectOri).append('<option>' + word + '</option>');
					
					tag = '<li class="active-result" id="">' + word + '</li>';
					$(selectPyro).append(tag);
					
					//console.log($(selectPyro).length);
				}
	});
}