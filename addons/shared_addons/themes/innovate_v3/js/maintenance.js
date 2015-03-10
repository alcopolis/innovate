// JavaScript Document

$(document).ready(function(){
		
		$("input[type=text]").focus(function(){
		    // Select field contents
			if(this.value == this.defaultValue){
		        this.select();
		    }
		});
		
		$('#subscribe-form').submit(function(e){
			e.preventDefault();
			process();
		});
	
		$('#subscribe').click(function(e){
			e.preventDefault();
			process();
		});
});

function process(){
	$('#msg-ajax').css('display','none');
	dataString = $('#subscribe-form').serialize();
	
	console.log(dataString);
	
	$.ajax({
		type: 'POST',
		url: 'subscriber/process/',
		data: dataString,
		dataType: 'json',
		success: function(data) {
			var msg;
			
			if(data.email_check == "invalid"){
				msg = '<p class="errorMessage">Sorry, <span class="emph">' +  data.email + '</span> is NOT a valid e-mail address. Please try again.</p>';
			} else if(data.email_check == "no input") {
				msg = '<p class="error">Please enter your email address.</p>';
			} else {
				if(data.exist == "yes"){
					msg = '<p class="success"><span class="emph">' + data.email + '</span> is already registered.</p>';
				}else{
					msg = '<p class="success">Thank you for your subscription.</p>';
				}
			}
			
			$('#msg-ajax').html(msg).fadeIn(600);
		}
	});
}