$(function(){
	var txt = $('.choices li label').text();

	
	$('#add-new-q').click(function(e){
		e.preventDefault();
		
		var qCollection = $('#q-collection > li');
		var qAmount = $(qCollection).length;
		var nextCounter = qAmount + 1;
		var nextHtml = '';
		
		
		nextHtml += '<li>';
		nextHtml += '<input type="text" style="width:75%;" class="editable" value="" name="q-' + nextCounter + '">';
		nextHtml += '<span class="crud-tools"><a id="add-new-c" class="no-click" href="#">Add Choices</a> | <a class="del" href="#">Delete</a></span>';
		nextHtml += '<ul class="choices" id="q-' + nextCounter + '">';
		nextHtml += '</ul></li>';
		
		if(nextCounter <= 5){
			$('#q-collection').append(nextHtml);
		}
	});
	
	
	
	
	$('#add-new-c').live('click', function(e){
		e.preventDefault();
		
		var cCollection = $(this).parent().siblings('.choices');
		var aCollection = ['a', 'b', 'c', 'd'];
		var cAmount = $(cCollection).children('li').length;
		var nextCounter = cAmount + 1;
		var qID = $(cCollection).attr('id');
		var nextHtml = '';
		
		nextHtml += '<li>';
		nextHtml += '<input id="' + qID + '" type="radio" value="' + aCollection[cAmount] + '" name="' + qID + '">';
		nextHtml += '<input class="editable" type="text" style="width:60%;" value="" name="'+ qID + '-c-' + nextCounter +'">';
		nextHtml += '<span class="crud-tools"><a class="del" href="#">Delete</a></span></li>';
		
		
		if(nextCounter <= 4){
			$(cCollection).append(nextHtml);
		}
	});
	
	
	
	$('.crud-tools a.del').live('click', function(e){
		e.preventDefault();
		var doDelete = confirm('Delete?');
		var qObj = $(this).parent().parent('li');
		if(doDelete){
			$(qObj).remove();
		}
	});
	
	
	$('button[name="btnAction"]').click(function(e){
		e.preventDefault();
		//console.log($(this).val());

		var qaForm = $('#qa-form').serializeArray();
		$.each(qaForm, function(k, field){
			console.log(field.name + ':' + field.value + '\n');
		})
		
	})
});