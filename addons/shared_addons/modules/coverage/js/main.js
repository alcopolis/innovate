$(function(){
	$('select[name="city"]').change(function(){
		var sel = $(this);
		if(sel.val() != 'select'){
			get_area(sel.val());
		}
	})	
});


function get_area(city = ''){
	if(city != ''){
		//
		
		$.ajax({
			type: 'GET',
			url: 'coverage/get_area/' + city,
			processData: false,
		    contentType: false,
			dataType: 'json',
			success: function(respond) {
				$('#cov-result').html(respond.data);
			}
		});
	}
}