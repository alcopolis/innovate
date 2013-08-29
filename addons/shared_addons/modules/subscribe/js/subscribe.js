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
							title = '<span class="bundle">Bundle &raquo;</span> ' + respond.data.net.package_name + ' & ' + respond.data.tv.package_name;
							desc = 'Paket bundle layanan ' + respond.data.net.package_name.toLowerCase() + ' ' + respond.data.net.package_body.toLowerCase() + ' + ' + respond.data.tv.package_body.toLowerCase();
							add = '<small style="color:#C00"><strong>Diskon 10% selama masa promosi.</strong></small>';
						}else{
							title = respond.data.package_name;
							desc = respond.data.package_body;
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
	
});