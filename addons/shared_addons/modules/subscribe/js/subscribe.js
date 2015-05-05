// JavaScript Document

$(document).ready(function(){
	var fields = $('.input');
	
	$.each(fields, function(index, obj){
		$(this).children('input, textarea').change(function(){
			var errElm = $(this).parent().children('p.error');
			$(errElm).detach();
		})
	})
});