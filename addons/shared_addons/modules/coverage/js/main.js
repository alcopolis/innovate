var city;

//Persiapan untuk sistem coverage versi PMO
var area;
var postal;
var complex;


$(function(){
	$('select[name="city"]').change(function(){
		var sel = $(this);
		if(sel.val() != 'select'){
			get_area(sel.val());
		}
		
		city = sel.val();
	})	
});


function get_area(c = ''){
	if(c != ''){
		$.ajax({
			type: 'GET',
			url: 'coverage/get_area/?city=' + c,
			processData: false,
		    contentType: false,
			dataType: 'json',
			success: function(respond) {
				$('#cov-result').html('');
				
//				processedData = '<ul>';
//				
//				dataKompleks = respond.data;
//				dataKompleks.forEach(function(entry){
//					processedData += '<li>' + entry + '</li>';
//				})
//				
//				processedData += '</ul>';
//				$('#cov-result').html(processedData);
//				
//				console.log(city);
				
				$('#cov-result').html(processedData('area', respond.data));
			}
		});
	}
}

function processedData(field, data){
	var procData;
	
	if(field != ''){
		switch(field){
			case 'area' :
				procData = '<ul>';
				data.forEach(function(entry){
					procData += '<li>' + entry + '</li>';
				});
				procData += '</ul>';
				
				break;
		}
	}
	
	return procData;
}