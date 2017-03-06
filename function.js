(function($){
	$(document).on('click','.btn-galvan', function(event){
		event.preventDefault();
	    var has_error = 0 ;
	    var email = $("#email").val();
	    var atpos = email.indexOf("@");
	    var dotpos = email.lastIndexOf(".");
	    var form = $(this).attr('data-form');
	    var action = $(this).attr('data-action');	    
	    var dataString = $('.'+form).serialize();
	            
	    if (form.length ==false) {
	    	return false;
	    }else{console.log(form);}

	    $('.'+form+' .required').each(function(){
	    	if($(this).val().length == 0) {
		        has_error = 1 ;
		        $(this).css({
		            "border-left": "solid 3px #D03019"
		        });
		    }
	    });
	    
	    if(atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
	        has_error = 1 ;
	        $('#email').css({
	        	"border-left": "solid 3px #D03019"
	    	});
	    	$('.status-form').removeClass('alert-success');
	    	$('.status-form').addClass('alert-danger');
	    	$('.status-form').html('<p><i class="fa fa-info-circle"></i> <strong>Verifique el correo.</strong></p>');
	    	return false
	    }
	    
	    if(has_error == 0 ) {
	        $.ajax({
	            type: "POST",
	             url: 'http://'+location.hostname+'/wp-admin/admin-ajax.php?action='+action,
	             action: 'glv_suscription_save',
	             data: dataString,
	             beforeSend:function(){
	             	$('.btn-galvan').prop('disabled',true);
	             	$('.btn-galvan').html('<i class="fa fa-spinner fa-spin"></i> procesando...');
	             },
	             success: function (data) {
	             	$('.btn-galvan').html('<i class="fa fa-ok-sign"></i>');
	             	$('.form-control').css({
			        	"border-left": "solid 3px #65a569"
			    	});
	             	$('input.form-control').val('');
	             	$('.status-form').removeClass('alert-danger');
	             	$('.status-form').addClass('alert-success');
	             	$('.status-form').fadeIn(300);
	             	$('.status-form').html('<p><i class="fa fa-info-circle"></i> <strong>'+data+'</strong></p>');
	             	$('.status-form').fadeOut(600);
	             	fbq('track', form, {
					value: 1.00,
					currency: 'MXN'
					});
					$('.btn-galvan').html('<i class="fa fa-send"></i> Enviar');
					$('.btn-galvan').prop('disabled',false);
	             }
	         });
	    }else{
	    	$('.status-form').removeClass('alert-success');
	    	$('.status-form').addClass('alert-danger');
	    	$('.status-form').fadeIn(300);
	    	$('.status-form').html('<p><i class="fa fa-info-circle"></i> <strong>Debe llenar todos los campos.</strong></p>');
	    	$('.status-form').fadeOut(600);
	    }
	});

	$(document).on('change','.country', function(){
		var country = $(this).val();
		console.log(country);
		if (country == 'Mexico') {
			$('.form-hide').fadeIn(400);
		}else{
			$('.form-hide').fadeOut(400);
		}
	});

	$('.numbers').keypress(function(tecla) {
	    if(tecla.charCode ==0) return true;
	    if(tecla.charCode < 48 || tecla.charCode > 57) return false;
	});

	$(".select2_multiple").select2({
          maximumSelectionLength: 4,
          placeholder: "Seleccione los servicios de interés",
          allowClear: true
    });
})(jQuery);

