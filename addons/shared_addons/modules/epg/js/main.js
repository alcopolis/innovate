$(document).ready(function(){
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
			$(this).siblings(':hidden').attr('value', 1);
		}else{
			$(this).attr('value', 0);
			$(this).siblings(':hidden').attr('value', 0);
		} 
	})
	
	$('#datepicker, .datepicker').datepicker({dateFormat: 'yy-mm-dd'});
	
	
	
	// ========================== TV Guide Function ========================//
	
	var t;
	
	$('.epg .show').each(function(){
		$(this).click(function(e){
			clearTimeout(t);
			
			boxpos = $(this).position();

			$(this).append($('#detail-container'));

			$('#detail-container').css({'top':boxpos.top + 70 + 'px', 'left':boxpos.left + 'px'})
		
			title = $(this).attr('data-title');
			$('#detail-container p#title').html(title);
		
			
			if($(this).attr('data-id') != ''){
				synid = $(this).attr('data-id');
				$('#detail-container p#id').html(synid);
				$('#detail-container hr').show();
			}else{
				$('#detail-container hr').hide();
				$('#detail-container p#id').html('');
			}
			
			if($(this).attr('data-en') != ''){
				synen = $(this).attr('data-en');
				$('#detail-container p#en').html(synen);
				$('#detail-container hr').show();
			}else{
				$('#detail-container hr').hide();
				$('#detail-container p#en').html('');
			}


			$('#detail-container').css('display', 'block').animate(
				{opacity:1}
			)
			
		})

		$(this).mouseout(function(){
			t = setTimeout(hide, 10000);
		})
	})
})

function hide(){
		console.log('hide');
		clearTimeout(t);
		
		$('#detail-container').animate(
				{opacity:0},400,function(){
					$(this).css('display', 'none');
				}
			)
	}

fnScroll = function(){
  $('#theader').scrollLeft($('#tdata').scrollLeft());
  $('#tcol').scrollTop($('#tdata').scrollTop());
}