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
	
	var delimiter = '_', start = 0, 
    
	
	
	selectOri = $(container);
	
	container += '_chzn';
	selectPyro = $(container);
	
	//Get Select Input List ID
		itemID = $(selectPyro).find('li:last-child').attr('id');
		tokens = itemID.split(delimiter).slice(start);
		tokens.pop();
		MasterID = tokens.join(delimiter) + '_';
		
		itemCounter = parseInt(itemID.slice(-1)) + 1;
		//console.log(itemCounter, MasterID);
	
	
	$.ajax({
		type: 'GET',
		url: 'admin/articles/add_category/',
		processData: false,
	    contentType: false,
		data:'word=' + word,
		dataType: 'json',
		success: function(respond) {
					//console.log($(selectOri).length);
					$(selectOri).find('option').attr('selected', false);
					$(selectOri).append('<option selected="selected" value="' + itemCounter + '">' + word + '</option>');
					
					$(selectPyro).find('li').removeClass('result-selected');
					$(selectPyro).find('a.chzn-single span').html(word);
					tag = '<li class="active-result result-selected" id="' + MasterID + itemCounter + '">' + word + '</li>';
					$(selectPyro).find('ul').append(tag);
					
					//console.log($(selectPyro).length);
				}
	});
}