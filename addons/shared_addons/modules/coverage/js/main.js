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

				console.log(respond.numdata);
				if(p == null && respond.numdata > 10){
					$('div.pagination ul').html('')
					pagesTot = Math.ceil(respond.pageTotal);
					
					$paging = '';
					for(i=0; i<=pagesTot; i++){
						if(i == 0 || i == 1){
							$paging += '<li class="active">1</li>';
							i++;
						}else{
							$paging += '<li>' + i + '</li>';
						}
					}
					
					$('div.pagination ul').html($paging);
					
					$('div.pagination > ul li').bind('click', function(){
						if(!$(this).hasClass('active')){
							get_area(city, $(this).html());
							$(this).parent().find('li.active').removeClass('active');
							$(this).addClass('active');
						}
					});
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
				procData = '<div class="area" style="font-size:13px; -moz-column-count:2; -moz-column-gap:20px;">';
				data.forEach(function(entry){
					procData += '<span style="display block">' + entry + '</span><br/>';
				});
				procData += '</div>';
				
				break;
		}
	}
	
	return procData;
}


function processedPagination(current){
	
}