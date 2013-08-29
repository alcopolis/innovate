// JavaScript Document

$(document).ready(function(){
	
	//Filter function
	if($('[name="search_key"]').val() == 'date'){
		$('[name="search_term"]').addClass('datepicker').datepicker({dateFormat: 'dd-mm-yy'});
	}
	
	$('[name="search_key"]').change(function(){
		if($(this).val() == 'date'){
			$('[name="search_term"]').attr('value', '');
			$('[name="search_term"]').addClass('datepicker').datepicker({dateFormat: 'dd-mm-yy'});
		}else{
			$('[name="search_term"]').datepicker('destroy');
			$('[name="search_term"]').attr('value', '');
		}
	})

	
	// Change Status Function
	$('.status-dropdown').change(function(){
		var sid = $(this).attr('id');
		
		$.ajax({
			type: 'GET',
			url: 'admin/subscribe/change_status/?id=' + sid + '&val=' + $(this).val(),
			dataType: 'json',
			success: function(response) {
				if(response.lock){
					$parent = $('td#' + sid);

					switch(response.val){
						case '2': $parent.html('<span style="color:rgba(0,180,0,.75);"><strong>Closed</strong></span>'); break;
						case '3': $parent.html('<span style="color:rgba(255,0,0,.75);"><strong>Cancelled</strong></span>'); break;
					}
					
				}
			},
		});
	})
	
});



//Download Data Function
function doSave(){
	var formData = new FormData($('#filter-form')[0]);
	
	$.ajax({
		type: 'POST',
		url: 'admin/subscribe/do_save',
		processData: false,
	    contentType: false,
		data:formData,
		dataType: 'json',
		success: function(response) {
			window.location = response.url;
		},
	});
}