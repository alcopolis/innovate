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
	
	
	$('#content-bg').height($('#content').innerHeight() + 16);
	
	
	// ========================== TV Guide Function ========================//
	
	var t;
	
	$('.epg .show').each(function(){
		$(this).click(function(e){
			clearTimeout(t);
			
			boxpos = $(this).position();

			$(this).append($('#detail-container'));

			$('#detail-container').css({'top':boxpos.top + 70 + 'px', 'left':boxpos.left + 'px'})
		
			title = '<a title="Click for more info" href="' + $(this).attr('data-url') + '">' + $(this).attr('data-title') + '</a> | <span id="time">' + $(this).attr('data-time'); + '</span>';
			time = $(this).attr('data-time');
			
			
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
			clearTimeout(t);
			t = setTimeout(hide, 3000);
		})
	})
	
	
	// ==================================== EPG TABLE ==========================================//
	
	if($('#epg').length > 0){
		$('.channel').each(function(){
			var temp = $(this).html().truncate(15, false, 'right', '');
			$(this).html(temp);
		});
		
		$('.show div').each(function(){
			var temp = $(this).html().truncate(15, false, 'right', '...');
			$(this).html(temp);
		});

		
		var epgContW = $('#tdata').width();
		var epgContH = $('#tdata').height();

		var blockDataWidth = 240;
		var blockDataMargin = 3;

		var showContW = (blockDataWidth + blockDataMargin) * 26;

		$('#tdata').width(epgContW + 16);
		$('#tdata').height(epgContH + 16);
		$('#tdata .sh-row').width(showContW);
	}
})

function hide(){
		$('#detail-container').animate(
				{opacity:0},400,function(){
					$(this).css('display', 'none');
				}
			)
	}

fnScroll = function(){
	$('#detail-container').css({'display':'none', 'opacity':'0'});
	$('#theader').scrollLeft($('#tdata').scrollLeft());
	$('#tcol').scrollTop($('#tdata').scrollTop());
}