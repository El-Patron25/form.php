
$(document).ready(function() {
   
   $('#uan').on('focusout', function() {
   	if($('#uan').val() != ""){
   		if (validateEmail($('#uan').val())) {
   			$('.error').fadeOut('slow');
   		}else{
   			$('.error').text('Invalid Username');
   			$('.error').fadeIn('slow');
   		}
   	}else{
   		$('.error').text('Username Required..!');
   		$('.error').fadeIn('slow');
   	}

   });

});

function validateEmail(eVal) {
	let val = /^[a-zA-Z0-9]*$/;

	if(val.test(eVal)){
		return true;
	}else{
		return false;
	}
}