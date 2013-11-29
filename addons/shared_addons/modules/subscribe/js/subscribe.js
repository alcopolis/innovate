// JavaScript Document

$(document).ready(function(){
		
	$('.packages').change(function(){
		var net = $('[name="packages-net"]').val();
		var tv = $('[name="packages-tv"]').val();

		if(net != 0 || tv != 0){
			$('#pack-info').show();

			var title = '';
			var desc = '';
			var add = '';
			var price = '';
			
			$.ajax({
				type: 'GET',
				url: 'subscribe/pack_info/?net=' + net + '&tv=' + tv,
				dataType: 'json',
				success: 
					function(respond) {							
						if(respond.bundle){
							title = '<span class="bundle">Bundle &raquo;</span> ' + respond.data.net.name + ' & ' + respond.data.tv.name;
							desc = 'Paket bundle layanan ' + respond.data.net.name.toLowerCase() + ' ' + respond.data.net.body.toLowerCase() + ' + ' + respond.data.tv.body.toLowerCase();
							add = '<small style="color:#C00"><strong>Diskon 10% selama masa promosi.</strong></small>';
						}else{
							title = respond.data.name;
							desc = respond.data.body;
							add = '';
						}

						$('#pack-info #pack-name').html(title);
						$('#pack-info #pack-desc').html(desc);
						$('#pack-info #additional-info').html(add);
					},
			});
		}else{
			$('#pack-info #pack-name').html('');
			$('#pack-info').hide();
		}
	});
	
	
	
	if($('#pack-name').html() != '' || $('#pack-desc').html() != ''){
		$('#pack-info').css('display', 'block');
	}
	
});