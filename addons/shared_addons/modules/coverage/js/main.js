var city;

//Persiapan untuk sistem coverage versi PMO
var city;
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
	
	$('div.pagination > ul li').bind('click', function(){
		if(!$(this).hasClass('active')){
			get_area(city, $(this).html());
			$(this).parent().find('li.active').removeClass('active');
			$(this).addClass('active');
		}
	});
});


function get_area(c = '', p = null){
	//var rqPath = 'coverage/get_area/?city=' + c + '&page=1';
	var rqPath = 'coverage/get_area/?city=';
	
	if(c != ''){
		
		if(p != null){
			rqPath += c + '&page=' + p;
		}else{
			rqPath += c + '&page=1';
		}
		
		$.ajax({
			type: 'GET',
			url: rqPath,
			processData: false,
		    contentType: false,
			dataType: 'json',
			success: function(respond) {
				$('#cov-result').html('');				
				$('#cov-result').html(processedData('area', respond.data));

				if(p == null){					
					if(respond.numdata > 10){
						pagesTot = Math.ceil(respond.pageTotal);
						
						$('div.pagination ul').html(processedPagination(pagesTot));
						
						$('div.pagination > ul li').bind('click', function(){
							if(!$(this).hasClass('active')){
								get_area(city, $(this).html());
								$(this).parent().find('li.active').removeClass('active');
								$(this).addClass('active');
							}
						});
					}else{
						$('div.pagination ul').html('');
					}
				}
			}
		});
	}
}



function processedData(field, data){
	var procData;
	
	if(field != ''){
		switch(field){
			case 'area' :
				procData = '<div id="area-list">';
				data.forEach(function(entry){
					procData += '<span class="area">' + entry + '</span>';
				});
				procData += '</div>';
				
				break;
		}
	}
	
	return procData;
}


function processedPagination(pagesTot){	
	var paging = '';
	for(i=0; i<=pagesTot; i++){
		if(i == 0 || i == 1){
			paging += '<li class="active">1</li>';
			i++;
		}else{
			paging += '<li>' + i + '</li>';
		}
	}
	
	return paging;
}